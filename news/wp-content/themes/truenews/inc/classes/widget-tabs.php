<?php
/**
 * Tabbed widget.
 *
 * @package    TrueNews
 * @author     Theme Junkie
 * @copyright  Copyright (c) 2014, Theme Junkie
 * @license    http://www.gnu.org/licenses/gpl-2.0.html
 * @since      1.0.0
 */
class TrueNews_Tabs_Widget extends WP_Widget {

	/**
	 * Sets up the widgets.
	 *
	 * @since 1.0.0
	 */
	function __construct() {

		// Set up the widget options.
		$widget_options = array(
			'classname'   => 'widget-truenews-tabs tabs-widget',
			'description' => __( 'Display popular posts, recent posts, recent comments and tags in tabs.', 'truenews' )
		);

		// Create the widget.
		$this->WP_Widget(
			'truenews-tabs',                  // $this->id_base
			__( '&raquo; Tabs', 'truenews' ), // $this->name
			$widget_options                   // $this->widget_options
		);
	}

	/**
	 * Outputs the widget based on the arguments input through the widget controls.
	 *
	 * @since 1.0.0
	 */
	function widget( $args, $instance ) {
		extract( $args );

		// Output the theme's $before_widget wrapper.
		echo $before_widget;
		?>
		
		<ul class="tabs-nav">
			<li class="active"><a href="#tab1" title="<?php esc_attr_e( 'Popular', 'truenews' ); ?>"><i class="fa fa-star"></i></a></li>
			<li><a href="#tab2" title="<?php esc_attr_e( 'Latest', 'truenews' ); ?>"><i class="fa fa-clock-o"></i></a></li>
			<li><a href="#tab3" title="<?php esc_attr_e( 'Comments', 'truenews' ); ?>"><i class="fa fa-comments"></i></a></li>        
			<li><a href="#tab4" title="<?php esc_attr_e( 'Tags', 'truenews' ); ?>"><i class="fa fa-tags"></i></a></li>
		</ul>

		<div class="tabs-container">

			<div class="tab-content" id="tab1">
				<?php echo truenews_popular_posts(); ?>
			</div>

			<div class="tab-content" id="tab2">
				<?php echo truenews_latest_posts(); ?>
			</div>

			<div class="tab-content" id="tab3">
				<?php $comments = get_comments( array( 'number' => 5, 'status' => 'approve', 'post_status' => 'publish' ) ); ?>
				<?php if ( $comments ) : ?>
					<ul>
						<?php foreach( $comments as $comment ) : ?>
							<li class="clearfix">
								<a href="<?php echo get_comment_link( $comment->comment_ID ) ?>"><span class="entry-thumbnail"><?php echo get_avatar( $comment->comment_author_email, '63' ); ?></span></a>
								<a href="<?php echo get_comment_link( $comment->comment_ID ) ?>"><strong><?php echo $comment->comment_author; ?></strong>: <span><?php echo wp_html_excerpt( $comment->comment_content, '80' ); ?></span></a>
							</li>
						<?php endforeach; ?>
					</ul>
				<?php endif; ?>
			</div>

			<div class="tab-content" id="tab4">
				<?php the_widget( 'WP_Widget_Tag_Cloud' ); ?>				
			</div>

		</div>

		<?php
		// Close the theme's widget wrapper.
		echo $after_widget;

	}

}

/**
 * Popular Posts by comment
 *
 * @since 1.0.0
 */
function truenews_popular_posts() {

	// Posts query arguments.
	$args = array(
		'posts_per_page' => 5,
		'orderby'        => 'comment_count',
		'post_type'      => 'post'
	);

	// The post query
	$popular = get_posts( $args );

	global $post;

	if ( $popular ) {
		$html = '<ul>';

			foreach ( $popular as $post ) :
				setup_postdata( $post );

				$html .= '<li class="clearfix">';
					$html .= '<a href="' . esc_url( get_permalink( $post->ID ) ) . '" rel="bookmark">' . get_the_post_thumbnail( $post->ID, 'truenews-widget-thumb', array( 'class' => 'entry-thumbnail', 'alt' => esc_attr( get_the_title( $post->ID ) ) ) ) . '</a>';
					$html .= '<h2 class="entry-title"><a href="' . esc_url( get_permalink( $post->ID ) ) . '" rel="bookmark">' . esc_attr( get_the_title( $post->ID ) ) . '</a></h2>';
					$html .= '<div class="entry-meta">' . get_the_date() . '</div>';
				$html .= '</li>';

			endforeach;

		$html .= '</ul>';
	}

	// Reset the query.
	wp_reset_postdata();

	if ( isset( $html ) ) {
		return $html;
	}

}

/**
 * Recent Posts
 *
 * @since 1.0.0
 */
function truenews_latest_posts() {

	// Posts query arguments.
	$args = array(
		'post_type'      => 'post',
		'posts_per_page' => 5
	);

	// The post query
	$recent = get_posts( $args );

	global $post;

	if ( $recent ) {
		$html = '<ul>';

			foreach ( $recent as $post ) :
				setup_postdata( $post );

				$html .= '<li class="clearfix">';
					$html .= '<a href="' . esc_url( get_permalink( $post->ID ) ) . '" rel="bookmark">' . get_the_post_thumbnail( $post->ID, 'truenews-widget-thumb', array( 'class' => 'entry-thumbnail', 'alt' => esc_attr( get_the_title( $post->ID ) ) ) ) . '</a>';
					$html .= '<h2 class="entry-title"><a href="' . esc_url( get_permalink( $post->ID ) ) . '" rel="bookmark">' . esc_attr( get_the_title( $post->ID ) ) . '</a></h2>';
					$html .= '<div class="entry-meta">' . get_the_date() . '</div>';
				$html .= '</li>';

			endforeach;

		$html .= '</ul>';
	}

	// Reset the query.
	wp_reset_postdata();

	if ( isset( $html ) ) {
		return $html;
	}

}