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
    wp_enqueue_style('irf-main', get_template_directory_uri() . '/assets/css/main.css', array(), '2.1');
    wp_enqueue_style('irf-style', get_stylesheet_uri(), array('irf-main'), '2.1');
    wp_enqueue_script('irf-main', get_template_directory_uri() . '/assets/js/main.js', array(), '2.1', true);
}
add_action('wp_enqueue_scripts', 'irf_enqueue_scripts');


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
        'supports'          => array('title', 'thumbnail'),
        'show_in_rest'      => true,
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
            array('key' => 'field_res_rank',          'label' => 'Rank / Roll No', 'name' => 'rank',          'type' => 'text',  'placeholder' => 'e.g. 142'),
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
                    'Event'    => 'Event',
                    'Exam'     => 'Exam',
                    'Workshop' => 'Workshop',
                    'Notice'   => 'Notice',
                    'Result'   => 'Result',
                    'Holiday'  => 'Holiday',
                ),
                'default_value' => 'Event',
                'ui' => 1,
            ),
            array('key' => 'field_ann_event_date',  'label' => 'Event Date',       'name' => 'event_date',        'type' => 'date_picker', 'display_format' => 'd M Y', 'return_format' => 'd M Y'),
            array('key' => 'field_ann_event_desc',  'label' => 'Short Description','name' => 'event_description', 'type' => 'textarea', 'rows' => 3),
            array('key' => 'field_ann_event_image', 'label' => 'Event Image',      'name' => 'event_image',       'type' => 'image',    'return_format' => 'array', 'preview_size' => 'medium'),
        ),
    ));
}
