<?php
/**
 * Disable Press This
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

if ( ! class_exists( 'Disable_Press_This' ) ) {

	/**
	 * Disable Press This.
	 *
	 * @author Jason Witt
	 * @since  0.0.1
	 */
	class Disable_Press_This {

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
			$option = ( isset( $this->settings['disable_press_this'] ) ) ? $this->settings['disable_press_this'] : 'false';
			if ( 'true' === $option ) {
				add_action( 'load-tools.php', array( $this, 'tools_page' ) );
				add_action( 'load-press-this.php', array( $this, 'disable_press_this' ) );
			}
		}

		/**
		 * Tools Page.
		 *
		 * @author Jason Witt
		 * @since  0.0.1
		 *
		 * @return void
		 */
		public function tools_page() {
			add_action( 'admin_enqueue_scripts', array( $this, 'styles' ) );
			add_filter( 'contextual_help', array( $this, 'remove_help_tab' ), 10, 3 );
		}

		/**
		 * Styles.
		 *
		 * @author Jason Witt
		 * @since  0.0.1
		 *
		 * @return void
		 */
		public function styles() {
			wp_add_inline_style( 'forms', '.card.pressthis { display: none !important }' );
		}

		/**
		 * Remove Help Tab.
		 *
		 * @author Jason Witt
		 * @since  0.0.1
		 *
		 * @param string    $old_help  Help text that appears on the screen.
		 * @param string    $screen_id Screen ID.
		 * @param WP_Screen $screen    Current WP_Screen instance.
		 *
		 * @return array
		 */
		public function remove_help_tab( $old_help, $screen_id, $screen ) {
			$screen->remove_help_tab( 'press-this' );
			return $old_help;
		}

		/**
		 * Disable Press This.
		 *
		 * @author Jason Witt
		 * @since  0.0.1
		 *
		 * @return void
		 */
		public function disable_press_this() {
			wp_die( 'Press This functionality has been disabled.' );
		}
	}
}
