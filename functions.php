<?php

// Cosmetics variable exchange
define('DS', DIRECTORY_SEPARATOR);
$inc = get_template_directory().DS.'inc'.DS;

// Bootstrap
require_once $inc.'functions.bootstrap.php';

// Meta
require_once $inc.'functions.app-meta.php';

// Menu
require_once $inc.'functions.menu.php';

// Custome post types
require_once $inc.'functions.cpt.php';

// Javascript
require_once $inc.'functions.java-scripts.php';

// CSS
require_once $inc.'functions.style-sheets.php';

// Meta boxes
require_once $inc.'functions.meta-boxes.php';

// Widgets
require_once $inc.'functions.widget.php';

// Editor
require_once $inc.'functions.editor.php';