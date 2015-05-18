<?php

// Enqueue style sheets
function init_style_enqueue()
{
  if(in_array( $GLOBALS['pagenow'], ['wp-login.php', 'wp-register.php']) 
  || is_admin())
    return;

  wp_enqueue_style(
    // Name
    'bootstrap',
    // Url
    get_template_directory_uri().'/css/bootstrap.min.css',
    // Dependencies
    [],
    // Version
    '3.3.4',
    // Media
    'all');

  wp_enqueue_style(
    'master',
    get_template_directory_uri().'/css/master.css',
    ['bootstrap'],
    '1.0.0',
    'all');
}
add_action('init', 'init_style_enqueue');