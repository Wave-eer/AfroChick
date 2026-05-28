<?php
$pageTitle = 'Hair & Scalp Analysis';
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
                    <span id="quiz-step-title">Question 1 of 7</span>
                    <span id="quiz-step-percentage">14%</span>
                </div>
                <div class="quiz-progress-bar">
                    <div class="quiz-progress-fill" id="quiz-progress-fill" style="width: 14.2%;"></div>
                </div>
            </div>

            <!-- Quiz Steps Form -->
            <form id="hair-quiz-form" onsubmit="return false;">
                
                <!-- Step 1: Hair texture type -->
                <div class="quiz-step active" data-step="1" data-title="Hair Texture Type">
                    <h3 class="quiz-question">Which category best describes your natural hair?</h3>
                    <div class="quiz-options-grid">
                        <div class="quiz-option-card" data-val="coily">
                            <span class="option-indicator"><span class="option-dot"></span></span>
                            <div class="option-text-wrapper">
                                <span class="option-title">Coily / Kinky</span>
                                <span class="option-desc">Tight coils, spiral shape, easily shrinks, locks moisture quickly but gets dry.</span>
                            </div>
                        </div>
                        <div class="quiz-option-card" data-val="curly">
                            <span class="option-indicator"><span class="option-dot"></span></span>
                            <div class="option-text-wrapper">
                                <span class="option-title">Curly / Springy</span>
                                <span class="option-desc">Defined loops or S-shapes, range of thickness, prone to frizz.</span>
                            </div>
                        </div>
                        <div class="quiz-option-card" data-val="wavy">
                            <span class="option-indicator"><span class="option-dot"></span></span>
                            <div class="option-text-wrapper">
                                <span class="option-title">Wavy</span>
                                <span class="option-desc">Loose S-curves, holds styling well, rarely locks.</span>
                            </div>
                        </div>
                        <div class="quiz-option-card" data-val="straight">
                            <span class="option-indicator"><span class="option-dot"></span></span>
                            <div class="option-text-wrapper">
                                <span class="option-title">Straight</span>
                                <span class="option-desc">No curls or loops, gets oily quickly due to easy sebum flow.</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Step 2: Curl pattern -->
                <div class="quiz-step" data-step="2" data-title="Curl Pattern Details">
                    <h3 class="quiz-question">What is your specific curl pattern?</h3>
                    <div class="quiz-options-grid">
                        <div class="quiz-option-card" data-val="4c_coily">
                            <span class="option-indicator"><span class="option-dot"></span></span>
                            <div class="option-text-wrapper">
                                <span class="option-title">4C Coily</span>
                                <span class="option-desc">Z-shaped tight curls, no defined pattern without product, up to 75% shrinkage.</span>
                            </div>
                        </div>
                        <div class="quiz-option-card" data-val="4ab_coily">
                            <span class="option-indicator"><span class="option-dot"></span></span>
                            <div class="option-text-wrapper">
                                <span class="option-title">4A / 4B Coily</span>
                                <span class="option-desc">Mini S-shaped coils, cotton-like feel, needs high hydration.</span>
                            </div>
                        </div>
                        <div class="quiz-option-card" data-val="3ac_curly">
                            <span class="option-indicator"><span class="option-dot"></span></span>
                            <div class="option-text-wrapper">
                                <span class="option-title">3A - 3C Curly</span>
                                <span class="option-desc">Large ringlets or springy S-corkscrews, normal-dry scalp.</span>
                            </div>
                        </div>
                        <div class="quiz-option-card" data-val="2ac_wavy">
                            <span class="option-indicator"><span class="option-dot"></span></span>
                            <div class="option-text-wrapper">
                                <span class="option-title">2A - 2C Wavy</span>
                                <span class="option-desc">Beach waves, fine-coarse strands, prone to product buildup.</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Step 3: Hair porosity -->
                <div class="quiz-step" data-step="3" data-title="Hair Porosity">
                    <h3 class="quiz-question">How does your hair react to water and products?</h3>
                    <div class="quiz-options-grid">
                        <div class="quiz-option-card" data-val="high_porosity">
                            <span class="option-indicator"><span class="option-dot"></span></span>
                            <div class="option-text-wrapper">
                                <span class="option-title">High Porosity</span>
                                <span class="option-desc">Absorbs water instantly but dries very fast. Needs heavy creams &amp; oils to seal.</span>
                            </div>
                        </div>
                        <div class="quiz-option-card" data-val="medium_porosity">
                            <span class="option-indicator"><span class="option-dot"></span></span>
                            <div class="option-text-wrapper">
                                <span class="option-title">Medium / Balanced Porosity</span>
                                <span class="option-desc">Easy to style, absorbs and retains hydration effortlessly.</span>
                            </div>
                        </div>
                        <div class="quiz-option-card" data-val="low_porosity">
                            <span class="option-indicator"><span class="option-dot"></span></span>
                            <div class="option-text-wrapper">
                                <span class="option-title">Low Porosity</span>
                                <span class="option-desc">Water beads up on strands; takes a long time to get wet. Needs heat to open cuticles.</span>
                            </div>
                        </div>
                        <div class="quiz-option-card" data-val="undetermined">
                            <span class="option-indicator"><span class="option-dot"></span></span>
                            <div class="option-text-wrapper">
                                <span class="option-title">Undetermined</span>
                                <span class="option-desc">Unsure. Water reaction varies based on styling.</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Step 4: Scalp dryness/oiliness -->
                <div class="quiz-step" data-step="4" data-title="Scalp &amp; Root Condition">
                    <h3 class="quiz-question">How does your scalp feel 2 days after washing?</h3>
                    <div class="quiz-options-grid">
                        <div class="quiz-option-card" data-val="dry_itchy">
                            <span class="option-indicator"><span class="option-dot"></span></span>
                            <div class="option-text-wrapper">
                                <span class="option-title">Extremely Dry / Itchy / Flaky</span>
                                <span class="option-desc">Feels tight, itchy, shows fine dry flakes. Needs deep scalp conditioning.</span>
                            </div>
                        </div>
                        <div class="quiz-option-card" data-val="balanced">
                            <span class="option-indicator"><span class="option-dot"></span></span>
                            <div class="option-text-wrapper">
                                <span class="option-title">Balanced</span>
                                <span class="option-desc">Normal, comfortable scalp, no intense itchiness or heavy oil.</span>
                            </div>
                        </div>
                        <div class="quiz-option-card" data-val="oily_roots">
                            <span class="option-indicator"><span class="option-dot"></span></span>
                            <div class="option-text-wrapper">
                                <span class="option-title">Oily Roots</span>
                                <span class="option-desc">Scalp gets greasy quickly, but the ends of the hair remain dry.</span>
                            </div>
                        </div>
                        <div class="quiz-option-card" data-val="combination">
                            <span class="option-indicator"><span class="option-dot"></span></span>
                            <div class="option-text-wrapper">
                                <span class="option-title">Combination / Product Buildup</span>
                                <span class="option-desc">Prone to scales and buildup from thick hair creams.</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Step 5: Hair breakage -->
                <div class="quiz-step" data-step="5" data-title="Hair Breakage &amp; Strength">
                    <h3 class="quiz-question">Do you experience severe shedding or snapped ends?</h3>
                    <div class="quiz-options-grid">
                        <div class="quiz-option-card" data-val="minimal">
                            <span class="option-indicator"><span class="option-dot"></span></span>
                            <div class="option-text-wrapper">
                                <span class="option-title">Minimal Shedding</span>
                                <span class="option-desc">Normal daily fall (50-100 strands), strong structural bonds.</span>
                            </div>
                        </div>
                        <div class="quiz-option-card" data-val="moderate">
                            <span class="option-indicator"><span class="option-dot"></span></span>
                            <div class="option-text-wrapper">
                                <span class="option-title">Moderate Breakage</span>
                                <span class="option-desc">Short pieces of hair snap off during combing or detangling.</span>
                            </div>
                        </div>
                        <div class="quiz-option-card" data-val="severe">
                            <span class="option-indicator"><span class="option-dot"></span></span>
                            <div class="option-text-wrapper">
                                <span class="option-title">Severe Breakage / Split Ends</span>
                                <span class="option-desc">Strands snap easily even with gentle finger detangling, split ends visible.</span>
                            </div>
                        </div>
                        <div class="quiz-option-card" data-val="hair_loss">
                            <span class="option-indicator"><span class="option-dot"></span></span>
                            <div class="option-text-wrapper">
                                <span class="option-title">Scalp Hair Loss / Thinning</span>
                                <span class="option-desc">Noticeable thinning at the crown, temples, or parting lines.</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Step 6: Hair density -->
                <div class="quiz-step" data-step="6" data-title="Hair Density">
                    <h3 class="quiz-question">How thick or dense is your hair overall?</h3>
                    <div class="quiz-options-grid">
                        <div class="quiz-option-card" data-val="fine">
                            <span class="option-indicator"><span class="option-dot"></span></span>
                            <div class="option-text-wrapper">
                                <span class="option-title">Fine / Low Density</span>
                                <span class="option-desc">Strands are thin; scalp is easily visible when hair is parted.</span>
                            </div>
                        </div>
                        <div class="quiz-option-card" data-val="medium">
                            <span class="option-indicator"><span class="option-dot"></span></span>
                            <div class="option-text-wrapper">
                                <span class="option-title">Medium Density</span>
                                <span class="option-desc">Balanced, normal volume, strands are moderately thick.</span>
                            </div>
                        </div>
                        <div class="quiz-option-card" data-val="thick">
                            <span class="option-indicator"><span class="option-dot"></span></span>
                            <div class="option-text-wrapper">
                                <span class="option-title">Thick / High Density</span>
                                <span class="option-desc">Massive volume of strands, takes a very long time to wash/dry.</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Step 7: Protective styling habits -->
                <div class="quiz-step" data-step="7" data-title="Protective Styling Habits">
                    <h3 class="quiz-question">How do you usually style and protect your hair?</h3>
                    <div class="quiz-options-grid">
                        <div class="quiz-option-card" data-val="rarely">
                            <span class="option-indicator"><span class="option-dot"></span></span>
                            <div class="option-text-wrapper">
                                <span class="option-title">Rarely / Always Loose</span>
                                <span class="option-desc">Wears hair out in wash-and-go, puffs, or loose styles.</span>
                            </div>
                        </div>
                        <div class="quiz-option-card" data-val="braids_twists">
                            <span class="option-indicator"><span class="option-dot"></span></span>
                            <div class="option-text-wrapper">
                                <span class="option-title">Braids / Twists / Cornrows</span>
                                <span class="option-desc">Wears extensions or natural hair tucked in long-term braids.</span>
                            </div>
                        </div>
                        <div class="quiz-option-card" data-val="wigs_weaves">
                            <span class="option-indicator"><span class="option-dot"></span></span>
                            <div class="option-text-wrapper">
                                <span class="option-title">Wigs / Weaves</span>
                                <span class="option-desc">Hair cornrowed underneath, wearing external wigs or sew-ins.</span>
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
            <h3 class="loader-status-text" id="loader-status">Initializing Hair Scan...</h3>
            <p class="loader-sub-text" id="loader-subtext">Mapping curl pattern density and scalp sebum balances...</p>
        </div>

        <!-- Results Dashboard -->
        <div id="quiz-results" class="results-dashboard" style="display: none;"></div>

    </div>
</section>

<?php
$extraJs = ['mockData.js', 'quiz.js'];
require_once __DIR__ . '/includes/footer.php';
?>
