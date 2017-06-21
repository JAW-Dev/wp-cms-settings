<?php
/**
 * Template Tags
 *
 * @package    WP_CMS_Settings
 * @subpackage WP_CMS_Settings/Includes/Classes/Settings
 * @author     Jason Witt <contact@jawittdesigns.com>
 * @copyright  Copyright (c) 2017, Jason Witt
 * @license    GNU General Public License v2 or later
 * @version    0.0.1
 */

if ( ! function_exists( 'wpcmss_create_checkbox' ) ) {
	/**
	 * Create checkbox for settings.
	 *
	 * @author Jason Witt
	 * @since  0.0.1
	 *
	 * @param string $option      The name for the field.
	 * @param string $label       The label for the field.
	 * @param string $plugin_slug The plugin slug.
	 * @param array  $settings    The plugin settings.
	 *
	 * @return void
	 */
	function wpcmss_create_checkbox( $option, $label, $plugin_slug, $settings ) {
		$name    = "{$plugin_slug}[{$option}]";
		$checked = ( isset( $settings['enable_cms_settings'] ) ) ? $settings['enable_cms_settings'] : '';
		?>
		<tr>
			<th><?php echo esc_html( $label ); ?></th>
			<td><input type="checkbox" name="<?php echo esc_attr( $name ); ?>" <?php checked( $checked, 1 ); ?> value="1" /></td>
		</tr>
		<?php
	}
}
