<?php

class Facade_WP_MetaBox
{
  public 
    $id,
    $title,
    $type,
    $template,
    $context,
    $priority;

  protected function __construct( $id, $title, $description, $type, $template,
          $context, $priority )
  {
    $template = implode(
      '', 
      array_map(
      'ucfirst',
      explode(
        '-',
        $template )));
    
    $this->title        = $title;
    $this->id           = sanitize_title( $id );
    $this->type         = $type;
    $this->description  = $description;
    $this->context      = $context;
    $this->priority     = $priority;
    
    if( class_exists( $template ))
      $this->template = new $template( $this->id, $description );
    
    if( !( $this->template instanceof Facade_WP_MetaBox_Template ))
    {
      $this->template = 'Facade_WP_MetaBox_Template_' . $template;
      $this->template = new $this->template( $this->id, $description );
    }
  }

  public static function add( $id, $title, $description = '', $type = 'post', 
          $template = 'simple', $context = 'normal', $priority = 'high' )
  {
    $instance = new self(
      $id,
      $title,
      $description,
      $type,
      $template,
      $context, 
      $priority );
    
    add_action(
      'add_meta_boxes',
      array(
        $instance,
        'addMetaBox' ));
    
    add_action(
      'save_post',
      array(
        $instance,
        'saveMetaBox' ),
      1,
      0);
  }
  
  public static function get( $key, $post = null )
  {
    if( $post === null )
      global $post;
    
    $data = get_post_meta(
      is_object( $post )
        ? $post->ID
        : (int) $post,
      sanitize_title( $key ), 
      true );

    if( is_serialized( $data ) )
      $data = unserialize( $data );
    
    return $data;
  }

  public function addMetaBox()
  {
    add_meta_box(
      $this->id,
      $this->title,
      array( $this->template, 'getHtml'),
      $this->type,
      $this->context,
      $this->priority );
  }
  
  public function saveMetaBox()
  {
    global $post;

    // Verify noncename
    if ( !wp_verify_nonce( $_POST[ 'noncename-' . $this->id ], $this->id ))
      return $post->ID;

    // Authorized?
    if ( !current_user_can( 'edit_post', $post->ID ))
      return $post->ID;

    // Prohibits saving data twice
    if( $post->post_type == 'revision' )
      return $post->ID;
    
    foreach( $this->template->getKeys() as $key )
    {
      $value = $_POST[ $key ];
      
      // If the value is defined as an array then serialize it
      $value = is_array( $value )
        ? serialize( $value )
        : trim( $value );

      // If empty field, no storage is needed
      if( empty( $value ))
      {
        delete_post_meta( $post->ID, $key );
        continue;
      }

      // Insert or update the db depending on if the value alredy exist
      get_post_meta( $post->ID, $key )
        ? update_post_meta( $post->ID, $key, $value )
        : add_post_meta( $post->ID, $key, $value );
    }
  }
}