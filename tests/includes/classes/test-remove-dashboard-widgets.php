<?php
/**
 * Remove Dashboard Widgets Test.
 *
 * @package    WP_CMS_Settings
 * @subpackage WP_CMS_Settings\Tests\Includes\Classes
 * @author     Jason Witt <contact@jawittdesigns.com>
 * @copyright  Copyright (c) 2017, Jason Witt
 * @license    GNU General Public License v2 or later
 * @version    0.0.1
 */

 /**
  * Remove Dashboard Widgets Test.
  *
  * @author Jason Witt
  * @since  1.0.0
  */
 class Remove_Dashboard_Widgets_Test extends Base_UnitTestCase {

	 /**
	  * SetUp.
	  *
	  * @author Jason Witt
	  * @since  0.0.1
	  *
	  * @return void
	  */
	 public function setUp() {
		 $this->file       = $this->dirname() . 'includes/classes/class-remove-dashboard-widgets.php';
		 $this->class_name = 'WP_CMS_Settings\\Includes\\Classes\\Remove_Dashboard_Widgets';
		 $this->class      = new WP_CMS_Settings\Includes\Classes\Remove_Dashboard_Widgets();
		 $this->methods    = array(
			 'init',
			 'remove_dashboard_right_now',
			 'remove_dashboard_activity',
			 'remove_dashboard_quick_press',
			 'remove_dashboard_primary',
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
				 'hook_name' => 'wp_dashboard_setup',
				 'method'    => 'remove_dashboard_right_now',
				 'priority'  => 10,
			 ),
			 array(
				 'hook_name' => 'wp_dashboard_setup',
				 'method'    => 'remove_dashboard_activity',
				 'priority'  => 10,
			 ),
			 array(
				 'hook_name' => 'wp_dashboard_setup',
				 'method'    => 'remove_dashboard_quick_press',
				 'priority'  => 10,
			 ),
			 array(
				 'hook_name' => 'wp_dashboard_setup',
				 'method'    => 'remove_dashboard_primary',
				 'priority'  => 10,
			 ),
		 );
		 foreach ( $hooks as $hook ) {
			 $this->assertEquals( $hook['priority'], has_action( $hook['hook_name'], array( $this->class, $hook['method'] ) ), 'init() is not attaching ' . $hook['method'] . '() to ' . $hook['hook_name'] . '!' );
		 }
	 }
 }
