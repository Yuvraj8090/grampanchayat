<?php if ( has_nav_menu( 'secondary' ) ) : // Check if there's a menu assigned to the 'primary' location. ?>

	<nav id="secondary-nav" class="secondary-navigation" role="navigation" <?php hybrid_attr( 'menu' ); ?>>

		<?php wp_nav_menu(
			array(
				'theme_location'  => 'secondary',
				'container'       => '',
				'menu_id'         => 'secondary-menu',
				'menu_class'      => 'sf-menu menu-primary-items',
				'walker'          => new TrueNews_Custom_Nav_Walker
			)
		); ?>

		<div class="news-search">
			<form action="<?php echo esc_url( home_url( '/' ) ); ?>" role="search">
				<input class="n-search" type="text" name="s" id="s" placeholder="<?php esc_attr_e( 'Search &hellip;', 'truenews' ); ?>">
				<button type="submit" name="submit" id="searchsubmit"><i class="fa fa-search"></i></button>
			</form>
		</div>

	</nav><!-- #site-navigation -->

<?php endif; // End check for menu. ?>