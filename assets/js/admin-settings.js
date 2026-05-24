document.addEventListener('DOMContentLoaded', () => {
  if (!Auth.requireAdmin()) return;

  const user = Auth.getUser();
  const settings = AdminStore.getSettings();

  document.getElementById('profile-name').value = user?.name || '';
  document.getElementById('profile-email').value = user?.email || '';
  document.getElementById('pref-notifications').checked = !!settings.emailNotifications;
  document.getElementById('pref-auto-approve').checked = !!settings.autoApprove;
  document.getElementById('pref-timezone').value = settings.timezone || 'UTC';

  document.querySelectorAll('.settings-tab').forEach((tab) => {
    tab.addEventListener('click', () => {
      document.querySelectorAll('.settings-tab').forEach((t) => t.classList.remove('active'));
      document.querySelectorAll('.settings-panel').forEach((p) => p.classList.add('hidden'));
      tab.classList.add('active');
      document.getElementById(`panel-${tab.dataset.tab}`)?.classList.remove('hidden');
    });
  });

  document.getElementById('profile-form')?.addEventListener('submit', (e) => {
    e.preventDefault();
    const form = e.target;
    clearFormErrors(form);
    const name = form.querySelector('#profile-name');
    const email = form.querySelector('#profile-email');
    if (!name.value.trim()) { showFieldError(name, 'Name is required'); return; }
    if (!validateEmail(email.value)) { showFieldError(email, 'Valid email required'); return; }

    const result = Auth.updateProfile(name.value, email.value);
    const msg = document.getElementById('profile-message');
    msg.textContent = result.success ? 'Profile updated.' : result.message;
    msg.className = 'form-message ' + (result.success ? 'success' : 'error');
    msg.hidden = false;
    if (result.success) {
      document.getElementById('admin-user-chip').textContent = result.user.name;
      showToast('Profile saved');
    }
  });

  document.getElementById('password-form')?.addEventListener('submit', (e) => {
    e.preventDefault();
    const form = e.target;
    clearFormErrors(form);
    const current = form.querySelector('#current-password');
    const newPw = form.querySelector('#new-password');
    const confirm = form.querySelector('#confirm-password');

    if (!current.value) { showFieldError(current, 'Required'); return; }
    if (newPw.value.length < 8) { showFieldError(newPw, 'Min 8 characters'); return; }
    if (newPw.value !== confirm.value) { showFieldError(confirm, 'Passwords do not match'); return; }

    const result = Auth.updatePassword(current.value, newPw.value);
    const msg = document.getElementById('password-message');
    msg.textContent = result.success ? result.message : result.message;
    msg.className = 'form-message ' + (result.success ? 'success' : 'error');
    msg.hidden = false;
    if (result.success) {
      form.reset();
      showToast('Password updated');
    }
  });

  document.getElementById('general-form')?.addEventListener('submit', (e) => {
    e.preventDefault();
    AdminStore.saveSettings({
      emailNotifications: document.getElementById('pref-notifications').checked,
      autoApprove: document.getElementById('pref-auto-approve').checked,
      timezone: document.getElementById('pref-timezone').value,
    });
    const msg = document.getElementById('general-message');
    msg.textContent = 'Preferences saved.';
    msg.className = 'form-message success';
    msg.hidden = false;
    showToast('Preferences saved');
  });
});
