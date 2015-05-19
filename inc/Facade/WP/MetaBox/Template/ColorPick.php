<?php

class Facade_WP_MetaBox_Template_ColorPick extends Facade_WP_MetaBox_Template
{
  public function __construct($id, $description)
  {
    parent::__construct($id, $description);
    
    wp_enqueue_style(
      'spectrum-css',
      get_template_directory_uri().'/css/spectrum.css',
      array(),
      '1.7.0',
      'all');

    wp_enqueue_script(
      'spectrum-js',
      get_template_directory_uri().'/js/spectrum.js',
      array('jquery'),
      '1.7.0',
      false);
  }
  
  public function getKeys()
  {
    return array( $this->id );
  }
}