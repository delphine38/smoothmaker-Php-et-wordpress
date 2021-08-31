<?php
/**
Template Name: Accueil
 **/


$articles = new  WP_Query([
   "post_type" => "post",
   "orderby" => "date",
   "post_per_page" => 3
]);

get_header(); ?>

    <div id="primary" class="content-area">
        <main id="main" class="site-main" role="main">

            <div class="container container-small template-home">

                <h1>Ce titre est un h1</h1>

                <?php
                while ( have_posts() ) : the_post();

                get_template_part( 'templates/template-parts/content', 'page' );
                ?>

            </div><!-- .container.container-small -->

            <?php
            // If comments are open or we have at least one comment, load up the comment template.
            if ( comments_open() || get_comments_number() ) :
                comments_template();
            endif;

            endwhile; // End of the loop.
            ?>
            <div class="container">

            <div id="jp-relatedposts" class="jp-relatedposts">

        <!-- On remplace le h3 par un h2 -->
        <h2 class="jp-relatedposts-headline">Les derniers articles</h2>
        <div class="jp-relatedposts-items jp-relatedposts-items-visual">
            <div class="jp-relatedposts-items jp-relatedposts-items-visual">

                <?php

                /* Start the Loop */
                while ($articles->have_posts()) : $articles->the_post();
                    get_template_part('templates/template-parts/content', 'related');
                endwhile;

                ?>

            </div>
        </div>
    </div>

        </main><!-- #main -->
    </div><!-- #primary -->



<?php
get_sidebar();
get_footer();
