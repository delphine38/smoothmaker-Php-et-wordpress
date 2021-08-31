<?php
/**
 * Change colors regarding user choices in customizer
 *
 * @package Eris
 */

/**
 * GENERAL THEME COLORS
 */

$headings_color           = get_theme_mod( 'eris_heading_color', '#000' );
$heading_link_hover_color = get_theme_mod( 'eris_heading_hover_color', '#747474' );
$paragraph_color          = get_theme_mod( 'eris_paragraph_color', '#5d5d5d' );
$link_color               = get_theme_mod( 'eris_link_color', '#000' );
$link_hover_color         = get_theme_mod( 'eris_link_hover_color', '#5d5d5d' );
$meta_link_color          = get_theme_mod( 'eris_meta_link_color', '#000' );
$meta_link_hover_color    = get_theme_mod( 'eris_meta_link_hover_color', '#808080' );
$background_color         = get_theme_mod( 'eris_body_bg_color', '#fff' );

/**
 * SLIDER COLORS
 */

// Blog Header Colors
$slider_links_color       = get_theme_mod( 'eris_slider_links_color', '#000' );
$slider_links_hover_color = get_theme_mod( 'eris_slider_links_hover_color', '#808080' );
$slider_background_color  = get_theme_mod( 'eris_slider_bg_color', '#e8eaec' );

/**
 * HEADER COLORS
 */

// Blog Header Colors
$navigation_color       = get_theme_mod( 'eris_navigation_color', '#000' );
$navigation_hover_color = get_theme_mod( 'eris_navigation_hover_color', '#808080' );
$logo_color             = get_theme_mod( 'eris_logo_color', '#000' );
$logo_hover_color       = get_theme_mod( 'eris_logo_hover_color', '#000' );
$logo_description_color = get_theme_mod( 'eris_logo_description_color', '#000' );


/**
 * FOOTER COLORS
 */

// Footer colors
$footer_text_color        = get_theme_mod( 'eris_footer_text_color', '#000' );
$footer_links_color       = get_theme_mod( 'eris_footer_links_color', '#000' );
$footer_links_hover_color = get_theme_mod( 'eris_footer_links_hover_color', '#5d5d5d' );
$comments_background_color    = get_theme_mod( 'eris_comments_background_color', '#eaedf3' );


