<?php

class Facade_Validator_Email implements Facade_Validator_Interface
{
  /**
   * @param mix $data
   * @return boolean
   */
  public function validate($data)
  {
    return filter_var($data, FILTER_VALIDATE_EMAIL);
  }
}