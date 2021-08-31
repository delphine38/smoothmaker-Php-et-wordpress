<?php
/**
 * Custom functions that act independently of the theme templates.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Eris
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 *
 * @since Eris 1.0
 */
function eris_body_classes( $classes ) {

	// Portfolio layout settings
	$portfolio_layout = get_theme_mod( 'portfolio_layout_setting', 'shuffle' );
	$sticky_header    = get_theme_mod( 'sticky_header_setting', 1 );
	$menu_type        = get_theme_mod( 'header_display_setting', 0 );
	$portfolio_header = get_theme_mod( 'portfolio_header_setting', 'slider' );
	$featured_slider_autoplay = get_theme_mod( 'featured_autoplay', 0 );
	$paging_type      = get_theme_mod( 'paging_setting', 'infinite-scroll' );


	if ( is_home() || is_tax( 'ct_portfolio' ) || is_tax( 'jetpack-portfolio-type' ) || is_tax( 'jetpack-portfolio-tag' ) || is_archive() || is_page_template( 'templates/template-headline.php' ) || is_page_template( 'templates/portfolio-page.php' ) ) {
		$classes[] = $paging_type;
	}

	// Portfolio archives classes
	if ( is_page_template( 'templates/portfolio-page.php' ) || ( is_tax( 'ct_portfolio' ) || is_tax( 'jetpack-portfolio-type' ) || is_tax( 'jetpack-portfolio-tag' ) ) ) {

		if ( 'slider' == $portfolio_header && !is_tax( 'ct_portfolio' ) && !is_tax( 'jetpack-portfolio-type' ) && !is_tax( 'jetpack-portfolio-tag' ) && !is_paged() ) {
			$classes[] = 'slider-initialized';

			if ($featured_slider_autoplay) {
			    $classes[] = 'portfolio-slider-autoplay';
			}
		}

		if ( 'headline' == $portfolio_header && ( '' != get_theme_mod( 'portfolio_headline_text' ) || '' != get_post()->post_content ) && !is_tax( 'ct_portfolio' ) && !is_tax( 'jetpack-portfolio-type' )  && !is_tax( 'jetpack-portfolio-tag' ) && !is_paged() ) {
			$classes[] = 'headline-template';
		}

		if ( 'shuffle' == $portfolio_layout ) {
			$classes[] = 'shuffle-layout';
		} else {
			$classes[] = esc_attr( 'layout-' . $portfolio_layout );
		}

	}

	if ( is_single() && ( 'portfolio' == get_post_type() || 'jetpack-portfolio' == get_post_type() ) ) {

		$single_layout_type = get_post_meta( get_the_ID(), 'eris_portfolio_display_type', true );

		if ( 'split' == $single_layout_type ) {

			$classes[] = 'split-layout';

		} else {

			if ( has_excerpt() ) {
				$classes[] = 'single-portfolio-headline';
			}

		}

	}

	// Adds a class of group-blog to blogs with more than 1 published author.
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}

	// Menu type class
	if ( $menu_type ) {
		$classes[] = 'hamburger-menu';
	} else {
		$classes[] = 'standard-menu';
	}

	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	// Portfolio single with excerpt

	if ( is_singular( 'jetpack-portfolio' ) ) {
		$classes[] = 'single-portfolio';
	}

	// Sticky header
	if ( $sticky_header ) {
		$classes[] = 'sticky-header';
	}

	// No sidebar class
	if ( !is_active_sidebar( 'sidebar-1' ) ) {
		$classes[] = 'no-sidebar';
	}

	// Adds a class of tk-theme-frontend when viewing frontend.
	if ( !is_admin() ) {
		$classes[] = 'tk-theme-frontend';
	}

	return $classes;
}
add_filter( 'body_class', 'eris_body_classes' );

/**
 * Adds custom classes to portfolio wrapper
 */
if ( ! function_exists( 'eris_portfolio_class' ) ) :
function eris_portfolio_class() {
	// Get portoflio layout settings
	$portfolio_layout = get_theme_mod( 'portfolio_layout_setting', 'shuffle' );

	if ( 'shuffle' != $portfolio_layout ) {
		echo esc_attr( 'masonry' );
	} else {
		return;
	}
}
endif;

/**
 * Display classes for grid sizer helper
 */
