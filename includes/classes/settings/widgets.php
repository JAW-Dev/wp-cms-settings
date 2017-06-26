<?php
/**
 * Widgets
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
		<h2><?php echo esc_html( __( 'Core Widgets', 'wp-cms-settings' ) ); ?></h2>
	</th>
</tr>
<?php
// Disable WP_Widget_Pages.
echo wp_kses_post( wpcmss_create_checkbox( array(
		'option' => 'remove_widget_pages',
		'label'  => __( 'Remove Pages Widget', 'wp-cms-settings' ),
		'description' => __( 'Remove the Pages from the widgets list', 'wp-cms-settings' ),
	) )
);
// Disable WP_Widget_Calendar.
echo wp_kses_post( wpcmss_create_checkbox( array(
		'option' => 'remove_widget_calendar',
		'label'  => __( 'Remove Calendar Widget', 'wp-cms-settings' ),
		'description' => __( 'Remove the Calendar from the widgets list', 'wp-cms-settings' ),
	) )
);
// Disable WP_Widget_Archives.
echo wp_kses_post( wpcmss_create_checkbox( array(
		'option' => 'remove_widget_archives',
		'label'  => __( 'Remove Archives Widget', 'wp-cms-settings' ),
		'description' => __( 'Remove the Archives from the widgets list', 'wp-cms-settings' ),
	) )
);
// Disable WP_Widget_Media_Audio.
echo wp_kses_post( wpcmss_create_checkbox( array(
		'option' => 'remove_widget_media_audio',
		'label'  => __( 'Remove Media Audio Widget', 'wp-cms-settings' ),
		'description' => __( 'Remove the Media Audio from the widgets list', 'wp-cms-settings' ),
	) )
);
// Disable WP_Widget_Media_Image.
echo wp_kses_post( wpcmss_create_checkbox( array(
		'option' => 'remove_widget_media_image',
		'label'  => __( 'Remove Media Image Widget', 'wp-cms-settings' ),
		'description' => __( 'Remove the Media Image from the widgets list', 'wp-cms-settings' ),
	) )
);
// Disable WP_Widget_Media_Video.
echo wp_kses_post( wpcmss_create_checkbox( array(
		'option' => 'remove_widget_media_video',
		'label'  => __( 'Remove Media Video Widget', 'wp-cms-settings' ),
		'description' => __( 'Remove the Media Video from the widgets list', 'wp-cms-settings' ),
	) )
);
// Disable WP_Widget_Meta.
echo wp_kses_post( wpcmss_create_checkbox( array(
		'option' => 'remove_widget_meta',
		'label'  => __( 'Remove Meta Widget', 'wp-cms-settings' ),
		'description' => __( 'Remove the Meta from the widgets list', 'wp-cms-settings' ),
	) )
);
// Disable WP_Widget_Search.
echo wp_kses_post( wpcmss_create_checkbox( array(
		'option' => 'remove_widget_search',
		'label'  => __( 'Remove Search Widget', 'wp-cms-settings' ),
		'description' => __( 'Remove the Search from the widgets list', 'wp-cms-settings' ),
	) )
);
// Disable WP_Widget_Text.
echo wp_kses_post( wpcmss_create_checkbox( array(
		'option' => 'remove_widget_text',
		'label'  => __( 'Remove Text Widget', 'wp-cms-settings' ),
		'description' => __( 'Remove the Text from the widgets list', 'wp-cms-settings' ),
	) )
);
// Disable WP_Widget_Categories.
echo wp_kses_post( wpcmss_create_checkbox( array(
		'option' => 'remove_widget_categories',
		'label'  => __( 'Remove Categories Widget', 'wp-cms-settings' ),
		'description' => __( 'Remove the Categories from the widgets list', 'wp-cms-settings' ),
	) )
);
// Disable WP_Widget_Recent_Posts.
echo wp_kses_post( wpcmss_create_checkbox( array(
		'option' => 'remove_widget_recent_posts',
		'label'  => __( 'Remove Recent Posts Widget', 'wp-cms-settings' ),
		'description' => __( 'Remove the Recent Posts from the widgets list', 'wp-cms-settings' ),
	) )
);
// Disable WP_Widget_Recent_Comments.
echo wp_kses_post( wpcmss_create_checkbox( array(
		'option' => 'remove_widget_recent_comments',
		'label'  => __( 'Remove Recent Comments Widget', 'wp-cms-settings' ),
		'description' => __( 'Remove the Recent Comments from the widgets list', 'wp-cms-settings' ),
	) )
);
// Disable WP_Widget_RSS.
echo wp_kses_post( wpcmss_create_checkbox( array(
		'option' => 'remove_widget_rss',
		'label'  => __( 'Remove RSS Widget', 'wp-cms-settings' ),
		'description' => __( 'Remove the RSS from the widgets list', 'wp-cms-settings' ),
	) )
);
// Disable WP_Widget_Tag_Cloud.
echo wp_kses_post( wpcmss_create_checkbox( array(
		'option' => 'remove_widget_tag_cloud',
		'label'  => __( 'Remove Tag Cloud Widget', 'wp-cms-settings' ),
		'description' => __( 'Remove the Tag Cloud from the widgets list', 'wp-cms-settings' ),
	) )
);
// Disable WP_Nav_Menu_Widget.
echo wp_kses_post( wpcmss_create_checkbox( array(
		'option' => 'remove_widget_nav_menu',
		'label'  => __( 'Remove Nav Menu Widget', 'wp-cms-settings' ),
		'description' => __( 'Remove the Nav Menu from the widgets list', 'wp-cms-settings' ),
	) )
);
