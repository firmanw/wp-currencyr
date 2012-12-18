<?php
/*
Plugin Name: Currencyr
Plugin URI: http://adivalabs.com/currencyr
Description: An easy, simple yet advance currency converter. Support Yahoo!, Google, Open Exchange Rates, FoXRate and European Central Bank exchange rates service, currency exchange rates list and converter widget, shortcode, WP Cron schedule, cache, custom currency and ip to local currency.
Version: 1.0.1
Author: Firman Wandayandi
Author URI: http://firmanw.com/
Text Domain: currencyr
Domain Path: /languages
*/

define( 'CURRENCYR_VERSION', '1.0.1' );
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
