<?php
/**
 * Archive: Results
 * Sets up the Results page as context so ACF fields work,
 * then loads template-results.php for the full premium design.
 */

// Point $post to the Results page so get_field() reads its ACF fields
global $post;
$_orig_post    = $post;
$_results_page = get_page_by_path( 'results' );
if ( $_results_page ) {
    $post = $_results_page;
    setup_postdata( $post );
}

// Load the full premium Results template
include( get_template_directory() . '/template-results.php' );

// Restore original post context
wp_reset_postdata();
$post = $_orig_post;
