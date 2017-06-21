<?php
/**
 * Enable Settings
 *
 * @package    WP_CMS_Settings
 * @subpackage WP_CMS_Settings/Includes/Classes/Settings
 * @author     Jason Witt <contact@jawittdesigns.com>
 * @copyright  Copyright (c) 2017, Jason Witt
 * @license    GNU General Public License v2 or later
 * @version    0.0.1
 */

$setting = 'enable_cms_settings';
$name    = "{$this->plugin_slug}[{$setting}]";
$checked = ( isset( $this->settings['enable_cms_settings'] ) ) ? $this->settings['enable_cms_settings'] : '';
?>
<tr>
	<th><?php echo esc_html( __( 'Enable CMS Settings', 'wp-cms-settings' ) ); ?></th>
	<td><input type="checkbox" name="<?php echo esc_attr( $name ); ?>" <?php checked( $checked, 1 ); ?> value="1" /></td>
</tr>
