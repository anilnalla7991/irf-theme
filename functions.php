<?php

function irf_theme_setup() {
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('html5', array('search-form', 'comment-form', 'comment-list', 'gallery', 'caption'));

    register_nav_menus(array(
        'primary' => 'Primary Menu',
        'footer'  => 'Footer Menu',
    ));
}
add_action('after_setup_theme', 'irf_theme_setup');

function irf_enqueue_scripts() {
    wp_enqueue_style('google-fonts', 'https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=Poppins:wght@600;700;800&display=swap', array(), null);
    wp_enqueue_style('irf-main', get_template_directory_uri() . '/assets/css/main.css', array(), '2.0');
    wp_enqueue_style('irf-style', get_stylesheet_uri(), array('irf-main'), '2.0');
    wp_enqueue_script('irf-main', get_template_directory_uri() . '/assets/js/main.js', array(), '2.0', true);
}
add_action('wp_enqueue_scripts', 'irf_enqueue_scripts');
