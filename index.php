<?php
$pageTitle = 'Melanin Beauty & Textured Hair Analysis';
$pageDescription = 'Science-informed skin & hair analysis tailored specifically for melanin-rich skin and textured hair.';
$currentPage = 'home';
$bodyClass = 'page-home';
$showFloatingCta = false; // Removed Start Analysis floating button from landing page
require_once __DIR__ . '/includes/header.php';
?>

<!-- Hero Section -->
<section class="hero" id="hero">
    <div class="hero-bg">
        <div class="hero-gradient"></div>
        <div class="hero-orbs">
            <span class="orb orb-1"></span>
            <span class="orb orb-2"></span>
            <span class="orb orb-3"></span>
        </div>
    </div>

    <div class="container hero-content" style="text-align: left; display: grid; grid-template-columns: 1.2fr 0.8fr; gap: 4rem; align-items: center; padding-block: 6rem 8rem;">
        <div class="hero-text-side">
            <div class="hero-badge reveal">
                <i data-lucide="sparkles"></i>
                AI Beauty Science, Made for Melanin
            </div>

            <h1 class="hero-title reveal reveal-delay-1" style="margin-inline: 0; max-width: 100%; font-size: clamp(2.75rem, 5vw, 4.5rem); line-height: 1.05;">
                Clarity for your <em>skin</em> and <em>hair</em>
            </h1>

            <p class="hero-subtitle reveal reveal-delay-2" style="margin-inline: 0; max-width: 38rem; margin-bottom: 2.5rem; font-size: 1.125rem;">
                AfroChic provides clinical-grade analysis tailored for melanin-rich skin types and coily, curly, or wavy textured hair. Understand what your cells actually need.
            </p>

            <div class="hero-cta reveal reveal-delay-3" style="justify-content: flex-start; gap: 1rem;">
                <a href="/products.php" class="btn btn-primary btn-lg">
                    <i data-lucide="shopping-bag"></i>
                    Explore Products
                </a>
                <a href="/signup.php" class="btn btn-secondary btn-lg">Join AfroChic</a>
                <a href="/login.php" class="btn btn-ghost btn-lg">Sign In</a>
            </div>
        </div>

        <!-- Premium Luxury Abstract Vector Illustration of an Afro Woman -->
        <div class="hero-visual-side reveal reveal-delay-2" style="position: relative; display: flex; align-items: center; justify-content: center; height: 100%;">
            <div class="visual-glow-background" style="position: absolute; width: 300px; height: 300px; background: radial-gradient(circle, var(--gold-400) 0%, transparent 70%); opacity: 0.35; filter: blur(30px); animation: pulseInfinite 4s infinite ease-in-out;"></div>
            <div class="glass-card" style="padding: 2rem; border-radius: var(--radius-xl); border-color: rgba(212, 175, 55, 0.25); background: linear-gradient(135deg, rgba(253, 251, 247, 0.8), rgba(246, 230, 223, 0.45)); box-shadow: var(--glass-shadow); position: relative; z-index: 2; width: 100%; aspect-ratio: 0.95; display: flex; align-items: center; justify-content: center;">
                <svg width="100%" height="100%" viewBox="0 0 200 200" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <!-- Abstract background elements -->
                  <circle cx="100" cy="100" r="75" stroke="var(--gold-400)" stroke-width="1.5" stroke-dasharray="4 4" opacity="0.6"/>
                  <circle cx="100" cy="100" r="60" stroke="var(--terracotta-400)" stroke-width="0.75" opacity="0.4"/>
                  <!-- Organic abstract leaf shapes representing natural botanical beauty -->
                  <path d="M40 70C40 70 55 55 70 60C70 60 65 80 50 85C35 90 40 70 40 70Z" fill="var(--terracotta-200)" opacity="0.3"/>
                  <path d="M160 130C160 130 145 145 130 140C130 140 135 120 150 115C165 110 160 130 160 130Z" fill="var(--gold-400)" opacity="0.25"/>
                  
                  <!-- Majestic Curly Afro Silhouette (Melanin Queen) -->
                  <defs>
                    <linearGradient id="queenGold" x1="40" y1="40" x2="160" y2="160" gradientUnits="userSpaceOnUse">
                      <stop offset="0%" stop-color="#cca43b" />
                      <stop offset="35%" stop-color="#b55331" />
                      <stop offset="70%" stop-color="#e5c185" />
                      <stop offset="100%" stop-color="#2c1810" />
                    </linearGradient>
                    <linearGradient id="queenFace" x1="70" y1="70" x2="130" y2="130" gradientUnits="userSpaceOnUse">
                      <stop offset="0%" stop-color="#b55331" />
                      <stop offset="100%" stop-color="#4a2c1f" />
                    </linearGradient>
                  </defs>
                  
                  <!-- Hair outline curves (Curls & Texture) -->
                  <path d="M100 25C58.58 25 25 58.58 25 100C25 116.89 30.6 132.48 40.06 145C37.17 151 37.9 158.28 42.92 163.3C48.74 169.12 57.78 169.84 64.39 165.5C74.75 172.77 87.21 177 100.2 177C114.86 177 128.36 171.88 139.2 163.3C145.32 166.55 153.22 165.73 158.56 160.39C163.9 155.05 164.72 147.15 161.47 141.03C171.16 129.89 177 115.44 177 100C177 58.58 141.42 25 100 25Z" fill="url(#queenGold)" opacity="0.95"/>
                  <path d="M100 37C65.21 37 37 65.21 37 100C37 113.88 41.5 126.71 49.12 137.05C47.88 142.34 49.33 148.15 53.52 152.34C57.71 156.53 63.52 157.98 68.81 156.74C77.44 162.7 87.97 166.2 100 166.2C111.45 166.2 122.06 162.13 130.43 155.33C135.25 157.9 141.45 157.26 145.66 153.05C149.87 148.84 150.51 142.64 147.94 137.82C155.53 129.07 160.1 117.79 160.1 100C160.1 65.21 134.79 37 100 37Z" fill="#24150f" />
                  
                  <!-- Slender elegant face outline in terracotta/gold -->
                  <path d="M96 70C96 70 105 70 109 77C113 84 108 93 108 93C108 93 117 95 119 102C121 109 113 113 110 116C107 119 109 124 114 126C119 128 117 136 109 139C101 142 89 141 84 129C80 119.4 83 107 88 96" stroke="url(#queenFace)" stroke-width="4.5" stroke-linecap="round" stroke-linejoin="round" />
                  <path d="M96 70C96 70 105 70 109 77C113 84 108 93 108 93C108 93 117 95 119 102C121 109 113 113 110 116C107 119 109 124 114 126C119 128 117 136 109 139C101 142 89 141 84 129C80 119.4 83 107 88 96" stroke="var(--gold-500)" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" opacity="0.8"/>
                </svg>
            </div>
        </div>
    </div>
