<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Eris
 */

$link_text    = get_post_meta( get_the_ID(), 'eris_link_text', true );
$link_title   = get_post_meta( get_the_ID(), 'eris_link_title', true );
$link_address = get_post_meta( get_the_ID(), 'eris_link_url', true );

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<div class="entry-content">

		<?php if ( is_search() ) { ?>

				<header class="entry-header">

					<!-- Entry header -->
					<?php eris_entry_header(); ?>

				</header><!-- .entry-header -->

		<?php }

            if ( is_single() ) {
                printf('<h2>%s</h2>', esc_html( $link_text ) );
            } else {
                printf('<h2 class="entry-title">%s</h2>', esc_html( $link_text ) );
            }

            printf( '<a href="%s">%s</a>', esc_url( $link_address ), esc_html( $link_title ) );

			the_content( sprintf(
				/* translators: %s: Name of current post. */
				wp_kses( __( 'Continue reading %s <span class="meta-nav">&rarr;</span>', 'eris' ), array( 'span' => array( 'class' => array() ) ) ),
				the_title( '<span class="screen-reader-text">"', '"</span>', false )
			) );

			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'eris' ),
				'after'  => '</div>',
			) );

		?>

	</div><!-- .entry-content -->

	<?php eris_entry_footer(); ?>

</article><!-- #post-## -->
