<?php
/**
 * Test Bootstrapper.
 *
 * @package    WP_CMS_Settings
 * @subpackage WP_CMS_Settings\Tests
 * @author     Jason Witt <contact@jawittdesigns.com>
 * @copyright  Copyright (c) 2017, Jason Witt
 * @license    GNU General Public License v2 or later
 * @version    0.0.1
 */

// Get our tests directory.
$_tests_dir = '/tmp/wordpress-tests-lib';

// Include our tests functions.
require_once $_tests_dir . '/includes/functions.php';

/**
 * Manually require our plugin for testing.
 *
 * @since 1.0.0
 */
function _manually_load_plugins() {

	// Include the REST API main plugin file if we're using it so we can run endpoint tests.
	if ( class_exists( 'WP_REST_Controller' ) && file_exists( WP_PLUGIN_DIR . '/rest-api/plugin.php' ) ) {
		require WP_PLUGIN_DIR . '/rest-api/plugin.php';
	}

	// Require our plugin.
	if ( file_exists( dirname( dirname( __FILE__ ) ) . '/wp-cms-settings.php' ) ) {
		require dirname( dirname( __FILE__ ) ) . '/wp-cms-settings.php';
	}

	// Plugins to activate.
	$active_plugins = array(
		'wp-cms-settings/wp-cms-settings.php',
	);

	// Update the active_plugins options with the $active_plugins array.
	update_option( 'active_plugins', $active_plugins );
}

// Inject in our plugin.
tests_add_filter( 'muplugins_loaded', '_manually_load_plugins' );

// Include the main tests bootstrapper.
require $_tests_dir . '/includes/bootstrap.php';

// Require Base class.
require dirname( __FILE__ ) . '/base.php';
