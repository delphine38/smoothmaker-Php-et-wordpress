<?php
/**
 * The template for displaying all single posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Eris
 */

get_header(); ?>

	<?php while ( have_posts() ) : the_post(); ?>

		<div class="container container-medium">

			<div class="hero">
	    		<!-- Featured media -->
	    		<?php eris_featured_media(); ?>

	    		<div class="entry-header">
	    			<!-- Entry header -->
	    			<?php eris_entry_header(); ?>
	    		</div>
			</div>

		</div><!-- .container.container-medium -->

		<div id="primary" class="content-area">
			<main id="main" class="site-main" role="main">

				<div class="container container-small">

					<?php

						if ( 'link' == get_post_format() || 'quote' == get_post_format() ) {
							get_template_part( 'templates/template-parts/content', get_post_format() );
						} else {
							get_template_part( 'templates/template-parts/content', 'single' );
						}

						// Author box
						eris_author_box();

					?>

				</div><!-- .container.container-small -->

				<div class="container">
					<?php

						// Display Related posts
						eris_related_posts();

						// Post navigation
						the_post_navigation();

					?>
				</div>

				<?php
					// If comments are open or we have at least one comment, load up the comment template.
					if ( comments_open() || get_comments_number() ) :
						comments_template();
					endif;

				?>

			</main><!-- #main -->
		</div><!-- #primary -->

	<?php endwhile; // End of the loop. ?>

<?php

get_footer();