if ( ! function_exists( 'eris_grid_sizer_class' ) ) :
function eris_grid_sizer_class() {

	// Get portfolio layout setting
	$portfolio_layout = get_theme_mod( 'portfolio_layout_setting', 'shuffle' );
	$classes          = array();
	$classes[]        = 'grid-sizer';

	if ( 'shuffle' != $portfolio_layout ) {
		if ( 'three-columns' == $portfolio_layout ) {
			$classes[] = 'col-md-4 col-sm-6';
		} else {
			$classes[] = 'col-lg-3 col-md-4 col-sm-6';
		}
	}

	echo esc_attr( implode( ' ', $classes ) );
}
endif;

/**
 * Adds custom classes to the array of post classes.
 *
 * @param array $classes Classes for the post element.
 * @return array
 *
 * @since Eris 1.0
 */
if ( ! function_exists( 'eris_post_classes' ) ) :
function eris_post_classes( $classes ) {

	if ( is_tag() ) {
		return $classes;
	}

	// Get portoflio layout settings
	$portfolio_layout = get_theme_mod( 'portfolio_layout_setting', 'shuffle' );

	if ( ( ( 'portfolio' == get_post_type() || 'jetpack-portfolio' == get_post_type() ) && !is_single() && !is_search() ) || ( is_tax( 'ct_portfolio' ) || is_tax( 'jetpack-portfolio-type' ) || is_tax( 'jetpack-portfolio-tag' ) ) ) :

		if ( 'shuffle' != $portfolio_layout ) {
			if ( 'three-columns' == $portfolio_layout ) {
				$classes[] = 'col-md-4 col-sm-6';
			} else {
				$classes[] = 'col-lg-3 col-md-4 col-sm-6';
			}

		}

	endif;

	return $classes;
}
endif;
add_filter( 'post_class', 'eris_post_classes' );

/**
 * Get Thumbnail Image Size Class
 *
 * @since Eris 1.0
 */
if ( ! function_exists( 'eris_get_featured_image_class' ) ) :
function eris_get_featured_image_class() {

	if ( ( 'portfolio' == get_post_type() || 'jetpack-portfolio' == get_post_type() ) && 'shuffle' != get_theme_mod( 'portfolio_layout_setting', 'shuffle' ) ) {
		return;
	}

	if ( !get_the_post_thumbnail() ) {
		return;
	}

	if ( has_post_thumbnail() ) {
		$thumb_class = '';
		$imgData     = wp_get_attachment_metadata( get_post_thumbnail_id( get_the_ID() ) );
		if ( empty( $imgData ) ){
			return $thumb_class; //VIP: if $url is blank or empty getimagesize will throw a PHP warning. Let's bail before it gets to it if the url is not present
		}
		$width       = $imgData['width'];
		$height      = $imgData['height'];

		if ( $width > $height || $width == $height ) {
			$thumb_class = 'featured-landscape';
		} else {

			if ( '' != get_the_title() ) {
				$thumb_class = 'featured-portrait';
			}
		}

		return esc_attr( $thumb_class );
	}


}
endif;

/**
 * Check for embed content in post and extract
 *
 * @since Eris 1.0
 */
