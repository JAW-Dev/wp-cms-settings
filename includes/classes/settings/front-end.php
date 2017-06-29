<?php
/**
 * Front End
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
		<h2><?php echo esc_html( __( 'Front End Features', 'wp-cms-settings' ) ); ?></h2>
	</th>
</tr>
<?php
// Disable emojis.
echo wp_kses_post( wpcmss_create_checkbox( array(
		'option' => 'disable_emojis',
		'label'  => __( 'Emojis', 'wp-cms-settings' ),
		'description' => __( 'Remove the Emojis CSS and JavaScript', 'wp-cms-settings' ),
	) )
);
// Disable Feed Links.
echo wp_kses_post( wpcmss_create_checkbox( array(
		'option' => 'disable_feeds',
		'label'  => __( 'RSS and Atom Feeds', 'wp-cms-settings' ),
		'description' => __( 'Disable RSS and Atom feed links', 'wp-cms-settings' ),
	) )
);
// Disable wlwmanifest.
echo wp_kses_post( wpcmss_create_checkbox( array(
		'option' => 'disable_wlwmanifest',
		'label'  => __( 'wlwmanifest', 'wp-cms-settings' ),
		'description' => __( 'Disable the wlwmanifest meta link', 'wp-cms-settings' ),
	) )
);
// Disable wp_generator.
echo wp_kses_post( wpcmss_create_checkbox( array(
		'option' => 'disable_wp_generator',
		'label'  => __( 'WP Generator', 'wp-cms-settings' ),
		'description' => __( 'Disable the WP Generator meta link', 'wp-cms-settings' ),
	) )
);
// Disable wp_shortlink.
echo wp_kses_post( wpcmss_create_checkbox( array(
		'option' => 'disable_wp_shortlink',
		'label'  => __( 'WP Shortlink', 'wp-cms-settings' ),
		'description' => __( 'Disable the WP Shortlink meta link', 'wp-cms-settings' ),
	) )
);
