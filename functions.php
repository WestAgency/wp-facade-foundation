<?php
// Starts the session
session_start();

// Cosmetics variable exchange
define('DS', DIRECTORY_SEPARATOR);

// Extended function collection
require_once get_template_directory()
  .DS
  .'inc'
  .DS
  .'Facade'
  .DS
  .'WP'
  .DS
  .'functions.php';

// Include classes
spl_autoload_register(function($class_name)
{
  $file = get_template_directory()
    .DS
    .'inc'
    .DS
    .implode(
      DS,
      explode(
      '_',
      $class_name))
    .'.php';

  if(is_file($file))
    include_once $file;
});

// Handles certain post data
Facade_Form::mapper(
  array(),
  $_POST['ns']);

// Register menus
function init_custome_menu()
{
  register_nav_menu('menu-main', __('Huvud meny', 'BBO'));
}
add_action('init', 'init_custome_menu');

// Custome post types
require_once get_template_directory()
  .DS
  .'inc'
  .DS
  .'functions.cpt.php';

// Register Meta boxes for pages
function init_meta_boxes()
{

}
add_action('init', 'init_meta_boxes');

// Register sidebars | widgets
function init_dynamic_sidebars()
{

}
add_action('widgets_init', 'init_dynamic_sidebars');

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
    '1.10.2',
    // Footer
    true);

  wp_enqueue_script(
    'bootstrap',
    get_template_directory_uri().'/js/bootstrap.min.js',
    array('jquery'),
    '3.0.0',
    true);

  wp_enqueue_script(
    'shift',
    get_template_directory_uri().'/js/shift.js',
    array(),
    '1.0.0',
    true);
}
add_action('init', 'init_script_enqueue');

// Enqueue style sheets
function init_style_enqueue()
{
  if(is_admin())
    return;

  wp_enqueue_style(
    // Name
    'bootstrap',
    // Url
    get_template_directory_uri().'/css/bootstrap.min.css',
    // Dependencies
    array(),
    // Version
    '3.0.0',
    // Media
    'all');

  wp_enqueue_style(
    // Name
    'master',
    // Url
    get_template_directory_uri().'/css/master.css',
    // Dependencies
    array('bootstrap'),
    // Version
    '1.0.0',
    // Media
    'all');
}
add_action('init', 'init_style_enqueue');

// RSS feed to header
add_theme_support('automatic-feed-links');

// Feutured images
add_theme_support('post-thumbnails', array('page'));

// Adding css rules for the text editor in admin panel
add_editor_style();

// Setting up the editor
function init_tiny_mce($init)
{
  $init['verify_html']                  = false;
  $init['cleanup']                      = false;
  $init['cleanup_on_startup']           = false;
  $init['forced_root_block']            = 'p';
  $init['validate_children']            = true;
  $init['remove_linebreaks']            = false;
  $init['force_p_newlines']             = true;
  $init['force_br_newlines']            = false;
  $init['fix_list_elements']            = false;
  $init['indentation']                  = '20px';
  $init['theme_advanced_blockformats']  = 'p,h2,h3,h4,h5,h6';

  return $init;
}
add_filter('tiny_mce_before_init', 'init_tiny_mce');

// Adds buttons
function init_tiny_mce_buttons($buttons)
{
  $buttons = array(
    'formatselect',
    'separator',
    'bold',
    'italic',
    'underline',
    'strikethrough',
    'separator',
    'justifyleft',
    'justifycenter',
    'justifyright',
    'justifyfull',
    'separator',
    'outdent',
    'indent',
    'separator',
    'bullist',
    'numlist',
    'separator',
    'link',
    'unlink',
    'separator',
    'sub',
    'sup',
    'forecolor',
    'separator',
    'removeformat');

  return $buttons;
}
add_filter('mce_buttons', 'init_tiny_mce_buttons');

// Exerpt length
function init_excerpt_length()
{
  return 24;
}
add_filter('excerpt_length', 'init_excerpt_length');

// Change the suffix
function init_excerpt_sufix($txt)
{
  return str_replace(' [...]', '...', $txt);
}
add_filter('get_the_excerpt', 'init_excerpt_sufix');

// Change the suffix
function init_read_more($txt)
{
  return $txt.' <a href="'.get_permalink().'">'.__('Läs mer', 'BBO').'..</a>';
}
add_filter('read_more', 'init_read_more');

// Removes not used menus from admin
function remove_menus()
{
  global $menu;
  $remove = array(__('Posts'), __('Comments'), __('Links'));
  foreach($menu as $key => $value)
  {
    $value = explode(' ',$value[0]);
    if(in_array($value[0] != null ? $value[0] : '' , $remove))
      unset($menu[$key]);
  }
}
add_action('admin_menu', 'remove_menus');

// Removes not used menus from admin bar
function my_admin_bar_link()
{
  global $wp_admin_bar;
  $wp_admin_bar->remove_menu('new-post');
  $wp_admin_bar->remove_menu('new-link');
  $wp_admin_bar->remove_menu('new-user');
}
add_action('wp_before_admin_bar_render', 'my_admin_bar_link');

// Clean up head
remove_action('wp_head', 'wp_generator');
remove_action('wp_head', 'wlwmanifest_link');
remove_action('wp_head', 'rsd_link');