<?php
/**
 * Template Name: Campus Selection
 *
 * @package irf-theme
 */
get_header();

/* ══════════════════════════════════════════════════════════════
   ICON HELPER
   ══════════════════════════════════════════════════════════════ */
function cmp_icon( $name ) {
    $icons = array(
        /* selector / facility chips */
        'book'        => '<svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"/><path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"/></svg>',
        'monitor'     => '<svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="3" width="20" height="14" rx="2"/><line x1="8" y1="21" x2="16" y2="21"/><line x1="12" y1="17" x2="12" y2="21"/></svg>',
        'users'       => '<svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>',
        'clipboard'   => '<svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M16 4h2a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h2"/><rect x="8" y="2" width="8" height="4" rx="1"/><line x1="9" y1="12" x2="15" y2="12"/><line x1="9" y1="16" x2="12" y2="16"/></svg>',
        'bar-chart'   => '<svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="20" x2="18" y2="10"/><line x1="12" y1="20" x2="12" y2="4"/><line x1="6" y1="20" x2="6" y2="14"/><line x1="2" y1="20" x2="22" y2="20"/></svg>',
        'target'      => '<svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><circle cx="12" cy="12" r="6"/><circle cx="12" cy="12" r="2"/></svg>',
        'building'    => '<svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>',
        'arrow'       => '<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>',
        'check'       => '<svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>',
        'pin'         => '<svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>',
        /* new icons */
        'shield'      => '<svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>',
        'trending-up' => '<svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="23 6 13.5 15.5 8.5 10.5 1 18"/><polyline points="17 6 23 6 23 12"/></svg>',
        'clock'       => '<svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>',
        'home'        => '<svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>',
        'coffee'      => '<svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 8h1a4 4 0 0 1 0 8h-1"/><path d="M2 8h16v9a4 4 0 0 1-4 4H6a4 4 0 0 1-4-4V8z"/><line x1="6" y1="1" x2="6" y2="4"/><line x1="10" y1="1" x2="10" y2="4"/><line x1="14" y1="1" x2="14" y2="4"/></svg>',
        'book-open'   => '<svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M2 3h6a4 4 0 0 1 4 4v14a3 3 0 0 0-3-3H2z"/><path d="M22 3h-6a4 4 0 0 0-4 4v14a3 3 0 0 1 3-3h7z"/></svg>',
        'trophy'      => '<svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="8 21 12 17 16 21"/><line x1="12" y1="17" x2="12" y2="11"/><path d="M7 4h10l1 7a5 5 0 0 1-5 5 5 5 0 0 1-5-5L7 4z"/><path d="M5 4H3a1 1 0 0 0-1 1v1a5 5 0 0 0 5 5"/><path d="M19 4h2a1 1 0 0 1 1 1v1a5 5 0 0 1-5 5"/></svg>',
        'star'        => '<svg width="22" height="22" viewBox="0 0 24 24" fill="currentColor" stroke="none"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>',
        'phone'       => '<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07A19.5 19.5 0 0 1 4.69 12a19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 3.6 1.18h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 8.91a16 16 0 0 0 6 6l.72-.81a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/></svg>',
        'mail'        => '<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>',
        'map-pin'     => '<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>',
        'send'        => '<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="22" y1="2" x2="11" y2="13"/><polygon points="22 2 15 22 11 13 2 9 22 2"/></svg>',
        'play'        => '<svg width="22" height="22" viewBox="0 0 24 24" fill="currentColor" stroke="none"><polygon points="5 3 19 12 5 21 5 3"/></svg>',
        'whatsapp'    => '<svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 0 1-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 0 1-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 0 1 2.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0 0 12.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 0 0 5.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 0 0-3.48-8.413z"/></svg>',
        'award'       => '<svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="8" r="6"/><path d="M15.477 12.89L17 22l-5-3-5 3 1.523-9.11"/></svg>',
        'zap'         => '<svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polygon points="13 2 3 14 12 14 11 22 21 10 12 10 13 2"/></svg>',
    );
    return isset( $icons[ $name ] ) ? $icons[ $name ] : '';
}

/* ══════════════════════════════════════════════════════════════
   BUILD CAMPUS DATA FROM ACF
   ══════════════════════════════════════════════════════════════ */
$acf_rows = function_exists( 'get_field' ) ? get_field( 'campuses' ) : array();
$campuses = array();

