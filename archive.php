<?php get_header(); ?>

<!-- Page Banner -->
<section class="page-banner">
    <div class="page-banner-bg"></div>
    <div class="container">
        <div class="page-banner-content">
            <h1 class="page-banner-title">
                <?php
                if (is_category()) {
                    echo 'Category: ' . esc_html(single_cat_title('', false));
                } elseif (is_tag()) {
                    echo 'Tag: ' . esc_html(single_tag_title('', false));
                } elseif (is_author()) {
                    echo 'Author: ' . esc_html(get_the_author());
                } elseif (is_post_type_archive()) {
                    echo esc_html(post_type_archive_title('', false));
                } else {
                    echo 'Blog';
                }
                ?>
            </h1>
            <nav class="breadcrumb" aria-label="Breadcrumb">
                <a href="<?php echo esc_url(home_url('/')); ?>">Home</a>
                <span class="breadcrumb-sep">&#8250;</span>
                <span><?php
                    if (is_post_type_archive()) echo esc_html(post_type_archive_title('', false));
                    else echo 'Blog';
                ?></span>
            </nav>
        </div>
    </div>
</section>

<!-- Blog Grid -->
<section class="section blog-archive-section">
    <div class="container">
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
            <div class="no-results" style="grid-column:1/-1; text-align:center; color:var(--gray); padding:60px 0;">
                <p>No posts found.</p>
            </div>
            <?php endif; ?>
        </div>
        <div class="archive-pagination">
            <?php the_posts_pagination(array('mid_size' => 2, 'prev_text' => '&larr; Prev', 'next_text' => 'Next &rarr;')); ?>
        </div>
    </div>
</section>

<?php get_footer(); ?>
