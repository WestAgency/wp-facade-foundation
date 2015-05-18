<?php

class Facade_WP_MetaBox_Template_Cpt extends Facade_WP_MetaBox_Template
{
  public function getKeys()
  {
    return [ $this->id ];
  }
}