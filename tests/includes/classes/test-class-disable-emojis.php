<?php
/**
 * Disable Emojis Test.
 *
 * @package    WP_CMS_Settings
 * @subpackage WP_CMS_Settings\Tests\Includes\Classes
 * @author     Jason Witt <contact@jawittdesigns.com>
 * @copyright  Copyright (c) 2017, Jason Witt
 * @license    GNU General Public License v2 or later
 * @version    0.0.1
 */

 /**
  * Main Plugin File Test.
  *
  * @author Jason Witt
  * @since  1.0.0
  */
 class Disable_Emojis_Test extends Base_UnitTestCase {

	 /**
	  * SetUp.
	  *
	  * @author Jason Witt
	  * @since  0.0.1
	  *
	  * @return void
	  */
	 public function setUp() {
		 $this->file       = $this->dirname() . 'includes/classes/class-disable-emojis.php';
		 $this->class_name = 'WP_CMS_Settings\\Includes\\Classes\\Disable_Emojis';
		 $this->class      = new WP_CMS_Settings\Includes\Classes\Disable_Emojis();
		 $this->methods    = array(
			 'init',
			 'disable_emojis',
			 'disable_emojis_tinymce',
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
				 'method'    => 'disable_emojis',
				 'priority'  => 10,
			 ),
		 );
		 foreach ( $hooks as $hook ) {
			 $this->assertEquals( $hook['priority'], has_action( $hook['hook_name'], array( $this->class, $hook['method'] ) ), 'init() is not attaching ' . $hook['method'] . '() to ' . $hook['hook_name'] . '!' );
		 }
	 }

	 /**
	  * Disable Emojis.
	  *
	  * @author Jason Witt
	  * @since  0.0.1
	  *
	  * @return void
	  */
	 public function test_disable_emojis() {
		 $this->class->disable_emojis();
		 $hooks = array(
			 array(
				 'hook_name' => 'tiny_mce_plugins',
				 'method'    => 'disable_emojis_tinymce',
				 'priority'  => 10,
			 ),
			 array(
				 'hook_name' => 'wp_resource_hints',
				 'method'    => 'disable_emojis_remove_dns_prefetch',
				 'priority'  => 10,
			 ),
		 );
		 foreach ( $hooks as $hook ) {
			 $this->assertEquals( $hook['priority'], has_filter( $hook['hook_name'], array( $this->class, $hook['method'] ) ), 'disable_emojis() is not attaching ' . $hook['method'] . '() to ' . $hook['hook_name'] . '!' );
		 }
	 }
 }
