<?php
/**
 * Widget home posts 2 column widget.
 *
 * @package    TrueNews
 * @author     Theme Junkie
 * @copyright  Copyright (c) 2014, Theme Junkie
 * @license    http://www.gnu.org/licenses/gpl-2.0.html
 * @since      1.0.0
 */
class TrueNews_Home_Posts_2col_Widget extends WP_Widget {

	/**
	 * Sets up the widgets.
	 *
	 * @since 1.0.0
	 */
	function __construct() {

		// Set up the widget options.
		$widget_options = array(
			'classname'   => 'widget-truenews-home-posts home-posts-2col',
			'description' => __( 'Display posts based on user selected category. Please use it only in Home sidebar!', 'truenews' )
		);

		// Create the widget.
		$this->WP_Widget(
			'truenews-home-posts-2col',                      // $this->id_base
			__( '&raquo; Home Posts 2 Column', 'truenews' ), // $this->name
			$widget_options                                  // $this->widget_options
		);
	}

	/**
	 * Outputs the widget based on the arguments input through the widget controls.
	 *
	 * @since 1.0.0
	 */
	function widget( $args, $instance ) {
		extract( $args );

		// If user have not selected any category then display none.
		if ( empty( $instance['cat'] ) && empty( $instance['cat_2'] ) ) {
			return;
		}

		// Output the theme's $before_widget wrapper.
		echo $before_widget;

		echo '<div class="recent-content clearfix">';

			// Pull the selected category.
			$cat_id   = $instance['cat'];
			$cat_id_2 = $instance['cat_2'];

			// Get the category.
			$category   = get_category( $cat_id );
			$category_2 = get_category( $cat_id_2 );

			// Get the category archive link.
			$cat_link   = get_category_link( $cat_id );
			$cat_link_2 = get_category_link( $cat_id_2 );

			/**
			 * Posts in column 1.
			 */
			
			// Posts query arguments.
			$args = array(
				'post_type'      => 'post',
				'posts_per_page' => 4
			);

			// Limit to category based on user selected tag.
			if ( ! empty( $instance['cat'] ) ) {
				$args['cat'] = $instance['cat'];
			}

			// Allow dev to filter the post arguments.
			$query = apply_filters( 'truenews_widget_posts_2col_args', $args );

			// The post query.
			$posts = new WP_Query( $query );

			if ( $posts->have_posts() ) : ?>

				<article class="hentry small-article">

					<h3 class="section-title">
						<strong class="color1"><?php echo $category->name; ?></strong> <span class="see-all"><a href="<?php echo esc_url( $cat_link ); ?>"><?php _e( 'More', 'truenews' ); ?> <i class="fa fa-angle-right"></i></a></span>
					</h3>

					<?php $i = 0; ?>

					<?php while ( $posts->have_posts() ) : $posts->the_post(); ?>
							
						<?php if ( ++$i == 1 ) { // If first post, show title, excerpt, and image. ?>							
						<div class="entry-top">
							<?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>

							<?php if ( has_post_thumbnail() ) : ?>
								<div class="post-img"><a href="<?php the_permalink(); ?>"><?php the_post_thumbnail( 'truenews-home-posts-2col', array( 'class' => 'entry-thumbnail', 'alt' => esc_attr( get_the_title() ) ) ); ?></a></div>
							<?php endif; ?>

							<div class="entry-summary">
								<?php echo apply_filters( 'truenews_posts_2col', wp_trim_words( get_the_excerpt(), 12 ) ); ?>
							</div><!-- .entry-summary -->
						</div>

						<div class="clearfix"></div>

						<?php } else { // If not the first post, add the entry titles as list items. ?>

							<?php if ( $i == 2 ) echo '<ul>'; // If second post, open the list. ?>

							<li class="more-post">
								<?php the_title( sprintf( '<h2 class="related-post-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>
								<div class="entry-meta">
									<time class="entry-date updated" datetime="<?php echo esc_html( get_the_date( 'c' ) ); ?>"><span><?php echo esc_html( get_the_date() ); ?></span></time>
									<?php if ( ! post_password_required() && ( comments_open() || '0' != get_comments_number() ) ) : ?>
										<span class="entry-comment"><?php comments_popup_link( __( '0 Comment', 'truenews' ), __( '1 Comment', 'truenews' ), __( '% Comments', 'truenews' ) ); ?></span>
									<?php endif; ?>
								</div>
							</li>

						<?php } ?>

					<?php endwhile; ?>

					<?php if ( $i > 1 ) echo '</ul>'; // If there is more than one post, close the list after the loop. ?>

				</article>

			<?php endif;

			// Restore original Post Data.
			wp_reset_postdata();

			/**
			 * Posts in column 2.
			 */
			
			// Posts query arguments.
			$args = array(
				'post_type'      => 'post',
				'posts_per_page' => 4
			);

			// Limit to category based on user selected tag.
			if ( ! empty( $instance['cat_2'] ) ) {
				$args['cat'] = $instance['cat_2'];
			}

			// Allow dev to filter the post arguments.
			$query = apply_filters( 'truenews_widget_posts_2col_2_args', $args );

			// The post query.
			$posts = new WP_Query( $query );

			if ( $posts->have_posts() ) : ?>

				<article class="related-post small-article">

					<h3 class="section-title">
						<strong class="color1"><?php echo $category_2->name; ?></strong> <span class="see-all"><a href="<?php echo esc_url( $cat_link_2 ); ?>"><?php _e( 'More', 'truenews' ); ?> <i class="fa fa-angle-right"></i></a></span>
					</h3>

					<?php $i = 0; ?>

					<?php while ( $posts->have_posts() ) : $posts->the_post(); ?>
							
						<?php if ( ++$i == 1 ) { // If first post, show title, excerpt, and image. ?>							
						<div class="entry-top">
							<?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>

							<?php if ( has_post_thumbnail() ) : ?>
								<div class="post-img"><a href="<?php the_permalink(); ?>"><?php the_post_thumbnail( 'truenews-home-posts-2col', array( 'class' => 'entry-thumbnail', 'alt' => esc_attr( get_the_title() ) ) ); ?></a></div>
							<?php endif; ?>

							<div class="entry-summary">
								<?php echo apply_filters( 'truenews_posts_2col', wp_trim_words( get_the_excerpt(), 12 ) ); ?>
							</div><!-- .entry-summary -->
						</div>

						<div class="clearfix"></div>

						<?php } else { // If not the first post, add the entry titles as list items. ?>

							<?php if ( $i == 2 ) echo '<ul>'; // If second post, open the list. ?>

							<li class="more-post">
								<?php the_title( sprintf( '<h2 class="related-post-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>
								<div class="entry-meta">
									<time class="entry-date updated" datetime="<?php echo esc_html( get_the_date( 'c' ) ); ?>"><span><?php echo esc_html( get_the_date() ); ?></span></time>
									<?php if ( ! post_password_required() && ( comments_open() || '0' != get_comments_number() ) ) : ?>
										<span class="entry-comment"><?php comments_popup_link( __( '0 Comment', 'truenews' ), __( '1 Comment', 'truenews' ), __( '% Comments', 'truenews' ) ); ?></span>
									<?php endif; ?>
								</div>
							</li>

						<?php } ?>

					<?php endwhile; ?>

					<?php if ( $i > 1 ) echo '</ul>'; // If there is more than one post, close the list after the loop. ?>

				</article>

			<?php endif;

			// Restore original Post Data.
			wp_reset_postdata();

		echo '</div>';

		// Close the theme's widget wrapper.
		echo $after_widget;

	}

	/**
	 * Updates the widget control options for the particular instance of the widget.
	 *
	 * @since 1.0.0
	 */
	function update( $new_instance, $old_instance ) {

		$instance          = $new_instance;
		$instance['cat']   = $new_instance['cat'];
		$instance['cat_2'] = $new_instance['cat_2'];

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
			'cat' => '',
			'cat_2' => '',
		);

		$instance = wp_parse_args( (array) $instance, $defaults );
	?>

	<p>
		<label for="<?php echo $this->get_field_id( 'cat' ); ?>"><?php _e( 'Choose Category 1:', 'truenews' ); ?></label>
		<select class="widefat" id="<?php echo $this->get_field_id( 'cat' ); ?>" name="<?php echo $this->get_field_name( 'cat' ); ?>" style="width:100%;">
			<?php $categories = get_terms( 'category' ); ?>
			<?php foreach( $categories as $category ) { ?>
				<option value="<?php echo esc_attr( $category->term_id ); ?>" <?php selected( $instance['cat'], $category->term_id ); ?>><?php echo esc_html( $category->name ); ?></option>
			<?php } ?>
		</select>
	</p>

	<p>
		<label for="<?php echo $this->get_field_id( 'cat_2' ); ?>"><?php _e( 'Choose Category 2:', 'truenews' ); ?></label>
		<select class="widefat" id="<?php echo $this->get_field_id( 'cat_2' ); ?>" name="<?php echo $this->get_field_name( 'cat_2' ); ?>" style="width:100%;">
			<?php $categories = get_terms( 'category' ); ?>
			<?php foreach( $categories as $category ) { ?>
				<option value="<?php echo esc_attr( $category->term_id ); ?>" <?php selected( $instance['cat_2'], $category->term_id ); ?>><?php echo esc_html( $category->name ); ?></option>
			<?php } ?>
		</select>
	</p>

	<?php

	}

}