<?php get_header(); ?>

	<div id="primary" class="content-area">
		<main id="more-content" class="site-main" role="main" <?php hybrid_attr( 'content' ); ?>>

			<section class="error-404 not-found">

				<header class="page-header">
					<h1 class="page-title"><?php _e( 'Oops! That page can&rsquo;t be found.', 'truenews' ); ?></h1>
				</header><!-- .page-header -->

				<div class="entry-content">
					<p><?php _e( 'Maybe the page was moved or deleted, or perhaps you just mistyped the address. Please, try to use the search form.', 'truenews' ); ?></p>
				</div><!-- .page-content -->
			</section><!-- .error-404 -->

		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>