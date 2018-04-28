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

if ( ! class_exists( '\\WP_CMS_Settings\\\Includes\\\Classes\\Remove_Widgets' ) ) {

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
		 * Initialize the class
		 *
		 * @author Jason Witt
		 * @since  0.0.1
		 *
		 * @return void
		 */
		public function __construct() {
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
			add_action( 'widgets_init', array( $this, 'unregister_widgets' ),11 );
		}

		/**
		 * Get WP Widgets.
		 *
		 * @author Jason Witt
		 * @since  0.0.1
		 *
		 * @return void
		 */
		public function get_wp_widgets( $callback ) {
			global $wp_widget_factory;

			// Loop through the registeres widgets.
			foreach ( $wp_widget_factory->widgets as $widget ) {
				$class_name = get_class( $widget );

				// If the widget is a core widget.
				// Test by looking for "WP_" prefix on object name.
				if ( strpos( $class_name, 'WP_' ) !== false ) {
					$option = str_replace( 'wp', 'remove', strtolower( $class_name ) );
					call_user_func_array( $callback, array( $class_name, $option, $widget ) );
				}
			}
		}

		/**
		 * Unregister Widgets.
		 *
		 * @author Jason Witt
		 * @since  0.0.1
		 *
		 * @return void
		 */
		public function unregister_widgets() {
			$this->get_wp_widgets( function( $class_name, $option, $widget ) {
				$setting = ( isset( $this->settings[ $option ] ) ) ? $this->settings[ $option ] : 'false';
				if ( 'true' === $setting ) {
					unregister_widget( $class_name );
				}
			});
		}
	}
}
