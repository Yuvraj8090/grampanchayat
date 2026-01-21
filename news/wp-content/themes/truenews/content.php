<article id="post-<?php the_ID(); ?>" <?php post_class( 'page-article' ); ?> <?php hybrid_attr( 'post' ); ?>>

	<?php if ( has_post_thumbnail() ) : ?>
		<div class="post-img">
			<a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_post_thumbnail( 'truenews-post', array( 'class' => 'entry-thumbnail', 'alt' => esc_attr( get_the_title() ) ) ); ?></a>
		</div>
	<?php endif; ?>

	<?php the_title( sprintf( '<h2 class="entry-title" ' . hybrid_get_attr( 'entry-title' ) . '><a href="%s" itemprop="url" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>

	<div class="entry-meta">
		<time class="entry-date updated" datetime="<?php echo esc_html( get_the_date( 'c' ) ); ?>" <?php hybrid_attr( 'entry-published' ); ?>><span><?php echo esc_html( get_the_date() ); ?></span></time>
		<?php if ( ! post_password_required() && ( comments_open() || '0' != get_comments_number() ) ) : ?>
			<span class="entry-comment"><?php comments_popup_link( __( '0 Comment', 'truenews' ), __( '1 Comment', 'truenews' ), __( '% Comments', 'truenews' ) ); ?></span>
		<?php endif; ?>
	</div>

	<div class="entry-summary" <?php hybrid_attr( 'entry-summary' ); ?>>
		<?php the_excerpt(); ?>
	</div>

	<?php if ( 'post' == get_post_type() ) : ?>
		<div class="more-link"><a href="<?php the_permalink(); ?>"><?php _e( 'Read Full Article', 'truenews' ); ?></a></div>
	<?php endif; ?>
	
</article><!-- #post-## -->
