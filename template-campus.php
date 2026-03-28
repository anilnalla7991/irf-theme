<?php
/**
 * Template Name: Campus Selection
 *
 * @package irf-theme
 */
get_header();

/* ── Campus data from ACF ── */
$acf_rows = function_exists('get_field') ? get_field('campuses') : array();
$campuses = array();

if ( ! empty( $acf_rows ) ) {
    foreach ( $acf_rows as $row ) {
        $name  = ! empty( $row['campus_name'] ) ? $row['campus_name'] : '';
        $image = ! empty( $row['campus_image']['url'] ) ? $row['campus_image']['url'] : '';
        $alt   = ! empty( $row['campus_image']['alt'] ) ? $row['campus_image']['alt'] : $name;

        /* Build facilities array */
        $facilities = array();
        if ( ! empty( $row['campus_facilities'] ) ) {
            foreach ( $row['campus_facilities'] as $fac ) {
                $facilities[] = array(
                    'name' => $fac['facility_name'],
                    'icon' => $fac['facility_icon'],
                );
            }
        }

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
        );
    }
}

/* Fallback when no ACF data yet — keeps page visible in dev */
if ( empty( $campuses ) ) {
    $campuses = array(
        array(
            'id'          => 'hyderabad',
            'name'        => 'IRF Hyderabad',
            'tagline'     => 'Flagship Campus',
            'location'    => 'Ameerpet, Hyderabad',
            'image'       => '',
            'image_alt'   => 'IRF Hyderabad Campus',
            'description' => 'Our flagship Hyderabad campus at Ameerpet is the heart of IRF–IACE coaching. Add campus data via the WordPress admin to update this content.',
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
        ),
    );
}

/* ── Inline SVG icon helper ── */
function cmp_icon( $name ) {
    $icons = array(
        'book'      => '<svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"/><path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"/></svg>',
        'monitor'   => '<svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="3" width="20" height="14" rx="2"/><line x1="8" y1="21" x2="16" y2="21"/><line x1="12" y1="17" x2="12" y2="21"/></svg>',
        'users'     => '<svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>',
        'clipboard' => '<svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M16 4h2a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h2"/><rect x="8" y="2" width="8" height="4" rx="1"/><line x1="9" y1="12" x2="15" y2="12"/><line x1="9" y1="16" x2="12" y2="16"/></svg>',
        'bar-chart' => '<svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="20" x2="18" y2="10"/><line x1="12" y1="20" x2="12" y2="4"/><line x1="6" y1="20" x2="6" y2="14"/><line x1="2" y1="20" x2="22" y2="20"/></svg>',
        'target'    => '<svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><circle cx="12" cy="12" r="6"/><circle cx="12" cy="12" r="2"/></svg>',
        'building'  => '<svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>',
        'arrow'     => '<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>',
        'check'     => '<svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>',
        'pin'       => '<svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>',
    );
    return isset( $icons[ $name ] ) ? $icons[ $name ] : '';
}
?>


<!-- ============================================================
     PAGE BANNER
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
     CAMPUS SELECTOR + CONTENT
     ============================================================ -->
