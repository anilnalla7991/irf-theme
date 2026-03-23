<?php
/**
 * Template Name: About IRF
 */
get_header();

$gf = 'get_field';

/* ── Hero Banner ── */
$ab_banner_title    = (function_exists($gf) ? get_field('about_banner_title')    : '') ?: 'About IRF – IACE';
$ab_banner_sub      = (function_exists($gf) ? get_field('about_banner_sub')      : '') ?: "India's #1 Competitive Exam Coaching Institute";
$ab_hero_pill1      = (function_exists($gf) ? get_field('about_hero_pill1')      : '') ?: '🏛️ Est. 2014';
$ab_hero_pill2      = (function_exists($gf) ? get_field('about_hero_pill2')      : '') ?: '📍 Hyderabad';
$ab_hero_pill3      = (function_exists($gf) ? get_field('about_hero_pill3')      : '') ?: '🎓 5000+ Students';
$ab_badge_num       = (function_exists($gf) ? get_field('about_hero_badge_num')  : '') ?: '10+';
$ab_badge_txt       = (function_exists($gf) ? get_field('about_hero_badge_txt')  : '') ?: 'Years of Excellence';
$ab_intro_image     = function_exists($gf)  ? get_field('about_intro_image')     : null;

/* ── Who We Are ── */
$ab_intro_tag       = (function_exists($gf) ? get_field('about_intro_tag')       : '') ?: 'Who We Are';
$ab_intro_title     = (function_exists($gf) ? get_field('about_intro_title')     : '') ?: 'IRF – IACE Result Factory';
$ab_intro_text      = (function_exists($gf) ? get_field('about_intro_text')      : '') ?: '<p>IRF – IACE Result Factory is a premier competitive exam coaching institute based in Hyderabad. Since 2014, we have been dedicated to shaping successful government job careers through smart preparation, consistent practice, and expert mentorship.</p><p>Our proven track record of selections across Banking, SSC, Railways and State PSC exams makes us the most trusted name in competitive exam coaching across South India.</p>';
$ab_collage_img1    = function_exists($gf)  ? get_field('about_collage_img1')    : null;
$ab_collage_img2    = function_exists($gf)  ? get_field('about_collage_img2')    : null;
$ab_collage_img3    = function_exists($gf)  ? get_field('about_collage_img3')    : null;
$ab_collage_badge   = (function_exists($gf) ? get_field('about_collage_badge')   : '') ?: '10+ Years of Trust';
$ab_highlights_acf  = function_exists($gf)  ? get_field('about_intro_highlights'): array();
$ab_highlights_def  = array(
    array('text' => 'Expert faculty with 10+ years experience'),
    array('text' => 'Structured batches for Banking, SSC, Railways & PSC'),
    array('text' => 'Online + Offline classes with live doubt sessions'),
    array('text' => '1200+ government job selections since inception'),
);
$ab_highlights = (!empty($ab_highlights_acf) && is_array($ab_highlights_acf)) ? $ab_highlights_acf : $ab_highlights_def;

/* ── Stats ── */
$ab_stats_acf  = function_exists($gf) ? get_field('about_stats') : array();
$ab_stats_def  = array(
    array('icon' => '👨‍🎓', 'number' => 5000,  'suffix' => '+',     'label' => 'Students Enrolled'),
    array('icon' => '🏅',   'number' => 1200,  'suffix' => '+',     'label' => 'Selections Made'),
    array('icon' => '📅',   'number' => 10,    'suffix' => '+ Yrs', 'label' => 'Years Experience'),
    array('icon' => '📈',   'number' => 98,    'suffix' => '%',      'label' => 'Success Rate'),
);
$ab_stats = (!empty($ab_stats_acf) && is_array($ab_stats_acf)) ? $ab_stats_acf : $ab_stats_def;

/* ── Mission & Vision ── */
$ab_mission_title = (function_exists($gf) ? get_field('about_mission_title') : '') ?: 'Our Mission';
$ab_mission_text  = (function_exists($gf) ? get_field('about_mission_text')  : '') ?: 'To empower every aspiring government job candidate with world-class coaching, tools, and mentorship that maximizes their selection probability.';
$ab_vision_title  = (function_exists($gf) ? get_field('about_vision_title')  : '') ?: 'Our Vision';
$ab_vision_text   = (function_exists($gf) ? get_field('about_vision_text')   : '') ?: 'To become the most trusted and results-driven competitive exam institute in South India, producing lakhs of government employees.';

