<?php get_header(); ?>

	<div id="primary" class="content-area">
		<main id="more-content" class="site-main" role="main" <?php hybrid_attr( 'content' ); ?>>

		<?php while ( have_posts() ) : the_post(); ?>

			<?php get_template_part( 'content', 'single' ); ?>

			<?php truenews_post_author(); // Display the post author informations. ?>

			<?php get_template_part( 'loop', 'nav' ); // Loads the loop-nav.php template  ?>

			<?php
				// If comments are open or we have at least one comment, load up the comment template
				if ( comments_open() || '0' != get_comments_number() ) :
					comments_template();
				endif;
			?>

		<?php endwhile; // end of the loop. ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>