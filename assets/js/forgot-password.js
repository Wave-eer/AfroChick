document.addEventListener('DOMContentLoaded', () => {
  const form = document.getElementById('forgot-form');
  if (!form) return;

  form.addEventListener('submit', (e) => {
    e.preventDefault();
    clearFormErrors(form);

    const email = form.email.value.trim();
    if (!validateEmail(email)) {
      showFieldError(form.email, 'Enter a valid email address.');
      return;
    }

    form.classList.add('hidden');
    document.getElementById('success-state')?.classList.remove('hidden');
    if (typeof lucide !== 'undefined') lucide.createIcons();
  });
});
