<?php
/**
 * Disable Taxonomies Test.
 *
 * @package    WP_CMS_Settings
 * @subpackage WP_CMS_Settings\Tests\Includes\Classes
 * @author     Jason Witt <contact@jawittdesigns.com>
 * @copyright  Copyright (c) 2017, Jason Witt
 * @license    GNU General Public License v2 or later
 * @version    0.0.1
 */

 /**
  * Disable Taxonomies Test.
  *
  * @author Jason Witt
  * @since  1.0.0
  */
 class Disable_Taxonomies_Test extends Base_UnitTestCase {

	 /**
	  * SetUp.
	  *
	  * @author Jason Witt
	  * @since  0.0.1
	  *
	  * @return void
	  */
	 public function setUp() {
		 $this->file       = $this->dirname() . 'includes/classes/class-disable-taxonomies.php';
		 $this->class_name = 'WP_CMS_Settings\\Includes\\Classes\\Disable_Taxonomies';
		 $this->class      = new WP_CMS_Settings\Includes\Classes\Disable_Taxonomies();
		 $this->methods    = array(
			 'init',
			 'unregister_category',
			 'unregister_post_tag',
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
				 'hook_name' => 'init',
				 'type'      => 'add_action',
				 'method'    => 'unregister_category',
			 ),
			 array(
				 'hook_name' => 'init',
				 'type'      => 'add_action',
				 'method'    => 'unregister_post_tag',
			 ),
		 );
		 $this->assertAddHooks( $hooks );
	 }
 }
