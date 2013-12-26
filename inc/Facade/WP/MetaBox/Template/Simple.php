<?php

class Facade_WP_MetaBox_Template_Simple extends Facade_WP_MetaBox_Template
{
  public function getKeys()
  {
    return array( $this->id );
  }
}