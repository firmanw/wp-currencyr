<?php
/*
Plugin Name: Currencyr
Plugin URI: http://firmanw.github.com/wp-currencyr
Description: Instead of traditional "calculator" looks converter, Currencyr take the advance of "tooltip" and sit right at the amount to allow user convert it. Support various exchange rates provider API running as WP Cron task and able to auto-determinate local currency of visitor. Currencyr also offers currency converter widget, shortcode and function.
Version: 1.0.4
Author: Firman Wandayandi
Author URI: http://firmanw.com/
Text Domain: currencyr
Domain Path: /languages
*/

define( 'CURRENCYR_VERSION', '1.0.4' );
define( 'CURRENCYR_PLUGIN_BASENAME', plugin_basename( __FILE__ ) );
define( 'CURRENCYR_PLUGIN_URL', plugin_dir_url( __FILE__ ) );
define( 'CURRENCYR_PLUGIN_ASSETS', plugin_dir_url( __FILE__ ) . 'assets' );
define( 'CURRENCYR_DBTABLE', 'currencyr' );
define( 'CURRENCYR_LIBS', dirname(__FILE__) . '/libs' );

/**
 * Currencyr
 */
require_once CURRENCYR_LIBS . '/class-currencyr.php';

/**
 * Functions
 */
require_once CURRENCYR_LIBS . '/functions.php';

// Creates a new instance of Currencyr
$currencyr = new Currencyr;

register_activation_hook( __FILE__, array( $currencyr, 'activate' ) );
register_deactivation_hook( __FILE__, array( $currencyr, 'deactivate' ) );
