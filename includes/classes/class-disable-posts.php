<?php
/**
 * Disable Posts
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

if ( ! class_exists( 'Disable_Posts' ) ) {

	/**
	 * Disable Posts.
	 *
	 * @author Jason Witt
	 * @since  0.0.1
	 */
	class Disable_Posts {

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
			$option = ( isset( $this->settings['disable_posts'] ) ) ? $this->settings['disable_posts'] : 'false';
			if ( 'true' === $option ) {
				add_action( 'init', array( $this, 'disable_posts' ) );
			}
		}

		/**
		 * Disable Posts.
		 *
		 * @author Jason Witt
		 * @since  0.0.1
		 *
		 * @return void
		 */
		public function disable_posts() {
			add_action( 'admin_head', array( $this, 'remove_posts_menu_item' ) );
			add_action( 'load-post.php', array( $this, 'disable_posts_pages' ) );
			add_action( 'load-edit.php', array( $this, 'disable_posts_pages' ) );
			add_action( 'load-post-new.php', array( $this, 'disable_posts_pages' ) );
		}

		/**
		 * Remove Comments menu item.
		 *
		 * @author Jason Witt
		 * @since  0.0.1
		 *
		 * @return void
		 */
		public function remove_posts_menu_item() {
			global $menu;

			// Get the post type.
			$post_type = $this->get_post_type();

			foreach ( $menu as $key => $value ) {
				if ( in_array( 'Posts', $value, true ) ) {
					unset( $menu[ $key ] );
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
		public function disable_posts_pages() {

			// Get the post type.
			$post_type = $this->get_post_type();

			// If post die.
			if ( 'post' === $post_type ) {
				wp_die( __( 'Invalid Post Type.', 'wp-cms-settings' ) );
			}
		}

		/**
		 * Get Post Type.
		 *
		 * @author Jason Witt
		 * @since  0.0.1
		 *
		 * @return string
		 */
		public function get_post_type() {
			global $post, $typenow, $current_screen;

			$post_type = '';

			if ( ! is_admin() ) {
				return $post_type;
			}

			if ( $post && $post->post_type ) {
				$post_type = $post->post_type;
			} elseif ( $typenow ) {
				$post_type = $typenow;
			} elseif ( $current_screen && $current_screen->post_type ) {
				$post_type = $current_screen->post_type;
			} elseif ( isset( $_REQUEST['post_type'] ) ) {
				$post_type = sanitize_key( $_REQUEST['post_type'] );
			} elseif ( isset( $_REQUEST['post'] ) ) {
				$post_type = get_post_type( sanitize_key( $_REQUEST['post'] ) );
			}

			return $post_type;
		}
	}
}