if ( ! function_exists( 'eris_get_embeded_media' ) ) :
function eris_get_embeded_media() {
	$content   = get_the_content();
	$embeds    = get_media_embedded_in_content( $content );
	$video_url_selected = str_replace( $embeds, '', $content );
	$video_url = wp_extract_urls( strip_shortcodes( $video_url_selected ) );

	if ( !empty( $embeds ) ) {

		// Check what is the first embed containg video tag, youtube or vimeo
		foreach( $embeds as $embed ) {
			if ( strpos( $embed, 'video' ) || strpos( $embed, 'youtube' ) || strpos( $embed, 'vimeo' ) || strpos( $embed, 'hulu' ) || strpos( $embed, 'animoto' ) || strpos( $embed, 'dailymotion' ) || strpos( $embed, 'educreations' ) || strpos( $embed, 'sproutvideo' ) || strpos( $embed, 'ted.com' )|| strpos( $embed, 'vine.co' ) || strpos( $embed, 'wistia' ) || strpos( $embed, 'kck.st' ) ) {

				$id   = 'eris' . rand();
				$href = "#TB_inline?height=640&width=1000&inlineId=" . $id;

				if ( !is_single() && has_post_thumbnail() ) {

					$video_url = '<div id="' . $id . '" style="display:none;">' . $embed . '</div>';
					$video_url .= '<figure class="featured-image"><a class="thickbox" title="' . get_the_title() . '" href="' . $href . '">' . get_the_post_thumbnail() . '</a></figure>';

					return $video_url;

				} else {

					return $embed;

				}

			}
		}

	} else {

		if ( $video_url ) {

			foreach( $video_url as $video_link ) {
				if ( strpos( $video_link, 'vimeo' ) || strpos( $video_link, 'youtube' ) || strpos( $video_link, 'cnnmoney-video' ) || strpos( $video_link, 'dailymotion' ) || strpos( $video_link, 'ted' ) || strpos( $video_link, 'hulu' ) || strpos( $video_link, 'vine' ) || strpos( $video_link, 'kck.st' ) ) {

					$id   = 'eris' . rand();
					$href = "#TB_inline?height=640&width=1000&inlineId=" . $id;

					if ( !is_single() && has_post_thumbnail() ) {

						$video_url = '<div id="' . $id . '" style="display:none;">' . wp_oembed_get( $video_url[0] ) . '</div>';
						$video_url .= '<figure class="featured-image"><a class="thickbox" title="' . get_the_title() . '" href="' . $href . '">' . get_the_post_thumbnail() . '</a></figure>';

						return $video_url;

					} else {

						return wp_oembed_get( $video_url[0] );

					}

				}
			}

		} else {
			// No video embedded found
			return $content;
		}
	}
}
endif;

/**
 * Remove parenthesses with dots from excerpt
 *
 * @since Eris 1.0
 */
if ( ! function_exists( 'eris_excerpt_more' ) ) :
function eris_excerpt_more( $more ) {
	return str_replace( '[...]', '', $more );
}
endif;
add_filter( 'excerpt_more', 'eris_excerpt_more' );

/**
 * Add read more text to excerpt
 *
 * @since Eris 1.0
 */
if ( ! function_exists( 'eris_add_read_more_excerpt' ) ) :
function eris_add_read_more_excerpt( $excerpt ) {
	$read_more_txt = sprintf(
		/* translators: %s: Name of current post. */
		wp_kses( __( 'Read more', 'eris' ), array( 'span' => array( 'class' => array() ) ) ),
		the_title( '<span class="screen-reader-text">"', '"</span>', false )
	);

	$read_more_link = '';

	if ( !is_single() ){
		$read_more_link = '<a class="read-more-link" href=" ' . esc_url( get_permalink() ) . ' ">' . esc_html( $read_more_txt ) . '</a>';
	}

	return $excerpt . $read_more_link;
}
endif;
add_filter( 'the_excerpt', 'eris_add_read_more_excerpt' );

/**
 * Removes parenthesses from category and archives widget
 *
 * @since Eris 1.0
 */
if ( ! function_exists( 'eris_categories_postcount_filter' ) ) :
function eris_categories_postcount_filter( $variable ) {
	$variable = str_replace( '(', '<span class="post_count"> ', $variable );
	$variable = str_replace( ')', '</span>', $variable );
	return $variable;
}
endif;
add_filter( 'wp_list_categories','eris_categories_postcount_filter' );

if ( ! function_exists( 'eris_archives_postcount_filter' ) ) :
function eris_archives_postcount_filter( $variable ) {
	$variable = str_replace( '(', '<span class="post_count"> ', $variable );
	$variable = str_replace( ')', '</span>', $variable );
	return $variable;
}
endif;
add_filter( 'get_archives_link', 'eris_archives_postcount_filter' );

/**
 * Filter content for gallery post format
 *
 * @since  Eris 1.0
 */
