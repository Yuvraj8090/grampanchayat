<?php get_header(); ?>

	<div id="primary" class="content-area uk-width-1-1 uk-width-large-7-10 site-content-left clearfix">
		<main id="main" class="site-main main-content" role="main">

		<?php if ( have_posts() ) : ?>

			<?php
				$class  = $html = '';
				$layout = of_get_option( 'aquamag_posts_layout', 'list' );

				if ( $layout === 'list' ) {
					$class = 'author-list';
				} else {
					$class = 'author-grid';
				}
			?>

			<div class="<?php echo $class; ?> border-style recent-post">

				<h2><?php _e( 'Latest Articles', 'aquamag' ) ?></h2>

				<div class="uk-clearfix"></div>
				
				<?php if ( $layout === 'list' ) { ?>
					<div class="list-view">
				<?php } else { ?>
					<div class="uk-grid grid-view uk-clearfix"  data-uk-grid-match>
				<?php } ?>

					<?php while ( have_posts() ) : the_post(); ?>

						<?php if ( $layout === 'grid' ) { ?>
							<div class="uk-width-1-1 uk-width-medium-1-3">
						<?php } ?>

							<?php get_template_part( 'content', get_post_format() ); ?>

						<?php if ( $layout === 'grid' ) { ?>
							</div>
						<?php } ?>

					<?php endwhile; ?>

				<?php if ( $layout === 'list' ) { ?>
					</div>
				<?php } else { ?>
					</div>
				<?php } ?>

			</div>

			<?php get_template_part( 'loop', 'nav' ); // Loads the loop-nav.php template ?>

		<?php else : ?>

			<?php get_template_part( 'content', 'none' ); ?>

		<?php endif; ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
