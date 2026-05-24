/**
 * Afrochick — Mock authentication (localStorage)
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

  isLoggedIn() {
    return !!this.getUser();
  },

  login(email, password) {
    const users = this._getUsers();
    const user = users.find((u) => u.email === email && u.password === password);
    if (!user) return { success: false, message: 'Invalid email or password.' };

    const session = { id: user.id, name: user.name, email: user.email, role: user.role || 'user' };
    localStorage.setItem(AUTH_KEY, JSON.stringify(session));
    return { success: true, user: session };
  },

  signup(name, email, password) {
    const users = this._getUsers();
    if (users.some((u) => u.email === email)) {
      return { success: false, message: 'An account with this email already exists.' };
    }

    const user = {
      id: Date.now(),
      name: name.trim(),
      email: email.trim().toLowerCase(),
      password,
      role: 'user',
    };
    users.push(user);
    localStorage.setItem('afrochick-users', JSON.stringify(users));

    const session = { id: user.id, name: user.name, email: user.email, role: user.role };
    localStorage.setItem(AUTH_KEY, JSON.stringify(session));
    return { success: true, user: session };
  },

  logout() {
    localStorage.removeItem(AUTH_KEY);
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

  _getUsers() {
    try {
      const data = localStorage.getItem('afrochick-users');
      if (data) return JSON.parse(data);
    } catch { /* empty */ }
    return [
      { id: 1, name: 'Demo User', email: 'demo@afrochick.com', password: 'demo1234', role: 'user' },
      { id: 2, name: 'Admin', email: 'admin@afrochick.com', password: 'admin1234', role: 'admin' },
    ];
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

document.addEventListener('DOMContentLoaded', initAuthNav);
