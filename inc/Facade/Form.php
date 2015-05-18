<?php

abstract class Facade_Form implements Facade_Form_Interface
{
  protected
   /**
    * Validation rules
    *
    * @var Array
    */
    $_rules = [],

   /**
    * What keys to filter
    *
    * @var Array
    */
    $_filter = [],

   /**
    * Validation rules
    *
    * @var Array
    */
    $_data = [];

  /**
   * All errors will be saved to session in a flash message before reloding url.
   * @see Facade_FlashMessage
   */
  private final function __construct()
  {
    $this->_init();
  }

  /**
   * Good for setting validation rules and filter keys or other what ever
   */
  protected function _init() {}

 /**
  * Composes the data.
  *
  * @throws Facade_Form_Exception
  */
  protected function _composeData()
  {
    foreach( $_POST as $key => $value )
      if( isset( $this->_filter[ $key ] ))
      {
        if( !is_array( $this->_filter[ $key ] ) )
          $this->_filter[ $key ] = [ $this->_filter[ $key ] ];

        foreach( $this->_filter[ $key ] as $filter )
        {
          try
          {
            $filter = new $filter();

            if( !( $filter instanceof Facade_Filter_Interface ))
              throw new Exception();
          }
          catch( Exception $exc )
          {
            throw new Facade_Form_Exception(
              'Unrecognized filter: "' . $rule . '"' );
          }

          $this->_data[ $key ] = $filter->filter( $value );
        }
      }
      else
        $this->_data[ $key ] = $value;
  }

 /**
  * Validates the data.
  *
  * @throws Facade_Form_Exception
  */
  protected function _validateData()
  {
    foreach( $this->_rules as $key => $rules )
    {
      if( !is_array( $rules ) )
        $rules = [ $rules ];

      foreach( $rules as $rule )
      {
        try
        {
          $rule = new $rule();

          if( !( $rule instanceof Facade_Validator_Interface ))
            throw new Exception();
        }
        catch( Exception $exc )
        {
          throw new Facade_Form_Exception(
            'Unrecognized validation rule: "' . $rule . '"' );
        }

        $data = isset( $this->_data[ $key ] )
              ? $this->_data[ $key ]
              : null;

        if( !$rule->validate( $data ))
          throw new Facade_Form_Exception(
            'Invalid data for: "' . $key . '", rule: "' . get_class ( $rule ) . '"' );
      }
    }
  }

  public static function mapper($handler)
  {
    if(class_exists($handler))
      return false;

    $form = new $handler();

    try
    {
      $form->_composeData();
      $form->_validateData();
    }
    catch( Facade_Form_Exception $e )
    {
      $form->onInvalidation( $e->getMessage() );
    }

    $form->validated();

    return true;
  }

  public function onInvalidation( $message = '' )
  {
    if( $message !== '' )
      Facade_FlashMessage::addMessage( $message, 'error' );

    Facade_Request::reload();
  }
}