<?php

class Facade_WP_Widget_Post extends Facade_WP_Widget_CPT
{
  protected function getCpt()
  {
    return 'post';
  }

  protected function getDescription()
  {
    return __('Välj en post');
  }

  protected function getTitle()
  {
    return __('Post');
  }
}