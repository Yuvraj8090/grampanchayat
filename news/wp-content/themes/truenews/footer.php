		<?php truenews_carousel_posts(); // Get the Editor's Pick posts. ?>

		<footer id="colophon" class="site-footer clearfix" role="contentinfo" <?php hybrid_attr( 'footer' ); ?>>
			
			<div class="footer-top clearfix" aria-label="<?php echo esc_attr_x( 'Footer Sidebar', 'Sidebar aria label', 'truenews' ); ?>" <?php hybrid_attr( 'sidebar', 'footer' ); ?>>

				<div class="footer-column footer-column-1">
					<div id="bottom-logo">
						<?php if ( of_get_option( 'truenews_footer_logo' ) ) : ?>
							<span itemscope itemtype="http://schema.org/Brand">
								<a href="<?php the_permalink(); ?>" itemprop="url" rel="home"><img itemprop="logo" src="<?php echo esc_url( of_get_option( 'truenews_footer_logo' ) ); ?>" alt="<?php get_bloginfo( 'name' ); ?>"></a>
							</span>
						<?php endif; ?>
						<?php if ( of_get_option( 'truenews_summary' ) ) : ?>
							<p><?php echo stripslashes( of_get_option( 'truenews_summary' ) ); ?></p>
						<?php endif; ?>
					</div>
				</div>

				<div class="footer-column footer-column-2">
					<div class="footer-column-left footer-subcolumn">
						<?php dynamic_sidebar( 'footer-1' ); ?>
					</div>
					<div class="footer-column-right footer-subcolumn">
						<?php dynamic_sidebar( 'footer-2' ); ?>
					</div>
				</div>

				<div class="footer-column footer-column-3">
					<div class="footer-column-left footer-subcolumn">
						<?php dynamic_sidebar( 'footer-3' ); ?>
					</div>
					<div class="footer-column-right footer-subcolumn">
						<?php dynamic_sidebar( 'footer-4' ); ?>
					</div>
				</div>

				<div class="footer-column footer-column-4">
					<div class="footer-column-left footer-subcolumn">
						<?php dynamic_sidebar( 'footer-5' ); ?>
					</div>
					<div class="footer-column-right footer-subcolumn">
						<?php dynamic_sidebar( 'footer-6' ); ?>
					</div>
				</div>

			</div>

			<div id="site-bottom" class="clearfix">
				<div class="copyright">
					<p><?php printf( __( '&copy; Copyright %1$s %2$s', 'truenews' ), date( 'Y' ), '<a href=" ' . esc_url( home_url() ) . '">' . esc_attr( get_bloginfo( 'name' ) ) . '</a>' ); ?> &middot; <?php printf( __( 'Designed by %s', 'truenews' ), '<a href="http://www.theme-junkie.com/">Theme Junkie</a>' ); ?></p>
				</div>
			</div>

		</footer><!-- #colophon -->

	</div><!-- .container -->
</div><!-- #content -->
	
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