?>
<style type="text/css">

    /* Body BG color */

    body,
    body.custom-background,
    #content,
    .shuffle-layout .entry-meta,
    .page-template-portfolio-page .site-content,
    .page-template-portfolio-page .site-footer,
    .sticky-header header.site-header {
        background-color: <?php echo esc_attr( $background_color ); ?>;
    }

    .featured-slider-wrap {
        background-color: <?php echo esc_attr( $slider_background_color ); ?>;
    }

    /* Headings color */

    h1, h2, h3, h4, h5, h6,
    h1 a, h2 a, h3 a, h4 a, h5 a, h6 a,
    .archive.category .page-title span,
    .archive.tag .page-title span,
    .archive.date .page-title span,
    .archive.author .page-title span,
    .search .page-title span,
    .search-results .page-title,
    .tag.archive .page-title,
    .comments-title span,
    .comment-author,
    .search-post-type,
    .bypostauthor > .comment-body .comment-author b:after,
    .entry-content h1,
    .entry-content h2,
    .entry-content h3,
    .entry-content h4,
    .entry-content h5,
    .entry-content h6,
    .page-content h1,
    .page-content h2,
    .page-content h3,
    .page-content h4,
    .page-content h5,
    .page-content h6,
    .nav-links,
    .format-quote blockquote,
    .emphasis,
    .entry-content .emphasis,
    .page-content .emphasis,
    .single .entry-content .emphasis,
    .single .format-quote blockquote,
    .single .format-quote q,
    .single .format-link .entry-content p,
    .single .format-link  .row-columns,
    .masonry .format-link .entry-content h2,
    .single .format-link .entry-content h2,
    .entry-content blockquote,
    .entry-content blockquote p,
    .page-content blockquote,
    .page-content blockquote p,
    .comment-content blockquote p,
    .single .entry-content blockquote p,
    .archive .page-title span,
    .search .page-title span,
    .error404 .page-title span,
    .site-footer .widget-title,
    .site-footer .widget .widget-title a,
    .author-box p,
    .dropcap:before {
        color: <?php echo esc_attr( $headings_color ); ?>;
    }

    /* Paragraph color */

    .entry-content p,
    .entry-content li,
    .page-content p,
    .page-content li,
    .comment-content p,
    .comment-content li,
    .comment-content dd,
    label,
    blockquote cite,
    blockquote + cite,
    blockquote + p cite,
    q cite,
    q + cite,
    q + p cite,
    .wp-caption-text,
    .format-quote blockquote cite,
    .format-quote blockquote + cite,
    .format-quote q cite,
    .format-quote q + cite,
    .format-quote blockquote + p cite,
    .format-quote q + p cite,
    .site-footer .widget p,
    .jp-relatedposts-post-context,
    .row-columns,
    .headline-template .hero .entry-content,
    .headline-template .hero p,
    .single-portfolio-headline .hero p,
    .contact .entry-content p,
    .contact .row-columns,
    .wp-block-separator.is-style-dots:before,
    .wp-block-image figcaption,
    .wp-block-embed figcaption {
        color: <?php echo esc_attr( $paragraph_color ); ?>;
    }

    hr,
    .wp-block-separator {
        background-color: <?php echo esc_attr( $paragraph_color ); ?>;
    }

    /* Link color */

    a,
    a.emphasis,
    .format-link .entry-content p,
    blockquote:before,
    q:before,
    .listing .format-link .entry-content:before,
    .single .format-link .entry-content:before,
    .format-link  .row-columns,
    .no-results input[type="search"],
    .error-404 input[type="search"],
    .no-results .search-instructions,
    .error-404 .search-instructions,
    .search .page-title span,
    .gallery-count,
    .entry-footer,
    .nav-links a,
    .read-more-link,
    .widget-title,
    .widget .widget-title a,
    .widget_calendar caption,
    .widget_calendar th,
    .widget_calendar tfoot a,
    .widget .search-form input[type="submit"]:focus,
    .widget .newsletter input[type="submit"]:focus,
    .paging-navigation a,
    .paging-navigation .dots,
    .paging-navigation .prev,
    .paging-navigation .next,
    .contact-form label,
    .contact-form textarea,
    .contact-form input[type="text"],
    .contact-form input[type="email"],
    body #infinite-handle span,
    .category-filter a,
    .category-filter .cat-active a,
    .gallery-caption,
    .entry-gallery .gallery-size-full:after,
    .featured-slider .slick-dots button,
    body .single-soc-share-link a,
    .comment-metadata a,
    .comment .reply a,
    .comment-metadata > * + *:before,
    .widget_wpcom_social_media_icons_widget a {
        color: <?php echo esc_attr( $link_color ); ?>;
    }

    .contact-form input[type="text"]::-webkit-input-placeholder,
    .contact-form input[type="email"]::-webkit-input-placeholder,
    .no-results input[type="search"]::-webkit-input-placeholder,
    .error-404 input[type="search"]::-webkit-input-placeholder {
        color: <?php echo esc_attr( $link_color ); ?>;
    }

    .contact-form input[type="text"]::-moz-placeholder,
    .contact-form input[type="email"]::-moz-placeholder,
    .no-results input[type="search"]::-moz-placeholder,
    .error-404 input[type="search"]::-moz-placeholder {
        color: <?php echo esc_attr( $link_color ); ?>;
    }

    .contact-form input[type="text"]:-moz-placeholder,
    .contact-form input[type="email"]:-moz-placeholder,
    .no-results input[type="search"]:-moz-placeholder,
    .error-404 input[type="search"]:-moz-placeholder {
        color: <?php echo esc_attr( $link_color ); ?>;
    }

    .site-header input[type="search"]:-ms-input-placeholder,
    .no-results input[type="search"]:-ms-input-placeholder,
    .error-404 input[type="search"]:-ms-input-placeholder {
        color: <?php echo esc_attr( $link_color ); ?>;
    }

    input[type="text"]:focus,
    input[type="email"]:focus,
    input[type="tel"]:focus,
    input[type="url"]:focus,
    input[type="password"]:focus,
    input[type="search"]:focus,
    textarea:focus {
        border-color: <?php echo esc_attr( $link_color ); ?>;
    }

    .entry-meta a,
    .posts-navigation .entry-meta a,
    #infinite-handle a,
    .single .nav-links a,
    .archive.category .page-title,
    .archive.tag .page-title,
    .archive.date .page-title,
    .archive.author .page-title,
    .entry-footer a,
    .author-name span,
    .site-footer .widget_recent_comments .comment-author-link a,
    .site-footer .widget_recent_comments li,
    .site-footer .widget_recent_entries li,
    .site-footer .rss-date {
        color: <?php echo esc_attr( $meta_link_color ); ?>;
    }

    /* Header color */

    .nav-menu > li > a,
    .standard-menu .main-navigation ul ul a,
    .dropdown-toggle,
    #big-search-trigger,
    .menu-toggle:before,
    .sidebar-trigger,
    .scroll-up,
    .scroll-down,
    .menu-social-container a,
    .menu-social-container .social-menu-trig:before {
        color: <?php echo esc_attr( $navigation_color ); ?>;
    }

    .main-navigation .current_page_item > a,
    .main-navigation .current-menu-item > a,
    .main-navigation .current_page_ancestor > a {
        border-color: <?php echo esc_attr( $navigation_color ); ?>;
    }

    .menu-toggle span,
    .menu-toggle span:before,
    .menu-toggle span:after,
    .hamburger-menu .menu-toggle span,
    .hamburger-menu .menu-toggle span:before,
    .hamburger-menu .menu-toggle span:after {
        background-color: <?php echo esc_attr( $navigation_color ); ?>;
    }

    /* Logo color */

    .site-title a {
        color: <?php echo esc_attr( $logo_color ); ?>;
    }

    .site-description {
        color: <?php echo esc_attr( $logo_description_color ); ?>;
    }

    /* Fullwidth slider colors */

    .featured-slider .portfolio-item h2 a,
    .featured-slider .slick-arrow:before,
    .featured-slider .slick-dots li,
    .featured-slider .slick-dots span,
    .featured-slider .slick-dots button,
    .featured-slider .slick-dots .slick-active:after {
        color: <?php echo esc_attr( $slider_links_color ); ?>;
    }

    .featured-slider .slick-dots .slick-active:after {
        background-color: <?php echo esc_attr( $slider_links_color ); ?>;
    }

    /* Footer colors */

    #comments {
        background-color: <?php echo esc_attr( $comments_background_color ); ?>;
    }

    .site-footer,
    .site-footer span,
    .site-info,
    .site-footer .widget,
    .site-footer .widget a,
    .site-footer .widget_calendar td,
    .site-footer .tagcloud a,
    .site-footer .rssSummary,
    .site-footer .widget_calendar caption,
    .site-footer .widget_calendar th,
    .site-footer input[type="text"],
    .site-footer input[type="email"],
    .site-footer input[type="tel"],
    .site-footer input[type="url"],
    .site-footer input[type="password"],
    .site-footer input[type="search"],
    .site-footer textarea {
        color: <?php echo esc_attr( $footer_text_color ); ?>;
    }

    .site-footer a,
    .site-footer .widget_calendar tbody a,
    .site-footer .widget_recent_comments li a,
    .site-footer .widget_recent_entries li a,
    .site-footer .widget_rss li a,
    .site-footer .widget_contact_info .confit-address a,
    .site-footer .jetpack-display-remote-posts h4 a,
    .site-footer .widget .tp_recent_tweets a,
    .site-footer .widget .search-form input[type="submit"],
    .site-footer .widget .newsletter input[type="submit"] {
        color: <?php echo esc_attr( $footer_links_color ); ?>;
    }

    @media only screen and (min-width: 1025px){

        a:hover,
        div[class^="gr_custom_container"] a:hover,
        .comment-metadata a:hover,
        .comment .reply a:hover,
        .entry-footer a:hover,
        .category-filter a:hover,
        .category-filter .cat-active a:hover,
        .format-link .entry-content a:hover,
        .back-to-top:hover,
        .paging-navigation a:hover,
        .page-numbers li a:hover,
        .listing .format-link .entry-content a:hover,
        .read-more-link:hover  {
            color: <?php echo esc_attr( $link_hover_color ); ?>;
        }

        .nav-links a:hover,
        .read-more-link:hover,
        .logged-in-as a:hover {
            color: <?php echo esc_attr( $link_color ); ?>;
        }

        h1 a:hover,
        h2 a:hover,
        h3 a:hover,
        h4 a:hover,
        h5 a:hover,
        h6 a:hover {
            color: <?php echo esc_attr( $heading_link_hover_color ); ?>;
        }

        .entry-meta a:hover,
        .posts-navigation .entry-meta a:hover {
            color: <?php echo esc_attr( $meta_link_hover_color ); ?>;
        }

        .standard-menu .main-navigation ul ul a:focus,
        .nav-menu > li:hover > a,
        .sidebar-trigger:hover,
        .nav-menu li > a:hover,
        .nav-menu li:hover > .dropdown-toggle,
        #big-search-trigger:hover,
        .sidebar-trigger:hover,
        .standard-menu .main-navigation ul ul a:hover,
        .scroll-up:hover,
        .scroll-down:hover,
        .menu-social-container a:hover,
        #big-search-trigger:focus,
        .sidebar-trigger:focus {
            color: <?php echo esc_attr( $navigation_hover_color ); ?>;
        }

        .menu-toggle:focus span,
        .menu-toggle:focus span:before,
        .menu-toggle:focus span:after {
            background-color: <?php echo esc_attr( $navigation_hover_color ); ?>;
        }

        .featured-slider .portfolio-item h2 a:hover,
        .featured-slider .slick-arrow:hover:before {
            color: <?php echo esc_attr( $slider_links_hover_color ); ?>;
        }

        .site-title a:hover {
            color: <?php echo esc_attr( $logo_hover_color ); ?>;
        }

        .site-footer a:hover,
        .site-footer .widget a:hover,
        .site-footer .widget.widget_wpcom_social_media_icons_widget a:hover,
        .site-footer .widget .tp_recent_tweets a:hover,
        .site-footer .instagram-username a:hover,
        .site-footer .widget .tp_recent_tweets a:hover {
            color: <?php echo esc_attr( $footer_links_hover_color ); ?>;
        }

    }

    @media only screen and (max-width: 1024px){

        .page-template-portfolio-page .portfolio-item .entry-title a,
        .tax-ct_portfolio .portfolio-item .entry-title a {
            color: <?php echo esc_attr( $headings_color ); ?>;
        }

    }

</style>
