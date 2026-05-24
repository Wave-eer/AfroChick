/**
 * Afrochick — API client (MySQL backend)
 */
const Api = {
  async request(url, options = {}) {
    const headers = { ...(options.headers || {}) };
    const hasBody = options.body !== undefined && options.body !== null;

    if (hasBody && !(options.body instanceof FormData)) {
      headers['Content-Type'] = 'application/json';
      if (typeof options.body === 'object') {
        options.body = JSON.stringify(options.body);
      }
    }

    const res = await fetch(url, {
      credentials: 'same-origin',
      ...options,
      headers,
    });

    let data = {};
    try {
      data = await res.json();
    } catch {
      data = { success: false, message: 'Invalid server response' };
    }

    if (!res.ok) {
      const err = new Error(data.message || 'Request failed');
      err.data = data;
      err.status = res.status;
      throw err;
    }

    return data;
  },

  get(url) {
    return this.request(url);
  },

  post(url, body) {
    return this.request(url, { method: 'POST', body });
  },

  put(url, body) {
    return this.request(url, { method: 'PUT', body });
  },

  delete(url) {
    return this.request(url, { method: 'DELETE' });
  },
};
