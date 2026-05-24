document.addEventListener('DOMContentLoaded', async () => {
  const form = document.getElementById('signup-form');
  if (!form) return;

  if (Auth.isLoggedIn()) {
    window.location.href = getNextUrl(Auth.getUser());
    return;
  }

  form.addEventListener('submit', async (e) => {
    e.preventDefault();
    clearFormErrors(form);

    const name = form.name.value.trim();
    const email = form.email.value.trim();
    const password = form.password.value;
    const confirm = form.confirm.value;
    let valid = true;

    if (name.length < 2) {
      showFieldError(form.name, 'Enter your full name.');
      valid = false;
    }
    if (!validateEmail(email)) {
      showFieldError(form.email, 'Enter a valid email address.');
      valid = false;
    }
    if (password.length < 8) {
      showFieldError(form.password, 'Password must be at least 8 characters.');
      valid = false;
    }
    if (password !== confirm) {
      showFieldError(form.confirm, 'Passwords do not match.');
      valid = false;
    }
    if (!valid) return;

    const btn = form.querySelector('button[type="submit"]');
    btn.disabled = true;
    const result = await Auth.signup(name, email, password);
    btn.disabled = false;

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
