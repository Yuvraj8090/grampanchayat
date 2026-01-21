<?php
/**
 * Custom functions that act independently of the theme templates
 *
 * Eventually, some of the functionality here could be replaced by core features
 *
 * @package    TrueNews
 * @author     Theme Junkie
 * @copyright  Copyright (c) 2014, Theme Junkie
 * @license    http://www.gnu.org/licenses/gpl-2.0.html
 * @since      1.0.0
 */

/**
 * Get our wp_nav_menu() fallback, wp_page_menu(), to show a home link.
 *
 * @since  1.0.0
 * @param  array $args Configuration arguments.
 * @return array
 */
function truenews_page_menu_args( $args ) {
	$args['show_home'] = true;
	return $args;
}
add_filter( 'wp_page_menu_args', 'truenews_page_menu_args' );

/**
 * Adds custom classes to the array of body classes.
 *
 * @since  1.0.0
 * @param  array $classes Classes for the body element.
 * @return array
 */
function truenews_body_classes( $classes ) {

	// Adds a class of group-blog to blogs with more than 1 published author.
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}

	return $classes;
}
add_filter( 'body_class', 'truenews_body_classes' );

/**
 * Adds custom classes to the array of post classes.
 *
 * @since  1.0.0
 * @param  array $classes Classes for the post element.
 * @return array
 */
function truenews_post_classes( $classes ) {

	// Adds a class if a post hasn't a thumbnail.
	if ( ! has_post_thumbnail() ) {
		$classes[] = 'no-post-thumbnail';
	}

	// Adds custom clearfix class
	$classes[] = 'clearfix';

	return $classes;
}
add_filter( 'post_class', 'truenews_post_classes' );

/**
 * Adds custom classes to the array of comment classes.
 *
 * @since  1.0.0
 * @param  array $classes Classes for the comment element.
 * @return array
 */
function truenews_comment_classes( $classes ) {
	// Adds custom clearfix class
	$classes[] = 'clearfix';

	return $classes;
}
add_filter( 'comment_class', 'truenews_comment_classes' );

if ( version_compare( $GLOBALS['wp_version'], '4.1', '<' ) ) :
	/**
	 * Filters wp_title to print a neat <title> tag based on what is being viewed.
	 *
	 * @param string $title Default title text for current view.
	 * @param string $sep Optional separator.
	 * @return string The filtered title.
	 */
	function truenews_wp_title( $title, $sep ) {
		if ( is_feed() ) {
			return $title;
		}

		global $page, $paged;

		// Add the blog name
		$title .= get_bloginfo( 'name', 'display' );

		// Add the blog description for the home/front page.
		$site_description = get_bloginfo( 'description', 'display' );
		if ( $site_description && ( is_home() || is_front_page() ) ) {
			$title .= " $sep $site_description";
		}

		// Add a page number if necessary:
		if ( ( $paged >= 2 || $page >= 2 ) && ! is_404() ) {
			$title .= " $sep " . sprintf( __( 'Page %s', 'truenews' ), max( $paged, $page ) );
		}

		return $title;
	}
	add_filter( 'wp_title', 'truenews_wp_title', 10, 2 );

	/**
	 * Title shim for sites older than WordPress 4.1.
	 *
	 * @link https://make.wordpress.org/core/2014/10/29/title-tags-in-4-1/
	 * @todo Remove this function when WordPress 4.3 is released.
	 */
	function truenews_render_title() {
		?>
		<title><?php wp_title( '|', true, 'right' ); ?></title>
		<?php
	}
	add_action( 'wp_head', 'truenews_render_title' );
endif;

/**
 * Sets the authordata global when viewing an author archive.
 *
 * This provides backwards compatibility with
 * http://core.trac.wordpress.org/changeset/25574
 *
 * It removes the need to call the_post() and rewind_posts() in an author
 * template to print information about the author.
 *
 * @since  1.0.0
 * @global WP_Query $wp_query WordPress Query object.
 * @return void
 */
function truenews_setup_author() {
	global $wp_query;

	if ( $wp_query->is_author() && isset( $wp_query->post ) ) {
		$GLOBALS['authordata'] = get_userdata( $wp_query->post->post_author );
	}
}
add_action( 'wp', 'truenews_setup_author' );

/**
 * Generates the relevant template info. Adds template meta with theme version. Uses the theme 
 * name and version from style.css.
 *
 * @since 1.0.0
 */
function truenews_meta_template() {
	$theme    = wp_get_theme( get_template() );
	$template = sprintf( '<meta name="template" content="%1$s %2$s" />' . "\n", esc_attr( $theme->get( 'Name' ) ), esc_attr( $theme->get( 'Version' ) ) );

	echo apply_filters( 'truenews_meta_template', $template );
}
add_action( 'wp_head', 'truenews_meta_template', 10 );

