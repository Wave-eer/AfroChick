document.addEventListener('DOMContentLoaded', async () => {
  await Auth.refresh();
  if (!Auth.requireAdmin()) return;

  const tbody = document.getElementById('users-tbody');
  const empty = document.getElementById('users-empty');
  let allUsers = [];

  document.getElementById('refresh-users')?.addEventListener('click', () => loadUsers());
  document.getElementById('user-search')?.addEventListener('input', renderTable);
  document.getElementById('user-role-filter')?.addEventListener('change', renderTable);

  await loadUsers();

  async function loadUsers() {
    try {
      const res = await Api.get('/api/admin/users.php');
      allUsers = res.data || [];
      renderTable();
      if (allUsers.length === 0) {
        showToast('No users in database. Run migration to seed accounts.', 'error');
      }
    } catch (e) {
      console.error(e);
      tbody.innerHTML = `<tr><td colspan="6" class="table-empty">Could not load users: ${escapeHtml(e.data?.message || e.message)}. Check database connection.</td></tr>`;
      showToast('Failed to load users from database', 'error');
    }
    if (typeof lucide !== 'undefined') lucide.createIcons();
  }

  function renderTable() {
    const q = document.getElementById('user-search')?.value.trim().toLowerCase() || '';
    const role = document.getElementById('user-role-filter')?.value || 'all';

    let list = allUsers;
    if (role !== 'all') list = list.filter((u) => u.role === role);
    if (q) {
      list = list.filter((u) => {
        const hay = `${u.name} ${u.email} ${u.role}`.toLowerCase();
        return hay.includes(q);
      });
    }

    tbody.innerHTML = list
      .map(
        (u) => `
      <tr>
        <td>${u.id}</td>
        <td><strong>${escapeHtml(u.name)}</strong></td>
        <td>${escapeHtml(u.email)}</td>
        <td>${roleBadge(u.role)}</td>
        <td>${formatDate(u.createdAt)}</td>
        <td class="table-actions">
          <button type="button" class="btn-icon-sm btn-icon-danger" data-delete="${u.id}" title="Delete user" aria-label="Delete">
            <i data-lucide="trash-2"></i>
          </button>
        </td>
      </tr>`
      )
      .join('');

    empty?.classList.toggle('hidden', list.length > 0);

    tbody.querySelectorAll('[data-delete]').forEach((btn) => {
      btn.addEventListener('click', async () => {
        const id = Number(btn.dataset.delete);
        if (!confirm('Delete this user from the database?')) return;
        try {
          await Api.delete(`/api/admin/users.php?id=${id}`);
          showToast('User deleted');
          await loadUsers();
        } catch (err) {
          showToast(err.data?.message || 'Delete failed', 'error');
        }
      });
    });

    if (typeof lucide !== 'undefined') lucide.createIcons();
  }

  function roleBadge(role) {
    const cls = role === 'admin' ? 'status-approved' : 'status-pending';
    return `<span class="status-badge ${cls}">${role}</span>`;
  }

  function escapeHtml(str) {
    const d = document.createElement('div');
    d.textContent = str ?? '';
    return d.innerHTML;
  }
});
