<?php

abstract class Facade_WP_MetaBox_Template
    implements Facade_WP_MetaBox_Template_Interface
{
  public $id;
  public $description;
  protected $_path;

  public function __construct( $id, $description )
  {
    $this->id          = $id;
    $this->description = $description;
    $this->_path       = dirname( __FILE__ ) 
                       . DIRECTORY_SEPARATOR 
                       . 'Template' ;
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
    
    require $this->_path 
      . $ds 
      . 'html' 
      . $ds 
      . $template 
      . '.phtml';
  }
  
  protected function getValue( $key )
  {
    return Facade_WP_MetaBox::get( $key );
  }
}