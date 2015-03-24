<?php

// Enqueue scripts
function init_script_enqueue()
{
  if(is_admin())
    return;

  wp_deregister_script('jquery');

  wp_enqueue_script(
    // Name
    'jquery',
    // Url
    get_template_directory_uri().'/js/jquery.min.js',
    // Dependencies
    false,
    // Version
    '1.11.2',
    // Footer
    true);

  wp_enqueue_script(
    'bootstrap',
    get_template_directory_uri().'/js/bootstrap.min.js',
    array('jquery'),
    '3.3.4',
    true);
}
add_action('init', 'init_script_enqueue');