</section>

<!-- About Section -->
<section class="section about" id="about">
    <div class="container">
        <div class="section-header reveal">
            <span class="section-label">About Afrochick</span>
            <h2 class="section-title">Designed for melanin and textures.</h2>
            <p class="section-desc">
                AfroChic is an AI-powered beauty analysis platform designed to help users understand their skin and hair better through personalized recommendations, routines, and smart beauty insights tailored for melanin-rich skin and textured hair.
            </p>
        </div>

        <div class="about-grid">
            <div class="about-visual reveal reveal-delay-1">
                <div class="glass-card about-card">
                    <div class="about-icons">
                        <span class="about-icon">🧪</span>
                        <span class="about-icon">✨</span>
                        <span class="about-icon">💆</span>
                        <span class="about-icon">🧴</span>
                    </div>
                    <div class="about-glow"></div>
                </div>
            </div>

            <ul class="about-features reveal reveal-delay-2">
                <li>
                    <div class="feature-icon"><i data-lucide="user-check"></i></div>
                    <div>
                        <strong>Personalized to your skin &amp; hair type</strong>
                        <p>Tailored recommendations based on your unique profile and concerns.</p>
                    </div>
                </li>
                <li>
                    <div class="feature-icon"><i data-lucide="flask-conical"></i></div>
                    <div>
                        <strong>Ingredient-first, not brand-driven</strong>
                        <p>Science-backed actives that address your specific needs.</p>
                    </div>
                </li>
                <li>
                    <div class="feature-icon"><i data-lucide="stethoscope"></i></div>
                    <div>
                        <strong>Reviewed by dermatology consultants</strong>
                        <p>Guidance shaped by clinical expertise and best practices.</p>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</section>

