<?php
/**
 * Custom template tags for this theme.
 * Eventually, some of the functionality here could be replaced by core features.
 * 
 * @package    TrueNews
 * @author     Theme Junkie
 * @copyright  Copyright (c) 2014, Theme Junkie
 * @license    http://www.gnu.org/licenses/gpl-2.0.html
 * @since      1.0.0
 */

if ( ! function_exists( 'truenews_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 *
 * @since 1.0.0
 */
function truenews_posted_on() {
	$time_string = '<time class="entry-date published" datetime="%1$s" ' . hybrid_get_attr( 'entry-published' ) . '>%2$s</time>';

	$time_string = sprintf( $time_string,
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() )
	);

	printf( __( '<span>%1$s</span> <span class="entry-author" ' . hybrid_get_attr( 'entry-author' ) . '> by %2$s</span>', 'truenews' ),
		$time_string,
		sprintf( '<span class="author vcard"><a class="url fn n" href="%1$s" itemprop="url"><span itemprop="name">%2$s</span></a></span>',
			esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
			esc_html( get_the_author() )
		)
	);

	/* translators: used between list items, there is a space after the comma */
	$categories_list = get_the_category_list( __( ', ', 'truenews' ) );
	if ( $categories_list && truenews_categorized_blog() ) : ?>
		<span class="entry-catagory" <?php hybrid_attr( 'entry-terms', 'category' ); ?>>
			<?php printf( __( 'in %s', 'truenews' ), $categories_list ); ?>
		</span>
	<?php endif; // End if categories ?>

	<?php if ( ! post_password_required() && ( comments_open() || '0' != get_comments_number() ) ) : ?>
		&middot; <span class="entry-comment"><?php comments_popup_link( __( '0 Comment', 'truenews' ), __( '1 Comment', 'truenews' ), __( '% Comments', 'truenews' ) ); ?></span>
	<?php endif; ?>
	
	<?php if ( ! is_singular() ) : ?>
 		<span class="entry-more"><a href="<?php the_permalink(); ?>"><?php _e( 'Read More &raquo;', 'truenews' ); ?></a></span>
 	<?php endif;

}
endif;

/**
 * Returns true if a blog has more than 1 category.
 *
 * @since  1.0.0
 * @return bool
 */
function truenews_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'truenews_categories' ) ) ) {
		// Create an array of all the categories that are attached to posts.
		$all_the_cool_cats = get_categories( array(
			'fields'     => 'ids',
			'hide_empty' => 1,

			// We only need to know if there is more than one category.
			'number'     => 2,
		) );

		// Count the number of categories that are attached to the posts.
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'truenews_categories', $all_the_cool_cats );
	}

	if ( $all_the_cool_cats > 1 ) {
		// This blog has more than 1 category so truenews_categorized_blog should return true.
		return true;
	} else {
		// This blog has only 1 category so truenews_categorized_blog should return false.
		return false;
	}
}

/**
 * Flush out the transients used in truenews_categorized_blog.
 *
 * @since 1.0.0
 */
function truenews_category_transient_flusher() {
	// Like, beat it. Dig?
	delete_transient( 'truenews_categories' );
}
add_action( 'edit_category', 'truenews_category_transient_flusher' );
add_action( 'save_post',     'truenews_category_transient_flusher' );

if ( ! function_exists( 'truenews_site_branding' ) ) :
/**
 * Site branding for the site.
 * 
 * Display site title by default, but user can change it with their custom logo.
 * They can upload it on Customizer page.
 * 
 * @since  1.0.0
 */
function truenews_site_branding() {

	$logo = of_get_option( 'truenews_logo' );

	// Check if logo available, then display it.
	if ( $logo ) :
		echo '<div id="logo" itemscope itemtype="http://schema.org/Brand">' . "\n";
			echo '<a href="' . esc_url( get_home_url() ) . '" itemprop="url" rel="home">' . "\n";
				echo '<img itemprop="logo" src="' . esc_url( $logo ) . '" alt="' . esc_attr( get_bloginfo( 'name' ) ) . '" />' . "\n";
			echo '</a>' . "\n";
		echo '</div>' . "\n";

	// If not, then display the Site Title.
	else :
		echo '<div id="logo"><h1 class="site-title" ' . hybrid_get_attr( 'site-title' ) . '><a href="' . esc_url( get_home_url() ) . '" itemprop="url" rel="home"><span itemprop="headline">' . esc_attr( get_bloginfo( 'name' ) ) . '</span></a></h1></div>';
	endif;

}
endif;