if ( ! empty( $acf_rows ) ) {
    foreach ( $acf_rows as $row ) {
        $name  = ! empty( $row['campus_name'] )         ? $row['campus_name']         : '';
        $image = ! empty( $row['campus_image']['url'] )  ? $row['campus_image']['url']  : '';
        $alt   = ! empty( $row['campus_image']['alt'] )  ? $row['campus_image']['alt']  : $name;

        /* Selector facilities */
        $facilities = array();
        if ( ! empty( $row['campus_facilities'] ) ) {
            foreach ( $row['campus_facilities'] as $fac ) {
                $facilities[] = array( 'name' => $fac['facility_name'], 'icon' => $fac['facility_icon'] );
            }
        }

        /* Why choose points */
        $why_points = array();
        if ( ! empty( $row['campus_why_points'] ) ) {
            foreach ( $row['campus_why_points'] as $wp ) {
                $why_points[] = array( 'icon' => $wp['why_icon'], 'title' => $wp['why_title'], 'desc' => $wp['why_desc'] );
            }
        }

        /* Facilities detail */
        $fac_detail = array();
        if ( ! empty( $row['campus_fac_detail'] ) ) {
            foreach ( $row['campus_fac_detail'] as $fd ) {
                $fac_detail[] = array( 'icon' => $fd['fac_icon'], 'name' => $fd['fac_name'], 'desc' => $fd['fac_desc'] );
            }
        }

        /* Daily routine */
        $routine = array();
        if ( ! empty( $row['campus_routine'] ) ) {
            foreach ( $row['campus_routine'] as $r ) {
                $routine[] = array( 'time' => $r['routine_time'], 'title' => $r['routine_title'], 'desc' => $r['routine_desc'] );
            }
        }

        /* Videos */
        $videos = array();
        if ( ! empty( $row['campus_videos'] ) ) {
            foreach ( $row['campus_videos'] as $v ) {
                $videos[] = array( 'id' => $v['video_id'], 'title' => $v['video_title'] );
            }
        }

        /* Stats */
        $stats = array();
        if ( ! empty( $row['campus_stats'] ) ) {
            foreach ( $row['campus_stats'] as $s ) {
                $stats[] = array( 'number' => $s['stat_number'], 'label' => $s['stat_label'] );
            }
        }

        /* Achievements */
        $achievements = array();
        if ( ! empty( $row['campus_achievements'] ) ) {
            foreach ( $row['campus_achievements'] as $a ) {
                $achievements[] = array(
                    'name'  => $a['ach_name'],
                    'exam'  => $a['ach_exam'],
                    'rank'  => $a['ach_rank'],
                    'photo' => ! empty( $a['ach_photo']['url'] ) ? $a['ach_photo']['url'] : '',
                );
            }
        }

        /* Contact */
        $contact = array(
            'phone'    => ! empty( $row['campus_phone'] )    ? $row['campus_phone']    : '',
            'whatsapp' => ! empty( $row['campus_whatsapp'] ) ? $row['campus_whatsapp'] : '',
            'email'    => ! empty( $row['campus_email'] )    ? $row['campus_email']    : '',
            'address'  => ! empty( $row['campus_address'] )  ? $row['campus_address']  : '',
            'maps_url' => ! empty( $row['campus_maps_url'] ) ? $row['campus_maps_url'] : '#',
        );

        $campuses[] = array(
            'id'          => sanitize_title( $name ),
            'name'        => $name,
            'tagline'     => ! empty( $row['campus_tagline'] )     ? $row['campus_tagline']     : '',
            'location'    => ! empty( $row['campus_location'] )    ? $row['campus_location']    : '',
            'image'       => $image,
            'image_alt'   => $alt,
            'description' => ! empty( $row['campus_description'] ) ? $row['campus_description'] : '',
            'cta_url'     => ! empty( $row['campus_cta_url'] )     ? $row['campus_cta_url']     : '#',
            'cta_label'   => ! empty( $row['campus_cta_label'] )   ? $row['campus_cta_label']   : 'Explore Full Campus',
            'facilities'  => $facilities,
            'why_points'  => $why_points,
            'fac_detail'  => $fac_detail,
            'routine'     => $routine,
            'videos'      => $videos,
            'stats'       => $stats,
            'achievements'=> $achievements,
            'contact'     => $contact,
        );
    }
}

