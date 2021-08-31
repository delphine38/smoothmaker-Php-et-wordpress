<?php
/**
 * Eris Theme Customizer.
 *
 * @package Eris
 */

// Load Customizer specific functions
require get_template_directory() . '/inc/customizer/functions/customizer-functions.php';
require get_template_directory() . '/inc/customizer/functions/customizer-sanitization.php';

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function eris_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

    require_once trailingslashit( get_template_directory() ) . 'inc/customizer/functions/customizer-text-editor.php';


    $wp_customize->remove_section('background_image');

    // Remove default Colors section
    $wp_customize->remove_section( 'colors' );

    $my_theme = wp_get_theme();
    if ( $my_theme->exists() ) {
        $theme_name = $my_theme;
    } else {
        $theme_name = esc_html__( 'Eris', 'eris' );
    }

    /**
     * PANELS
     */

    // Shop Settings Panel
    $wp_customize->add_panel( 'eris_colors_panel', array(
        'title'       => esc_html__( 'Color Settings', 'eris' ),
        'description' => esc_html__( 'For customizing theme colors', 'eris' ),
        'priority'    => 190
    ) );

	/**
     * PANELS
     */
    $wp_customize->add_panel( 'theme_options_panel', array(
        'priority'    => 200,
        'capability'  => 'edit_theme_options',
        'title'       => esc_html__( 'Theme Settings', 'eris' ),
        'description' => $theme_name . esc_html__( ' Theme Settings', 'eris' )
    ) );


    /**
     * SECTIONS AND SETTINGS
     */

    // Header settings
    require get_template_directory() . '/inc/customizer/settings/customizer-header.php';

    // Slider Settings
    require get_template_directory() . '/inc/customizer/settings/customizer-paging.php';

    // Customizer Colors
    require get_template_directory() . '/inc/customizer/settings/customizer-colors.php';

    // Footer copyright
    require get_template_directory() . '/inc/customizer/settings/customizer-footer.php';


}
add_action( 'customize_register', 'eris_customize_register' );

// if Kirki installed

if(class_exists( 'Kirki' )){

    // Google fonts
    require get_template_directory() . '/inc/customizer/settings/customizer-google-fonts.php';

}

add_action( 'wp_head', 'eris_add_loader_styles_to_header', 100 );
function eris_add_loader_styles_to_header() {
    ?>
    <style>
        .kirki-customizer-loading-wrapper {
            background-image: none !important;
        }
    </style>
    <?php
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function eris_customize_preview_js() {
	wp_enqueue_script( 'eris-customizer', get_template_directory_uri() . '/assets/js/customizer.js', array( 'customize-preview' ), '20151215', true );
}
add_action( 'customize_preview_init', 'eris_customize_preview_js' );
