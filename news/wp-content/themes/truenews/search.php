<?php get_header(); ?>

	<section id="primary" class="content-area">
		<main id="more-content" class="site-main" role="main" <?php hybrid_attr( 'content' ); ?>>

		<?php if ( have_posts() ) : ?>

			<header class="page-header" <?php hybrid_attr( 'loop-meta' ); ?>>
				<h1 class="page-title" <?php hybrid_attr( 'loop-title' ); ?>><?php printf( __( 'Search Results for: %s', 'truenews' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
			</header><!-- .page-header -->

			<?php /* Start the Loop */ ?>
			<?php while ( have_posts() ) : the_post(); ?>

				<?php get_template_part( 'content', 'search' ); ?>

			<?php endwhile; ?>

			<?php get_template_part( 'loop', 'nav' ); // Loads the loop-nav.php template ?>

		<?php else : ?>

			<?php get_template_part( 'content', 'none' ); ?>

		<?php endif; ?>

		</main><!-- #main -->
	</section><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
