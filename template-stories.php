<?php
/**
 * Template Name: Success Stories
 */
get_header();
$banner_title    = (function_exists('get_field') ? get_field('banner_title')    : '') ?: 'Success Stories';
$banner_subtitle = (function_exists('get_field') ? get_field('banner_subtitle') : '') ?: '';
$section_tag     = (function_exists('get_field') ? get_field('section_tag')     : '') ?: 'Student Stories';
$section_title   = (function_exists('get_field') ? get_field('section_title')   : '') ?: 'Hear From Our Students';
$section_subtitle= (function_exists('get_field') ? get_field('section_subtitle'): '') ?: 'Real experiences from students who achieved their government job dreams with IRF.';
?>
<section class="page-banner">
    <div class="page-banner-bg"></div>
    <div class="container">
        <div class="page-banner-content">
            <h1 class="page-banner-title"><?php echo esc_html($banner_title); ?></h1>
            <nav class="breadcrumb" aria-label="Breadcrumb">
                <a href="<?php echo esc_url(home_url('/')); ?>">Home</a>
                <span class="breadcrumb-sep">&#8250;</span>
                <span><?php echo esc_html($banner_title); ?></span>
            </nav>
            <?php if ($banner_subtitle) : ?>
            <p class="page-banner-subtitle"><?php echo esc_html($banner_subtitle); ?></p>
            <?php endif; ?>
        </div>
    </div>
</section>

<section class="section stories-archive-section">
    <div class="container">
        <div class="section-header reveal">
            <span class="section-tag"><?php echo esc_html($section_tag); ?></span>
            <h2 class="section-title"><?php echo esc_html($section_title); ?></h2>
            <p class="section-subtitle"><?php echo esc_html($section_subtitle); ?></p>
        </div>
        <div class="stories-archive-grid">
            <?php
            $stories_query = new WP_Query(array('post_type' => 'success_stories', 'posts_per_page' => 24, 'post_status' => 'publish'));
            if ($stories_query->have_posts()) :
                while ($stories_query->have_posts()) : $stories_query->the_post();
                    $s_name  = function_exists('get_field') ? get_field('student_name')    : get_the_title();
                    $s_exam  = function_exists('get_field') ? get_field('exam_cleared')    : '';
                    $s_rank  = function_exists('get_field') ? get_field('rank')            : '';
                    $s_msg   = function_exists('get_field') ? get_field('student_message') : get_the_excerpt();
                    $s_photo = function_exists('get_field') ? get_field('student_photo')   : null;
            ?>
            <div class="story-card-full reveal">
                <div class="story-header">
                    <?php if ($s_photo) : ?>
                        <img src="<?php echo esc_url(is_array($s_photo) ? $s_photo['url'] : $s_photo); ?>" alt="<?php echo esc_attr($s_name); ?>" class="story-photo">
                    <?php elseif (has_post_thumbnail()) : ?>
                        <?php the_post_thumbnail('thumbnail', array('class' => 'story-photo')); ?>
                    <?php else : ?>
                        <div class="story-photo-placeholder">🎓</div>
                    <?php endif; ?>
                    <div>
                        <div class="story-name"><?php echo esc_html($s_name); ?></div>
                        <?php if ($s_exam) : ?><div class="story-exam"><?php echo esc_html($s_exam); ?></div><?php endif; ?>
                        <?php if ($s_rank) : ?><span class="story-rank">🏆 Rank <?php echo esc_html($s_rank); ?></span><?php endif; ?>
                    </div>
                </div>
                <?php if ($s_msg) : ?><p class="story-message">"<?php echo esc_html($s_msg); ?>"</p><?php endif; ?>
            </div>
            <?php endwhile; wp_reset_postdata(); else : ?>
            <div class="no-results" style="grid-column:1/-1;text-align:center;color:var(--gray);padding:40px 0;"><p>Success stories coming soon!</p></div>
            <?php endif; ?>
        </div>
        <div class="archive-pagination">
            <?php the_posts_pagination(array('mid_size' => 2, 'prev_text' => '&larr; Prev', 'next_text' => 'Next &rarr;')); ?>
        </div>
    </div>
</section>
<?php get_footer(); ?>
