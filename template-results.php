<?php
/**
 * Template Name: Results
 */


get_header();
$fn      = 'get_field';
$has_acf = function_exists($fn);

/* ── ACF: Banner slides ─────────────────────────────────────────── */
$rb_slides = ($has_acf ? get_field('results_banners') : null) ?: array();
if (empty($rb_slides)) {
    $rb_slides = array(
        array(
            'rb_badge'       => 'Proven Track Record',
            'rb_title'       => "Our Toppers.\nProven Results.",
            'rb_subtitle'    => 'Every rank. Every exam. Every year. IRF students dominate every major competitive exam in the country.',
            'rb_stat1_num'   => '5000', 'rb_stat1_sfx' => '+', 'rb_stat1_lbl' => 'Selections',
            'rb_stat2_num'   => '50',   'rb_stat2_sfx' => '+', 'rb_stat2_lbl' => 'Exams Covered',
            'rb_stat3_num'   => '10',   'rb_stat3_sfx' => '+', 'rb_stat3_lbl' => 'Years',
            'rb_fx'          => 'diagonal',
            'rb_theme'       => 'dark-red',
            'rb_decoration'  => 'trophy',
            'rb_bg_image'    => null,
        ),
        array(
            'rb_badge'       => 'Latest Highlights',
            'rb_title'       => "Record Selections\nin 2025",
            'rb_subtitle'    => 'Our biggest year yet — hundreds of students cleared SSC, Banking, Railway, Police & State exams.',
            'rb_stat1_num'   => 'All India', 'rb_stat1_sfx' => '', 'rb_stat1_lbl' => 'Toppers',
            'rb_stat2_num'   => 'Rank #1',   'rb_stat2_sfx' => '', 'rb_stat2_lbl' => 'Multiple Exams',
            'rb_stat3_num'   => 'State',     'rb_stat3_sfx' => '', 'rb_stat3_lbl' => 'Top 10 Holders',
            'rb_fx'          => 'iris',
            'rb_theme'       => 'dark-purple',
            'rb_decoration'  => 'year-highlight',
            'rb_bg_image'    => null,
        ),
        array(
            'rb_badge'       => '50+ Exams Covered',
            'rb_title'       => "Every Major Exam.\nEvery Rank.",
            'rb_subtitle'    => 'From SSC CGL to RBI Grade B — our students have cracked them all with top ranks and state merit positions.',
            'rb_stat1_num'   => 'SSC',     'rb_stat1_sfx' => '', 'rb_stat1_lbl' => 'CGL / CHSL / MTS',
            'rb_stat2_num'   => 'Banking', 'rb_stat2_sfx' => '', 'rb_stat2_lbl' => 'IBPS / SBI / RBI',
            'rb_stat3_num'   => 'Railway', 'rb_stat3_sfx' => '', 'rb_stat3_lbl' => 'RRB / NTPC',
            'rb_fx'          => 'slide-x',
            'rb_theme'       => 'dark-teal',
            'rb_decoration'  => 'exam-pills',
            'rb_bg_image'    => null,
        ),
    );
}
$slide_count = count($rb_slides);

/* ── ACF: Stats strip ───────────────────────────────────────────── */
$stats = array(
    array(
        'icon' => '🏆',
        'num'  => $has_acf ? (get_field('results_stat1_num') ?: '5000') : '5000',
        'sfx'  => $has_acf ? (get_field('results_stat1_sfx') ?: '+')    : '+',
        'lbl'  => $has_acf ? (get_field('results_stat1_lbl') ?: 'Total Selections') : 'Total Selections',
    ),
    array(
        'icon' => '📋',
        'num'  => $has_acf ? (get_field('results_stat2_num') ?: '50')   : '50',
        'sfx'  => $has_acf ? (get_field('results_stat2_sfx') ?: '+')    : '+',
        'lbl'  => $has_acf ? (get_field('results_stat2_lbl') ?: 'Exams Covered') : 'Exams Covered',
    ),
    array(
        'icon' => '📅',
        'num'  => $has_acf ? (get_field('results_stat3_num') ?: '10')   : '10',
        'sfx'  => $has_acf ? (get_field('results_stat3_sfx') ?: '+')    : '+',
        'lbl'  => $has_acf ? (get_field('results_stat3_lbl') ?: 'Years of Results') : 'Years of Results',
    ),
    array(
        'icon' => '⭐',
        'num'  => $has_acf ? (get_field('results_stat4_num') ?: '98')   : '98',
        'sfx'  => $has_acf ? (get_field('results_stat4_sfx') ?: '%')    : '%',
        'lbl'  => $has_acf ? (get_field('results_stat4_lbl') ?: 'Success Rate') : 'Success Rate',
    ),
);

