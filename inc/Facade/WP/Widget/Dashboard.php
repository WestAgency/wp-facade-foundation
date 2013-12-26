<?php

abstract class Facade_WP_Widget_Dashboard
{
  protected
    $id,
    $name,
    $path;
  
  public function __construct( $id, $name )
  {
    $this->id   = $id;
    $this->name = $name;
    $this->path = dirname( __FILE__ );
  }
  
  public function setup()
  {
    add_action(
      'wp_dashboard_setup', 
      array(
        $this,
        'addDdashboardWidget' ) );
  }

  public function addDdashboardWidget()
  {
    wp_add_dashboard_widget(
      $this->id, 
      $this->name, 
      array( $this, 'getHtml' ));	
  }
  
  public function getHtml()
  {
    $filter   = new Facade_Filter_CamelToDashed();
    $ds       = DIRECTORY_SEPARATOR;
    $template = $filter->filter(
      array_pop(
        explode(
          '_', 
          get_class( $this ))));
    
    require $this->path . $ds . 'html' . $ds . $template . '.phtml';
  }
}