if ( ! function_exists( 'truenews_social_links' ) ) :
/**
 * Social links
 *
 * @since  1.0.0
 */
function truenews_social_links() {

	// Get option value.
	$enable     = of_get_option( 'truenews_enable_social', '1' );
	$facebook   = of_get_option( 'truenews_fb' );
	$twitter    = of_get_option( 'truenews_tw' );
	$gplus      = of_get_option( 'truenews_gplus' );
	$pinterest  = of_get_option( 'truenews_pinterest' );
	$linkedin   = of_get_option( 'truenews_linkedin' );
	$feed       = of_get_option( 'truenews_feed' );
	$newsletter = of_get_option( 'truenews_newsletter' );

	// Check if social links option enabled.
	if ( $enable ) {

		echo '<div class="header-social-icons">';

			if ( $facebook ) {
				echo '<a href="' . esc_url( $facebook ) . '" title="Facebook"><i class="fa fa-facebook"></i></a>';
			}
			if ( $twitter ) {
				echo '<a href="' . esc_url( $twitter ) . '" title="Twitter"><i class="fa fa-twitter"></i></a>';
			}
			if ( $gplus ) {
				echo '<a href="' . esc_url( $gplus ) . '" title="GooglePlus"><i class="fa fa-google-plus"></i></a>';
			}
			if ( $pinterest ) {
				echo '<a href="' . esc_url( $pinterest ) . '" title="Pinterest"><i class="fa fa-pinterest"></i></a>';
			}
			if ( $linkedin ) {
				echo '<a href="' . esc_url( $linkedin ) . '" title="LinkedIn"><i class="fa fa-linkedin"></i></a>';
			}
			if ( $feed ) {
				echo '<a href="' . esc_url( $feed ) . '" title="RSS"><i class="fa fa-rss"></i></a>';
			}
			if ( $newsletter ) {
				echo '<a href="' . esc_url( $newsletter ) . '" title="Newsletter"><i class="fa fa-envelope-o"></i></a>';
			}

		echo  '</div>';

	}

}
endif;

if ( ! function_exists( 'truenews_breaking_posts' ) ) :
/**
 * Breaking posts.
 * 
 * @since  1.0.0
 */
function truenews_breaking_posts() {

	$enable = of_get_option( 'truenews_breaking', '1' ); // Enable disable area.
	$tag    = of_get_option( 'truenews_breaking_tag' );  // Get the user selected tag for the breaking posts.

	// Return early if disabled by user.
	if ( ! $enable ) {
		return;
	}

	// Posts query arguments.
	$args = array(
		'post_type'      => 'post',
		'posts_per_page' => 5
	);

	// Limit to tag based on user selected tag.
	if ( ! empty( $tag ) ) {
		$args['tag_id'] = $tag;
	}

	// Allow dev to filter the post arguments.
	$query = apply_filters( 'truenews_breaking_args', $args );

	// The post query.
	$breaking = new WP_Query( $query );

	// Check if the post(s) exist.
	if ( $breaking->have_posts() ) : ?>

		<div id="news-ticker" class="clearfix">
			<span class="text"><?php _e( 'Breaking News', 'truenews' ); ?></span>
			<ul class="news-list">
				<?php while ( $breaking->have_posts() ) : $breaking->the_post(); ?>
					<li class="news-item">
						<?php printf( __( '%s ago', 'truenews' ), human_time_diff( get_the_date( 'U' ), current_time( 'timestamp' ) ) ); ?> - <a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a> - <?php if ( ! post_password_required() && ( comments_open() || '0' != get_comments_number() ) ) : ?><span class="headline-comment"><?php comments_popup_link( __( '0 Comment', 'truenews' ), __( '1 Comment', 'truenews' ), __( '% Comments', 'truenews' ) ); ?></span><?php endif; ?>
					</li>
				<?php endwhile; ?>
			</ul>
			<span class="headline-nav">
				<a class="headline-prev" href="#"><i class="fa fa-angle-left"></i></a>
				<a class="headline-next" href="#"><i class="fa fa-angle-right"></i></a>
			</span><!-- headline-nav -->
		</div>

	<?php endif; // End check.

	// Restore original Post Data.
	wp_reset_postdata();

}
endif;

