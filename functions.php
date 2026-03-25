<?php

/* =============================================================
   ACF OPTIONS HELPER
   ============================================================= */
function irf_opt($key, $default = '') {
    return function_exists('get_field') ? (get_field($key, 'option') ?: $default) : $default;
}


/* =============================================================
   THEME SETUP
   ============================================================= */
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


/* =============================================================
   ENQUEUE SCRIPTS & STYLES
   ============================================================= */
function irf_enqueue_scripts() {
    wp_enqueue_style('google-fonts', 'https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=Poppins:wght@600;700;800&display=swap', array(), null);
    wp_enqueue_style('irf-main', get_template_directory_uri() . '/assets/css/main.css', array(), '2.7');
    wp_enqueue_style('irf-style', get_stylesheet_uri(), array('irf-main'), '2.7');
    wp_enqueue_script('irf-main', get_template_directory_uri() . '/assets/js/main.js', array(), '2.7', true);

    /* ── Results page: load dedicated CSS + JS only when needed ── */
    if ( is_post_type_archive('results') || is_page_template('template-results.php') ) {
        wp_enqueue_style(
            'irf-results',
            get_template_directory_uri() . '/assets/css/results.css',
            array('irf-main'),
            '2.8'
        );
        wp_enqueue_script(
            'irf-results',
            get_template_directory_uri() . '/assets/js/results.js',
            array('irf-main'),
            '2.8',
            true   /* load in footer */
        );
    }

    /* ── Contact page: load dedicated CSS + JS only when needed ── */
    if ( is_page_template('template-contact.php') ) {
        wp_enqueue_style(
            'irf-contact',
            get_template_directory_uri() . '/assets/css/contact.css',
            array('irf-main'),
            '1.0'
        );
        wp_enqueue_script(
            'irf-contact',
            get_template_directory_uri() . '/assets/js/contact.js',
            array(),
            '1.0',
            true   /* load in footer */
        );
        wp_localize_script('irf-contact', 'irfContact', array(
            'ajaxurl' => admin_url('admin-ajax.php'),
            'nonce'   => wp_create_nonce('irf_contact_nonce'),
        ));
    }
}
add_action('wp_enqueue_scripts', 'irf_enqueue_scripts');


/* =============================================================
   CONTACT FORM — AJAX HANDLER
   ============================================================= */
function irf_handle_contact_form() {
    if ( ! isset( $_POST['nonce'] ) || ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['nonce'] ) ), 'irf_contact_nonce' ) ) {
        wp_send_json_error( array( 'message' => 'Security check failed.' ) );
    }

    $name    = sanitize_text_field( wp_unslash( $_POST['name']    ?? '' ) );
    $phone   = sanitize_text_field( wp_unslash( $_POST['phone']   ?? '' ) );
    $email   = sanitize_email( wp_unslash( $_POST['email']        ?? '' ) );
    $course  = sanitize_text_field( wp_unslash( $_POST['course']  ?? '' ) );
    $branch  = sanitize_text_field( wp_unslash( $_POST['branch']  ?? '' ) );
    $message = sanitize_textarea_field( wp_unslash( $_POST['message'] ?? '' ) );

    if ( empty( $name ) || empty( $phone ) || empty( $email ) ) {
        wp_send_json_error( array( 'message' => 'Please fill in all required fields.' ) );
    }
    if ( ! is_email( $email ) ) {
        wp_send_json_error( array( 'message' => 'Invalid email address.' ) );
    }

    $to      = irf_opt( 'site_email', get_option( 'admin_email' ) );
    $subject = sprintf( '[IRF IACE] New Inquiry from %s', $name );
    $body    = sprintf(
        "New contact inquiry received via the website.\n\n" .
        "Name    : %s\nPhone   : %s\nEmail   : %s\nCourse  : %s\nBranch  : %s\n\nMessage :\n%s",
        $name, $phone, $email,
        $course  ?: '(not specified)',
        $branch  ?: '(not specified)',
        $message ?: '(no message)'
    );
    $headers = array(
        'Content-Type: text/plain; charset=UTF-8',
        sprintf( 'Reply-To: %s <%s>', $name, $email ),
    );

    $sent = wp_mail( $to, $subject, $body, $headers );

    if ( $sent ) {
        wp_send_json_success( array( 'message' => 'Inquiry sent successfully.' ) );
    } else {
        wp_send_json_error( array( 'message' => 'Mail could not be sent. Please call us directly.' ) );
    }
}
add_action( 'wp_ajax_irf_contact_form',        'irf_handle_contact_form' );
add_action( 'wp_ajax_nopriv_irf_contact_form', 'irf_handle_contact_form' );


/* =============================================================
   REGISTER CUSTOM POST TYPES
   ============================================================= */
function irf_register_post_types() {

    // Results
    register_post_type('results', array(
        'labels'  => array(
            'name'               => 'Results',
            'singular_name'      => 'Result',
            'add_new_item'       => 'Add New Topper',
            'edit_item'          => 'Edit Topper',
            'new_item'           => 'New Topper',
            'view_item'          => 'View Topper',
            'search_items'       => 'Search Results',
            'not_found'          => 'No results found',
        ),
        'public'            => true,
        'has_archive'       => true,
        'menu_icon'         => 'dashicons-awards',
        'supports'          => array('title', 'thumbnail'),
        'show_in_rest'      => true,
        'rewrite'           => array('slug' => 'results'),
    ));

    // Success Stories
    register_post_type('success_stories', array(
        'labels'  => array(
            'name'               => 'Success Stories',
            'singular_name'      => 'Success Story',
            'add_new_item'       => 'Add New Story',
            'edit_item'          => 'Edit Story',
            'new_item'           => 'New Story',
            'view_item'          => 'View Story',
            'search_items'       => 'Search Stories',
            'not_found'          => 'No stories found',
        ),
        'public'            => true,
        'has_archive'       => true,
        'menu_icon'         => 'dashicons-format-quote',
        'supports'          => array('title', 'thumbnail'),
        'show_in_rest'      => true,
        'rewrite'           => array('slug' => 'success-stories'),
    ));

    // Announcements
    register_post_type('announcements', array(
        'labels'  => array(
            'name'               => 'Announcements',
            'singular_name'      => 'Announcement',
            'add_new_item'       => 'Add New Announcement',
            'edit_item'          => 'Edit Announcement',
            'new_item'           => 'New Announcement',
            'view_item'          => 'View Announcement',
            'search_items'       => 'Search Announcements',
            'not_found'          => 'No announcements found',
        ),
        'public'            => true,
        'has_archive'       => true,
        'menu_icon'         => 'dashicons-megaphone',
        'supports'          => array('title', 'editor', 'thumbnail'),
        'show_in_rest'      => false,
        'rewrite'           => array('slug' => 'announcements'),
    ));
}
add_action('init', 'irf_register_post_types');


/* =============================================================
   ACF: OPTIONS PAGE (IRF Settings)
   ============================================================= */
