<?php

class Facade_Filter_CamelToDashed implements Facade_Filter_Interface
{
  /**
   * @param mix $data 
   * @return string 
   */
  public function filter( $data )
  {
    return strtolower( preg_replace( '/([a-zA-Z])(?=[A-Z])/', '$1-', $data ));
  }
}