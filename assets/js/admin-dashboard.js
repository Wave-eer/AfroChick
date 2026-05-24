document.addEventListener('DOMContentLoaded', () => {
  if (!Auth.requireAdmin()) return;

  const stats = AdminStore.getStats();
  renderStats(stats);
  renderAnalysisChart(stats);
  renderProductChart(stats);
  renderAnalysesTable();
  renderSubmissionsTable();
  if (typeof lucide !== 'undefined') lucide.createIcons();
});

function renderStats(s) {
  const grid = document.getElementById('stats-grid');
  if (!grid) return;

  const cards = [
    { icon: 'users', label: 'Total users', value: s.totalUsers, color: 'sage' },
    { icon: 'activity', label: 'Total analyses', value: s.totalAnalyses, color: 'blue' },
    { icon: 'clock', label: 'Pending submissions', value: s.pendingSubmissions, color: 'amber' },
    { icon: 'package-check', label: 'Approved products', value: s.approvedProducts, color: 'sage' },
  ];

  grid.innerHTML = cards
    .map(
      (c) => `
    <div class="stat-card glass-card stat-${c.color}">
      <div class="stat-icon"><i data-lucide="${c.icon}"></i></div>
      <div class="stat-body">
        <span class="stat-value">${c.value}</span>
        <span class="stat-label">${c.label}</span>
      </div>
    </div>`
    )
    .join('');
}

function renderAnalysisChart(s) {
  const el = document.getElementById('analysis-chart');
  if (!el) return;
  const total = s.skinAnalyses + s.hairAnalyses || 1;
  el.innerHTML = `
    <div class="bar-row">
      <span class="bar-label">Skin</span>
      <div class="bar-track"><div class="bar-fill bar-sage" style="width:${(s.skinAnalyses / total) * 100}%"></div></div>
      <span class="bar-value">${s.skinAnalyses}</span>
    </div>
    <div class="bar-row">
      <span class="bar-label">Hair</span>
      <div class="bar-track"><div class="bar-fill bar-blue" style="width:${(s.hairAnalyses / total) * 100}%"></div></div>
      <span class="bar-value">${s.hairAnalyses}</span>
    </div>
  `;
}

function renderProductChart(s) {
  const el = document.getElementById('product-chart');
  if (!el) return;
  const total = s.totalProducts || 1;
  const other = s.totalProducts - s.approvedProducts - s.pendingProducts;
  el.innerHTML = `
    <div class="bar-row">
      <span class="bar-label">Approved</span>
      <div class="bar-track"><div class="bar-fill bar-sage" style="width:${(s.approvedProducts / total) * 100}%"></div></div>
      <span class="bar-value">${s.approvedProducts}</span>
    </div>
    <div class="bar-row">
      <span class="bar-label">Pending</span>
      <div class="bar-track"><div class="bar-fill bar-amber" style="width:${(s.pendingProducts / total) * 100}%"></div></div>
      <span class="bar-value">${s.pendingProducts}</span>
    </div>
    <div class="bar-row">
      <span class="bar-label">Other</span>
      <div class="bar-track"><div class="bar-fill bar-muted" style="width:${Math.max(0, (other / total) * 100)}%"></div></div>
      <span class="bar-value">${Math.max(0, other)}</span>
    </div>
  `;
}

function renderAnalysesTable() {
  const tbody = document.querySelector('#analyses-table tbody');
  if (!tbody) return;

  const rows = AdminStore.getAnalyses()
    .sort((a, b) => new Date(b.createdAt) - new Date(a.createdAt))
    .slice(0, 8);

  tbody.innerHTML =
    rows.length === 0
      ? '<tr><td colspan="4" class="table-empty">No analyses yet</td></tr>'
      : rows
          .map(
            (a) => `
      <tr>
        <td><span class="type-pill type-${a.type}">${a.type}</span></td>
        <td>${escapeHtml(a.userEmail)}</td>
        <td>${escapeHtml(a.skinType || a.hairType || '—')}</td>
        <td>${formatDate(a.createdAt)}</td>
      </tr>`
          )
          .join('');
}

function renderSubmissionsTable() {
  const tbody = document.querySelector('#submissions-table tbody');
  if (!tbody) return;

  const rows = AdminStore.getSubmissions()
    .filter((s) => s.status === 'pending')
    .slice(0, 8);

  tbody.innerHTML =
    rows.length === 0
      ? '<tr><td colspan="4" class="table-empty">No pending submissions</td></tr>'
      : rows
          .map(
            (s) => `
      <tr>
        <td>${escapeHtml(s.product_name)}</td>
        <td>${escapeHtml(s.category)}</td>
        <td>${escapeHtml(s.contact_email)}</td>
        <td>${formatDate(s.createdAt)}</td>
      </tr>`
          )
          .join('');
}

function escapeHtml(str) {
  const d = document.createElement('div');
  d.textContent = str ?? '';
  return d.innerHTML;
}
