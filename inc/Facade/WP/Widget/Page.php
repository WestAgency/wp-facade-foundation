<?php

class Facade_WP_Widget_Page extends Facade_WP_Widget_CPT
{
  protected function getCpt()
  {
    return 'page';
  }

  protected function getDescription()
  {
    return __('Välj en sida');
  }

  protected function getTitle()
  {
    return __('Sida');
  }
}