<?php
/**
 * Template Name: Results
 */


get_header();
$fn      = 'get_field';
$has_acf = function_exists($fn);

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

/* ── ACF: Scrolling Ticker ──────────────────────────────────────── */
$ticker_enabled = $has_acf ? (bool) get_field('results_ticker_enable') : false;
$ticker_items   = ($ticker_enabled && $has_acf) ? (get_field('results_ticker_items') ?: array()) : array();

/* ── ACF: Reels (from homepage) ─────────────────────────────────── */
$home_id       = (int) get_option('page_on_front');
$reels_acf     = ($has_acf && $home_id) ? get_field('home_youtube_videos', $home_id) : array();
$youtube_reels = array();
if (!empty($reels_acf) && is_array($reels_acf)) {
    foreach ($reels_acf as $row) {
        if (!empty($row['video_id'])) $youtube_reels[] = sanitize_text_field($row['video_id']);
    }
}

/* ── ACF: Student Fields repeater ───────────────────────────────── */
$rs_rows     = ($has_acf ? get_field('results_students') : null) ?: array();
$all_results = array();
$years_set   = array();
$exams_set   = array();

foreach ($rs_rows as $row) {
    $sname       = sanitize_text_field($row['rs_student_name']  ?? '');
    $category    = sanitize_text_field($row['rs_exam_category'] ?? '');  // broad category → filter chips
    $exam_clr    = sanitize_text_field($row['rs_exam_cleared']  ?? '');  // specific exam → card pill
    $ht_no       = sanitize_text_field($row['rs_ht_no']         ?? '');
    $date_raw    = $row['rs_result_date'] ?? '';                          // format: Y-m-d
    $year        = $date_raw ? date('Y', strtotime($date_raw)) : '';
    $img_raw     = $row['rs_student_image'] ?? null;
    $photo_url   = $img_raw ? (is_array($img_raw) ? $img_raw['url'] : $img_raw) : '';
    // Extra exams: comma-separated text field e.g. "IBPS PO, SBI Clerk"
    $extra_raw   = sanitize_text_field($row['rs_extra_exams'] ?? '');
    $extra_exams = $extra_raw ? array_filter(array_map('trim', explode(',', $extra_raw))) : array();
    $batch       = sanitize_text_field($row['rs_batch_name'] ?? '');

    if (!$sname) continue;

    $all_results[] = array(
        'sname'        => $sname,
        'exam'         => $category,    // used for data-exam (filter chips)
        'exam_display' => $exam_clr,    // shown on card pill
        'year'         => $year,
        'photo_url'    => $photo_url,
        'ht_no'        => $ht_no,
        'extra_exams'  => $extra_exams, // additional selections
        'batch'        => $batch,       // batch grouping
    );
    if ($year     && !in_array($year,     $years_set)) $years_set[] = $year;
    if ($category && !in_array($category, $exams_set)) $exams_set[] = $category;
}
rsort($years_set);

