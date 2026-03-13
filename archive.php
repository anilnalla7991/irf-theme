<?php get_header(); ?>

<h1>Archive</h1>

<?php
if(have_posts()):
while(have_posts()): the_post();
the_title('<h2>','</h2>');
endwhile;
endif;
?>

<?php get_footer(); ?>