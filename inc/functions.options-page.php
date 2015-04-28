<?php

function west_theme_options_global_segment()
{
  // Validate access
  if(!current_user_can('manage_options'))
    wp_die(__(
      'Du har inte tillräcklig behörighet för att komma åt sidan.',
      'west'));

  // Save post data
  if($_SERVER['REQUEST_METHOD'] === 'POST')
  {
    foreach ($_POST as $key => $value)
      update_option('facade_' . $key, $value);

    echo '<div id="message" class="updated">' . __('Inehåll sparat') . '</div>';
  }

  // Render template
  $fallback = ICL_LANGUAGE_CODE ?: '';
  $context  = ['currentTab' => $_GET['tab'] ?: $fallback];
  Timber::render('admin/global-segment.twig', $context);
}

function west_theme_options()
{
  add_menu_page(
    __('Globala segment', 'west'),
    'west.',
    'manage_options',
    'west_global-segment',
    'west_theme_options_global_segment');
}
add_action('admin_menu', 'west_theme_options');