/* ── ACF: Section headers ───────────────────────────────────────── */
$yr_tag      = $has_acf ? (get_field('results_yr_tag')      ?: 'Year by Year')                                    : 'Year by Year';
$yr_title    = $has_acf ? (get_field('results_yr_title')    ?: 'Results Timeline')                                : 'Results Timeline';
$yr_subtitle = $has_acf ? (get_field('results_yr_subtitle') ?: 'Our consistent selection record year after year.') : 'Our consistent selection record year after year.';

$ex_tag      = $has_acf ? (get_field('results_ex_tag')      ?: 'All Categories')                                  : 'All Categories';
$ex_title    = $has_acf ? (get_field('results_ex_title')    ?: 'Browse by Exam')                                  : 'Browse by Exam';
$ex_subtitle = $has_acf ? (get_field('results_ex_subtitle') ?: 'Filter results by exam category to find toppers in your target exam.') : 'Filter results by exam category to find toppers in your target exam.';

/* ── ACF: Reels (from homepage) ─────────────────────────────────── */
$home_id       = (int) get_option('page_on_front');
$reels_acf     = ($has_acf && $home_id) ? get_field('home_youtube_videos', $home_id) : array();
$youtube_reels = array();
if (!empty($reels_acf) && is_array($reels_acf)) {
    foreach ($reels_acf as $row) {
        if (!empty($row['video_id'])) $youtube_reels[] = sanitize_text_field($row['video_id']);
    }
}

/* ── Query all published results ────────────────────────────────── */
$rq = new WP_Query(array(
    'post_type'      => 'results',
    'posts_per_page' => -1,
    'post_status'    => 'publish',
    'orderby'        => 'date',
    'order'          => 'DESC',
));
$all_results = array();
$years_set   = array();
$exams_set   = array();

if ($rq->have_posts()) {
    while ($rq->have_posts()) : $rq->the_post();
        $sname     = ($has_acf ? get_field('student_name')  : null) ?: get_the_title();
        $exam      = $has_acf ? (get_field('exam_name') ?: '')  : '';
        $year      = $has_acf ? (get_field('year')       ?: '')  : '';
        $sphoto    = $has_acf ? get_field('student_photo')       : null;
        $photo_url = '';
        if ($sphoto)                   $photo_url = is_array($sphoto) ? $sphoto['url'] : $sphoto;
        elseif (has_post_thumbnail())  $photo_url = get_the_post_thumbnail_url(null, 'medium');

        $ht_no     = $has_acf ? (get_field('ht_no') ?: '')  : '';
        $all_results[] = array('sname' => $sname, 'exam' => $exam, 'year' => $year, 'photo_url' => $photo_url, 'ht_no' => $ht_no);
        if ($year && !in_array($year, $years_set)) $years_set[] = $year;
        if ($exam && !in_array($exam, $exams_set)) $exams_set[] = $exam;
    endwhile;
    wp_reset_postdata();
}
rsort($years_set);

