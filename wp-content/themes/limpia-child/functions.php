<?php
//chargement de la feuille de style

function wpchild_loadfiles(){
    wp_enqueue_style("wpchild-style",get_template_directory_uri().
    "/style.css");
}
/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 *
 * ma version de fonction
 */
function ah_widgets_init() {

    // Define sidebars
    $sidebars = array(
        'sidebar-1' => esc_html__( 'Sidebar', 'eris' ),
        'sidebar-2' => esc_html__( 'Footer Widgets 1', 'eris' ),
        'sidebar-3' => esc_html__( 'Footer Widgets 2', 'eris' ),
        'sidebar-4' => esc_html__( 'Footer Widgets 3', 'eris' )
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
add_action( 'widgets_init', 'ah_widgets_init' ,20 );

add_action("wp_enqueue_scripts", "wpchild_loadfiles");