/* ── Journey / Timeline ── */
$ab_journey_tag   = (function_exists($gf) ? get_field('about_journey_tag')   : '') ?: 'Our Journey';
$ab_journey_title = (function_exists($gf) ? get_field('about_journey_title') : '') ?: 'A Decade of Transforming Lives';
$ab_journey_sub   = (function_exists($gf) ? get_field('about_journey_sub')   : '') ?: "From a single classroom to South India's most trusted coaching brand";
$ab_timeline_acf  = function_exists($gf)  ? get_field('about_timeline')      : array();
$ab_timeline_def  = array(
    array('year' => '2014', 'title' => 'Founded in Hyderabad',       'desc' => 'Started with a single classroom and a mission to change how students prepare for government exams.'),
    array('year' => '2016', 'title' => 'First 100 Selections',       'desc' => 'Crossed 100 government job selections — proof that our method truly works.'),
    array('year' => '2018', 'title' => 'Expanded to 3 Centers',      'desc' => 'Opened branches across Hyderabad to serve more aspirants with the same quality.'),
    array('year' => '2020', 'title' => 'Launched Online Platform',   'desc' => 'Introduced live online classes, mock tests and recorded lectures to reach students across India.'),
    array('year' => '2022', 'title' => '1000+ Selections Milestone', 'desc' => 'Celebrated 1000+ cumulative government job selections across Banking, SSC and State PSC.'),
    array('year' => '2024', 'title' => '10 Years of Excellence',     'desc' => 'Decade of transforming aspirants into officers — with 5000+ enrolled and still growing.'),
);
$ab_timeline = (!empty($ab_timeline_acf) && is_array($ab_timeline_acf)) ? $ab_timeline_acf : $ab_timeline_def;

/* ── Core Values ── */
$ab_vals_tag   = (function_exists($gf) ? get_field('about_values_tag')   : '') ?: 'What We Stand For';
$ab_vals_title = (function_exists($gf) ? get_field('about_values_title') : '') ?: 'Our Core Values';
$ab_vals_sub   = (function_exists($gf) ? get_field('about_values_sub')   : '') ?: 'The principles that guide everything we do';
$ab_vals_acf   = function_exists($gf)  ? get_field('about_values')       : array();
$ab_vals_def   = array(
    array('icon' => '💎', 'title' => 'Excellence',    'desc' => 'Highest standards in teaching quality, study material, and student support across every batch.'),
    array('icon' => '🤝', 'title' => 'Integrity',     'desc' => 'Honest performance feedback and transparent progress tracking — no empty promises.'),
    array('icon' => '🔬', 'title' => 'Innovation',    'desc' => 'Continuously evolving teaching methods, AI tools, and content to stay ahead of changing exam patterns.'),
    array('icon' => '❤️', 'title' => 'Student First', 'desc' => "Every decision we make is driven by what is best for our students' long-term success."),
    array('icon' => '🎯', 'title' => 'Focus',         'desc' => 'Laser-focused preparation strategies with structured timetables and daily performance benchmarks.'),
    array('icon' => '🏆', 'title' => 'Results',       'desc' => 'We measure success by selections — thousands of students have achieved their dream government jobs with us.'),
);
$ab_values = (!empty($ab_vals_acf) && is_array($ab_vals_acf)) ? $ab_vals_acf : $ab_vals_def;

/* ── Why Choose Us ── */
$ab_why_tag       = (function_exists($gf) ? get_field('about_why_tag')       : '') ?: 'Why Choose Us';
$ab_why_title     = (function_exists($gf) ? get_field('about_why_title')     : '') ?: 'The IRF Advantage';
$ab_why_sub       = (function_exists($gf) ? get_field('about_why_sub')       : '') ?: "We don't just teach — we build toppers. Every element of our program is engineered for maximum selection probability.";
$ab_why_image     = function_exists($gf)  ? get_field('about_why_image')     : null;
$ab_why_badge_num = (function_exists($gf) ? get_field('about_why_badge_num') : '') ?: '1200+';
$ab_why_badge_txt = (function_exists($gf) ? get_field('about_why_badge_txt') : '') ?: 'Selections';
$ab_why_items_acf = function_exists($gf)  ? get_field('about_why_items')     : array();
$ab_why_items_def = array(
    array('title' => 'Exam-Pattern Aligned Content',  'desc' => 'Study material updated every cycle to match the latest exam patterns and syllabus changes.'),
    array('title' => 'Daily Mock Tests & Analytics',  'desc' => 'Track your accuracy, speed and weak areas with detailed performance reports after every test.'),
    array('title' => 'Personal Mentorship',           'desc' => 'One-on-one doubt sessions and career guidance to keep every student on the right track.'),
    array('title' => 'Interview Preparation',         'desc' => 'Dedicated GD & interview coaching rounds to help students clear the final selection stage.'),
);
$ab_why_items = (!empty($ab_why_items_acf) && is_array($ab_why_items_acf)) ? $ab_why_items_acf : $ab_why_items_def;