/* ── Demo fallback (shown when no CPT data exists) ──────────────── */
if (empty($all_results)) {
    $all_results = array(
        array('sname' => 'Ravi Kumar',    'exam' => 'SSC CGL',     'year' => '2025', 'photo_url' => '', 'ht_no' => 'HT2025001234'),
        array('sname' => 'Priya Reddy',   'exam' => 'RBI Grade B', 'year' => '2025', 'photo_url' => '', 'ht_no' => 'HT2025005678'),
        array('sname' => 'Kiran Babu',    'exam' => 'SI Police',   'year' => '2025', 'photo_url' => '', 'ht_no' => 'HT2025009012'),
        array('sname' => 'Anand Sharma',  'exam' => 'RRB NTPC',    'year' => '2025', 'photo_url' => '', 'ht_no' => 'HT2025003456'),
        array('sname' => 'Deepa Rao',     'exam' => 'IBPS PO',     'year' => '2025', 'photo_url' => '', 'ht_no' => 'HT2025007890'),
        array('sname' => 'Suresh Nair',   'exam' => 'SSC CHSL',    'year' => '2025', 'photo_url' => '', 'ht_no' => 'HT2025002345'),
        array('sname' => 'Lakshmi V',     'exam' => 'SBI PO',      'year' => '2025', 'photo_url' => '', 'ht_no' => 'HT2025006789'),
        array('sname' => 'Sneha Mehta',   'exam' => 'SSC CGL',     'year' => '2025', 'photo_url' => '', 'ht_no' => 'HT2025001111'),
        array('sname' => 'Raj Mohan',     'exam' => 'RBI Grade B', 'year' => '2024', 'photo_url' => '', 'ht_no' => 'HT2024004321'),
        array('sname' => 'Meena Kumari',  'exam' => 'SSC CGL',     'year' => '2024', 'photo_url' => '', 'ht_no' => 'HT2024008765'),
        array('sname' => 'Arjun Singh',   'exam' => 'SI Police',   'year' => '2024', 'photo_url' => '', 'ht_no' => 'HT2024001357'),
        array('sname' => 'Fatima Khan',   'exam' => 'IBPS PO',     'year' => '2024', 'photo_url' => '', 'ht_no' => 'HT2024009753'),
        array('sname' => 'Venkat Rao',    'exam' => 'RRB NTPC',    'year' => '2024', 'photo_url' => '', 'ht_no' => 'HT2024002468'),
        array('sname' => 'Sita Devi',     'exam' => 'SSC MTS',     'year' => '2023', 'photo_url' => '', 'ht_no' => 'HT2023006543'),
        array('sname' => 'Ramesh Babu',   'exam' => 'SSC CGL',     'year' => '2023', 'photo_url' => '', 'ht_no' => 'HT2023003217'),
        array('sname' => 'Geetha Patel',  'exam' => 'SBI Clerk',   'year' => '2023', 'photo_url' => '', 'ht_no' => 'HT2023007891'),
    );
    $years_set = array('2025', '2024', '2023');
    $exams_set = array('SSC CGL', 'RBI Grade B', 'SI Police', 'RRB NTPC', 'IBPS PO', 'SSC CHSL', 'SBI PO', 'SSC MTS', 'SBI Clerk');
}

/* ── Exam category → colour map (deterministic) ─────────────────── */
$cat_colors = array(
    '#1E3A8A', /* deep blue   */
    '#DC2626', /* red         */
    '#7C3AED', /* violet      */
    '#0891B2', /* cyan        */
    '#059669', /* emerald     */
    '#D97706', /* amber       */
    '#DB2777', /* pink        */
    '#0F766E', /* teal        */
);
$cat_gradients = array(
    'linear-gradient(135deg,#1E3A8A,#3B5BDB)',
    'linear-gradient(135deg,#DC2626,#F87171)',
    'linear-gradient(135deg,#7C3AED,#A78BFA)',
    'linear-gradient(135deg,#0891B2,#38BDF8)',
    'linear-gradient(135deg,#059669,#34D399)',
    'linear-gradient(135deg,#D97706,#FCD34D)',
    'linear-gradient(135deg,#DB2777,#F472B6)',
    'linear-gradient(135deg,#0F766E,#2DD4BF)',
);
$get_color = function($key) use ($cat_colors) {
    return $cat_colors[abs(crc32((string)$key)) % count($cat_colors)];
};
$get_gradient = function($key) use ($cat_gradients) {
    return $cat_gradients[abs(crc32((string)$key)) % count($cat_gradients)];
};

