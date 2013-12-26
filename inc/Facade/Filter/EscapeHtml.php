<?php

class Facade_Filter_EscapeHtml implements Facade_Filter_Interface
{
  /**
   * @param mix $data 
   * @return string 
   */
  public function filter( $data )
  {
    return htmlentities( $data, ENT_QUOTES | ENT_IGNORE, 'UTF-8' );
  }
}