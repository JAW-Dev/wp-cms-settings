<?php
/**
 * Disable Customizer
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

if ( ! class_exists( '\\WP_CMS_Settings\\\Includes\\\Classes\\Disable_Customizer' ) ) {

	/**
	 * Disable Customizer.
	 *
	 * @author Jason Witt
	 * @since  0.0.1
	 */
	class Disable_Customizer {

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

			add_action( 'admin_init', function() {
				global $submenu, $menu, $pagenow;
			});
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
			$option = ( isset( $this->settings['disable_customizer'] ) ) ? $this->settings['disable_customizer'] : 'false';
			if ( 'true' === $option ) {
				add_action( 'init', array( $this, 'remove_capability' ), 10 );
				add_action( 'load-customize.php', array( $this, 'disable_customizer' ) );
				add_action( 'admin_init', array( $this, 'admin_actions' ), 10 );
				add_action( 'admin_menu', array( $this, 'remove_menu_items' ) );
			}
		}

		/**
		 * Remove Capability.
		 *
		 * @author Jason Witt
		 * @since  0.0.1
		 *
		 * @return void
		 */
		public function remove_capability() {
			add_filter( 'map_meta_cap', array( $this, 'customizer_filter' ), 10, 4 );
		}

		/**
		 * Customizer Filter.
		 *
		 * @author Jason Witt
		 * @since  0.0.1
		 *
		 * @param array  $caps    Returns the user's actual capabilities.
		 * @param string $cap     Capability name.
		 *
		 * @return array $caps The user's capabilities.
		 */
		public function customizer_filter( $caps = array(), $cap = '' ) {
			if ( 'customize' === $cap ) {
				return array( 'nope' );
			}
			return $caps;
		}

		/**
		 * Disable Press This.
		 *
		 * @author Jason Witt
		 * @since  0.0.1
		 *
		 * @return void
		 */
		public function disable_customizer() {
			wp_die( esc_html( __( 'Customizer functionality has been disabled.', 'wp-cms-settings' ) ) );
		}

		/**
		 * Admin Actions.
		 *
		 * @author Jason Witt
		 * @since  0.0.1
		 *
		 * @return void
		 */
		public function admin_actions() {
			remove_action( 'plugins_loaded', '_wp_customize_include', 10 );
			remove_action( 'admin_enqueue_scripts', '_wp_customize_loader_settings', 11 );
		}

		/**
		 * Remove Menu Items.
		 *
		 * @author Jason Witt
		 * @since  0.0.1
		 *
		 * @return void
		 */
		public function remove_menu_items() {
			global $submenu;
			if ( isset( $submenu['themes.php'] ) ) {
				foreach ( $submenu['themes.php'] as $index => $menu_item ) {
					if ( in_array( 'Customize', $menu_item, true ) ) {
						unset( $submenu['themes.php'][ $index ] );
					}
				}
			}
		}
	}
}