/* ── Achievement card render ────────────────────────────────────── */
$render_card = function($r) use ($get_color, $get_gradient) {
    $name     = $r['sname'];
    $exam     = $r['exam'];
    $year     = $r['year'];
    $photo    = $r['photo_url'];
    $ht_no    = $r['ht_no'] ?? '';
    $parts    = explode(' ', trim($name));
    $init     = strtoupper(substr($parts[0] ?? '', 0, 1) . substr($parts[1] ?? '', 0, 1));
    $color    = $get_color($exam);
    $gradient = $get_gradient($exam);
    ob_start();
    ?>
    <div class="rcard reveal" data-year="<?php echo esc_attr($year); ?>" data-exam="<?php echo esc_attr($exam); ?>">

        <!-- Gradient header -->
        <div class="rcard-header" style="background:<?php echo esc_attr($gradient); ?>;"></div>

        <!-- Circle photo — overlaps header -->
        <div class="rcard-photo-ring">
            <?php if ($photo) : ?>
            <img src="<?php echo esc_url($photo); ?>" alt="<?php echo esc_attr($name); ?>" loading="lazy">
            <?php else : ?>
            <div class="rcard-initials-ph" style="background:<?php echo esc_attr($color); ?>;"><?php echo esc_html($init ?: '?'); ?></div>
            <?php endif; ?>
        </div>

        <!-- Body -->
        <div class="rcard-body">
            <div class="rcard-name"><?php echo esc_html($name); ?></div>
            <?php if ($exam) : ?>
            <span class="rcard-exam-pill" style="background:<?php echo esc_attr($color); ?>;"><?php echo esc_html($exam); ?></span>
            <?php endif; ?>
            <?php if ($ht_no) : ?>
            <div class="rcard-ht">HT: <strong><?php echo esc_html($ht_no); ?></strong></div>
            <?php endif; ?>
        </div>

    </div>
    <?php
    return ob_get_clean();
};
$render_card_portrait = $render_card;
?>

<!-- ============================================================
     SECTION 1: CINEMATIC BANNER SLIDER
     ============================================================ -->
