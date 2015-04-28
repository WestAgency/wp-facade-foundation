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

function get_dynamic_sidebar($index = 1)
{
  ob_start();
  dynamic_sidebar($index);
  $sidebar_contents = ob_get_clean();
  return $sidebar_contents;
}

function get_the_post_thumbnail_src($id = null)
{
  global $post;
  $id  = is_null($id) ? $post->ID : $id;
  $url = wp_get_attachment_url( get_post_thumbnail_id( $id ) );
  return $url;
}

/**
 * @param string $key The global key to access
 * @param string $lang [optional] Specify a language or let it fallback
 * @return String
 */
function get_global($key, $lang = null)
{
  $lang = $lang ?: (ICL_LANGUAGE_CODE ?: '');
  return get_option('facade_' . $key . '_' . $lang);
}