<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Eris
 */

$footer_copyright = get_theme_mod( 'eris_footer_copyright', '' );

?>

	</div><!-- #content -->

	<footer id="colophon" class="site-footer" role="contentinfo">

		<div class="container">

			<div class="row">


				<div class="col-7">
                        <div class="row">
                            <div class="col-6">
                                <?php eris_footer_widgets(); ?>
                                <h2>Archives</h2>
                                <p>avril 2018</p>
                                <p>mai 2018</p>
                                <p>juin 2018</p>
                            </div>
                            <div class="col-6">
                                <?php eris_footer_widgets(); ?>
                                <p class="">Rechercher</p>
                                <p>NEWSLETTER</p>
                                <p>Votre nom:</p>
                                <p>Votre email (obligatoire)</p>
                                <button class="btn btn-pimary">S'INSCRIRE</button>
                            </div>
                        </div><!-- .row -->
				</div><!-- .col-sm-6 -->




<hr>


			</div><!-- .row -->
            <div class="site-info col-sm-7">

                <?php if ( get_theme_mod( 'footer_title_enable', 1 ) ) : ?>

                    <div class="footer-site-branding">
                        <?php eris_display_logo_title(); ?>
                    </div>

                <?php endif; ?>

                <?php if ( '' == $footer_copyright ) { ?>

                    <a href="https://wordpress.org/"><?php printf( esc_html__( 'Proudly powered by %s', 'eris' ), 'WordPress' ); ?></a>
                    <span class="sep"> | </span>
                    <?php printf( esc_html__( 'Theme: %1$s by %2$s.', 'eris' ), wp_get_theme()->get( 'Name' ), '<a href="http://themeskingdom.com" rel="nofollow">Themes Kingdom</a>' ); ?>

                <?php } else {

                    printf( esc_html($footer_copyright), 'eris' );

                } ?>

            </div><!-- .site-info -->


        </div><!-- .container -->

	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