<section class="banner-slider results-page-banner" id="resultsSlider" aria-label="Results Page Banner">

    <div class="banner-slides" id="bannerTrack">
    <?php
    /* Each slide gets a unique transition effect */
    $banner_effects = array('diagonal', 'iris', 'slide-x', 'zoom-fade', 'cube', 'slide-y');
    foreach ($rb_slides as $idx => $sl) :
        $fx      = esc_attr($sl['rb_fx']    ?: $banner_effects[$idx % count($banner_effects)]);
        $theme   = esc_attr($sl['rb_theme'] ?: 'dark-red');
        $deco    = $sl['rb_decoration']     ?: 'none';
        $img_raw = $sl['rb_bg_image']       ?? null;
        $img_url = $img_raw ? (is_array($img_raw) ? $img_raw['url'] : $img_raw) : '';
    ?>
        <div class="banner-slide<?php echo $idx === 0 ? ' active' : ''; ?>" data-fx="<?php echo $fx; ?>">
            <div class="rbslide rbslide-theme-<?php echo $theme; ?>">

                <?php if ($img_url) : ?>
                <div class="banner-img-wrap">
                    <img src="<?php echo esc_url($img_url); ?>" alt="" class="banner-bg-img" loading="<?php echo $idx === 0 ? 'eager' : 'lazy'; ?>">
                </div>
                <?php else : ?>
                <div class="rbslide-bg"></div>
                <div class="rbslide-deco" aria-hidden="true">
                    <div class="rbslide-orb rbo1"></div>
                    <div class="rbslide-orb rbo2"></div>
                    <div class="rbslide-orb rbo3"></div>
                    <div class="rbslide-orb rbo4"></div>
                    <?php if ($deco === 'trophy') : ?>
                    <div class="rbslide-watermark">🏆</div>
                    <?php elseif ($deco === 'year-highlight') : ?>
                    <div class="rbslide-watermark rbwm-year">2025</div>
                    <?php elseif ($deco === 'exam-pills') : ?>
                    <div class="rbslide-exam-pills">
                        <span>SSC</span><span>RBI</span><span>SI</span><span>RRB</span><span>IBPS</span><span>Police</span>
                    </div>
                    <?php endif; ?>
                </div>
                <?php endif; ?>

                <div class="banner-overlay"></div>
            </div>
        </div>
    <?php endforeach; ?>
    </div><!-- /#bannerTrack -->

    <!-- Progress bar -->
    <div class="banner-progress-track">
        <div class="banner-progress-fill" id="bannerProgress"></div>
    </div>

    <?php if ($slide_count > 1) : ?>
    <!-- Prev / Next -->
    <button class="banner-nav banner-prev" aria-label="Previous slide">
        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="15 18 9 12 15 6"/></svg>
    </button>
    <button class="banner-nav banner-next" aria-label="Next slide">
        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="9 18 15 12 9 6"/></svg>
    </button>

    <!-- Counter + dots -->
    <div class="banner-footer">
        <div class="banner-counter">
            <span class="banner-curr" id="bannerCurrNum">01</span>
            <span class="banner-slash">/</span>
            <span class="banner-total"><?php echo esc_html(str_pad($slide_count, 2, '0', STR_PAD_LEFT)); ?></span>
        </div>
        <div class="banner-dots" id="bannerDots">
            <?php for ($d = 0; $d < $slide_count; $d++) : ?>
            <button class="banner-dot<?php echo $d === 0 ? ' active' : ''; ?>" aria-label="Slide <?php echo $d + 1; ?>"></button>
            <?php endfor; ?>
        </div>
    </div>
    <?php endif; ?>

</section>


<!-- ============================================================
     SECTION 2: ANIMATED STATS STRIP
     ============================================================ -->
<div class="results-stats-strip">
    <div class="container">
        <div class="results-stats-grid">
            <?php foreach ($stats as $st) :
                $is_numeric = is_numeric($st['num']); ?>
            <div class="rss-item">
                <div class="rss-icon"><?php echo $st['icon']; ?></div>
                <div class="rss-num-wrap">
                    <?php if ($is_numeric) : ?>
                    <span class="rss-num counter" data-target="<?php echo esc_attr($st['num']); ?>" data-suffix="<?php echo esc_attr($st['sfx']); ?>">0</span>
                    <?php else : ?>
                    <span class="rss-num"><?php echo esc_html($st['num'] . $st['sfx']); ?></span>
                    <?php endif; ?>
                </div>
                <span class="rss-lbl"><?php echo esc_html($st['lbl']); ?></span>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>


<!-- ============================================================
     SECTION 3: YEAR-WISE RESULTS
     ============================================================ -->
<section class="section results-yearwise-section">
    <div class="container">
        <div class="section-header reveal">
            <span class="section-tag"><?php echo esc_html($yr_tag); ?></span>
            <h2 class="section-title"><?php echo esc_html($yr_title); ?></h2>
            <p class="section-subtitle"><?php echo esc_html($yr_subtitle); ?></p>
        </div>

        <!-- Year tabs -->
        <div class="yr-tabs" role="tablist">
            <button class="yr-tab active" data-year="all" role="tab" aria-selected="true">All Years</button>
            <?php foreach ($years_set as $y) : ?>
            <button class="yr-tab" data-year="<?php echo esc_attr($y); ?>" role="tab" aria-selected="false"><?php echo esc_html($y); ?></button>
            <?php endforeach; ?>
        </div>

        <!-- Cards grid -->
        <div class="results-cards-grid" id="yearGrid">
            <?php foreach ($all_results as $r) echo $render_card_portrait($r); ?>
        </div>
        <p class="filter-empty" id="yearNoResults" style="display:none;">No results found for this year.</p>
        <div class="results-show-more-wrap">
            <button class="btn-show-more" id="yearShowMore" onclick="showMoreCards('yearGrid','yearShowMore')">
                Show More &nbsp;&#8595;
            </button>
        </div>
    </div>
