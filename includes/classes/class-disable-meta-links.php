<?php
/**
 * Disable Meta Links
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

if ( ! class_exists( '\\WP_CMS_Settings\\\Includes\\\Classes\\Disable_Meta_Links' ) ) {

	/**
	 * Disable Meta Links.
	 *
	 * @author Jason Witt
	 * @since  0.0.1
	 */
	class Disable_Meta_Links {

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
			$wlwmanifest  = ( isset( $this->settings['disable_wlwmanifest'] ) ) ? $this->settings['disable_wlwmanifest'] : 'false';
			$wp_generator = ( isset( $this->settings['disable_wp_generator'] ) ) ? $this->settings['disable_wp_generator'] : 'false';
			$wp_shortlink = ( isset( $this->settings['disable_wp_shortlink'] ) ) ? $this->settings['disable_wp_shortlink'] : 'false';
			if ( 'true' === $wlwmanifest ) {
				add_action( 'init', array( $this, 'disable_wlwmanifest' ) );
			}
			if ( 'true' === $wp_generator ) {
				add_action( 'init', array( $this, 'disable_wp_generator' ) );
			}
			if ( 'true' === $wp_shortlink ) {
				add_action( 'init', array( $this, 'disable_wp_shortlink' ) );
			}
		}

		/**
		 * Disable wlwmanifest.
		 *
		 * @author Jason Witt
		 * @since  0.0.1
		 *
		 * @return void
		 */
		public function disable_wlwmanifest() {
			remove_action( 'wp_head', 'wlwmanifest_link' );
		}

		/**
		 * Disable WP Generator.
		 *
		 * @author Jason Witt
		 * @since  0.0.1
		 *
		 * @return void
		 */
		public function disable_wp_generator() {
			remove_action( 'wp_head', 'wp_generator' );
			add_filter( 'the_generator', '__return_false' );
		}

		/**
		 * Disable WP Shortlink.
		 *
		 * @author Jason Witt
		 * @since  0.0.1
		 *
		 * @return void
		 */
		public function disable_wp_shortlink() {
			remove_action( 'wp_head', 'wp_shortlink_wp_head', 10 );
		}
	}
}
