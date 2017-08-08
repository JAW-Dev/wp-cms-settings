<?php
/**
 * Disable Press This.
 *
 * @package    WP_CMS_Settings
 * @subpackage WP_CMS_Settings\Tests\Includes\Classes
 * @author     Jason Witt <contact@jawittdesigns.com>
 * @copyright  Copyright (c) 2017, Jason Witt
 * @license    GNU General Public License v2 or later
 * @version    0.0.1
 */

 /**
  * Disable Press This.
  *
  * @author Jason Witt
  * @since  1.0.0
  */
 class Disable_Disable_Customizer_Test extends Base_UnitTestCase {

	 /**
	  * SetUp.
	  *
	  * @author Jason Witt
	  * @since  0.0.1
	  *
	  * @return void
	  */
	 public function setUp() {
		 $this->file       = $this->dirname() . 'includes/classes/class-disable-customizer.php';
		 $this->class_name = 'WP_CMS_Settings\\Includes\\Classes\\Disable_Customizer';
		 $this->class      = new WP_CMS_Settings\Includes\Classes\Disable_Customizer();
		 $this->methods    = array(
			 'init',
			 'remove_capability',
			 'customizer_filter',
			 'disable_customizer',
			 'admin_actions',
			 'remove_menu_items',
		 );
		 $this->properties  = array(
			 'settings',
		 );
		 $this->option_settings = array(
			 array(
				 'name' => 'disable_customizer',
			 ),
		 );
		 $this->set_the_options();
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
				 'type'      => 'add_action',
				 'method'    => 'remove_capability',
			 ),
			 array(
				 'hook_name' => 'load-customize.php',
				 'type'      => 'add_action',
				 'method'    => 'disable_customizer',
			 ),
			 array(
				 'hook_name' => 'admin_init',
				 'type'      => 'add_action',
				 'method'    => 'admin_actions',
			 ),
			 array(
				 'hook_name' => 'admin_menu',
				 'type'      => 'add_action',
				 'method'    => 'remove_menu_items',
			 ),
		 );
		 $this->assertAddHooks( $hooks );
	 }
 }