if ( ! function_exists( 'truenews_featured_posts' ) ) :
/**
 * Featured posts.
 * 
 * @since  1.0.0
 */
function truenews_featured_posts() {

	$enable = of_get_option( 'truenews_featured', '1' ); // Enable disable area.
	$tag    = of_get_option( 'truenews_featured_tag' );  // Get the user selected tag for the featured posts.

	// Return early if disabled by user.
	if ( ! $enable ) {
		return;
	}

	// Posts query arguments.
	$args = array(
		'post_type'      => 'post',
		'posts_per_page' => 4
	);

	// Limit to tag based on user selected tag.
	if ( ! empty( $tag ) ) {
		$args['tag_id'] = $tag;
	}

	// Allow dev to filter the post arguments.
	$query = apply_filters( 'truenews_featured_args', $args );

	// The post query.
	$featured = new WP_Query( $query );

	// Check if the post(s) exist.
	if ( $featured->have_posts() ) : ?>

		<section id="featured-content" class="clearfix" itemscope itemtype="http://schema.org/Blog">
		
			<div id="mainslider" class="flexslider">
				<ul class="slides">
					<?php while ( $featured->have_posts() ) : $featured->the_post(); ?>
						<li>
							<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> <?php hybrid_attr( 'post' ); ?>>
								<?php if ( has_post_thumbnail() ) : ?>
									<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail( 'truenews-featured', array( 'class' => 'entry-thumbnail', 'alt' => esc_attr( get_the_title() ) ) ); ?></a>
								<?php endif; ?>
								<div class="entry-meta">
									<?php
										$category = get_the_category();
										if ( $category && truenews_categorized_blog() ) :
									?>
										<span class="entry-category" <?php hybrid_attr( 'entry-terms', 'category' ); ?>>
											<a href="<?php echo get_category_link( $category[0]->term_id ); ?>"><?php echo $category[0]->name; ?></a>
										</span>
									<?php endif; // End if categories ?>
								</div>
								<?php the_title( sprintf( '<h2 class="entry-title" ' . hybrid_get_attr( 'entry-title' ) . '><a href="%s" rel="bookmark" itemprop="url">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>
								<div class="entry-meta">
									<time class="entry-date updated" datetime="<?php echo esc_html( get_the_date( 'c' ) ); ?>" <?php hybrid_attr( 'entry-published' ); ?>><span><?php echo esc_html( get_the_date() ); ?></span></time>
									<?php if ( ! post_password_required() && ( comments_open() || '0' != get_comments_number() ) ) : ?>
										<span class="entry-comment"><?php comments_popup_link( __( '0 Comment', 'truenews' ), __( '1 Comment', 'truenews' ), __( '% Comments', 'truenews' ) ); ?></span>
									<?php endif; ?>
								</div>
								<div class="entry-summary" <?php hybrid_attr( 'entry-summary' ); ?>>
									<?php the_excerpt(); ?>
								</div><!-- .entry-summary -->
								<div class="more-link"><a href="<?php the_permalink(); ?>"><?php _e( 'Read Full Article', 'truenews' ); ?></a></div>
							</article>
						</li>
					<?php endwhile; ?>
				</ul>			
			</div><!-- #mainslider -->

			<div class="thumb-slider clearfix">
				<div id="carousel" class="flexslider">
					<ul class="tabs" id="main-slider-control-nav">
						<?php $i = 0 ;?>
						<?php while ( $featured->have_posts() ) : $featured->the_post(); ?>
						
						<?php
						$i++;
						$class = '';
						if ( $i === 1 ) {
							$class = 'class="first-slide"';
						} elseif ( $i === 4 ) {
							$class = 'class="last-slide"';
						}
						?>
							<li <?php echo $class; ?>>
								<article class="slider-thumbs clearfix">
									<?php if ( has_post_thumbnail() ) : ?>
										<div class="slider-img"><?php the_post_thumbnail( 'truenews-featured-thumb', array( 'alt' => esc_attr( get_the_title() ) ) ); ?></div>
									<?php endif; ?>
									<?php the_title( '<h3 class="thumb-title">', '</h3>' ); ?>
								</article>
							</li>
						<?php endwhile; ?>
					</ul>
				</div>
			</div><!-- .thumb-slider -->
	
		</section>

	<?php endif; // End check.

	// Restore original Post Data.
	wp_reset_postdata();

}
endif;

if ( ! function_exists( 'truenews_carousel_posts' ) ) :
/**
 * Editor's Pick posts.
 * 
 * @since  1.0.0
 */
function truenews_carousel_posts() {

	$enable = of_get_option( 'truenews_editor_picks', '1' ); // Enable disable area.
	$tag    = of_get_option( 'truenews_editor_picks_tag' );  // Get the user selected tag for the editor's picks posts.

	// Return early if disabled by user.
	if ( ! $enable ) {
		return;
	}

	// Posts query arguments.
	$args = array(
		'post_type'      => 'post',
		'posts_per_page' => 10
	);

	// Limit to tag based on user selected tag.
	if ( ! empty( $tag ) ) {
		$args['tag_id'] = $tag;
	}

	$query = apply_filters( 'truenews_editor_args', $args );

	// The post query.
	$editor = new WP_Query( $query );

	// Check if the post(s) exist.
	if ( $editor->have_posts() ) : ?>

		<div id="carousel-1" class="carousel-loop clearfix">
			<h3 class="section-title"><strong class="color9"><?php _e( 'Editor\'s Picks', 'truenews' ); ?></strong></h3>
			<div class="jcarousel">
				<ul>
					<?php while ( $editor->have_posts() ) : $editor->the_post(); ?>
						<li>
							<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
								<?php if ( has_post_thumbnail() ) : ?>
									<a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_post_thumbnail( 'truenews-carousel', array( 'class' => 'entry-thumbnail', 'alt' => esc_attr( get_the_title() ) ) ); ?></a>
								<?php endif; ?>
								<?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>
							</article>
						</li>
					<?php endwhile; ?>
				</ul>
			</div>

			<a href="#" class="jcarousel-control-prev"><i class="fa fa-angle-left"></i></a>
			<a href="#" class="jcarousel-control-next"><i class="fa fa-angle-right"></i></a>
		</div>

	<?php endif; // End check.

	// Restore original Post Data.
	wp_reset_postdata();

}
endif;

if ( ! function_exists( 'truenews_social_share' ) ) :
/**
 * Social share.
 *
 * @since  1.0.0
 */
function truenews_social_share() {
	global $post;

	// Bail if user don't want to display the share buttons via theme settings.
	if ( ! of_get_option( 'truenews_post_share', '1' ) ) {
		return;
	}
?>
	<span class="entry-share-icons">
		<span class="entry-share-icons">
			<a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo urlencode( get_permalink( $post->ID ) ); ?>" class="tooltip" title="Facebook"><i class="fa fa-facebook"></i></a>
			<a href="https://twitter.com/intent/tweet?text=<?php echo esc_attr( get_the_title( $post->ID ) ); ?>&url=<?php echo urlencode( get_permalink( $post->ID ) ); ?>" class="tooltip" title="Twitter"><i class="fa fa-twitter"></i></a>
			<a href="https://plus.google.com/share?url=<?php echo urlencode( get_permalink( $post->ID ) ); ?>" class="tooltip" title="GooglePlus"><i class="fa fa-google-plus"></i></a>
			<a href="https://pinterest.com/pin/create/button/?url=<?php echo urlencode( get_permalink( $post->ID ) ); ?>&media=<?php echo wp_get_attachment_url( get_post_thumbnail_id( $post->ID ) ); ?>&description=<?php echo get_the_excerpt(); ?>" class="tooltip" title="Pinterest"><i class="fa fa-pinterest"></i></a>
			<a href="https://www.linkedin.com/shareArticle?mini=true&url=<?php echo urlencode( get_permalink( $post->ID ) ); ?>&title=<?php echo esc_attr( get_the_title( $post->ID ) ); ?>&summary=<?php echo get_the_excerpt(); ?>&source=<?php echo esc_attr( get_bloginfo( 'name' ) ) ?>" class="tooltip" title="LinkedIn"><i class="fa fa-linkedin"></i></a>
		</span>
	</span>
<?php
}
endif;

if ( ! function_exists( 'truenews_post_author' ) ) :
/**
 * Author post informations.
 *
 * @since  1.0.0
 */
function truenews_post_author() {

	// Bail if not on the single post.
	if ( ! is_single() ) {
		return;
	}

	// Bail if user hasn't fill the Biographical Info field.
	if ( ! get_the_author_meta( 'description' ) ) {
		return;
	}

	// Bail if user don't want to display the author info via theme settings.
	if ( ! of_get_option( 'truenews_post_author', '1' ) ) {
		return;
	}
?>

	<div class="author-box clearfix" <?php hybrid_attr( 'entry-author' ) ?>>
		<?php echo get_avatar( is_email( get_the_author_meta( 'user_email' ) ), apply_filters( 'truenews_author_bio_avatar_size', 64 ), '', strip_tags( get_the_author() ) ); ?>
		<h3 class="author-title">
			<a class="author-name url fn n" href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" rel="author" itemprop="url"><span itemprop="name"><?php echo strip_tags( get_the_author() ); ?></span></a>
		</h3>
		<p itemprop="description"><?php echo stripslashes( get_the_author_meta( 'description' ) ); ?></p>
	</div><!-- .author-box -->

<?php
}
endif;

if ( ! function_exists( 'truenews_comment' ) ) :
/**
 * Template for comments and pingbacks.
 *
 * Used as a callback by wp_list_comments() for displaying the comments.
 *
 * @since  1.0.0
 */
function truenews_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case 'pingback' :
		case 'trackback' :
		// Display trackbacks differently than normal comments.
	?>
	<li <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>" <?php hybrid_attr( 'comment' ); ?>>
		<p <?php hybrid_attr( 'comment-content' ); ?>><?php _e( 'Pingback:', 'truenews' ); ?> <span <?php hybrid_attr( 'comment-author' ); ?>><span itemprop="name"><?php comment_author_link(); ?></span></span> <?php edit_comment_link( __( '(Edit)', 'truenews' ), '<span class="edit-link">', '</span>' ); ?></p>
	<?php
			break;
		default :
		// Proceed with normal comments.
		global $post;
	?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>" <?php hybrid_attr( 'comment' ); ?>>
		<article id="comment-<?php comment_ID(); ?>" class="comment">

			<?php echo get_avatar( $comment, apply_filters( 'truenews_comment_avatar_size', 56 ) ); ?>
			
			<div class="comment-des">

				<div class="arrow-comment"></div>

				<div class="comment-by">
					<p class="author" <?php hybrid_attr( 'comment-author' ); ?>><strong><span itemprop="name"><?php echo get_comment_author_link(); ?></span></strong></p>
					<?php
						printf( '<p class="date"><a href="%1$s" ' . hybrid_get_attr( 'comment-permalink' ) . '><time datetime="%2$s" ' . hybrid_get_attr( 'comment-published' ) . '>%3$s</time></a> - %4$s</p>',
							esc_url( get_comment_link( $comment->comment_ID ) ),
							get_comment_time( 'c' ),
							/* translators: 1: date, 2: time */
							sprintf( __( '%1$s at %2$s', 'truenews' ), get_comment_date(), get_comment_time() ),
							sprintf( __( '%1$sEdit%2$s', 'truenews' ), '<a href="' . get_edit_comment_link() . '" title="' . esc_attr__( 'Edit Comment', 'truenews' ) . '">', '</a>' )
						);
					?>
					<span class="reply">
						<?php comment_reply_link( array_merge( $args, array( 'reply_text' => __( 'Reply', 'truenews' ), 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
					</span><!-- .reply -->
				</div><!-- .comment-by -->

				<section class="comment-content comment" <?php hybrid_attr( 'comment-content' ); ?>>
					<?php if ( '0' == $comment->comment_approved ) : ?>
						<p class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'truenews' ); ?></p>
					<?php endif; ?>
					<?php comment_text(); ?>
				</section><!-- .comment-content -->

			</div><!-- .comment-des -->

		</article><!-- #comment-## -->
	<?php
		break;
	endswitch; // end comment_type check
}
endif;