<!-- Why Choose Section -->
<section class="section why-choose" id="why">
    <div class="container">
        <div class="section-header center reveal">
            <span class="section-label">Why choose Afrochick</span>
            <h2 class="section-title">Built for real skin and real hair.</h2>
        </div>

        <div class="features-grid">
            <div class="glass-card feature-card reveal reveal-delay-1">
                <div class="feature-card-icon"><i data-lucide="clipboard-list"></i></div>
                <h3>Clinical analysis</h3>
                <p>A multi-step wizard mirrors a dermatology intake.</p>
            </div>
            <div class="glass-card feature-card reveal reveal-delay-2">
                <div class="feature-card-icon"><i data-lucide="atom"></i></div>
                <h3>Ingredient logic</h3>
                <p>Recommendations grounded in actives that work.</p>
            </div>
            <div class="glass-card feature-card reveal reveal-delay-3">
                <div class="feature-card-icon"><i data-lucide="shield"></i></div>
                <h3>Safety first</h3>
                <p>Sensitivity-aware suggestions and clear warnings.</p>
            </div>
            <div class="glass-card feature-card reveal reveal-delay-4">
                <div class="feature-card-icon"><i data-lucide="heart"></i></div>
                <h3>Made to feel good</h3>
                <p>A calm, beautiful experience end to end.</p>
            </div>
        </div>
    </div>
</section>

<!-- AI Beauty Insights Section -->
<section class="section insights-section" id="insights" style="background: var(--bg-secondary);">
    <div class="container">
        <div class="section-header center reveal">
            <span class="section-label">Smart Science</span>
            <h2 class="section-title">AI Beauty Insights</h2>
            <p class="section-desc">
                Understanding the unique biology of melanin-rich skin and textured hair to deliver targeted active ingredients that actually work.
            </p>
        </div>

        <div class="insights-grid reveal reveal-delay-1">
            <div class="glass-card insight-card">
                <div class="insight-icon">☀️</div>
                <h4>Melanin &amp; Sun Care</h4>
                <p>Higher melanin levels provide natural protection but do not block UV rays. Daily broad-spectrum mineral SPF is essential to prevent hyperpigmentation and sun spots.</p>
            </div>
            <div class="glass-card insight-card">
                <div class="insight-icon">🌀</div>
                <h4>Textured Hair Porosity</h4>
                <p>Coily (4C/4A) curl structures naturally have raised cuticles, making moisture absorption easy but retention challenging. L.O.C. (Liquid, Oil, Cream) methods are ideal.</p>
            </div>
            <div class="glass-card insight-card">
                <div class="insight-icon">🧬</div>
                <h4>Hyperpigmentation</h4>
                <p>Melanocytes in deeper skin tones are highly active. To soothe inflammation and even out tone, favor gentle inhibitors like Niacinamide, Squalane, and Centella.</p>
            </div>
        </div>
    </div>
</section>

<!-- Featured Products Section -->
<section class="section products-section" id="featured-products">
    <div class="container">
        <div class="section-header center reveal">
            <span class="section-label">Curated Collection</span>
            <h2 class="section-title">Featured Recommended Products</h2>
            <p class="section-desc">
                Clinical-grade formulas approved by our dermatology consultants to support your daily routine.
            </p>
        </div>

        <div class="premium-products-grid reveal reveal-delay-1">
            <!-- Product 1 -->
            <article class="premium-product-card">
                <span class="product-card-badge">Top Seller</span>
                <div class="product-card-img-wrap">🧴</div>
                <div class="product-card-meta">
                    <span class="product-card-cat">Serums</span>
                    <span class="product-card-price">$42</span>
                </div>
                <h3>Sage Glow Niacinamide Serum</h3>
                <p class="product-card-desc">A lightweight serum formulated to regulate sebum production, minimize pores, and boost tone clarity for oily and combination skin.</p>
                <div class="product-card-usage">
                    <strong>Usage:</strong> Apply 3-4 drops morning and night after cleansing.
                </div>
            </article>

            <!-- Product 2 -->
            <article class="premium-product-card">
                <span class="product-card-badge">Best for Curls</span>
                <div class="product-card-img-wrap">🌿</div>
                <div class="product-card-meta">
                    <span class="product-card-cat">Hair Oils</span>
                    <span class="product-card-price">$29</span>
                </div>
                <h3>Rosemary Root Strengthening Oil</h3>
                <p class="product-card-desc">An intensive hair and scalp oil designed to stimulate roots, strengthen hair follicles, and reduce breakage in protective styles.</p>
                <div class="product-card-usage">
                    <strong>Usage:</strong> Massage gently into the scalp 3 times a week.
                </div>
            </article>

            <!-- Product 3 -->
            <article class="premium-product-card">
                <span class="product-card-badge">Barrier Care</span>
                <div class="product-card-img-wrap">💧</div>
                <div class="product-card-meta">
                    <span class="product-card-cat">Moisturizers</span>
                    <span class="product-card-price">$38</span>
                </div>
                <h3>Ceramide Barrier Cream</h3>
                <p class="product-card-desc">A rich yet breathable moisturizer formulated with ceramides and squalane to lock in hydration and repair dry or reactive skin barriers.</p>
                <div class="product-card-usage">
                    <strong>Usage:</strong> Apply as the final step in your night routine.
                </div>
            </article>
        </div>
    </div>
