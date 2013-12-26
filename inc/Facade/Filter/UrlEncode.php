<?php

class Facade_Filter_UrlEncode implements Facade_Filter_Interface
{
  /**
   * @param mix $data 
   * @return string 
   */
  public function filter( $data )
  {
    return urlencode( $data );
  }
}