<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo('charset'); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>

<header class="site-header" id="site-header">
    <div class="container">
        <nav class="nav-wrapper">

            <a href="<?php echo esc_url(home_url('/')); ?>" class="site-logo">
                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/logo.png" alt="IRF IACE" class="logo-img">
            </a>

            <?php
            wp_nav_menu( array(
                'theme_location'  => 'primary',
                'menu_id'         => 'nav-menu',
                'menu_class'      => 'nav-menu',
                'container'       => false,
                'fallback_cb'     => function() { ?>
                <ul class="nav-menu" id="nav-menu">
                    <li><a href="<?php echo esc_url(home_url('/')); ?>">Home</a></li>
                    <li><a href="<?php echo esc_url(home_url('/about-irf')); ?>">About</a></li>
                    <li><a href="<?php echo esc_url(home_url('/facilities')); ?>">Facilities</a></li>
                    <li><a href="<?php echo esc_url(home_url('/results')); ?>">Results</a></li>
                    <li><a href="<?php echo esc_url(home_url('/success-stories')); ?>">Success Stories</a></li>
                    <li><a href="<?php echo esc_url(home_url('/announcements')); ?>">Events</a></li>
                    <li><a href="<?php echo esc_url(home_url('/blog')); ?>">Blog</a></li>
                    <li><a href="<?php echo esc_url(home_url('/contact')); ?>" class="nav-cta">Contact Us</a></li>
                </ul>
                <?php },
            ) );
            ?>

            <div class="nav-right">
                <?php
                $mock_btn_text = irf_opt('header_mock_btn_text', 'Mock Test');
                $mock_btn_url  = irf_opt('header_mock_btn_url',  '#');
                if ($mock_btn_text) : ?>
                <a href="<?php echo esc_url($mock_btn_url); ?>" class="header-mock-btn">
                    <?php echo esc_html($mock_btn_text); ?>
                </a>
                <?php endif; ?>

                <button class="hamburger" id="hamburger" aria-label="Toggle Menu">
                    <span></span>
                    <span></span>
                    <span></span>
                </button>
            </div>

        </nav>
    </div>
</header>