/* ── Team ── */
$ab_team_tag      = (function_exists($gf) ? get_field('about_team_tag')      : '') ?: 'Our Experts';
$ab_team_title    = (function_exists($gf) ? get_field('about_team_title')    : '') ?: 'Meet Our Expert Faculty';
$ab_team_subtitle = (function_exists($gf) ? get_field('about_team_subtitle') : '') ?: 'Experienced mentors dedicated to your success';
$ab_team_acf      = function_exists($gf)  ? get_field('about_team')          : array();

/* ── CTA ── */
$ab_cta_title     = (function_exists($gf) ? get_field('about_cta_title')     : '') ?: 'Ready to Start Your Government Job Journey?';
$ab_cta_sub       = (function_exists($gf) ? get_field('about_cta_sub')       : '') ?: 'Join 5000+ students who trusted IRF–IACE to crack their dream exam.';
$ab_cta_btn1_text = (function_exists($gf) ? get_field('about_cta_btn1_text') : '') ?: 'Explore Courses';
$ab_cta_btn1_url  = (function_exists($gf) ? get_field('about_cta_btn1_url')  : '') ?: home_url('/courses');
$ab_cta_btn2_text = (function_exists($gf) ? get_field('about_cta_btn2_text') : '') ?: 'Talk to Us';
$ab_cta_btn2_url  = (function_exists($gf) ? get_field('about_cta_btn2_url')  : '') ?: home_url('/contact');

/* helper to get image URL from ACF image field (array or string) */
function irf_img_url($field, $fallback = '') {
    if (!$field) return $fallback;
    return is_array($field) ? $field['url'] : $field;
}
function irf_img_alt($field, $fallback = '') {
    if (!$field) return $fallback;
    return is_array($field) ? $field['alt'] : $fallback;
}
?>

<!-- ============================================================
     HERO BANNER
     ============================================================ -->
