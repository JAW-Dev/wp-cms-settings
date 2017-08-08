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
		'label'  => __( 'Pages Widget', 'wp-cms-settings' ),
		'description' => __( 'Remove Pages from the widgets list', 'wp-cms-settings' ),
	) )
);
// Disable WP_Widget_Calendar.
echo wp_kses_post( wpcmss_create_checkbox( array(
		'option' => 'remove_widget_calendar',
		'label'  => __( 'Calendar Widget', 'wp-cms-settings' ),
		'description' => __( 'Remove Calendar from the widgets list', 'wp-cms-settings' ),
	) )
);
// Disable WP_Widget_Archives.
echo wp_kses_post( wpcmss_create_checkbox( array(
		'option' => 'remove_widget_archives',
		'label'  => __( 'Archives Widget', 'wp-cms-settings' ),
		'description' => __( 'Remove Archives from the widgets list', 'wp-cms-settings' ),
	) )
);
// Disable WP_Widget_Media_Audio.
echo wp_kses_post( wpcmss_create_checkbox( array(
		'option' => 'remove_widget_media_audio',
		'label'  => __( 'Media Audio Widget', 'wp-cms-settings' ),
		'description' => __( 'Remove Media Audio from the widgets list', 'wp-cms-settings' ),
	) )
);
// Disable WP_Widget_Media_Image.
echo wp_kses_post( wpcmss_create_checkbox( array(
		'option' => 'remove_widget_media_image',
		'label'  => __( 'Media Image Widget', 'wp-cms-settings' ),
		'description' => __( 'Remove Media Image from the widgets list', 'wp-cms-settings' ),
	) )
);
// Disable WP_Widget_Media_Video.
echo wp_kses_post( wpcmss_create_checkbox( array(
		'option' => 'remove_widget_media_video',
		'label'  => __( 'Media Video Widget', 'wp-cms-settings' ),
		'description' => __( 'Remove Media Video from the widgets list', 'wp-cms-settings' ),
	) )
);
// Disable WP_Widget_Meta.
echo wp_kses_post( wpcmss_create_checkbox( array(
		'option' => 'remove_widget_meta',
		'label'  => __( 'Meta Widget', 'wp-cms-settings' ),
		'description' => __( 'Remove Meta from the widgets list', 'wp-cms-settings' ),
	) )
);
// Disable WP_Widget_Search.
echo wp_kses_post( wpcmss_create_checkbox( array(
		'option' => 'remove_widget_search',
		'label'  => __( 'Search Widget', 'wp-cms-settings' ),
		'description' => __( 'Remove Search from the widgets list', 'wp-cms-settings' ),
	) )
);
// Disable WP_Widget_Text.
echo wp_kses_post( wpcmss_create_checkbox( array(
		'option' => 'remove_widget_text',
		'label'  => __( 'Text Widget', 'wp-cms-settings' ),
		'description' => __( 'Remove Text from the widgets list', 'wp-cms-settings' ),
	) )
);
// Disable WP_Widget_Categories.
echo wp_kses_post( wpcmss_create_checkbox( array(
		'option' => 'remove_widget_categories',
		'label'  => __( 'Categories Widget', 'wp-cms-settings' ),
		'description' => __( 'Remove Categories from the widgets list', 'wp-cms-settings' ),
	) )
);
// Disable WP_Widget_Recent_Posts.
echo wp_kses_post( wpcmss_create_checkbox( array(
		'option' => 'remove_widget_recent_posts',
		'label'  => __( 'Recent Posts Widget', 'wp-cms-settings' ),
		'description' => __( 'Remove Recent Posts from the widgets list', 'wp-cms-settings' ),
	) )
);
// Disable WP_Widget_Recent_Comments.
echo wp_kses_post( wpcmss_create_checkbox( array(
		'option' => 'remove_widget_recent_comments',
		'label'  => __( 'Recent Comments Widget', 'wp-cms-settings' ),
		'description' => __( 'Remove Recent Comments from the widgets list', 'wp-cms-settings' ),
	) )
);
// Disable WP_Widget_RSS.
echo wp_kses_post( wpcmss_create_checkbox( array(
		'option' => 'remove_widget_rss',
		'label'  => __( 'RSS Widget', 'wp-cms-settings' ),
		'description' => __( 'Remove RSS from the widgets list', 'wp-cms-settings' ),
	) )
);
// Disable WP_Widget_Tag_Cloud.
echo wp_kses_post( wpcmss_create_checkbox( array(
		'option' => 'remove_widget_tag_cloud',
		'label'  => __( 'Tag Cloud Widget', 'wp-cms-settings' ),
		'description' => __( 'Remove Tag Cloud from the widgets list', 'wp-cms-settings' ),
	) )
);
// Disable WP_Nav_Menu_Widget.
echo wp_kses_post( wpcmss_create_checkbox( array(
		'option' => 'remove_nav_menu_widget',
		'label'  => __( 'Nav Menu Widget', 'wp-cms-settings' ),
		'description' => __( 'Remove Nav Menu from the widgets list', 'wp-cms-settings' ),
	) )
);
// Disable WP_Custom_HTML_Widget.
echo wp_kses_post( wpcmss_create_checkbox( array(
		'option' => 'remove_widget_custom_html',
		'label'  => __( 'Custom HTML Widget', 'wp-cms-settings' ),
		'description' => __( 'Remove Custom HTML from the widgets list', 'wp-cms-settings' ),
	) )
);
