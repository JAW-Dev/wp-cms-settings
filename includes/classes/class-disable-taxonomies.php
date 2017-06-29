<?php
/**
 * Disable Taxonomies
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

if ( ! class_exists( 'Disable_Taxonomies' ) ) {

	/**
	 * Disable Taxonomies.
	 *
	 * @author Jason Witt
	 * @since  0.0.1
	 */
	class Disable_Taxonomies {

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
			$category = ( isset( $this->settings['disable_categories'] ) ) ? $this->settings['disable_categories'] : 'false';
			$post_tag = ( isset( $this->settings['disable_post_tag'] ) ) ? $this->settings['disable_post_tag'] : 'false';
			if ( 'true' === $category ) {
				add_action( 'init', array( $this, 'unregister_category' ) );
			}
			if ( 'true' === $post_tag ) {
				add_action( 'init', array( $this, 'unregister_post_tag' ) );
			}
		}

		/**
		 * Unregister Categories.
		 *
		 * @author Jason Witt
		 * @since  0.0.1
		 *
		 * @return void
		 */
		public function unregister_category() {
			global $wp_taxonomies;

			// If category exists unset it for the wp_taxonomies array.
			if ( taxonomy_exists( 'category' ) ) {
				unset( $wp_taxonomies['category'] );
			}
		}

		/**
		 * Unregister Categories.
		 *
		 * @author Jason Witt
		 * @since  0.0.1
		 *
		 * @return void
		 */
		public function unregister_post_tag() {
			global $wp_taxonomies;

			// If post_tag exists unset it for the wp_taxonomies array.
			if ( taxonomy_exists( 'post_tag' ) ) {
				unset( $wp_taxonomies['post_tag'] );
			}
		}
	}
}
