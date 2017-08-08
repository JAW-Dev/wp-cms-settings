<?php
/**
 * Remove Widgets Test.
 *
 * @package    WP_CMS_Settings
 * @subpackage WP_CMS_Settings\Tests\Includes\Classes
 * @author     Jason Witt <contact@jawittdesigns.com>
 * @copyright  Copyright (c) 2017, Jason Witt
 * @license    GNU General Public License v2 or later
 * @version    0.0.1
 */

 /**
  * Remove Widgets Test.
  *
  * @author Jason Witt
  * @since  1.0.0
  */
 class Remove_Widgets_Test extends Base_UnitTestCase {

	 /**
	  * SetUp.
	  *
	  * @author Jason Witt
	  * @since  0.0.1
	  *
	  * @return void
	  */
	 public function setUp() {
		 $this->file            = $this->dirname() . 'includes/classes/class-remove-widgets.php';
		 $this->class_name      = 'WP_CMS_Settings\\Includes\\Classes\\Remove_Widgets';
		 $this->class           = new WP_CMS_Settings\Includes\Classes\Remove_Widgets();
		 $this->methods    = array(
			 'init',
			 'get_wp_widgets',
			 'unregister_widgets',
		 );
		 $this->properties  = array(
			 'settings',
		 );
	 }
 }
