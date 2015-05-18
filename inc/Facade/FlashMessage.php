<?php

class Facade_FlashMessage
{
  /**
   * Returns if there is any messages
   * @param String $namespace [optional]
   * @return Boolean
   */
  public function hasMessages( $namespace = '' )
  {
    return count( $this->_getMessages( $namespace )) > 0;
  }

  /**
   * @param String $message
   * @param String $namespace [optional]
   */
  public function addMessage( $message, $namespace = '' )
  {
    if( strlen( $message ) > 0 )
      strlen( $namespace ) > 0
        ? $_SESSION[ 'FlashMessage' ][ 'ns' ][ $namespace ][] = $message
        : $_SESSION[ 'FlashMessage' ][ 'no-ns' ][] = $message;
  }

  /**
   * Returns an array of namespaces in use
   * @return Array
   */
  public function getNamespaces()
  {
    $this->_compose();

    $namespaces = array_keys($_SESSION[ 'FlashMessage' ][ 'ns' ]);
    array_push($namespaces, '');

    return $namespaces;
  }

  /**
   * @param String $namespace [optional]
   * @return Array
   */
  public function getMessages( $namespace = '' )
  {
    $messages = $this->_getMessages( $namespace );

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
  protected function _getMessages( $namespace = '' )
  {
    $this->_compose( $namespace );

    return strlen( $namespace ) > 0
      ? $_SESSION[ 'FlashMessage' ][ 'ns' ][ $namespace ]
      : $_SESSION[ 'FlashMessage' ][ 'no-ns' ];
  }

  /**
   * @param String $namespace [optional]
   * @return Array
   */
  public function getAllMessages()
  {
    $this->_compose();

    $messages = $_SESSION[ 'FlashMessage' ];
    unset( $_SESSION[ 'FlashMessage' ] );

    return $messages;
  }

  /**
   * Composes the hierarki
   * @param String $namespace
   */
  protected function _compose( $namespace = '' )
  {
    if( !isset( $_SESSION[ 'FlashMessage' ] ))
      $_SESSION[ 'FlashMessage' ] = [];

    if( !isset( $_SESSION[ 'FlashMessage' ][ 'ns' ] ))
      $_SESSION[ 'FlashMessage' ][ 'ns' ] = [];

    if( strlen( $namespace ) > 0 )
      if( !isset( $_SESSION[ 'FlashMessage' ][ 'ns' ][ $namespace ] ))
        $_SESSION[ 'FlashMessage' ][ 'ns' ][ $namespace ] = [];

    if( !isset( $_SESSION[ 'FlashMessage' ][ 'no-ns' ] ))
      $_SESSION[ 'FlashMessage' ][ 'no-ns' ] = [];
  }
}