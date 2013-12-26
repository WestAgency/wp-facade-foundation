<?php

class Facade_Validator_IsSet implements Facade_Validator_Interface
{
  /**
   * @param mix $data 
   * @return boolean 
   */
  public function validate( $data )
  {
    return $data !== null && $data <> '';
  }
}