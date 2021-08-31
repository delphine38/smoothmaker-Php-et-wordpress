<?php
/**
 * Content for Related posts on single post page
 *
 * @package  Eris
 */
?>

<div class="jp-relatedposts-post jp-relatedposts-post-thumbs">

    <a class="jp-relatedposts-post-a" href="<?php the_permalink(); ?>" title="<?php echo esc_attr( get_the_title() ); ?>">

        <?php

            if ( 'gallery' == get_post_format() ) :

                $gallery_images = get_post_meta( get_the_ID(), 'eris_repeatable', true );

                if ( $gallery_images ) {
                    printf( '<img src="%s" alt="post-gallery-image">', esc_url( $gallery_images[0] ) );
                } else {
                    the_post_thumbnail( 'eris-archive-image-portrait' );
                }

            else :

                the_post_thumbnail( 'eris-archive-image-portrait' );

            endif;
        ?>

    </a>

    <h4 class="jp-relatedposts-post-title">
        <a class="jp-relatedposts-post-a" href="<?php the_permalink(); ?>" title="<?php echo esc_attr( get_the_title() ); ?>">
            <?php the_title(); ?>
        </a>
    </h4>

    <p class="jp-relatedposts-post-context">
        <?php

            esc_html_e( 'In ', 'eris' );

            if ( taxonomy_exists( 'jetpack-portfolio-type' ) && 'jetpack-portfolio' == get_post_type() ) {
                $categories_list = get_the_term_list( get_the_ID(), 'jetpack-portfolio-type', '', ', ', '' );
            } elseif ( 'portfolio' == get_post_type() && ( !class_exists( 'Jetpack' ) || !post_type_exists( 'jetpack-portfolio' ) ) ) {
                $categories = get_the_term_list( get_the_ID(), 'ct_portfolio', '', ', ', '' );
            } else {
                $categories = get_the_category();
            }

            if ( ! empty( $categories ) ) {

                if ( 'portfolio' == get_post_type() || 'jetpack-portfolio' == get_post_type() ) {
                    printf( $categories );
                } else {
                    echo esc_html( $categories[0]->name );
                }

            }

        ?>
    </p>

</div>
