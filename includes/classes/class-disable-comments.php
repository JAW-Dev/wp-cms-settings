<?php
/**
 * Disable Comments
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

if ( ! class_exists( 'Disable_Comments' ) ) {

	/**
	 * Disable Comments.
	 *
	 * @author Jason Witt
	 * @since  0.0.1
	 */
	class Disable_Comments {

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
			$option = ( isset( $this->settings['disable_comments'] ) ) ? $this->settings['disable_comments'] : 'false';
			if ( 'true' === $option ) {
				add_action( 'init', array( $this, 'disable_comments' ) );
			}
		}

		/**
		 * Disable Comments.
		 *
		 * @author Jason Witt
		 * @since  0.0.1
		 *
		 * @return void
		 */
		public function disable_comments() {
			add_filter( 'comments_open', '__return_false' );
			add_filter( 'pings_open', '__return_false' );
			add_filter( 'comments_array', array( $this, 'hide_comments' ), 10, 2 );
			add_action( 'admin_menu', array( $this, 'remove_comments_menu_item' ) );
			add_action( 'load-edit-comments.php', array( $this, 'disable_comments_page' ) );
		}

		/**
		 * Hide Comments.
		 *
		 * @author Jason Witt
		 * @since  0.0.1
		 *
		 * @param array $comments The comments array.
		 *
		 * @return array
		 */
		public function hide_comments( $comments ) {

			// Empty the comments array.
			$comments = array();
			return $comments;
		}
		
		/**
		 * Remove Comments menu item.
		 *
		 * @author Jason Witt
		 * @since  0.0.1
		 *
		 * @return void
		 */
		public function remove_comments_menu_item() {
			remove_menu_page( 'edit-comments.php' );
		}

		/**
		 * Disable Comments page.
		 *
		 * @author Jason Witt
		 * @since  0.0.1
		 *
		 * @return void
		 */
		public function disable_comments_page() {
			wp_die( __( 'Press Comments have been disabled.', 'wp-cms-settings' ) );
		}
	}
}
