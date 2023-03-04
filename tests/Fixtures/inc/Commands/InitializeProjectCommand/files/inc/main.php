<?php

namespace MyTestApp;

use MyTestApp\Dependencies\League\Container\Container;
use MyTestApp\Engine\Activation\Activation;
use MyTestApp\Engine\Deactivation\Deactivation;

defined( 'ABSPATH' ) || exit;

// Composer autoload.
if ( file_exists( MY_TEST_APP_PATH . 'vendor/autoload.php' ) ) {
    require MY_TEST_APP_PATH . 'vendor/autoload.php';
}

/**
 * Tell WP what to do when plugin is loaded.
 *
 * @since 1.0
 */
function plugin_init() {
    // Nothing to do if autosave.
    if ( defined( 'DOING_AUTOSAVE' ) ) {
        return;
    }

    // Last constants.
    define( 'MY_TEST_APP_PLUGIN_NAME', 'My test app' );
    define( 'MY_TEST_APP_PLUGIN_SLUG', sanitize_key( MY_TEST_APP_PLUGIN_NAME ) );

    $wp_rocket = new Plugin(
        new Container()
    );
    $wp_rocket->load(MY_TEST_APP_PLUGIN_SLUG, MY_TEST_APP_TEMPLATE_PATH );

    // Call defines and functions.
}
add_action( 'plugins_loaded',  __NAMESPACE__ . '\\plugin_init' );

register_deactivation_hook( MY_TEST_APP_FILE, [ Deactivation::class, 'deactivate_plugin' ] );
register_activation_hook( MY_TEST_APP_FILE, [ Activation::class, 'activate_plugin' ] );