/* ── Fallback dummy data ── */
if ( empty( $campuses ) ) {
    $dummy_why = array(
        array( 'icon' => 'shield',       'title' => 'Distraction-Free Environment',   'desc' => 'Purpose-built campus with zero tolerance for distractions. Every corner is designed to keep aspirants in deep focus mode — only serious goals thrive here.' ),
        array( 'icon' => 'users',        'title' => 'Continuous Mentor Guidance',     'desc' => 'Dedicated mentors personally track every student\'s daily progress. One-on-one doubt sessions and real-time feedback ensure no one is left behind.' ),
        array( 'icon' => 'trending-up',  'title' => 'Result-Oriented System',         'desc' => 'Data-driven preparation with daily mock tests, individual performance analytics, and targeted improvement plans that have produced 5,000+ selections.' ),
    );
    $dummy_fac = array(
        array( 'icon' => 'book',      'name' => 'Spacious Practice Hall',     'desc' => '500-seat air-conditioned hall for focused, distraction-free daily practice with dedicated seating for every student.' ),
        array( 'icon' => 'monitor',   'name' => 'CBT Computer Lab',           'desc' => '50+ high-spec systems loaded with the latest competitive exam simulation software — real exam feel every day.' ),
        array( 'icon' => 'clock',     'name' => 'Structured 10-Hour Day',     'desc' => 'Expert-monitored daily schedule that maximises every hour — from morning assembly to night self-study.' ),
        array( 'icon' => 'home',      'name' => 'Residential Hostel',         'desc' => 'Safe, affordable on-campus accommodation with 24/7 security — no commute means more study time.' ),
        array( 'icon' => 'coffee',    'name' => 'Campus Cafeteria',           'desc' => 'Nutritious, affordable meals served fresh three times a day to keep aspirants energised through long study hours.' ),
        array( 'icon' => 'book-open', 'name' => 'Reference Library',          'desc' => '1,000+ books, previous year papers, and current affairs magazines available for deep self-study sessions.' ),
    );
    $dummy_routine = array(
        array( 'time' => '5:30 AM', 'title' => 'Wake Up & Morning Routine',        'desc' => 'Begin the day fresh with light exercise and positive mental conditioning.' ),
        array( 'time' => '6:00 AM', 'title' => 'Morning Assembly',                 'desc' => 'Group motivation session — daily targets, positive affirmations, and mindset reset by mentors.' ),
        array( 'time' => '7:00 AM', 'title' => 'Revision Hour',                    'desc' => 'Structured recap of the previous day\'s topics to strengthen memory and retention.' ),
        array( 'time' => '9:00 AM', 'title' => 'Expert Subject Classes',           'desc' => 'In-depth classroom sessions by subject experts — systematically covering the exam syllabus.' ),
        array( 'time' => '1:00 PM', 'title' => 'Lunch & Short Rest',               'desc' => 'Nutritious meal followed by a brief rest period to fully recharge for the afternoon.' ),
        array( 'time' => '2:30 PM', 'title' => 'Practice Hall Session',            'desc' => 'Timed practice with previous year papers, topic drills, and speed-building exercises.' ),
        array( 'time' => '5:00 PM', 'title' => 'Daily Mock Test',                  'desc' => 'Full-length timed mock exam under real exam hall conditions — every single day.' ),
        array( 'time' => '6:30 PM', 'title' => 'Performance Review & Doubts',      'desc' => 'Score analysis, error discussion, personalised feedback, and weak-area targeting with mentors.' ),
    );
    $dummy_videos = array(
        array( 'id' => 'dQw4w9WgXcQ', 'title' => 'Morning Assembly Routine'   ),
        array( 'id' => 'dQw4w9WgXcQ', 'title' => 'Practice Hall in Action'    ),
        array( 'id' => 'dQw4w9WgXcQ', 'title' => 'CBT Lab Session'            ),
        array( 'id' => 'dQw4w9WgXcQ', 'title' => 'Evening Doubt Clearing'     ),
        array( 'id' => 'dQw4w9WgXcQ', 'title' => 'Student Testimonial'        ),
        array( 'id' => 'dQw4w9WgXcQ', 'title' => 'Result Celebration Moments' ),
    );
    $dummy_stats = array(
        array( 'number' => '5,000+', 'label' => 'Students Selected'  ),
        array( 'number' => '98%',    'label' => 'Success Rate'        ),
        array( 'number' => '10+',    'label' => 'Years of Excellence' ),
        array( 'number' => '200+',   'label' => 'Govt. Jobs in 2024'  ),
    );
    $dummy_ach = array(
        array( 'name' => 'Rahul Kumar',   'exam' => 'SSC CGL 2024',   'rank' => 'AIR 47',  'photo' => '' ),
        array( 'name' => 'Priya Sharma',  'exam' => 'IBPS PO 2024',   'rank' => 'AIR 12',  'photo' => '' ),
        array( 'name' => 'Amit Reddy',    'exam' => 'RBI Grade B',     'rank' => 'AIR 8',   'photo' => '' ),
        array( 'name' => 'Sneha Patel',   'exam' => 'SBI PO 2024',     'rank' => 'AIR 23',  'photo' => '' ),
    );
    $dummy_contact = array(
        'phone'    => '+91 98765 43210',
        'whatsapp' => '919876543210',
        'email'    => 'hyderabad@irf.ac.in',
        'address'  => '3rd Floor, Anand Complex, Ameerpet, Hyderabad – 500016',
        'maps_url' => '#',
    );
    $campuses = array(
        array(
            'id'          => 'hyderabad',
            'name'        => 'IRF Hyderabad',
            'tagline'     => 'Flagship Campus',
            'location'    => 'Ameerpet, Hyderabad',
            'image'       => '',
            'image_alt'   => 'IRF Hyderabad Campus',
            'description' => 'Our flagship Hyderabad campus at Ameerpet is the heart of IRF–IACE coaching. State-of-the-art infrastructure, expert faculty, and a proven methodology have helped thousands crack SSC, IBPS, RBI, and more.',
            'cta_url'     => '#',
            'cta_label'   => 'Explore Full Campus',
            'facilities'  => array(
                array( 'name' => 'Practice Hall', 'icon' => 'book'      ),
                array( 'name' => 'CBT Lab',       'icon' => 'monitor'   ),
                array( 'name' => 'Mentorship',    'icon' => 'users'     ),
                array( 'name' => 'Mock Tests',    'icon' => 'clipboard' ),
                array( 'name' => 'Analysis',      'icon' => 'bar-chart' ),
                array( 'name' => 'Strategy',      'icon' => 'target'    ),
            ),
            'why_points'  => $dummy_why,
            'fac_detail'  => $dummy_fac,
            'routine'     => $dummy_routine,
            'videos'      => $dummy_videos,
            'stats'       => $dummy_stats,
            'achievements'=> $dummy_ach,
            'contact'     => $dummy_contact,
        ),
    );
}
?>


