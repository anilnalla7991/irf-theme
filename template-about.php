<?php
/**
 * Template Name: About IRF
 */
get_header();

$ab_banner_title = (function_exists('get_field') ? get_field('about_banner_title') : '') ?: 'About IRF – IACE';
$ab_banner_sub   = (function_exists('get_field') ? get_field('about_banner_sub')   : '') ?: "India's #1 Competitive Exam Coaching Institute";

$ab_intro_tag   = (function_exists('get_field') ? get_field('about_intro_tag')   : '') ?: 'Who We Are';
$ab_intro_title = (function_exists('get_field') ? get_field('about_intro_title') : '') ?: 'IRF – IACE Result Factory';
$ab_intro_text  = (function_exists('get_field') ? get_field('about_intro_text')  : '') ?: '<p>IRF – IACE Result Factory is a premier competitive exam coaching institute based in Hyderabad. Since 2014, we have been dedicated to shaping successful government job careers through smart preparation, consistent practice, and expert mentorship.</p><p>Our proven track record of selections across Banking, SSC, Railways and State PSC exams makes us the most trusted name in competitive exam coaching across South India.</p>';
$ab_intro_image = function_exists('get_field') ? get_field('about_intro_image') : null;

$ab_stats_acf = function_exists('get_field') ? get_field('about_stats') : array();
$ab_stats_def = array(
    array('number' => 5000,  'suffix' => '+',     'label' => 'Students Enrolled',  'icon' => '👨‍🎓'),
    array('number' => 1200,  'suffix' => '+',     'label' => 'Selections Made',     'icon' => '🏅'),
    array('number' => 10,    'suffix' => '+ Yrs', 'label' => 'Years Experience',    'icon' => '📅'),
    array('number' => 98,    'suffix' => '%',      'label' => 'Success Rate',        'icon' => '📈'),
);
$ab_stats = (!empty($ab_stats_acf) && is_array($ab_stats_acf)) ? $ab_stats_acf : $ab_stats_def;

$ab_mission_text = (function_exists('get_field') ? get_field('about_mission_text') : '') ?: 'To empower every aspiring government job candidate with world-class coaching, tools, and mentorship that maximizes their selection probability.';
$ab_vision_text  = (function_exists('get_field') ? get_field('about_vision_text')  : '') ?: 'To become the most trusted and results-driven competitive exam institute in South India, producing lakhs of government employees.';

$ab_vals_acf = function_exists('get_field') ? get_field('about_values') : array();
$ab_vals_def = array(
    array('icon' => '💎', 'title' => 'Excellence',    'desc' => 'Highest standards in teaching quality, study material, and student support across every batch.'),
    array('icon' => '🤝', 'title' => 'Integrity',     'desc' => 'Honest performance feedback and transparent progress tracking — no empty promises.'),
    array('icon' => '🔬', 'title' => 'Innovation',    'desc' => 'Continuously evolving teaching methods, AI tools, and content to stay ahead of changing exam patterns.'),
    array('icon' => '❤️', 'title' => 'Student First', 'desc' => 'Every decision we make is driven by what is best for our students\' long-term success.'),
    array('icon' => '🎯', 'title' => 'Focus',         'desc' => 'Laser-focused preparation strategies with structured timetables and daily performance benchmarks.'),
    array('icon' => '🏆', 'title' => 'Results',       'desc' => 'We measure success by selections — thousands of students have achieved their dream government jobs with us.'),
);
$ab_values = (!empty($ab_vals_acf) && is_array($ab_vals_acf)) ? $ab_vals_acf : $ab_vals_def;

$ab_team_acf = function_exists('get_field') ? get_field('about_team') : array();

$ab_timeline_acf = function_exists('get_field') ? get_field('about_timeline') : array();
$ab_timeline_def = array(
    array('year' => '2014', 'title' => 'Founded in Hyderabad',         'desc' => 'Started with a single classroom and a mission to change how students prepare for government exams.'),
    array('year' => '2016', 'title' => 'First 100 Selections',         'desc' => 'Crossed 100 government job selections — proof that our method truly works.'),
    array('year' => '2018', 'title' => 'Expanded to 3 Centers',        'desc' => 'Opened branches across Hyderabad to serve more aspirants with the same quality.'),
    array('year' => '2020', 'title' => 'Launched Online Platform',     'desc' => 'Introduced live online classes, mock tests and recorded lectures to reach students across India.'),
    array('year' => '2022', 'title' => '1000+ Selections Milestone',   'desc' => 'Celebrated 1000+ cumulative government job selections across Banking, SSC and State PSC.'),
    array('year' => '2024', 'title' => '10 Years of Excellence',       'desc' => 'Decade of transforming aspirants into officers — with 5000+ enrolled and still growing.'),
);
$ab_timeline = (!empty($ab_timeline_acf) && is_array($ab_timeline_acf)) ? $ab_timeline_acf : $ab_timeline_def;
?>

