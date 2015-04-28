<?php

class Facade_WP_Widget_CPT extends WP_Widget
{
  protected
    $cpt,
    $title,
    $description;

  public function __construct($cpt, $title, $description)
  {
    $this->cpt         = $cpt;
    $this->title       = $title;
    $this->description = $description;

    $widget_options = array(
      'classname'   => $this->cpt . '-widget',
      'description' => $this->description);

    $control_options = array();

    parent::WP_Widget(
      $this->cpt . 'widget',
      $this->title,
      $widget_options,
      $control_options);
  }

  public function widget($args, $instance)
  {
    $query = new WP_Query(
      array(
        'p'         => $instance[$this->cpt],
        'post_type' => $this->cpt));

    if($query->have_posts())
    {
      echo $args['before_widget'];

      $query->the_post();
      get_template_part('widget', $this->cpt);
      wp_reset_postdata();

      echo $args['after_widget'];
    }
  }

  public function update( $new_instance, $old_instance )
  {
    $instance = $old_instance;
    $instance[$this->cpt] = (int) $new_instance[$this->cpt];
    $instance['title'] = get_the_title( $instance[$this->cpt] );
    return $instance;
  }

  public function form($instance)
  {
    $instance = wp_parse_args((array) $instance, array('title' => '', $this->cpt => 0));
    echo '<input class="widefat" id="' . $this->get_field_id('title') . '" name="' . $this->get_field_name('title') . '" type="hidden" value="' . $instance['title'] . '" />'
        .'<p>'
        .'<label for="' . $this->get_field_id($this->cpt) . '">' . __('Välj en post:');

    $posts = get_posts('post_type=' . $this->cpt . '&post_status=publish&numberposts=-1');
    if(count($posts) > 0)
    {
      echo '<select class="widefat" id="' . $this->get_field_id($this->cpt) . '" name="' . $this->get_field_name($this->cpt) . '">';
      foreach($posts as $post)
        echo '<option value="' . $post->ID . '"' . selected($post->ID, $instance[$this->cpt], false) . '>' . $post->post_title . '</option>';
      echo '</select>';
    }
    else
      echo '<em>'. __('Inga poster funna') .'</em>';

    echo '</label>';
  }
}