<section class="ab-hero">
    <div class="ab-hero-bg"></div>
    <div class="ab-hero-overlay"></div>
    <div class="ab-hero-shape ab-hero-shape-1"></div>
    <div class="ab-hero-shape ab-hero-shape-2"></div>
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
                <?php if ($ab_hero_pill1) : ?><span class="ab-pill"><?php echo esc_html($ab_hero_pill1); ?></span><?php endif; ?>
                <?php if ($ab_hero_pill2) : ?><span class="ab-pill"><?php echo esc_html($ab_hero_pill2); ?></span><?php endif; ?>
                <?php if ($ab_hero_pill3) : ?><span class="ab-pill"><?php echo esc_html($ab_hero_pill3); ?></span><?php endif; ?>
            </div>
        </div>
        <div class="ab-hero-cards">
            <div class="ab-hero-img-wrap">
                <img src="<?php echo esc_url(irf_img_url($ab_intro_image, 'https://images.unsplash.com/photo-1523050854058-8df90110c9f1?w=600&q=80')); ?>"
                     alt="<?php echo esc_attr(irf_img_alt($ab_intro_image, 'IRF Students')); ?>"
                     class="ab-hero-img">
                <?php if ($ab_badge_num) : ?>
                <div class="ab-hero-badge">
                    <span class="ab-badge-num"><?php echo esc_html($ab_badge_num); ?></span>
                    <span class="ab-badge-txt"><?php echo esc_html($ab_badge_txt); ?></span>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
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
                <?php if (!empty($stat['icon'])) : ?>
                <div class="ab-stat-icon"><?php echo esc_html($stat['icon']); ?></div>
                <?php endif; ?>
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
            <!-- Photo collage -->
            <div class="ab-intro-collage reveal">
                <div class="ab-collage-main">
                    <img src="<?php echo esc_url(irf_img_url($ab_collage_img1, 'https://images.unsplash.com/photo-1580582932707-520aed937b7b?w=600&q=80')); ?>"
                         alt="<?php echo esc_attr(irf_img_alt($ab_collage_img1, 'IRF Classroom')); ?>">
                </div>
                <div class="ab-collage-side">
                    <div class="ab-collage-sm">
                        <img src="<?php echo esc_url(irf_img_url($ab_collage_img2, 'https://images.unsplash.com/photo-1552664730-d307ca884978?w=300&q=80')); ?>"
                             alt="<?php echo esc_attr(irf_img_alt($ab_collage_img2, 'Studying')); ?>">
                    </div>
                    <div class="ab-collage-sm">
                        <img src="<?php echo esc_url(irf_img_url($ab_collage_img3, 'https://images.unsplash.com/photo-1523240795612-9a054b0db644?w=300&q=80')); ?>"
                             alt="<?php echo esc_attr(irf_img_alt($ab_collage_img3, 'Students')); ?>">
                    </div>
                </div>
                <?php if ($ab_collage_badge) :
                    // Split "10+ Years\nof Trust" style text
                    $badge_parts = preg_split('/[\n\\\\n]+/', $ab_collage_badge, 2);
                    $badge_bold  = $badge_parts[0] ?? $ab_collage_badge;
                    $badge_rest  = $badge_parts[1] ?? '';
                ?>
                <div class="ab-collage-badge-exp">
                    <strong><?php echo esc_html($badge_bold); ?></strong>
                    <?php if ($badge_rest) echo '<br>' . esc_html($badge_rest); ?>
                </div>
                <?php endif; ?>
            </div>
            <!-- Content -->
            <div class="ab-intro-content reveal reveal-delay-2">
                <span class="section-tag"><?php echo esc_html($ab_intro_tag); ?></span>
                <h2 class="section-title" style="text-align:left"><?php echo esc_html($ab_intro_title); ?></h2>
                <div class="ab-intro-text">
                    <?php echo wp_kses_post($ab_intro_text); ?>
                </div>
                <?php if (!empty($ab_highlights)) : ?>
                <div class="ab-intro-highlights">
                    <?php foreach ($ab_highlights as $hl) : ?>
                    <div class="ab-highlight">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none"><circle cx="12" cy="12" r="10" fill="#FE0000" opacity=".12"/><path d="M8 12l3 3 5-5" stroke="#FE0000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                        <?php echo esc_html($hl['text']); ?>
                    </div>
                    <?php endforeach; ?>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>


<!-- ============================================================
     MISSION & VISION
     ============================================================ -->
<section class="section ab-mv-section">
    <div class="container">
        <div class="ab-mv-grid">
            <div class="ab-mv-card ab-mv-mission reveal reveal-delay-1">
                <div class="ab-mv-icon-wrap">
                    <svg width="36" height="36" viewBox="0 0 24 24" fill="none"><path d="M12 2L3 7l9 5 9-5-9-5z" fill="white" opacity=".9"/><path d="M3 17l9 5 9-5" stroke="white" stroke-width="2" stroke-linecap="round"/><path d="M3 12l9 5 9-5" stroke="white" stroke-width="2" stroke-linecap="round"/></svg>
                </div>
                <h3 class="ab-mv-title"><?php echo esc_html($ab_mission_title); ?></h3>
                <p class="ab-mv-text"><?php echo esc_html($ab_mission_text); ?></p>
                <div class="ab-mv-line"></div>
            </div>
            <div class="ab-mv-card ab-mv-vision reveal reveal-delay-2">
                <div class="ab-mv-icon-wrap">
                    <svg width="36" height="36" viewBox="0 0 24 24" fill="none"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z" stroke="white" stroke-width="2"/><circle cx="12" cy="12" r="3" fill="white"/></svg>
                </div>
                <h3 class="ab-mv-title"><?php echo esc_html($ab_vision_title); ?></h3>
                <p class="ab-mv-text"><?php echo esc_html($ab_vision_text); ?></p>
                <div class="ab-mv-line"></div>
            </div>
        </div>
    </div>
</section>


<!-- ============================================================
     JOURNEY / TIMELINE
     ============================================================ -->
