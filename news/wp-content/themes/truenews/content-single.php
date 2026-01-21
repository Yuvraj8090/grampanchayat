<article id="post-<?php the_ID(); ?>" <?php post_class( 'post' ); ?> <?php hybrid_attr( 'post' ); ?>>
	
	<?php the_title( '<h1 class="entry-title" ' . hybrid_get_attr( 'entry-title' ) . '>', '</h1>' ); ?>

	<div class="post-share clearfix">

		<?php if ( 'post' == get_post_type() ) : ?>
			<div class="entry-meta">
				<?php truenews_posted_on(); ?>
			</div><!-- .entry-meta -->
		<?php endif; ?>

		<?php truenews_social_share(); ?>

	</div>

	<div class="entry-content" <?php hybrid_attr( 'entry-content' ); ?>>
		<?php the_content(); ?>
		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'truenews' ),
				'after'  => '</div>',
			) );
		?>

		<?php
			$tag_list = get_the_tag_list();
			if ( $tag_list ) : 
		?>
			<p class="entry-tags" <?php hybrid_attr( 'entry-terms', 'post_tag' ); ?>><?php echo $tag_list; ?></p>
		<?php endif; ?>

		<?php edit_post_link( __( 'Edit', 'truenews' ), '<span class="edit-link">', '</span>' ); ?>
	</div><!-- .entry-content -->
	
</article><!-- #post-## -->
