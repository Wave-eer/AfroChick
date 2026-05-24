document.addEventListener('DOMContentLoaded', () => {
  const form = document.getElementById('login-form');
  if (!form) return;

  if (Auth.isLoggedIn()) {
    window.location.href = getNextUrl(Auth.getUser());
    return;
  }

  const params = new URLSearchParams(window.location.search);
  const signupLink = document.querySelector('.auth-footer-text a[href="/signup.php"]');
  if (signupLink && params.get('next')) {
    signupLink.href = '/signup.php?next=' + encodeURIComponent(params.get('next'));
  }

  form.addEventListener('submit', (e) => {
    e.preventDefault();
    clearFormErrors(form);

    const email = form.email.value.trim();
    const password = form.password.value;
    let valid = true;

    if (!validateEmail(email)) {
      showFieldError(form.email, 'Enter a valid email address.');
      valid = false;
    }
    if (!password) {
      showFieldError(form.password, 'Password is required.');
      valid = false;
    }
    if (!valid) return;

    const result = Auth.login(email, password);
    const msg = document.getElementById('form-message');

    if (result.success) {
      window.location.href = getNextUrl(result.user);
    } else {
      msg.textContent = result.message;
      msg.className = 'form-message error';
      msg.hidden = false;
    }
  });
});

function getNextUrl(user) {
  const params = new URLSearchParams(window.location.search);
  if (params.get('next')) return params.get('next');
  if (user?.role === 'admin') return '/admin/index.php';
  return '/dashboard.php';
}