</section>

<!-- Daily Routine Tracker & Before/After Planner Section -->
<section class="section tracker-planner-section" id="routine-planner" style="background: var(--bg-secondary); overflow: hidden;">
    <div class="container">
        <div class="section-header center reveal">
            <span class="section-label">Progress Tracking</span>
            <h2 class="section-title">Consistency in Motion</h2>
            <p class="section-desc">
                Consistent habits unlock lasting results. Use our digital routine tracking system alongside your personalized AI routines.
            </p>
        </div>

        <div style="display: grid; grid-template-columns: 0.9fr 1.1fr; gap: 3rem; align-items: stretch; margin-top: 2rem;">
            <!-- Daily Routine Tracker Widget -->
            <div class="glass-card routine-tracker-widget reveal reveal-delay-1" style="display: flex; flex-direction: column; justify-content: center;">
                <div class="tracker-header">
                    <span class="tracker-streak">🔥 5 Day Streak</span>
                    <span class="tracker-streak-label">You're doing amazing!</span>
                </div>
                <div class="tracker-days">
                    <div class="tracker-day active">
                        <span class="day-circle"><i data-lucide="check" style="width: 1rem; height: 1rem;"></i></span>
                        <span class="day-label">Mon</span>
                    </div>
                    <div class="tracker-day active">
                        <span class="day-circle"><i data-lucide="check" style="width: 1rem; height: 1rem;"></i></span>
                        <span class="day-label">Tue</span>
                    </div>
                    <div class="tracker-day active">
                        <span class="day-circle"><i data-lucide="check" style="width: 1rem; height: 1rem;"></i></span>
                        <span class="day-label">Wed</span>
                    </div>
                    <div class="tracker-day active">
                        <span class="day-circle"><i data-lucide="check" style="width: 1rem; height: 1rem;"></i></span>
                        <span class="day-label">Thu</span>
                    </div>
                    <div class="tracker-day active">
                        <span class="day-circle"><i data-lucide="check" style="width: 1rem; height: 1rem;"></i></span>
                        <span class="day-label">Fri</span>
                    </div>
                    <div class="tracker-day">
                        <span class="day-circle">Sat</span>
                        <span class="day-label">Sat</span>
                    </div>
                    <div class="tracker-day">
                        <span class="day-circle">Sun</span>
                        <span class="day-label">Sun</span>
                    </div>
                </div>
                <p style="font-size: 0.875rem; color: var(--text-muted); line-height: 1.5;">
                    Track morning skincare steps and night hair hydration streaks to establish a perfect cellular cycle.
                </p>
            </div>

            <!-- Interactive Before & After Planner -->
            <div class="glass-card interactive-comparison reveal reveal-delay-2" style="padding: 2.25rem;">
                <div class="comparison-details">
                    <h3>Before &amp; After Glow</h3>
                    <p>Slide to reveal the real visual change in skin texture and melanin radiance after 4 weeks on the Ceramide Barrier and Niacinamide Routine.</p>
                </div>
                <div class="comparison-visual-card" id="comparison-slider-container" style="cursor: ew-resize; user-select: none;">
                    <!-- Before Image Visual (Gradient representing uneven skin/dullness) -->
                    <div style="width: 100%; height: 100%; background: linear-gradient(135deg, #422f25 0%, #a67c63 100%); display: flex; align-items: center; justify-content: center; color: rgba(255,255,255,0.7); font-weight: 600; font-size: 1.125rem;">
                        <span style="position: absolute; left: 1rem; bottom: 1rem; background: rgba(0,0,0,0.5); padding: 0.25rem 0.5rem; border-radius: var(--radius-sm); font-size: 0.75rem; letter-spacing: 0.05em; text-transform: uppercase;">Week 0</span>
                    </div>
                    <!-- After Image Visual (Gradient representing uniform glowing radiant skin) -->
                    <div class="comparison-overlay-after" id="comparison-after-box" style="left: 50%; width: 50%; border-left: 2px solid var(--gold-500); background: linear-gradient(135deg, #cca43b 0%, #ebbfae 100%); display: flex; align-items: center; justify-content: center;">
                        <div style="position: absolute; right: 0; width: 200%; height: 100%; background: linear-gradient(135deg, #cca43b 0%, #ebbfae 100%); display: flex; align-items: center; justify-content: center; color: #2c1810; font-weight: 600; font-size: 1.125rem;">
                            <span style="position: absolute; right: 1rem; bottom: 1rem; background: var(--gold-500); color: var(--coffee-700); padding: 0.25rem 0.5rem; border-radius: var(--radius-sm); font-size: 0.75rem; letter-spacing: 0.05em; text-transform: uppercase;">Week 4 Glow</span>
                        </div>
                    </div>
                    <!-- Slider Handle -->
                    <div class="comparison-slider-handle" id="comparison-handle" style="left: 50%;">
                        <div class="slider-handle-dot">↔</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Curated Beauty Tips Section -->