<!-- ============================================================
     PAGE BANNER  —  DO NOT MODIFY
     ============================================================ -->
<section class="page-banner cmp-banner">
    <div class="page-banner-bg"></div>
    <div class="cmp-banner-circle cmp-circle-1"></div>
    <div class="cmp-banner-circle cmp-circle-2"></div>
    <div class="container">
        <div class="page-banner-content">
            <span class="section-tag">Our Campuses</span>
            <h1 class="page-banner-title">Choose Your Campus</h1>
            <p class="page-banner-subtitle">Select your preferred IRF campus to explore world-class facilities and expert coaching.</p>
            <nav class="breadcrumb" aria-label="Breadcrumb">
                <a href="<?php echo esc_url( home_url('/') ); ?>">Home</a>
                <span class="breadcrumb-sep">&#8250;</span>
                <span>Campus Selection</span>
            </nav>
        </div>
    </div>
</section>


<!-- ============================================================
     CAMPUS SELECTOR + OVERVIEW PANEL
     ============================================================ -->
<section class="section cmp-section">

    <div class="container">
        <div class="section-header">
            <span class="section-tag section-tag-dark">Select Campus</span>
            <h2 class="section-title">Explore Our Campuses</h2>
            <p class="section-subtitle">Two premier campuses. One proven result. Choose the one closest to you.</p>
        </div>
    </div>

    <div class="cmp-selector-track">
        <div class="cmp-selector" role="tablist" aria-label="Campus selector">
            <?php foreach ( $campuses as $i => $campus ) : ?>
            <div class="cmp-selector-card <?php echo 0 === $i ? 'active' : ''; ?>"
                 role="tab"
                 aria-selected="<?php echo 0 === $i ? 'true' : 'false'; ?>"
                 aria-controls="cmp-panel-<?php echo esc_attr( $campus['id'] ); ?>"
                 data-campus="<?php echo esc_attr( $campus['id'] ); ?>"
                 tabindex="<?php echo 0 === $i ? '0' : '-1'; ?>">
                <div class="cmp-selector-icon"><?php echo cmp_icon('building'); // phpcs:ignore ?></div>
                <div class="cmp-selector-meta">
                    <span class="cmp-selector-name"><?php echo esc_html( $campus['name'] ); ?></span>
                    <span class="cmp-selector-loc"><?php echo cmp_icon('pin'); // phpcs:ignore ?><?php echo esc_html( $campus['location'] ); ?></span>
                </div>
                <span class="cmp-selector-check" aria-hidden="true"><?php echo cmp_icon('check'); // phpcs:ignore ?></span>
            </div>
            <?php endforeach; ?>
        </div>
    </div>

    <div class="container">
        <?php foreach ( $campuses as $i => $campus ) : ?>
        <div class="cmp-panel <?php echo 0 === $i ? 'active' : ''; ?>"
             id="cmp-panel-<?php echo esc_attr( $campus['id'] ); ?>"
             role="tabpanel"
             aria-label="<?php echo esc_attr( $campus['name'] ); ?>">
            <div class="cmp-panel-inner">
                <div class="cmp-panel-image-wrap">
                    <img class="cmp-panel-image"
                         src="<?php echo esc_url( $campus['image'] ); ?>"
                         alt="<?php echo esc_attr( $campus['image_alt'] ); ?>"
                         loading="lazy"
                         onerror="this.style.display='none';this.nextElementSibling.style.display='flex'">
                    <div class="cmp-panel-image-placeholder" style="display:none">
                        <?php echo cmp_icon('building'); // phpcs:ignore ?>
                        <span><?php echo esc_html( $campus['name'] ); ?></span>
                    </div>
                    <div class="cmp-panel-badge"><?php echo esc_html( $campus['tagline'] ); ?></div>
                </div>
                <div class="cmp-panel-info">
                    <h3 class="cmp-panel-title"><?php echo esc_html( $campus['name'] ); ?></h3>
                    <p class="cmp-panel-desc"><?php echo esc_html( $campus['description'] ); ?></p>
                    <h4 class="cmp-facilities-heading"><span class="cmp-facilities-line"></span>Campus Facilities</h4>
                    <div class="cmp-facilities-grid">
                        <?php foreach ( $campus['facilities'] as $fac ) : ?>
                        <div class="cmp-facility-card">
                            <div class="cmp-facility-icon"><?php echo cmp_icon( $fac['icon'] ); // phpcs:ignore ?></div>
                            <span class="cmp-facility-name"><?php echo esc_html( $fac['name'] ); ?></span>
                        </div>
                        <?php endforeach; ?>
                    </div>
                    <a href="<?php echo esc_url( $campus['cta_url'] ); ?>" class="btn btn-primary cmp-cta">
                        <?php echo esc_html( $campus['cta_label'] ); ?><?php echo cmp_icon('arrow'); // phpcs:ignore ?>
                    </a>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>

