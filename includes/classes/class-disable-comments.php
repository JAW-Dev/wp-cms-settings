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

if ( ! class_exists( '\\WP_CMS_Settings\\\Includes\\\Classes\\Disable_Comments' ) ) {

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
			add_action( 'admin_init', array( $this, 'remove_support' ) );
			add_action( 'admin_menu', array( $this, 'remove_comments_menu_item' ) );
			add_action( 'load-edit-comments.php', array( $this, 'disable_comments_pages' ) );
			add_action( 'load-comment.php', array( $this, 'disable_comments_pages' ) );
			add_action( 'load-options-discussion.php', array( $this, 'disable_comments_pages' ) );
		}

		/**
		 * Remove comment support.
		 *
		 * @author Jason Witt
		 * @since  0.0.1
		 *
		 * @return void
		 */
		public function remove_support() {
			$post_types = get_post_types();

			// Loop throught the post types.
			foreach ( $post_types as $post_type ) {

				// Remove comments support.
				if ( post_type_supports( $post_type, 'comments' ) ) {
					remove_post_type_support( $post_type, 'comments' );
				}

				// Remove tractbacks support.
				if ( post_type_supports( $post_type, 'trackbacks' ) ) {
					remove_post_type_support( $post_type, 'trackbacks' );
				}
			}
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
			global $submenu;

			// Remove main Comments menu item.
			remove_menu_page( 'edit-comments.php' );

			// Remove Discussion sub-menu item.
			if ( isset( $submenu['options-general.php'] ) ) {
				foreach ( $submenu['options-general.php'] as $index => $menu_item ) {
					if ( in_array( 'Discussion', $menu_item, true ) ) {
						unset( $submenu['options-general.php'][ $index ] );
					}
				}
			}
		}

		/**
		 * Disable Comments page.
		 *
		 * @author Jason Witt
		 * @since  0.0.1
		 *
		 * @return void
		 */
		public function disable_comments_pages() {
			wp_die( __( 'Press Comments have been disabled.', 'wp-cms-settings' ) );
		}
	}
}