<section class="section beauty-tips-section" id="tips">
    <div class="container">
        <div class="section-header center reveal">
            <span class="section-label">Expert Wisdom</span>
            <h2 class="section-title">Earthy Beauty Tips</h2>
            <p class="section-desc">
                Quick, effective beauty secrets curated by specialists for daily melanin and curl maintenance.
            </p>
        </div>

        <div class="beauty-tips-slider reveal reveal-delay-1">
            <div class="glass-card beauty-tip-card">
                <span class="beauty-tip-category">Haircare</span>
                <h3>Damp Scalp Hydration</h3>
                <p>Never apply dense oils or butters directly onto a bone-dry scalp. Lightly mist your roots with water first, then apply oil to seal in structural moisture.</p>
            </div>
            <div class="glass-card beauty-tip-card">
                <span class="beauty-tip-category">Skincare</span>
                <h3>Soothe Hyperpigmentation</h3>
                <p>Physical scrubs cause micro-tears that trigger reactive melanin production. Always choose liquid exfoliants (like Salicylic Acid or Lactic Acid) to gently renew skin.</p>
            </div>
            <div class="glass-card beauty-tip-card">
                <span class="beauty-tip-category">Curly Care</span>
                <h3>Protecting Your Curls</h3>
                <p>Ensure you sleep on a silk or satin pillowcase, or wear a satin bonnet. Cotton absorbs sebum, dry-straining coily hair cuticles and causing breakage.</p>
            </div>
        </div>
    </div>
</section>

<script>
document.addEventListener('DOMContentLoaded', () => {
    // Before & After Interactive Slider Script
    const container = document.getElementById('comparison-slider-container');
    const afterBox = document.getElementById('comparison-after-box');
    const handle = document.getElementById('comparison-handle');
    
    if (container && afterBox && handle) {
        const updateSlider = (clientX) => {
            const rect = container.getBoundingClientRect();
            const posX = Math.max(0, Math.min(clientX - rect.left, rect.width));
            const percentage = (posX / rect.width) * 100;
            
            handle.style.left = percentage + '%';
            afterBox.style.left = percentage + '%';
            afterBox.style.width = (100 - percentage) + '%';
        };

        container.addEventListener('mousemove', (e) => {
            updateSlider(e.clientX);
        });

        container.addEventListener('touchmove', (e) => {
            if (e.touches && e.touches[0]) {
                updateSlider(e.touches[0].clientX);
            }
        });
    }
});
</script>

