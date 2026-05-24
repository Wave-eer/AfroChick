document.addEventListener('DOMContentLoaded', () => {
  Auth.requireAuth('/login.php?next=' + encodeURIComponent('/dashboard.php'));
});
