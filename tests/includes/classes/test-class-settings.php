<?php
/**
 * Settings Test.
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
 class Settings_Test extends Base_UnitTestCase {

	 /**
	  * SetUp.
	  *
	  * @author Jason Witt
	  * @since  0.0.1
	  *
	  * @return void
	  */
	 public function setUp() {
		 $this->file       = $this->dirname() . 'includes/classes/class-settings.php';
		 $this->class_name = 'WP_CMS_Settings\\Includes\\Classes\\Settings';
		 $this->class      = new WP_CMS_Settings\Includes\Classes\Settings();
		 $this->methods    = array(
			 'init',
			 'settings_page',
			 'render_settings_page',
			 'save',
			 'admin_notice',
			 'include_fields',
			 'get_active_tab',
			 'checkbox_values',
			 'sanitize',
			 'redirect_after_save',
		 );
		 $this->properties  = array(
			 'plugin_slug',
			 'settings',
			 'active_tab',
		 );
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
		 $menu    = ( is_multisite() ) ? 'network_admin_menu' : 'admin_menu';
		 $notices = ( is_multisite() ) ? 'network_admin_notices' : 'admin_notices';
		 $hooks = array(
			 array(
				 'hook_name' => $menu,
				 'method'    => 'settings_page',
				 'priority'  => 10,
			 ),
			 array(
				 'hook_name' => 'init',
				 'method'    => 'save',
				 'priority'  => 10,
			 ),
			 array(
				 'hook_name' => $notices,
				 'method'    => 'admin_notice',
				 'priority'  => 10,
			 ),
		 );
		 foreach ( $hooks as $hook ) {
			 $this->assertEquals( $hook['priority'], has_action( $hook['hook_name'], array( $this->class, $hook['method'] ) ), 'init() is not attaching ' . $hook['method'] . '() to ' . $hook['hook_name'] . '!' );
		 }
	 }
 }