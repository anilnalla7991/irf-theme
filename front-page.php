<?php
get_header();

// Banner slides — fetched from the homepage page editor
$home_banners = function_exists('get_field') ? get_field('home_banners') : array();
?>

<?php if (!empty($home_banners) && is_array($home_banners)) : ?>
<!-- ============================================================
     BANNER SLIDER — Cinematic Edition
     ============================================================ -->
<section class="banner-slider" id="bannerSlider" aria-label="Homepage Banner">

    <!-- Slides -->
    <div class="banner-slides" id="bannerTrack">
        <?php
        foreach ($home_banners as $idx => $slide) :
            $desk_img  = $slide['image'];
            $desk_src  = is_array($desk_img) ? $desk_img['url'] : $desk_img;
            $desk_alt  = is_array($desk_img) ? $desk_img['alt'] : '';
            $mob_img   = !empty($slide['mobile_image']) ? $slide['mobile_image'] : $desk_img;
            $mob_src   = is_array($mob_img)  ? $mob_img['url']  : $mob_img;
            $desk_link = !empty($slide['link'])        ? $slide['link']        : '';
            $mob_link  = !empty($slide['mobile_link']) ? $slide['mobile_link'] : $desk_link;
            $is_first  = $idx === 0;
        ?>
        <div class="banner-slide<?php echo $is_first ? ' active' : ''; ?>">

            <!-- Desktop image -->
            <?php if ($desk_src) : ?>
            <div class="banner-img-wrap banner-desk-wrap">
                <?php if ($desk_link) : ?><a href="<?php echo esc_url($desk_link); ?>" tabindex="-1"><?php endif; ?>
                <img src="<?php echo esc_url($desk_src); ?>"
                     alt="<?php echo esc_attr($desk_alt); ?>"
                     class="banner-bg-img"
                     loading="<?php echo $is_first ? 'eager' : 'lazy'; ?>">
                <?php if ($desk_link) : ?></a><?php endif; ?>
            </div>
            <?php endif; ?>

            <!-- Mobile image -->
            <?php if ($mob_src) : ?>
            <div class="banner-img-wrap banner-mob-wrap">
                <?php if ($mob_link) : ?><a href="<?php echo esc_url($mob_link); ?>" tabindex="-1"><?php endif; ?>
                <img src="<?php echo esc_url($mob_src); ?>"
                     alt="<?php echo esc_attr(is_array($mob_img) ? $mob_img['alt'] : $desk_alt); ?>"
                     class="banner-bg-img"
                     loading="lazy">
                <?php if ($mob_link) : ?></a><?php endif; ?>
            </div>
            <?php endif; ?>

            <!-- Cinematic gradient overlay -->
            <div class="banner-overlay"></div>
        </div>
        <?php endforeach; ?>
    </div>

    <?php $total = count($home_banners); ?>

    <!-- Top progress bar -->
    <div class="banner-progress-track">
        <div class="banner-progress-fill" id="bannerProgress"></div>
    </div>

    <?php if ($total > 1) : ?>
    <!-- Prev / Next -->
    <button class="banner-nav banner-prev" aria-label="Previous slide">
        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="15 18 9 12 15 6"/></svg>
    </button>
    <button class="banner-nav banner-next" aria-label="Next slide">
        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="9 18 15 12 9 6"/></svg>
    </button>

    <!-- Bottom bar: counter + pill dots -->
    <div class="banner-footer">
        <div class="banner-counter">
            <span class="banner-curr" id="bannerCurrNum">01</span>
            <span class="banner-slash">/</span>
            <span class="banner-total"><?php echo esc_html(str_pad($total, 2, '0', STR_PAD_LEFT)); ?></span>
        </div>
        <div class="banner-dots" id="bannerDots">
            <?php for ($i = 0; $i < $total; $i++) : ?>
            <button class="banner-dot<?php echo $i === 0 ? ' active' : ''; ?>"
                    aria-label="Slide <?php echo esc_attr($i + 1); ?>"></button>
            <?php endfor; ?>
        </div>
    </div>
    <?php endif; ?>

</section>
<?php endif; ?>

<!-- ============================================================
     ANNOUNCEMENT TICKER
     ============================================================ -->
