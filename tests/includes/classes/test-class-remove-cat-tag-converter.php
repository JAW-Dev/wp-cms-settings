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
				 'hook_name' => 'load-tools.php',
				 'type'      => 'add_action',
				 'method'    => 'tools_page',
			 ),
		 );
		 $this->assertAddHooks( $hooks );
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
		 $hooks = array(
			 array(
				 'hook_name' => 'admin_enqueue_scripts',
				 'type'      => 'add_action',
				 'method'    => 'styles',
			 ),
			 array(
				 'hook_name' => 'contextual_help',
				 'type'      => 'add_filter',
				 'method'    => 'remove_help_tab',
			 ),
		 );
		 $this->assertAddHooks( $hooks );
	 }
 }
