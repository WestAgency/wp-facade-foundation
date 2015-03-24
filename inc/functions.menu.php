<?php

// Register menus
function init_custome_menu()
{
  register_nav_menu('menu-main', __('Huvudmeny', 'west'));
}
add_action('init', 'init_custome_menu');