</section>


<!-- ============================================================
     SECTION 4: EXAM-WISE RESULTS
     ============================================================ -->
<section class="section results-examwise-section">
    <div class="container">
        <div class="section-header reveal">
            <span class="section-tag section-tag-dark"><?php echo esc_html($ex_tag); ?></span>
            <h2 class="section-title"><?php echo esc_html($ex_title); ?></h2>
            <p class="section-subtitle"><?php echo esc_html($ex_subtitle); ?></p>
        </div>

        <!-- Exam chips -->
        <div class="exam-chips">
            <button class="exam-chip active" data-exam="all">All Exams</button>
            <?php foreach ($exams_set as $ex) : ?>
            <button class="exam-chip" data-exam="<?php echo esc_attr($ex); ?>"><?php echo esc_html($ex); ?></button>
            <?php endforeach; ?>
        </div>

        <!-- Cards grid -->
        <div class="results-cards-grid" id="examGrid">
            <?php foreach ($all_results as $r) echo $render_card($r); ?>
        </div>
        <p class="filter-empty" id="examNoResults" style="display:none;">No results found for this exam.</p>
        <div class="results-show-more-wrap">
            <button class="btn-show-more" id="examShowMore" onclick="showMoreCards('examGrid','examShowMore')">
                Show More &nbsp;&#8595;
            </button>
        </div>
    </div>
</section>


<!-- ============================================================
     SECTION 5: YOUTUBE REELS AUTO-SCROLL
     ============================================================ -->
<section class="section reels-section">
    <div class="container">
        <div class="section-header reveal">
            <span class="section-tag">Watch &amp; Learn</span>
            <h2 class="section-title">IRF on YouTube</h2>
            <p class="section-subtitle">Quick exam tips, success stories and strategies — straight from our YouTube channel.</p>
        </div>
    </div>
    <div class="reels-track-wrapper">
        <div class="reels-track" id="reelsTrack">
            <?php if (!empty($youtube_reels)) :
                $all_reels = array_merge($youtube_reels, $youtube_reels);
                foreach ($all_reels as $vid_id) : ?>
            <div class="reel-item">
                <div class="reel-embed">
                    <iframe src="https://www.youtube.com/embed/<?php echo esc_attr($vid_id); ?>?rel=0&modestbranding=1" loading="lazy" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                </div>
            </div>
            <?php endforeach; else :
                for ($i = 0; $i < 10; $i++) : ?>
            <div class="reel-item">
                <div class="reel-placeholder">
                    <div class="reel-play-icon">&#9654;</div>
                    <span>IRF Short #<?php echo esc_html($i + 1); ?></span>
                    <small>Add YouTube IDs in Homepage → YouTube Reels</small>
                </div>
            </div>
            <?php endfor; endif; ?>
        </div>
    </div>
</section>


<!-- ============================================================
     SECTION 6: CALL TO ACTION
     ============================================================ -->
<?php
$cta_title    = irf_opt('cta_title',     'Start Your Government Job Journey Today');
$cta_subtitle = irf_opt('cta_subtitle',  'Join 5,000+ students who trusted IRF and got selected. Your turn is next.');
$cta_btn1     = irf_opt('cta_btn1_text', 'Enroll Now');
$cta_btn1_url = irf_opt('cta_btn1_url',  home_url('/contact'));
$cta_btn2     = irf_opt('cta_btn2_text', 'Call Us Now');
$cta_btn2_url = irf_opt('cta_btn2_url',  'tel:+919999999999');
?>
<section class="section cta-section">
    <div class="container">
        <div class="cta-content">
            <h2 class="cta-title"><?php echo esc_html($cta_title); ?></h2>
            <p class="cta-subtitle"><?php echo esc_html($cta_subtitle); ?></p>
            <div class="cta-actions">
                <a href="<?php echo esc_url($cta_btn1_url); ?>" class="btn btn-white"><?php echo esc_html($cta_btn1); ?></a>
                <a href="<?php echo esc_url($cta_btn2_url); ?>" class="btn btn-outline"><?php echo esc_html($cta_btn2); ?></a>
            </div>
        </div>
    </div>
