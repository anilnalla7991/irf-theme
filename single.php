<?php get_header(); ?>

<?php
while(have_posts()) :
the_post();
the_title('<h1>','</h1>');
the_content();
endwhile;
?>

<?php get_footer(); ?>