/**
 * Afrochick — Admin data store (localStorage)
 */
const STORAGE_KEYS = {
  products: 'afrochick-products',
  submissions: 'afrochick-submissions',
  analyses: 'afrochick-analyses',
  users: 'afrochick-users',
  settings: 'afrochick-admin-settings',
};

const ProductStore = {
  init() {
    if (!localStorage.getItem(STORAGE_KEYS.products)) {
      localStorage.setItem(STORAGE_KEYS.products, JSON.stringify(MOCK_PRODUCTS));
    }
    if (!localStorage.getItem(STORAGE_KEYS.analyses)) {
      localStorage.setItem(
        STORAGE_KEYS.analyses,
        JSON.stringify([
          { id: 1, type: 'skin', userEmail: 'demo@afrochick.com', skinType: 'Combination', createdAt: daysAgo(2) },
          { id: 2, type: 'hair', userEmail: 'demo@afrochick.com', hairType: 'Curly', createdAt: daysAgo(5) },
          { id: 3, type: 'skin', userEmail: 'amara@example.com', skinType: 'Oily', createdAt: daysAgo(7) },
        ])
      );
    }
  },

  getAll() {
    this.init();
    try {
      return JSON.parse(localStorage.getItem(STORAGE_KEYS.products) || '[]');
    } catch {
      return [...MOCK_PRODUCTS];
    }
  },

  getApproved() {
    return this.getAll().filter((p) => p.status === 'approved');
  },

  getById(id) {
    return this.getAll().find((p) => p.id === Number(id));
  },

  save(product) {
    const list = this.getAll();
    const payload = {
      id: product.id || Date.now(),
      name: product.name.trim(),
      category: product.category,
      status: product.status || 'approved',
      image: product.image || '🧴',
      price: product.price || '$0',
      ingredients: Array.isArray(product.ingredients)
        ? product.ingredients
        : parseList(product.ingredients),
      benefits: Array.isArray(product.benefits) ? product.benefits : parseList(product.benefits),
      description: product.description.trim(),
      updatedAt: new Date().toISOString(),
    };

    const idx = list.findIndex((p) => p.id === payload.id);
    if (idx >= 0) list[idx] = { ...list[idx], ...payload };
    else list.push({ ...payload, createdAt: new Date().toISOString() });

    localStorage.setItem(STORAGE_KEYS.products, JSON.stringify(list));
    return payload;
  },

  delete(id) {
    const list = this.getAll().filter((p) => p.id !== Number(id));
    localStorage.setItem(STORAGE_KEYS.products, JSON.stringify(list));
  },
};

const AdminStore = {
  getSubmissions() {
    try {
      return JSON.parse(localStorage.getItem(STORAGE_KEYS.submissions) || '[]');
    } catch {
      return [];
    }
  },

  getAnalyses() {
    ProductStore.init();
    try {
      return JSON.parse(localStorage.getItem(STORAGE_KEYS.analyses) || '[]');
    } catch {
      return [];
    }
  },

  getUsers() {
    try {
      const data = localStorage.getItem(STORAGE_KEYS.users);
      if (data) return JSON.parse(data);
    } catch { /* empty */ }
    return Auth._getUsers();
  },

  getStats() {
    const products = ProductStore.getAll();
    const submissions = this.getSubmissions();
    const analyses = this.getAnalyses();
    const users = this.getUsers();

    const skinCount = analyses.filter((a) => a.type === 'skin').length;
    const hairCount = analyses.filter((a) => a.type === 'hair').length;

    return {
      totalUsers: users.length,
      totalAnalyses: analyses.length,
      skinAnalyses: skinCount,
      hairAnalyses: hairCount,
      pendingSubmissions: submissions.filter((s) => s.status === 'pending').length,
      approvedProducts: products.filter((p) => p.status === 'approved').length,
      totalProducts: products.length,
      pendingProducts: products.filter((p) => p.status === 'pending').length,
    };
  },

  getSettings() {
    try {
      return JSON.parse(localStorage.getItem(STORAGE_KEYS.settings) || '{}');
    } catch {
      return {};
    }
  },

  saveSettings(settings) {
    const merged = { ...this.getSettings(), ...settings };
    localStorage.setItem(STORAGE_KEYS.settings, JSON.stringify(merged));
    return merged;
  },
};

function parseList(str) {
  if (!str) return [];
  return String(str)
    .split(',')
    .map((s) => s.trim())
    .filter(Boolean);
}

function daysAgo(n) {
  const d = new Date();
  d.setDate(d.getDate() - n);
  return d.toISOString();
}

function formatDate(iso) {
  if (!iso) return '—';
  return new Date(iso).toLocaleDateString('en-US', {
    month: 'short',
    day: 'numeric',
    year: 'numeric',
  });
}

ProductStore.init();