</section>


<!-- ============================================================
     INLINE JS: Year & Exam filters
     ============================================================ -->
<script>
(function () {
    'use strict';

    var PAGE_SIZE = 12; /* initial visible cards per grid */

    /* ── Apply initial limit ─────────────────────────────────── */
    function applyLimit(gridId, btnId) {
        var grid = document.getElementById(gridId);
        var btn  = document.getElementById(btnId);
        if (!grid) return;
        var cards = Array.from(grid.querySelectorAll('.rcard'));
        var shown = 0;
        cards.forEach(function (c) {
            if (c.classList.contains('rcard-hidden')) return;
            shown++;
            if (shown > PAGE_SIZE) c.classList.add('rcard-overlimit');
            else                   c.classList.remove('rcard-overlimit');
        });
        if (btn) btn.classList.toggle('hidden', shown <= PAGE_SIZE);
    }

    /* ── Show more ───────────────────────────────────────────── */
    window.showMoreCards = function(gridId, btnId) {
        var grid = document.getElementById(gridId);
        if (!grid) return;
        var hidden = grid.querySelectorAll('.rcard-overlimit');
        var count  = 0;
        hidden.forEach(function (c) {
            if (count < PAGE_SIZE) { c.classList.remove('rcard-overlimit'); count++; }
        });
        if (grid.querySelectorAll('.rcard-overlimit').length === 0) {
            var btn = document.getElementById(btnId);
            if (btn) btn.classList.add('hidden');
        }
    };

    /* ── Filter grid ─────────────────────────────────────────── */
    function filterGrid(gridId, noMsgId, btnId, filterAttr, value) {
        var grid  = document.getElementById(gridId);
        var noMsg = document.getElementById(noMsgId);
        if (!grid) return;
        var cards   = grid.querySelectorAll('.rcard');
        var visible = 0;
        cards.forEach(function (c) {
            c.classList.remove('rcard-overlimit');
            var match = (value === 'all' || c.dataset[filterAttr] === value);
            c.classList.toggle('rcard-hidden', !match);
            if (match) visible++;
        });
        if (noMsg) noMsg.style.display = visible === 0 ? 'block' : 'none';
        applyLimit(gridId, btnId);
    }

    /* ── Year tabs ───────────────────────────────────────────── */
    document.querySelectorAll('.yr-tab').forEach(function (btn) {
        btn.addEventListener('click', function () {
            document.querySelectorAll('.yr-tab').forEach(function (b) {
                b.classList.remove('active');
                b.setAttribute('aria-selected', 'false');
            });
            this.classList.add('active');
            this.setAttribute('aria-selected', 'true');
            filterGrid('yearGrid', 'yearNoResults', 'yearShowMore', 'year', this.dataset.year);
        });
    });

    /* ── Exam chips ──────────────────────────────────────────── */
    document.querySelectorAll('.exam-chip').forEach(function (btn) {
        btn.addEventListener('click', function () {
            document.querySelectorAll('.exam-chip').forEach(function (b) { b.classList.remove('active'); });
            this.classList.add('active');
            filterGrid('examGrid', 'examNoResults', 'examShowMore', 'exam', this.dataset.exam);
        });
    });

    /* ── Initial limits on page load ─────────────────────────── */
    applyLimit('yearGrid', 'yearShowMore');
    applyLimit('examGrid', 'examShowMore');

}());
</script>
<style>
.rcard.rcard-overlimit { display: none; }
</style>

<?php get_footer(); ?>
