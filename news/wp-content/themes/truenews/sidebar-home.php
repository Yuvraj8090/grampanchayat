<?php if ( is_active_sidebar( 'home' ) ) : // Return early if no widget found. ?>
	<div id="home-sidebar">
		<?php dynamic_sidebar( 'home' ); ?>
	</div>
<?php else : ?>
	<p><?php printf( __( 'To manage the content that appeared here. Please go to %1$sWidget%2$s page then add a few widgets to the Home sidebar.' , 'truenews' ), '<strong><a href="' . esc_url( admin_url( 'widgets.php' ) ) . '">', '</a></strong>' ); ?></p>
<?php endif; ?>