</section>


<!-- ============================================================
     2. WHY CHOOSE IRF
     ============================================================ -->
<section class="section cmp-why-section">
    <div class="container">
        <div class="section-header">
            <span class="section-tag">Why Choose IRF</span>
            <h2 class="section-title">What Makes IRF Campus Different?</h2>
            <p class="section-subtitle">Not just coaching — a complete ecosystem built to convert aspirants into government job holders.</p>
        </div>

        <?php foreach ( $campuses as $i => $campus ) : ?>
        <div class="cmp-data-section <?php echo 0 === $i ? 'active' : ''; ?>" data-campus="<?php echo esc_attr( $campus['id'] ); ?>">
            <div class="cmp-why-grid">
                <?php foreach ( $campus['why_points'] as $j => $wp ) : ?>
                <div class="cmp-why-card" data-delay="<?php echo $j * 100; ?>">
                    <div class="cmp-why-icon-wrap">
                        <div class="cmp-why-icon"><?php echo cmp_icon( $wp['icon'] ); // phpcs:ignore ?></div>
                        <div class="cmp-why-number">0<?php echo $j + 1; ?></div>
                    </div>
                    <h3 class="cmp-why-title"><?php echo esc_html( $wp['title'] ); ?></h3>
                    <p class="cmp-why-desc"><?php echo esc_html( $wp['desc'] ); ?></p>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
