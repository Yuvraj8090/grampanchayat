<?php
/**
 * Theme functions file
 *
 * Contains all of the Theme's setup functions, custom functions,
 * custom hooks and Theme settings.
 * 
 * @package    TrueNews
 * @author     Theme Junkie
 * @copyright  Copyright (c) 2014, Theme Junkie
 * @license    http://www.gnu.org/licenses/gpl-2.0.html
 * @since      1.0.0
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) ) {
	$content_width = 730; /* pixels */
}

if ( ! function_exists( 'truenews_content_width' ) ) :
/**
 * Set new content width if user uses 1 column layout.
 *
 * @since  1.0.0
 */
function truenews_content_width() {
	global $content_width;

	if ( in_array( get_theme_mod( 'theme_layout' ), array( '1c' ) ) ) {
		$content_width = 1070;
	}
}
endif;
add_action( 'template_redirect', 'truenews_content_width' );

if ( ! function_exists( 'truenews_theme_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * @since  1.0.0
 */
function truenews_theme_setup() {

	// Make the theme available for translation.
	load_theme_textdomain( 'truenews', trailingslashit( get_template_directory() ) . 'languages' );

	// Add custom stylesheet file to the TinyMCE visual editor.
	add_editor_style( array( 'assets/css/editor-style.css' ) );

	// Add RSS feed links to <head> for posts and comments.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	// Enable support for Post Thumbnails.
	add_theme_support( 'post-thumbnails' );

	// Declare image sizes.
	add_image_size( 'truenews-megamenu', 200, 135, true );
	add_image_size( 'truenews-post', 343, 187, true );
	add_image_size( 'truenews-carousel', 245, 156, true );
	add_image_size( 'truenews-featured', 530, 300, true );
	add_image_size( 'truenews-featured-thumb', 100, 56, true );
	add_image_size( 'truenews-home-posts-1col', 340, 190, true );
	add_image_size( 'truenews-home-posts-2col', 121, 73, true );
	add_image_size( 'truenews-widget-thumb', 64, 64, true );
	add_image_size( 'truenews-widget-gallery', 300, 199, true );

	// Register custom navigation menu.
	register_nav_menus(
		array(
			'primary'   => __( 'Primary Menu', 'truenews' ),
			'secondary' => __( 'Secondary Menu' , 'truenews' ),
		)
	);

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'comment-list', 'search-form', 'comment-form', 'gallery', 'caption'
	) );

	/*
	 * Enable support for Post Formats.
	 * See: http://codex.wordpress.org/Post_Formats
	 */
	add_theme_support( 'post-formats', array(
		'aside', 'image', 'video', 'quote', 'link'
	) );

	// Setup the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'truenews_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );

	// Enable theme-layouts extensions.
	add_theme_support( 'theme-layouts', 
		array(
			'1c'   => __( '1 Column Wide (Full Width)', 'truenews' ),
			'2c-l' => __( '2 Columns: Content / Sidebar', 'truenews' ),
			'2c-r' => __( '2 Columns: Sidebar / Content', 'truenews' )
		),
		array( 'customize' => false, 'default' => '2c-l' ) 
	);

	// This theme uses its own gallery styles.
	add_filter( 'use_default_gallery_style', '__return_false' );

}
endif; // truenews_theme_setup
add_action( 'after_setup_theme', 'truenews_theme_setup' );

/**
 * Registers widget areas and custom widgets.
 *
 * @since 1.0.0
 * @link  http://codex.wordpress.org/Function_Reference/register_sidebar
 * @link  http://codex.wordpress.org/Function_Reference/register_widget
 */
