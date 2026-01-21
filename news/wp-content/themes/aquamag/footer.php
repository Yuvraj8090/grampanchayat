			</div><!-- .uk-grid -->
		</div><!-- .uk-container -->
	</div><!-- #content -->

	<footer id="colophon" class="site-footer footer-main" role="contentinfo">
		
		<div class="footer-top">
			<div class="uk-container uk-container-center">
				<div class="uk-grid" data-uk-grid-match>
					
					<div class="uk-width-1-1 uk-width-small-2-4 uk-width-medium-1-4">
						<?php dynamic_sidebar( 'footer-1' ); ?>
					</div>

					<div class="uk-width-1-1 uk-width-small-2-4 uk-width-medium-1-4">
						<?php dynamic_sidebar( 'footer-2' ); ?>
					</div>

					<div class="uk-width-1-1 uk-width-small-2-4 uk-width-medium-1-4">
						<?php dynamic_sidebar( 'footer-3' ); ?>
					</div>

					<div class="uk-width-1-1 uk-width-small-2-4 uk-width-medium-1-4">
						<?php dynamic_sidebar( 'footer-4' ); ?>
					</div>

				</div>
			</div>
		</div>

		<div class="footer-bottom">
			<div class="uk-container uk-container-center">

				<div class="footer-bottom-left">
					<p><?php printf( __( '&copy; Copyright %1$s %2$s', 'rexus' ), date( 'Y' ), '<a href=" ' . esc_url( home_url() ) . '">' . esc_attr( get_bloginfo( 'name' ) ) . '</a>.' );?>
					<span class="copyright"><?php printf( __( 'Proudly designed by %s', 'rexus' ), '<a href="http://www.theme-junkie.com/">Theme Junkie</a>.' ); ?></span></p>
				</div>

				<div class="footer-bottom-right">
				 	<?php aquamag_social_links(); ?>
				</div>
			
			</div>
		</div>

	</footer><!-- #colophon -->
	
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
