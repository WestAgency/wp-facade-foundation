<?php

// Starts the session
session_start();

// Extended function collection
require_once get_template_directory()
  .DS.'inc'.DS.'Facade'.DS.'WP'.DS.'functions.php';

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
if(isset($_POST['ns']))
  Facade_Form::mapper($_POST['ns']);