<?php
/**
 * eris functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Eris
 */

if ( ! function_exists( 'eris_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function eris_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on eris, use a find and replace
	 * to change 'eris' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'eris', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	// Add support for custom logo
	add_theme_support( 'custom-logo', array(
		'header-text' => array( 'site-title', 'site-description' ),
	) );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );

	// Image sizes
	add_image_size( 'eris-archive-image', 1100, 99999, false );
	add_image_size( 'eris-archive-image-portrait', 550, 99999, false );
	add_image_size( 'eris-search-image', 160, 99999, false );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'menu-1' => esc_html__( 'Primary menu', 'eris' ),
		'menu-2' => esc_html__( 'Side social menu', 'eris' )
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	/*
	 * Enable support for Post Formats.
	 * See https://developer.wordpress.org/themes/functionality/post-formats/
	 */
	add_theme_support( 'post-formats', array(
		'video',
		'gallery',
		'quote',
		'link'
	) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'eris_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );
}
endif;
add_action( 'after_setup_theme', 'eris_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
if ( ! function_exists( 'eris_content_width' ) ) :
function eris_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'eris_content_width', 1100 );
}
endif;
add_action( 'after_setup_theme', 'eris_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function eris_widgets_init() {

	// Define sidebars
	$sidebars = array(
		'sidebar-1' => esc_html__( 'Sidebar', 'eris' ),
		'sidebar-2' => esc_html__( 'Footer Widgets 1', 'eris' ),
		'sidebar-3' => esc_html__( 'Footer Widgets 2', 'eris' )
	);

	// Loop through each sidebar and register
	foreach ( $sidebars as $sidebar_id => $sidebar_name ) {
		register_sidebar( array(
			'name'          => $sidebar_name,
			'id'            => $sidebar_id,
			'description'   => sprintf ( esc_html__( 'Widget area for %s', 'eris' ), $sidebar_name ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		) );
	}

}
add_action( 'widgets_init', 'eris_widgets_init' );


/**
 * Registers an editor stylesheet for the theme.
 */
function eris_add_editor_styles() {
    add_editor_style( 'editor-style.css' );
}
add_action( 'admin_init', 'eris_add_editor_styles' );

/**
 * Enqueue scripts and styles.
 */
function eris_scripts() {

	// Google Fonts
	wp_enqueue_style( 'eris-font-enqueue', eris_font_url(), array(), null );

	// Main theme style
	wp_enqueue_style( 'thickbox' );
	wp_enqueue_style( 'eris-style', get_stylesheet_uri() );

	// Theme scripts
	wp_enqueue_script( 'eris-navigation', get_template_directory_uri() . '/assets/js/navigation.js', array(), '20151215', true );
	wp_enqueue_script( 'eris-skip-link-focus-fix', get_template_directory_uri() . '/assets/js/skip-link-focus-fix.js', array(), '20151215', true );
	wp_enqueue_script( 'spinner', get_template_directory_uri() . '/assets/js/spin/spin.min.js', array(), false, true );
	wp_enqueue_script( 'infinite-scroll', get_template_directory_uri() . '/assets/js/infinite-scroll/infinite-scroll.min.js', array( 'jquery', 'masonry' ), false, true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	wp_enqueue_script( 'thickbox' );
	wp_enqueue_script( 'eris-slick-slider', get_template_directory_uri() . '/assets/js/slick/slick.min.js', array(), false, true );

	if ( eris_is_split_layout() ) {
		wp_enqueue_script( 'scroll-to-fixed', get_template_directory_uri() . '/assets/js/scroll-to-fixed/scrolltofixed.min.js', array( 'jquery' ), false, true );
	}

	// Main JS file
	wp_enqueue_script( 'eris-call-scripts', get_template_directory_uri() . '/assets/js/common.js', array( 'jquery', 'jquery-effects-core', 'masonry' ), false, true );


	// Get and define JS vars
	global $wp_query;

	$max                  = $wp_query->max_num_pages;
	$paged                = ( get_query_var( 'paged' ) > 1 ) ? get_query_var( 'paged' ) : 1;
	$infinite_scroll_type = get_theme_mod( 'infinite_scroll_type', 'click' );
	$paging_type          = get_theme_mod( 'paging_setting', 'infinite-scroll' );

	if ( is_page_template( 'templates/portfolio-page.php' ) ) {
		if ( 'jetpack-portfolio' == get_post_type() ) {
			$type = 'jetpack-portfolio';
		}
		else {
			$type = 'portfolio';
		}
	} else {
		$type = 'posts';
	}

	$js_vars = array(
		'url'          => get_template_directory_uri(),
		'admin_url'    => admin_url( 'admin-ajax.php' ),
		'nonce'        => wp_create_nonce( 'ajax-nonce' ),
		'no_more_text' => esc_html__( 'No more posts to load.', 'eris' ),
		'startPage'    => $paged,
		'maxPages'     => $max,
		'is_type'      => $infinite_scroll_type,
		'paging_type'  => $paging_type,
		'posts_type'   => $type
	);
	wp_localize_script( 'eris-call-scripts', 'js_vars', $js_vars );

}
add_action( 'wp_enqueue_scripts', 'eris_scripts' );

/**
 * Enqueue admin scripts
 */
function eris_add_admin_scripts() {
	// Admin styles
	wp_enqueue_style( 'eris-admin-css', get_template_directory_uri() . '/inc/admin/admin.css' );
	wp_enqueue_style( 'wp-color-picker' );

	// Admin scripts
	wp_enqueue_media();
	wp_enqueue_script( 'my-upload' );
	wp_enqueue_script( 'jquery-ui' );
	wp_enqueue_script( 'wp-color-picker' );
	wp_enqueue_script( 'eris-admin-js', get_template_directory_uri() . '/inc/admin/admin.js' );

	// Customizer settings
	wp_enqueue_script( 'eris-customizer-scripts', get_template_directory_uri() . '/inc/customizer/js/customize-controls.js', array(), false, false );

	$js_vars = array(
		'url'                     => get_template_directory_uri(),
		'admin_url'               => admin_url( 'admin-ajax.php' ),
		'nonce'                   => wp_create_nonce( 'ajax-nonce' ),
		'default_text'            => esc_html__( 'Theme default', 'eris' ),
		'headings_font_variant'   => get_theme_mod( 'headings_font_weight', 'default' ),
		'text_font_variant'       => get_theme_mod( 'paragraphs_font_weight', 'default' ),
		'navigation_font_variant' => get_theme_mod( 'navigation_font_weight', 'default' )
	);
	wp_localize_script( 'eris-admin-scripts', 'js_vars', $js_vars );


}
add_action( 'admin_enqueue_scripts', 'eris_add_admin_scripts' );


/**
 * Adds theme default Google Fonts
 */
if ( ! function_exists( 'eris_font_url' ) ) :
function eris_font_url() {
    $fonts_url = '';

    /* Translators: If there are characters in your language that are not
    * supported by SK Modernist, translate this to 'off'. Do not translate
    * into your own language.
    */
    $sk_modernist    = esc_html_x( 'on', 'SK Modernist font: on or off', 'eris' );

    if ( 'off' === $sk_modernist ) {

		return;

	} else {

        return get_template_directory_uri() . '/assets/fonts/stylesheet.css';

    }
}
endif;

/**
 * Change theme color and fonts support
 */
if ( ! function_exists( 'eris_change_colors_fonts' ) ):
function eris_change_colors_fonts() {
	require get_template_directory() . '/inc/change-colors.php';
}
endif;
add_action( 'wp_head', 'eris_change_colors_fonts', '99' );

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';

/**
 * Load plugin activation script
 */
require get_template_directory() . '/inc/plugin-activation.php';

/**
 * Load Meta Boxes Config
 */
require get_template_directory() . '/inc/metadata/meta-boxes.php';


require_once get_parent_theme_file_path( '/inc/merlin/vendor/autoload.php' );
require_once get_parent_theme_file_path( '/inc/merlin/class-merlin.php' );
require_once get_parent_theme_file_path( '/inc/merlin-config.php' );

/**
 * Remove the child theme step.
 * This is for a Child theme.
 *
 * @since   0.1.0
 *
 * @return  $array  The merlin import steps.
 */
function remove_child_step($steps) {
	unset( $steps['child'] );
	return $steps;
}
add_filter( get_template() . '_merlin_steps', 'remove_child_step');

// Set up import files for Merlin
function merlin_local_import_files() {
	return array(
		array(
			'import_file_name'             => 'Demo',
			'import_file_url'            => 'https://tk-public-downloads.s3-eu-west-1.amazonaws.com/files/limpia/content.xml',
			'import_widget_file_url'     => 'https://tk-public-downloads.s3-eu-west-1.amazonaws.com/files/limpia/widgets.wie',
			'import_customizer_file_url' => 'https://tk-public-downloads.s3-eu-west-1.amazonaws.com/files/limpia/customizer.dat',
			'import_preview_image_url'     => 'https://tk-public-downloads.s3-eu-west-1.amazonaws.com/files/limpia/screenshot.png',
			'import_notice'                => __( 'Thank you!', 'eris' ),
			'preview_url'                  => 'http://themeskingdom.com/',
		),
	);
}
add_filter( 'merlin_import_files', 'merlin_local_import_files' );
