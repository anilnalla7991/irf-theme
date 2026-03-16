<?php get_header(); ?>

<!-- Page Banner -->
<section class="page-banner">
    <div class="page-banner-bg"></div>
    <div class="container">
        <div class="page-banner-content">
            <h1 class="page-banner-title">Announcements &amp; Events</h1>
            <nav class="breadcrumb" aria-label="Breadcrumb">
                <a href="<?php echo esc_url(home_url('/')); ?>">Home</a>
                <span class="breadcrumb-sep">&#8250;</span>
                <span>Announcements</span>
            </nav>
        </div>
    </div>
</section>

<!-- Announcements Grid -->
<section class="section announcements-section">
    <div class="container">
        <div class="section-header reveal">
            <span class="section-tag">Stay Updated</span>
            <h2 class="section-title">Latest Announcements</h2>
            <p class="section-subtitle">Upcoming events, exam schedules and important notifications from IRF.</p>
        </div>
        <div class="announcements-grid">
            <?php if (have_posts()) : while (have_posts()) : the_post();
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
            <?php endwhile; else : ?>
            <div class="no-results" style="grid-column:1/-1; text-align:center; color:var(--gray); padding:40px 0;">
                <p>No announcements yet. Check back soon!</p>
            </div>
            <?php endif; ?>
        </div>
        <div class="archive-pagination">
            <?php the_posts_pagination(array('mid_size' => 2, 'prev_text' => '&larr; Prev', 'next_text' => 'Next &rarr;')); ?>
        </div>
    </div>
</section>

<?php get_footer(); ?>
