<?php

class Facade_WP_MetaBox_Template_ImageDubbel extends Facade_WP_MetaBox_Template
{
  public function getKeys()
  {
    return
      [
        $this->id . '-thumb', 
        $this->id . '-image', 
        $this->id . '-alt' 
      ];
  }
}