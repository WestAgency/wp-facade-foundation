<?php

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
  $buttons = 
  [
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
    'removeformat'
  ];

  return $buttons;
}
add_filter('mce_buttons', 'init_tiny_mce_buttons');
