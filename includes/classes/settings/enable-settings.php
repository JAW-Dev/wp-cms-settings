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

// Enable CMS Settings field.
echo wp_kses( wpcmss_create_checkbox(
		'enable_cms_settings',
		__( 'Enable CMS Settings', 'wp-cms-settings' ),
		$this->plugin_slug,
		$this->settings
	),
	$this->allowed_tags
);