function truenews_widgets_init() {

	// Register ad widget.
	require trailingslashit( get_template_directory() ) . 'inc/classes/widget-ads.php';
	register_widget( 'TrueNews_Ads_Widget' );

	// Register ad125 widget.
	require trailingslashit( get_template_directory() ) . 'inc/classes/widget-ads125.php';
	register_widget( 'TrueNews_Ads125_Widget' );

	// Register feedburner widget.
	require trailingslashit( get_template_directory() ) . 'inc/classes/widget-feedburner.php';
	register_widget( 'TrueNews_Feedburner_Widget' );

	// Register recent posts thumbnail widget.
	require trailingslashit( get_template_directory() ) . 'inc/classes/widget-recent.php';
	register_widget( 'TrueNews_Recent_Widget' );

	// Register popular posts thumbnail widget.
	require trailingslashit( get_template_directory() ) . 'inc/classes/widget-popular.php';
	register_widget( 'TrueNews_Popular_Widget' );

	// Register random posts thumbnail widget.
	require trailingslashit( get_template_directory() ) . 'inc/classes/widget-random.php';
	register_widget( 'TrueNews_Random_Widget' );

	// Register video widget.
	require trailingslashit( get_template_directory() ) . 'inc/classes/widget-video.php';
	register_widget( 'TrueNews_Video_Widget' );

	// Register tabs widget.
	require trailingslashit( get_template_directory() ) . 'inc/classes/widget-tabs.php';
	register_widget( 'TrueNews_Tabs_Widget' );

	// Register posts widget.
	require trailingslashit( get_template_directory() ) . 'inc/classes/widget-posts-1col.php';
	register_widget( 'TrueNews_Home_Posts_1col_Widget' );

	// Register posts widget.
	require trailingslashit( get_template_directory() ) . 'inc/classes/widget-posts-2col.php';
	register_widget( 'TrueNews_Home_Posts_2col_Widget' );

	// Register gallery widget.
	require trailingslashit( get_template_directory() ) . 'inc/classes/widget-thumbnail.php';
	register_widget( 'TrueNews_Thumbnail_Widget' );

	register_sidebar(
		array(
			'name'          => __( 'Home Sidebar', 'truenews' ),
			'id'            => 'home',
			'description'   => __( 'Use this sidebar to manage the content on home page. We recommended you only use a widget with Home prefix.', 'truenews' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h3 class="widget-title"><span>',
			'after_title'   => '</span></h3>',
		)
	);

	register_sidebar(
		array(
			'name'          => __( 'Primary Sidebar', 'truenews' ),
			'id'            => 'primary',
			'description'   => __( 'Main sidebar that appears on the right.', 'truenews' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h3 class="widget-title"><span>',
			'after_title'   => '</span></h3>',
		)
	);

	register_sidebar(
		array(
			'name'          => __( 'Footer 1', 'truenews' ),
			'id'            => 'footer-1',
			'description'   => __( 'The sidebar will appear at the bottom of your site.', 'truenews' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		)
	);

	register_sidebar(
		array(
			'name'          => __( 'Footer 2', 'truenews' ),
			'id'            => 'footer-2',
			'description'   => __( 'The sidebar will appear at the bottom of your site.', 'truenews' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		)
	);

	register_sidebar(
		array(
			'name'          => __( 'Footer 3', 'truenews' ),
			'id'            => 'footer-3',
			'description'   => __( 'The sidebar will appear at the bottom of your site.', 'truenews' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		)
	);

	register_sidebar(
		array(
			'name'          => __( 'Footer 4', 'truenews' ),
			'id'            => 'footer-4',
			'description'   => __( 'The sidebar will appear at the bottom of your site.', 'truenews' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		)
	);

	register_sidebar(
		array(
			'name'          => __( 'Footer 5', 'truenews' ),
			'id'            => 'footer-5',
			'description'   => __( 'The sidebar will appear at the bottom of your site.', 'truenews' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		)
	);

	register_sidebar(
		array(
			'name'          => __( 'Footer 6', 'truenews' ),
			'id'            => 'footer-6',
			'description'   => __( 'The sidebar will appear at the bottom of your site.', 'truenews' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		)
	);
	
}
add_action( 'widgets_init', 'truenews_widgets_init' );

/**
 * Register Oswald Google fonts.
 *
 * @return string
 */
function truenews_oswald_font_url() {
	$oswald_font_url = '';

	/* translators: If there are characters in your language that are not supported
	   by Oswald, translate this to 'off'. Do not translate into your own language. */
	if ( 'off' !== _x( 'on', 'Oswald font: on or off', 'truenews' ) ) {

		$oswald_font_url = add_query_arg( 'family', urlencode( 'Oswald:700' ), "//fonts.googleapis.com/css" );
	}

	return $oswald_font_url;
}

/**
 * Custom template tags for this theme.
 */
require trailingslashit( get_template_directory() ) . 'inc/template-tags.php';

/**
 * Enqueue scripts and styles.
 */
require trailingslashit( get_template_directory() ) . 'inc/scripts.php';

/**
 * Require and recommended plugins list.
 */
require trailingslashit( get_template_directory() ) . 'inc/plugins.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require trailingslashit( get_template_directory() ) . 'inc/extras.php';

/**
 * Customizer additions.
 */
require trailingslashit( get_template_directory() ) . 'inc/customizer.php';

/**
 * We use some part of Hybrid Core to extends our themes.
 *
 * @link  http://themehybrid.com/hybrid-core Hybrid Core site.
 */
require trailingslashit( get_template_directory() ) . 'inc/hybrid/loop-pagination.php';
require trailingslashit( get_template_directory() ) . 'inc/hybrid/theme-layouts.php';
require trailingslashit( get_template_directory() ) . 'inc/hybrid/attr.php';

/**
 * Load Options Framework core.
 */
define( 'OPTIONS_FRAMEWORK_DIRECTORY', trailingslashit( get_template_directory_uri() ) . 'admin/' );
require trailingslashit( get_template_directory() ) . 'admin/options-framework.php';
require trailingslashit( get_template_directory() ) . 'admin/options-functions.php';

/**
 * Mega menus walker.
 */
require trailingslashit( get_template_directory() ) . 'inc/megamenus/init.php';
require trailingslashit( get_template_directory() ) . 'inc/megamenus/class-truenews-primary-nav-walker.php';