<?php
$hp_ticker_cats = array(
    'batches'   => array('label' => 'New Batches',    'color' => '#E07B00', 'types' => array('Batch')),
    'news'      => array('label' => 'Flash News',     'color' => '#CC1100', 'types' => array('Flash News', 'Notice')),
    'results'   => array('label' => 'Our Results',    'color' => '#1255A6', 'types' => array('Result')),
    'schedules' => array('label' => 'Live Schedules', 'color' => '#1A7A4A', 'types' => array('Schedule')),
);
$hp_ticker_by_cat = array('batches' => array(), 'news' => array(), 'results' => array(), 'schedules' => array());
$hp_ann_q = new WP_Query(array('post_type' => 'announcements', 'posts_per_page' => 60, 'post_status' => 'publish', 'orderby' => 'date', 'order' => 'DESC'));
if ($hp_ann_q->have_posts()) {
    while ($hp_ann_q->have_posts()) {
        $hp_ann_q->the_post();
        $hp_etype = function_exists('get_field') ? (string) get_field('event_type') : '';
        $hp_edate = function_exists('get_field') ? get_field('event_date') : '';
        $hp_item  = array('title' => get_the_title(), 'date' => $hp_edate);
        foreach ($hp_ticker_cats as $hp_key => $hp_cat) {
            foreach ($hp_cat['types'] as $hp_t) {
                if (strcasecmp(trim($hp_etype), $hp_t) === 0) { $hp_ticker_by_cat[$hp_key][] = $hp_item; break; }
            }
        }
    }
    wp_reset_postdata();
}
$hp_ticker_dummy = array(
    'batches'   => array(
        array('title' => 'New IBPS PO Batch starting 1st April 2026 @ Hyderabad (Morning & Evening)',   'date' => '01 Apr 2026'),
        array('title' => 'Bank Clerk / PO batch starts 15-Apr-2026 (6:30 am – 9:30 am) @ Hyderabad',   'date' => '15 Apr 2026'),
        array('title' => 'New Weekend Batch for working professionals — starts 5th April 2026',          'date' => '05 Apr 2026'),
        array('title' => 'RRB (ALP/TECHNICIAN/NTPC/GROUP-D/JE/RPF) Batch starts 13-Apr-2026',          'date' => '13 Apr 2026'),
    ),
    'news'      => array(
        array('title' => 'TS Police SI 2026 notification out — enroll now for dedicated batch',           'date' => ''),
        array('title' => 'APPSC Group-1 Prelims 2026 notification released — limited seats available',    'date' => ''),
        array('title' => 'SSC MTS 2026 exam dates announced — batch registrations open now',              'date' => ''),
        array('title' => 'Special doubt-clearing sessions every Saturday for all current batch students', 'date' => ''),
    ),
    'results'   => array(
        array('title' => 'SSC CGL 2025 Result — 42 IRF students selected! Congratulations!',             'date' => '20 Mar 2026'),
        array('title' => 'SBI PO 2025 — 18 IRF students cleared Mains. Full list inside.',               'date' => '15 Mar 2026'),
        array('title' => 'IBPS RRB-XIV Clerk Final Result — 31 IRF selections confirmed',                 'date' => '10 Mar 2026'),
        array('title' => 'TS Police SI 2025 Final Result — 27 IRF selections',                            'date' => '08 Mar 2026'),
    ),
    'schedules' => array(
        array('title' => 'IBPS PO Mains mock test schedule — April 2026 batch timetable released',        'date' => 'Apr 2026'),
        array('title' => 'SSC CPO 2026 live class schedule updated — check your batch calendar',          'date' => 'Apr 2026'),
        array('title' => 'RRB NTPC Group-D exam schedule released for Hyderabad centre',                  'date' => 'May 2026'),
        array('title' => 'APPSC Group-1 Prelims live schedule released for May 2026 batch',               'date' => 'May 2026'),
    ),
);
foreach ($hp_ticker_by_cat as $hp_key => $hp_items) {
    if (empty($hp_items)) $hp_ticker_by_cat[$hp_key] = $hp_ticker_dummy[$hp_key];
}
$hp_first_key   = array_key_first($hp_ticker_cats);
$hp_first_color = $hp_ticker_cats[$hp_first_key]['color'];
?>
<div class="irf-ticker-wrap">
    <div class="irf-ticker-bar" id="irfTickerBar" style="background:<?php echo esc_attr($hp_first_color); ?>">
        <div class="irf-ticker-live">
            <span class="irf-live-dot"></span> LIVE
        </div>
        <?php foreach ($hp_ticker_by_cat as $hp_key => $hp_items) :
            $hp_is_first = ($hp_key === $hp_first_key);
            $hp_looped   = array_merge($hp_items, $hp_items);
        ?>
        <div class="irf-ticker-track <?php echo $hp_is_first ? 'active' : ''; ?>" data-track="<?php echo esc_attr($hp_key); ?>">
            <div class="irf-ticker-inner">
                <?php foreach ($hp_looped as $hp_n => $hp_item) :
                    $hp_num = ($hp_n % count($hp_items)) + 1;
                ?>
                <span class="irf-tick-item">
                    <span class="irf-tick-num"><?php echo $hp_num; ?></span>
                    <?php echo esc_html($hp_item['title']); ?>
                    <?php if (!empty($hp_item['date'])) : ?>
                    <span class="irf-tick-date"><?php echo esc_html($hp_item['date']); ?></span>
                    <?php endif; ?>
                </span>
                <span class="irf-tick-sep" aria-hidden="true">|</span>
                <?php endforeach; ?>
            </div>
        </div>
        <?php endforeach; ?>
        <a href="<?php echo esc_url(home_url('/announcements')); ?>" class="irf-ticker-more">More &rsaquo;</a>
    </div>
</div>

<!-- ============================================================
     SECTION 1: HERO
     ============================================================ -->
