<?php

abstract class Facade_WP_Widget_CPT extends WP_Widget
{
  abstract protected function getCpt();
  abstract protected function getTitle();
  abstract protected function getDescription();

  public function __construct()
  {
    $widget_options = array(
      'classname'   => $this->getCpt() . '-widget',
      'description' => $this->getDescription());

    $control_options = array();

    parent::WP_Widget(
      $this->getCpt() . 'widget',
      $this->getTitle(),
      $widget_options,
      $control_options);
  }

  public function widget($args, $instance)
  {
    $query = new WP_Query(
      array(
        'p'         => $instance[$this->getCpt()],
        'post_type' => $this->getCpt()));

    if($query->have_posts())
    {
      echo $args['before_widget'];

      $query->the_post();
      get_template_part('widget', $this->getCpt());
      wp_reset_postdata();

      echo $args['after_widget'];
    }
  }

  public function update( $new_instance, $old_instance )
  {
    $instance = $old_instance;
    $instance[$this->getCpt()] = (int) $new_instance[$this->getCpt()];
    $instance['title'] = get_the_title( $instance[$this->getCpt()] );
    return $instance;
  }

  public function form($instance)
  {
    $instance = wp_parse_args((array) $instance, array('title' => '', $this->getCpt() => 0));
    echo '<input class="widefat" id="' . $this->get_field_id('title') . '" name="' . $this->get_field_name('title') . '" type="hidden" value="' . $instance['title'] . '" />'
        .'<p>'
        .'<label for="' . $this->get_field_id($this->getCpt()) . '">' . __('Välj en post:');

    $posts = get_posts('post_type=' . $this->getCpt() . '&post_status=publish&numberposts=-1');
    if(count($posts) > 0)
    {
      echo '<select class="widefat" id="' . $this->get_field_id($this->getCpt()) . '" name="' . $this->get_field_name($this->getCpt()) . '">';
      foreach($posts as $post)
        echo '<option value="' . $post->ID . '"' . selected($post->ID, $instance['employee'], false) . '>' . $post->post_title . '</option>';
      echo '</select>';
    }
    else
      echo '<em>'. __('Inga poster funna') .'</em>';

    echo '</label>';
  }
}