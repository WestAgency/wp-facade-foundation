<?php

class Facade_WP_MetaBox
{
  public
    $id,
    $title,
    $type,
    $pageTemplate,
    $metaTemplate,
    $context,
    $priority,
    $args;

  protected function __construct($id, $title, $description, $type,
    $metaTemplate, $pageTemplate, $context, $priority,$args)
  {
    $metaTemplate = implode(
      '',
      array_map(
      'ucfirst',
      explode(
        '-',
        $metaTemplate )));

    $this->title        = $title;
    $this->id           = sanitize_title( $id );
    $this->type         = $type;
    $this->description  = $description;
    $this->context      = $context;
    $this->pageTemplate = $pageTemplate;
    $this->priority     = $priority;
    $this->args         = $args;

    if( class_exists( $metaTemplate ))
      $this->metaTemplate = new $metaTemplate( $this->id, $description, $args );

    if( !( $this->metaTemplate instanceof Facade_WP_MetaBox_Template ))
    {
      $this->metaTemplate = 'Facade_WP_MetaBox_Template_' . $metaTemplate;
      $this->metaTemplate = new $this->metaTemplate( $this->id, $description, $args );
    }
  }

  public static function add($id, $title, $description = '', $types = 'post',
    $metaTemplate = 'simple', $pageTemplate = 'any', $context = 'normal',
    $priority = 'high',$args=array())
  {
    if(!is_array($types))
      $types = array($types);

    //Loop to allow multiple posttypes
    foreach ($types as $key => $type)
    {
      $instance = new self(
        $id,
        $title,
        $description,
        $type,
        $metaTemplate,
        $pageTemplate,
        $context,
        $priority,
        $args);

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
    $templates = get_page_templates();
    $template  = get_page_template_slug();

    if($this->pageTemplate == 'any'
    || $templates[$this->pageTemplate] == $template)
      add_meta_box(
        $this->id,
        $this->title,
        array($this->metaTemplate, 'getHtml'),
        $this->type,
        $this->context,
        $this->priority);
  }

  public function saveMetaBox()
  {
    global $post;

    // Verify noncename
    if ( !isset($_POST[ 'noncename-' . $this->id ])
      || !wp_verify_nonce( $_POST[ 'noncename-' . $this->id ], $this->id ))
      return $post->ID;

    // Authorized?
    if ( !current_user_can( 'edit_post', $post->ID ))
      return $post->ID;

    // Prohibits saving data twice
    if( $post->post_type == 'revision' )
      return $post->ID;

    foreach( $this->metaTemplate->getKeys() as $key )
    {
      $value = $_POST[ $key ];

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