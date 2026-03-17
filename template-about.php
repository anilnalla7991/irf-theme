<?php
/**
 * Template Name: About IRF
 */
get_header();

$ab_banner_title = (function_exists('get_field') ? get_field('about_banner_title') : '') ?: 'About IRF – IACE';
$ab_banner_sub   = (function_exists('get_field') ? get_field('about_banner_sub')   : '') ?: "India's #1 Competitive Exam Coaching Institute";
?>

<!-- ============================================================
     PAGE BANNER
     ============================================================ -->
<section class="page-banner">
    <div class="page-banner-bg"></div>
    <div class="container">
        <div class="page-banner-content">
            <h1 class="page-banner-title"><?php echo esc_html($ab_banner_title); ?></h1>
            <nav class="breadcrumb" aria-label="Breadcrumb">
                <a href="<?php echo esc_url(home_url('/')); ?>">Home</a>
                <span class="breadcrumb-sep">&#8250;</span>
                <span><?php echo esc_html($ab_banner_title); ?></span>
            </nav>
            <?php if ($ab_banner_sub) : ?>
            <p class="page-banner-subtitle"><?php echo esc_html($ab_banner_sub); ?></p>
            <?php endif; ?>
        </div>
    </div>
</section>


<!-- ============================================================
     INTRO SECTION
     ============================================================ -->
<?php
$ab_intro_tag   = (function_exists('get_field') ? get_field('about_intro_tag')   : '') ?: 'Who We Are';
$ab_intro_title = (function_exists('get_field') ? get_field('about_intro_title') : '') ?: 'IRF – IACE Result Factory';
$ab_intro_text  = (function_exists('get_field') ? get_field('about_intro_text')  : '') ?: '<p>IRF – IACE Result Factory is a premier competitive exam coaching institute based in Hyderabad. Since 2014, we have been dedicated to shaping successful government job careers through smart preparation, consistent practice, and expert mentorship.</p>';
$ab_intro_image = function_exists('get_field') ? get_field('about_intro_image') : null;
?>
<section class="section about-intro-section">
    <div class="container">
        <div class="about-intro-grid">
            <div class="about-intro-content reveal">
                <span class="section-tag"><?php echo esc_html($ab_intro_tag); ?></span>
                <h2 class="section-title" style="text-align:left"><?php echo esc_html($ab_intro_title); ?></h2>
                <div class="about-intro-text">
                    <?php echo wp_kses_post($ab_intro_text); ?>
                </div>
            </div>
            <?php if ($ab_intro_image) : ?>
            <div class="about-intro-image reveal reveal-delay-2">
                <img src="<?php echo esc_url(is_array($ab_intro_image) ? $ab_intro_image['url'] : $ab_intro_image); ?>"
                     alt="<?php echo esc_attr(is_array($ab_intro_image) ? $ab_intro_image['alt'] : $ab_intro_title); ?>">
            </div>
            <?php endif; ?>
        </div>
    </div>
</section>


<!-- ============================================================
     STATS SECTION
     ============================================================ -->
<?php
$ab_stats_tag   = (function_exists('get_field') ? get_field('about_stats_tag')   : '') ?: 'By The Numbers';
$ab_stats_title = (function_exists('get_field') ? get_field('about_stats_title') : '') ?: 'Our Impact';
$ab_stats_acf   = function_exists('get_field') ? get_field('about_stats') : array();
$ab_stats_def   = array(
    array('number' => 5000, 'suffix' => '+',      'label' => 'Students Enrolled'),
    array('number' => 1200, 'suffix' => '+',      'label' => 'Selections Made'),
    array('number' => 10,   'suffix' => '+ Yrs',  'label' => 'Experience'),
    array('number' => 98,   'suffix' => '%',       'label' => 'Success Rate'),
);
$ab_stats = (!empty($ab_stats_acf) && is_array($ab_stats_acf)) ? $ab_stats_acf : $ab_stats_def;
?>
<section class="section about-stats-section" style="background:var(--navy)">
    <div class="container">
        <div class="section-header reveal">
            <span class="section-tag"><?php echo esc_html($ab_stats_tag); ?></span>
            <h2 class="section-title"><?php echo esc_html($ab_stats_title); ?></h2>
        </div>
        <div class="hero-stats" style="justify-content:center; gap:48px; flex-wrap:wrap; margin-top:40px;">
            <?php foreach ($ab_stats as $stat) : ?>
            <div class="hero-stat reveal">
                <div class="hero-stat-number counter"
                     data-target="<?php echo esc_attr($stat['number']); ?>"
                     data-suffix="<?php echo esc_attr($stat['suffix']); ?>">0</div>
                <div class="hero-stat-label"><?php echo esc_html($stat['label']); ?></div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>


<!-- ============================================================
     MISSION & VISION
     ============================================================ -->