if ( ! function_exists( 'eris_portfolio_filter_post_content' ) ) :
function eris_portfolio_filter_post_content( $content ) {

	if ( post_password_required() ) {
		return $content;
	}

	if ( 'portfolio' == get_post_type() || 'jetpack-portfolio' == get_post_type() ) {

		if ( eris_is_split_layout() ) {
			$gallery_regex = '/\[gallery.*]/';
			$content = preg_replace( $gallery_regex, '', $content );

			$embed_regex = '/.*wp-block-embed[\s\S]*?<\/figure>/';
			$content = preg_replace( $embed_regex, '', $content );

			$content = preg_replace( '/\[caption.*?].*?(<img.*?\/?>).*?\[\/caption]/s', '', $content );
			$content = preg_replace( '/<a href=\"(.*?)\"><img.*?\/?><\/a>/', '', $content );
			$content = preg_replace( '/<figure class=\"(.*?)\"><img.*?\/?><\/figure>/', '', $content );
			$content = preg_replace( '/<img[^>]+./', '', $content );

			$embeds = get_media_embedded_in_content( $content );
			$video_url     = wp_extract_urls( $content );

			if (!empty($embeds)) {
				if ( strpos( $embeds[0], 'video' ) || strpos( $embeds[0], 'youtube' ) || strpos( $embeds[0], 'vimeo' ) || strpos( $embeds[0], 'hulu' ) || strpos( $embeds[0], 'animoto' ) || strpos( $embeds[0], 'dailymotion' ) || strpos( $embeds[0], 'educreations' ) || strpos( $embeds[0], 'sproutvideo' ) || strpos( $embeds[0], 'ted.com' )|| strpos( $embeds[0], 'vine.co' )|| strpos( $embeds[0], 'wistia' ) || strpos( $embeds[0], 'kck.st' ) ) {
					$content = str_replace( $embeds, '', $content );
				}
			}

			if ( $video_url ) {
				if ( strpos( $video_url[0], 'video' ) || strpos( $video_url[0], 'vimeo' ) || strpos( $video_url[0], 'youtube' ) || strpos( $video_url[0], 'cnnmoney-video' ) || strpos( $video_url[0], 'dailymotion' ) || strpos( $video_url[0], 'ted' ) || strpos( $video_url[0], 'hulu' ) || strpos( $video_url[0], 'vine' ) || strpos( $video_url[0], 'kck.st' ) ) {
					$content = str_replace( $video_url[0], '', $content );
				}
			}

			$tags = array(
				'wpvideo',
				'video',
				'vimeo',
				'youtube',
				'cnnmoney-video',
				'dailymotion',
				'ted',
				'hulu',
				'vine',
				'playlist',
				'kickstarter',
			);

			preg_match_all( '/' . get_shortcode_regex() . '/', $content, $matches, PREG_SET_ORDER );

			if ( !empty( $matches ) ) {
				foreach ( $matches as $shortcode ) {
					foreach ( $tags as $tag ) {
						if ( $tag === $shortcode[2] ) {
							$tag_shortcode = $shortcode[0];
							$content = str_replace( $tag_shortcode, '', $content );
							break;
						}
					}
				}
			}

			return wp_kses_post( $content );
		}
		else {
			return $content;
		}

	}
	else {
		return $content;
	}

}
endif;
add_filter( 'the_content', 'eris_portfolio_filter_post_content', 1, 1 );

/**
 * Get title of page that uses portfolio template
 *
 * @return  String [Page title]
 */
if ( ! function_exists( 'eris_return_portfolio_page' ) ) :
function eris_return_portfolio_page( $type ) {
	$pages = get_pages( array(
		'meta_key'   => '_wp_page_template',
		'meta_value' => 'templates/portfolio-page.php'
	) );

	if ( !empty( $pages ) ) {
		if ( 'id' == $type ) {
			return $pages[0]->ID;
		} else {
			return $pages[0]->post_title;
		}
	}
}
endif;

/**
 * Conditional helper for split layout projects
 */
if ( ! function_exists( 'eris_is_split_layout' ) ) :
function eris_is_split_layout() {

	$single_layout_type = get_post_meta( get_the_ID(), 'eris_portfolio_display_type', true );

	if ( is_single() && ( 'portfolio' == get_post_type() || 'jetpack-portfolio' == get_post_type() ) && 'split' == $single_layout_type ) {
		return true;
	} else {
		return false;
	}
}
endif;

// Load our function when hook is set
if ( ! function_exists( 'eris_modify_query_get_projects' ) ) :
function eris_modify_query_get_projects( $query ) {

	// Check if on frontend and main query is modified
	if ( ! is_admin() && $query->is_main_query() && ( is_tax( 'ct_portfolio' ) || is_tax( 'jetpack-portfolio-type' )) ) {

		$posts_per_page = get_theme_mod( 'projects_per_page', 6 );
		$query->set( 'posts_per_archive_page', $posts_per_page );

	}
}
endif;
add_action( 'pre_get_posts', 'eris_modify_query_get_projects' );

/**
 * Add portfolio to tag page archive
 */