if (function_exists('acf_add_options_page')) {
    acf_add_options_page(array(
        'page_title'  => 'IRF Theme Settings',
        'menu_title'  => 'IRF Settings',
        'menu_slug'   => 'irf-theme-settings',
        'capability'  => 'manage_options',
        'icon_url'    => 'dashicons-admin-customizer',
        'redirect'    => false,
    ));

    acf_add_options_sub_page(array(
        'page_title'  => 'Hero Section',
        'menu_title'  => 'Hero Section',
        'menu_slug'   => 'irf-settings-hero',
        'parent_slug' => 'irf-theme-settings',
    ));

    acf_add_options_sub_page(array(
        'page_title'  => 'CTA Section',
        'menu_title'  => 'CTA Section',
        'menu_slug'   => 'irf-settings-cta',
        'parent_slug' => 'irf-theme-settings',
    ));

    acf_add_options_sub_page(array(
        'page_title'  => 'Site Info & Social',
        'menu_title'  => 'Site Info & Social',
        'menu_slug'   => 'irf-settings-siteinfo',
        'parent_slug' => 'irf-theme-settings',
    ));

    acf_add_options_sub_page(array(
        'page_title'  => 'Exams Section',
        'menu_title'  => 'Exams Section',
        'menu_slug'   => 'irf-settings-exams',
        'parent_slug' => 'irf-theme-settings',
    ));

    acf_add_options_sub_page(array(
        'page_title'  => 'Learning Model',
        'menu_title'  => 'Learning Model',
        'menu_slug'   => 'irf-settings-learning',
        'parent_slug' => 'irf-theme-settings',
    ));

    acf_add_options_sub_page(array(
        'page_title'  => 'Facilities Section',
        'menu_title'  => 'Facilities',
        'menu_slug'   => 'irf-settings-facilities',
        'parent_slug' => 'irf-theme-settings',
    ));

    acf_add_options_sub_page(array(
        'page_title'  => 'YouTube Reels',
        'menu_title'  => 'YouTube Reels',
        'menu_slug'   => 'irf-settings-reels',
        'parent_slug' => 'irf-theme-settings',
    ));

    acf_add_options_sub_page(array(
        'page_title'  => 'Section Headers',
        'menu_title'  => 'Section Headers',
        'menu_slug'   => 'irf-settings-headers',
        'parent_slug' => 'irf-theme-settings',
    ));

    acf_add_options_sub_page(array(
        'page_title'  => 'About Page',
        'menu_title'  => 'About Page',
        'menu_slug'   => 'irf-settings-about',
        'parent_slug' => 'irf-theme-settings',
    ));
}


/* =============================================================
   ACF: REGISTER FIELD GROUPS
   ============================================================= */
