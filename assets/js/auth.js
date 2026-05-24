/**
 * Afrochick — Authentication (PHP session + API / MySQL)
 */
const AUTH_KEY = 'afrochick-auth';

const Auth = {
  getUser() {
    try {
      const data = localStorage.getItem(AUTH_KEY);
      return data ? JSON.parse(data) : null;
    } catch {
      return null;
    }
  },

  _setUser(user) {
    if (user) {
      localStorage.setItem(AUTH_KEY, JSON.stringify(user));
    } else {
      localStorage.removeItem(AUTH_KEY);
    }
  },

  isLoggedIn() {
    return !!this.getUser();
  },

  async refresh() {
    try {
      const res = await Api.get('/api/auth/me.php');
      if (res.success && res.user) {
        this._setUser(res.user);
        return res.user;
      }
    } catch {
      this._setUser(null);
    }
    return null;
  },

  async login(email, password) {
    try {
      const res = await Api.post('/api/auth/login.php', { email, password });
      if (res.success) {
        this._setUser(res.user);
        return { success: true, user: res.user };
      }
      return { success: false, message: res.message || 'Login failed.' };
    } catch (e) {
      return { success: false, message: e.data?.message || e.message };
    }
  },

  async signup(name, email, password) {
    try {
      const res = await Api.post('/api/auth/signup.php', { name, email, password });
      if (res.success) {
        this._setUser(res.user);
        return { success: true, user: res.user };
      }
      return { success: false, message: res.message || 'Signup failed.' };
    } catch (e) {
      return { success: false, message: e.data?.message || e.message };
    }
  },

  async logout() {
    try {
      await Api.post('/api/auth/logout.php', {});
    } catch {
      /* still clear client */
    }
    this._setUser(null);
    window.location.replace('/index.php');
  },

  requireAuth(redirectTo = '/login.php') {
    if (!this.isLoggedIn()) {
      const next = encodeURIComponent(window.location.pathname);
      window.location.href = `${redirectTo}?next=${next}`;
      return false;
    }
    return true;
  },

  isAdmin() {
    return this.getUser()?.role === 'admin';
  },

  requireAdmin() {
    if (!this.requireAuth('/login.php')) return false;
    if (!this.isAdmin()) {
      window.location.href = '/dashboard.php';
      return false;
    }
    return true;
  },

  async updateProfile(name, email) {
    try {
      const res = await Api.put('/api/auth/profile.php', { name, email });
      if (res.success) {
        this._setUser(res.user);
        return { success: true, user: res.user };
      }
      return { success: false, message: res.message };
    } catch (e) {
      return { success: false, message: e.data?.message || e.message };
    }
  },

  async updatePassword(currentPassword, newPassword) {
    try {
      const res = await Api.put('/api/auth/password.php', { currentPassword, newPassword });
      return res.success
        ? { success: true, message: res.message }
        : { success: false, message: res.message };
    } catch (e) {
      return { success: false, message: e.data?.message || e.message };
    }
  },
};

function initAuthNav() {
  const loginBtn = document.getElementById('nav-login-btn');
  const signupBtn = document.getElementById('nav-signup-btn');
  const userMenu = document.getElementById('nav-user-menu');
  const userName = document.getElementById('nav-user-name');
  const logoutBtn = document.getElementById('nav-logout-btn');
  const startBtn = document.getElementById('nav-start-btn');

  const user = Auth.getUser();

  if (user) {
    loginBtn?.classList.add('hidden');
    signupBtn?.classList.add('hidden');
    userMenu?.classList.remove('hidden');
    if (userName) userName.textContent = user.name.split(' ')[0];
    if (user.role === 'admin') {
      document.getElementById('nav-admin-link')?.classList.remove('hidden');
    }
    logoutBtn?.addEventListener('click', (e) => {
      e.preventDefault();
      Auth.logout();
    });
  } else {
    userMenu?.classList.add('hidden');
    loginBtn?.classList.remove('hidden');
    signupBtn?.classList.remove('hidden');
  }

  startBtn?.addEventListener('click', (e) => {
    if (!Auth.isLoggedIn()) {
      e.preventDefault();
      window.location.href = '/login.php?next=' + encodeURIComponent('/dashboard.php');
    }
  });
}

function validateEmail(email) {
  return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email);
}

function showFieldError(input, message) {
  const group = input.closest('.form-group');
  const err = group?.querySelector('.field-error');
  if (err) {
    err.textContent = message;
    err.hidden = !message;
  }
  input.classList.toggle('input-error', !!message);
}

function clearFormErrors(form) {
  form.querySelectorAll('.field-error').forEach((el) => {
    el.textContent = '';
    el.hidden = true;
  });
  form.querySelectorAll('.input-error').forEach((el) => el.classList.remove('input-error'));
}

document.addEventListener('DOMContentLoaded', async () => {
  if (typeof Api !== 'undefined') {
    await Auth.refresh();
  }
  initAuthNav();
});
