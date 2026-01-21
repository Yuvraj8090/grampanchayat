<!DOCTYPE html>
<html class="no-js" <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?> <?php hybrid_attr( 'body' ); ?>>

<div id="page" class="hfeed site clearfix">

	<div id="secondary-bar">

		<div class="container clearfix">

			<a id="primary-mobile-menu" href="#"><i class="fa fa-bars"></i></a>

			<span class="news-date"><i class="fa fa-clock-o"></i><?php echo apply_filters( 'truenews_today_date', date_i18n( 'l, j F Y' ) ); ?></span>
			
			<div class="form-search">
				<a href="#"><i class="fa fa-search"></i></a>
				<div class="search-dropdown">
					<form action="<?php echo esc_url( home_url( '/' ) ); ?>" class="navbar-form" role="search">
						<input type="text" name="s" id="s" placeholder="<?php esc_attr_e( 'Search', 'truenews' ); ?>">
						<button type="submit" name="submit" id="searchsubmit"><i class="fa fa-search"></i></button>
					</form>
				</div>
			</div>

			<?php get_template_part( 'menu', 'primary' ); // Loads the menu-primary.php template. ?>

			<?php truenews_social_links(); // Display the social icons. ?>

		</div><!-- container / End -->

	</div>

	<div id="content" class="site-content">

		<div class="container">

			<header id="masthead" class="site-header clearfix" role="banner" <?php hybrid_attr( 'header' ); ?>>

				<?php truenews_site_branding(); // Get the site title/logo. ?>

				<?php if ( of_get_option( 'truenews_header_ads' ) ) : ?>
					<div class="header-ad">
						<?php echo stripslashes( of_get_option( 'truenews_header_ads' ) ); ?>
					</div>
				<?php endif; ?>

			</header>

			<a id="secondary-mobile-menu" class="container" href="#"><i class="fa fa-bars"></i><span><?php _e( 'Menu', 'truenews' ); ?></span></a>

			<?php get_template_part( 'menu', 'secondary' ); // Loads the menu-secondary.php template. ?>

			<div class="clearfix"></div>
			
			<?php truenews_breaking_posts(); // Get the breaking posts. ?>