</section>


<!-- ============================================================
     3. FACILITIES
     ============================================================ -->
<section class="section cmp-fac-section">
    <div class="container">
        <div class="section-header">
            <span class="section-tag section-tag-dark">Facilities</span>
            <h2 class="section-title">World-Class Campus Facilities</h2>
            <p class="section-subtitle">Everything a serious aspirant needs — under one roof, on one campus.</p>
        </div>

        <?php foreach ( $campuses as $i => $campus ) : ?>
        <div class="cmp-data-section <?php echo 0 === $i ? 'active' : ''; ?>" data-campus="<?php echo esc_attr( $campus['id'] ); ?>">
            <div class="cmp-fac-grid">
                <?php foreach ( $campus['fac_detail'] as $fac ) : ?>
                <div class="cmp-fac-card">
                    <div class="cmp-fac-icon-wrap">
                        <div class="cmp-fac-icon"><?php echo cmp_icon( $fac['icon'] ); // phpcs:ignore ?></div>
                    </div>
                    <h4 class="cmp-fac-name"><?php echo esc_html( $fac['name'] ); ?></h4>
                    <p class="cmp-fac-desc"><?php echo esc_html( $fac['desc'] ); ?></p>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
</section>


<!-- ============================================================
     4. DAILY ROUTINE / TIMELINE
     ============================================================ -->
<section class="section cmp-routine-section">
    <div class="container">
        <div class="section-header">
            <span class="section-tag">Daily Routine</span>
            <h2 class="section-title">A Day in the Life at IRF</h2>
            <p class="section-subtitle">Discipline, consistency, and a structured routine — the foundation of every selection.</p>
        </div>

        <?php foreach ( $campuses as $i => $campus ) : ?>
        <div class="cmp-data-section <?php echo 0 === $i ? 'active' : ''; ?>" data-campus="<?php echo esc_attr( $campus['id'] ); ?>">
            <div class="cmp-timeline">
                <?php foreach ( $campus['routine'] as $j => $step ) : ?>
                <div class="cmp-timeline-item <?php echo $j % 2 === 0 ? 'cmp-tl-left' : 'cmp-tl-right'; ?>">
                    <div class="cmp-timeline-dot">
                        <div class="cmp-timeline-dot-inner"></div>
                    </div>
                    <div class="cmp-timeline-card">
                        <span class="cmp-timeline-time"><?php echo cmp_icon('clock'); // phpcs:ignore ?><?php echo esc_html( $step['time'] ); ?></span>
                        <h4 class="cmp-timeline-title"><?php echo esc_html( $step['title'] ); ?></h4>
                        <p class="cmp-timeline-desc"><?php echo esc_html( $step['desc'] ); ?></p>
                    </div>
                </div>
                <?php endforeach; ?>
                <div class="cmp-timeline-line"></div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
</section>


<!-- ============================================================
     5. CAMPUS LIFE — VIDEO REEL STRIP
     ============================================================ -->
