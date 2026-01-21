<?php get_header(); ?>

	<div id="primary" class="content-area">
		<main id="more-content" class="site-main" role="main" <?php hybrid_attr( 'content' ); ?>>

		<?php if ( have_posts() ) : ?>
			
			<header class="page-header" <?php hybrid_attr( 'loop-meta' ); ?>>
				<h1 class="page-title" <?php hybrid_attr( 'loop-title' ); ?>><?php _e( 'Latest Posts', 'truenews' ); ?></h1>
			<header>

			<?php /* Start the Loop */ ?>
			<?php while ( have_posts() ) : the_post(); ?>

				<?php get_template_part( 'content', 'index' ); ?>

			<?php endwhile; ?>

			<?php get_template_part( 'loop', 'nav' ); // Loads the loop-nav.php template ?>

		<?php else : ?>

			<?php get_template_part( 'content', 'none' ); ?>

		<?php endif; ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
