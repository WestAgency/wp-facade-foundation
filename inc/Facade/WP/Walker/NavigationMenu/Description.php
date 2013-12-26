<?php

/**
 * @author Erik Landvall
 */
class Facade_WP_Walker_NavigationMenu_Description extends Walker_Nav_Menu
{
  /**
   * @param string $output Passed by reference. Used to append additional
   * content.
   * @param object $item Menu item data object.
   * @param int $depth Depth of menu item. Used for padding.
   * @param object $args
   */
  function start_el( &$output, $item, $depth = 0, $args = array() )
  {
    $classes = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( array( 'cell', 'loose' )), $item, $args ) );
    $classes = $classes ? ' class="' . esc_attr( $classes ) . '"' : '';

    $output .= '<li' . $classes .'>';

    $attributes  = ! empty( $item->attr_title )  ? ' title="'  . esc_attr( $item->attr_title ) . '"' : '';
    $attributes .= ! empty( $item->target )      ? ' target="' . esc_attr( $item->target     ) . '"' : '';
    $attributes .= ! empty( $item->xfn )         ? ' rel="'    . esc_attr( $item->xfn        ) . '"' : '';
    $attributes .= ! empty( $item->url )         ? ' href="'   . esc_attr( $item->url        ) . '"' : '';
    
    $item_output = $args->before
      . '<a'. $attributes .'>'
      . $args->link_before
      . '<strong>'
      . apply_filters( 'the_title', $item->title, $item->ID )
      . '</strong>'
      . ( empty( $item->description ) ? '' : esc_attr( $item->description ))
      . $args->link_after
      . '</a>'
      . $args->after;

    $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
  }
}