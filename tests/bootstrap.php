<?php
/**
 * Test Bootstrapper.
 *
 * @package    WP_CMS_Settings
 * @subpackage WP_CMS_Settings\Test
 * @author     Jason Witt <contact@jawittdesigns@gmail.com>
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

	// Require our plugin.
	if ( file_exists( trailingslashit( PROJECT_DIR ) . 'plugin-file-name.php' ) ) {
		require dirname( dirname( __FILE__ ) ) . '/plugin-file-name.php';
	}
}

// Inject in our plugin.
tests_add_filter( 'muplugins_loaded', '_manually_load_plugins' );

// Include the main tests bootstrapper.
require $_tests_dir . '/includes/bootstrap.php';

// Require Base class.
require dirname( __FILE__ ) . '/base.php';