<!-- ============================================================
     PAGE BANNER
     ============================================================ -->
<section class="ab-hero">
    <div class="ab-hero-bg"></div>
    <div class="ab-hero-overlay"></div>
    <!-- floating shapes -->
    <div class="ab-hero-shape ab-hero-shape-1"></div>
    <div class="ab-hero-shape ab-hero-shape-2"></div>
    <div class="ab-hero-shape ab-hero-shape-3"></div>
    <div class="container ab-hero-inner">
        <div class="ab-hero-text">
            <nav class="breadcrumb" aria-label="Breadcrumb">
                <a href="<?php echo esc_url(home_url('/')); ?>">Home</a>
                <span class="breadcrumb-sep">&#8250;</span>
                <span>About</span>
            </nav>
            <h1 class="ab-hero-title"><?php echo esc_html($ab_banner_title); ?></h1>
            <p class="ab-hero-sub"><?php echo esc_html($ab_banner_sub); ?></p>
            <div class="ab-hero-pills">
                <span class="ab-pill">🏛️ Est. 2014</span>
                <span class="ab-pill">📍 Hyderabad</span>
                <span class="ab-pill">🎓 5000+ Students</span>
            </div>
        </div>
        <div class="ab-hero-cards">
            <div class="ab-hero-img-wrap">
                <?php if ($ab_intro_image) : ?>
                    <img src="<?php echo esc_url(is_array($ab_intro_image) ? $ab_intro_image['url'] : $ab_intro_image); ?>"
                         alt="IRF Institute" class="ab-hero-img">
                <?php else : ?>
                    <img src="https://images.unsplash.com/photo-1523050854058-8df90110c9f1?w=600&q=80"
                         alt="IRF Students" class="ab-hero-img">
                <?php endif; ?>
                <div class="ab-hero-badge">
                    <span class="ab-badge-num">10+</span>
                    <span class="ab-badge-txt">Years of<br>Excellence</span>
                </div>
            </div>
        </div>
    </div>
    <!-- wave divider -->
    <div class="ab-hero-wave">
        <svg viewBox="0 0 1440 60" fill="none" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="none">
            <path d="M0,30 C360,60 1080,0 1440,30 L1440,60 L0,60 Z" fill="#F8F9FA"/>
        </svg>
    </div>
</section>


<!-- ============================================================
     STATS STRIP
     ============================================================ -->
<section class="ab-stats-strip">
    <div class="container">
        <div class="ab-stats-row">
            <?php foreach ($ab_stats as $stat) : ?>
            <div class="ab-stat-box reveal">
                <div class="ab-stat-icon"><?php echo esc_html($stat['icon'] ?? '📊'); ?></div>
                <div class="ab-stat-num counter"
                     data-target="<?php echo esc_attr($stat['number']); ?>"
                     data-suffix="<?php echo esc_attr($stat['suffix']); ?>">0</div>
                <div class="ab-stat-lbl"><?php echo esc_html($stat['label']); ?></div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>


<!-- ============================================================
     WHO WE ARE
     ============================================================ -->
<section class="section ab-intro-section">
    <div class="container">
        <div class="ab-intro-grid">
            <!-- Images collage -->
            <div class="ab-intro-collage reveal">
                <div class="ab-collage-main">
                    <img src="https://images.unsplash.com/photo-1580582932707-520aed937b7b?w=600&q=80" alt="Classroom">
                </div>
                <div class="ab-collage-side">
                    <div class="ab-collage-sm">
                        <img src="https://images.unsplash.com/photo-1552664730-d307ca884978?w=300&q=80" alt="Study">
                    </div>
                    <div class="ab-collage-sm">
                        <img src="https://images.unsplash.com/photo-1523240795612-9a054b0db644?w=300&q=80" alt="Students">
                    </div>
                </div>
                <div class="ab-collage-badge-exp">
                    <strong>10+</strong> Years<br>of Trust
                </div>
            </div>
            <!-- Content -->
            <div class="ab-intro-content reveal reveal-delay-2">
                <span class="section-tag"><?php echo esc_html($ab_intro_tag); ?></span>
                <h2 class="section-title" style="text-align:left"><?php echo esc_html($ab_intro_title); ?></h2>
                <div class="ab-intro-text">
                    <?php echo wp_kses_post($ab_intro_text); ?>
                </div>
                <div class="ab-intro-highlights">
                    <div class="ab-highlight">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none"><circle cx="12" cy="12" r="10" fill="#FE0000" opacity=".12"/><path d="M8 12l3 3 5-5" stroke="#FE0000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                        Expert faculty with 10+ years experience
                    </div>
                    <div class="ab-highlight">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none"><circle cx="12" cy="12" r="10" fill="#FE0000" opacity=".12"/><path d="M8 12l3 3 5-5" stroke="#FE0000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                        Structured batches for Banking, SSC, Railways & PSC
                    </div>
                    <div class="ab-highlight">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none"><circle cx="12" cy="12" r="10" fill="#FE0000" opacity=".12"/><path d="M8 12l3 3 5-5" stroke="#FE0000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                        Online + Offline classes with live doubt sessions
                    </div>
                    <div class="ab-highlight">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none"><circle cx="12" cy="12" r="10" fill="#FE0000" opacity=".12"/><path d="M8 12l3 3 5-5" stroke="#FE0000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                        1200+ government job selections since inception
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<!-- ============================================================
     MISSION & VISION – split cards
     ============================================================ -->