/* ── Demo fallback (shown when no ACF student data entered yet) ─── */
if (empty($all_results)) {
    $all_results = array(
        array('sname' => 'Ravi Kumar',   'exam' => 'SSC',     'exam_display' => 'SSC CGL',     'year' => '2025', 'photo_url' => '', 'ht_no' => 'HT2025001234', 'extra_exams' => array('IBPS PO', 'SBI Clerk'), 'batch' => 'Batch 1'),
        array('sname' => 'Priya Reddy',  'exam' => 'Banking', 'exam_display' => 'RBI Grade B', 'year' => '2025', 'photo_url' => '', 'ht_no' => 'HT2025005678', 'extra_exams' => array('IBPS PO'),              'batch' => 'Batch 1'),
        array('sname' => 'Kiran Babu',   'exam' => 'Police',  'exam_display' => 'SI Police',   'year' => '2025', 'photo_url' => '', 'ht_no' => 'HT2025009012', 'extra_exams' => array(),                        'batch' => 'Batch 1'),
        array('sname' => 'Anand Sharma', 'exam' => 'RRB',     'exam_display' => 'RRB NTPC',    'year' => '2025', 'photo_url' => '', 'ht_no' => 'HT2025003456', 'extra_exams' => array(),                        'batch' => 'Batch 1'),
        array('sname' => 'Deepa Rao',    'exam' => 'Banking', 'exam_display' => 'IBPS PO',     'year' => '2025', 'photo_url' => '', 'ht_no' => 'HT2025007890', 'extra_exams' => array(),                        'batch' => 'Batch 1'),
        array('sname' => 'Suresh Nair',  'exam' => 'SSC',     'exam_display' => 'SSC CHSL',    'year' => '2025', 'photo_url' => '', 'ht_no' => 'HT2025002345', 'extra_exams' => array(),                        'batch' => 'Batch 2'),
        array('sname' => 'Lakshmi V',    'exam' => 'Banking', 'exam_display' => 'SBI PO',      'year' => '2025', 'photo_url' => '', 'ht_no' => 'HT2025006789', 'extra_exams' => array('SSC CGL'),               'batch' => 'Batch 2'),
        array('sname' => 'Sneha Mehta',  'exam' => 'SSC',     'exam_display' => 'SSC CGL',     'year' => '2025', 'photo_url' => '', 'ht_no' => 'HT2025001111', 'extra_exams' => array(),                        'batch' => 'Batch 2'),
        array('sname' => 'Raj Mohan',    'exam' => 'Banking', 'exam_display' => 'RBI Grade B', 'year' => '2024', 'photo_url' => '', 'ht_no' => 'HT2024004321', 'extra_exams' => array(),                        'batch' => 'Batch 1'),
        array('sname' => 'Meena Kumari', 'exam' => 'SSC',     'exam_display' => 'SSC CGL',     'year' => '2024', 'photo_url' => '', 'ht_no' => 'HT2024008765', 'extra_exams' => array(),                        'batch' => 'Batch 1'),
        array('sname' => 'Arjun Singh',  'exam' => 'Police',  'exam_display' => 'SI Police',   'year' => '2024', 'photo_url' => '', 'ht_no' => 'HT2024001357', 'extra_exams' => array(),                        'batch' => 'Batch 1'),
        array('sname' => 'Fatima Khan',  'exam' => 'Banking', 'exam_display' => 'IBPS PO',     'year' => '2024', 'photo_url' => '', 'ht_no' => 'HT2024009753', 'extra_exams' => array(),                        'batch' => 'Batch 1'),
        array('sname' => 'Venkat Rao',   'exam' => 'RRB',     'exam_display' => 'RRB NTPC',    'year' => '2024', 'photo_url' => '', 'ht_no' => 'HT2024002468', 'extra_exams' => array(),                        'batch' => 'Batch 1'),
        array('sname' => 'Sita Devi',    'exam' => 'SSC',     'exam_display' => 'SSC MTS',     'year' => '2023', 'photo_url' => '', 'ht_no' => 'HT2023006543', 'extra_exams' => array(),                        'batch' => 'Batch 1'),
        array('sname' => 'Ramesh Babu',  'exam' => 'SSC',     'exam_display' => 'SSC CGL',     'year' => '2023', 'photo_url' => '', 'ht_no' => 'HT2023003217', 'extra_exams' => array(),                        'batch' => 'Batch 1'),
        array('sname' => 'Geetha Patel', 'exam' => 'Banking', 'exam_display' => 'SBI Clerk',   'year' => '2023', 'photo_url' => '', 'ht_no' => 'HT2023007891', 'extra_exams' => array(),                        'batch' => 'Batch 1'),
    );
    $years_set = array('2025', '2024', '2023');
    $exams_set = array('SSC', 'Banking', 'RRB', 'Police');
    /* Demo batch metadata shown when no ACF data configured */
    $demo_bm = array(
        '2025' => array(
            'Batch 1' => array('rb_batch_label' => 'Jan – Jun 2025', 'rb_total_students' => 6),
            'Batch 2' => array('rb_batch_label' => 'Jul – Dec 2025', 'rb_total_students' => 4),
        ),
        '2024' => array('Batch 1' => array('rb_batch_label' => 'Jan – Dec 2024', 'rb_total_students' => 6)),
        '2023' => array('Batch 1' => array('rb_batch_label' => 'Jan – Dec 2023', 'rb_total_students' => 4)),
    );
}

/* ── Batch-wise grouping ─────────────────────────────────────────── */
$batch_by_year = array();
foreach ($all_results as $r) {
    if (empty($r['batch'])) continue;
    $batch_by_year[$r['year'] ?: 'Unknown'][$r['batch']][] = $r;
}
krsort($batch_by_year); // newest year first

