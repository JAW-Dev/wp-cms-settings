<?php
/**
 * Remove Default Sidebar Widgets
 *
 * @package    WP_CMS_Settings
 * @subpackage WP_CMS_Settings/Includes/Classes
 * @author     Jason Witt <contact@jawittdesigns.com>
 * @copyright  Copyright (c) 2017, Jason Witt
 * @license    GNU General Public License v2 or later
 * @version    0.0.1
 */

namespace WP_CMS_Settings\Includes\Classes;

use \WP_CMS_Settings as Root;

if ( ! class_exists( 'Remove_Widgets' ) ) {

	/**
	 * Remove Default Sidebar Widgets.
	 *
	 * @author Jason Witt
	 * @since  0.0.1
	 */
	class Remove_Widgets {

		/**
		 * Settings.
		 *
		 * @author Jason Witt
		 * @since  0.0.1
		 *
		 * @var array
		 */
		protected $settings;

		/**
		 * Widgets.
		 *
		 * @author Jason Witt
		 * @since  0.0.1
		 *
		 * @var array
		 */
		protected $widgets;

		/**
		 * Initialize the class
		 *
		 * @author Jason Witt
		 * @since  0.0.1
		 *
		 * @return void
		 */
		public function __construct() {
			// Set the properties.
			$this->settings = Root\wp_cms_settings()->get_settings;
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
			$this->init();
		}

		/**
		 * Init
		 *
		 * @author Jason Witt
		 * @since  0.0.1
		 *
		 * @return void
		 */
		public function init() {
			foreach ( $this->widgets as $widget ) {
				$option = ( isset( $this->settings[ $widget ] ) ) ? $this->settings[ $widget ] : 'false';
				if ( 'true' === $option ) {
					add_action( 'widgets_init', array( $this, $widget ),11 );
				}
			}
		}

		/**
		 * Remove WP_Widget_Pages.
		 *
		 * @author Jason Witt
		 * @since  0.0.1
		 *
		 * @return void
		 */
		public function remove_widget_pages() {
			unregister_widget( 'WP_Widget_Pages' );
		}

		/**
		 * Remove WP_Widget_Calendar.
		 *
		 * @author Jason Witt
		 * @since  0.0.1
		 *
		 * @return void
		 */
		public function remove_widget_calendar() {
			unregister_widget( 'WP_Widget_Calendar' );
		}

		/**
		 * Remove WP_Widget_Archives.
		 *
		 * @author Jason Witt
		 * @since  0.0.1
		 *
		 * @return void
		 */
		public function remove_widget_archives() {
			unregister_widget( 'WP_Widget_Archives' );
		}

		/**
		 * Remove WP_Widget_Media_Audio.
		 *
		 * @author Jason Witt
		 * @since  0.0.1
		 *
		 * @return void
		 */
		public function remove_widget_media_audio() {
			unregister_widget( 'WP_Widget_Media_Audio' );
		}

		/**
		 * Remove WP_Widget_Media_Image.
		 *
		 * @author Jason Witt
		 * @since  0.0.1
		 *
		 * @return void
		 */
		public function remove_widget_media_image() {
			unregister_widget( 'WP_Widget_Media_Image' );
		}

		/**
		 * Remove WP_Widget_Media_Video.
		 *
		 * @author Jason Witt
		 * @since  0.0.1
		 *
		 * @return void
		 */
		public function remove_widget_media_video() {
			unregister_widget( 'WP_Widget_Media_Video' );
		}

		/**
		 * Remove WP_Widget_Meta.
		 *
		 * @author Jason Witt
		 * @since  0.0.1
		 *
		 * @return void
		 */
		public function remove_widget_meta() {
			unregister_widget( 'WP_Widget_Meta' );
		}

		/**
		 * Remove WP_Widget_Search.
		 *
		 * @author Jason Witt
		 * @since  0.0.1
		 *
		 * @return void
		 */
		public function remove_widget_search() {
			unregister_widget( 'WP_Widget_Search' );
		}

		/**
		 * Remove WP_Widget_Text.
		 *
		 * @author Jason Witt
		 * @since  0.0.1
		 *
		 * @return void
		 */
		public function remove_widget_text() {
			unregister_widget( 'WP_Widget_Text' );
		}

		/**
		 * Remove WP_Widget_Categories.
		 *
		 * @author Jason Witt
		 * @since  0.0.1
		 *
		 * @return void
		 */
		public function remove_widget_categories() {
			unregister_widget( 'WP_Widget_Categories' );
		}

		/**
		 * Remove WP_Widget_Recent_Posts.
		 *
		 * @author Jason Witt
		 * @since  0.0.1
		 *
		 * @return void
		 */
		public function remove_widget_recent_posts() {
			unregister_widget( 'WP_Widget_Recent_Posts' );
		}

		/**
		 * Remove WP_Widget_Recent_Comments.
		 *
		 * @author Jason Witt
		 * @since  0.0.1
		 *
		 * @return void
		 */
		public function remove_widget_recent_comments() {
			unregister_widget( 'WP_Widget_Recent_Comments' );
		}

		/**
		 * Remove WP_Widget_RSS.
		 *
		 * @author Jason Witt
		 * @since  0.0.1
		 *
		 * @return void
		 */
		public function remove_widget_rss() {
			unregister_widget( 'WP_Widget_RSS' );
		}

		/**
		 * Remove WP_Widget_Tag_Cloud.
		 *
		 * @author Jason Witt
		 * @since  0.0.1
		 *
		 * @return void
		 */
		public function remove_widget_tag_cloud() {
			unregister_widget( 'WP_Widget_Tag_Cloud' );
		}

		/**
		 * Remove WP_Nav_Menu_Widget.
		 *
		 * @author Jason Witt
		 * @since  0.0.1
		 *
		 * @return void
		 */
		public function remove_widget_nav_menu() {
			unregister_widget( 'WP_Nav_Menu_Widget' );
		}
	}
}
