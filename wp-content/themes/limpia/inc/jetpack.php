<?php
/**
 * Jetpack Compatibility File.
 *
 * @link https://jetpack.me/
 *
 * @package Eris
 */

/**
 * Jetpack setup function.
 *
 * See: https://jetpack.me/support/responsive-videos/
 */
if ( ! function_exists( 'eris_jetpack_setup' ) ) :
function eris_jetpack_setup() {

	// Add theme support for Responsive Videos.
	add_theme_support( 'jetpack-responsive-videos' );

	// Add theme support for JetPack Portfolio
	add_theme_support( 'jetpack-portfolio' );

	// Add excerpt functionality to jetpack portfolio projects
	add_post_type_support( 'jetpack-portfolio', 'excerpt' );

	// Add Featured Content Support
	add_theme_support( 'featured-content', array(
		'filter'     => 'eris_get_featured_posts',
		'post_types' => 'jetpack-portfolio'
	) );
}
endif;
add_action( 'after_setup_theme', 'eris_jetpack_setup' );

if ( ! function_exists( 'eris_remove_jp_infinite_scroll' ) ) :
function eris_remove_jp_infinite_scroll( $modules ) {
	if( isset( $modules['infinite-scroll'] ) ) {
		unset( $modules['infinite-scroll'] );
	}
	unset( $modules['custom-content-types'] );

	return $modules;
}
endif;
add_filter( 'jetpack_get_available_modules', 'eris_remove_jp_infinite_scroll' );

/**
 * Featured posts filter function
 */
if ( ! function_exists( 'eris_get_featured_posts' ) ) :
function eris_get_featured_posts() {
    return apply_filters( 'eris_get_featured_posts', array() );
}
endif;

/**
 * Removing JP Related posts so it can be moved to other location
 */
if ( ! function_exists( 'jetpackme_remove_rp' ) ) :
function jetpackme_remove_rp() {
    if ( class_exists( 'Jetpack_RelatedPosts' ) ) {
        $jprp = Jetpack_RelatedPosts::init();
        $callback = array( $jprp, 'filter_add_target_to_dom' );
        remove_filter( 'the_content', $callback, 40 );
    }
}
endif;
add_filter( 'wp', 'jetpackme_remove_rp', 20 );

 /**
 * A helper conditional function that returns a boolean value.
 */
 if ( ! function_exists( 'eris_has_featured_posts' ) ) :
function eris_has_featured_posts() {
	return (bool) eris_get_featured_posts();
}
endif;