<?php
$hero_badge      = irf_opt('hero_badge',          "India's #1 Competitive Exam Institute");
$hero_title      = irf_opt('hero_title',           'Crack Your Dream Exam with <span class="highlight">IRF – IACE</span>');
$hero_subtitle   = irf_opt('hero_subtitle',        'Smart preparation. Expert guidance. Proven results.');
$hero_typed_raw  = irf_opt('hero_typed_words',     "SSC CGL\nIBPS PO\nRBI Grade B\nSI Exam\nConstable\nRRB NTPC\nSBI PO");
$hero_typed      = array_filter(array_map('trim', explode("\n", $hero_typed_raw)));
$cta1_text       = irf_opt('hero_cta_primary_text','Enroll Now');
$cta1_url        = irf_opt('hero_cta_primary_url', home_url('/contact'));
$cta2_text       = irf_opt('hero_cta_sec_text',    'View Results');
$cta2_url        = irf_opt('hero_cta_sec_url',     home_url('/results'));
$stats = array(
    array('num' => irf_opt('stat1_number', 5000), 'suffix' => irf_opt('stat1_suffix', '+'),      'label' => irf_opt('stat1_label', 'Students Enrolled')),
    array('num' => irf_opt('stat2_number', 1200), 'suffix' => irf_opt('stat2_suffix', '+'),      'label' => irf_opt('stat2_label', 'Selections Made')),
    array('num' => irf_opt('stat3_number', 10),   'suffix' => irf_opt('stat3_suffix', '+ Yrs'), 'label' => irf_opt('stat3_label', 'Experience')),
    array('num' => irf_opt('stat4_number', 98),   'suffix' => irf_opt('stat4_suffix', '%'),      'label' => irf_opt('stat4_label', 'Success Rate')),
);
// Pass typed words to JS via data attribute
$typed_json = esc_attr(json_encode(array_values($hero_typed)));
?>
<section class="hero">
    <!-- Layered background -->
    <div class="hero-bg"></div>
    <div class="hero-orb hero-orb-1"></div>
    <div class="hero-orb hero-orb-2"></div>
    <div class="hero-orb hero-orb-3"></div>
    <div class="hero-grid"></div>

    <div class="container">
        <div class="hero-split">

            <!-- ── LEFT: Text content ── -->
            <div class="hero-left">
                <div class="hero-badge">
                    <span class="dot"></span>
                    <?php echo esc_html($hero_badge); ?>
                </div>
                <h1 class="hero-title">
                    <?php echo wp_kses($hero_title, array('span' => array('class' => array()))); ?>
                </h1>
                <p class="hero-subtitle"><?php echo esc_html($hero_subtitle); ?></p>
                <p class="hero-typed">We prepare you for <span class="typed-text" data-words="<?php echo $typed_json; ?>"><?php echo esc_html($hero_typed[0] ?? 'SSC CGL'); ?></span></p>
                <div class="hero-actions">
                    <a href="<?php echo esc_url($cta1_url); ?>" class="btn btn-primary"><?php echo esc_html($cta1_text); ?> &rarr;</a>
                    <a href="<?php echo esc_url($cta2_url); ?>" class="btn btn-outline"><?php echo esc_html($cta2_text); ?></a>
                </div>
                <div class="hero-features">
                    <span class="hero-feat"><span>✓</span> Practice Hall</span>
                    <span class="hero-feat"><span>✓</span> Computer Lab</span>
                    <span class="hero-feat"><span>✓</span> Mentor Guidance</span>
                </div>
            </div>

            <!-- ── RIGHT: Visual ── -->
            <div class="hero-right" id="heroVisual">

                <!-- Glow backdrop -->
                <div class="hero-glow-bg"></div>

                <!-- Central SVG ring — shows success rate -->
                <div class="hero-ring-wrap">
                    <svg class="ring-svg" viewBox="0 0 220 220" aria-hidden="true">
                        <circle class="ring-track" cx="110" cy="110" r="96"/>
                        <circle class="ring-fill"  cx="110" cy="110" r="96" id="ringFill"/>
                    </svg>
                    <div class="ring-center">
                        <span class="ring-number counter" data-target="<?php echo esc_attr($stats[3]['num']); ?>" data-suffix="<?php echo esc_attr($stats[3]['suffix']); ?>">0</span>
                        <span class="ring-label"><?php echo esc_html($stats[3]['label']); ?></span>
                    </div>
                </div>

                <!-- Glassmorphism stat cards -->
                <div class="stat-card stat-card-1">
                    <div class="stat-card-num counter" data-target="<?php echo esc_attr($stats[0]['num']); ?>" data-suffix="<?php echo esc_attr($stats[0]['suffix']); ?>">0</div>
                    <div class="stat-card-label"><?php echo esc_html($stats[0]['label']); ?></div>
                </div>
                <div class="stat-card stat-card-2">
                    <div class="stat-card-num counter" data-target="<?php echo esc_attr($stats[1]['num']); ?>" data-suffix="<?php echo esc_attr($stats[1]['suffix']); ?>">0</div>
                    <div class="stat-card-label"><?php echo esc_html($stats[1]['label']); ?></div>
                </div>
                <div class="stat-card stat-card-3">
                    <div class="stat-card-num counter" data-target="<?php echo esc_attr($stats[2]['num']); ?>" data-suffix="<?php echo esc_attr($stats[2]['suffix']); ?>">0</div>
                    <div class="stat-card-label"><?php echo esc_html($stats[2]['label']); ?></div>
                </div>

                <!-- Floating education icons -->
                <div class="float-icon float-icon-1" aria-hidden="true">🎓</div>
                <div class="float-icon float-icon-2" aria-hidden="true">📚</div>
                <div class="float-icon float-icon-3" aria-hidden="true">🏆</div>
                <div class="float-icon float-icon-4" aria-hidden="true">⭐</div>

            </div>
        </div>
    </div>

    <div class="scroll-indicator">
        <div class="scroll-mouse"><div class="scroll-wheel"></div></div>
        <span>Scroll Down</span>
    </div>