<section class="cmp-videos-section">
    <div class="container">
        <div class="section-header" style="margin-bottom:40px">
            <span class="section-tag">Campus Life</span>
            <h2 class="section-title">Experience <span class="cmp-title-accent">Life</span> at IRF</h2>
            <p class="section-subtitle">Real students. Real routines. Real breakthroughs. Witness the culture that creates government job selections.</p>
        </div>
    </div>

    <?php foreach ( $campuses as $i => $campus ) : ?>
    <div class="cmp-data-section <?php echo 0 === $i ? 'active' : ''; ?>" data-campus="<?php echo esc_attr( $campus['id'] ); ?>">
        <?php if ( ! empty( $campus['videos'] ) ) : ?>
        <div class="cmp-video-viewport">
            <div class="cmp-video-track">
                <?php
                /* Original set */
                foreach ( $campus['videos'] as $vid ) :
                    $vid_id  = esc_attr( $vid['id'] );
                    $vid_ttl = esc_html( $vid['title'] );
                ?>
                <a class="cmp-video-card" href="https://www.youtube.com/watch?v=<?php echo $vid_id; ?>" target="_blank" rel="noopener" aria-label="<?php echo $vid_ttl; ?>">
                    <div class="cmp-video-thumb">
                        <img src="https://img.youtube.com/vi/<?php echo $vid_id; ?>/hqdefault.jpg" alt="<?php echo $vid_ttl; ?>" loading="lazy">
                        <div class="cmp-video-play"><?php echo cmp_icon('play'); // phpcs:ignore ?></div>
                    </div>
                    <span class="cmp-video-label"><?php echo $vid_ttl; ?></span>
                </a>
                <?php endforeach; ?>
                <?php
                /* Duplicate set — seamless loop */
                foreach ( $campus['videos'] as $vid ) :
                    $vid_id  = esc_attr( $vid['id'] );
                    $vid_ttl = esc_html( $vid['title'] );
                ?>
                <a class="cmp-video-card" href="https://www.youtube.com/watch?v=<?php echo $vid_id; ?>" target="_blank" rel="noopener" aria-hidden="true" tabindex="-1">
                    <div class="cmp-video-thumb">
                        <img src="https://img.youtube.com/vi/<?php echo $vid_id; ?>/hqdefault.jpg" alt="" loading="lazy">
                        <div class="cmp-video-play"><?php echo cmp_icon('play'); // phpcs:ignore ?></div>
                    </div>
                    <span class="cmp-video-label"><?php echo $vid_ttl; ?></span>
                </a>
                <?php endforeach; ?>
            </div>
        </div>
        <?php endif; ?>
    </div>
    <?php endforeach; ?>
</section>


<!-- ============================================================
     6. RESULTS & ACHIEVEMENTS
     ============================================================ -->
<section class="section cmp-results-section">
    <div class="container">
        <div class="section-header">
            <span class="section-tag section-tag-dark">Results</span>
            <h2 class="section-title">Our Results Speak Louder</h2>
            <p class="section-subtitle">Numbers that prove IRF is the right choice for your government job preparation.</p>
        </div>

        <?php foreach ( $campuses as $i => $campus ) : ?>
        <div class="cmp-data-section <?php echo 0 === $i ? 'active' : ''; ?>" data-campus="<?php echo esc_attr( $campus['id'] ); ?>">

            <!-- Stats strip -->
            <div class="cmp-stats-strip">
                <?php foreach ( $campus['stats'] as $stat ) : ?>
                <div class="cmp-stat-item">
                    <span class="cmp-stat-number"><?php echo esc_html( $stat['number'] ); ?></span>
                    <span class="cmp-stat-label"><?php echo esc_html( $stat['label'] ); ?></span>
                </div>
                <?php endforeach; ?>
            </div>

            <!-- Achievement cards -->
            <div class="cmp-ach-grid">
                <?php foreach ( $campus['achievements'] as $ach ) :
                    $initials = implode( '', array_map( fn($w) => strtoupper($w[0]), explode(' ', $ach['name']) ) );
                ?>
                <div class="cmp-ach-card">
                    <div class="cmp-ach-avatar">
                        <?php if ( ! empty( $ach['photo'] ) ) : ?>
                            <img src="<?php echo esc_url( $ach['photo'] ); ?>" alt="<?php echo esc_attr( $ach['name'] ); ?>">
                        <?php else : ?>
                            <span class="cmp-ach-initials"><?php echo esc_html( $initials ); ?></span>
                        <?php endif; ?>
                        <div class="cmp-ach-badge"><?php echo cmp_icon('award'); // phpcs:ignore ?></div>
                    </div>
                    <div class="cmp-ach-stars">
                        <?php for ( $s = 0; $s < 5; $s++ ) : ?><?php echo cmp_icon('star'); // phpcs:ignore ?><?php endfor; ?>
                    </div>
                    <h4 class="cmp-ach-name"><?php echo esc_html( $ach['name'] ); ?></h4>
                    <p class="cmp-ach-exam"><?php echo esc_html( $ach['exam'] ); ?></p>
                    <span class="cmp-ach-rank"><?php echo esc_html( $ach['rank'] ); ?></span>
                </div>
                <?php endforeach; ?>
            </div>

        </div>
        <?php endforeach; ?>
    </div>
</section>


<!-- ============================================================
     7. FINAL CTA — ENQUIRY + WHATSAPP
     ============================================================ -->
