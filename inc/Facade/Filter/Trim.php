<?php

class Facade_Filter_Trim implements Facade_Filter_Interface
{
  /**
   * @param mix $data 
   * @return string 
   */
  public function filter( $data )
  {
    return trim( $data );
  }
}