</section>


<!-- ============================================================
     SECTION 2: EXAMS WE PREPARE FOR
     ============================================================ -->
<?php
$exams_tag      = irf_opt('exams_tag',      'What We Teach');
$exams_title    = irf_opt('exams_title',    'Exams We Prepare For');
$exams_subtitle = irf_opt('exams_subtitle', 'Comprehensive coaching for all major government competitive exams across India.');
$exams_acf      = function_exists('get_field') ? get_field('exams_list', 'option') : array();
$exams_default  = array(
    array('icon' => '📋', 'name' => 'SSC CGL',    'full' => 'Combined Graduate Level'),
    array('icon' => '📄', 'name' => 'SSC CHSL',   'full' => 'Combined Higher Secondary'),
    array('icon' => '🏦', 'name' => 'IBPS PO',    'full' => 'Probationary Officer'),
    array('icon' => '💳', 'name' => 'IBPS Clerk', 'full' => 'Clerical Cadre'),
    array('icon' => '🏛️', 'name' => 'RBI Grade B','full' => 'Reserve Bank of India'),
    array('icon' => '👮', 'name' => 'SI Exam',    'full' => 'Sub Inspector'),
    array('icon' => '🚔', 'name' => 'Constable',  'full' => 'Police Constable'),
    array('icon' => '🚂', 'name' => 'RRB NTPC',   'full' => 'Railway Recruitment Board'),
    array('icon' => '📊', 'name' => 'SBI PO',     'full' => 'State Bank of India'),
    array('icon' => '⚖️', 'name' => 'NABARD',     'full' => 'Agriculture Bank'),
);
$exams = (!empty($exams_acf) && is_array($exams_acf)) ? $exams_acf : $exams_default;
?>
<section class="section exams-section">
    <div class="container">
        <div class="section-header reveal">
            <span class="section-tag"><?php echo esc_html($exams_tag); ?></span>
            <h2 class="section-title"><?php echo esc_html($exams_title); ?></h2>
            <p class="section-subtitle"><?php echo esc_html($exams_subtitle); ?></p>
        </div>
        <div class="exams-grid">
            <?php foreach ($exams as $index => $exam) : ?>
            <div class="exam-card reveal reveal-delay-<?php echo esc_attr(min($index + 1, 4)); ?>">
                <div class="exam-icon"><span aria-hidden="true"><?php echo esc_html($exam['icon']); ?></span></div>
                <div class="exam-name"><?php echo esc_html($exam['name']); ?></div>
                <div class="exam-full"><?php echo esc_html($exam['full']); ?></div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>


<!-- ============================================================
     SECTION 3: IRF LEARNING MODEL
     ============================================================ -->
<?php
$learn_tag      = irf_opt('learning_tag',      'Our Methodology');
$learn_title    = irf_opt('learning_title',    'The IRF Learning Model');
$learn_subtitle = irf_opt('learning_subtitle', 'A proven 4-step framework that has produced thousands of government job selections.');
$learn_acf      = function_exists('get_field') ? get_field('learning_steps', 'option') : array();
$learn_default  = array(
    array('icon' => '📝', 'title' => 'Practice', 'desc' => 'Daily mock tests, previous year papers and topic-wise drills to build exam readiness.'),
    array('icon' => '🔍', 'title' => 'Analyze',  'desc' => 'Detailed performance analytics to identify weak areas and track your progress scientifically.'),
    array('icon' => '🎯', 'title' => 'Improve',  'desc' => 'Targeted sessions with expert mentors to close gaps and strengthen your core concepts.'),
    array('icon' => '🏆', 'title' => 'Perform',  'desc' => 'Full-length simulated exams in CBT format to build speed, accuracy and exam-day confidence.'),
);
$learn_steps = (!empty($learn_acf) && is_array($learn_acf)) ? $learn_acf : $learn_default;
?>
<section class="section learning-section">
    <div class="container">
        <div class="section-header reveal">
            <span class="section-tag"><?php echo esc_html($learn_tag); ?></span>
            <h2 class="section-title"><?php echo esc_html($learn_title); ?></h2>
            <p class="section-subtitle"><?php echo esc_html($learn_subtitle); ?></p>
        </div>
        <div class="learning-steps">
            <?php foreach ($learn_steps as $i => $step) : ?>
            <div class="learning-step reveal reveal-delay-<?php echo esc_attr(min($i + 1, 4)); ?>">
                <div class="step-number"><span class="step-icon" aria-hidden="true"><?php echo esc_html($step['icon']); ?></span></div>
                <h3 class="step-title"><?php echo esc_html($step['title']); ?></h3>
                <p class="step-desc"><?php echo esc_html($step['desc']); ?></p>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>


