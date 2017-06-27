<?php
/**
 * Admin
 *
 * Load: true
 *
 * @package    WP_CMS_Settings
 * @subpackage WP_CMS_Settings/Includes/Classes/Settings
 * @author     Jason Witt <contact@jawittdesigns.com>
 * @copyright  Copyright (c) 2017, Jason Witt
 * @license    GNU General Public License v2 or later
 * @version    0.0.1
 */
?>
<tr>
	<th>
		<h2><?php echo esc_html( __( 'Admin Features', 'wp-cms-settings' ) ); ?></h2>
	</th>
</tr>
<?php
// Disable Press This.
echo wp_kses_post( wpcmss_create_checkbox( array(
		'option' => 'disable_press_this',
		'label'  => __( 'Disable Press This', 'wp-cms-settings' ),
		'description' => __( 'Disable the Press This Functionality', 'wp-cms-settings' ),
	) )
);
// Disable Press This.
echo wp_kses_post( wpcmss_create_checkbox( array(
		'option' => 'remove_cat_tag_converter',
		'label'  => __( 'Remove Categories and Tag Converter', 'wp-cms-settings' ),
		'description' => __( 'Remove Categories and Tag Converter from the Tools', 'wp-cms-settings' ),
	) )
);
// Remove Right Now Dasboard widget.
echo wp_kses_post( wpcmss_create_checkbox( array(
		'option' => 'remove_dashboard_right_now',
		'label'  => __( 'Remove Right Now Widget', 'wp-cms-settings' ),
		'description' => __( 'Remove the Right Now dasboard widget', 'wp-cms-settings' ),
	) )
);
// Remove Activity dasboard widget.
echo wp_kses_post( wpcmss_create_checkbox( array(
		'option' => 'remove_dashboard_activity',
		'label'  => __( 'Remove Activity Widget', 'wp-cms-settings' ),
		'description' => __( 'Remove the Activity dasboard widget', 'wp-cms-settings' ),
	) )
);
// Remove Quick Press dasboard widget.
echo wp_kses_post( wpcmss_create_checkbox( array(
		'option' => 'remove_dashboard_quick_press',
		'label'  => __( 'Remove Quick Press Widget', 'wp-cms-settings' ),
		'description' => __( 'Remove the Quick Press dasboard widget', 'wp-cms-settings' ),
	) )
);
// Remove Primary dasboard widget.
echo wp_kses_post( wpcmss_create_checkbox( array(
		'option' => 'remove_dashboard_primary',
		'label'  => __( 'Remove Primary Widget', 'wp-cms-settings' ),
		'description' => __( 'Remove the Primary dasboard widget', 'wp-cms-settings' ),
	) )
);
