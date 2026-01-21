<?php
/**
 * A unique identifier is defined to store the options in the database and reference them from the theme.
 * By default it uses the theme name, in lowercase and without spaces, but this can be changed if needed.
 * If the identifier changes, it'll appear as if the options have been reset.
 *
 * @package    TrueNews
 * @author     Theme Junkie
 * @copyright  Copyright (c) 2014, Theme Junkie
 * @license    http://www.gnu.org/licenses/gpl-2.0.html
 * @since      1.0.0
 */

function optionsframework_option_name() {

	// This gets the theme name from the stylesheet
	$themename = wp_get_theme();
	$themename = preg_replace("/\W/", "_", strtolower( $themename ) );

	$optionsframework_settings = get_option( 'optionsframework' );
	$optionsframework_settings['id'] = $themename;
	update_option( 'optionsframework', $optionsframework_settings );

}

/**
 * Defines an array of options that will be used to generate the settings page 
 * and be saved in the database.
 *
 * @since  1.0.0
 * @access public
 */
function optionsframework_options() {

	// Pull all tags into an array.
	$tags = array();
	$tags_obj = get_tags();
	foreach ( $tags_obj as $tag ) {
		$tags[$tag->term_id] = esc_html( $tag->name );
	}

	// Pull all the categories into an array
	$categories = array();
	$categories_obj = get_categories();
	foreach ( $categories_obj as $category ) {
		$categories[$category->cat_ID] = esc_html( $category->cat_name );
	}

	// Background thumbnail path.
	$imgpath =  get_template_directory_uri() . '/assets/img/bg/';

	$options = array();

	$options[] = array(
		'name' => __( 'General', 'truenews' ),
		'type' => 'heading'
	);

	$options[] = array(
		'name' => __( 'Logo Uploader', 'truenews' ),
		'desc' => __( 'Upload your custom logo, it will automatically replace the Site Title', 'truenews' ),
		'id'   => 'truenews_logo',
		'type' => 'upload'
	);

	$options[] = array(
		'name' => __( 'Favicon Uploader', 'truenews' ),
		'desc' => __( 'Upload your custom favicon.', 'truenews' ),
		'id'   => 'truenews_favicon',
		'type' => 'upload'
	);

	$options[] = array(
		'name'  => __( 'FeedBurner URL', 'truenews' ),
		'desc'  => __( 'Enter your full FeedBurner URL. If you wish to use FeedBurner over the standard WordPress feed.', 'truenews' ),
		'id'    => 'truenews_feedburner_url',
		'placeholder' => 'http://feeds.feedburner.com/ThemeJunkie',
		'type'  => 'text'
	);

	$options[] = array(
		'name' => '',
		'desc' => __( 'These setting will appear at the bottom of your site.', 'truenews' ),
		'type' => 'info'
	);

	$options[] = array(
		'name' => __( 'Logo', 'truenews' ),
		'desc' => '',
		'id'   => 'truenews_footer_logo',
		'type' => 'upload'
	);

	$options[] = array(
		'name'  => __( 'Website Summary', 'truenews' ),
		'desc'  => __( 'Please enter your website summary here.', 'truenews' ),
		'id'    => 'truenews_summary',
		'type'  => 'textarea'
	);

	$options[] = array(
		'name' => __( 'Posts', 'truenews' ),
		'type' => 'heading'
	);

	$options[] = array(
		'name' => '',
		'desc' => __( 'The Featured posts will appear on home page.', 'truenews' ),
		'type' => 'info'
	);

	$options[] = array(
		'name' => __( 'Featured Posts', 'truenews' ),
		'desc' => __( 'Enable the Featured Posts area.', 'truenews' ),
		'id'   => 'truenews_featured',
		'std'  => '1',
		'type' => 'checkbox'
	);

	$options[] = array(
		'name'    => __( 'Featured Posts Tag', 'truenews' ),
		'desc'    => __( 'Select a tag to be used as Featured Posts Posts.', 'truenews' ),
		'id'      => 'truenews_featured_tag',
		'type'    => 'select',
		'options' => $tags
	);

	$options[] = array(
		'name' => '',
		'desc' => __( 'The Breaking posts will appear at the top of your site.', 'truenews' ),
		'type' => 'info'
	);

	$options[] = array(
		'name' => __( 'Breaking Posts', 'truenews' ),
		'desc' => __( 'Enable the Breaking Posts area.', 'truenews' ),
		'id'   => 'truenews_breaking',
		'std'  => '1',
		'type' => 'checkbox'
	);

	$options[] = array(
		'name'    => __( 'Breaking Posts Tag', 'truenews' ),
		'desc'    => __( 'Select a tag to be used as Breaking Posts Posts.', 'truenews' ),
		'id'      => 'truenews_breaking_tag',
		'type'    => 'select',
		'options' => $tags
	);

	$options[] = array(
		'name' => '',
		'desc' => __( 'The Editor\'s Picks posts will appear on all pages.', 'truenews' ),
		'type' => 'info'
	);

	$options[] = array(
		'name' => __( 'Editor\'s Picks', 'truenews' ),
		'desc' => __( 'Enable the editor\'s picks area.', 'truenews' ),
		'id'   => 'truenews_editor_picks',
		'std'  => '1',
		'type' => 'checkbox'
	);

	$options[] = array(
		'name'    => __( 'Editor\'s Picks Tag', 'truenews' ),
		'desc'    => __( 'Select a tag to be used as Editor\'s Picks Posts', 'truenews' ),
		'id'      => 'truenews_editor_picks_tag',
		'type'    => 'select',
		'options' => $tags
	);

	$options[] = array(
		'name' => __( 'Single Post', 'truenews' ),
		'type' => 'heading'
	);

	$options[] = array(
		'name' => __( 'Display author info ', 'truenews' ),
		'desc' => __( 'Enable the author biographical info.', 'truenews' ),
		'id'   => 'truenews_post_author',
		'std'  => '1',
		'type' => 'checkbox'
	);

	$options[] = array(
		'name' => __( 'Display share links', 'truenews' ),
		'desc' => __( 'Enable the share links.', 'truenews' ),
		'id'   => 'truenews_post_share',
		'std'  => '1',
		'type' => 'checkbox'
	);

	$options[] = array(
		'name' => __( 'Before Content Advertisement', 'truenews' ),
		'desc' => __( 'Your ad will appear on single post before content.', 'truenews' ),
		'id'   => 'truenews_ad_single_before',
		'type' => 'textarea'
	);

	$options[] = array(
		'name' => __( 'After Content Advertisement', 'truenews' ),
		'desc' => __( 'Your ad will appear on single post after content.', 'truenews' ),
		'id'   => 'truenews_ad_single_after',
		'type' => 'textarea'
	);

	$options[] = array(
		'name' => __( 'Social Links', 'truenews' ),
		'type' => 'heading'
	);

	$options['truenews_enable_social'] = array(
		'name' => __( 'Enable ', 'truenews' ),
		'desc' => __( 'Enable social links', 'truenews' ),
		'id'   => 'truenews_enable_social',
		'std'  => '1',
		'type' => 'checkbox'
	);

	$options['truenews_fb'] = array(
		'name' => __( 'Facebook', 'truenews' ),
		'desc' => __( 'Facebook profile url', 'truenews' ),
		'id'   => 'truenews_fb',
		'placeholder' => 'http://',
		'type' => 'text'
	);

	$options['truenews_tw'] = array(
		'name' => __( 'Twitter', 'truenews' ),
		'desc' => __( 'Twitter profile url', 'truenews' ),
		'id'   => 'truenews_tw',
		'placeholder' => 'http://',
		'type' => 'text'
	);

	$options['truenews_gplus'] = array(
		'name' => __( 'Google Plus', 'truenews' ),
		'desc' => __( 'Google Plus profile url', 'truenews' ),
		'id'   => 'truenews_gplus',
		'placeholder' => 'http://',
		'type' => 'text'
	);

	$options['truenews_pinterest'] = array(
		'name' => __( 'Pinterest', 'truenews' ),
		'desc' => __( 'Pinterest profile url', 'truenews' ),
		'id'   => 'truenews_pinterest',
		'placeholder' => 'http://',
		'type' => 'text'
	);

	$options['truenews_linkedin'] = array(
		'name' => __( 'LinkedIn', 'truenews' ),
		'desc' => __( 'LinkedIn profile url', 'truenews' ),
		'id'   => 'truenews_linkedin',
		'placeholder' => 'http://',
		'type' => 'text'
	);

	$options['truenews_feed'] = array(
		'name' => __( 'RSS Feed', 'truenews' ),
		'desc' => __( 'RSS Feed url', 'truenews' ),
		'id'   => 'truenews_feed',
		'placeholder' => 'http://',
		'type' => 'text'
	);

	$options['truenews_newsletter'] = array(
		'name' => __( 'Newsletter', 'truenews' ),
		'desc' => __( 'Newsletter url', 'truenews' ),
		'id'   => 'truenews_newsletter',
		'placeholder' => 'http://',
		'type' => 'text'
	);

	$options[] = array(
		'name' => __( 'Advertisement', 'truenews' ),
		'type' => 'heading'
	);

	$options[] = array(
		'name' => __( 'Header Advertisement', 'truenews' ),
		'desc' => __( 'Add your ad code to the text box. Recommended size 728x90', 'truenews' ),
		'id'   => 'truenews_header_ads',
		'type' => 'textarea'
	);

	$options[] = array(
		'name' => __( 'Custom Code', 'truenews' ),
		'type' => 'heading'
	);

	$options['truenews_script_head'] = array(
		'name' => __( 'Header code', 'truenews' ),
		'desc' => __( 'If you need to add custom scripts to your header (meta tag verification, google fonts url), you should enter them in the box. They will be added before &lt;/head&gt; tag', 'truenews' ),
		'id'   => 'truenews_script_head',
		'type' => 'textarea'
	);

	$options['truenews_script_footer'] = array(
		'name' => __( 'Footer code', 'truenews' ),
		'desc' => __( 'If you need to add custom scripts to your footer (like google analytic script), you should enter them in the box. They will be added before &lt;/body&gt; tag', 'truenews' ),
		'id'   => 'truenews_script_footer',
		'type' => 'textarea'
	);

	/* Return the theme settings data. */
	return $options;
}