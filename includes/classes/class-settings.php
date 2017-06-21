<?php
/**
 * Settings
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

if ( ! class_exists( 'Settings' ) ) {

	/**
	 * Name
	 *
	 * @author Jason Witt
	 * @since  0.0.1
	 */
	class Settings {

		/**
		 * Plugin Slug.
		 *
		 * @author Jason Witt
		 * @since  0.0.1
		 *
		 * @var string
		 */
		protected $plugin_slug;

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
		 * Active Tab.
		 *
		 * @author Jason Witt
		 * @since  0.0.1
		 *
		 * @var string
		 */
		protected $active_tab;

		/**
		 * Initialize the class
		 *
		 * @author Jason Witt
		 * @since  0.0.1
		 *
		 * @return void
		 */
		public function __construct() {
			// Only run if on the admin dashboard.
			if ( is_admin() ) {
				$this->init();
			}

			// Set the properties.
			$this->plugin_slug = Root\wp_cms_settings()->plugin_slug;
			$this->settings    = Root\wp_cms_settings()->get_settings;
			$this->active_tab  = ( isset( $_GET['tab'] ) ) ? sanitize_text_field( $_GET['tab'] ) : 'allowed-roles';

			// Get the field views.
			$this->fields = ( is_array( $this->include_fields() ) ) ? $this->include_fields() : array();
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
			add_action( is_multisite() ? 'network_admin_menu' : 'admin_menu',  array( $this, 'settings_page' ) );
			add_action( 'init', array( $this, 'save' ) );
			add_action( is_multisite() ? 'network_admin_notices' : 'admin_notices',  array( $this, 'admin_notice' ) );
		}

		/**
		 * Settings Page.
		 *
		 * @author Jason Witt
		 * @since  0.0.1
		 *
		 * @return void
		 */
		public function settings_page() {
			$page = ( is_multisite() ) ? 'settings.php' : 'options-general.php';
			add_submenu_page(
				$page,
				__( 'CMS Settings', 'wp-cms-settings' ),
				__( 'CMS Settings', 'wp-cms-settings' ),
				'manage_options',
				$this->plugin_slug,
				array( $this, 'render_settings_page' )
			);
		}

		/**
		 * Render Settings Page.
		 *
		 * @author Jason Witt
		 * @since  0.0.1
		 *
		 * @return void
		 */
		public function render_settings_page() {
			$action = ( is_multisite() ) ? 'edit.php?action=' . $this->plugin_slug : 'options-general.php';
			?>
			<div class="wrap">
				<form action="<?php echo esc_attr( $action ); ?>" method="post" />
				<?php settings_errors(); ?>
				<form method="post" />
					<input type="hidden" name="action" value="update_<?php echo esc_attr( $this->plugin_slug ); ?>" />
					<?php wp_nonce_field( $this->plugin_slug . '_nonce', $this->plugin_slug . '_nonce' ); ?>
					<h1><?php echo esc_html( get_admin_page_title() );?></h1>
					<h2 class="nav-tab-wrapper">
						<a href="?page=<?php echo esc_html( $this->plugin_slug ); ?>&tab=allowed-roles" class="nav-tab<?php echo esc_attr( $this->get_active_tab( 'allowed-roles' ) ); ?>">General</a>
						<!-- <a href="?page=pro_dev_tools&tab=environment" class="nav-tab<?php echo esc_attr( $this->get_active_tab( 'environment' ) ); ?>">Environment</a> -->
					</h2>
					<table class="form-table">
						<tbody>
							<?php
							if ( ! empty( $this->fields ) ) {
								switch ( $this->active_tab ) {
									case 'enable-settings':
									default:
										include $this->fields['enable-settings'];
									break;
								}
							}
							?>
							<tr><td><?php submit_button(); ?></td></tr>
						</tbody>
					</table>
				</form>
			</div>
			<?php
		}

		/**
		 * Save.
		 *
		 * @author Jason Witt
		 * @since  0.0.1
		 *
		 * @return void
		 */
		public function save() {

			// Only run if form is saved.
			if ( ! isset( $_POST['submit'] ) ) {
				return;
			}

			// The form nonce.
			$nonce = $this->plugin_slug . '_nonce';

			// Bail if nonce is not verified.
			if ( ! isset( $_POST[ $nonce ] ) || ! wp_verify_nonce( $_POST[ $nonce ], $nonce ) ) {
				return;
			}

			// The post data.
			$post_set = ( isset( $_POST[ $this->plugin_slug ] ) || ! empty( $_POST[ $this->plugin_slug ] ) );
			$settings = ( $post_set ) ? $this->sanitize( $_POST[ $this->plugin_slug ] ) : array();

			$this->checkbox_values( $settings );

			if ( isset( $settings ) ) {
				if ( is_multisite() ) {

					// Update site options.
					update_site_option( $this->plugin_slug, $settings );
				} else {

					// Update options.
					update_option( $this->plugin_slug, $settings );
				}
			}

			// Redirect after save.
			$this->redirect_after_save();
		}

		/**
		 * Admin notice.
		 *
		 * @author Jason Witt
		 * @since  0.0.1
		 *
		 * @return void
		 */
		public function admin_notice() {
			if ( isset( $_GET['saved'] ) ) {
				?>
				<div class="notice notice-success is-dismissible">
					<p><strong>Settings saved.</strong></p>
				</div>
				<?php
			}
		}

		/**
		 * Include Field Views.
		 *
		 * @author Jason Witt
		 * @since  0.0.1
		 *
		 * @return array $fields An array of field views.
		 */
		private function include_fields() {
			$fields = array();
			foreach ( glob( trailingslashit( dirname( __FILE__ ) ) . 'settings/*.php' ) as $file ) {
				if ( file_exists( $file ) ) {
					$name = str_replace( '.php', '', basename( $file ) );
					$fields[ $name ] = $file;
				}
			}
			return $fields;
		}

		/**
		 * Get Active Tab.
		 *
		 * @author Jason Witt
		 * @since  0.0.1
		 *
		 * @param string $slug The tabd slug.
		 *
		 * @return string $class The class to add to the active tab.
		 */
		private function get_active_tab( $slug ) {
			$class = ( $slug === $this->active_tab ) ? ' nav-tab-active' : '';
			return $class;
		}

		/**
		 * Checkbox Values.
		 *
		 * @author Jason Witt
		 * @since  0.0.1
		 *
		 * @param array $settings The array of settings.
		 *
		 * @return array $settings The array of setting with the correct checkbox values.
		 */
		private function checkbox_values( $settings ) {

			// Bail if settings is not set or empty.
			if ( ! isset( $_POST[ $this->plugin_slug ] ) || empty( $_POST[ $this->plugin_slug ] ) ) {
				return;
			}

			// The checkboxes.
			$checkboxes = array(
				'enable_cms_settings',
			);

			// Ensure the checkboxes get the correct value.
			foreach ( $checkboxes as $checkbox ) {
				if ( ! isset( $settings[ $checkbox ] ) ) {
					$settings[ $checkbox ] = 0;
				}
			}

			return $settings;
		}

		/**
		 * Sanitize.
		 *
		 * @author Jason Witt
		 * @since  0.0.1
		 *
		 * @param array $input The data to input.
		 *
		 * @return array $output The array of sanitized data.
		 */
		private function sanitize( $input ) {

			$output = array();

			// Loop though the post data.
			foreach ( $input as $key => $value ) {

				if ( is_array( $value ) ) {

					// Loop though data if multidimensional array.
					$this->sanitize( $value );
				}

				// Strip out any HTML or JS tags or slashes.
				$output[ $key ] = ( ! is_array( $value ) ) ? sanitize_text_field( $value ) : $value;
			}
			// Filter.
			return apply_filters( "{$this->plugin_slug}_settings_sanitized_data", $output, $input );
		}

		/**
		 * Redirect After Save.
		 *
		 * @author Jason Witt
		 * @since  0.0.1
		 *
		 * @return void
		 */
		private function redirect_after_save() {

			// Get the current url.
			$current_url = strtok( ( isset( $_SERVER['HTTPS'] ) ? 'https' : 'http' ) . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]", '?' );

			// Redirect after save.
			wp_safe_redirect( $current_url . "?page={$this->plugin_slug}&saved=true" );
			exit;
		}
	}
}