<section class="section cmp-section">

    <!-- Section header — inside container -->
    <div class="container">
        <div class="section-header">
            <span class="section-tag section-tag-dark">Select Campus</span>
            <h2 class="section-title">Explore Our Campuses</h2>
            <p class="section-subtitle">Two premier campuses. One proven result. Choose the one closest to you.</p>
        </div>
    </div>

    <!-- Selector strip — OUTSIDE container so it can scroll full-width -->
    <div class="cmp-selector-track">
        <div class="cmp-selector" role="tablist" aria-label="Campus selector">
            <?php foreach ( $campuses as $i => $campus ) : ?>
            <div class="cmp-selector-card <?php echo 0 === $i ? 'active' : ''; ?>"
                 role="tab"
                 aria-selected="<?php echo 0 === $i ? 'true' : 'false'; ?>"
                 aria-controls="cmp-panel-<?php echo esc_attr( $campus['id'] ); ?>"
                 data-campus="<?php echo esc_attr( $campus['id'] ); ?>"
                 tabindex="<?php echo 0 === $i ? '0' : '-1'; ?>">

                <div class="cmp-selector-icon">
                    <?php echo cmp_icon('building'); // phpcs:ignore WordPress.Security.EscapeOutput ?>
                </div>
                <div class="cmp-selector-meta">
                    <span class="cmp-selector-name"><?php echo esc_html( $campus['name'] ); ?></span>
                    <span class="cmp-selector-loc">
                        <?php echo cmp_icon('pin'); // phpcs:ignore WordPress.Security.EscapeOutput ?>
                        <?php echo esc_html( $campus['location'] ); ?>
                    </span>
                </div>
                <span class="cmp-selector-check" aria-hidden="true">
                    <?php echo cmp_icon('check'); // phpcs:ignore WordPress.Security.EscapeOutput ?>
                </span>

            </div>
            <?php endforeach; ?>
        </div><!-- /.cmp-selector -->
    </div><!-- /.cmp-selector-track -->

    <!-- Campus content panels — back inside container -->
    <div class="container">

        <!-- Campus content panels -->
        <?php foreach ( $campuses as $i => $campus ) : ?>
        <div class="cmp-panel <?php echo 0 === $i ? 'active' : ''; ?>"
             id="cmp-panel-<?php echo esc_attr( $campus['id'] ); ?>"
             role="tabpanel"
             aria-label="<?php echo esc_attr( $campus['name'] ); ?>">

            <div class="cmp-panel-inner">

                <!-- Campus image -->
                <div class="cmp-panel-image-wrap">
                    <img class="cmp-panel-image"
                         src="<?php echo esc_url( $campus['image'] ); ?>"
                         alt="<?php echo esc_attr( $campus['image_alt'] ); ?>"
                         loading="lazy"
                         onerror="this.style.display='none';this.nextElementSibling.style.display='flex'">
                    <!-- Fallback placeholder when image not found -->
                    <div class="cmp-panel-image-placeholder" style="display:none">
                        <?php echo cmp_icon('building'); // phpcs:ignore WordPress.Security.EscapeOutput ?>
                        <span><?php echo esc_html( $campus['name'] ); ?></span>
                    </div>
                    <div class="cmp-panel-badge"><?php echo esc_html( $campus['tagline'] ); ?></div>
                </div>

                <!-- Campus info -->
                <div class="cmp-panel-info">

                    <h3 class="cmp-panel-title"><?php echo esc_html( $campus['name'] ); ?></h3>
                    <p class="cmp-panel-desc"><?php echo esc_html( $campus['description'] ); ?></p>

                    <h4 class="cmp-facilities-heading">
                        <span class="cmp-facilities-line"></span>
                        Campus Facilities
                    </h4>

                    <div class="cmp-facilities-grid">
                        <?php foreach ( $campus['facilities'] as $fac ) : ?>
                        <div class="cmp-facility-card">
                            <div class="cmp-facility-icon">
                                <?php echo cmp_icon( $fac['icon'] ); // phpcs:ignore WordPress.Security.EscapeOutput ?>
                            </div>
                            <span class="cmp-facility-name"><?php echo esc_html( $fac['name'] ); ?></span>
                        </div>
                        <?php endforeach; ?>
                    </div>

                    <a href="<?php echo esc_url( $campus['cta_url'] ); ?>" class="btn btn-primary cmp-cta">
                        <?php echo esc_html( $campus['cta_label'] ); ?>
                        <?php echo cmp_icon('arrow'); // phpcs:ignore WordPress.Security.EscapeOutput ?>
                    </a>

                </div>
            </div>
        </div>
        <?php endforeach; ?>

    </div><!-- /.container (panels) -->
</section>


<?php get_footer(); ?>
