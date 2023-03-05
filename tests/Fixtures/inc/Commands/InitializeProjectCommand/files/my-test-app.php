<?php
/**
 * Plugin Name: My test app
 * Version: 1.0.0
 * License: GPL2
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: mytestapp
 * Domain Path: /languages
 */
defined( 'ABSPATH' ) || exit;

define( 'MY_TEST_APP_VERSION',               '1.0.0' );
define( 'MY_TEST_APP_FILE',                  __FILE__ );
define( 'MY_TEST_APP_PATH',                  realpath( plugin_dir_path( MY_TEST_APP_FILE ) ) . '/' );
define( 'MY_TEST_APP_INC_PATH',              realpath( MY_TEST_APP_PATH . 'inc/' ) . '/' );
define( 'MY_TEST_APP_TEMPLATE_PATH',         realpath( MY_TEST_APP_PATH . 'templates/' ) . '/' );


require MY_TEST_APP_INC_PATH . 'main.php';
