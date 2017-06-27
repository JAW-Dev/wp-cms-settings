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
		 $this->file       = $this->dirname() . 'includes/classes/class-remove-widgets.php';
		 $this->class_name = 'WP_CMS_Settings\\Includes\\Classes\\Remove_Widgets';
		 $this->class      = new WP_CMS_Settings\Includes\Classes\Remove_Widgets();
		 $this->widgets = array(
			 'remove_widget_pages',
			 'remove_widget_calendar',
			 'remove_widget_archives',
			 'remove_widget_media_audio',
			 'remove_widget_media_image',
			 'remove_widget_media_video',
			 'remove_widget_meta',
			 'remove_widget_search',
			 'remove_widget_text',
			 'remove_widget_categories',
			 'remove_widget_recent_posts',
			 'remove_widget_recent_comments',
			 'remove_widget_rss',
			 'remove_widget_tag_cloud',
			 'remove_widget_nav_menu',
		 );
		 $this->methods    = array(
			 'init',
		 );
		 $this->widgets    = array_merge( $this->widgets, $this->widgets );
		 $this->properties = array(
			 'settings',
			 'widgets',
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
		 $hooks = array();

		 foreach ( $this->widgets as $widget ) {
			 $hooks[] = array(
				 'hook_name' => 'widgets_init',
				 'method'    => $widget,
				 'priority'  => 11,
			 );
		 }
		 foreach ( $hooks as $hook ) {
			 $this->assertEquals( $hook['priority'], has_action( $hook['hook_name'], array( $this->class, $hook['method'] ) ), 'init() is not attaching ' . $hook['method'] . '() to ' . $hook['hook_name'] . '!' );
		 }
	 }
 }
