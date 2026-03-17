<?php get_header(); ?>

<?php $blog_page_id = get_option('page_for_posts'); ?>

<!-- Page Banner -->
<section class="page-banner">
    <div class="page-banner-bg"></div>
    <div class="container">
        <div class="page-banner-content">
            <h1 class="page-banner-title"><?php echo esc_html((function_exists('get_field') ? get_field('banner_title', $blog_page_id) : '') ?: 'Blog'); ?></h1>
            <nav class="breadcrumb" aria-label="Breadcrumb">
                <a href="<?php echo esc_url(home_url('/')); ?>">Home</a>
                <span class="breadcrumb-sep">&#8250;</span>
                <span><?php echo esc_html((function_exists('get_field') ? get_field('banner_title', $blog_page_id) : '') ?: 'Blog'); ?></span>
            </nav>
            <?php $banner_subtitle = (function_exists('get_field') ? get_field('banner_subtitle', $blog_page_id) : '') ?: ''; ?>
            <?php if ($banner_subtitle) : ?>
            <p class="page-banner-subtitle"><?php echo esc_html($banner_subtitle); ?></p>
            <?php endif; ?>
        </div>
    </div>
</section>

<!-- Blog Grid -->
<section class="section blog-archive-section">
    <div class="container">
        <div class="section-header reveal">
            <span class="section-tag"><?php echo esc_html((function_exists('get_field') ? get_field('section_tag', $blog_page_id) : '') ?: 'Latest Articles'); ?></span>
            <h2 class="section-title"><?php echo esc_html((function_exists('get_field') ? get_field('section_title', $blog_page_id) : '') ?: 'IRF Blog'); ?></h2>
            <p class="section-subtitle"><?php echo esc_html((function_exists('get_field') ? get_field('section_subtitle', $blog_page_id) : '') ?: 'Exam tips, strategy guides, and success stories from our faculty and students.'); ?></p>
        </div>
        <div class="blog-grid">
            <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
            <article class="blog-card reveal">
                <?php if (has_post_thumbnail()) : ?>
                    <a href="<?php the_permalink(); ?>" class="blog-card-thumb">
                        <?php the_post_thumbnail('medium_large', array('class' => 'blog-thumb-img')); ?>
                    </a>
                <?php else : ?>
                    <div class="blog-thumb-placeholder">📰</div>
                <?php endif; ?>
                <div class="blog-card-body">
                    <div class="blog-card-meta">
                        <span class="blog-date">📅 <?php echo esc_html(get_the_date()); ?></span>
                        <?php $cats = get_the_category(); if ($cats) : ?>
                            <span class="blog-cat"><?php echo esc_html($cats[0]->name); ?></span>
                        <?php endif; ?>
                    </div>
                    <h2 class="blog-card-title">
                        <a href="<?php the_permalink(); ?>"><?php echo esc_html(get_the_title()); ?></a>
                    </h2>
                    <p class="blog-card-excerpt"><?php echo esc_html(wp_trim_words(get_the_excerpt(), 22)); ?></p>
                    <a href="<?php the_permalink(); ?>" class="announcement-link">Read More &#8594;</a>
                </div>
            </article>
            <?php endwhile; else : ?>
            <div class="no-results" style="grid-column:1/-1; text-align:center; color:var(--gray); padding:60px 0; font-size:16px;">
                <p>No blog posts yet. Check back soon!</p>
            </div>
            <?php endif; ?>
        </div>
        <div class="archive-pagination">
            <?php the_posts_pagination(array('mid_size' => 2, 'prev_text' => '&larr; Prev', 'next_text' => 'Next &rarr;')); ?>
        </div>
    </div>
</section>

<?php get_footer(); ?>
