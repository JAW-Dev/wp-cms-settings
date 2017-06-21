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
	<th style="padding: 0 10px 0">
		<h2><?php echo esc_html( __( 'Front End Features', 'wp-cms-settings' ) ); ?></h2>
	</th>
</tr>
<?php
// Disable emojis.
echo wp_kses( wpcmss_create_checkbox(
		'disable_emojis',
		__( 'Disable Emojis', 'wp-cms-settings' ),
		$this->plugin_slug,
		$this->settings
	),
	$this->allowed_tags
);
