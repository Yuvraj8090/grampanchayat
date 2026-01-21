<?php if ( has_nav_menu( 'primary' ) ) : // Check if there's a menu assigned to the 'primary' location. ?>

	<nav id="primary-nav" class="primary-navigation" role="navigation" <?php hybrid_attr( 'menu' ); ?>>

		<?php wp_nav_menu(
			array(
				'theme_location'  => 'primary',
				'container'       => '',
				'menu_id'         => 'primary-menu',
				'menu_class'      => 'menu-primary-items sf-menu',
			)
		); ?>

	</nav><!-- #site-navigation -->

<?php endif; // End check for menu. ?>