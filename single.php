<?php get_header(); ?>

<?php while (have_posts()) : the_post(); ?>

<!-- Page Banner -->
<section class="page-banner">
    <div class="page-banner-bg"></div>
    <div class="container">
        <div class="page-banner-content">
            <h1 class="page-banner-title"><?php echo esc_html(get_the_title()); ?></h1>
            <nav class="breadcrumb" aria-label="Breadcrumb">
                <a href="<?php echo esc_url(home_url('/')); ?>">Home</a>
                <span class="breadcrumb-sep">&#8250;</span>
                <a href="<?php echo esc_url(home_url('/blog')); ?>">Blog</a>
                <span class="breadcrumb-sep">&#8250;</span>
                <span><?php echo esc_html(wp_trim_words(get_the_title(), 6)); ?></span>
            </nav>
        </div>
    </div>
</section>

<!-- Single Post Content -->
<section class="page-content-section">
    <div class="container">
        <div class="single-post-wrap">
            <?php if (has_post_thumbnail()) : ?>
                <div class="single-post-thumb">
                    <?php the_post_thumbnail('large', array('class' => 'single-thumb-img')); ?>
                </div>
            <?php endif; ?>
            <div class="single-post-meta">
                <span class="blog-date">📅 <?php echo esc_html(get_the_date()); ?></span>
                <?php $cats = get_the_category(); if ($cats) : ?>
                    <span class="blog-cat"><?php echo esc_html($cats[0]->name); ?></span>
                <?php endif; ?>
            </div>
            <div class="single-post-content page-content-wrap">
                <?php the_content(); ?>
            </div>
            <div class="single-post-nav">
                <div class="post-nav-prev"><?php previous_post_link('%link', '&larr; %title'); ?></div>
                <div class="post-nav-next"><?php next_post_link('%link', '%title &rarr;'); ?></div>
            </div>
        </div>
    </div>
</section>

<?php endwhile; ?>

<?php get_footer(); ?>
