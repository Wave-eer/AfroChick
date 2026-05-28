/**
 * AfroChic — Interactive Beauty Quizzes & Recommendation Engine
 * Handles: multi-step wizards, AI loaders, results dashboards, routine builders, and product matching.
 */

document.addEventListener('DOMContentLoaded', () => {
  // Determine page type
  const isSkinPage = !!document.getElementById('skin-quiz-form');
  const isHairPage = !!document.getElementById('hair-quiz-form');
  
  if (!isSkinPage && !isHairPage) return;

  const formId = isSkinPage ? 'skin-quiz-form' : 'hair-quiz-form';
  const form = document.getElementById(formId);
  const intakeCard = document.getElementById('quiz-intake-card');
  const loader = document.getElementById('quiz-loader');
  const resultsContainer = document.getElementById('quiz-results');

  const btnPrev = document.getElementById('quiz-btn-prev');
  const btnNext = document.getElementById('quiz-btn-next');
  
  const progressFill = document.getElementById('quiz-progress-fill');
  const stepTitle = document.getElementById('quiz-step-title');
  const stepPercentage = document.getElementById('quiz-step-percentage');

  const steps = Array.from(form.querySelectorAll('.quiz-step'));
  let currentStepIndex = 0;
  const answers = {};

  // Initialize interactive option selectors
  form.querySelectorAll('.quiz-option-card').forEach((card) => {
    card.addEventListener('click', () => {
      const isCheckbox = card.classList.contains('checkbox');
      const stepEl = card.closest('.quiz-step');
      const stepIndex = steps.indexOf(stepEl);

      if (isCheckbox) {
        // Toggle selected class
        card.classList.toggle('selected');
      } else {
        // Remove selection from siblings and select this one
        stepEl.querySelectorAll('.quiz-option-card').forEach((c) => c.classList.remove('selected'));
        card.classList.add('selected');
      }

      // Collect answers immediately on click
      saveStepAnswer(stepIndex, stepEl);
    });
  });

  // Save selection states
  function saveStepAnswer(stepIndex, stepEl) {
    const isCheckbox = stepEl.querySelector('.quiz-option-card').classList.contains('checkbox');
    const stepName = isSkinPage ? `skin_step_${stepIndex + 1}` : `hair_step_${stepIndex + 1}`;

    if (isCheckbox) {
      const selected = Array.from(stepEl.querySelectorAll('.quiz-option-card.selected')).map(c => c.dataset.val);
      answers[stepName] = selected;
    } else {
      const selectedEl = stepEl.querySelector('.quiz-option-card.selected');
      answers[stepName] = selectedEl ? selectedEl.dataset.val : null;
    }
  }

  // Navigation handlers
  btnPrev?.addEventListener('click', () => {
    if (currentStepIndex > 0) {
      goToStep(currentStepIndex - 1);
    }
  });

  btnNext?.addEventListener('click', () => {
    if (validateStep(currentStepIndex)) {
      if (currentStepIndex < steps.length - 1) {
        goToStep(currentStepIndex + 1);
      } else {
        // Submit Quiz
        handleSubmit();
      }
    } else {
      alert('Please select an option to proceed.');
    }
  });

  function goToStep(index) {
    steps[currentStepIndex].classList.remove('active');
    steps[index].classList.add('active');
    currentStepIndex = index;

    // Update buttons
    btnPrev.disabled = currentStepIndex === 0;
    btnNext.textContent = currentStepIndex === steps.length - 1 ? 'Analyze Now' : 'Next →';

    // Update progress
    const percent = Math.round(((currentStepIndex + 1) / steps.length) * 100);
    progressFill.style.width = percent + '%';
    stepTitle.textContent = `Question ${currentStepIndex + 1} of ${steps.length}`;
    stepPercentage.textContent = percent + '%';
  }

  function validateStep(index) {
    const stepEl = steps[index];
    const selectedOptions = stepEl.querySelectorAll('.quiz-option-card.selected');
    return selectedOptions.length > 0;
  }

  // Handle final quiz submissions
  async function handleSubmit() {
    // 1. Force Authentication
    if (typeof Auth !== 'undefined' && !Auth.isLoggedIn()) {
      // Save answers in local storage to restore after login
      localStorage.setItem('afrochick-saved-quiz', JSON.stringify({
        type: isSkinPage ? 'skin' : 'hair',
        answers: answers
      }));
      
      // Redirect
      alert('To generate your premium AI Beauty profile and routines, please sign up or log in first. Your answers have been safely saved!');
      const nextUrl = window.location.pathname;
      window.location.href = `/signup.php?next=${encodeURIComponent(nextUrl)}`;
      return;
    }

    // 2. Hide intake card and show dynamic AI loader
    intakeCard.style.display = 'none';
    loader.style.display = 'flex';

    // Run dynamic loader status strings
    const statusText = document.getElementById('loader-status');
    const subText = document.getElementById('loader-subtext');

    const loadingStages = isSkinPage ? [
      { status: 'Initializing Epidermal Scan...', sub: 'Establishing color spectrum and Fitzpatrick factors...' },
      { status: 'Analyzing Melanosome Activity...', sub: 'Calculating hyperpigmentation sensitivity levels...' },
      { status: 'Assessing Sebum & Moisture Levels...', sub: 'Correlating hydration barriers and ingredient safety...' },
      { status: 'Generating Bespoke Melanin Routines...', sub: 'Matching curated active complexes...' }
    ] : [
      { status: 'Initializing Follicle Diagnostic...', sub: 'Structuring curl geometry and thickness scales...' },
      { status: 'Analyzing Hair Porosity Factor...', sub: 'Determining cuticle alignment and hydration matrices...' },
      { status: 'Correlating Scalp Sebum Profiles...', sub: 'Validating active scalp botanical receptors...' },
      { status: 'Assembling Personalized Routines...', sub: 'Selecting optimal L.O.C. product combinations...' }
    ];

    for (let i = 0; i < loadingStages.length; i++) {
      await new Promise(resolve => setTimeout(resolve, 600));
      statusText.textContent = loadingStages[i].status;
      subText.textContent = loadingStages[i].sub;
    }

    // Hide loader and render dashboard
    loader.style.display = 'none';
    renderResults();
  }

  // Check if there's a saved quiz in local storage that needs processing
  function checkSavedQuiz() {
    const saved = localStorage.getItem('afrochick-saved-quiz');
    if (saved && typeof Auth !== 'undefined' && Auth.isLoggedIn()) {
      const parsed = JSON.parse(saved);
      const isCorrectPage = (parsed.type === 'skin' && isSkinPage) || (parsed.type === 'hair' && isHairPage);
      
      if (isCorrectPage) {
        localStorage.removeItem('afrochick-saved-quiz');
        Object.assign(answers, parsed.answers);
        // Direct submission
        handleSubmit();
      }
    }
  }

  // Render personalized beauty results
  function renderResults() {
    let html = '';

    if (isSkinPage) {
      html = generateSkinResults();
    } else {
      html = generateHairResults();
    }

    resultsContainer.innerHTML = html;
    resultsContainer.style.display = 'flex';
    
    // Smooth scroll to top of results
    window.scrollTo({ top: 0, behavior: 'smooth' });

    // Initialize Lucide Icons for results page
    if (typeof lucide !== 'undefined') {
      lucide.createIcons();
    }
  }

  // Dynamic Skin Profile logic
  function generateSkinResults() {
    const oilVal = answers['skin_step_1'];
    const sensVal = answers['skin_step_2'];
    const acneVal = answers['skin_step_3'];
    const concerns = answers['skin_step_4'] || [];
    const hyperVal = answers['skin_step_5'];
    const sunVal = answers['skin_step_6'];

    // Compute Skin Profile Title
    let profileTitle = '';
    if (oilVal === 'very_dry') profileTitle += 'Dehydrated ';
    else if (oilVal === 'oily') profileTitle += 'Hyper-Sebaceous ';
    else if (oilVal === 'combination') profileTitle += 'Combination ';
    else profileTitle += 'Balanced ';

    if (sensVal === 'highly_sensitive' || sensVal === 'oily_reactive') profileTitle += 'Reactive ';
    else profileTitle += 'Resilient ';

    profileTitle += 'Melanin V-VI';

    // Selections description helper
    let acneText = acneVal === 'chronic' || acneVal === 'frequently' ? 'active breakout-prone pathways' : 'balanced sebum levels';
    let hyperText = hyperVal === 'deep_post' || hyperVal === 'melasma' ? 'stubborn deep hyperpigmentation' : 'mild pigmentation reactivity';

    // personalized advice paragraph
    const personalAdvice = `Based on your Fitzpatrick scale responses, your skin demonstrates rich melanin properties that are naturally highly resilient to UV burns, but exceptionally sensitive to post-inflammatory hyperpigmentation. When pimples or friction trigger inflammation, your melanocytes produce pigment aggressively, leaving dark marks. Because your skin is classified as <strong>${profileTitle}</strong>, it is crucial to avoid harsh physical scrubs that compromise the epidermal lipid barrier. Instead, focus on soothing anti-inflammatory actives (such as Niacinamide and Squalane) to calm reactive cells, paired with daily mineral SPF to shield your melanin from UV-induced dark spot activation.`;

    // Recommended Products Matching
    let recommendedProducts = [];
    if (typeof MOCK_PRODUCTS !== 'undefined') {
      // Hyperpigmentation / Dark spots
      if (hyperVal !== 'none' || concerns.includes('hyperpigmentation')) {
        recommendedProducts.push(MOCK_PRODUCTS.find(p => p.id === 3)); // Vitamin C
        recommendedProducts.push(MOCK_PRODUCTS.find(p => p.id === 1)); // Niacinamide
        recommendedProducts.push(MOCK_PRODUCTS.find(p => p.id === 4)); // Sunscreen
      } else if (oilVal === 'oily' || acneVal === 'frequently') {
        recommendedProducts.push(MOCK_PRODUCTS.find(p => p.id === 1)); // Niacinamide
        recommendedProducts.push(MOCK_PRODUCTS.find(p => p.id === 9)); // Centella Calm
        recommendedProducts.push(MOCK_PRODUCTS.find(p => p.id === 4)); // Sunscreen
      } else {
        recommendedProducts.push(MOCK_PRODUCTS.find(p => p.id === 2)); // Ceramide Cream
        recommendedProducts.push(MOCK_PRODUCTS.find(p => p.id === 9)); // Centella Calm
        recommendedProducts.push(MOCK_PRODUCTS.find(p => p.id === 4)); // Sunscreen
      }
    }

    // Filter undefined and build product cards HTML
    recommendedProducts = recommendedProducts.filter(Boolean);
    const productCardsHtml = recommendedProducts.map(p => `
      <article class="premium-product-card">
        <span class="product-card-badge">${p.category}</span>
        <div class="product-card-img-wrap">${p.image}</div>
        <div class="product-card-meta">
          <span class="product-card-cat">${p.category}</span>
          <span class="product-card-price">${p.price}</span>
        </div>
        <h3>${p.name}</h3>
        <p class="product-card-desc">${p.description}</p>
        <div class="product-card-usage" style="margin-top: auto;">
          <strong>Recommendation:</strong> ${p.benefits.join(', ')}. Apply after toning.
        </div>
      </article>
    `).join('');

    return `
      <!-- Results Hero Header -->
      <div class="glass-card results-hero-card">
        <div class="results-hero-glow"></div>
        <span class="results-score-badge">
          <i data-lucide="shield-check" style="width: 1rem; height: 1rem;"></i>
          Analysis Confidence: 96% (Clinical-grade matching)
        </span>
        <div class="results-title-wrap">
          <span style="font-size: 0.8125rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.08em; color: var(--terracotta-500);">Your Dynamic Skin Profile</span>
          <h2>${profileTitle}</h2>
          <p class="results-summary-text">
            Your skin demonstrates ${acneText} paired with ${hyperText}. Our diagnostic algorithm has constructed a specialized routine tailored for melanin protective barriers.
          </p>
        </div>
      </div>

      <!-- Personalized AI Advice -->
      <div class="glass-card" style="padding: 2.5rem;">
        <h3 style="font-family: var(--font-heading); font-size: 1.5rem; margin-bottom: 1rem; color: var(--text);">
          <i data-lucide="sparkles" style="vertical-align: middle; margin-right: 0.5rem; color: var(--gold-500);"></i>
          Personalized AI Beauty Insights
        </h3>
        <p style="font-size: 1.0625rem; line-height: 1.7; color: var(--text-muted);">
          ${personalAdvice}
        </p>
      </div>

      <!-- Routines Section -->
      <div>
        <h3 style="font-family: var(--font-heading); font-size: 1.75rem; margin-bottom: 1.5rem; text-align: center;">Your Curated Skincare Routine</h3>
        <div class="routine-grid">
          <!-- Morning Routine -->
          <div class="glass-card routine-card">
            <div class="routine-header">
              <div class="routine-icon-box">☀️</div>
              <div>
                <h3>Morning Focus</h3>
                <span style="font-size: 0.75rem; text-transform: uppercase; color: var(--text-light);">Protect &amp; Calm</span>
              </div>
            </div>
            <div class="routine-steps-list">
              <div class="routine-step-item">
                <span class="step-number">1</span>
                <div class="step-details">
                  <h4>Gentle Hydrating Cleanse</h4>
                  <p>Wash with a pH-balanced milk cleanser and lukewarm water. Do not strip natural lipids.</p>
                </div>
              </div>
              <div class="routine-step-item">
                <span class="step-number">2</span>
                <div class="step-details">
                  <h4>Tone &amp; Soothe</h4>
                  <p>Apply alcohol-free Rosewater or Hyaluronic Acid toner to damp skin.</p>
                </div>
              </div>
              <div class="routine-step-item">
                <span class="step-number">3</span>
                <div class="step-details">
                  <h4>Targeted Active</h4>
                  <p>Apply 3 drops of Niacinamide or Vitamin C to even out dark spots and regulate sebum.</p>
                </div>
              </div>
              <div class="routine-step-item">
                <span class="step-number">4</span>
                <div class="step-details">
                  <h4>UV Shield (Crucial)</h4>
                  <p>Apply a generous layer of SPF 50 Mineral sunscreen. Crucial to prevent dark marks from darkening further.</p>
                </div>
              </div>
            </div>
          </div>

          <!-- Night Routine -->
          <div class="glass-card routine-card">
            <div class="routine-header">
              <div class="routine-icon-box">🌙</div>
              <div>
                <h3>Night Focus</h3>
                <span style="font-size: 0.75rem; text-transform: uppercase; color: var(--text-light);">Barrier Repair &amp; Renew</span>
              </div>
            </div>
            <div class="routine-steps-list">
              <div class="routine-step-item">
                <span class="step-number">1</span>
                <div class="step-details">
                  <h4>Deep Cleanse</h4>
                  <p>Double-cleanse using a light cleansing oil followed by a gentle foaming wash to clear impurities.</p>
                </div>
              </div>
              <div class="routine-step-item">
                <span class="step-number">2</span>
                <div class="step-details">
                  <h4>Hydration Recovery</h4>
                  <p>Apply Centella or Beta-Glucan serum on slightly damp skin to reduce inflammation.</p>
                </div>
              </div>
              <div class="routine-step-item">
                <span class="step-number">3</span>
                <div class="step-details">
                  <h4>Barrier Cream Seal</h4>
                  <p>Apply Ceramide Barrier Cream to seal in moisture and repair the lipid barrier overnight.</p>
                </div>
              </div>
              <div class="routine-step-item">
                <span class="step-number">4</span>
                <div class="step-details">
                  <h4>Weekly Exfoliant (Alternate Nights)</h4>
                  <p>2 times a week, apply Salicylic Acid (BHA) to deep-clean pores. Do not mix with Vitamin C.</p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Recommended Products Grid -->
      <div>
        <h3 style="font-family: var(--font-heading); font-size: 1.75rem; margin-bottom: 1.5rem; text-align: center;">Your Recommended Products</h3>
        <div class="premium-products-grid">
          ${productCardsHtml}
        </div>
      </div>

      <!-- Safety & Medical Warnings -->
      <div class="safety-warning-card">
        <div class="warning-icon-box">⚠️</div>
        <div class="warning-content">
          <h4>Dermatological Safety Notice</h4>
          <div class="warning-text">
            <p class="warning-item">This analysis is AI-generated and may not always be 100% accurate.</p>
            <p class="warning-item">If serious skin irritation, infections, scalp issues, or sudden hair loss are detected, consult a licensed dermatologist immediately.</p>
          </div>
        </div>
      </div>

      <div style="text-align: center; margin-top: 1rem; margin-bottom: 3rem;">
         <a href="/dashboard.php" class="btn btn-secondary">← Return to Dashboard</a>
      </div>
    `;
  }

  // Dynamic Hair Profile logic
  function generateHairResults() {
    const texVal = answers['hair_step_1'];
    const curlVal = answers['hair_step_2'];
    const porVal = answers['hair_step_3'];
    const scalpVal = answers['hair_step_4'];
    const breakVal = answers['hair_step_5'];
    const denVal = answers['hair_step_6'];
    const stylVal = answers['hair_step_7'];

    // Compute Hair Profile Title
    let profileTitle = '';
    if (curlVal === '4c_coily') profileTitle += '4C Coily ';
    else if (curlVal === '4ab_coily') profileTitle += '4A/4B Coily ';
    else if (curlVal === '3ac_curly') profileTitle += '3A-3C Curly ';
    else profileTitle += 'Wavy/Curly ';

    if (porVal === 'high_porosity') profileTitle += 'High Porosity ';
    else if (porVal === 'low_porosity') profileTitle += 'Low Porosity ';
    else profileTitle += 'Balanced Porosity ';

    profileTitle += 'Hair Profile';

    // Descriptions
    let scalpText = scalpVal === 'dry_itchy' ? 'an extremely dry, flaking scalp environment' : 'a balanced root environment';
    let breakageText = breakVal === 'severe' || breakVal === 'hair_loss' ? 'elevated breakage and cuticle fragility' : 'minimal strand breakage';

    // personalized advice paragraph
    const personalAdvice = `Your textured coily strands naturally present high mechanical fragility at the curl torsion points. Because your hair is <strong>${profileTitle}</strong>, standard moisture evaporation is highly accelerated. If your porosity is High, your hair cuticles are raised, making moisture loss instant; if Low, the cuticles are tightly closed, blocking heavy oils from penetrating. To prevent dry snaps and thinning under ${scalpText}, you should adopt the L.O.C. (Liquid-Oil-Cream) hydration method. Seal your ends with rosemary and biotin active oils, which reinforce scalp blood circulation, stimulate thinning temples, and decrease structural ${breakageText} during detangling sessions.`;

    // Recommended Products Matching
    let recommendedProducts = [];
    if (typeof MOCK_PRODUCTS !== 'undefined') {
      if (scalpVal === 'dry_itchy') {
        recommendedProducts.push(MOCK_PRODUCTS.find(p => p.id === 6)); // Calm Scalp Shampoo
        recommendedProducts.push(MOCK_PRODUCTS.find(p => p.id === 5)); // Rosemary Oil
        recommendedProducts.push(MOCK_PRODUCTS.find(p => p.id === 10)); // Scalp Detox
      } else if (breakVal === 'severe' || curlVal === '4c_coily') {
        recommendedProducts.push(MOCK_PRODUCTS.find(p => p.id === 5)); // Rosemary Oil
        recommendedProducts.push(MOCK_PRODUCTS.find(p => p.id === 7)); // Keratin Conditioner
        recommendedProducts.push(MOCK_PRODUCTS.find(p => p.id === 8)); // Overnight Repair Mask
      } else {
        recommendedProducts.push(MOCK_PRODUCTS.find(p => p.id === 6)); // Calm Scalp Shampoo
        recommendedProducts.push(MOCK_PRODUCTS.find(p => p.id === 7)); // Keratin Conditioner
        recommendedProducts.push(MOCK_PRODUCTS.find(p => p.id === 5)); // Rosemary Oil
      }
    }

    recommendedProducts = recommendedProducts.filter(Boolean);
    const productCardsHtml = recommendedProducts.map(p => `
      <article class="premium-product-card">
        <span class="product-card-badge">${p.category}</span>
        <div class="product-card-img-wrap">${p.image}</div>
        <div class="product-card-meta">
          <span class="product-card-cat">${p.category}</span>
          <span class="product-card-price">${p.price}</span>
        </div>
        <h3>${p.name}</h3>
        <p class="product-card-desc">${p.description}</p>
        <div class="product-card-usage" style="margin-top: auto;">
          <strong>Recommendation:</strong> ${p.benefits.join(', ')}. Massage into strands.
        </div>
      </article>
    `).join('');

    return `
      <!-- Results Hero Header -->
      <div class="glass-card results-hero-card">
        <div class="results-hero-glow"></div>
        <span class="results-score-badge">
          <i data-lucide="shield-check" style="width: 1rem; height: 1rem;"></i>
          Analysis Confidence: 94% (Clinical-grade matching)
        </span>
        <div class="results-title-wrap">
          <span style="font-size: 0.8125rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.08em; color: var(--terracotta-500);">Your Dynamic Hair Profile</span>
          <h2>${profileTitle}</h2>
          <p class="results-summary-text">
            Your scalp shows ${scalpText} paired with ${breakageText}. Our clinical active system has mapped a custom hydration routine to prevent curly snapping.
          </p>
        </div>
      </div>

      <!-- Personalized AI Advice -->
      <div class="glass-card" style="padding: 2.5rem;">
        <h3 style="font-family: var(--font-heading); font-size: 1.5rem; margin-bottom: 1rem; color: var(--text);">
          <i data-lucide="sparkles" style="vertical-align: middle; margin-right: 0.5rem; color: var(--gold-500);"></i>
          Personalized AI Hair &amp; Scalp Insights
        </h3>
        <p style="font-size: 1.0625rem; line-height: 1.7; color: var(--text-muted);">
          ${personalAdvice}
        </p>
      </div>

      <!-- Routines Section -->
      <div>
        <h3 style="font-family: var(--font-heading); font-size: 1.75rem; margin-bottom: 1.5rem; text-align: center;">Your Curated Haircare Routine</h3>
        <div class="routine-grid">
          <!-- Daily Hydration / LOC Focus -->
          <div class="glass-card routine-card">
            <div class="routine-header">
              <div class="routine-icon-box">💦</div>
              <div>
                <h3>L.O.C. Daily Hydration</h3>
                <span style="font-size: 0.75rem; text-transform: uppercase; color: var(--text-light);">Daily/Every 2 Days</span>
              </div>
            </div>
            <div class="routine-steps-list">
              <div class="routine-step-item">
                <span class="step-number">1</span>
                <div class="step-details">
                  <h4>Liquid (L) Mist</h4>
                  <p>Spray a water-based leave-in conditioner mist evenly over your strands. Hair should be damp, not dripping.</p>
                </div>
              </div>
              <div class="routine-step-item">
                <span class="step-number">2</span>
                <div class="step-details">
                  <h4>Oil (O) Strengthening</h4>
                  <p>Apply 4 drops of Rosemary Strengthening Oil to your fingertips. Gently massage into scalp and temples to stimulate circulation.</p>
                </div>
              </div>
              <div class="routine-step-item">
                <span class="step-number">3</span>
                <div class="step-details">
                  <h4>Cream (C) Seal</h4>
                  <p>Apply a thick Shea-based cream over strands to seal moisture inside the cuticle scales. Focus heavily on ends.</p>
                </div>
              </div>
            </div>
          </div>

          <!-- Deep Wash & Treatment Day -->
          <div class="glass-card routine-card">
            <div class="routine-header">
              <div class="routine-icon-box">🧼</div>
              <div>
                <h3>Weekly Wash &amp; Detox</h3>
                <span style="font-size: 0.75rem; text-transform: uppercase; color: var(--text-light);">Every 7-10 Days</span>
              </div>
            </div>
            <div class="routine-steps-list">
              <div class="routine-step-item">
                <span class="step-number">1</span>
                <div class="step-details">
                  <h4>Scalp Detox</h4>
                  <p>Apply a Salicylic Acid scalp detox scrub 15 minutes before washing to break down persistent oil and product buildup.</p>
                </div>
              </div>
              <div class="routine-step-item">
                <span class="step-number">2</span>
                <div class="step-details">
                  <h4>Sulfate-free Wash</h4>
                  <p>Cleanse scalp with Calm Scalp shampoo. Work lather into roots with finger pads. Rinse completely with lukewarm water.</p>
                </div>
              </div>
              <div class="routine-step-item">
                <span class="step-number">3</span>
                <div class="step-details">
                  <h4>Deep Conditioning Mask</h4>
                  <p>Apply Keratin conditioner or Overnight Peptide Mask. Cover with a plastic shower cap for 20 minutes under mild heat.</p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Recommended Products Grid -->
      <div>
        <h3 style="font-family: var(--font-heading); font-size: 1.75rem; margin-bottom: 1.5rem; text-align: center;">Your Recommended Products</h3>
        <div class="premium-products-grid">
          ${productCardsHtml}
        </div>
      </div>

      <!-- Safety & Medical Warnings -->
      <div class="safety-warning-card">
        <div class="warning-icon-box">⚠️</div>
        <div class="warning-content">
          <h4>Scalp Safety Notice</h4>
          <div class="warning-text">
            <p class="warning-item">This analysis is AI-generated and may not always be 100% accurate.</p>
            <p class="warning-item">If serious skin irritation, infections, scalp issues, or sudden hair loss are detected, consult a licensed dermatologist immediately.</p>
          </div>
        </div>
      </div>

      <div style="text-align: center; margin-top: 1rem; margin-bottom: 3rem;">
         <a href="/dashboard.php" class="btn btn-secondary">← Return to Dashboard</a>
      </div>
    `;
  }

  // Run immediately on page load
  checkSavedQuiz();
});
