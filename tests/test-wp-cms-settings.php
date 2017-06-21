<?php
/**
 * Main Plugin File Test.
 *
 * @package    WP_CMS_Settings
 * @subpackage WP_CMS_Settings\Tests
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
 class WP_CMS_Settings_Test extends Base_UnitTestCase {

	 /**
	  * SetUp.
	  *
	  * @author Jason Witt
	  * @since  0.0.1
	  *
	  * @return void
	  */
	 public function setUp() {
		 $this->file       = $this->dirname() . 'wp-cms-settings.php';
		 $this->class_name = 'WP_CMS_Settings\\WP_CMS_Settings';
		 $this->methods    = array(
			 '_activate',
			 'init',
		 );
		 $this->properties  = array(
			'plugin_slug',
			'get_settings',
		 );
	 }

	 /**
	  * Test that our main helper function is an instance of our class.
	  *
	  * @since  1.0.0
	  */
	 function test_get_instance() {
		 $this->assertInstanceOf( $this->class_name, WP_CMS_Settings\wp_cms_settings() );
	 }
 }