<section class="section ab-mv-section">
    <div class="container">
        <div class="ab-mv-grid">
            <!-- Mission -->
            <div class="ab-mv-card ab-mv-mission reveal reveal-delay-1">
                <div class="ab-mv-icon-wrap">
                    <svg width="36" height="36" viewBox="0 0 24 24" fill="none"><path d="M12 2L3 7l9 5 9-5-9-5z" fill="white" opacity=".9"/><path d="M3 17l9 5 9-5" stroke="white" stroke-width="2" stroke-linecap="round"/><path d="M3 12l9 5 9-5" stroke="white" stroke-width="2" stroke-linecap="round"/></svg>
                </div>
                <h3 class="ab-mv-title">Our Mission</h3>
                <p class="ab-mv-text"><?php echo esc_html($ab_mission_text); ?></p>
                <div class="ab-mv-line"></div>
            </div>
            <!-- Vision -->
            <div class="ab-mv-card ab-mv-vision reveal reveal-delay-2">
                <div class="ab-mv-icon-wrap">
                    <svg width="36" height="36" viewBox="0 0 24 24" fill="none"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z" stroke="white" stroke-width="2"/><circle cx="12" cy="12" r="3" fill="white"/></svg>
                </div>
                <h3 class="ab-mv-title">Our Vision</h3>
                <p class="ab-mv-text"><?php echo esc_html($ab_vision_text); ?></p>
                <div class="ab-mv-line"></div>
            </div>
        </div>
    </div>
</section>


<!-- ============================================================
     TIMELINE / JOURNEY
     ============================================================ -->
<section class="section ab-journey-section">
    <div class="container">
        <div class="section-header reveal">
            <span class="section-tag">Our Journey</span>
            <h2 class="section-title">A Decade of Transforming Lives</h2>
            <p class="section-subtitle">From a single classroom to South India's most trusted coaching brand</p>
        </div>
        <div class="ab-timeline">
            <?php foreach ($ab_timeline as $i => $item) : ?>
            <div class="ab-tl-item reveal reveal-delay-<?php echo esc_attr(($i % 3) + 1); ?>">
                <div class="ab-tl-year"><?php echo esc_html($item['year']); ?></div>
                <div class="ab-tl-dot"></div>
                <div class="ab-tl-card">
                    <h4 class="ab-tl-title"><?php echo esc_html($item['title']); ?></h4>
                    <p class="ab-tl-desc"><?php echo esc_html($item['desc']); ?></p>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>


<!-- ============================================================
     CORE VALUES
     ============================================================ -->
<section class="section ab-values-section">
    <div class="container">
        <div class="section-header reveal">
            <span class="section-tag">What We Stand For</span>
            <h2 class="section-title" style="color:var(--white)">Our Core Values</h2>
            <p class="section-subtitle" style="color:rgba(255,255,255,0.6)">The principles that guide everything we do</p>
        </div>
        <div class="ab-values-grid">
            <?php foreach ($ab_values as $i => $val) : ?>
            <div class="ab-val-card reveal reveal-delay-<?php echo esc_attr(($i % 3) + 1); ?>">
                <div class="ab-val-icon"><?php echo esc_html($val['icon']); ?></div>
                <h3 class="ab-val-title"><?php echo esc_html($val['title']); ?></h3>
                <p class="ab-val-desc"><?php echo esc_html($val['desc']); ?></p>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>


<!-- ============================================================
     WHY CHOOSE US
     ============================================================ -->