<section class="section ab-journey-section">
    <div class="container">
        <div class="section-header reveal">
            <span class="section-tag"><?php echo esc_html($ab_journey_tag); ?></span>
            <h2 class="section-title"><?php echo esc_html($ab_journey_title); ?></h2>
            <p class="section-subtitle"><?php echo esc_html($ab_journey_sub); ?></p>
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
            <span class="section-tag"><?php echo esc_html($ab_vals_tag); ?></span>
            <h2 class="section-title" style="color:var(--white)"><?php echo esc_html($ab_vals_title); ?></h2>
            <p class="section-subtitle" style="color:rgba(255,255,255,0.6)"><?php echo esc_html($ab_vals_sub); ?></p>
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
                <img src="<?php echo esc_url(irf_img_url($ab_why_image, 'https://images.unsplash.com/photo-1454165804606-c3d57bc86b40?w=600&q=80')); ?>"
                     alt="<?php echo esc_attr(irf_img_alt($ab_why_image, 'Why IRF')); ?>">
                <?php if ($ab_why_badge_num) : ?>
                <div class="ab-why-img-badge">
                    <span><?php echo esc_html($ab_why_badge_num); ?></span>
                    <?php echo esc_html($ab_why_badge_txt); ?>
                </div>
                <?php endif; ?>
            </div>
            <div class="ab-why-content reveal reveal-delay-2">
                <span class="section-tag"><?php echo esc_html($ab_why_tag); ?></span>
                <h2 class="section-title" style="text-align:left"><?php echo esc_html($ab_why_title); ?></h2>
                <?php if ($ab_why_sub) : ?>
                <p style="color:var(--gray); margin-bottom:28px; font-size:15px; line-height:1.8"><?php echo esc_html($ab_why_sub); ?></p>
                <?php endif; ?>
                <div class="ab-why-list">
                    <?php foreach ($ab_why_items as $n => $item) : ?>
                    <div class="ab-why-item">
                        <div class="ab-why-num"><?php printf('%02d', $n + 1); ?></div>
                        <div>
                            <strong><?php echo esc_html($item['title']); ?></strong>
                            <p><?php echo esc_html($item['desc']); ?></p>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</section>


<!-- ============================================================
     TEAM (only if ACF rows exist)
     ============================================================ -->
<?php if (!empty($ab_team_acf) && is_array($ab_team_acf)) : ?>
<section class="section ab-team-section">
    <div class="container">
        <div class="section-header reveal">
            <span class="section-tag"><?php echo esc_html($ab_team_tag); ?></span>
            <h2 class="section-title"><?php echo esc_html($ab_team_title); ?></h2>
            <p class="section-subtitle"><?php echo esc_html($ab_team_subtitle); ?></p>
        </div>
        <div class="ab-team-grid">
            <?php foreach ($ab_team_acf as $i => $member) : ?>
            <div class="ab-team-card reveal reveal-delay-<?php echo esc_attr(($i % 3) + 1); ?>">
                <div class="ab-team-photo-wrap">
                    <?php if (!empty($member['photo'])) : ?>
                        <img src="<?php echo esc_url(irf_img_url($member['photo'])); ?>"
                             alt="<?php echo esc_attr($member['name'] ?? ''); ?>" class="ab-team-photo">
                    <?php else : ?>
                        <div class="ab-team-photo-ph">👨‍🏫</div>
                    <?php endif; ?>
                </div>
                <div class="ab-team-info">
                    <div class="ab-team-name"><?php echo esc_html($member['name'] ?? ''); ?></div>
                    <?php if (!empty($member['role'])) : ?>
                        <div class="ab-team-role"><?php echo esc_html($member['role']); ?></div>
                    <?php endif; ?>
                    <?php if (!empty($member['experience'])) : ?>
                        <div class="ab-team-exp"><?php echo esc_html($member['experience']); ?></div>
                    <?php endif; ?>
                    <?php if (!empty($member['bio'])) : ?>
                        <p class="ab-team-bio"><?php echo esc_html($member['bio']); ?></p>
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
            <h2 class="ab-cta-title"><?php echo esc_html($ab_cta_title); ?></h2>
            <p class="ab-cta-sub"><?php echo esc_html($ab_cta_sub); ?></p>
        </div>
        <div class="ab-cta-actions reveal reveal-delay-2">
            <?php if ($ab_cta_btn1_text) : ?>
            <a href="<?php echo esc_url($ab_cta_btn1_url ?: home_url('/courses')); ?>" class="btn btn-primary"><?php echo esc_html($ab_cta_btn1_text); ?></a>
            <?php endif; ?>
            <?php if ($ab_cta_btn2_text) : ?>
            <a href="<?php echo esc_url($ab_cta_btn2_url ?: home_url('/contact')); ?>" class="btn btn-outline"><?php echo esc_html($ab_cta_btn2_text); ?></a>
            <?php endif; ?>
        </div>
    </div>
</section>

<?php get_footer(); ?>
