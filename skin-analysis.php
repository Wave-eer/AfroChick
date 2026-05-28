<?php
$pageTitle = 'Skin Analysis';
$currentPage = 'analyze';
$bodyClass = 'page-wizard';
require_once __DIR__ . '/includes/header.php';
?>

<section class="section" style="padding-top: var(--navbar-height);">
    <div class="container quiz-wrapper">
        
        <!-- Clinical Intake Form / Multi-step Wizard -->
        <div class="glass-card quiz-card animate reveal" id="quiz-intake-card">
            
            <!-- Progress Tracker -->
            <div class="quiz-progress-container">
                <div class="quiz-progress-meta">
                    <span id="quiz-step-title">Question 1 of 6</span>
                    <span id="quiz-step-percentage">16%</span>
                </div>
                <div class="quiz-progress-bar">
                    <div class="quiz-progress-fill" id="quiz-progress-fill" style="width: 16.6%;"></div>
                </div>
            </div>

            <!-- Quiz Steps Form -->
            <form id="skin-quiz-form" onsubmit="return false;">
                
                <!-- Step 1: Skin Oiliness/Dryness -->
                <div class="quiz-step active" data-step="1" data-title="Skin Texture &amp; Oiliness">
                    <h3 class="quiz-question">How does your skin feel throughout the day?</h3>
                    <div class="quiz-options-grid">
                        <div class="quiz-option-card" data-val="very_dry">
                            <span class="option-indicator"><span class="option-dot"></span></span>
                            <div class="option-text-wrapper">
                                <span class="option-title">Very Dry / Flaky</span>
                                <span class="option-desc">Tight feeling, occasional dry scales, needs intense moisture.</span>
                            </div>
                        </div>
                        <div class="quiz-option-card" data-val="normal_dry">
                            <span class="option-indicator"><span class="option-dot"></span></span>
                            <div class="option-text-wrapper">
                                <span class="option-title">Balanced to Dry</span>
                                <span class="option-desc">Comfortable, but can feel dry or dehydrated in cold weather.</span>
                            </div>
                        </div>
                        <div class="quiz-option-card" data-val="combination">
                            <span class="option-indicator"><span class="option-dot"></span></span>
                            <div class="option-text-wrapper">
                                <span class="option-title">Combination</span>
                                <span class="option-desc">Oily in the T-zone (forehead, nose, chin) and dry or normal elsewhere.</span>
                            </div>
                        </div>
                        <div class="quiz-option-card" data-val="oily">
                            <span class="option-indicator"><span class="option-dot"></span></span>
                            <div class="option-text-wrapper">
                                <span class="option-title">Oily</span>
                                <span class="option-desc">Shiny all over, feels greasy, has larger visible pores.</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Step 2: Sensitivity level -->
                <div class="quiz-step" data-step="2" data-title="Skin Sensitivity">
                    <h3 class="quiz-question">How easily does your skin get irritated or red?</h3>
                    <div class="quiz-options-grid">
                        <div class="quiz-option-card" data-val="resilient">
                            <span class="option-indicator"><span class="option-dot"></span></span>
                            <div class="option-text-wrapper">
                                <span class="option-title">Resilient / Strong</span>
                                <span class="option-desc">Rarely reacts to new products or environment factors.</span>
                            </div>
                        </div>
                        <div class="quiz-option-card" data-val="mildly_sensitive">
                            <span class="option-indicator"><span class="option-dot"></span></span>
                            <div class="option-text-wrapper">
                                <span class="option-title">Mildly Sensitive</span>
                                <span class="option-desc">Occasional stinging or itchiness from active products.</span>
                            </div>
                        </div>
                        <div class="quiz-option-card" data-val="highly_sensitive">
                            <span class="option-indicator"><span class="option-dot"></span></span>
                            <div class="option-text-wrapper">
                                <span class="option-title">Highly Sensitive</span>
                                <span class="option-desc">Reacts immediately to fragrance, alcohol, or weather changes.</span>
                            </div>
                        </div>
                        <div class="quiz-option-card" data-val="oily_reactive">
                            <span class="option-indicator"><span class="option-dot"></span></span>
                            <div class="option-text-wrapper">
                                <span class="option-title">Oily-Reactive</span>
                                <span class="option-desc">Gets oily AND irritated simultaneously, prone to contact rashes.</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Step 3: Acne Frequency -->
                <div class="quiz-step" data-step="3" data-title="Acne &amp; Breakouts">
                    <h3 class="quiz-question">How frequently do you experience breakouts or acne?</h3>
                    <div class="quiz-options-grid">
                        <div class="quiz-option-card" data-val="rarely">
                            <span class="option-indicator"><span class="option-dot"></span></span>
                            <div class="option-text-wrapper">
                                <span class="option-title">Rarely / Never</span>
                                <span class="option-desc">Clear skin, experiences breakouts less than once a month.</span>
                            </div>
                        </div>
                        <div class="quiz-option-card" data-val="occasionally">
                            <span class="option-indicator"><span class="option-dot"></span></span>
                            <div class="option-text-wrapper">
                                <span class="option-title">Occasionally</span>
                                <span class="option-desc">Prone to breakouts around stress, hormones, or diet changes.</span>
                            </div>
                        </div>
                        <div class="quiz-option-card" data-val="frequently">
                            <span class="option-indicator"><span class="option-dot"></span></span>
                            <div class="option-text-wrapper">
                                <span class="option-title">Frequently</span>
                                <span class="option-desc">Has active breakouts regularly, particularly in oily regions.</span>
                            </div>
                        </div>
                        <div class="quiz-option-card" data-val="chronic">
                            <span class="option-indicator"><span class="option-dot"></span></span>
                            <div class="option-text-wrapper">
                                <span class="option-title">Chronic Acne</span>
                                <span class="option-desc">Persistent painful cysts or nodules, slow-healing spots.</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Step 4: Skin Concerns -->
                <div class="quiz-step" data-step="4" data-title="Primary Skin Concerns">
                    <h3 class="quiz-question">What are your primary skin concerns? (Select multiple)</h3>
                    <div class="quiz-options-grid two-cols">
                        <div class="quiz-option-card checkbox" data-val="hyperpigmentation">
                            <span class="option-indicator"><span class="option-dot"></span></span>
                            <div class="option-text-wrapper">
                                <span class="option-title">Hyperpigmentation</span>
                                <span class="option-desc">Dark spots or uneven patches.</span>
                            </div>
                        </div>
                        <div class="quiz-option-card checkbox" data-val="dehydration">
                            <span class="option-indicator"><span class="option-dot"></span></span>
                            <div class="option-text-wrapper">
                                <span class="option-title">Dehydration</span>
                                <span class="option-desc">Flaky or tight under-layer.</span>
                            </div>
                        </div>
                        <div class="quiz-option-card checkbox" data-val="dullness">
                            <span class="option-indicator"><span class="option-dot"></span></span>
                            <div class="option-text-wrapper">
                                <span class="option-title">Dullness</span>
                                <span class="option-desc">Lacks radiant natural glow.</span>
                            </div>
                        </div>
                        <div class="quiz-option-card checkbox" data-val="texture">
                            <span class="option-indicator"><span class="option-dot"></span></span>
                            <div class="option-text-wrapper">
                                <span class="option-title">Uneven Texture</span>
                                <span class="option-desc">Rough patches or bumps.</span>
                            </div>
                        </div>
                        <div class="quiz-option-card checkbox" data-val="lines">
                            <span class="option-indicator"><span class="option-dot"></span></span>
                            <div class="option-text-wrapper">
                                <span class="option-title">Fine Lines</span>
                                <span class="option-desc">Aging signs or loss of elasticity.</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Step 5: Hyperpigmentation presence -->
                <div class="quiz-step" data-step="5" data-title="Dark Spots &amp; Melasma">
                    <h3 class="quiz-question">Do you notice dark marks after pimples heal, or patches on cheeks?</h3>
                    <div class="quiz-options-grid">
                        <div class="quiz-option-card" data-val="none">
                            <span class="option-indicator"><span class="option-dot"></span></span>
                            <div class="option-text-wrapper">
                                <span class="option-title">None</span>
                                <span class="option-desc">Marks fade quickly without leaving dark residues.</span>
                            </div>
                        </div>
                        <div class="quiz-option-card" data-val="mild">
                            <span class="option-indicator"><span class="option-dot"></span></span>
                            <div class="option-text-wrapper">
                                <span class="option-title">Mild Dark Spots</span>
                                <span class="option-desc">Pimples leave brown or black spots that take months to fade.</span>
                            </div>
                        </div>
                        <div class="quiz-option-card" data-val="melasma">
                            <span class="option-indicator"><span class="option-dot"></span></span>
                            <div class="option-text-wrapper">
                                <span class="option-title">Symmetrical Patches (Melasma)</span>
                                <span class="option-desc">Larger grey-brown patches triggered by sun, heat, or hormones.</span>
                            </div>
                        </div>
                        <div class="quiz-option-card" data-val="deep_post">
                            <span class="option-indicator"><span class="option-dot"></span></span>
                            <div class="option-text-wrapper">
                                <span class="option-title">Deep Post-inflammatory Hyperpigmentation</span>
                                <span class="option-desc">Dark, stubborn pigmentation spots from any cuts, insect bites, or breakouts.</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Step 6: Sun reaction -->
                <div class="quiz-step" data-step="6" data-title="Sun Exposure Response">
                    <h3 class="quiz-question">How does your skin react to 30 minutes in direct sunlight?</h3>
                    <div class="quiz-options-grid">
                        <div class="quiz-option-card" data-val="burns_always">
                            <span class="option-indicator"><span class="option-dot"></span></span>
                            <div class="option-text-wrapper">
                                <span class="option-title">Burns easily, never tans</span>
                                <span class="option-desc">Highly reactive. Prone to severe redness and sun damage.</span>
                            </div>
                        </div>
                        <div class="quiz-option-card" data-val="burns_sometimes">
                            <span class="option-indicator"><span class="option-dot"></span></span>
                            <div class="option-text-wrapper">
                                <span class="option-title">Tans with minor redness/burns first</span>
                                <span class="option-desc">Prone to immediate dark spots activation.</span>
                            </div>
                        </div>
                        <div class="quiz-option-card" data-val="tans_easily">
                            <span class="option-indicator"><span class="option-dot"></span></span>
                            <div class="option-text-wrapper">
                                <span class="option-title">Tans deeply, rarely or never burns</span>
                                <span class="option-desc">Typical for melanin-rich Fitzpatrick V-VI. Protects from burning, but triggers deep stubborn pigmentation.</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Navigation Buttons -->
                <div class="quiz-navigation">
                    <button type="button" class="btn btn-secondary" id="quiz-btn-prev" disabled>← Previous</button>
                    <button type="button" class="btn btn-primary" id="quiz-btn-next">Next →</button>
                </div>
            </form>
        </div>

        <!-- AI Clinical Diagnostic Loader -->
        <div class="glass-card quiz-card diagnostic-loader" id="quiz-loader">
            <div class="loader-spinner-wrapper">
                <div class="loader-pattern-ring"></div>
                <div class="loader-pulse-glow"></div>
                <div class="loader-logo-wrap">
                    <svg width="100%" height="100%" viewBox="0 0 100 100" fill="none" xmlns="http://www.w3.org/2000/svg">
                      <path d="M50 12C29.01 12 12 29.01 12 50C12 58.55 14.83 66.45 19.61 72.82C18.15 75.87 18.52 79.57 21.05 82.1C23.98 85.03 28.53 85.39 31.86 83.21C37.07 86.87 43.34 89 50.1 89C57.48 89 64.28 86.41 69.75 82.1C72.83 83.74 76.81 83.33 79.5 80.64C82.19 77.95 82.6 73.97 80.96 70.89C85.83 65.28 89 58 89 50C89 29.01 70.99 12 50 12Z" fill="var(--gold-500)" />
                    </svg>
                </div>
            </div>
            <h3 class="loader-status-text" id="loader-status">Initializing Skin Scan...</h3>
            <p class="loader-sub-text" id="loader-subtext">Mapping Fitzpatrick scale and active melanocyte triggers...</p>
        </div>

        <!-- Results Dashboard -->
        <div id="quiz-results" class="results-dashboard" style="display: none;"></div>

    </div>
</section>

<?php
$extraJs = ['mockData.js', 'quiz.js'];
require_once __DIR__ . '/includes/footer.php';
?>