<!-- Testimonials Section -->
<section class="section testimonials" id="testimonials">
    <div class="container">
        <div class="section-header center reveal">
            <span class="section-label">Loved by careful skincare people</span>
            <h2 class="section-title">Real stories, real glow.</h2>
        </div>

        <div class="testimonials-grid">
            <blockquote class="glass-card testimonial-card reveal reveal-delay-1">
                <div class="testimonial-stars">★★★★★</div>
                <p>"Afrochick's analysis nailed my skin concerns. My routine finally makes sense."</p>
                <footer>
                    <strong>Amara K.</strong>
                    <span>Skincare enthusiast</span>
                </footer>
            </blockquote>
            <blockquote class="glass-card testimonial-card reveal reveal-delay-2">
                <div class="testimonial-stars">★★★★★</div>
                <p>"The hair report recommended ingredients my dermatologist later confirmed."</p>
                <footer>
                    <strong>Joel R.</strong>
                    <span>Verified user</span>
                </footer>
            </blockquote>
            <blockquote class="glass-card testimonial-card reveal reveal-delay-3">
                <div class="testimonial-stars">★★★★★</div>
                <p>"Luxurious experience and genuinely helpful. Felt like a clinic visit."</p>
                <footer>
                    <strong>Sofia L.</strong>
                    <span>Beauty editor</span>
                </footer>
            </blockquote>
        </div>
    </div>
</section>

<!-- FAQ Section -->
<section class="section faq" id="faq">
    <div class="container container-narrow">
        <div class="section-header center reveal">
            <span class="section-label">FAQ</span>
            <h2 class="section-title">Questions, answered.</h2>
        </div>

        <div class="faq-list reveal reveal-delay-1">
            <div class="faq-item">
                <button class="faq-question" aria-expanded="false">
                    <span>Is the analysis medically accurate?</span>
                    <i data-lucide="chevron-down" class="faq-icon"></i>
                </button>
                <div class="faq-answer">
                    <p>Afrochick provides educational, personalized guidance based on your inputs. It is not a substitute for medical diagnosis. Always consult a dermatologist for persistent or severe concerns.</p>
                </div>
            </div>
            <div class="faq-item">
                <button class="faq-question" aria-expanded="false">
                    <span>How long does an analysis take?</span>
                    <i data-lucide="chevron-down" class="faq-icon"></i>
                </button>
                <div class="faq-answer">
                    <p>Most analyses take 5–8 minutes. Our guided wizard walks you through skin or hair type, concerns, lifestyle factors, and sensitivity checks step by step.</p>
                </div>
            </div>
            <div class="faq-item">
                <button class="faq-question" aria-expanded="false">
                    <span>Are my results private?</span>
                    <i data-lucide="chevron-down" class="faq-icon"></i>
                </button>
                <div class="faq-answer">
                    <p>Yes. Your analysis data is stored securely and never shared with third parties. You control your account and can delete your data at any time.</p>
                </div>
            </div>
            <div class="faq-item">
                <button class="faq-question" aria-expanded="false">
                    <span>Can I submit my own products?</span>
                    <i data-lucide="chevron-down" class="faq-icon"></i>
                </button>
                <div class="faq-answer">
                    <p>Absolutely. Visit our Product Submission page to share products you love. Our team reviews submissions before they appear in the Product Center.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Newsletter & Contact -->
<section class="section contact-section" id="contact">
    <div class="container">
        <div class="contact-grid">
            <div class="glass-card newsletter-card reveal">
                <h3>Stay in the loop.</h3>
                <p>Monthly notes on ingredient science, routines, and product picks.</p>
                <form class="newsletter-form" id="newsletter-form" action="/api/newsletter.php" method="POST">
                    <div class="input-group">
                        <input type="email" name="email" placeholder="Your email address" required aria-label="Email address">
                        <button type="submit" class="btn btn-primary">Subscribe</button>
                    </div>
                    <p class="form-message" id="newsletter-message" hidden></p>
                </form>
            </div>

            <div class="glass-card contact-card reveal reveal-delay-1">
                <h3>Get in touch.</h3>
                <p>Press, partnerships, or feedback — we'd love to hear from you.</p>
                <div class="contact-details">
                    <a href="mailto:<?= CONTACT_EMAIL ?>" class="contact-link">
                        <i data-lucide="mail"></i>
                        <?= CONTACT_EMAIL ?>
                    </a>
                    <p class="contact-location">
                        <i data-lucide="map-pin"></i>
                        Stockholm · Lagos · Remote
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
