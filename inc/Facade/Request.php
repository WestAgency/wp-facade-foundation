<?php

class Facade_Request
{
  /**
   * @var String 
   */
  protected static
    $_curUrl,
    $_curHost;
    
  public static function getCurrentUrl()
  {
    if( self::$_curUrl === null )
      self::$_curUrl = self::getHostedDir() . $_SERVER[ 'REQUEST_URI' ];

    return self::$_curUrl;
  }
    
  public static function getHostedDir()
  {
    if( self::$_curHost === null )
        self::$_curHost =
          ( isset( $_SERVER[ 'HTTPS' ] ) && $_SERVER[ 'HTTPS' ] == 'on'
          ? 'https'
          : 'http' )
        . '://'
        . $_SERVER[ 'SERVER_NAME' ]
        . ( $_SERVER[ 'SERVER_PORT' ] = '80'
          ? ''
          : ':' . $_SERVER[ 'SERVER_PORT' ] );

    return self::$_curHost;
  }

  public static function reload( $params = array(), $exit = true )
  {
    $url = self::getCurrentUrl();
    
    if( count( $params ) > 0 )
    {
      $end = '';
      
      foreach( $params as $key => $value )
        $end .= '&' . urlencode( $key ) . '=' . urlencode( $value );
      
      if( strlen( $end ) > 0 )
        $end[ 0 ] = strstr( $url, '?' )
          ? '&'
          : '?';
      
      $url .= $end;
    }

    self::relocate( $url, $exit );
  }

  public static function relocate( $url, $exit = true )
  {
    header(
      'Location: ' . $url,
      true,
      302 );

    if( $exit )
      exit;
  }
}