<section class="cmp-enquiry-section">
    <?php foreach ( $campuses as $i => $campus ) : ?>
    <div class="cmp-data-section <?php echo 0 === $i ? 'active' : ''; ?>" data-campus="<?php echo esc_attr( $campus['id'] ); ?>">
        <div class="cmp-enquiry-inner">

            <!-- Left — Motivational CTA -->
            <div class="cmp-enquiry-left">
                <span class="cmp-enq-tag">Start Today</span>
                <h2 class="cmp-enq-heading">Your Government<br>Job Journey Starts<br><span>at <?php echo esc_html( $campus['name'] ); ?></span></h2>
                <p class="cmp-enq-sub">Join thousands of successful aspirants who trusted IRF. One decision today can change everything.</p>

                <div class="cmp-enq-actions">
                    <?php if ( ! empty( $campus['contact']['whatsapp'] ) ) : ?>
                    <a href="https://wa.me/<?php echo esc_attr( $campus['contact']['whatsapp'] ); ?>" class="btn-wa" target="_blank" rel="noopener">
                        <?php echo cmp_icon('whatsapp'); // phpcs:ignore ?>
                        Chat on WhatsApp
                    </a>
                    <?php endif; ?>
                    <?php if ( ! empty( $campus['contact']['phone'] ) ) : ?>
                    <a href="tel:<?php echo esc_attr( $campus['contact']['phone'] ); ?>" class="btn-call">
                        <?php echo cmp_icon('phone'); // phpcs:ignore ?>
                        <?php echo esc_html( $campus['contact']['phone'] ); ?>
                    </a>
                    <?php endif; ?>
                </div>

                <div class="cmp-enq-contact-info">
                    <?php if ( ! empty( $campus['contact']['email'] ) ) : ?>
                    <div class="cmp-enq-contact-row">
                        <?php echo cmp_icon('mail'); // phpcs:ignore ?>
                        <span><?php echo esc_html( $campus['contact']['email'] ); ?></span>
                    </div>
                    <?php endif; ?>
                    <?php if ( ! empty( $campus['contact']['address'] ) ) : ?>
                    <div class="cmp-enq-contact-row">
                        <?php echo cmp_icon('map-pin'); // phpcs:ignore ?>
                        <span><?php echo esc_html( $campus['contact']['address'] ); ?></span>
                    </div>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Right — Enquiry Form -->
            <div class="cmp-enquiry-right">
                <div class="cmp-enq-form-wrap">
                    <h3 class="cmp-enq-form-title">Send an Enquiry</h3>
                    <p class="cmp-enq-form-sub">We'll get back to you within 24 hours.</p>

                    <form class="cmp-enq-form" data-campus-id="<?php echo esc_attr( $campus['id'] ); ?>" novalidate>
                        <input type="hidden" name="campus" value="<?php echo esc_attr( $campus['name'] ); ?>">

                        <div class="cmp-form-row cmp-form-row-2">
                            <div class="cmp-form-group">
                                <label>Your Name</label>
                                <input type="text" name="name" placeholder="e.g. Rahul Kumar" required>
                            </div>
                            <div class="cmp-form-group">
                                <label>Phone Number</label>
                                <input type="tel" name="phone" placeholder="+91 98765 43210" required>
                            </div>
                        </div>

                        <div class="cmp-form-group">
                            <label>Target Exam</label>
                            <select name="exam" required>
                                <option value="">Select your target exam</option>
                                <option>SSC CGL</option>
                                <option>SSC CHSL</option>
                                <option>IBPS PO</option>
                                <option>IBPS Clerk</option>
                                <option>SBI PO</option>
                                <option>SBI Clerk</option>
                                <option>RBI Grade B</option>
                                <option>RRB NTPC</option>
                                <option>SI / Constable</option>
                                <option>Other</option>
                            </select>
                        </div>

                        <div class="cmp-form-group">
                            <label>Your Message <span>(optional)</span></label>
                            <textarea name="message" rows="3" placeholder="Any questions or specific requirements..."></textarea>
                        </div>

                        <button type="submit" class="cmp-form-submit">
                            <?php echo cmp_icon('send'); // phpcs:ignore ?>
                            Send Enquiry
                        </button>

                        <p class="cmp-form-success" style="display:none">
                            <?php echo cmp_icon('check'); // phpcs:ignore ?>
                            Thank you! We'll reach out to you shortly.
                        </p>
                    </form>
                </div>
            </div>

        </div>
    </div>
    <?php endforeach; ?>
</section>


<?php get_footer(); ?>
