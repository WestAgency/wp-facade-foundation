<?php

// Cosmetics variable exchange
define('DS', DIRECTORY_SEPARATOR);

// Bootstrap
require_once get_template_directory()
  .DS.'inc'.DS.'functions.bootstrap.php';

// Custome post types
require_once get_template_directory()
  .DS.'inc'.DS.'functions.cpt.php';

// Javascript
require_once get_template_directory()
  .DS.'inc'.DS.'functions.java-scripts.php';

// CSS
require_once get_template_directory()
  .DS.'inc'.DS.'functions.style-sheets.php';

// Meta boxes
require_once get_template_directory()
  .DS.'inc'.DS.'functions.meta-boxes.php';

// Widgets
require_once get_template_directory()
  .DS.'inc'.DS.'functions.widget.php';

// Editor
require_once get_template_directory()
  .DS.'inc'.DS.'functions.editor.php';

// Meta
require_once get_template_directory()
  .DS.'inc'.DS.'functions.meta.php';