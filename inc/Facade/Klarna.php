<?php

/**
 * Loads required assets and its dependencies to use the API 
 */
class Facade_Klarna
{
  /**
   * @var Facade_Klarna 
   */
  protected static $_instance;
  
  /**
   * @var Klarna 
   */
  protected $_klarna;
  
  protected function __construct()
  {
    $dir = dirname( __FILE__ );
    $ds  = DIRECTORY_SEPARATOR;
    $lib = $dir . $ds . 'Klarna' . $ds . 'lib' . $ds;
    
    require_once $lib . 'xmlrpc-3.0.0.beta' . $ds . 'xmlrpc.inc';
    require_once $lib . 'xmlrpc-3.0.0.beta' . $ds . 'xmlrpc_wrappers.inc';
    require_once $lib . 'Klarna' . $ds . 'Klarna.php';
    
    $this->_klarna = new Klarna();
  }

  /**
   * Lazy loads
   * 
   * @return Klarna 
   */
  public static function getInstance()
  {
    if( !is_object( self::$_instance ) )
      self::$_instance = new self();
    
    return self::$_instance->_klarna;
  }
  
  /**
   * Requires the klarna flags
   * 
   * @return void 
   */
  public static function requireFlags()
  {
    $dir = dirname( __FILE__ );
    $ds  = DIRECTORY_SEPARATOR;
    $lib = $dir . $ds . 'Klarna' . $ds . 'lib' . $ds;
    require_once $lib . 'Klarna' . $ds . 'Flags.php';
  }
}