/* Batch metadata lookup: ACF → fallback to demo meta */
$bm_lookup = array();
$batch_defs_raw = $has_acf ? (get_field('results_batches') ?: array()) : array();
foreach ($batch_defs_raw as $bd) {
    $yr = trim($bd['rb_year'] ?? ''); $bn = trim($bd['rb_batch_name'] ?? '');
    if ($yr && $bn) $bm_lookup[$yr][$bn] = $bd;
}
if (empty($bm_lookup) && !empty($demo_bm)) $bm_lookup = $demo_bm;

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
    $name         = $r['sname'];
    $exam         = $r['exam'];                          // broad category (filter key)
    $exam_display = $r['exam_display'] ?? $exam;         // specific exam (shown on card)
    $year         = $r['year'];
    $photo        = $r['photo_url'];
    $ht_no        = $r['ht_no'] ?? '';
    $extra_exams  = $r['extra_exams'] ?? array();
    $all_exams    = $exam_display ? array_merge(array($exam_display), $extra_exams) : $extra_exams;
    $total        = count($all_exams);
    $parts        = explode(' ', trim($name));
    $init         = strtoupper(substr($parts[0] ?? '', 0, 1) . substr($parts[1] ?? '', 0, 1));
    $color        = $get_color($exam);
    $gradient     = $get_gradient($exam);
    ob_start();
    ?>
    <div class="rcard reveal" data-year="<?php echo esc_attr($year); ?>" data-exam="<?php echo esc_attr($exam); ?>" style="--rcard-accent:<?php echo esc_attr($color); ?>;">

        <!-- Full-width photo area -->
        <div class="rcard-photo-area">
            <?php if ($photo) : ?>
            <img src="<?php echo esc_url($photo); ?>" alt="<?php echo esc_attr($name); ?>" loading="lazy">
            <?php else : ?>
            <div class="rcard-initials-ph" style="background:<?php echo esc_attr($gradient); ?>;"><?php echo esc_html($init ?: '?'); ?></div>
            <?php endif; ?>
        </div>

        <?php if ($total > 1) : ?>
        <!-- Multi-selection badge + tooltip — outside photo-area so overflow:hidden doesn't clip tooltip -->
        <div class="rcard-multi-wrap">
            <span class="rcard-multi-badge"><?php echo esc_html($total); ?>x</span>
            <div class="rcard-tooltip">
                <div class="rcard-tooltip-title">All Selections</div>
                <?php foreach ($all_exams as $ex) : ?>
                <div class="rcard-tooltip-item"><?php echo esc_html($ex); ?></div>
                <?php endforeach; ?>
            </div>
        </div>
        <?php endif; ?>

        <!-- Body -->
        <div class="rcard-body">
            <div class="rcard-name"><?php echo esc_html($name); ?></div>
            <?php if ($exam_display) : ?>
            <span class="rcard-exam-pill" style="background:<?php echo esc_attr($color); ?>;"><?php echo esc_html($exam_display); ?></span>
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

<?php if ($ticker_enabled && !empty($ticker_items)) : ?>
<!-- ============================================================
     SCROLLING TICKER STRIP
     ============================================================ -->
<div class="results-ticker-strip" id="resultsTickerStrip" aria-label="Results highlights">
    <div class="results-ticker-inner" id="resultsTickerInner">
        <?php
        /* Render items twice for a seamless infinite loop */
        for ($pass = 0; $pass < 2; $pass++) :
            foreach ($ticker_items as $item) :
                $icon  = esc_html($item['ticker_icon']  ?? '●');
                $value = esc_html($item['ticker_value'] ?? '');
                $text  = esc_html($item['ticker_text']  ?? '');
        ?>
        <span class="rtk-item"<?php echo $pass === 1 ? ' aria-hidden="true"' : ''; ?>>
            <span class="rtk-icon"><?php echo $icon; ?></span>
            <?php if ($value) : ?><strong class="rtk-value"><?php echo $value; ?></strong><?php endif; ?>
            <?php if ($text)  : ?><span  class="rtk-text"><?php echo $text; ?></span><?php endif; ?>
        </span>
        <?php
            endforeach;
        endfor;
        ?>
    </div>
</div>
<?php endif; ?>

