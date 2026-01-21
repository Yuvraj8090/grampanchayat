<?php
/**
 * Template Name: Home template
 */
get_header(); ?>

	<div id="primary" class="content-area">

		<?php truenews_featured_posts(); // Get the featured posts. ?>

		<main id="more-content" class="site-main" role="main" <?php hybrid_attr( 'content' ); ?>>

			<?php get_sidebar( 'home' ); ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>