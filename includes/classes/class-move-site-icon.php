<?php
/**
 * Move site icon.
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

if ( ! class_exists( 'Move_Site_Icon' ) ) {

	/**
	 * Move site icon.
	 *
	 * @author Jason Witt
	 * @since  0.0.1
	 */
	class Move_Site_Icon {

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
		 * Debug.
		 *
		 * @author Jason Witt
		 * @since  0.0.1
		 *
		 * @var boolean
		 */
		protected $debug;

		/**
		 * Minified file.
		 *
		 * @author Jason Witt
		 * @since  0.0.1
		 *
		 * @var string
		 */
		protected $min;

		/**
		 * Plugin data.
		 *
		 * @author Jason Witt
		 * @since  0.0.1
		 *
		 * @var array
		 */
		protected $plugin_data;

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
			$this->settings    = Root\wp_cms_settings()->get_settings;
			$this->debug       = ( defined( 'SCRIPT_DEBUG' ) && true === SCRIPT_DEBUG ) ? true : false;
			$this->min         = ( ! $this->debug ) ? '.min' : '';
			$this->plugin_data = get_plugin_data( trailingslashit( dirname( plugin_dir_path( __DIR__ ) ) ) . 'wp-cms-settings.php' );

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
				add_action( 'admin_init' , array( $this, 'register_fields' ) );
				add_action( 'current_screen', array( $this, 'current_screen' ) );
			}
		}

		/**
		 * Register fields.
		 *
		 * @author Jason Witt
		 * @since  0.0.1
		 *
		 * @return void
		 */
		public function register_fields() {
			register_setting( 'general', 'site_icon', 'esc_attr' );
			add_settings_field(
				'site_icon',
				'<label for="site-icon">' . __( 'Site Icon' , '' ) . '</label>',
				array( $this, 'fields' ),
				'general'
			);
		}

		/**
		 * Fields.
		 *
		 * @author Jason Witt
		 * @since  0.0.1
		 *
		 * @return void
		 */
		public function fields() {
			$option       = get_option( 'site_icon', '' );
			$has_icon     = ( '0' !== $option && isset( $option ) ) ? true : false;
			$allowed_tags = wp_kses_allowed_html( 'post' );
			$preview_show = ( $has_icon ) ? ' show-preview' : ' show-preview no-show-preview';

			$allowed_tags['input'] = array(
				'id'    => true,
				'name'  => true,
				'type'  => true,
				'value' => true,
			);

			echo '<div id="attachment-media-view" class="attachment-media-view' . esc_attr( $preview_show ) . '">' . wp_kses( $this->render_fields( $option, $has_icon ), $allowed_tags ) . '</div>';
		}

		/**
		 * Render fields.
		 *
		 * @author Jason Witt
		 * @since  0.0.1
		 *
		 * @param array   $option   The option value.
		 * @param boolean $has_icon True if the site icon is set.
		 *
		 * @return html
		 */
		public function render_fields( $option, $has_icon ) {
			$image = wp_get_attachment_image_src( $option );

			if ( $has_icon ) {
				$field_value = $option;
				$upload_text = __( 'Change Image', 'textdomain' );
			} else {
				$field_value = 0;
				$upload_text = __( 'Select Image', 'textdomain' );
			}

			ob_start();
			?>
			<div id="site-icon-preview" class="site-icon-preview">
				<div class="wp-clearfix">
					<div class="favicon-preview">
						<img src="<?php echo esc_attr( home_url() ); ?>/wp-admin/images/browser.png" width="182" alt="">
						<div class="favicon">
							<img id="browser-preview" class="browser-preview" src="<?php echo esc_attr( $image[0] ); ?>" alt="' . esc_attr( 'Preview as an app icon' ) . '" />
						</div>
						<span class="browser-title" aria-hidden="true"><?php echo esc_html( get_bloginfo( 'name' ) ); ?></span>
					</div>
					<img id="app-icon-preview" class="app-icon-preview" src="<?php echo esc_attr( $image[0] ); ?>" alt="' . esc_attr( 'Preview as an app icon' ) . '" />
				</div>
			</div>
			<div id="site-icon-placeholder" class="site-icon-placeholder">
				<div class="wp-clearfix">
					<div class="favicon-preview">
						<div class="placeholder">No image selected</div>
					</div>
				</div>
			</div>
			<div class="controls-wrap">
				<input type="hidden" name="site_icon" id="site_icon" value="<?php echo esc_attr( $field_value ); ?>" />
				<button type="button" id="remove-button" class="button remove-button">Remove</button>
				<button type="button" id="upload-button" class="button upload-button"><?php echo esc_html( $upload_text ); ?></button>
			</div>
			<?php
			return ob_get_clean();
		}

		/**
		 * Current Screen.
		 *
		 * @author Jason Witt
		 * @since  0.0.1
		 *
		 * @return void
		 */
		public function current_screen() {
			$screen = get_current_screen();

			// If on genral setting page.
			if ( 'options-general' === $screen->id ) {
				add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_scripts' ) );
				add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_styles' ) );
			}
		}

		/**
		 * File Version.
		 *
		 * @author Jason Witt
		 * @since  0.0.1
		 *
		 * @param string $file           The file to enqueue.
		 * @param int    $custom_version The custom stylesheet version.
		 *
		 * @return int
		 */
		public function file_version( $file, $custom_version = '' ) {

			// Bail if file is not set.
			if ( ! $file ) {
				return '0.0.1';
			}

			// If custom version is set return it.
			if ( $custom_version ) {
				return $custom_version;
			}

			$cache_buster   = filemtime( trailingslashit( dirname( plugin_dir_path( __DIR__ ) ) ) . trailingslashit( 'assets' ) . $file );
			$plugin_version = $this->plugin_data['Version'];
			$version        = ( defined( 'WP_DEBUG' ) && true === WP_DEBUG ) ? $cache_buster : $plugin_version;

			return $version;
		}

		/**
		 * Enqueue scripts.
		 *
		 * @author Jason Witt
		 * @since  0.0.1
		 *
		 * @return void
		 */
		public function enqueue_scripts() {
			wp_enqueue_media();
			$file = 'scripts/index' . $this->min . '.js';
			$name = strtolower( str_replace( ' ', '-', $this->plugin_data['Name'] ) );
			wp_enqueue_script(
				"{$name}-scripts",
				trailingslashit( dirname( plugin_dir_url( __DIR__ ) ) ) . trailingslashit( 'assets' ) . $file,
				array(),
				$this->file_version( $file ),
				true
			);
		}

		/**
		 * Enqueue styles.
		 *
		 * @author Jason Witt
		 * @since  0.0.1
		 *
		 * @return void
		 */
		public function enqueue_styles() {
			$file = 'styles/style' . $this->min . '.css';
			$name = strtolower( str_replace( ' ', '-', $this->plugin_data['Name'] ) );
			wp_enqueue_style( "{$name}-styles",
			trailingslashit(
				dirname( plugin_dir_url( __DIR__ ) ) ) . trailingslashit( 'assets' ) . $file,
				array(),
				$this->file_version( $file )
			);
		}
	}
}
