<?php
/**
 * Remove Categories and Tags Converter Test.
 *
 * @package    WP_CMS_Settings
 * @subpackage WP_CMS_Settings\Tests\Includes\Classes
 * @author     Jason Witt <contact@jawittdesigns.com>
 * @copyright  Copyright (c) 2017, Jason Witt
 * @license    GNU General Public License v2 or later
 * @version    0.0.1
 */

 /**
  * Remove Categories and Tags Converter Test.
  *
  * @author Jason Witt
  * @since  1.0.0
  */
 class Remove_Cat_Tag_Converter_Test extends Base_UnitTestCase {

	 /**
	  * SetUp.
	  *
	  * @author Jason Witt
	  * @since  0.0.1
	  *
	  * @return void
	  */
	 public function setUp() {
		 $this->file       = $this->dirname() . 'includes/classes/class-remove-cat-tag-converter.php';
		 $this->class_name = 'WP_CMS_Settings\\Includes\\Classes\\Remove_Cat_Tag_Converter';
		 $this->class      = new WP_CMS_Settings\Includes\Classes\Remove_Cat_Tag_Converter();
		 $this->methods    = array(
			 'init',
			 'tools_page',
			 'styles',
			 'remove_help_tab',
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
				 'hook_name' => 'load-tools.php',
				 'method'    => 'tools_page',
				 'priority'  => 10,
			 ),
		 );
		 foreach ( $hooks as $hook ) {
			 $this->assertEquals( $hook['priority'], has_action( $hook['hook_name'], array( $this->class, $hook['method'] ) ), 'init() is not attaching ' . $hook['method'] . '() to ' . $hook['hook_name'] . '!' );
		 }
	 }

	 /**
	  * Test Tools Page.
	  *
	  * @author Jason Witt
	  * @since  0.0.1
	  *
	  * @return void
	  */
	 public function test_tools_page() {
		 $this->class->tools_page();
		 $this->assertEquals( 10, has_action( 'admin_enqueue_scripts', array( $this->class, 'styles' ) ), 'tools_page() is not attaching styles() to admin_enqueue_scripts!' );
		 $this->assertEquals( 10, has_filter( 'contextual_help', array( $this->class, 'remove_help_tab' ) ), 'tools_page() is not attaching remove_help_tab() to contextual_help!' );
	 }
 }
