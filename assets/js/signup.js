document.addEventListener('DOMContentLoaded', () => {
  const form = document.getElementById('signup-form');
  if (!form) return;

  if (Auth.isLoggedIn()) {
    window.location.href = getNextUrl();
    return;
  }

  form.addEventListener('submit', (e) => {
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

    const result = Auth.signup(name, email, password);
    const msg = document.getElementById('form-message');

    if (result.success) {
      window.location.href = getNextUrl();
    } else {
      msg.textContent = result.message;
      msg.className = 'form-message error';
      msg.hidden = false;
    }
  });
});

function getNextUrl() {
  const params = new URLSearchParams(window.location.search);
  return params.get('next') || '/dashboard.php';
}
