document.addEventListener('DOMContentLoaded', () => {
  if (!Auth.requireAdmin()) return;

  let deleteId = null;
  let viewOnly = false;

  const modal = document.getElementById('product-modal');
  const deleteModal = document.getElementById('delete-modal');
  const form = document.getElementById('product-form');
  const viewPanel = document.getElementById('product-view');
  const categorySelect = document.getElementById('product-category');

  SUBMIT_CATEGORIES.forEach((cat) => {
    const opt = document.createElement('option');
    opt.value = cat;
    opt.textContent = cat;
    categorySelect.appendChild(opt);
  });

  document.getElementById('btn-create-product')?.addEventListener('click', () => openModal('create'));
  document.getElementById('modal-close')?.addEventListener('click', closeModal);
  document.getElementById('modal-cancel')?.addEventListener('click', closeModal);
  modal?.addEventListener('click', (e) => { if (e.target === modal) closeModal(); });
  document.getElementById('delete-cancel')?.addEventListener('click', () => deleteModal?.classList.add('hidden'));
  document.getElementById('delete-confirm')?.addEventListener('click', confirmDelete);

  document.getElementById('admin-product-search')?.addEventListener('input', renderTable);
  document.getElementById('admin-status-filter')?.addEventListener('change', renderTable);

  form?.addEventListener('submit', (e) => {
    e.preventDefault();
    if (viewOnly) return;
    saveProduct();
  });

  renderTable();
  if (typeof lucide !== 'undefined') lucide.createIcons();

  function renderTable() {
    const tbody = document.getElementById('products-tbody');
    const empty = document.getElementById('products-empty');
    const q = document.getElementById('admin-product-search')?.value.trim().toLowerCase() || '';
    const statusFilter = document.getElementById('admin-status-filter')?.value || 'all';

    let list = ProductStore.getAll();
    if (statusFilter !== 'all') list = list.filter((p) => p.status === statusFilter);
    if (q) {
      list = list.filter((p) => {
        const hay = [p.name, p.category, p.description, ...(p.ingredients || []), ...(p.benefits || [])].join(' ').toLowerCase();
        return hay.includes(q);
      });
    }

    tbody.innerHTML = list
      .map(
        (p) => `
      <tr>
        <td>
          <div class="table-product">
            <span class="table-product-icon">${p.image || '🧴'}</span>
            <span>${escapeHtml(p.name)}</span>
          </div>
        </td>
        <td>${escapeHtml(p.category)}</td>
        <td>${escapeHtml(p.price)}</td>
        <td>${statusBadge(p.status)}</td>
        <td class="table-actions">
          <button type="button" class="btn-icon-sm" data-action="view" data-id="${p.id}" title="View"><i data-lucide="eye"></i></button>
          <button type="button" class="btn-icon-sm" data-action="edit" data-id="${p.id}" title="Edit"><i data-lucide="pencil"></i></button>
          <button type="button" class="btn-icon-sm btn-icon-danger" data-action="delete" data-id="${p.id}" title="Delete"><i data-lucide="trash-2"></i></button>
        </td>
      </tr>`
      )
      .join('');

    empty?.classList.toggle('hidden', list.length > 0);

    tbody.querySelectorAll('[data-action]').forEach((btn) => {
      btn.addEventListener('click', () => {
        const id = Number(btn.dataset.id);
        const action = btn.dataset.action;
        if (action === 'view') openModal('view', id);
        else if (action === 'edit') openModal('edit', id);
        else if (action === 'delete') openDeleteModal(id);
      });
    });

    if (typeof lucide !== 'undefined') lucide.createIcons();
  }

  function openModal(mode, id) {
    viewOnly = mode === 'view';
    form.classList.toggle('hidden', viewOnly);
    viewPanel.classList.toggle('hidden', !viewOnly);
    document.getElementById('modal-actions').classList.toggle('hidden', viewOnly);
    document.getElementById('modal-heading').textContent =
      mode === 'create' ? 'Create product' : mode === 'edit' ? 'Edit product' : 'View product';

    clearFormErrors(form);
    form.reset();

    if (mode === 'create') {
      document.getElementById('product-id').value = '';
      document.getElementById('product-status').value = 'approved';
      document.getElementById('product-image').value = '🧴';
    } else {
      const p = ProductStore.getById(id);
      if (!p) return;
      if (viewOnly) {
        viewPanel.innerHTML = `
          <div class="view-header">
            <span class="view-emoji">${p.image}</span>
            <div>
              <h3>${escapeHtml(p.name)}</h3>
              ${statusBadge(p.status)}
            </div>
          </div>
          <p><strong>Category:</strong> ${escapeHtml(p.category)} · <strong>Price:</strong> ${escapeHtml(p.price)}</p>
          <p class="view-desc">${escapeHtml(p.description)}</p>
          <p><strong>Ingredients:</strong> ${(p.ingredients || []).join(', ')}</p>
          <p><strong>Benefits:</strong> ${(p.benefits || []).join(', ')}</p>
          <div class="modal-actions">
            <button type="button" class="btn btn-ghost" id="view-close">Close</button>
            <button type="button" class="btn btn-primary" id="view-edit">Edit</button>
          </div>`;
        viewPanel.querySelector('#view-close')?.addEventListener('click', closeModal);
        viewPanel.querySelector('#view-edit')?.addEventListener('click', () => {
          closeModal();
          openModal('edit', id);
        });
      } else {
        document.getElementById('product-id').value = p.id;
        document.getElementById('product-name').value = p.name;
        document.getElementById('product-category').value = p.category;
        document.getElementById('product-price').value = p.price;
        document.getElementById('product-image').value = p.image;
        document.getElementById('product-status').value = p.status;
        document.getElementById('product-ingredients').value = (p.ingredients || []).join(', ');
        document.getElementById('product-benefits').value = (p.benefits || []).join(', ');
        document.getElementById('product-description').value = p.description;
      }
    }

    modal.classList.remove('hidden');
    document.body.style.overflow = 'hidden';
    if (typeof lucide !== 'undefined') lucide.createIcons();
  }

  function closeModal() {
    modal.classList.add('hidden');
    document.body.style.overflow = '';
    viewOnly = false;
  }

  function saveProduct() {
    const name = document.getElementById('product-name');
    const category = document.getElementById('product-category');
    const ingredients = document.getElementById('product-ingredients');
    const benefits = document.getElementById('product-benefits');
    const description = document.getElementById('product-description');

    clearFormErrors(form);
    let valid = true;
    if (!name.value.trim()) { showFieldError(name, 'Required'); valid = false; }
    if (!category.value) { showFieldError(category, 'Required'); valid = false; }
    if (!ingredients.value.trim()) { showFieldError(ingredients, 'Required'); valid = false; }
    if (!benefits.value.trim()) { showFieldError(benefits, 'Required'); valid = false; }
    if (!description.value.trim()) { showFieldError(description, 'Required'); valid = false; }
    if (!valid) return;

    const idVal = document.getElementById('product-id').value;
    ProductStore.save({
      id: idVal ? Number(idVal) : undefined,
      name: name.value,
      category: category.value,
      price: document.getElementById('product-price').value || '$0',
      image: document.getElementById('product-image').value || '🧴',
      status: document.getElementById('product-status').value,
      ingredients: ingredients.value,
      benefits: benefits.value,
      description: description.value,
    });

    closeModal();
    renderTable();
    showToast('Product saved successfully');
  }

  function openDeleteModal(id) {
    deleteId = id;
    deleteModal?.classList.remove('hidden');
  }

  function confirmDelete() {
    if (deleteId) {
      ProductStore.delete(deleteId);
      showToast('Product deleted');
      renderTable();
    }
    deleteId = null;
    deleteModal?.classList.add('hidden');
  }

  function escapeHtml(str) {
    const d = document.createElement('div');
    d.textContent = str ?? '';
    return d.innerHTML;
  }
});
