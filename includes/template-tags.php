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
	 * @param array $args {
	 *     The arguments.
	 *
	 *     @type string $option      The name for the field.
	 *     @type string $label       The label for the field.
	 *     @type string $description The description for the field.
	 *     @type string $plugin_slug The plugin slug.
	 *     @type array  $settings    The plugin settings.
	 * }
	 *
	 * @return void
	 */
	function wpcmss_create_checkbox( $args = array() ) {

		// Defaults.
		$defaults = array(
			'option'      => '',
			'label'       => '',
			'description' => '',
			'plugin_slug' => \WP_CMS_Settings\wp_cms_settings()->plugin_slug,
			'settings'    => \WP_CMS_Settings\wp_cms_settings()->get_settings,
		);

		// The arguments.
		$args = wp_parse_args( $args, $defaults );

		$name    = "{$args['plugin_slug']}[{$args['option']}]";
		$checked = ( isset( $args['settings'][ $args['option'] ] ) ) ? $args['settings'][ $args['option'] ] : '';
		?>
		<tr class="wpcmss__field <?php echo esc_attr( $args['option'] ); ?>">
			<th class='field__heading' scope="row">
				<?php echo esc_html( $args['label'] ); ?>
			</th>
			<td class='field__fields'>
				<fieldset>
					<legend class="screen-reader-text">
						<span><?php echo esc_html( $args['label'] ); ?></span>
					</legend>
					<label for="<?php echo esc_attr( $name ); ?>">
						<input type="hidden" name="<?php echo esc_attr( $name ); ?>" value="false" />
						<input type="checkbox" name="<?php echo esc_attr( $name ); ?>" <?php checked( $checked, 'true' ); ?> id="<?php echo esc_attr( $args['option'] ); ?>" value="true" />
						<?php if ( isset( $args['description'] ) ) : ?>
							<span class='field__description'><?php echo esc_html( $args['description'] ); ?></span>
						<?php endif; ?>
					</label>
				</fieldset>
			</td>
		</tr>
		<?php
	}
}
