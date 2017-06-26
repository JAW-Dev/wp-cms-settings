<?php
/**
 * Disable Meta Links.
 *
 * @package    WP_CMS_Settings
 * @subpackage WP_CMS_Settings\Tests\Includes\Classes
 * @author     Jason Witt <contact@jawittdesigns.com>
 * @copyright  Copyright (c) 2017, Jason Witt
 * @license    GNU General Public License v2 or later
 * @version    0.0.1
 */

 /**
  * Disable Meta Links.
  *
  * @author Jason Witt
  * @since  1.0.0
  */
 class Disable_Meta_Links_Test extends Base_UnitTestCase {

	 /**
	  * SetUp.
	  *
	  * @author Jason Witt
	  * @since  0.0.1
	  *
	  * @return void
	  */
	 public function setUp() {
		 $this->file       = $this->dirname() . 'includes/classes/class-disable-meta-links.php';
		 $this->class_name = 'WP_CMS_Settings\\Includes\\Classes\\Disable_Meta_Links';
		 $this->class      = new WP_CMS_Settings\Includes\Classes\Disable_Meta_Links();
		 $this->methods    = array(
			 'init',
			 'disable_wlwmanifest',
			 'disable_wp_generator',
			 'disable_wp_shortlink',
		 );
		 $this->properties  = array(
			 'settings',
		 );

		 // Get the options.
		 WP_CMS_Settings\wp_cms_settings()->_activate();
		 $settings = ( is_multisite() ) ? get_site_option( 'wp_cms_settings' ) : get_option( 'wp_cms_settings' );
		 // Set settings property.
		 $this->set_property( $this->class, 'settings', $settings );
	 }

	 /**
	  * Test Init.
	  *
	  * @author Jason Witt
	  * @since  0.0.1
	  *
	  * @return void
	  */
	 public function test_init() {
		 $this->class->init();
		 $hooks = array(
			 array(
				 'hook_name' => 'init',
				 'method'    => 'disable_wlwmanifest',
				 'priority'  => 10,
			 ),
			 array(
				 'hook_name' => 'init',
				 'method'    => 'disable_wp_generator',
				 'priority'  => 10,
			 ),
			 array(
				 'hook_name' => 'init',
				 'method'    => 'disable_wp_shortlink',
				 'priority'  => 10,
			 ),
		 );
		 foreach ( $hooks as $hook ) {
			 $this->assertEquals( $hook['priority'], has_action( $hook['hook_name'], array( $this->class, $hook['method'] ) ), 'init() is not attaching ' . $hook['method'] . '() to ' . $hook['hook_name'] . '!' );
		 }
	 }
 }
