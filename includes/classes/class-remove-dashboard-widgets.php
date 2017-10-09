<?php
/**
 * Remove Default Dashboard Widgets
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

if ( ! class_exists( '\\WP_CMS_Settings\\\Includes\\\Classes\\Remove_Dashboard_Widgets' ) ) {

	/**
	 * Remove Default Dashboard Widgets.
	 *
	 * @author Jason Witt
	 * @since  0.0.1
	 */
	class Remove_Dashboard_Widgets {

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
			$remove_dashboard_right_now   = ( isset( $this->settings['remove_dashboard_right_now'] ) ) ? $this->settings['remove_dashboard_right_now'] : 'false';
			$remove_dashboard_activity    = ( isset( $this->settings['remove_dashboard_activity'] ) ) ? $this->settings['remove_dashboard_activity'] : 'false';
			$remove_dashboard_quick_press = ( isset( $this->settings['remove_dashboard_quick_press'] ) ) ? $this->settings['remove_dashboard_quick_press'] : 'false';
			$remove_dashboard_primary     = ( isset( $this->settings['remove_dashboard_primary'] ) ) ? $this->settings['remove_dashboard_primary'] : 'false';
			if ( 'true' === $remove_dashboard_right_now ) {
				add_action( 'wp_dashboard_setup', array( $this, 'remove_dashboard_right_now' ) );
			}
			if ( 'true' === $remove_dashboard_activity ) {
				add_action( 'wp_dashboard_setup', array( $this, 'remove_dashboard_activity' ) );
			}
			if ( 'true' === $remove_dashboard_quick_press ) {
				add_action( 'wp_dashboard_setup', array( $this, 'remove_dashboard_quick_press' ) );
			}
			if ( 'true' === $remove_dashboard_primary ) {
				add_action( 'wp_dashboard_setup', array( $this, 'remove_dashboard_primary' ) );
			}
		}

		/**
		 * Remove dashboard_right_now.
		 *
		 * @author Jason Witt
		 * @since  0.0.1
		 *
		 * @return void
		 */
		public function remove_dashboard_right_now() {
			global $wp_meta_boxes;
			unset( $wp_meta_boxes['dashboard']['normal']['core']['dashboard_right_now'] );
		}

		/**
		 * Remove dashboard_activity.
		 *
		 * @author Jason Witt
		 * @since  0.0.1
		 *
		 * @return void
		 */
		public function remove_dashboard_activity() {
			global $wp_meta_boxes;
			unset( $wp_meta_boxes['dashboard']['normal']['core']['dashboard_activity'] );
		}

		/**
		 * Remove dashboard_quick_press.
		 *
		 * @author Jason Witt
		 * @since  0.0.1
		 *
		 * @return void
		 */
		public function remove_dashboard_quick_press() {
			global $wp_meta_boxes;
			unset( $wp_meta_boxes['dashboard']['side']['core']['dashboard_quick_press'] );
		}

		/**
		 * Remove remove_dashboard_primary.
		 *
		 * @author Jason Witt
		 * @since  0.0.1
		 *
		 * @return void
		 */
		public function remove_dashboard_primary() {
			global $wp_meta_boxes;
			unset( $wp_meta_boxes['dashboard']['side']['core']['dashboard_primary'] );
		}
	}
}