/**
 * Removes default styles set by WordPress recent comments widget.
 *
 * @since 1.0.0
 */
function truenews_remove_recent_comments_style() {
	global $wp_widget_factory;
	remove_action( 'wp_head', array( $wp_widget_factory->widgets['WP_Widget_Recent_Comments'], 'recent_comments_style' ) );
}
add_action( 'widgets_init', 'truenews_remove_recent_comments_style' );

/**
 * Change the excerpt more string.
 *
 * @since  1.0.0
 * @param  string  $more
 * @return string
 */
function truenews_excerpt_more( $more ) {
	return '&hellip;';
}
add_filter( 'excerpt_more', 'truenews_excerpt_more' );

/**
 * Control the excerpt length.
 *
 * @since  1.0.0
 * @param  $length
 */
function truenews_excerpt_length( $length ) {
	return 30;
}
add_filter( 'excerpt_length', 'truenews_excerpt_length', 999 );

/**
 * Override the default options.php location.
 *
 * @since  1.0.0
 */
function truenews_location_override() {
	return array( 'admin/options.php' );
}
add_filter( 'options_framework_location', 'truenews_location_override' );

/**
 * Change the theme options text.
 *
 * @since  1.0.0
 * @param  array $menu
 */
function truenews_theme_options_text( $menu ) {
	$menu['page_title'] = '';
	$menu['menu_title'] = __( 'Theme Settings', 'truenews' );

	return $menu;
}
add_filter( 'optionsframework_menu', 'truenews_theme_options_text' );

/**
 * Custom RSS feed url.
 *
 * @since  1.0.0
 * @return string
 */
function truenews_feed_url( $output, $feed ) {

	// Get the custom rss feed url.
	$url = of_get_option( 'truenews_feedburner_url' );

	// Do not redirect comments feed
	if ( strpos( $output, 'comments' ) ) {
		return $output;
	}

	// Check the settings.
	if ( !empty( $url ) ) {
		$output = $url;
	}

	return $output;
}
add_filter( 'feed_link', 'truenews_feed_url', 10, 2 );

/**
 * Custom comment form fields.
 *
 * @since  1.0.0
 * @param  array $fields
 * @return array
 */
function truenews_comment_form_fields( $fields ) {

	$commenter = wp_get_current_commenter();
	$req       = get_option( 'require_name_email' );
	$aria_req  = ( $req ? " aria-required='true'" : '' );

	$fields['author'] = '<input class="comment-name" id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30" placeholder="' . esc_attr__( 'Name (required)', 'truenews' ) . '"' . $aria_req . ' />';

	$fields['email'] = '<input class="comment-email" id="email" name="email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30" placeholder="' . esc_attr__( 'Email (required)', 'truenews' ) . '"' . $aria_req . ' />';

	$fields['url'] = '<input class="comment-website" id="url" name="url" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) . '" size="30" placeholder="' . esc_attr__( 'Website (optional)', 'truenews' ) . '" />';

	return $fields;

}
add_filter( 'comment_form_default_fields', 'truenews_comment_form_fields' );

/**
 * Custom comment form submit field.
 * 
 * @since  1.0.0
 */
function truenews_comment_button() {
	echo '<button type="submit" id="submit">' . __( 'Post Comment', 'truenews' ) . '</button>';
}
add_action( 'comment_form', 'truenews_comment_button' );

/**
 * Add custom attribute 'itempro="image"' to the post thumbnail.
 *
 * @since  1.0.0
 * @param  array  $attr
 * @return array
 */
function truenews_img_attr( $attr ) {
    $attr['itemprop'] = 'image';
    return $attr;
}
add_filter( 'wp_get_attachment_image_attributes', 'truenews_img_attr', 10, 2 );

/**
 * Remove theme-layouts meta box on attachment and bbPress post type.
 * 
 * @since 1.0.0
 */
function truenews_remove_theme_layout_metabox() {
	remove_post_type_support( 'attachment', 'theme-layouts' );
	remove_post_type_support( 'forum', 'theme-layouts' );
	remove_post_type_support( 'topic', 'theme-layouts' );
	remove_post_type_support( 'reply', 'theme-layouts' );
}
add_action( 'init', 'truenews_remove_theme_layout_metabox', 11 );

/**
 * Add post type 'post' support for page sidebars plugin.
 * 
 * @since  1.0.0
 */
function truenews_page_sidebar_plugin() {
	include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
	if ( is_plugin_active( 'simple-page-sidebars/simple-page-sidebars.php' ) ) {
		add_post_type_support( 'post', 'simple-page-sidebars' );
	}
}
add_action( 'init', 'truenews_page_sidebar_plugin' );