<!-- ============================================================
     SECTION 4: FACILITIES
     ============================================================ -->
<?php
$fac_tag      = irf_opt('facilities_tag',      'World-Class Infrastructure');
$fac_title    = irf_opt('facilities_title',    'Our Facilities');
$fac_subtitle = irf_opt('facilities_subtitle', 'Everything you need to prepare, practice and perform — all under one roof.');
$fac_acf      = function_exists('get_field') ? get_field('facilities_list', 'option') : array();
$fac_default  = array(
    array('icon' => '🏛️', 'title' => 'Practice Hall',       'desc' => 'Spacious, air-conditioned study halls designed for focused, distraction-free learning with seating for 200+ students.'),
    array('icon' => '💻', 'title' => 'CBT Lab',             'desc' => 'State-of-the-art computer-based testing lab with 100+ systems simulating the exact real exam environment.'),
    array('icon' => '👨‍🏫', 'title' => 'Expert Mentorship',  'desc' => 'One-on-one mentoring sessions with experienced faculty who are former toppers and subject matter experts.'),
    array('icon' => '📊', 'title' => 'Mock Tests',          'desc' => 'Weekly full-length mock exams with instant analysis, rankings and detailed score breakdowns.'),
    array('icon' => '📈', 'title' => 'Performance Analysis','desc' => 'AI-powered analytics dashboard to track strengths, weaknesses and daily improvement metrics.'),
    array('icon' => '🗺️', 'title' => 'Exam Strategy',       'desc' => 'Customized study plans, time management workshops and last-mile revision strategies for every exam.'),
);
$facilities = (!empty($fac_acf) && is_array($fac_acf)) ? $fac_acf : $fac_default;
?>
<section class="section facilities-section">
    <div class="container">
        <div class="section-header reveal">
            <span class="section-tag"><?php echo esc_html($fac_tag); ?></span>
            <h2 class="section-title"><?php echo esc_html($fac_title); ?></h2>
            <p class="section-subtitle"><?php echo esc_html($fac_subtitle); ?></p>
        </div>
        <div class="facilities-grid">
            <?php foreach ($facilities as $index => $facility) : ?>
            <div class="facility-card reveal reveal-delay-<?php echo esc_attr(($index % 3) + 1); ?>">
                <div class="facility-card-line" aria-hidden="true"></div>
                <div class="facility-icon-wrap">
                    <span class="facility-icon" aria-hidden="true"><?php echo esc_html($facility['icon']); ?></span>
                </div>
                <h3 class="facility-title"><?php echo esc_html($facility['title']); ?></h3>
                <p class="facility-desc"><?php echo esc_html($facility['desc']); ?></p>
                <div class="facility-glow" aria-hidden="true"></div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>


<!-- ============================================================
     SECTION 5: RESULTS (CPT)
     ============================================================ -->
<section class="section results-section">
    <div class="container">
        <div class="section-header reveal">
            <span class="section-tag"><?php echo esc_html(irf_opt('results_tag',      'Proven Track Record')); ?></span>
            <h2 class="section-title"><?php echo esc_html(irf_opt('results_title',    'Our Toppers')); ?></h2>
            <p class="section-subtitle"><?php echo esc_html(irf_opt('results_subtitle','Real students. Real results. Selections across every major competitive exam.')); ?></p>
        </div>
        <div class="results-grid">
            <?php
            $results_query = new WP_Query(array(
                'post_type'      => 'results',
                'posts_per_page' => 8,
                'post_status'    => 'publish',
                'orderby'        => 'date',
                'order'          => 'DESC',
            ));

            if ($results_query->have_posts()) :
                while ($results_query->have_posts()) : $results_query->the_post();
                    $student_name  = function_exists('get_field') ? get_field('student_name')  : get_the_title();
                    $exam_name     = function_exists('get_field') ? get_field('exam_name')      : '';
                    $rank          = function_exists('get_field') ? get_field('rank')           : '';
                    $year          = function_exists('get_field') ? get_field('year')           : '';
                    $student_photo = function_exists('get_field') ? get_field('student_photo')  : null;
            ?>
            <div class="result-card reveal">
                <?php if ($student_photo) : ?>
                    <img src="<?php echo esc_url(is_array($student_photo) && isset($student_photo['url']) ? $student_photo['url'] : $student_photo); ?>" alt="<?php echo esc_attr($student_name); ?>" class="result-photo">
                <?php elseif (has_post_thumbnail()) : ?>
                    <?php the_post_thumbnail('medium', array('class' => 'result-photo')); ?>
                <?php else : ?>
                    <div class="result-photo-placeholder">🎓</div>
                <?php endif; ?>
                <div class="result-info">
                    <?php if ($rank) : ?>
                        <span class="result-rank">Rank <?php echo esc_html($rank); ?></span>
                    <?php endif; ?>
                    <div class="result-name"><?php echo esc_html($student_name); ?></div>
                    <?php if ($exam_name) : ?>
                        <div class="result-exam"><?php echo esc_html($exam_name); ?></div>
                    <?php endif; ?>
                    <?php if ($year) : ?>
                        <div class="result-year"><?php echo esc_html($year); ?></div>
                    <?php endif; ?>
                </div>
            </div>
            <?php
                endwhile;
                wp_reset_postdata();
            else :
            ?>
            <div class="no-results">
                <p>Results coming soon. Our toppers will be featured here!</p>
            </div>
            <?php endif; ?>
        </div>
        <div style="text-align:center; margin-top:48px;">
            <a href="<?php echo esc_url(home_url('/results')); ?>" class="btn btn-primary"><?php echo esc_html(irf_opt('results_btn_text', 'View All Results')); ?> &rarr;</a>
        </div>
    </div>
