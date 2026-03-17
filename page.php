<?php get_header(); ?>

<!-- Page Banner -->
<section class="page-banner">
    <div class="page-banner-bg"></div>
    <div class="container">
        <div class="page-banner-content">
            <h1 class="page-banner-title"><?php echo esc_html(get_the_title()); ?></h1>
            <nav class="breadcrumb" aria-label="Breadcrumb">
                <a href="<?php echo esc_url(home_url('/')); ?>">Home</a>
                <span class="breadcrumb-sep">&#8250;</span>
                <span><?php echo esc_html(get_the_title()); ?></span>
            </nav>
        </div>
    </div>
</section>

<!-- Page Content -->
<section class="page-content-section">
    <div class="container">
        <div class="page-content-wrap">
            <?php
            while (have_posts()) :
                the_post();
                if (get_the_content()) :
                    the_content();
                else :
            ?>
            <p style="color:var(--gray); text-align:center; padding: 40px 0; font-size:16px;">
                Content coming soon. Please check back later!
            </p>
            <?php
                endif;
            endwhile;
            ?>
        </div>
    </div>
</section>

<?php get_footer(); ?>
