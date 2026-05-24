document.addEventListener('DOMContentLoaded', async () => {
  const grid = document.getElementById('products-grid');
  const tabs = document.getElementById('category-tabs');
  const search = document.getElementById('product-search');
  const empty = document.getElementById('products-empty');
  const modal = document.getElementById('product-modal');
  if (!grid || !tabs) return;

  let allProducts = [];
  let activeCategory = 'All';
  let query = '';

  try {
    allProducts = await ProductStore.getApproved();
  } catch {
    allProducts = typeof MOCK_PRODUCTS !== 'undefined'
      ? MOCK_PRODUCTS.filter((p) => p.status === 'approved')
      : [];
  }

  PRODUCT_CATEGORIES.forEach((cat) => {
    const btn = document.createElement('button');
    btn.type = 'button';
    btn.className = 'category-tab' + (cat === 'All' ? ' active' : '');
    btn.textContent = cat;
    btn.dataset.category = cat;
    btn.addEventListener('click', () => {
      activeCategory = cat;
      tabs.querySelectorAll('.category-tab').forEach((t) => t.classList.toggle('active', t.dataset.category === cat));
      render();
    });
    tabs.appendChild(btn);
  });

  search?.addEventListener('input', () => {
    query = search.value.trim().toLowerCase();
    render();
  });

  document.getElementById('modal-close')?.addEventListener('click', closeModal);
  modal?.addEventListener('click', (e) => {
    if (e.target === modal) closeModal();
  });
  document.addEventListener('keydown', (e) => {
    if (e.key === 'Escape') closeModal();
  });

  render();

  function getFiltered() {

    return allProducts.filter((p) => {


    const source = typeof ProductStore !== 'undefined' ? ProductStore.getApproved() : MOCK_PRODUCTS.filter((p) => p.status === 'approved');
    return source.filter((p) => {

    return MOCK_PRODUCTS.filter((p) => {
      if (p.status !== 'approved') return false;
      if (activeCategory !== 'All' && p.category !== activeCategory) return false;
      if (!query) return true;
      const hay = [p.name, p.category, p.description, ...(p.ingredients || []), ...(p.benefits || [])].join(' ').toLowerCase();
      return hay.includes(query);
    });
  }

  function render() {
    const items = getFiltered();
    grid.innerHTML = items
      .map(
        (p) => `
      <article class="glass-card product-card reveal visible" data-id="${p.id}">
        <div class="product-image">${p.image}</div>
        <div class="product-info">
          <span class="product-category">${p.category}</span>
          <h3>${p.name}</h3>
          <p class="product-price">${p.price}</p>
        </div>
      </article>`
      )
      .join('');

    empty?.classList.toggle('hidden', items.length > 0);

    grid.querySelectorAll('.product-card').forEach((card) => {
      card.addEventListener('click', () => openModal(Number(card.dataset.id)));
    });

    if (typeof lucide !== 'undefined') lucide.createIcons();
  }

  function openModal(id) {

    const p = allProducts.find((x) => x.id === id);

    const p = (typeof ProductStore !== 'undefined' ? ProductStore.getAll() : MOCK_PRODUCTS).find((x) => x.id === id);

    const p = MOCK_PRODUCTS.find((x) => x.id === id);


    if (!p || !modal) return;

    document.getElementById('modal-body').innerHTML = `
      <div class="modal-product-image">${p.image}</div>
      <span class="product-category">${p.category}</span>
      <h2 id="modal-title">${p.name}</h2>
      <p class="modal-price">${p.price}</p>
      <p class="modal-desc">${p.description}</p>
      <div class="modal-section">
        <h4>Ingredients</h4>
        <ul class="tag-list">${(p.ingredients || []).map((i) => `<li>${i}</li>`).join('')}</ul>
      </div>
      <div class="modal-section">
        <h4>Benefits</h4>
        <ul class="tag-list benefits">${(p.benefits || []).map((b) => `<li>${b}</li>`).join('')}</ul>
      </div>`;
    modal.classList.remove('hidden');
    document.body.style.overflow = 'hidden';
    if (typeof lucide !== 'undefined') lucide.createIcons();
  }

  function closeModal() {
    modal?.classList.add('hidden');
    document.body.style.overflow = '';
  }
});
