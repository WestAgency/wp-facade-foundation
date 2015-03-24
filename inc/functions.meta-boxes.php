<?php

// Register Meta boxes for pages
function init_meta_boxes()
{

}
add_action('init', 'init_meta_boxes');

// Hides the editor for defined template
function hide_editor()
{
  // Get the Post ID.
  if(isset($_GET['post']))
    $post_id = $_GET['post'];

  else if(isset($_POST['post_ID']))
    $post_id = $_POST['post_ID'];

  else
    return;

  // Get the name of the Page Template file.
  $template_file = get_post_meta($post_id, '_wp_page_template', true);

  switch ($template_file)
  {
    // add correct template file name
    case '?.php':
      remove_post_type_support('page', 'editor');
      break;
  }
}
add_action('admin_init', 'hide_editor');