</section>


<!-- ============================================================
     SECTION 6: SUCCESS STORIES CAROUSEL (CPT)
     ============================================================ -->
<section class="section stories-section">
    <div class="container">
        <div class="section-header reveal">
            <span class="section-tag"><?php echo esc_html(irf_opt('stories_tag',      'Student Stories')); ?></span>
            <h2 class="section-title"><?php echo esc_html(irf_opt('stories_title',    'What Our Students Say')); ?></h2>
            <p class="section-subtitle stories-subtitle"><?php echo esc_html(irf_opt('stories_subtitle', 'Real voices. Real results. Students who cracked government exams with IRF – IACE.')); ?></p>
        </div>
        <div class="stories-carousel reveal">
            <div class="stories-track" id="storiesTrack">
                <?php
                $avatar_classes = array('story-avatar-1','story-avatar-2','story-avatar-3','story-avatar-4');
                $stories_query = new WP_Query(array(
                    'post_type'      => 'success_stories',
                    'posts_per_page' => 8,
                    'post_status'    => 'publish',
                ));

                if ($stories_query->have_posts()) :
                    $s_i = 0;
                    while ($stories_query->have_posts()) : $stories_query->the_post();
                        $s_name    = function_exists('get_field') ? get_field('student_name')    : get_the_title();
                        $s_exam    = function_exists('get_field') ? get_field('exam_cleared')    : '';
                        $s_rank    = function_exists('get_field') ? get_field('rank')            : '';
                        $s_msg     = function_exists('get_field') ? get_field('student_message') : get_the_excerpt();
                        $s_photo   = function_exists('get_field') ? get_field('student_photo')   : null;
                        $name_parts = explode(' ', trim($s_name));
                        $initials   = strtoupper(substr($name_parts[0], 0, 1) . (isset($name_parts[1]) ? substr($name_parts[1], 0, 1) : ''));
                        $av_class   = $avatar_classes[$s_i % 4];
                        $s_i++;
                ?>
                <div class="story-card">
                    <span class="story-quote-icon">&ldquo;</span>
                    <p class="story-message"><?php echo esc_html($s_msg); ?></p>
                    <div class="story-stars">&#9733;&#9733;&#9733;&#9733;&#9733;</div>
                    <div class="story-sep"></div>
                    <div class="story-footer">
                        <?php if ($s_photo) : ?>
                            <img src="<?php echo esc_url(is_array($s_photo) && isset($s_photo['url']) ? $s_photo['url'] : $s_photo); ?>" alt="<?php echo esc_attr($s_name); ?>" class="story-photo">
                        <?php elseif (has_post_thumbnail()) : ?>
                            <?php the_post_thumbnail('thumbnail', array('class' => 'story-photo')); ?>
                        <?php else : ?>
                            <div class="story-avatar <?php echo esc_attr($av_class); ?>"><?php echo esc_html($initials); ?></div>
                        <?php endif; ?>
                        <div class="story-info">
                            <div class="story-name"><?php echo esc_html($s_name); ?></div>
                            <?php if ($s_exam) : ?>
                                <div class="story-exam"><?php echo esc_html($s_exam); ?></div>
                            <?php endif; ?>
                        </div>
                        <?php if ($s_rank) : ?>
                            <div class="story-rank-pill">&#127942; Rank <?php echo esc_html($s_rank); ?></div>
                        <?php endif; ?>
                    </div>
                </div>
                <?php
                    endwhile;
                    wp_reset_postdata();
                else :
                    $placeholders = array(
                        array('name' => 'Rahul Sharma',  'initials' => 'RS', 'av' => 'story-avatar-1', 'exam' => 'SSC CGL 2023',    'rank' => '142', 'msg' => 'IRF\'s structured approach and daily mock tests helped me crack SSC CGL in my very first attempt. The faculty mentorship here is truly world-class.'),
                        array('name' => 'Priya Reddy',   'initials' => 'PR', 'av' => 'story-avatar-2', 'exam' => 'IBPS PO 2023',    'rank' => '87',  'msg' => 'The performance analysis system at IRF showed me exactly where I was going wrong. Cleared IBPS PO with a top rank — couldn\'t have done it without IRF!'),
                        array('name' => 'Kiran Kumar',   'initials' => 'KK', 'av' => 'story-avatar-3', 'exam' => 'SI Exam 2023',    'rank' => '23',  'msg' => 'Joined IRF with zero coaching experience. The step-by-step IRF learning model made every concept crystal clear. Proud SI now!'),
                        array('name' => 'Sneha Patel',   'initials' => 'SP', 'av' => 'story-avatar-4', 'exam' => 'RBI Grade B 2023','rank' => '56',  'msg' => 'The CBT lab at IRF was a game changer. I practised in the exact same environment as the real exam. Cleared RBI Grade B on my first try!'),
                        array('name' => 'Arjun Singh',   'initials' => 'AS', 'av' => 'story-avatar-1', 'exam' => 'RRB NTPC 2023',   'rank' => '34',  'msg' => 'The weekly mock tests and instant analytics at IRF helped me improve my score by 40 marks in just 3 months. Best investment of my life.'),
                        array('name' => 'Divya Nair',    'initials' => 'DN', 'av' => 'story-avatar-2', 'exam' => 'SBI PO 2023',     'rank' => '61',  'msg' => 'IRF\'s exam strategy workshops gave me a clear plan for every section. Cleared SBI PO in my second attempt with a massive improvement. Thank you IRF!'),
                    );
                    foreach ($placeholders as $p) :
                ?>
                <div class="story-card">
                    <span class="story-quote-icon">&ldquo;</span>
                    <p class="story-message"><?php echo esc_html($p['msg']); ?></p>
                    <div class="story-stars">&#9733;&#9733;&#9733;&#9733;&#9733;</div>
                    <div class="story-sep"></div>
                    <div class="story-footer">
                        <div class="story-avatar <?php echo esc_attr($p['av']); ?>"><?php echo esc_html($p['initials']); ?></div>
                        <div class="story-info">
                            <div class="story-name"><?php echo esc_html($p['name']); ?></div>
                            <div class="story-exam"><?php echo esc_html($p['exam']); ?></div>
                        </div>
                        <div class="story-rank-pill">&#127942; Rank <?php echo esc_html($p['rank']); ?></div>
                    </div>
                </div>
                <?php endforeach; endif; ?>
            </div>
        </div>
        <div class="carousel-controls">
            <button class="carousel-btn prev" aria-label="Previous">&#8592;</button>
            <div class="carousel-dots" id="carouselDots"></div>
            <button class="carousel-btn next" aria-label="Next">&#8594;</button>
        </div>
    </div>
