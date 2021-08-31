<?php
/**
 * Template part for displaying results in search pages.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Eris
 */

?>

<div class="container container-small search-container">

	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

		<div class="search-post-type">
			<?php
				if ( get_post_type() == 'portfolio' || get_post_type() == 'jetpack-portfolio' )
					esc_html_e( 'portfolio', 'eris' );
				else
					echo get_post_type();
			 ?>
		</div>

		<?php

			// Display featured image
			if ( get_post_type() == 'portfolio' || get_post_type() == 'jetpack-portfolio' ) :
				eris_featured_image();
			endif;

		?>

		<div class="entry-header">
			<?php

				// Display header meta
				eris_entry_header();

			?>
		</div>

	</article><!-- #post-## -->

</div><!-- .container -->
