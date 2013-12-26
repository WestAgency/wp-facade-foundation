<?php

function get_flash_messages( $namespace = '' )
{
  return Facade_FlashMessage::getMessages( $namespace );
}

function get_the_meta_value( $key, $post = null, $content_filter = false )
{
  $value = Facade_WP_MetaBox::get( $key, $post );
  
  if( $content_filter )
    $value = the_content_filter( $value );
  
  return $value;
}

function the_meta_value( $key, $post = null, $content_filter = false )
{
  echo get_the_meta_value( $key, $post, $content_filter );
}

function the_content_filter( $content )
{
  $content = apply_filters( 'the_content', $content );
  $content = str_replace( ']]>', ']]&gt;', $content );
  
  return $content;
}