</section>


<!-- ============================================================
     SECTION 7: ANNOUNCEMENTS / EVENTS (CPT)
     ============================================================ -->
<section class="section announcements-section">
    <div class="container">
        <div class="section-header reveal">
            <span class="section-tag"><?php echo esc_html(irf_opt('ann_tag',      'Stay Updated')); ?></span>
            <h2 class="section-title"><?php echo esc_html(irf_opt('ann_title',    'Latest Announcements')); ?></h2>
            <p class="section-subtitle"><?php echo esc_html(irf_opt('ann_subtitle','Upcoming events, exam schedules and important notifications from IRF.')); ?></p>
        </div>
        <div class="announcements-grid">
            <?php
            $announcements_query = new WP_Query(array(
                'post_type'      => 'announcements',
                'posts_per_page' => 6,
                'post_status'    => 'publish',
                'orderby'        => 'date',
                'order'          => 'DESC',
            ));

            if ($announcements_query->have_posts()) :
                while ($announcements_query->have_posts()) : $announcements_query->the_post();
                    $event_date  = function_exists('get_field') ? get_field('event_date')        : '';
                    $event_type  = function_exists('get_field') ? get_field('event_type')        : 'Event';
                    $event_desc  = function_exists('get_field') ? get_field('event_description') : get_the_excerpt();
                    $event_image = function_exists('get_field') ? get_field('event_image')       : null;
            ?>
            <div class="announcement-card reveal">
                <?php if ($event_image) : ?>
                    <img src="<?php echo esc_url(is_array($event_image) && isset($event_image['url']) ? $event_image['url'] : $event_image); ?>" alt="<?php echo esc_attr(get_the_title()); ?>" class="announcement-image">
                <?php elseif (has_post_thumbnail()) : ?>
                    <?php the_post_thumbnail('medium_large', array('class' => 'announcement-image')); ?>
                <?php else : ?>
                    <div class="announcement-image-placeholder">📢</div>
                <?php endif; ?>
                <div class="announcement-body">
                    <div class="announcement-meta">
                        <span class="announcement-type"><?php echo esc_html($event_type ?: 'Event'); ?></span>
                        <?php if ($event_date) : ?>
                            <span class="announcement-date">📅 <?php echo esc_html($event_date); ?></span>
                        <?php endif; ?>
                    </div>
                    <h3 class="announcement-title"><?php echo esc_html(get_the_title()); ?></h3>
                    <?php if ($event_desc) : ?>
                        <p class="announcement-desc"><?php echo esc_html(wp_trim_words($event_desc, 20)); ?></p>
                    <?php endif; ?>
                    <a href="<?php echo esc_url(get_permalink()); ?>" class="announcement-link">Read More &#8594;</a>
                </div>
            </div>
            <?php
                endwhile;
                wp_reset_postdata();
            else :
            ?>
            <div class="no-results" style="grid-column:1/-1; text-align:center; color:var(--gray); padding:40px 0;">
                <p>No announcements yet. Check back soon!</p>
            </div>
            <?php endif; ?>
        </div>
        <div style="text-align:center; margin-top:48px;">
            <a href="<?php echo esc_url(home_url('/announcements')); ?>" class="btn btn-primary"><?php echo esc_html(irf_opt('ann_btn_text', 'View All Announcements')); ?> &rarr;</a>
        </div>
    </div>