<?php
$ab_mission_icon  = (function_exists('get_field') ? get_field('about_mission_icon')  : '') ?: '🎯';
$ab_mission_title = (function_exists('get_field') ? get_field('about_mission_title') : '') ?: 'Our Mission';
$ab_mission_text  = (function_exists('get_field') ? get_field('about_mission_text')  : '') ?: 'To empower every aspiring government job candidate with world-class coaching, tools, and mentorship that maximize their selection probability.';
$ab_vision_icon   = (function_exists('get_field') ? get_field('about_vision_icon')   : '') ?: '🏆';
$ab_vision_title  = (function_exists('get_field') ? get_field('about_vision_title')  : '') ?: 'Our Vision';
$ab_vision_text   = (function_exists('get_field') ? get_field('about_vision_text')   : '') ?: 'To become the most trusted and results-driven competitive exam institute in South India, producing lakhs of government employees.';
?>
<section class="section about-mv-section">
    <div class="container">
        <div class="about-mv-grid">
            <div class="about-mv-card reveal reveal-delay-1">
                <div class="facility-icon" aria-hidden="true"><?php echo esc_html($ab_mission_icon); ?></div>
                <h3 class="facility-title"><?php echo esc_html($ab_mission_title); ?></h3>
                <p class="facility-desc"><?php echo esc_html($ab_mission_text); ?></p>
            </div>
            <div class="about-mv-card reveal reveal-delay-2">
                <div class="facility-icon" aria-hidden="true"><?php echo esc_html($ab_vision_icon); ?></div>
                <h3 class="facility-title"><?php echo esc_html($ab_vision_title); ?></h3>
                <p class="facility-desc"><?php echo esc_html($ab_vision_text); ?></p>
            </div>
        </div>
    </div>
</section>


<!-- ============================================================
     CORE VALUES
     ============================================================ -->
<?php
$ab_vals_tag   = (function_exists('get_field') ? get_field('about_values_tag')   : '') ?: 'What We Stand For';
$ab_vals_title = (function_exists('get_field') ? get_field('about_values_title') : '') ?: 'Our Core Values';
$ab_vals_acf   = function_exists('get_field') ? get_field('about_values') : array();
$ab_vals_def   = array(
    array('icon' => '💎', 'title' => 'Excellence',   'desc' => 'We set the highest standards in teaching quality, study material, and student support.'),
    array('icon' => '🤝', 'title' => 'Integrity',    'desc' => 'Honest performance feedback and transparent progress tracking for every student.'),
    array('icon' => '🔬', 'title' => 'Innovation',   'desc' => 'Continuously evolving our teaching methods, tools, and content to stay ahead.'),
    array('icon' => '❤️', 'title' => 'Student First','desc' => 'Every decision we make is driven by what is best for our students\' success.'),
);
$ab_values = (!empty($ab_vals_acf) && is_array($ab_vals_acf)) ? $ab_vals_acf : $ab_vals_def;
?>
<?php if (!empty($ab_values)) : ?>
<section class="section facilities-section">
    <div class="container">
        <div class="section-header reveal">
            <span class="section-tag"><?php echo esc_html($ab_vals_tag); ?></span>
            <h2 class="section-title"><?php echo esc_html($ab_vals_title); ?></h2>
        </div>
        <div class="facilities-grid">
            <?php foreach ($ab_values as $index => $val) : ?>
            <div class="facility-card reveal reveal-delay-<?php echo esc_attr(($index % 3) + 1); ?>">
                <div class="facility-icon" aria-hidden="true"><?php echo esc_html($val['icon']); ?></div>
                <h3 class="facility-title"><?php echo esc_html($val['title']); ?></h3>
                <p class="facility-desc"><?php echo esc_html($val['desc']); ?></p>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<?php endif; ?>


<!-- ============================================================
     TEAM SECTION
     ============================================================ -->
<?php
$ab_team_tag      = (function_exists('get_field') ? get_field('about_team_tag')      : '') ?: 'Our Experts';
$ab_team_title    = (function_exists('get_field') ? get_field('about_team_title')    : '') ?: 'Meet Our Expert Faculty';
$ab_team_subtitle = (function_exists('get_field') ? get_field('about_team_subtitle') : '') ?: 'Experienced mentors and subject matter experts dedicated to your success.';
$ab_team_acf      = function_exists('get_field') ? get_field('about_team') : array();
?>
<?php if (!empty($ab_team_acf) && is_array($ab_team_acf)) : ?>
<section class="section">
    <div class="container">
        <div class="section-header reveal">
            <span class="section-tag"><?php echo esc_html($ab_team_tag); ?></span>
            <h2 class="section-title"><?php echo esc_html($ab_team_title); ?></h2>
            <p class="section-subtitle"><?php echo esc_html($ab_team_subtitle); ?></p>
        </div>
        <div class="results-grid" style="grid-template-columns:repeat(auto-fill,minmax(220px,1fr))">
            <?php foreach ($ab_team_acf as $member) :
                $tm_photo = $member['photo'];
                $tm_name  = $member['name'];
                $tm_role  = $member['role'];
                $tm_exp   = $member['experience'];
                $tm_bio   = $member['bio'];
            ?>
            <div class="result-card reveal" style="text-align:center">
                <?php if ($tm_photo) : ?>
                    <img src="<?php echo esc_url(is_array($tm_photo) ? $tm_photo['url'] : $tm_photo); ?>"
                         alt="<?php echo esc_attr($tm_name); ?>" class="result-photo">
                <?php else : ?>
                    <div class="result-photo-placeholder">👨‍🏫</div>
                <?php endif; ?>
                <div class="result-info">
                    <div class="result-name"><?php echo esc_html($tm_name); ?></div>
                    <?php if ($tm_role) : ?>
                        <div class="result-exam"><?php echo esc_html($tm_role); ?></div>
                    <?php endif; ?>
                    <?php if ($tm_exp) : ?>
                        <div class="result-year"><?php echo esc_html($tm_exp); ?></div>
                    <?php endif; ?>
                    <?php if ($tm_bio) : ?>
                        <p style="font-size:13px; color:var(--gray); margin-top:8px; line-height:1.5"><?php echo esc_html($tm_bio); ?></p>
                    <?php endif; ?>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<?php endif; ?>

<?php get_footer(); ?>
