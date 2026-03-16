<?php get_header(); ?>

<!-- Page Banner -->
<section class="page-banner">
    <div class="page-banner-bg"></div>
    <div class="container">
        <div class="page-banner-content">
            <h1 class="page-banner-title">Our Toppers</h1>
            <nav class="breadcrumb" aria-label="Breadcrumb">
                <a href="<?php echo esc_url(home_url('/')); ?>">Home</a>
                <span class="breadcrumb-sep">&#8250;</span>
                <span>Results</span>
            </nav>
        </div>
    </div>
</section>

<!-- Results Grid -->
<section class="section results-section">
    <div class="container">
        <div class="section-header reveal">
            <span class="section-tag">Proven Track Record</span>
            <h2 class="section-title">Student Selections</h2>
            <p class="section-subtitle">Real students. Real results. Selections across every major competitive exam.</p>
        </div>
        <div class="results-grid">
            <?php if (have_posts()) : while (have_posts()) : the_post();
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
            <?php endwhile; else : ?>
            <div class="no-results">
                <p>Results coming soon. Our toppers will be featured here!</p>
            </div>
            <?php endif; ?>
        </div>
        <div class="archive-pagination">
            <?php the_posts_pagination(array('mid_size' => 2, 'prev_text' => '&larr; Prev', 'next_text' => 'Next &rarr;')); ?>
        </div>
    </div>
</section>

<?php get_footer(); ?>
