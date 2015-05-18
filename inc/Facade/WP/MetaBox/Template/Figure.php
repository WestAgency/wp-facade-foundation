<?php

class Facade_WP_MetaBox_Template_Figure extends Facade_WP_MetaBox_Template
{
  public function getKeys()
  {
    return
      [
        $this->id . '-image',
        $this->id . '-alt',
        $this->id . '-caption' 
      ];
  }
}