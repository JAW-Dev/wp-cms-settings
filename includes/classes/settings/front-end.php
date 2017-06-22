<?php
/**
 * Front End
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
		'label'  => __( 'Disable Emojis', 'wp-cms-settings' ),
		'description' => __( 'Remove the Emojis CSS and JavaScript', 'wp-cms-settings' ),
	) )
);
