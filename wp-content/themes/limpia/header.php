<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Eris
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<?php get_sidebar(); ?>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#main"><?php esc_html_e( 'Skip to content', 'eris' ); ?></a>

	<header id="masthead" class="site-header" role="banner">
		<div class="container container-big">

			<div class="site-branding">

				<?php

					// Display logo and / or title
					eris_display_logo_title();

					$description = get_bloginfo( 'description', 'display' );
					if ( $description || is_customize_preview() ) :
						printf( '<p class="site-description">%s</p>', esc_html( $description ) );
					endif;

				?>

			</div><!-- .site-branding -->

			<nav id="site-navigation" class="main-navigation" role="navigation">
				<?php printf( '<button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false"><i>%1$s</i>%2$s<span>%3$s</span></button>', esc_html__( 'Menu', 'eris' ), esc_html__( 'Primary Menu', 'eris' ), '&nbsp;' ); ?>


				<?php wp_nav_menu( array( 'theme_location' => 'menu-1', 'menu_id' => 'primary-menu' ) ); ?>
				<i id="menuMarker"><?php esc_html_e( 'Menu', 'eris' ) ?></i>
			</nav><!-- #site-navigation -->

			<!-- Search form -->
			<div class="search-wrap">
				<?php get_search_form(); ?>
				<div class="search-instructions"><?php esc_html_e( 'Press Enter / Return to begin your search.', 'eris' ); ?></div>
				<button id="big-search-close">
					<span class="screen-reader-text"><?php esc_html_e( 'close search form', 'eris' ); ?></span>
				</button>
			</div>
			<a href="#" id="big-search-trigger">
				<span class="screen-reader-text"><?php esc_html_e( 'open search form', 'eris' ); ?></span>
				<i class="icon-search"></i>
			</a>

			<!-- Sidebar trigger -->
			<?php if ( is_active_sidebar( 'sidebar-1' ) ) : ?>

				<a href="#" id="sidebar-trigger" class="sidebar-trigger">
					<span class="screen-reader-text"><?php esc_html_e( 'open sidebar', 'eris' ); ?></span>
					<i class="icon-sidebar"></i>
				</a>

			<?php endif; ?>

		</div><!-- .container -->
	</header><!-- #masthead -->

	<a href="#" id="scrollDownBtn" class="scroll-down"><i class="icon-left"></i><?php esc_html_e( 'scroll to discover more', 'eris' ); ?></a>
	<a href="#" id="scrollUpBtn" class="scroll-up"><?php esc_html_e( 'back to top', 'eris' ); ?><i class="icon-right"></i></a>

	<!-- Social menu -->
	<?php eris_social_menu(); ?>

	<!-- Featured Portfolio Slider -->
	<?php

		if ( is_page_template( 'templates/portfolio-page.php' ) && ! is_paged() ) :

			if ( 'slider' == get_theme_mod( 'portfolio_header_setting', 'slider' ) ) {
				eris_portfolio_template_slider();
			}

			if ( 'headline' == get_theme_mod( 'portfolio_header_setting', 'slider' ) ) {

				if ( '' != get_theme_mod( 'portfolio_headline_text' ) ) { ?>

				<div class="hero">
					<div class="container">
						<div class="entry-content">
							<?php printf( get_theme_mod( 'portfolio_headline_text' ) ); ?>
						</div>
					</div><!-- .container -->
				</div>

		<?php 	} else {
					while ( have_posts() ) : the_post();
						if ( '' != get_the_content() ) { ?>
							<div class="hero">
								<div class="container">
									<div class="entry-content">
										<?php the_content(); ?>
									</div>
								</div><!-- .container -->
							</div>

				<?php
						}
					endwhile;
				}


			}

		endif;

	?>

	<div id="content" class="site-content">

