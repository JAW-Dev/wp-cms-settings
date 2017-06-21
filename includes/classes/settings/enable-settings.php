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
$allowed_tags = array(
	'tr'    => array(),
	'th'    => array(),
	'td'    => array(),
	'input' => array(
		'type'    => array(),
		'name'    => array(),
		'checked' => array(),
		'value'   => array(),
	),
);

// Enable CMS Settings field.
echo wp_kses( wpcmss_create_checkbox(
		'enable_cms_settings',
		__( 'Enable CMS Settings', 'wp-cms-settings' ),
		$this->plugin_slug,
		$this->settings
	),
	$allowed_tags
);
