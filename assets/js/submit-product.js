document.addEventListener('DOMContentLoaded', () => {
  const form = document.getElementById('submit-form');
  const categorySelect = document.getElementById('category');
  const formWrap = document.getElementById('submit-form-wrap');
  const success = document.getElementById('submit-success');
  if (!form || !categorySelect) return;

  SUBMIT_CATEGORIES.forEach((cat) => {
    const opt = document.createElement('option');
    opt.value = cat;
    opt.textContent = cat;
    categorySelect.appendChild(opt);
  });

  const user = Auth.getUser();
  if (user && form.contact_email && !form.contact_email.value) {
    form.contact_email.value = user.email;
  }

  document.getElementById('submit-another')?.addEventListener('click', () => {
    form.reset();
    if (user) form.contact_email.value = user.email;
    success?.classList.add('hidden');
    formWrap?.classList.remove('hidden');
  });

  form.addEventListener('submit', (e) => {
    e.preventDefault();
    clearFormErrors(form);

    const data = {
      product_name: form.product_name.value.trim(),
      category: form.category.value,
      ingredients: form.ingredients.value.trim(),
      benefits: form.benefits.value.trim(),
      description: form.description.value.trim(),
      website: form.website.value.trim(),
      contact_email: form.contact_email.value.trim(),
    };

    let valid = true;
    if (!data.product_name) { showFieldError(form.product_name, 'Product name is required.'); valid = false; }
    if (!data.category) { showFieldError(form.category, 'Select a category.'); valid = false; }
    if (!data.ingredients) { showFieldError(form.ingredients, 'Ingredients are required.'); valid = false; }
    if (!data.benefits) { showFieldError(form.benefits, 'Benefits are required.'); valid = false; }
    if (!data.description) { showFieldError(form.description, 'Description is required.'); valid = false; }
    if (!validateEmail(data.contact_email)) { showFieldError(form.contact_email, 'Enter a valid email.'); valid = false; }
    if (data.website && !/^https?:\/\/.+/.test(data.website)) {
      showFieldError(form.website, 'Enter a valid URL starting with http:// or https://');
      valid = false;
    }
    if (!valid) return;

    const submissions = JSON.parse(localStorage.getItem('afrochick-submissions') || '[]');
    submissions.push({ ...data, id: Date.now(), status: 'pending', createdAt: new Date().toISOString() });
    localStorage.setItem('afrochick-submissions', JSON.stringify(submissions));

    formWrap?.classList.add('hidden');
    success?.classList.remove('hidden');
    if (typeof lucide !== 'undefined') lucide.createIcons();
  });
});
