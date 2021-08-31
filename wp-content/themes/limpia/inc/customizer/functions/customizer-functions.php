<?php
/**
 * Customizer specific functions
 *
 * @package Eris
 */

/**
 * Generate divider to use in Customizer page
 */
if ( class_exists( 'WP_Customize_Control' ) ) :

    class WP_Customize_Divider_Control extends WP_Customize_Control {
        public $type = 'divider';

        public function render_content() {
            ?>
            <div class="customizer-divider"></div>
            <?php
        }
    }

endif;


// List 1 - 10
function eris_number_of_slides() {

    $results = array();

    for ( $i=1; $i <= 10; $i++ ) {
        $results[ $i ] = $i;
    }

    return $results;

}

// List all categories in dropdown
function eris_get_categories_select() {

    if ( taxonomy_exists( 'ct_portfolio' ) || taxonomy_exists( 'jetpack-portfolio-type' ) ) {

        if ( taxonomy_exists( 'jetpack-portfolio-type' ) ) {
            $teh_cats = get_terms( 'jetpack-portfolio-type' );
        } else if ( taxonomy_exists( 'ct_portfolio' ) && ( !class_exists( 'Jetpack' ) || !post_type_exists( 'jetpack-portfolio' ) ) ) {
            $teh_cats = get_terms( 'ct_portfolio' );
        }

        $results = array();

        $count = count( $teh_cats );

        $results['default'] = esc_html__( '-- Select --', 'eris' );

        if ( !empty( $teh_cats ) ) {
            for ( $i=0; $i < $count; $i++ ) {
                if ( isset( $teh_cats[$i] ) )
                    $results[$teh_cats[$i]->slug] = $teh_cats[$i]->name;
                else
                    $count++;
            }
            return $results;
        }

    }

}

