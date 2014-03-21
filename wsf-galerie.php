<?php
/*
Plugin Name: WSF - Galerie
Plugin URI: http://test.com
Description: Plugin test
Author: Manuel, Vicor et Baptiste
Version: 1.0
Author URI: http://manuellemaire.com
*/
define('WSF_PORTFOLIO_URL', plugin_dir_url(__FILE__));
define('WSF_PORTFOLIO_DIR', plugin_dir_path(__FILE__));

// Classes
require_once( WSF_PORTFOLIO_DIR . '/inc/cpt.php');
require_once( WSF_PORTFOLIO_DIR . '/inc/fields.php');
<<<<<<< HEAD
// require_once( WSF_PORTFOLIO_DIR . '/inc/shortcodes.php');
 

 // test pour commit
=======
require_once( WSF_PORTFOLIO_DIR . '/inc/shortcodes.php');

new shortcode_gallery();
>>>>>>> 81cfbf83b5fa5bdfaca52b85977c958fae35d832

// test commit Victor
