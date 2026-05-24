<?php
$pageTitle = 'Skin & Hair Analysis Center';
$pageDescription = 'Clinical-grade skin & hair analysis with personalized routines, nutrients, and ingredient guidance.';
$currentPage = 'home';
$bodyClass = 'page-home';
$showFloatingCta = true;
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

    <!-- Floating product visuals -->
    <div class="floating-products" aria-hidden="true">
        <div class="float-item float-1"><span>🧴</span></div>
        <div class="float-item float-2"><span>💧</span></div>
        <div class="float-item float-3"><span>🌿</span></div>
        <div class="float-item float-4"><span>✨</span></div>
        <div class="float-item float-5"><span>🍃</span></div>
        <div class="float-item float-6"><span>🔬</span></div>
    </div>

    <div class="container hero-content">
        <div class="hero-badge reveal">
            <i data-lucide="sparkles"></i>
            AI-guided dermatology, made gentle
        </div>

        <h1 class="hero-title reveal reveal-delay-1">
            Clarity for your <em>skin</em> and <em>hair</em>
        </h1>

        <p class="hero-subtitle reveal reveal-delay-2">
            Afrochick's clinical-grade analysis tells you what your skin and hair actually need —
            with personalized routines, nutrients, and ingredient guidance.
        </p>

        <div class="hero-cta reveal reveal-delay-3">
            <a href="/dashboard.php" class="btn btn-primary btn-lg">
                <i data-lucide="scan-line"></i>
                Start analysis
            </a>
            <a href="/signup.php" class="btn btn-secondary btn-lg">Sign up</a>
            <a href="/login.php" class="btn btn-ghost btn-lg">Login</a>
        </div>
    </div>
</section>

<!-- About Section -->
<section class="section about" id="about">
    <div class="container">
        <div class="section-header reveal">
            <span class="section-label">About Afrochick</span>
            <h2 class="section-title">A calmer, smarter approach to skin &amp; hair care.</h2>
            <p class="section-desc">
                Afrochick blends clinical thinking with modern AI to translate your symptoms, lifestyle,
                and goals into a focused, evidence-informed plan — minus the noise of generic beauty advice.
            </p>
        </div>

        <div class="about-grid">
            <div class="about-visual reveal reveal-delay-1">
                <div class="glass-card about-card">
                    <div class="about-icons">
                        <span class="about-icon">🧪</span>
                        <span class="about-icon">🌸</span>
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