add_action('acf/init', 'irf_register_acf_fields');
function irf_register_acf_fields() {
    if (!function_exists('acf_add_local_field_group')) return;

    /* ----------------------------------------------------------
       HERO SECTION (Options page)
    ---------------------------------------------------------- */
    acf_add_local_field_group(array(
        'key'      => 'group_irf_hero',
        'title'    => 'Hero Section',
        'location' => array(array(array(
            'param'    => 'options_page',
            'operator' => '==',
            'value'    => 'irf-settings-hero',
        ))),
        'fields' => array(
            array('key' => 'field_hero_badge',            'label' => 'Badge Text',              'name' => 'hero_badge',            'type' => 'text',     'default_value' => "India's #1 Competitive Exam Institute"),
            array('key' => 'field_hero_title',            'label' => 'Main Title',              'name' => 'hero_title',            'type' => 'text',     'default_value' => 'Crack Your Dream Exam with <span class="highlight">IRF – IACE</span>', 'instructions' => 'You can use HTML like &lt;span class="highlight"&gt;text&lt;/span&gt; for red highlight.'),
            array('key' => 'field_hero_subtitle',         'label' => 'Subtitle',                'name' => 'hero_subtitle',         'type' => 'text',     'default_value' => 'Smart preparation. Expert guidance. Proven results.'),
            array('key' => 'field_hero_typed_words',      'label' => 'Typed Words (one per line)', 'name' => 'hero_typed_words',  'type' => 'textarea', 'default_value' => "SSC CGL\nIBPS PO\nRBI Grade B\nSI Exam\nConstable\nRRB NTPC\nSBI PO", 'instructions' => 'Each word on a new line. These cycle in the typing animation.', 'rows' => 7),
            array('key' => 'field_hero_cta_primary_text', 'label' => 'Primary Button Text',     'name' => 'hero_cta_primary_text','type' => 'text',     'default_value' => 'Enroll Now'),
            array('key' => 'field_hero_cta_primary_url',  'label' => 'Primary Button URL',      'name' => 'hero_cta_primary_url', 'type' => 'url',      'default_value' => '/contact'),
            array('key' => 'field_hero_cta_sec_text',     'label' => 'Secondary Button Text',   'name' => 'hero_cta_sec_text',    'type' => 'text',     'default_value' => 'View Results'),
            array('key' => 'field_hero_cta_sec_url',      'label' => 'Secondary Button URL',    'name' => 'hero_cta_sec_url',     'type' => 'url',      'default_value' => '/results'),
            // Stats
            array('key' => 'field_hero_tab_stats',        'label' => 'Stats',                   'name' => '',                     'type' => 'tab'),
            array('key' => 'field_stat1_num',             'label' => 'Stat 1 – Number',         'name' => 'stat1_number',          'type' => 'number',   'default_value' => 5000),
            array('key' => 'field_stat1_suffix',          'label' => 'Stat 1 – Suffix',         'name' => 'stat1_suffix',          'type' => 'text',     'default_value' => '+'),
            array('key' => 'field_stat1_label',           'label' => 'Stat 1 – Label',          'name' => 'stat1_label',           'type' => 'text',     'default_value' => 'Students Enrolled'),
            array('key' => 'field_stat2_num',             'label' => 'Stat 2 – Number',         'name' => 'stat2_number',          'type' => 'number',   'default_value' => 1200),
            array('key' => 'field_stat2_suffix',          'label' => 'Stat 2 – Suffix',         'name' => 'stat2_suffix',          'type' => 'text',     'default_value' => '+'),
            array('key' => 'field_stat2_label',           'label' => 'Stat 2 – Label',          'name' => 'stat2_label',           'type' => 'text',     'default_value' => 'Selections Made'),
            array('key' => 'field_stat3_num',             'label' => 'Stat 3 – Number',         'name' => 'stat3_number',          'type' => 'number',   'default_value' => 10),
            array('key' => 'field_stat3_suffix',          'label' => 'Stat 3 – Suffix',         'name' => 'stat3_suffix',          'type' => 'text',     'default_value' => '+ Yrs'),
            array('key' => 'field_stat3_label',           'label' => 'Stat 3 – Label',          'name' => 'stat3_label',           'type' => 'text',     'default_value' => 'Experience'),
            array('key' => 'field_stat4_num',             'label' => 'Stat 4 – Number',         'name' => 'stat4_number',          'type' => 'number',   'default_value' => 98),
            array('key' => 'field_stat4_suffix',          'label' => 'Stat 4 – Suffix',         'name' => 'stat4_suffix',          'type' => 'text',     'default_value' => '%'),
            array('key' => 'field_stat4_label',           'label' => 'Stat 4 – Label',          'name' => 'stat4_label',           'type' => 'text',     'default_value' => 'Success Rate'),
        ),
    ));

    /* ----------------------------------------------------------
       CTA SECTION (Options page)
    ---------------------------------------------------------- */
    acf_add_local_field_group(array(
        'key'      => 'group_irf_cta',
        'title'    => 'CTA Section',
        'location' => array(array(array(
            'param'    => 'options_page',
            'operator' => '==',
            'value'    => 'irf-settings-cta',
        ))),
        'fields' => array(
            array('key' => 'field_cta_title',        'label' => 'Title',               'name' => 'cta_title',        'type' => 'text', 'default_value' => 'Ready to Start Your Government Job Journey?'),
            array('key' => 'field_cta_subtitle',     'label' => 'Subtitle',            'name' => 'cta_subtitle',     'type' => 'text', 'default_value' => 'Join 5,000+ students who trusted IRF and got selected. Your turn is next.'),
            array('key' => 'field_cta_btn1_text',    'label' => 'Button 1 Text',       'name' => 'cta_btn1_text',    'type' => 'text', 'default_value' => 'Enroll Now'),
            array('key' => 'field_cta_btn1_url',     'label' => 'Button 1 URL',        'name' => 'cta_btn1_url',     'type' => 'url',  'default_value' => '/contact'),
            array('key' => 'field_cta_btn2_text',    'label' => 'Button 2 Text',       'name' => 'cta_btn2_text',    'type' => 'text', 'default_value' => 'Call Us Now'),
            array('key' => 'field_cta_btn2_phone',   'label' => 'Button 2 Phone No.',  'name' => 'cta_btn2_phone',   'type' => 'text', 'default_value' => '+919876543210', 'instructions' => 'Include country code, no spaces. e.g. +919876543210'),
        ),
    ));

    /* ----------------------------------------------------------
       SITE INFO & SOCIAL (Options page)
    ---------------------------------------------------------- */
    acf_add_local_field_group(array(
        'key'      => 'group_irf_siteinfo',
        'title'    => 'Site Info & Social Links',
        'location' => array(array(array(
            'param'    => 'options_page',
            'operator' => '==',
            'value'    => 'irf-settings-siteinfo',
        ))),
        'fields' => array(
            array('key' => 'field_site_phone',    'label' => 'Phone Number',    'name' => 'site_phone',    'type' => 'text', 'default_value' => '+91 98765 43210'),
            array('key' => 'field_site_email',    'label' => 'Email Address',   'name' => 'site_email',    'type' => 'email','default_value' => 'info@irf-iace.com'),
            array('key' => 'field_site_address',  'label' => 'Address',         'name' => 'site_address',  'type' => 'textarea', 'rows' => 3, 'default_value' => '123, Main Road, Hyderabad, Telangana – 500001'),
            array('key' => 'field_social_tab',    'label' => 'Social Links',    'name' => '',              'type' => 'tab'),
            array('key' => 'field_social_youtube',   'label' => 'YouTube URL',    'name' => 'social_youtube',   'type' => 'url'),
            array('key' => 'field_social_instagram', 'label' => 'Instagram URL',  'name' => 'social_instagram', 'type' => 'url'),
            array('key' => 'field_social_facebook',  'label' => 'Facebook URL',   'name' => 'social_facebook',  'type' => 'url'),
            array('key' => 'field_social_telegram',  'label' => 'Telegram URL',   'name' => 'social_telegram',  'type' => 'url'),
        ),
    ));

    /* ----------------------------------------------------------
       EXAMS SECTION (Options page)
    ---------------------------------------------------------- */
    acf_add_local_field_group(array(
        'key'      => 'group_irf_exams',
        'title'    => 'Exams Section',
        'location' => array(array(array(
            'param'    => 'options_page',
            'operator' => '==',
            'value'    => 'irf-settings-exams',
        ))),
        'fields' => array(
            array('key' => 'field_exams_tag',      'label' => 'Section Tag',      'name' => 'exams_tag',      'type' => 'text',     'default_value' => 'What We Teach'),
            array('key' => 'field_exams_title',    'label' => 'Section Title',    'name' => 'exams_title',    'type' => 'text',     'default_value' => 'Exams We Prepare For'),
            array('key' => 'field_exams_subtitle', 'label' => 'Section Subtitle', 'name' => 'exams_subtitle', 'type' => 'text',     'default_value' => 'Comprehensive coaching for all major government competitive exams across India.'),
            array(
                'key'        => 'field_exams_list',
                'label'      => 'Exam Cards',
                'name'       => 'exams_list',
                'type'       => 'repeater',
                'min'        => 1,
                'layout'     => 'table',
                'button_label' => 'Add Exam',
                'sub_fields' => array(
                    array('key' => 'field_exam_icon', 'label' => 'Icon (Emoji)', 'name' => 'icon', 'type' => 'text', 'default_value' => '📋'),
                    array('key' => 'field_exam_name', 'label' => 'Short Name',   'name' => 'name', 'type' => 'text', 'placeholder' => 'e.g. SSC CGL'),
                    array('key' => 'field_exam_full', 'label' => 'Full Name',    'name' => 'full', 'type' => 'text', 'placeholder' => 'e.g. Combined Graduate Level'),
                ),
            ),
        ),
    ));


    /* ----------------------------------------------------------
       LEARNING MODEL SECTION (Options page)
    ---------------------------------------------------------- */
    acf_add_local_field_group(array(
        'key'      => 'group_irf_learning',
        'title'    => 'Learning Model Section',
        'location' => array(array(array(
            'param'    => 'options_page',
            'operator' => '==',
            'value'    => 'irf-settings-learning',
        ))),
        'fields' => array(
            array('key' => 'field_learn_tag',      'label' => 'Section Tag',      'name' => 'learning_tag',      'type' => 'text', 'default_value' => 'Our Methodology'),
            array('key' => 'field_learn_title',    'label' => 'Section Title',    'name' => 'learning_title',    'type' => 'text', 'default_value' => 'The IRF Learning Model'),
            array('key' => 'field_learn_subtitle', 'label' => 'Section Subtitle', 'name' => 'learning_subtitle', 'type' => 'text', 'default_value' => 'A proven 4-step framework that has produced thousands of government job selections.'),
            array(
                'key'          => 'field_learn_steps',
                'label'        => 'Steps',
                'name'         => 'learning_steps',
                'type'         => 'repeater',
                'min'          => 1,
                'max'          => 8,
                'layout'       => 'block',
                'button_label' => 'Add Step',
                'sub_fields'   => array(
                    array('key' => 'field_step_icon',  'label' => 'Icon (Emoji)',  'name' => 'icon',  'type' => 'text',     'default_value' => '📝'),
                    array('key' => 'field_step_title', 'label' => 'Step Title',    'name' => 'title', 'type' => 'text'),
                    array('key' => 'field_step_desc',  'label' => 'Description',   'name' => 'desc',  'type' => 'textarea', 'rows' => 2),
                ),
            ),
        ),
    ));


    /* ----------------------------------------------------------
       FACILITIES SECTION (Options page)
    ---------------------------------------------------------- */
    acf_add_local_field_group(array(
        'key'      => 'group_irf_facilities',
        'title'    => 'Facilities Section',
        'location' => array(array(array(
            'param'    => 'options_page',
            'operator' => '==',
            'value'    => 'irf-settings-facilities',
        ))),
        'fields' => array(
            array('key' => 'field_fac_tag',      'label' => 'Section Tag',      'name' => 'facilities_tag',      'type' => 'text', 'default_value' => 'World-Class Infrastructure'),
            array('key' => 'field_fac_title',    'label' => 'Section Title',    'name' => 'facilities_title',    'type' => 'text', 'default_value' => 'Our Facilities'),
            array('key' => 'field_fac_subtitle', 'label' => 'Section Subtitle', 'name' => 'facilities_subtitle', 'type' => 'text', 'default_value' => 'Everything you need to prepare, practice and perform — all under one roof.'),
            array(
                'key'          => 'field_fac_list',
                'label'        => 'Facility Cards',
                'name'         => 'facilities_list',
                'type'         => 'repeater',
                'min'          => 1,
                'layout'       => 'block',
                'button_label' => 'Add Facility',
                'sub_fields'   => array(
                    array('key' => 'field_fac_icon',  'label' => 'Icon (Emoji)', 'name' => 'icon',  'type' => 'text',     'default_value' => '🏛️'),
                    array('key' => 'field_fac_title2', 'label' => 'Title',       'name' => 'title', 'type' => 'text'),
                    array('key' => 'field_fac_desc',  'label' => 'Description',  'name' => 'desc',  'type' => 'textarea', 'rows' => 3),
                ),
            ),
        ),
    ));


    /* ----------------------------------------------------------
       YOUTUBE REELS SECTION (Options page)
    ---------------------------------------------------------- */
    acf_add_local_field_group(array(
        'key'      => 'group_irf_reels',
        'title'    => 'YouTube Reels Section',
        'location' => array(array(array(
            'param'    => 'options_page',
            'operator' => '==',
            'value'    => 'irf-settings-reels',
        ))),
        'fields' => array(
            array('key' => 'field_reels_tag',      'label' => 'Section Tag',      'name' => 'reels_tag',      'type' => 'text', 'default_value' => 'Watch & Learn'),
            array('key' => 'field_reels_title',    'label' => 'Section Title',    'name' => 'reels_title',    'type' => 'text', 'default_value' => 'IRF on YouTube'),
            array('key' => 'field_reels_subtitle', 'label' => 'Section Subtitle', 'name' => 'reels_subtitle', 'type' => 'text', 'default_value' => 'Quick exam tips, success stories and strategies — straight from our YouTube channel.'),
            array(
                'key'          => 'field_reels_videos',
                'label'        => 'YouTube Shorts',
                'name'         => 'reels_videos',
                'type'         => 'repeater',
                'layout'       => 'table',
                'button_label' => 'Add YouTube Short',
                'instructions' => 'Add each YouTube Shorts video ID (the part after youtube.com/shorts/)',
                'sub_fields'   => array(
                    array('key' => 'field_reel_video_id', 'label' => 'Video ID', 'name' => 'video_id', 'type' => 'text', 'placeholder' => 'e.g. dQw4w9WgXcQ'),
                ),
            ),
        ),
    ));


    /* ----------------------------------------------------------
       SECTION HEADERS — Results, Stories, Announcements
    ---------------------------------------------------------- */
    acf_add_local_field_group(array(
        'key'      => 'group_irf_headers',
        'title'    => 'Section Headers',
        'location' => array(array(array(
            'param'    => 'options_page',
            'operator' => '==',
            'value'    => 'irf-settings-headers',
        ))),
        'fields' => array(
            // Results
            array('key' => 'field_hdr_res_tab',      'label' => 'Results Section',        'name' => '',                   'type' => 'tab'),
            array('key' => 'field_hdr_res_tag',       'label' => 'Tag',                    'name' => 'results_tag',         'type' => 'text', 'default_value' => 'Proven Track Record'),
            array('key' => 'field_hdr_res_title',     'label' => 'Title',                  'name' => 'results_title',       'type' => 'text', 'default_value' => 'Our Toppers'),
            array('key' => 'field_hdr_res_subtitle',  'label' => 'Subtitle',               'name' => 'results_subtitle',    'type' => 'text', 'default_value' => 'Real students. Real results. Selections across every major competitive exam.'),
            array('key' => 'field_hdr_res_btn',       'label' => '"View All" Button Text', 'name' => 'results_btn_text',    'type' => 'text', 'default_value' => 'View All Results'),
            // Stories
            array('key' => 'field_hdr_sto_tab',      'label' => 'Success Stories Section', 'name' => '',                   'type' => 'tab'),
            array('key' => 'field_hdr_sto_tag',       'label' => 'Tag',                    'name' => 'stories_tag',         'type' => 'text', 'default_value' => 'Student Stories'),
            array('key' => 'field_hdr_sto_title',     'label' => 'Title',                  'name' => 'stories_title',       'type' => 'text', 'default_value' => 'What Our Students Say'),
            array('key' => 'field_hdr_sto_subtitle',  'label' => 'Subtitle',               'name' => 'stories_subtitle',    'type' => 'text', 'default_value' => 'Real voices. Real results. Students who cracked government exams with IRF – IACE.'),
            // Announcements
            array('key' => 'field_hdr_ann_tab',      'label' => 'Announcements Section',  'name' => '',                   'type' => 'tab'),
            array('key' => 'field_hdr_ann_tag',       'label' => 'Tag',                   'name' => 'ann_tag',             'type' => 'text', 'default_value' => 'Stay Updated'),
            array('key' => 'field_hdr_ann_title',     'label' => 'Title',                 'name' => 'ann_title',           'type' => 'text', 'default_value' => 'Latest Announcements'),
            array('key' => 'field_hdr_ann_subtitle',  'label' => 'Subtitle',              'name' => 'ann_subtitle',        'type' => 'text', 'default_value' => 'Upcoming events, exam schedules and important notifications from IRF.'),
            array('key' => 'field_hdr_ann_btn',       'label' => '"View All" Button Text','name' => 'ann_btn_text',        'type' => 'text', 'default_value' => 'View All Announcements'),
        ),
    ));


    /* ----------------------------------------------------------
       ABOUT PAGE (Options page)
    ---------------------------------------------------------- */
    acf_add_local_field_group(array(
        'key'      => 'group_irf_about',
        'title'    => 'About Page',
        'location' => array(array(array(
            'param'    => 'page_template',
            'operator' => '==',
            'value'    => 'template-about.php',
        ))),
        'fields' => array(

            /* ── TAB: Hero Banner ── */
            array('key' => 'field_ab_tab_banner',    'label' => 'Hero Banner',         'name' => '', 'type' => 'tab'),
            array('key' => 'field_ab_banner_title',  'label' => 'Banner Title',        'name' => 'about_banner_title', 'type' => 'text',  'default_value' => 'About IRF – IACE'),
            array('key' => 'field_ab_banner_sub',    'label' => 'Banner Subtitle',     'name' => 'about_banner_sub',   'type' => 'text',  'default_value' => "India's #1 Competitive Exam Coaching Institute"),
            array('key' => 'field_ab_hero_pill1',    'label' => 'Hero Pill 1',         'name' => 'about_hero_pill1',   'type' => 'text',  'default_value' => '🏛️ Est. 2014',        'instructions' => 'Short badge text, e.g. 🏛️ Est. 2014'),
            array('key' => 'field_ab_hero_pill2',    'label' => 'Hero Pill 2',         'name' => 'about_hero_pill2',   'type' => 'text',  'default_value' => '📍 Hyderabad',         'instructions' => 'Short badge text'),
            array('key' => 'field_ab_hero_pill3',    'label' => 'Hero Pill 3',         'name' => 'about_hero_pill3',   'type' => 'text',  'default_value' => '🎓 5000+ Students',    'instructions' => 'Short badge text'),
            array('key' => 'field_ab_hero_badge_num','label' => 'Hero Badge Number',   'name' => 'about_hero_badge_num','type' => 'text', 'default_value' => '10+',                'instructions' => 'Big number on the image badge, e.g. 10+'),
            array('key' => 'field_ab_hero_badge_txt','label' => 'Hero Badge Text',     'name' => 'about_hero_badge_txt','type' => 'text', 'default_value' => 'Years of Excellence', 'instructions' => 'Label below badge number'),
            array('key' => 'field_ab_intro_image',   'label' => 'Hero / About Image',  'name' => 'about_intro_image',  'type' => 'image', 'return_format' => 'array', 'preview_size' => 'medium'),

            /* ── TAB: Who We Are ── */
            array('key' => 'field_ab_tab_intro',     'label' => 'Who We Are',          'name' => '', 'type' => 'tab'),
            array('key' => 'field_ab_intro_tag',     'label' => 'Section Tag',         'name' => 'about_intro_tag',   'type' => 'text',    'default_value' => 'Who We Are'),
            array('key' => 'field_ab_intro_title',   'label' => 'Section Title',       'name' => 'about_intro_title', 'type' => 'text',    'default_value' => 'IRF – IACE Result Factory'),
            array('key' => 'field_ab_intro_text',    'label' => 'About Description',   'name' => 'about_intro_text',  'type' => 'wysiwyg', 'tabs' => 'visual', 'toolbar' => 'basic', 'media_upload' => 0,
                'default_value' => '<p>IRF – IACE Result Factory is a premier competitive exam coaching institute based in Hyderabad. Since 2014, we have been dedicated to shaping successful government job careers through smart preparation, consistent practice, and expert mentorship.</p><p>Our proven track record of selections across Banking, SSC, Railways and State PSC exams makes us the most trusted name in competitive exam coaching across South India.</p>'),
            array('key' => 'field_ab_collage_img1',  'label' => 'Collage Image 1 (Main)', 'name' => 'about_collage_img1', 'type' => 'image', 'return_format' => 'array', 'preview_size' => 'medium', 'instructions' => 'Large top image in photo collage'),
            array('key' => 'field_ab_collage_img2',  'label' => 'Collage Image 2',     'name' => 'about_collage_img2', 'type' => 'image', 'return_format' => 'array', 'preview_size' => 'thumbnail'),
            array('key' => 'field_ab_collage_img3',  'label' => 'Collage Image 3',     'name' => 'about_collage_img3', 'type' => 'image', 'return_format' => 'array', 'preview_size' => 'thumbnail'),
            array('key' => 'field_ab_collage_badge', 'label' => 'Collage Badge Text',  'name' => 'about_collage_badge','type' => 'text',  'default_value' => '10+ Years of Trust', 'instructions' => 'Text on collage badge. Use "10+ Years\\nof Trust" format — first word becomes bold number'),
            array(
                'key'          => 'field_ab_highlights',
                'label'        => 'Intro Highlights (Tick list)',
                'name'         => 'about_intro_highlights',
                'type'         => 'repeater',
                'min'          => 1,
                'layout'       => 'table',
                'button_label' => 'Add Highlight',
                'instructions' => 'Short bullet points shown with a red tick under the intro text',
                'sub_fields'   => array(
                    array('key' => 'field_ab_hl_text', 'label' => 'Highlight Text', 'name' => 'text', 'type' => 'text',
                        'default_value' => 'Expert faculty with 10+ years experience'),
                ),
            ),

            /* ── TAB: Mission & Vision ── */
            array('key' => 'field_ab_tab_mv',        'label' => 'Mission & Vision',    'name' => '', 'type' => 'tab'),
            array('key' => 'field_ab_mission_title',  'label' => 'Mission Card Title',  'name' => 'about_mission_title', 'type' => 'text',     'default_value' => 'Our Mission'),
            array('key' => 'field_ab_mission_text',   'label' => 'Mission Text',        'name' => 'about_mission_text',  'type' => 'textarea', 'rows' => 3, 'default_value' => 'To empower every aspiring government job candidate with world-class coaching, tools, and mentorship that maximizes their selection probability.'),
            array('key' => 'field_ab_vision_title',   'label' => 'Vision Card Title',   'name' => 'about_vision_title',  'type' => 'text',     'default_value' => 'Our Vision'),
            array('key' => 'field_ab_vision_text',    'label' => 'Vision Text',         'name' => 'about_vision_text',   'type' => 'textarea', 'rows' => 3, 'default_value' => 'To become the most trusted and results-driven competitive exam institute in South India, producing lakhs of government employees.'),

            /* ── TAB: Journey / Timeline ── */
            array('key' => 'field_ab_tab_journey',   'label' => 'Our Journey',         'name' => '', 'type' => 'tab'),
            array('key' => 'field_ab_journey_tag',   'label' => 'Section Tag',         'name' => 'about_journey_tag',   'type' => 'text', 'default_value' => 'Our Journey'),
            array('key' => 'field_ab_journey_title', 'label' => 'Section Title',       'name' => 'about_journey_title', 'type' => 'text', 'default_value' => 'A Decade of Transforming Lives'),
            array('key' => 'field_ab_journey_sub',   'label' => 'Section Subtitle',    'name' => 'about_journey_sub',   'type' => 'text', 'default_value' => "From a single classroom to South India's most trusted coaching brand"),
            array(
                'key'          => 'field_ab_timeline',
                'label'        => 'Timeline Items',
                'name'         => 'about_timeline',
                'type'         => 'repeater',
                'min'          => 1,
                'layout'       => 'block',
                'button_label' => 'Add Timeline Item',
                'sub_fields'   => array(
                    array('key' => 'field_ab_tl_year',  'label' => 'Year',        'name' => 'year',  'type' => 'text',     'placeholder' => 'e.g. 2014'),
                    array('key' => 'field_ab_tl_title', 'label' => 'Title',       'name' => 'title', 'type' => 'text'),
                    array('key' => 'field_ab_tl_desc',  'label' => 'Description', 'name' => 'desc',  'type' => 'textarea', 'rows' => 2),
                ),
            ),

            /* ── TAB: Core Values ── */
            array('key' => 'field_ab_tab_vals',      'label' => 'Core Values',         'name' => '', 'type' => 'tab'),
            array('key' => 'field_ab_vals_tag',      'label' => 'Section Tag',         'name' => 'about_values_tag',   'type' => 'text', 'default_value' => 'What We Stand For'),
            array('key' => 'field_ab_vals_title',    'label' => 'Section Title',       'name' => 'about_values_title', 'type' => 'text', 'default_value' => 'Our Core Values'),
            array('key' => 'field_ab_vals_sub',      'label' => 'Section Subtitle',    'name' => 'about_values_sub',   'type' => 'text', 'default_value' => 'The principles that guide everything we do'),
            array(
                'key'          => 'field_ab_values',
                'label'        => 'Values',
                'name'         => 'about_values',
                'type'         => 'repeater',
                'min'          => 1,
                'layout'       => 'table',
                'button_label' => 'Add Value',
                'sub_fields'   => array(
                    array('key' => 'field_ab_val_icon',  'label' => 'Icon (Emoji)', 'name' => 'icon',  'type' => 'text',     'default_value' => '⭐'),
                    array('key' => 'field_ab_val_title', 'label' => 'Title',        'name' => 'title', 'type' => 'text'),
                    array('key' => 'field_ab_val_desc',  'label' => 'Description',  'name' => 'desc',  'type' => 'textarea', 'rows' => 2),
                ),
            ),

            /* ── TAB: Why Choose Us ── */
            array('key' => 'field_ab_tab_why',       'label' => 'Why Choose Us',       'name' => '', 'type' => 'tab'),
            array('key' => 'field_ab_why_tag',       'label' => 'Section Tag',         'name' => 'about_why_tag',   'type' => 'text',  'default_value' => 'Why Choose Us'),
            array('key' => 'field_ab_why_title',     'label' => 'Section Title',       'name' => 'about_why_title', 'type' => 'text',  'default_value' => 'The IRF Advantage'),
            array('key' => 'field_ab_why_sub',       'label' => 'Section Subtitle',    'name' => 'about_why_sub',   'type' => 'text',  'default_value' => "We don't just teach — we build toppers. Every element of our program is engineered for maximum selection probability."),
            array('key' => 'field_ab_why_image',     'label' => 'Why Choose Us Image', 'name' => 'about_why_image', 'type' => 'image', 'return_format' => 'array', 'preview_size' => 'medium'),
            array('key' => 'field_ab_why_badge_num', 'label' => 'Image Badge Number',  'name' => 'about_why_badge_num', 'type' => 'text', 'default_value' => '1200+'),
            array('key' => 'field_ab_why_badge_txt', 'label' => 'Image Badge Label',   'name' => 'about_why_badge_txt', 'type' => 'text', 'default_value' => 'Selections'),
            array(
                'key'          => 'field_ab_why_items',
                'label'        => 'Advantage Items',
                'name'         => 'about_why_items',
                'type'         => 'repeater',
                'min'          => 1,
                'layout'       => 'block',
                'button_label' => 'Add Advantage',
                'instructions' => 'Each item shows with an auto-numbered red badge',
                'sub_fields'   => array(
                    array('key' => 'field_ab_why_item_title', 'label' => 'Title',       'name' => 'title', 'type' => 'text'),
                    array('key' => 'field_ab_why_item_desc',  'label' => 'Description', 'name' => 'desc',  'type' => 'textarea', 'rows' => 2),
                ),
            ),

            /* ── TAB: Team ── */
            array('key' => 'field_ab_tab_team',      'label' => 'Team',                'name' => '', 'type' => 'tab'),
            array('key' => 'field_ab_team_tag',      'label' => 'Section Tag',         'name' => 'about_team_tag',      'type' => 'text', 'default_value' => 'Our Experts'),
            array('key' => 'field_ab_team_title',    'label' => 'Section Title',       'name' => 'about_team_title',    'type' => 'text', 'default_value' => 'Meet Our Expert Faculty'),
            array('key' => 'field_ab_team_subtitle', 'label' => 'Section Subtitle',    'name' => 'about_team_subtitle', 'type' => 'text', 'default_value' => 'Experienced mentors dedicated to your success'),
            array(
                'key'          => 'field_ab_team_members',
                'label'        => 'Team Members',
                'name'         => 'about_team',
                'type'         => 'repeater',
                'layout'       => 'block',
                'button_label' => 'Add Team Member',
                'sub_fields'   => array(
                    array('key' => 'field_tm_photo',  'label' => 'Photo',        'name' => 'photo',      'type' => 'image',    'return_format' => 'array', 'preview_size' => 'thumbnail'),
                    array('key' => 'field_tm_name',   'label' => 'Name',         'name' => 'name',       'type' => 'text'),
                    array('key' => 'field_tm_role',   'label' => 'Role/Subject', 'name' => 'role',       'type' => 'text',     'placeholder' => 'e.g. Quantitative Aptitude Expert'),
                    array('key' => 'field_tm_exp',    'label' => 'Experience',   'name' => 'experience', 'type' => 'text',     'placeholder' => 'e.g. 10+ Years'),
                    array('key' => 'field_tm_bio',    'label' => 'Short Bio',    'name' => 'bio',        'type' => 'textarea', 'rows' => 2),
                ),
            ),

            /* ── TAB: CTA Banner ── */
            array('key' => 'field_ab_tab_cta',       'label' => 'CTA Banner',          'name' => '', 'type' => 'tab'),
            array('key' => 'field_ab_cta_title',     'label' => 'CTA Title',           'name' => 'about_cta_title',     'type' => 'text',    'default_value' => 'Ready to Start Your Government Job Journey?'),
            array('key' => 'field_ab_cta_sub',       'label' => 'CTA Subtitle',        'name' => 'about_cta_sub',       'type' => 'text',    'default_value' => 'Join 5000+ students who trusted IRF–IACE to crack their dream exam.'),
            array('key' => 'field_ab_cta_btn1_text', 'label' => 'Button 1 Text',       'name' => 'about_cta_btn1_text', 'type' => 'text',    'default_value' => 'Explore Courses'),
            array('key' => 'field_ab_cta_btn1_url',  'label' => 'Button 1 URL',        'name' => 'about_cta_btn1_url',  'type' => 'url',     'default_value' => ''),
            array('key' => 'field_ab_cta_btn2_text', 'label' => 'Button 2 Text',       'name' => 'about_cta_btn2_text', 'type' => 'text',    'default_value' => 'Talk to Us'),
            array('key' => 'field_ab_cta_btn2_url',  'label' => 'Button 2 URL',        'name' => 'about_cta_btn2_url',  'type' => 'url',     'default_value' => ''),
        ),
    ));


    /* ----------------------------------------------------------
       HOMEPAGE — attached to the front page editor
       Sections that match the actual homepage:
       Slider | YouTube Reels
    ---------------------------------------------------------- */
    acf_add_local_field_group(array(
        'key'      => 'group_irf_homepage',
        'title'    => 'HomePage',
        'location' => array(array(array(
            'param'    => 'page_type',
            'operator' => '==',
            'value'    => 'front_page',
        ))),
        'menu_order'            => 0,
        'position'              => 'normal',
        'style'                 => 'default',
        'label_placement'       => 'top',
        'instruction_placement' => 'label',
        'fields' => array(

            /* ---- TAB: Slider ---- */
            array('key' => 'field_hp_tab_slider', 'label' => 'Slider', 'name' => '', 'type' => 'tab', 'placement' => 'top'),
            array(
                'key'          => 'field_hp_banners',
                'label'        => 'Home Slide',
                'name'         => 'home_banners',
                'type'         => 'repeater',
                'instructions' => 'Add banner slides. Each slide shows a desktop image and a separate mobile image.',
                'min'          => 0,
                'layout'       => 'row',
                'button_label' => 'Add Slide',
                'sub_fields'   => array(
                    array('key' => 'field_bn_image',        'label' => 'Desktop Image', 'name' => 'image',        'type' => 'image', 'return_format' => 'array', 'preview_size' => 'medium',    'instructions' => 'Desktop &amp; Tablet: 1920×500px landscape (will auto-crop to 400px on tablet)'),
                    array('key' => 'field_bn_link',         'label' => 'Link',          'name' => 'link',         'type' => 'url',   'instructions' => 'Leave blank if slide is not clickable'),
                    array('key' => 'field_bn_mobile_image', 'label' => 'Mobile Image',  'name' => 'mobile_image', 'type' => 'image', 'return_format' => 'array', 'preview_size' => 'thumbnail', 'instructions' => 'Mobile: 640×360px landscape — shown on screens below 768px'),
                    array('key' => 'field_bn_mobile_link',  'label' => 'Mobile Link',   'name' => 'mobile_link',  'type' => 'url',   'instructions' => 'Optional — separate link for mobile'),
                ),
            ),

            /* ---- TAB: YouTube Reels ---- */
            array('key' => 'field_hp_tab_reels', 'label' => 'YouTube Reels', 'name' => '', 'type' => 'tab', 'placement' => 'top'),
            array('key' => 'field_hp_reels_tag',      'label' => 'Section Tag',      'name' => 'reels_tag',      'type' => 'text', 'default_value' => 'Watch & Learn'),
            array('key' => 'field_hp_reels_title',    'label' => 'Section Title',    'name' => 'reels_title',    'type' => 'text', 'default_value' => 'IRF on YouTube'),
            array('key' => 'field_hp_reels_subtitle', 'label' => 'Section Subtitle', 'name' => 'reels_subtitle', 'type' => 'text', 'default_value' => 'Quick exam tips, success stories and strategies — straight from our YouTube channel.'),
            array(
                'key'          => 'field_hp_reels_videos',
                'label'        => 'YouTube Shorts',
                'name'         => 'home_youtube_videos',
                'type'         => 'repeater',
                'min'          => 0,
                'layout'       => 'table',
                'button_label' => 'Add YouTube Short',
                'instructions' => 'Paste only the Video ID — the part after youtube.com/shorts/  e.g. for youtube.com/shorts/dQw4w9WgXcQ enter: dQw4w9WgXcQ',
                'sub_fields'   => array(
                    array('key' => 'field_hp_reel_id', 'label' => 'YouTube Short Video ID', 'name' => 'video_id', 'type' => 'text', 'placeholder' => 'e.g. dQw4w9WgXcQ'),
                ),
            ),

        ),
    ));


    /* ----------------------------------------------------------
       RESULTS PAGE (page template)
    ---------------------------------------------------------- */
    acf_add_local_field_group(array(
        'key'      => 'group_irf_results_page',
        'title'    => 'Results Page',
        'location' => array(array(array('param' => 'page_template', 'operator' => '==', 'value' => 'template-results.php'))),
        'fields'   => array(

            /* ── TAB: Hero Slides ── */
            array('key' => 'field_rp_tab_slides', 'label' => 'Hero Slides', 'name' => '', 'type' => 'tab'),
            array(
                'key'          => 'field_rp_banners',
                'label'        => 'Banner Slides',
                'name'         => 'results_banners',
                'type'         => 'repeater',
                'instructions' => 'Add up to 5 slides. Leave empty to use built-in default slides.',
                'min'          => 0,
                'layout'       => 'row',
                'button_label' => 'Add Slide',
                'sub_fields'   => array(
                    array(
                        'key'           => 'field_rp_rb_bg_img',
                        'label'         => 'Desktop Banner Image',
                        'name'          => 'rb_bg_image',
                        'type'          => 'image',
                        'return_format' => 'array',
                        'preview_size'  => 'medium',
                        'instructions'  => 'Recommended: 1920×600px landscape. Shown on desktop.',
                        'wrapper'       => array('width' => '50'),
                    ),
                    array(
                        'key'           => 'field_rp_rb_mobile_img',
                        'label'         => 'Mobile Banner Image',
                        'name'          => 'rb_mobile_image',
                        'type'          => 'image',
                        'return_format' => 'array',
                        'preview_size'  => 'medium',
                        'instructions'  => 'Recommended: 640×360px. Shown on screens below 768px.',
                        'wrapper'       => array('width' => '50'),
                    ),
                ),
            ),

            /* ── TAB: Stats Strip ── */
            array('key' => 'field_rp_tab_stats', 'label' => 'Stats Strip', 'name' => '', 'type' => 'tab'),
            array('key' => 'field_rp_stat1_num', 'label' => 'Stat 1 Number', 'name' => 'results_stat1_num', 'type' => 'text', 'default_value' => '5000', 'instructions' => 'Numeric value only (will animate as a counter)', 'wrapper' => array('width' => '33')),
            array('key' => 'field_rp_stat1_sfx', 'label' => 'Stat 1 Suffix', 'name' => 'results_stat1_sfx', 'type' => 'text', 'default_value' => '+',     'wrapper' => array('width' => '17')),
            array('key' => 'field_rp_stat1_lbl', 'label' => 'Stat 1 Label',  'name' => 'results_stat1_lbl', 'type' => 'text', 'default_value' => 'Total Selections', 'wrapper' => array('width' => '50')),
            array('key' => 'field_rp_stat2_num', 'label' => 'Stat 2 Number', 'name' => 'results_stat2_num', 'type' => 'text', 'default_value' => '50',    'wrapper' => array('width' => '33')),
            array('key' => 'field_rp_stat2_sfx', 'label' => 'Stat 2 Suffix', 'name' => 'results_stat2_sfx', 'type' => 'text', 'default_value' => '+',     'wrapper' => array('width' => '17')),
            array('key' => 'field_rp_stat2_lbl', 'label' => 'Stat 2 Label',  'name' => 'results_stat2_lbl', 'type' => 'text', 'default_value' => 'Exams Covered', 'wrapper' => array('width' => '50')),
            array('key' => 'field_rp_stat3_num', 'label' => 'Stat 3 Number', 'name' => 'results_stat3_num', 'type' => 'text', 'default_value' => '10',    'wrapper' => array('width' => '33')),
            array('key' => 'field_rp_stat3_sfx', 'label' => 'Stat 3 Suffix', 'name' => 'results_stat3_sfx', 'type' => 'text', 'default_value' => '+',     'wrapper' => array('width' => '17')),
            array('key' => 'field_rp_stat3_lbl', 'label' => 'Stat 3 Label',  'name' => 'results_stat3_lbl', 'type' => 'text', 'default_value' => 'Years of Results', 'wrapper' => array('width' => '50')),
            array('key' => 'field_rp_stat4_num', 'label' => 'Stat 4 Number', 'name' => 'results_stat4_num', 'type' => 'text', 'default_value' => '98',    'wrapper' => array('width' => '33')),
            array('key' => 'field_rp_stat4_sfx', 'label' => 'Stat 4 Suffix', 'name' => 'results_stat4_sfx', 'type' => 'text', 'default_value' => '%',     'wrapper' => array('width' => '17')),
            array('key' => 'field_rp_stat4_lbl', 'label' => 'Stat 4 Label',  'name' => 'results_stat4_lbl', 'type' => 'text', 'default_value' => 'Success Rate', 'wrapper' => array('width' => '50')),

            /* ── TAB: Year-wise Section ── */
            array('key' => 'field_rp_tab_yr',    'label' => 'Year-wise Section', 'name' => '', 'type' => 'tab'),
            array('key' => 'field_rp_yr_tag',    'label' => 'Section Tag',       'name' => 'results_yr_tag',      'type' => 'text', 'default_value' => 'Year by Year'),
            array('key' => 'field_rp_yr_title',  'label' => 'Section Title',     'name' => 'results_yr_title',    'type' => 'text', 'default_value' => 'Results Timeline'),
            array('key' => 'field_rp_yr_sub',    'label' => 'Section Subtitle',  'name' => 'results_yr_subtitle', 'type' => 'text', 'default_value' => 'Our consistent selection record year after year.'),

            /* ── TAB: Exam-wise Section ── */
            array('key' => 'field_rp_tab_ex',    'label' => 'Exam-wise Section', 'name' => '', 'type' => 'tab'),
            array('key' => 'field_rp_ex_tag',    'label' => 'Section Tag',       'name' => 'results_ex_tag',      'type' => 'text', 'default_value' => 'All Categories'),
            array('key' => 'field_rp_ex_title',  'label' => 'Section Title',     'name' => 'results_ex_title',    'type' => 'text', 'default_value' => 'Browse by Exam'),
            array('key' => 'field_rp_ex_sub',    'label' => 'Section Subtitle',  'name' => 'results_ex_subtitle', 'type' => 'text', 'default_value' => 'Filter results by exam category to find toppers in your target exam.'),

            /* ── TAB: Student Fields ── */
            array('key' => 'field_rp_tab_students', 'label' => 'Student Fields', 'name' => '', 'type' => 'tab'),
            array(
                'key'          => 'field_rp_students',
                'label'        => 'Student Fields',
                'name'         => 'results_students',
                'type'         => 'repeater',
                'instructions' => 'Add one row per student result. Rows are shown in the Year-wise and Exam-wise sections.',
                'min'          => 0,
                'layout'       => 'table',
                'button_label' => 'Add Row',
                'sub_fields'   => array(
                    array(
                        'key'           => 'field_rp_rs_category',
                        'label'         => 'Exam Category',
                        'name'          => 'rs_exam_category',
                        'type'          => 'select',
                        'choices'       => array(
                            'SSC'       => 'SSC',
                            'Banking'   => 'Banking',
                            'RRB'       => 'RRB',
                            'Police'    => 'Police',
                            'UPSC'      => 'UPSC',
                            'State PSC' => 'State PSC',
                            'Defence'   => 'Defence',
                        ),
                        'allow_null'    => 0,
                        'return_format' => 'value',
                        'wrapper'       => array('width' => '12'),
                    ),
                    array(
                        'key'           => 'field_rp_rs_image',
                        'label'         => 'Student Image',
                        'name'          => 'rs_student_image',
                        'type'          => 'image',
                        'return_format' => 'array',
                        'preview_size'  => 'thumbnail',
                        'wrapper'       => array('width' => '18'),
                    ),
                    array(
                        'key'     => 'field_rp_rs_name',
                        'label'   => 'Student Name',
                        'name'    => 'rs_student_name',
                        'type'    => 'text',
                        'wrapper' => array('width' => '20'),
                    ),
                    array(
                        'key'         => 'field_rp_rs_exam',
                        'label'       => 'Exam Cleared',
                        'name'        => 'rs_exam_cleared',
                        'type'        => 'text',
                        'placeholder' => 'e.g. IBPS (RRB) PO',
                        'wrapper'     => array('width' => '20'),
                    ),
                    array(
                        'key'         => 'field_rp_rs_htno',
                        'label'       => 'Hall Ticket No',
                        'name'        => 'rs_ht_no',
                        'type'        => 'text',
                        'wrapper'     => array('width' => '15'),
                    ),
                    array(
                        'key'           => 'field_rp_rs_date',
                        'label'         => 'Result Date',
                        'name'          => 'rs_result_date',
                        'type'          => 'date_picker',
                        'display_format' => 'd/m/Y',
                        'return_format'  => 'Y-m-d',
                        'first_day'      => 1,
                        'wrapper'        => array('width' => '15'),
                    ),
                ),
            ),
        ),
    ));

    /* ----------------------------------------------------------
       SUCCESS STORIES PAGE (page template)
    ---------------------------------------------------------- */
    acf_add_local_field_group(array(
        'key'      => 'group_irf_stories_page',
        'title'    => 'Success Stories Page',
        'location' => array(array(array('param' => 'page_template', 'operator' => '==', 'value' => 'template-stories.php'))),
        'fields' => array(
            array('key' => 'field_sp_tab_banner',   'label' => 'Page Banner',     'name' => '', 'type' => 'tab'),
            array('key' => 'field_sp_banner_title', 'label' => 'Banner Title',    'name' => 'banner_title',    'type' => 'text', 'default_value' => 'Success Stories'),
            array('key' => 'field_sp_banner_sub',   'label' => 'Banner Subtitle', 'name' => 'banner_subtitle', 'type' => 'text', 'default_value' => 'Students who achieved their dreams with IRF.'),
            array('key' => 'field_sp_tab_section',  'label' => 'Section Header',  'name' => '', 'type' => 'tab'),
            array('key' => 'field_sp_sec_tag',      'label' => 'Section Tag',     'name' => 'section_tag',     'type' => 'text', 'default_value' => 'Student Stories'),
            array('key' => 'field_sp_sec_title',    'label' => 'Section Title',   'name' => 'section_title',   'type' => 'text', 'default_value' => 'Hear From Our Students'),
            array('key' => 'field_sp_sec_subtitle', 'label' => 'Section Subtitle','name' => 'section_subtitle','type' => 'text', 'default_value' => 'Real experiences from students who achieved their government job dreams with IRF.'),
        ),
    ));

    /* ----------------------------------------------------------
       ANNOUNCEMENTS PAGE (page template)
    ---------------------------------------------------------- */
    acf_add_local_field_group(array(
        'key'      => 'group_irf_ann_page',
        'title'    => 'Announcements Page',
        'location' => array(array(array('param' => 'page_template', 'operator' => '==', 'value' => 'template-announcements.php'))),
        'fields' => array(
            array('key' => 'field_ap_tab_banner',   'label' => 'Page Banner',     'name' => '', 'type' => 'tab'),
            array('key' => 'field_ap_banner_title', 'label' => 'Banner Title',    'name' => 'banner_title',    'type' => 'text', 'default_value' => 'Announcements & Events'),
            array('key' => 'field_ap_banner_sub',   'label' => 'Banner Subtitle', 'name' => 'banner_subtitle', 'type' => 'text', 'default_value' => 'Stay updated with the latest from IRF.'),
            array('key' => 'field_ap_tab_section',  'label' => 'Section Header',  'name' => '', 'type' => 'tab'),
            array('key' => 'field_ap_sec_tag',      'label' => 'Section Tag',     'name' => 'section_tag',     'type' => 'text', 'default_value' => 'Stay Updated'),
            array('key' => 'field_ap_sec_title',    'label' => 'Section Title',   'name' => 'section_title',   'type' => 'text', 'default_value' => 'Latest Announcements'),
            array('key' => 'field_ap_sec_subtitle', 'label' => 'Section Subtitle','name' => 'section_subtitle','type' => 'text', 'default_value' => 'Upcoming events, exam schedules and important notifications from IRF.'),
        ),
    ));

    /* ----------------------------------------------------------
       BLOG PAGE (Posts page in Settings > Reading)
    ---------------------------------------------------------- */
    acf_add_local_field_group(array(
        'key'      => 'group_irf_blog_page',
        'title'    => 'Blog Page',
        'location' => array(array(array('param' => 'page_type', 'operator' => '==', 'value' => 'posts_page'))),
        'fields' => array(
            array('key' => 'field_bp_tab_banner',   'label' => 'Page Banner',     'name' => '', 'type' => 'tab'),
            array('key' => 'field_bp_banner_title', 'label' => 'Banner Title',    'name' => 'banner_title',    'type' => 'text', 'default_value' => 'Blog'),
            array('key' => 'field_bp_banner_sub',   'label' => 'Banner Subtitle', 'name' => 'banner_subtitle', 'type' => 'text', 'default_value' => 'Exam tips, strategy guides and success stories.'),
            array('key' => 'field_bp_tab_section',  'label' => 'Section Header',  'name' => '', 'type' => 'tab'),
            array('key' => 'field_bp_sec_tag',      'label' => 'Section Tag',     'name' => 'section_tag',     'type' => 'text', 'default_value' => 'Latest Articles'),
            array('key' => 'field_bp_sec_title',    'label' => 'Section Title',   'name' => 'section_title',   'type' => 'text', 'default_value' => 'IRF Blog'),
            array('key' => 'field_bp_sec_subtitle', 'label' => 'Section Subtitle','name' => 'section_subtitle','type' => 'text', 'default_value' => 'Exam tips, strategy guides, and success stories from our faculty and students.'),
        ),
    ));

    /* ----------------------------------------------------------
       RESULTS CPT FIELDS
    ---------------------------------------------------------- */
    acf_add_local_field_group(array(
        'key'      => 'group_irf_results',
        'title'    => 'Result Details',
        'location' => array(array(array(
            'param'    => 'post_type',
            'operator' => '==',
            'value'    => 'results',
        ))),
        'fields' => array(
            array('key' => 'field_res_student_name',  'label' => 'Student Name',   'name' => 'student_name',  'type' => 'text',  'required' => 1),
            array('key' => 'field_res_exam_name',     'label' => 'Exam Name',      'name' => 'exam_name',     'type' => 'text',  'required' => 1, 'placeholder' => 'e.g. SSC CGL 2024'),
            array('key' => 'field_res_ht_no',         'label' => 'HT No (Hall Ticket)', 'name' => 'ht_no',    'type' => 'text',  'placeholder' => 'e.g. HT2025001234'),
            array('key' => 'field_res_year',          'label' => 'Year',           'name' => 'year',          'type' => 'text',  'placeholder' => 'e.g. 2024'),
            array('key' => 'field_res_student_photo', 'label' => 'Student Photo',  'name' => 'student_photo', 'type' => 'image', 'return_format' => 'array', 'preview_size' => 'thumbnail'),
        ),
    ));

    /* ----------------------------------------------------------
       SUCCESS STORIES CPT FIELDS
    ---------------------------------------------------------- */
    acf_add_local_field_group(array(
        'key'      => 'group_irf_stories',
        'title'    => 'Success Story Details',
        'location' => array(array(array(
            'param'    => 'post_type',
            'operator' => '==',
            'value'    => 'success_stories',
        ))),
        'fields' => array(
            array('key' => 'field_sto_student_name',  'label' => 'Student Name',     'name' => 'student_name',    'type' => 'text',     'required' => 1),
            array('key' => 'field_sto_exam_cleared',  'label' => 'Exam Cleared',     'name' => 'exam_cleared',    'type' => 'text',     'required' => 1, 'placeholder' => 'e.g. IBPS PO 2024'),
            array('key' => 'field_sto_rank',          'label' => 'Rank',             'name' => 'rank',            'type' => 'text',     'placeholder' => 'e.g. 87'),
            array('key' => 'field_sto_message',       'label' => 'Student Message',  'name' => 'student_message', 'type' => 'textarea', 'required' => 1, 'rows' => 4, 'instructions' => 'What the student wants to say about IRF. Keep it 1–3 sentences.'),
            array('key' => 'field_sto_photo',         'label' => 'Student Photo',    'name' => 'student_photo',   'type' => 'image',    'return_format' => 'array', 'preview_size' => 'thumbnail'),
        ),
    ));

    /* ----------------------------------------------------------
       ANNOUNCEMENTS CPT FIELDS
    ---------------------------------------------------------- */
    acf_add_local_field_group(array(
        'key'      => 'group_irf_announcements',
        'title'    => 'Announcement Details',
        'location' => array(array(array(
            'param'    => 'post_type',
            'operator' => '==',
            'value'    => 'announcements',
        ))),
        'fields' => array(
            array('key' => 'field_ann_event_type', 'label' => 'Event Type',        'name' => 'event_type',        'type' => 'select',   'required' => 1,
                'choices' => array(
                    'Batch'      => '📚 New Batch',
                    'Flash News' => '⚡ Flash News',
                    'Result'     => '🏆 Our Results',
                    'Schedule'   => '📅 Live Schedule',
                    'Event'      => 'Event',
                    'Exam'       => 'Exam',
                    'Workshop'   => 'Workshop',
                    'Notice'     => 'Notice',
                    'Holiday'    => 'Holiday',
                ),
                'default_value' => 'Flash News',
                'ui' => 1,
            ),
            array('key' => 'field_ann_event_date',  'label' => 'Event Date',       'name' => 'event_date',        'type' => 'date_picker', 'display_format' => 'd M Y', 'return_format' => 'd M Y'),
            array('key' => 'field_ann_event_desc',  'label' => 'Short Description','name' => 'event_description', 'type' => 'textarea', 'rows' => 3),
            array('key' => 'field_ann_event_image', 'label' => 'Event Image',      'name' => 'event_image',       'type' => 'image',    'return_format' => 'array', 'preview_size' => 'medium'),
        ),
    ));
}
