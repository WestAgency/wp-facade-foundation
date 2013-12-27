<nav class="clearfix" id="main-menu" itemscope itemtype="http://schema.org/SiteNavigationElement">
  <?php
    wp_nav_menu(
      array(
        'theme_location' => 'menu-main',
        'container'      => false,
        'items_wrap'     => '<ul class="%2$s">%3$s</ul>',
        'menu_class'     => 'container',
        'fallback_cb'    => false ))
  ?>
</nav>