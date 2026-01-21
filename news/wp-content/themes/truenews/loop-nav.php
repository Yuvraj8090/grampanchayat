<?php if ( is_singular( 'post' ) ) : // If viewing a single post page. ?>

	<div class="post-nav clearfix">
		<?php previous_post_link( '<p class="post-nav-prev">' . __( '<i class="fa fa-angle-left"></i>%link', 'theworld' ) . '</p>', '%title' ); ?>
		<?php next_post_link( '<p class="post-nav-next">' . __( '%link<i class="fa fa-angle-right"></i>', 'theworld' ) . '</p>', '%title' ); ?>
	</div><!-- .loop-nav -->

<?php elseif ( is_home() || is_archive() || is_search() ) : // If viewing the blog, an archive, or search results. ?>

	<?php loop_pagination(
		array( 
			'prev_text' => _x( '&larr; Previous', 'posts navigation', 'truenews' ), 
			'next_text' => _x( 'Next &rarr;',     'posts navigation', 'truenews' )
		) 
	); ?>

<?php endif; // End check for type of page being viewed. ?>