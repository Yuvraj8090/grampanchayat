<?php
/**
 * Thumbnail widget.
 *
 * @package    TrueNews
 * @author     Theme Junkie
 * @copyright  Copyright (c) 2014, Theme Junkie
 * @license    http://www.gnu.org/licenses/gpl-2.0.html
 * @since      1.0.0
 */
class TrueNews_Thumbnail_Widget extends WP_Widget {

	/**
	 * Sets up the widgets.
	 *
	 * @since 1.0.0
	 */
	function __construct() {

		// Set up the widget options.
		$widget_options = array(
			'classname'   => 'widget-truenews-thumbnail photo-widget',
			'description' => __( 'Display posts thumbnail gallery.', 'truenews' )
		);

		// Create the widget.
		$this->WP_Widget(
			'truenews-gallery',                        // $this->id_base
			__( '&raquo; Posts Gallery', 'truenews' ), // $this->name
			$widget_options                            // $this->widget_options
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

		// If the title not empty, display it.
		if ( $instance['title'] ) {
			echo $before_title . apply_filters( 'widget_title', $instance['title'], $instance, $this->id_base ) . $after_title;
		}

		// Posts query
		$args = array(
			'post_type'      => 'post',
			'posts_per_page' => $instance['num']
		);

		// Limit to category based on user selected tag.
		if ( ! empty( $instance['cat'] ) ) {
			$args['cat'] = $instance['cat'];
		}

		$posts = new WP_Query( $args );

		if ( $posts->have_posts() ) :
			echo '<div id="photo-slider" class="flexslider">';
				echo '<ul class="slides">';
					while ( $posts->have_posts() ) : $posts->the_post();
						echo '<li>';
						echo '<a href=" ' . esc_url( get_permalink() ) . ' " rel="bookmark">';
						echo get_the_post_thumbnail( get_the_ID(), 'truenews-widget-gallery' );
						echo '</a>';
						echo '</li>';
					endwhile;
				echo '</ul>';
			echo '</div>';
		endif;

		// Close the theme's widget wrapper.
		echo $after_widget;

	}

	/**
	 * Updates the widget control options for the particular instance of the widget.
	 *
	 * @since 1.0.0
	 */
	function update( $new_instance, $old_instance ) {

		$instance = $new_instance;

		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['num']   = absint( $new_instance['num'] );
		$instance['cat']   = $new_instance['cat'];

		return $instance;
	}

	/**
	 * Displays the widget control options in the Widgets admin screen.
	 *
	 * @since 1.0.0
	 */
	function form( $instance ) {

		// Default value.
		$defaults = array(
			'title' => esc_html__( 'Posts Gallery', 'truenews' ),
			'num'   => 5,
			'cat'   => 0,
		);

		$instance = wp_parse_args( (array) $instance, $defaults );
	?>

		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>">
				<?php _e( 'Title:', 'truenews' ); ?>
			</label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo esc_attr( $instance['title'] ); ?>" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'num' ); ?>">
				<?php _e( 'Number of posts to show:', 'truenews' ); ?>
			</label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'num' ); ?>" name="<?php echo $this->get_field_name( 'num' ); ?>" value="<?php echo esc_attr( $instance['num'] ); ?>" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'cat' ); ?>"><?php _e( 'Choose Category:', 'truenews' ); ?></label>
			<select class="widefat" id="<?php echo $this->get_field_id( 'cat' ); ?>" name="<?php echo $this->get_field_name( 'cat' ); ?>" style="width:100%;">
				<?php $categories = get_terms( 'category' ); ?>
				<option value="0" <?php selected( $instance['cat'], 0 ); ?>><?php _e( 'All Categories', 'truenews' ) ?></option>
				<?php foreach( $categories as $category ) { ?>
					<option value="<?php echo esc_attr( $category->term_id ); ?>" <?php selected( $instance['cat'], $category->term_id ); ?>><?php echo esc_html( $category->name ); ?></option>
				<?php } ?>
			</select>
		</p>

	<?php

	}

}