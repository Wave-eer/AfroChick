/**
 * Afrochick — Admin shared utilities
 */
document.addEventListener('DOMContentLoaded', () => {
  if (!Auth.requireAdmin()) return;

  const user = Auth.getUser();
  const chip = document.getElementById('admin-user-chip');
  if (chip && user) chip.textContent = user.name;

  document.getElementById('admin-logout')?.addEventListener('click', () => Auth.logout());

  document.getElementById('admin-menu-toggle')?.addEventListener('click', () => {
    document.getElementById('admin-sidebar')?.classList.toggle('open');
  });

  initTheme();
  if (typeof lucide !== 'undefined') lucide.createIcons();
});

function initTheme() {
  const toggle = document.getElementById('theme-toggle');
  const stored = localStorage.getItem('afrochick-theme');
  const prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
  if (stored === 'dark' || (!stored && prefersDark)) {
    document.documentElement.classList.add('dark');
  }
  toggle?.addEventListener('click', () => {
    const isDark = document.documentElement.classList.toggle('dark');
    localStorage.setItem('afrochick-theme', isDark ? 'dark' : 'light');
  });
}

function showToast(message, type = 'success') {
  const container = document.getElementById('toast-container');
  if (!container) return;

  const toast = document.createElement('div');
  toast.className = `toast toast-${type}`;
  toast.textContent = message;
  container.appendChild(toast);

  requestAnimationFrame(() => toast.classList.add('show'));
  setTimeout(() => {
    toast.classList.remove('show');
    setTimeout(() => toast.remove(), 300);
  }, 3200);
}

function statusBadge(status) {
  const s = status || 'pending';
  return `<span class="status-badge status-${s}">${s}</span>`;
}
