<?php
/**
 * Remove Categories and Tags Converter from Tools
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

//include ABSPATH . 'wp-admin/includes/class-wp-press-this.php';

if ( ! class_exists( 'Remove_Cat_Tag_Converter' ) ) {

	/**
	 * Remove Categories and Tags Converter from Tools.
	 *
	 * @author Jason Witt
	 * @since  0.0.1
	 */
	class Remove_Cat_Tag_Converter {

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
			$option = ( isset( $this->settings['remove_cat_tag_converter'] ) ) ? $this->settings['remove_cat_tag_converter'] : 'false';
			if ( 'true' === $option ) {
				add_action( 'load-tools.php', array( $this, 'tools_page' ) );
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
			wp_add_inline_style( 'forms', '.card { display: none } .card.pressthis { display: block }' );
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
			$screen->remove_help_tab( 'converter' );
			return $old_help;
		}
	}
}
