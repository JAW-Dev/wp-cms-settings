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
		 $this->option_settings = array(
			 array(
				 'name' => 'remove_widget_pages',
				 'name' => 'remove_widget_calendar',
				 'name' => 'remove_widget_archives',
				 'name' => 'remove_widget_media_audio',
				 'name' => 'remove_widget_media_image',
				 'name' => 'remove_widget_media_video',
				 'name' => 'remove_widget_meta',
				 'name' => 'remove_widget_search',
				 'name' => 'remove_widget_text',
				 'name' => 'remove_widget_categories',
				 'name' => 'remove_widget_recent_posts',
				 'name' => 'remove_widget_recent_comments',
				 'name' => 'remove_widget_rss',
				 'name' => 'remove_widget_tag_cloud',
				 'name' => 'remove_nav_menu_widget',
				 'name' => 'remove_widget_custom_html',
			 ),
		 );
		 $this->set_the_options();
	 }
 }
