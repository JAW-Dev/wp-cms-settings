<?php
/**
 * Plugin Name: WP CMS Settings
 * Plugin URI:  https://github.com/jawittdesigns/wp-cms-settings
 * Description: Custom settings to make WordPress a streamline CMS
 * Version:     0.0.1
 * Author:      Jason Witt
 * Author URI:  http://jawittdesigns.com
 * Donate link: https://github.com/jawittdesigns/wp-cms-settings
 * License:     GPLv2
 * Text Domain: wp-cms-settings
 * Domain Path: /languages
 *
 * @package   WP_CMS_Settings
 * @author    Jason Witt <contact@jawittdesigns.com>
 * @copyright Copyright (c) 2017, Jason Witt
 * @license   GNU General Public License v2 or later
 * @version   0.0.1
 */

namespace WP_CMS_Settings;

use WP_CMS_Settings\Includes\Classes as Classes;

/**
 * Autoloader
 */
require_once trailingslashit( plugin_dir_path( __FILE__ ) ) . trailingslashit( 'includes' ) . 'autoload.php';

if ( ! class_exists( 'WP_CMS_Settings' ) ) {

	/**
	 * Name
	 *
	 * @author Jason Witt
	 * @since  0.0.1
	 */
	class WP_CMS_Settings {

		/**
		 * Plugin Slug.
		 *
		 * @author Jason Witt
		 * @since  0.0.1
		 *
		 * @var sting
		 */
		public $plugin_slug = 'wp_cms_settings';

		/**
		 * Get the plugin Settings.
		 *
		 * @author Jason Witt
		 * @since  0.0.1
		 *
		 * @var array
		 */
		public $get_settings;

		/**
		 * Singleton instance of plugin.
		 *
		 * @var   WP_CMS_Settings
		 * @since 0.0.1
		 */
		protected static $single_instance = null;

		/**
		 * Creates or returns an instance of this class.
		 *
		 * @author Jason Witt
		 * @since  0.0.1
		 *
		 * @return A single instance of this class.
		 */
		public static function get_instance() {
			if ( null === self::$single_instance ) {
				self::$single_instance = new self();
			}
			return self::$single_instance;
		}

		/**
		 * Initialize the class
		 *
		 * @author Jason Witt
		 * @since  0.0.1
		 *
		 * @return void
		 */
		public function __construct() {
			// Get the settings option.
			$settings = ( is_multisite() ) ? get_site_option( 'wp_cms_settings' ) : get_option( 'wp_cms_settings' );
			// Pass an empty array if option is not set.
			$this->get_settings = ( $settings ) ? $settings : array();
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
			// Load translated strings for plugin.
			load_plugin_textdomain( 'wp-cms-settings', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );

			// Load Template Tags.
			include trailingslashit( plugin_dir_path( __FILE__ ) ) . 'includes/template-tags.php';

			// Instantiate Classes.
			$this->classes();
		}

		/**
		 * Instantiate Classes.
		 *
		 * @author Jason Witt
		 * @since  0.0.1
		 *
		 * @return void
		 */
		public function classes() {
			$option   = ( isset( $this->get_settings['enable_cms_settings'] ) ) ? $this->get_settings['enable_cms_settings'] : 'false';
			$settings = new Classes\Settings;

			// If enable CMS settings is enabled.
			if ( isset( $option ) && 'true' === $option ) {
				$disable_emojis           = new Classes\Disable_Emojis;
				$disable_feeds            = new Classes\Disable_Feeds;
				$disable_meta_links       = new Classes\Disable_Meta_Links;
				$remove_widgets           = new Classes\Remove_Widgets;
				$disable_press_this       = new Classes\Disable_Press_This;
				$remove_cat_tag_converter = new Classes\Remove_Cat_Tag_Converter;
			}
		}

		/**
		 * Activate the plugin.
		 *
		 * @author Jason Witt
		 * @since  0.0.1
		 *
		 * @return void
		 */
		public function _activate() {
			// Deafult Settings.
			$settings = array(
				'enable_cms_settings'           => 'true',
				'disable_emojis'                => 'true',
				'disable_feeds'                 => 'true',
				'disable_wlwmanifest'           => 'true',
				'disable_wp_generator'          => 'true',
				'disable_wp_shortlink'          => 'true',
				'remove_widget_pages'           => 'true',
				'remove_widget_calendar'        => 'true',
				'remove_widget_archives'        => 'true',
				'remove_widget_media_audio'     => 'true',
				'remove_widget_media_image'     => 'true',
				'remove_widget_media_video'     => 'true',
				'remove_widget_meta'            => 'true',
				'remove_widget_search'          => 'true',
				'remove_widget_text'            => 'true',
				'remove_widget_categories'      => 'true',
				'remove_widget_recent_posts'    => 'true',
				'remove_widget_recent_comments' => 'true',
				'remove_widget_rss'             => 'true',
				'remove_widget_tag_cloud'       => 'true',
				'remove_widget_nav_menu'        => 'true',
				'disable_press_this'            => 'true',
				'remove_cat_tag_converter'      => 'true',
			);

			// If is multisite.
			if ( is_multisite() ) {

				// Update site options.
				update_site_option( $this->plugin_slug, $settings );
			} else {

				// Update options.
				update_option( $this->plugin_slug, $settings );
			}

			// Flush Rewrite Rules.
			flush_rewrite_rules();
		}
	}
}

/**
 * Return an instance of the plugin class.
 *
 * @author Jason Witt
 * @since  0.0.1
 *
 * @return Singleton instance of plugin class.
 */
function wp_cms_settings() {
	return WP_CMS_Settings::get_instance();
}
add_action( 'plugins_loaded', array( wp_cms_settings(), 'init' ) );

/**
 * Activation
 */
register_activation_hook( __FILE__, array( wp_cms_settings(), '_activate' ) );