<section class="section ab-why-section">
    <div class="container">
        <div class="ab-why-grid">
            <div class="ab-why-image reveal">
                <img src="https://images.unsplash.com/photo-1454165804606-c3d57bc86b40?w=600&q=80" alt="Why IRF">
                <div class="ab-why-img-badge">
                    <span>1200+</span>
                    Selections
                </div>
            </div>
            <div class="ab-why-content reveal reveal-delay-2">
                <span class="section-tag">Why Choose Us</span>
                <h2 class="section-title" style="text-align:left">The IRF Advantage</h2>
                <p style="color:var(--gray); margin-bottom:28px; font-size:15px; line-height:1.8">We don't just teach — we build toppers. Every element of our program is engineered for maximum selection probability.</p>
                <div class="ab-why-list">
                    <div class="ab-why-item">
                        <div class="ab-why-num">01</div>
                        <div>
                            <strong>Exam-Pattern Aligned Content</strong>
                            <p>Study material updated every cycle to match the latest exam patterns and syllabus changes.</p>
                        </div>
                    </div>
                    <div class="ab-why-item">
                        <div class="ab-why-num">02</div>
                        <div>
                            <strong>Daily Mock Tests & Analytics</strong>
                            <p>Track your accuracy, speed and weak areas with detailed performance reports after every test.</p>
                        </div>
                    </div>
                    <div class="ab-why-item">
                        <div class="ab-why-num">03</div>
                        <div>
                            <strong>Personal Mentorship</strong>
                            <p>One-on-one doubt sessions and career guidance to keep every student on the right track.</p>
                        </div>
                    </div>
                    <div class="ab-why-item">
                        <div class="ab-why-num">04</div>
                        <div>
                            <strong>Interview Preparation</strong>
                            <p>Dedicated GD & interview coaching rounds to help students clear the final selection stage.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<!-- ============================================================
     TEAM SECTION (only if ACF data exists)
     ============================================================ -->
<?php if (!empty($ab_team_acf) && is_array($ab_team_acf)) : ?>
<section class="section ab-team-section">
    <div class="container">
        <div class="section-header reveal">
            <span class="section-tag">Our Experts</span>
            <h2 class="section-title">Meet Our Expert Faculty</h2>
            <p class="section-subtitle">Experienced mentors dedicated to your success</p>
        </div>
        <div class="ab-team-grid">
            <?php foreach ($ab_team_acf as $i => $member) :
                $tm_photo = $member['photo'];
                $tm_name  = $member['name'];
                $tm_role  = $member['role'];
                $tm_exp   = $member['experience'];
                $tm_bio   = $member['bio'];
            ?>
            <div class="ab-team-card reveal reveal-delay-<?php echo esc_attr(($i % 3) + 1); ?>">
                <div class="ab-team-photo-wrap">
                    <?php if ($tm_photo) : ?>
                        <img src="<?php echo esc_url(is_array($tm_photo) ? $tm_photo['url'] : $tm_photo); ?>"
                             alt="<?php echo esc_attr($tm_name); ?>" class="ab-team-photo">
                    <?php else : ?>
                        <div class="ab-team-photo-ph">👨‍🏫</div>
                    <?php endif; ?>
                </div>
                <div class="ab-team-info">
                    <div class="ab-team-name"><?php echo esc_html($tm_name); ?></div>
                    <?php if ($tm_role) : ?>
                        <div class="ab-team-role"><?php echo esc_html($tm_role); ?></div>
                    <?php endif; ?>
                    <?php if ($tm_exp) : ?>
                        <div class="ab-team-exp"><?php echo esc_html($tm_exp); ?></div>
                    <?php endif; ?>
                    <?php if ($tm_bio) : ?>
                        <p class="ab-team-bio"><?php echo esc_html($tm_bio); ?></p>
                    <?php endif; ?>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<?php endif; ?>


<!-- ============================================================
     CTA BANNER
     ============================================================ -->
<section class="ab-cta-section">
    <div class="ab-cta-bg"></div>
    <div class="container ab-cta-inner">
        <div class="ab-cta-text reveal">
            <h2 class="ab-cta-title">Ready to Start Your Government Job Journey?</h2>
            <p class="ab-cta-sub">Join 5000+ students who trusted IRF–IACE to crack their dream exam.</p>
        </div>
        <div class="ab-cta-actions reveal reveal-delay-2">
            <a href="<?php echo esc_url(home_url('/courses')); ?>" class="btn btn-primary">Explore Courses</a>
            <a href="<?php echo esc_url(home_url('/contact')); ?>" class="btn btn-outline">Talk to Us</a>
        </div>
    </div>
</section>

<?php get_footer(); ?>