if ( ! function_exists( 'eris_query_include_posts' ) ) :
function eris_query_include_posts( $query ) {
	if ( ! is_admin() && $query->is_main_query() && $query->is_tag() ) {
		$query->set( 'post_type', array( 'post', 'portfolio', 'jetpack-portfolio' ) );
	}
}
endif;
add_action( 'pre_get_posts', 'eris_query_include_posts' );

/**
 * Change tag cloud font size
 *
 * @since  eris 1.0
 */
if ( ! function_exists( 'eris_widget_tag_cloud_args' ) ) :
function eris_widget_tag_cloud_args( $args ) {
	$args['largest']  = 12;
	$args['smallest'] = 12;
	$args['unit']     = 'px';
	return $args;
}
endif;
add_filter( 'widget_tag_cloud_args', 'eris_widget_tag_cloud_args' );

/**
 * Number of projects to display on archives
 */
if ( ! function_exists( 'eris_change_number_of_projects' ) ) :
function eris_change_number_of_projects( $query ) {

	$posts_per_page = get_theme_mod( 'projects_per_page', 10 );

	if ( ( $query->is_post_type_archive( 'portfolio' ) || $query->is_post_type_archive( 'jetpack-portfolio' ) ) && $query->is_main_query() ) {
		$query->set( 'posts_per_page', $posts_per_page );
	}
}
endif;
add_action( 'pre_get_posts', 'eris_change_number_of_projects' );

/**
 * Alter default gallery shortcode output
 */
if ( ! function_exists( 'eris_alter_post_gallery' ) ) :
function eris_alter_post_gallery( $output, $attr ) {
	global $post;

	if ( isset( $attr['orderby'] ) ) {
		$attr['orderby'] = sanitize_sql_orderby( $attr['orderby'] );
		if ( !$attr['orderby'] )
			unset ($attr['orderby'] );
	}

	extract( shortcode_atts( array(
		'order'      => 'ASC',
		'orderby'    => 'menu_order ID',
		'id'         => $post->ID,
		'itemtag'    => 'dl',
		'icontag'    => 'dt',
		'captiontag' => 'dd',
		'columns'    => 3,
		'size'       => 'thumbnail',
		'include'    => '',
		'exclude'    => ''
	), $attr ) );

	$id = intval( $id );
	if ( 'RAND' == $order ) $orderby = 'none';

	if ( !empty( $include ) ) {
		$include = preg_replace( '/[^0-9,]+/', '', $include );

		$_attachments = get_posts( array(
			   'include'        => $include,
			   'post_status'    => 'inherit',
			   'post_type'      => 'attachment',
			   'post_mime_type' => 'image',
			   'order'          => $order,
			   'orderby'        => $orderby
			)
		);

		$attachments = array();
		foreach ( $_attachments as $key => $val ) {
			$attachments[$val->ID] = $_attachments[$key];
		}
	}

	if ( empty( $attachments ) )
		return '';

	// Here's your actual output, you may customize it to your need
	$output = "<div class=\"entry-gallery fullsize-gallery\">\n";

		$output .= "<div class=\"gallery gallery-size-full\">\n";

			$output .= "<ul class=\"slides list-reset\">\n";

				// Now you loop through each attachment
				foreach ( $attachments as $id => $attachment ) {
					// Get featured image caption
					$thumb_img       = get_post( $id );      // Get post by ID
					$img_title       = $thumb_img->post_title;      // Display title
					$img_description = $thumb_img->post_content; // Display Description
					$img             = wp_get_attachment_image_src( $id, 'full' ); // Image src
					$gallery_rel     = get_the_ID() . 'post-gallery';

					$output .= "<figure class=\"gallery-item\">\n";
						$output .= "<a href=\"{$img[0]}\" class=\"thickbox\" data-content=\"{$img_description}\" rel=\"{$gallery_rel}\" title=\"{$img_title}\">";
							$output .= "<img src=\"{$img[0]}\" width=\"{$img[1]}\" height=\"{$img[2]}\" alt=\"gallery image\"  />\n";
						$output .= "</a>";
					$output .= "</figure>\n";
				}

			$output .= "</ul>\n";

		$output .= "</div>\n";

	$output .= "</div>\n";

	return $output;
}
endif;
add_filter( 'post_gallery', 'eris_alter_post_gallery', 10, 2 );
