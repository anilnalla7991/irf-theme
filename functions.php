<?php

function irf_theme_setup(){

add_theme_support('title-tag');

register_nav_menus(array(
'primary' => 'Primary Menu'
));

}

add_action('after_setup_theme','irf_theme_setup');