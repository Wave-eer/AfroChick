/**
 * Afrochick — Admin data store (MySQL via API)
 */
const ProductStore = {
  _cache: null,

  invalidate() {
    this._cache = null;
  },

  async getAll() {
    if (this._cache) return this._cache;
    const res = await Api.get('/api/products.php');
    this._cache = res.data || [];
    return this._cache;
  },

  async getApproved() {
    const res = await Api.get('/api/products.php?status=approved');
    return res.data || [];
  },

  async getById(id) {
    const res = await Api.get(`/api/product.php?id=${id}`);
    return res.data;
  },

  async save(product) {
    const payload = {
      name: product.name,
      category: product.category,
      status: product.status || 'approved',
      image: product.image || '🧴',
      price: product.price || '$0',
      ingredients: Array.isArray(product.ingredients) ? product.ingredients : parseList(product.ingredients),
      benefits: Array.isArray(product.benefits) ? product.benefits : parseList(product.benefits),
      description: product.description,
    };

    let res;
    if (product.id) {
      res = await Api.put(`/api/product.php?id=${product.id}`, payload);
    } else {
      res = await Api.post('/api/products.php', payload);
    }
    this.invalidate();
    return res.data;
  },

  async delete(id) {
    await Api.delete(`/api/product.php?id=${id}`);
    this.invalidate();
  },
};

const AdminStore = {
  async getSubmissions() {
    const res = await Api.get('/api/submissions.php');
    return res.data || [];
  },

  async getAnalyses() {
    const res = await Api.get('/api/analyses.php');
    return res.data || [];
  },

  async getStats() {
    const res = await Api.get('/api/admin/stats.php');
    return res.data;
  },

  async getSettings() {
    try {
      const res = await Api.get('/api/admin/settings.php');
      return res.data || {};
    } catch {
      return {};
    }
  },

  async saveSettings(settings) {
    const res = await Api.put('/api/admin/settings.php', settings);
    return res.data;
  },
};

function parseList(str) {
  if (!str) return [];
  if (Array.isArray(str)) return str;
  return String(str)
    .split(',')
    .map((s) => s.trim())
    .filter(Boolean);
}

function formatDate(iso) {
  if (!iso) return '—';
  return new Date(iso).toLocaleDateString('en-US', {
    month: 'short',
    day: 'numeric',
    year: 'numeric',
  });
}
