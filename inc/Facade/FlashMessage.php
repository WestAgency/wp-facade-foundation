<?php

class Facade_FlashMessage
{
  /**
   * Returns if there is any messages
   * @param String $namespace [optional]
   * @return Boolean 
   */
  public static function hasMessages( $namespace = '' )
  {
    return count( self::_getMessages( $namespace )) > 0;
  }

  /**
   * @param String $message
   * @param String $namespace [optional]
   */
  public static function addMessage( $message, $namespace = '' )
  {
    if( strlen( $message ) > 0 )
      strlen( $namespace ) > 0
        ? $_SESSION[ 'FlashMessage' ][ 'ns' ][ $namespace ][] = $message
        : $_SESSION[ 'FlashMessage' ][ 'no-ns' ][] = $message;
  }

  /**
   * @param String $namespace [optional]
   * @return Array 
   */
  public static function getMessages( $namespace = '' )
  {
    $messages = self::_getMessages( $namespace );

    if( strlen( $namespace ) > 0 )
      unset( $_SESSION[ 'FlashMessage' ][ 'ns' ][ $namespace ] );

    else
      unset( $_SESSION[ 'FlashMessage' ][ 'no-ns' ] );

    return $messages;
  }

  /**
   * @param String $namespace [optional]
   * @return Array
   */
  protected static function _getMessages( $namespace = '' )
  {
    self::_compose( $namespace );

    return strlen( $namespace ) > 0
      ? $_SESSION[ 'FlashMessage' ][ 'ns' ][ $namespace ]
      : $_SESSION[ 'FlashMessage' ][ 'no-ns' ];
  }

  /**
   * @param String $namespace [optional]
   * @return Array 
   */
  public static function getAllMessages()
  {
    self::_compose();

    $messages = $_SESSION[ 'FlashMessage' ];
    unset( $_SESSION[ 'FlashMessage' ] );

    return $messages;
  }

  /** 
   * Composes the hierarki
   * @param String $namespace 
   */
  protected static function _compose( $namespace = '' )
  {
    if( !isset( $_SESSION[ 'FlashMessage' ] ))
      $_SESSION[ 'FlashMessage' ] = array();

    if( !isset( $_SESSION[ 'FlashMessage' ][ 'ns' ] ))
      $_SESSION[ 'FlashMessage' ][ 'ns' ] = array();

    if( strlen( $namespace ) > 0 )
      if( !isset( $_SESSION[ 'FlashMessage' ][ 'ns' ][ $namespace ] ))
        $_SESSION[ 'FlashMessage' ][ 'ns' ][ $namespace ] = array();

    if( !isset( $_SESSION[ 'FlashMessage' ][ 'no-ns' ] ))
      $_SESSION[ 'FlashMessage' ][ 'no-ns' ] = array();
  }
}