</section>


<!-- ============================================================
     SECTION 8: YOUTUBE REELS AUTO-SCROLL
     ============================================================ -->
<?php
// Read from homepage page editor fields
$reels_tag      = function_exists('get_field') ? (get_field('reels_tag')      ?: 'Watch & Learn')    : 'Watch & Learn';
$reels_title    = function_exists('get_field') ? (get_field('reels_title')    ?: 'IRF on YouTube')   : 'IRF on YouTube';
$reels_subtitle = function_exists('get_field') ? (get_field('reels_subtitle') ?: 'Quick exam tips, success stories and strategies — straight from our YouTube channel.') : 'Quick exam tips, success stories and strategies — straight from our YouTube channel.';
$reels_acf      = function_exists('get_field') ? get_field('home_youtube_videos') : array();
$youtube_reels  = array();
if (!empty($reels_acf) && is_array($reels_acf)) {
    foreach ($reels_acf as $row) {
        if (!empty($row['video_id'])) {
            $youtube_reels[] = sanitize_text_field($row['video_id']);
        }
    }
}
?>
<section class="section reels-section">
    <div class="container">
        <div class="section-header reveal">
            <span class="section-tag"><?php echo esc_html($reels_tag); ?></span>
            <h2 class="section-title"><?php echo esc_html($reels_title); ?></h2>
            <p class="section-subtitle"><?php echo esc_html($reels_subtitle); ?></p>
        </div>
    </div>
    <div class="reels-track-wrapper">
        <div class="reels-track" id="reelsTrack">
            <?php if (!empty($youtube_reels)) :
                $all_reels = array_merge($youtube_reels, $youtube_reels);
                foreach ($all_reels as $video_id) : ?>
            <div class="reel-item">
                <div class="reel-embed">
                    <iframe src="https://www.youtube.com/embed/<?php echo esc_attr($video_id); ?>?rel=0&modestbranding=1" loading="lazy" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                </div>
            </div>
            <?php endforeach; else :
                for ($i = 0; $i < 10; $i++) : ?>
            <div class="reel-item">
                <div class="reel-placeholder">
                    <div class="reel-play-icon">&#9654;</div>
                    <span>IRF Short #<?php echo esc_html($i + 1); ?></span>
                    <small>Add YouTube IDs in IRF Settings → YouTube Reels</small>
                </div>
            </div>
            <?php endfor; endif; ?>
        </div>
    </div>
</section>


<!-- ============================================================
     SECTION 9: CALL TO ACTION
     ============================================================ -->
<?php
$cta_title     = irf_opt('cta_title',      'Ready to Start Your Government Job Journey?');
$cta_subtitle  = irf_opt('cta_subtitle',   'Join 5,000+ students who trusted IRF and got selected. Your turn is next.');
$cta_btn1_text = irf_opt('cta_btn1_text',  'Enroll Now');
$cta_btn1_url  = irf_opt('cta_btn1_url',   home_url('/contact'));
$cta_btn2_text = irf_opt('cta_btn2_text',  'Call Us Now');
$cta_phone     = irf_opt('cta_btn2_phone', '+919876543210');
?>
<section class="section cta-section">
    <div class="container">
        <div class="cta-content reveal">
            <h2 class="cta-title"><?php echo esc_html($cta_title); ?></h2>
            <p class="cta-subtitle"><?php echo esc_html($cta_subtitle); ?></p>
            <div class="cta-actions">
                <a href="<?php echo esc_url($cta_btn1_url); ?>" class="btn btn-white"><?php echo esc_html($cta_btn1_text); ?> &rarr;</a>
                <a href="tel:<?php echo esc_attr(preg_replace('/\s+/', '', $cta_phone)); ?>" class="btn btn-outline">📞 <?php echo esc_html($cta_btn2_text); ?></a>
            </div>
        </div>
    </div>
</section>

<?php get_footer(); ?>