<!-- ============================================================
     SECTION 1: ANIMATED STATS STRIP
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


<?php if (!empty($batch_by_year)) : ?>
<!-- ============================================================
     SECTION 2: BATCH-WISE RESULTS
     ============================================================ -->
<section class="section results-batches-section">
    <div class="container">
        <div class="section-header reveal">
            <span class="section-tag">Batch Wise</span>
            <h2 class="section-title">Results by Batch</h2>
            <p class="section-subtitle">Year-wise batch performance — selection count, success ratio and student highlights.</p>
        </div>

        <!-- Year tabs: side-by-side, click to switch panel -->
        <div class="batch-yr-tabs" role="tablist">
            <?php $first = true; foreach ($batch_by_year as $yr => $unused) : ?>
            <button class="batch-yr-tab<?php echo $first ? ' active' : ''; ?>"
                    data-batchyr="<?php echo esc_attr($yr); ?>"
                    role="tab" aria-selected="<?php echo $first ? 'true' : 'false'; ?>">
                <?php echo esc_html($yr); ?>
            </button>
            <?php $first = false; endforeach; ?>
        </div>

        <!-- Year panels: only active one is visible -->
        <?php $first = true; foreach ($batch_by_year as $yr => $batches) :
            $yr_key = preg_replace('/[^a-z0-9]/i', '', (string)$yr);
        ?>
        <div class="batch-yr-panel<?php echo $first ? ' active' : ''; ?>"
             data-batchyrpanel="<?php echo esc_attr($yr); ?>"
             role="tabpanel">

            <?php $b_idx = 0; foreach ($batches as $bn => $b_students) :
                $meta     = $bm_lookup[$yr][$bn] ?? array();
                $label    = $meta['rb_batch_label']    ?? '';
                $total    = max((int)($meta['rb_total_students'] ?? 0), count($b_students));
                $selected = count($b_students);
                $pct      = $total > 0 ? round($selected / $total * 100, 1) : 0;
                $grid_id  = 'batchGrid_'     . $yr_key . '_' . $b_idx;
                $btn_id   = 'batchShowMore_' . $yr_key . '_' . $b_idx;
            ?>
            <div class="batch-group">

                <div class="batch-header">
                    <div class="batch-header-info">
                        <div class="batch-name"><?php echo esc_html($bn); ?></div>
                        <?php if ($label) : ?>
                        <div class="batch-label"><?php echo esc_html($label); ?></div>
                        <?php endif; ?>
                    </div>

                    <div class="batch-stats-row">
                        <div class="batch-stat-box">
                            <div class="batch-stat-num"><?php echo esc_html($selected . ' / ' . $total); ?></div>
                            <div class="batch-stat-lbl">Selected</div>
                        </div>
                        <div class="batch-stat-box">
                            <div class="batch-stat-num batch-pct"><?php echo esc_html($pct); ?>%</div>
                            <div class="batch-stat-lbl">Success Rate</div>
                        </div>
                    </div>

                    <div class="batch-progress-wrap">
                        <div class="batch-progress-meta">
                            <span>Success Ratio</span>
                            <span><?php echo esc_html($selected . '/' . $total); ?></span>
                        </div>
                        <div class="batch-progress-bar">
                            <div class="batch-progress-fill" style="width:<?php echo esc_attr(min($pct, 100)); ?>%"></div>
                        </div>
                        <div class="batch-progress-pct"><?php echo esc_html($pct); ?>%</div>
                    </div>
                </div>

                <div class="results-cards-grid" id="<?php echo esc_attr($grid_id); ?>">
                    <?php foreach ($b_students as $r) echo $render_card($r); ?>
                </div>
                <?php if (count($b_students) > 12) : ?>
                <div class="results-show-more-wrap">
                    <button class="btn-show-more" id="<?php echo esc_attr($btn_id); ?>"
                            onclick="showMoreCards('<?php echo esc_js($grid_id); ?>','<?php echo esc_js($btn_id); ?>')">
                        Show More &nbsp;&#8595;
                    </button>
                </div>
                <?php endif; ?>
            </div>
            <?php $b_idx++; endforeach; ?>
        </div>
        <?php $first = false; endforeach; ?>
    </div>
</section>
<?php endif; ?>


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
<!-- JS for this page lives in assets/js/results.js (enqueued via functions.php) -->

<?php get_footer(); ?>
