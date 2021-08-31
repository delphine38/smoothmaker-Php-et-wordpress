<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Eris
 */

$quote_text   = get_post_meta( get_the_ID(), 'eris_quote', true );
$quote_author = get_post_meta( get_the_ID(), 'eris_quote_author', true );

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<div class="entry-content">

		<?php if ( is_search() ) { ?>

				<header class="entry-header">

					<!-- Entry header -->
					<?php eris_entry_header(); ?>

				</header><!-- .entry-header -->

		<?php }

			printf( '<blockquote>%s</blockquote><cite>%s</cite>', esc_html( $quote_text ), esc_html( $quote_author ) );

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

