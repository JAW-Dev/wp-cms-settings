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
		 $this->file            = $this->dirname() . 'includes/classes/class-disable-emojis.php';
		 $this->class_name      = 'WP_CMS_Settings\\Includes\\Classes\\Disable_Emojis';
		 $this->class           = new WP_CMS_Settings\Includes\Classes\Disable_Emojis();
		 $this->methods         = array(
			 'init',
			 'disable_emojis',
			 'disable_emojis_tinymce',
		 );
		 $this->properties      = array(
			 'settings',
		 );
		 $this->option_settings = array(
			 array(
				 'name' => 'disable_emojis',
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
				 'method'    => 'disable_emojis',
			 ),
		 );
		 $this->assertAddHooks( $hooks );
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
				 'type'      => 'add_filter',
				 'method'    => 'disable_emojis_tinymce',
			 ),
			 array(
				 'hook_name' => 'wp_resource_hints',
				 'type'      => 'add_filter',
				 'method'    => 'disable_emojis_remove_dns_prefetch',
			 ),
		 );
		 $this->assertAddHooks( $hooks );
	 }
 }
