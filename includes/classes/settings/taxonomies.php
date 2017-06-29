<?php
/**
 * Taxonomies Settings
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
		<h2><?php echo esc_html( __( 'Taxonomies', 'wp-cms-settings' ) ); ?></h2>
	</th>
</tr>
<?php
// Disable catagory field.
echo wp_kses_post( wpcmss_create_checkbox( array(
		'option' => 'disable_categories',
		'label'  => __( 'Categories', 'wp-cms-settings' ),
		'description' => __( 'Disable the Category taxonomy', 'wp-cms-settings' ),
	) )
);
// Disable tags field.
echo wp_kses_post( wpcmss_create_checkbox( array(
		'option' => 'disable_post_tag',
		'label'  => __( 'Tags', 'wp-cms-settings' ),
		'description' => __( 'Disable the Tags taxonomy', 'wp-cms-settings' ),
	) )
);
