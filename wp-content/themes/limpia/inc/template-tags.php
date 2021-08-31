<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Eris
 */

/**
 * Displays entry header
 *
 * @since Eris 1.0
 */
if ( ! function_exists( 'eris_entry_header' ) ) :
function eris_entry_header() {

	if ( !is_single() && ( !is_search() && ( 'link' == get_post_format() || 'quote' == get_post_format() ) ) ) {
		return;
	}

	$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';

	if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
		$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
	}

	$edit_post_link = '';

	if ( is_user_logged_in() ) {
		$edit_post_link = '<a href="' . esc_url( get_edit_post_link() ) . '"></a>';
	}

	$time_string = sprintf( $time_string,
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() ),
		esc_attr( get_the_modified_date( 'c' ) ),
		esc_html( get_the_modified_date() )
	);

	$posted_on = sprintf(
		esc_html_x( '%s', 'post date', 'eris' ),
		'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
	);

	if ( taxonomy_exists( 'jetpack-portfolio-type' ) && 'jetpack-portfolio' == get_post_type() ) {
		$categories_list = get_the_term_list( get_the_ID(), 'jetpack-portfolio-type', '', '&nbsp;', ''  );
	} elseif ( 'portfolio' == get_post_type() && ( !class_exists( 'Jetpack' ) || !post_type_exists( 'jetpack-portfolio' ) ) ) {
		$categories_list = get_the_term_list( get_the_ID(), 'ct_portfolio', '', '&nbsp;', '' );
	} else {
		$categories_list = get_the_term_list( get_the_ID(), 'category', '', '&nbsp;', '' );
	}

	if ( is_single() ) {
		the_title( '<h1 class="entry-title">', '</h1>' );
	} else {
		the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
	}

	printf( '<div class="entry-meta"><span class="category-list">%1$s</span><span class="post-date">%2$s</span><span class="edit-link">%3$s</span></div>', $categories_list, $posted_on, $edit_post_link );

}
endif;

if ( ! function_exists( 'eris_entry_footer' ) ) :
/**
 * Prints HTML with meta information for the categories, tags.
 */
function eris_entry_footer() {

	if ( is_single() ) : ?>

		<footer class="entry-footer">

		<?php


			if ( taxonomy_exists( 'jetpack-portfolio-type' ) && 'jetpack-portfolio' == get_post_type() ) {
				$categories_list = get_the_term_list( get_the_ID(), 'jetpack-portfolio-type', '', ' ', '' );
			} elseif ( 'portfolio' == get_post_type() && ( !class_exists( 'Jetpack' ) || !post_type_exists( 'jetpack-portfolio' ) ) ) {
				$categories_list = get_the_term_list( get_the_ID(), 'ct_portfolio', '', ' ', '' );
			} else {
				$categories_list = get_the_category_list( ' ' );
			}

			if ( $categories_list && eris_categorized_blog() ) {
				printf( '<span class="cat-links">' . esc_html__( 'Posted in %1$s', 'eris' ) . '</span>', $categories_list ); // WPCS: XSS OK.
			}

			$tags_list = get_the_tag_list( '', ' ' );

			if ( $tags_list ) {
				printf( '<span class="tags-links"><span>&nbsp;' . esc_html__( 'and', 'eris' ) . '&nbsp;</span><span>' . esc_html__( 'Tagged %1$s', 'eris' ) . '</span></span>', $tags_list ); // WPCS: XSS OK.
			}

		?>

		</footer>

	<?php

	endif; // if is single
}
endif;

/**
 * Display the archive title based on the queried object.
 *
 * @param string $before Optional. Content to prepend to the title. Default empty.
 * @param string $after  Optional. Content to append to the title. Default empty.
 */
if ( ! function_exists( 'eris_archive_title' ) ) :
function eris_archive_title( $before = '', $after = '' ) {
	if ( is_category() ) {
		$title = sprintf( esc_html__( 'Category: %s', 'eris' ), '<span>' . single_cat_title( '', false ) . '</span>' );
	} elseif ( is_tag() ) {
		$title = sprintf( esc_html__( 'Tag: %s', 'eris' ), '<span>' . single_tag_title( '', false ) . '</span>' );
	} elseif ( is_author() ) {
		$title = sprintf( esc_html__( 'Author: %s', 'eris' ), '<span class="vcard">' . get_the_author() . '</span>' );
	} elseif ( is_year() ) {
		$title = sprintf( esc_html__( 'Year: %s', 'eris' ), '<span>' . get_the_date( esc_html_x( 'Y', 'yearly archives date format', 'eris' ) ) . '</span>' );
	} elseif ( is_month() ) {
		$title = sprintf( esc_html__( 'Month: %s', 'eris' ), '<span>' . get_the_date( esc_html_x( 'F Y', 'monthly archives date format', 'eris' ) ) . '</span>' );
	} elseif ( is_day() ) {
		$title = sprintf( esc_html__( 'Date: %s', 'eris' ), '<span>' . get_the_date( esc_html_x( 'F j, Y', 'daily archives date format', 'eris' ) ) . '</span>' );
	} elseif ( is_tax( 'post_format' ) ) {
		if ( is_tax( 'post_format', 'post-format-aside' ) ) {
			$title = esc_html_x( 'Asides', 'post format archive title', 'eris' );
		} elseif ( is_tax( 'post_format', 'post-format-gallery' ) ) {
			$title = esc_html_x( 'Galleries', 'post format archive title', 'eris' );
		} elseif ( is_tax( 'post_format', 'post-format-image' ) ) {
			$title = esc_html_x( 'Images', 'post format archive title', 'eris' );
		} elseif ( is_tax( 'post_format', 'post-format-video' ) ) {
			$title = esc_html_x( 'Videos', 'post format archive title', 'eris' );
		} elseif ( is_tax( 'post_format', 'post-format-quote' ) ) {
			$title = esc_html_x( 'Quotes', 'post format archive title', 'eris' );
		} elseif ( is_tax( 'post_format', 'post-format-link' ) ) {
			$title = esc_html_x( 'Links', 'post format archive title', 'eris' );
		} elseif ( is_tax( 'post_format', 'post-format-status' ) ) {
			$title = esc_html_x( 'Statuses', 'post format archive title', 'eris' );
		} elseif ( is_tax( 'post_format', 'post-format-audio' ) ) {
			$title = esc_html_x( 'Audio', 'post format archive title', 'eris' );
		} elseif ( is_tax( 'post_format', 'post-format-chat' ) ) {
			$title = esc_html_x( 'Chats', 'post format archive title', 'eris' );
		}
	} elseif ( is_post_type_archive() ) {
		$title = sprintf( esc_html__( '%s', 'eris' ), post_type_archive_title( '', false ) );
	} elseif ( is_tax() ) {
		$tax = get_taxonomy( get_queried_object()->taxonomy );
		/* translators: 1: Taxonomy singular name, 2: Current taxonomy term */
		$title = sprintf( esc_html__( '%1$s: %2$s', 'eris' ), $tax->labels->singular_name, '<span>' . single_term_title( '', false ) . '</span>' );
	} else {
		$title = esc_html__( 'Archives', 'eris' );
	}

	/**
	 * Filter the archive title.
	 *
	 * @param string $title Archive title to be displayed.
	 */
	$title = apply_filters( 'get_the_archive_title', $title );

	if ( ! empty( $title ) ) {
		echo $before . $title . $after;  // WPCS: XSS OK.
	}
}
endif;

/**
 * HTML for Infinite Scroll pagination
 */
if ( ! function_exists( 'eris_pagination' ) ) :
function eris_pagination() {

	global $wp_query, $project_query;

	if ( is_page_template( 'templates/portfolio-page.php' ) ) {

		// Don't print empty markup if there's only one page.
		if ( $project_query->max_num_pages < 2 ) {
			return;
		}

		$max   = $project_query->max_num_pages;
		$paged = ( get_query_var( 'paged' ) > 1 ) ? get_query_var( 'paged' ) : 1;

		$js_vars = array(
			'projectStartPage' => $paged,
			'projectMaxPages'  => $max
		);

		wp_localize_script( 'eris-call-scripts', 'project_vars', $js_vars );

		$wp_query = $project_query;

	} else {

		// Don't print empty markup if there's only one page.
		if ( $wp_query->max_num_pages < 2 ) {
			return;
		}

	}

	$paging_type = get_theme_mod( 'paging_setting', 'infinite-scroll' );

	if ( 'infinite-scroll' == $paging_type ) { ?>

		<h2 class="screen-reader-text"><?php esc_html_e( 'Posts navigation', 'eris' ); ?></h2>

		<div id="infinite-handle">
			<?php if ( get_next_posts_link() ) : ?>
				<span>
					<?php next_posts_link( esc_html__( 'Load More', 'eris' ) ); ?>
				</span>
			<?php endif; ?>
		</div><!-- .nav-links -->

		<div id="loading-is" class="infinite-loader"></div>

	<?php

	} else {

		the_posts_navigation( array(
			'prev_text' => esc_html__( 'Prev', 'eris' ),
			'next_text' => esc_html__( 'Next', 'eris' )
		) );

	}

}
endif;

/**
 * Returns true if a blog has more than 1 category.
 *
 * @return bool
 */
if ( ! function_exists( 'eris_categorized_blog' ) ) :
function eris_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'eris_categories' ) ) ) {
		// Create an array of all the categories that are attached to posts.
		$all_the_cool_cats = get_categories( array(
			'fields'     => 'ids',
			'hide_empty' => 1,
			// We only need to know if there is more than one category.
			'number'     => 2,
		) );

		// Count the number of categories that are attached to the posts.
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'eris_categories', $all_the_cool_cats );
	}

	if ( $all_the_cool_cats > 1 ) {
		// This blog has more than 1 category so eris_categorized_blog should return true.
		return true;
	} else {
		// This blog has only 1 category so eris_categorized_blog should return false.
		return false;
	}
}
endif;

/**
 * Flush out the transients used in eris_categorized_blog.
 */
if ( ! function_exists( 'eris_category_transient_flusher' ) ) :
function eris_category_transient_flusher() {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	// Like, beat it. Dig?
	delete_transient( 'eris_categories' );
}
endif;
add_action( 'edit_category', 'eris_category_transient_flusher' );
add_action( 'save_post',     'eris_category_transient_flusher' );

/**
 * Extract image from video
 */
if ( ! function_exists( 'eris_get_video_image' ) ) :
function eris_get_video_image( $url, $post_ID, $img_quality ) {

    require_once( ABSPATH . "wp-admin" . '/includes/image.php' );
    require_once( ABSPATH . "wp-admin" . '/includes/file.php' );
    require_once( ABSPATH . "wp-admin" . '/includes/media.php' );

    if ( !empty( $url ) ) {
        $key_str1    = 'youtube';
        $key_str2    = 'vimeo';
        $pos_youtube = strpos( $url, $key_str1 );
        $pos_vimeo   = strpos( $url, $key_str2 );

        if ( !empty( $pos_youtube ) ) {
            $url      = str_replace( 'watch?v=', '', $url );
            $url      = explode( '&', $url );
            $url      = $url[0];
            $protocol = substr( $url, 0, 5 );

            if ( $protocol == "http:" ) {
                $url      = str_replace( 'http://www.youtube.com/', '', $url );
                $protocol_new = "http://";
            }
            if ( $protocol == "https" ) {
                $url      = str_replace( 'https://www.youtube.com/', '', $url );
                $protocol_new = "https://";
            }

            if ( empty( $img_quality ) ) {
                $img_quality = 2;
            }

            $video_image_url = $protocol_new . 'img.youtube.com/vi/'. $url . '/hqdefault.jpg';

            if ( !has_post_thumbnail( $post_ID ) ) {
                $url = $video_image_url;
                $tmp = download_url( $url );

                if( is_wp_error( $tmp ) ){
                    // download failed, handle error
                }

                $post_id    = $post_ID;
                $desc       = get_the_title();
                $file_array = array();

                // Set variables for storage
                // fix file filename for query strings
                preg_match( '/[^\?]+\.(jpg|jpe|jpeg|gif|png)/i', $url, $matches );
                $file_array['name']     = basename( $matches[0] );
                $file_array['tmp_name'] = $tmp;

                // If error storing temporarily, unlink
                if ( is_wp_error( $tmp ) ) {
                    @unlink( $file_array['tmp_name'] );
                    $file_array['tmp_name'] = '';
                }

                // do the validation and storage stuff
                $id = media_handle_sideload( $file_array, $post_id, $desc );

                // If error storing permanently, unlink
                if ( is_wp_error( $id ) ) {
                    @unlink( $file_array['tmp_name'] );
                    return $id;
                }

                set_post_thumbnail( $post_ID, $id );

            }

            $video_image = get_the_post_thumbnail( $post_ID, 'post-thumbnail', array('class' => 'eris-video-featured-image skip-lazy') );

        }
        elseif ( !empty( $pos_vimeo ) ) {

            $urlParts = explode( "/", parse_url( $url, PHP_URL_PATH ) );
            $videoId  = (int) $urlParts[count($urlParts)-1 ];
            $data     = wp_remote_get( "http://vimeo.com/api/v2/video/" . $videoId . ".json" );

            if ( !is_wp_error( $data ) && is_array( $data ) ) {
                $data  = wp_remote_get( "http://vimeo.com/api/v2/video/" . $videoId . ".json" );
                $data  = json_decode( wp_remote_retrieve_body( $data ), true );
                $image = $data[0]['thumbnail_large'];

                if ( !has_post_thumbnail( $post_ID ) ) {
                    $url = $image;
                    $tmp = download_url( $url );

                    if( is_wp_error( $tmp ) ){
                        // download failed, handle error
                    }

                    $post_id    = $post_ID;
                    $desc       = get_the_title();
                    $file_array = array();

                    // Set variables for storage
                    // fix file filename for query strings
                    preg_match( '/[^\?]+\.(jpg|jpe|jpeg|gif|png)/i', $url, $matches );
                    $file_array['name']     = basename( $matches[0] );
                    $file_array['tmp_name'] = $tmp;

                    // If error storing temporarily, unlink
                    if ( is_wp_error( $tmp ) ) {
                        @unlink( $file_array['tmp_name'] );
                        $file_array['tmp_name'] = '';
                    }

                    // do the validation and storage stuff
                    $id = media_handle_sideload( $file_array, $post_id, $desc );

                    // If error storing permanently, unlink
                    if ( is_wp_error( $id ) ) {
                        @unlink( $file_array['tmp_name'] );
                        return $id;
                    }

                    set_post_thumbnail( $post_ID, $id );

                }

                $video_image = get_the_post_thumbnail( $post_ID, 'post-thumbnail', array('class' => 'eris-video-featured-image skip-lazy') );

            }
        }
        else {

            $video_image = esc_html__( 'Video only allowes vimeo and youtube!', 'eris' );
        }

        return $video_image;
    }
}
endif;

/**
 * Generates video player for user content post meta
 */
if ( ! function_exists( 'eris_video_player' ) ) :
function eris_video_player( $url ) {

	if ( !empty( $url ) ) {

		$key_str1    = 'youtube';
		$key_str2    = 'vimeo';
		$pos_youtube = strpos( $url, $key_str1 );
		$pos_vimeo   = strpos( $url, $key_str2 );

		if ( !empty( $pos_youtube ) ) {
			$url = str_replace( 'watch?v=', '', $url );
			$url = explode( '&', $url );
			$url = $url[0];
			$protocol = substr( $url, 0, 5 );

			if ( $protocol == "http:" ) {
				$url = str_replace( 'http://www.youtube.com/', '', $url );
			}
			if ( $protocol == "https" ) {
				$url = str_replace( 'https://www.youtube.com/', '', $url );
			}

			$iframe_video = '<iframe id="youtube-player" class="scalable-element" src="http://www.youtube.com/embed/' . $url . '?enablejsapi=1&rel=0"></iframe>';

		} elseif ( ! empty( $pos_vimeo ) ) {
			$urlParts = explode( "/", parse_url( $url, PHP_URL_PATH ) );
			$videoId  = (int) $urlParts[count($urlParts)-1 ];
			$iframe_video = '<iframe class="vimeo-video scalable-element" src="http://player.vimeo.com/video/' . $videoId . '"></iframe>';
		} else {
			$iframe_video = esc_html__( 'Video only allowes vimeo and youtube!', 'eris' );
		}

		return $iframe_video;
	}
}
endif;

/**
 * Displays post featured image
 *
 * @since  Eris 1.0
 */
if ( ! function_exists( 'eris_featured_image' ) ) :
function eris_featured_image() {

	if ( has_post_thumbnail() ) :

		if ( is_single() ) { ?>

			<figure class="featured-image <?php echo esc_attr( eris_get_featured_image_class() ); ?>">
				<?php the_post_thumbnail( 'eris-single-featured-image' ); ?>
			</figure>

		<?php } else { ?>

			<?php

				// Set image sizes depending on content display
				$thumb_size = 'eris-archive-image';

				if ( 'featured-portrait' == eris_get_featured_image_class() ) {
					$thumb_size = 'eris-archive-image-portrait';
				}

				if ( is_search() || is_tag() ) {
					$thumb_size = 'eris-search-image';
				}

			?>

			<figure class="featured-image <?php echo esc_attr( eris_get_featured_image_class() ); ?>">
				<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail( $thumb_size, array('class' => 'skip-lazy') ); ?></a>
			</figure>

		<?php }

	else :

		return;

	endif;

}
endif;

/**
 * Displays post featured media
 *
 * @since  Eris 1.0
 */
if ( ! function_exists( 'eris_featured_media' ) ) :
function eris_featured_media() {

	if ( eris_is_split_layout() ) {
		global $post;
		$content = $post->post_content;
		$embeds    = get_media_embedded_in_content( $post->post_content );

		eris_featured_image();

		$images_with_captions = '/\[caption.*\](.*?)\[\/caption\]/';

		preg_match_all( $images_with_captions, $post->post_content, $captions );

		$images_with_caption = $captions[1];

		foreach ( $images_with_caption as $image_with_caption ) {
			if ( $image_with_caption ) { ?>
				<figure class="wp-caption">
					<?php echo wp_kses_post( $image_with_caption ); ?>
				</figure>
			<?php }
		}

		// Images with wrapping links
		$images_with_links = '/<a href=\"(.*?)\"><img.*?\/?><\/a>/';

		preg_match_all( $images_with_links, $post->post_content, $links );

		$imgs_w_links = $links[0];

		foreach ( $imgs_w_links as $img_w_link ) {

			str_replace( $img_w_link, '', $images_with_caption, $caption_count );

			if ( $img_w_link && $caption_count == 0 ) {
				echo wp_kses_post( $img_w_link );
			}
		}

		// WP block images

		$wp_block_images = '/<figure class=\"(wp-block-image)*\"><img (.*?)class=\".*?\"(.*?)><\/figure>/';

		preg_match_all( $wp_block_images, $post->post_content, $block_imgs );

		$wp_block_image = $block_imgs[0];

		foreach ( $wp_block_image as $block_img ) {
			if ( $block_img ) {
				echo wp_kses_post( $block_img );
			}
		}

		// WP block galleries

		$wp_block_galleries = '/.*wp-block-gallery[\s\S]*?<\/ul>/';

		preg_match_all( $wp_block_galleries, $post->post_content, $block_galleries );

		$wp_block_gallery = $block_galleries[0];

		foreach ( $wp_block_gallery as $block_gallery ) {
			if ( $block_gallery ) {
				echo wp_kses_post( $block_gallery );
			}
		}

		// Images without captions
		$find_images = '~<img.*?\/?>~';

		// Run preg_match_all to grab all the images and save the results
		preg_match_all( $find_images, $post->post_content, $all_images );

		$all_images_array = $all_images[0];

		$caption_link_images = array_merge( $imgs_w_links, $images_with_caption, $wp_block_gallery );

		foreach ( $all_images_array as $image ) {

			str_replace( $image, '', $caption_link_images, $count );

			if( $count == 0 ) {
				echo wp_kses_post( $image );
			}

		}

        if ( get_post_galleries( $post ) && ! post_password_required() ) { ?>

            <div class="entry-gallery">
            	<?php

            		$all_galleries = get_post_galleries( $post );

            		if ( is_single() ) {
	            		foreach( $all_galleries as $gallery ) {
	            			echo $gallery;
	            		}
	            	} else {
	            		echo $all_galleries[0];
	            	}

            	?>
            </div><!-- .entry-gallery -->

		<?php }

		// Videos
		$video_url_selected = str_replace( $embeds, '', $content );
		$video_url = wp_extract_urls( strip_shortcodes( $video_url_selected ) );

		if ( $embeds ) {

			// Check what is the first embed containg video tag, youtube or vimeo
			foreach( $embeds as $embed ) {
				if ( strpos( $embed, 'video' ) || strpos( $embed, 'youtube' ) || strpos( $embed, 'vimeo' ) || strpos( $embed, 'hulu' ) || strpos( $embed, 'animoto' ) || strpos( $embed, 'dailymotion' ) || strpos( $embed, 'educreations' ) || strpos( $embed, 'sproutvideo' ) || strpos( $embed, 'ted.com' )|| strpos( $embed, 'vine.co' ) || strpos( $embed, 'wistia' ) || strpos( $embed, 'kck.st' ) || strpos( $embed, 'spotify' ) || strpos( $embed, 'soundcloud' ) ) {

					echo '<div class="entry-video">' . $embed . '</div>';

				}
			}

		}

		if ( $video_url ) {

			foreach( $video_url as $video_link ) {
				if ( strpos( $video_link, 'vimeo' ) || strpos( $video_link, 'youtube' ) || strpos( $video_link, 'cnnmoney-video' ) || strpos( $video_link, 'dailymotion' ) || strpos( $video_link, 'ted' ) || strpos( $video_link, 'hulu' ) || strpos( $video_link, 'vine' ) || strpos( $video_link, 'kck.st' ) || strpos( $video_link, 'spotify' ) || strpos( $video_link, 'soundcloud' ) ) {

					echo '<div class="entry-video">' . wp_oembed_get( $video_link ) . '</div>';

				}
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
						echo do_shortcode($tag_shortcode);
						break;
					}
				}
			}
		}

	} else {

		if ( 'gallery' != get_post_format() && 'video' != get_post_format() && 'portfolio' != get_post_type() && 'jetpack-portfolio' != get_post_type() ) {
			eris_featured_image();
		}

	}

	if ( 'portfolio' == get_post_type() || 'jetpack-portfolio' == get_post_type() && !eris_is_split_layout() ) {
		eris_featured_image();
	}

	// If is gallery post format or jetpack-portfolio
	if ( 'gallery' == get_post_format() ) :

		$gallery_images = get_post_meta( get_the_ID(), 'eris_repeatable', true );

		if ( !empty( $gallery_images[0] ) ) { ?>

			<div class="entry-gallery">

				<div class="gallery gallery-size-full">

					<?php foreach( $gallery_images as $gallery_image ) : ?>

						<figure class="gallery-item">
							<a href="<?php echo esc_url( $gallery_image ); ?>" class="thickbox" rel="<?php echo esc_attr( get_the_ID() . '-post-gallery' ); ?>">
								<img src="<?php echo esc_url( $gallery_image ); ?> " alt="Gallery image" class="skip-lazy">
							</a>
						</figure>

					<?php endforeach; ?>

				</div>

			</div><!-- .entry-gallery -->

		<?php

		} else {
			if ( !eris_is_split_layout() ) {
				eris_featured_image();
			}
		}

	endif;

	// If is video post format or jetpack-portfolio
	if ( eris_is_split_layout() ) :

        if ( eris_get_embeded_media() ) { ?>

            <div class="entry-video <?php echo esc_attr( eris_get_featured_image_class() ); ?>">
                <?php echo eris_get_embeded_media(); ?>
            </div><!-- .entry-video -->

        <?php }

    endif;

    if ( 'video' == get_post_format() ) {

    	$video_link = get_post_meta( get_the_ID(), 'eris_video_link', true );

		if ( $video_link ) {

			$video_image = eris_get_video_image( $video_link, get_the_ID(), 2 );

			?>
			<div class="entry-video">

				<?php if ( !is_single() && isset( $video_image ) ) :

						$id   = 'eris' . rand();
						$href = "#TB_inline?height=640&width=1000&inlineId=" . $id;

						$video_url = '<div id="' . $id . '" style="display:none;">' . wp_oembed_get( $video_link ) . '</div>';
						$video_url .= '<figure class="featured-image"><a class="thickbox" title="' . get_the_title() . '" href="' . $href . '">' . $video_image . '</a></figure>';

						printf( rawurldecode( $video_url ) );

					else : ?>

					<figure class="featured-image scalable-wrapper">
						<?php echo eris_video_player( $video_link ); ?>
					</figure>

				<?php endif; ?>

			</div><!-- .entry-video -->
<?php

		}
    }

}
endif;

/**
 * Dispalys Author Box under single post content
 *
 * @since  Eris 1.0
 */
if ( ! function_exists( 'eris_author_box' ) ) :
function eris_author_box() {

	$author_desciption = get_the_author_meta( 'description' );

	if ($author_desciption == '') {
		return;
	}
?>

	<div class="container container-small">
		<section class="author-box">
			<figure class="author-avatar">
				<?php echo get_avatar( get_the_author_meta( 'ID' ) ); ?>
			</figure>
			<div class="author-info">
				<h6 class="author-name"><span>Posted by:</span><?php the_author(); ?></h6>
				<p><?php echo $author_desciption; ?></p>
			</div>
		</section>
	</div>

<?php
}
endif;

/**
 * Displays portfolio category filter
 *
 * @since Eris 1.0
 */
if ( ! function_exists( 'eris_category_filter' ) ) :
function eris_category_filter( $type = 'post' ) {

	if ( 'jetpack-portfolio' == $type ) {
		$categories_list = get_terms( 'jetpack-portfolio-type' );
	} elseif ( 'portfolio' == $type && ( !class_exists( 'Jetpack' ) || !post_type_exists( 'jetpack-portfolio' ) ) ) {
		$categories_list = get_terms( 'ct_portfolio' );
	} else {
		$categories_list = get_terms( 'category' );
	}

	if ( ! empty( $categories_list ) && ! is_wp_error( $categories_list ) ) {

		if ( ! is_home() ) {
			if ( isset( get_queried_object()->term_id ) ) {
				$term_id = get_queried_object()->term_id;
			} else {
				$term_id = 0;
			}
		}

		$categories_list_display = '<ul class="category-filter ">';

		if ( is_tax( 'ct_portfolio' ) || is_tax( 'jetpack-portfolio-type' ) ) {

			$categories_list_display .= '<li><a href="' . esc_url( get_permalink( eris_return_portfolio_page( 'id' ) ) ) . '#page-title">' . esc_html__( 'All', 'eris' ) . '</a></li>';

		}

		foreach ( $categories_list as $term ) {

			if ( $term->term_id == $term_id ) {
				$active_class = 'cat-active';
			} else {
				$active_class = '';
			}

			$categories_list_display .= '<li class="' . esc_attr( $active_class ) . '"><a href="' . esc_url( get_term_link( $term ) ) . '">' . $term->name . '</a></li>';

		}

		$categories_list_display .= '</ul>';

		printf( $categories_list_display );

	}

}
endif;

/**
 * Side Social Menu
 *
 * @since Eris 1.0
 */
if ( ! function_exists( 'eris_social_menu' ) ) :
function eris_social_menu() {
	if ( has_nav_menu( 'menu-2' ) ) :

		$args = array(
			'theme_location'  => 'menu-2',
			'container_class' => 'menu-social-container'
		);

		echo '<span id="socMenuTrig" class="social-menu-trig">' . esc_html__( 'Follow', 'eris' ) . '</span>';

		wp_nav_menu( $args );

	endif;
}
endif;

/**
 * Generate and display Footer widgets
 *
 * @since Eris 1.0
 */
if ( ! function_exists( 'eris_footer_widgets' ) ) :
function eris_footer_widgets() {

	$footer_sidebars = array(
		'sidebar-2',
		'sidebar-3'
	);

	foreach ( $footer_sidebars as $footer_sidebar ) {

		if ( is_active_sidebar( $footer_sidebar ) ) { ?>

			<div class="col-sm-6 widget-area">
				<?php dynamic_sidebar( $footer_sidebar );	?>
			</div>

		<?php

		}

	}

}
endif;

/**
 * Displays header on portfolio page template
 *
 * @since Eris 1.0
 */
if ( ! function_exists( 'eris_portfolio_template_slider' ) ) :
function eris_portfolio_template_slider() { ?>

	<div class="featured-slider-wrap hero">
		<div class="verticalize-container container container-medium">

			<div class="featured-slider verticalize">

				<?php

					// Get Featured Slider settings
					$featured_category     = get_theme_mod( 'featured_category_select', 'default' );
					$featured_posts_number = get_theme_mod( 'featured_posts_number', 6 );

					if ( 'default' != $featured_category ) {
						$args = array(
							'post_type'      => array( 'portfolio', 'jetpack-portfolio' ),
							'posts_per_page' => $featured_posts_number,
							'tax_query'      => array(
							'relation'       => 'OR',
						      array(
								'taxonomy'         => 'ct_portfolio',
								'field'            => 'slug',
								'terms'            => array( $featured_category ),
								'include_children' => true,
								'operator'         => 'IN'
						      ),
						      array(
								'taxonomy'         => 'jetpack-portfolio-type',
								'field'            => 'slug',
								'terms'            => array( $featured_category ),
								'include_children' => true,
								'operator'         => 'IN'
						      )
      						)
						);
					} else {
						$args = array(
							'post_type'      => array( 'portfolio', 'jetpack-portfolio' ),
							'posts_per_page' => $featured_posts_number
						);
					}

					$featured_posts = new WP_Query( $args );

					if ( $featured_posts->have_posts() ) :

						while ( $featured_posts->have_posts() ) : $featured_posts->the_post();
							get_template_part( 'templates/template-parts/content-portfolio', 'slide' );
						endwhile;

					endif;

					wp_reset_postdata();

				?>

			</div><!-- .featured-slider -->

		</div><!-- .verticalize-container -->
	</div>

	<?php

}
endif;


/**
 * Custom logo display
 *
 * @since Eris 1.0
 */
if ( ! function_exists( 'eris_the_custom_logo' ) ) :
function eris_the_custom_logo() {

	if ( function_exists( 'the_custom_logo' ) ) {
		the_custom_logo();
	}

}
endif;

/**
 * Displays related posts on single post page
 */
if ( ! function_exists( 'eris_related_posts' ) ) :
function eris_related_posts() {

	$post_id        = get_the_ID();
	$posts_per_page = 3;

	if ( taxonomy_exists( 'jetpack-portfolio-type' ) && 'jetpack-portfolio' == get_post_type() ) {
		$categories = get_the_terms( $post_id, 'jetpack-portfolio-type' );
	} elseif ( 'portfolio' == get_post_type() && ( !class_exists( 'Jetpack' ) || !post_type_exists( 'jetpack-portfolio' ) ) ) {
		$categories = get_the_terms( $post_id, 'ct_portfolio' );
	} else {
		$categories = get_the_terms( $post_id, 'category' );
	}

	$cats = array();

	if ( ! empty( $categories ) ) {
		foreach ( $categories as $category ) {
			$cats[] = $category->term_id;
		}
		$cats = implode( ',', $cats );

		if ( 'portfolio' == get_post_type() || 'jetpack-portfolio' == get_post_type() ) {

			$args = array(
				'post_type'      => array( 'portfolio', 'jetpack-portfolio' ),
				'post_status'    => 'publish',
				'posts_per_page' => $posts_per_page,
				'post__not_in'   => array( $post_id ),
				'tax_query'      => array(
				'relation'       => 'OR',
			      array(
					'taxonomy'         => 'ct_portfolio',
					'field'            => 'id',
					'terms'            => $cats,
					'include_children' => true,
					'operator'         => 'IN'
			      ),
			      array(
					'taxonomy'         => 'jetpack-portfolio-type',
					'field'            => 'id',
					'terms'            => $cats,
					'include_children' => true,
					'operator'         => 'IN'
			      )
				)
			);

		} else {

			$args = array(
				'cat'            => $cats,
				'post_type'      => 'post',
				'post_status'    => 'publish',
				'posts_per_page' => $posts_per_page,
				'post__not_in'   => array( $post_id )
			);

		}

		// Get related posts
		$related_query = new WP_Query( $args );

		// Related posts Loop
		if ( $related_query->have_posts() ) : ?>

			<div id="jp-relatedposts" class="jp-relatedposts">

				<?php if ( 'portfolio' == get_post_type() || 'jetpack-portfolio' == get_post_type() ) { ?>
					<?php printf( '<h3 class="jp-relatedposts-headline">%s</h3>', esc_html__( 'Related Projects', 'eris' ) ); ?>
				<?php } else { ?>
					<?php printf( '<h3 class="jp-relatedposts-headline">%s</h3>', esc_html__( 'Related Articles', 'eris' ) ); ?>
				<?php } ?>

				<div class="jp-relatedposts-items jp-relatedposts-items-visual">

					<?php

						while( $related_query->have_posts() ) : $related_query->the_post();

							get_template_part( 'templates/template-parts/content', 'related' );

						endwhile;

						wp_reset_postdata();

					?>

				</div>
				<!-- .jp-relatedposts-items -->

			</div>
			<!-- .jp-relatedposts -->

			<?php
		endif;

	}
	else {
		return;
	}
}
endif;

/**
 * Wrap video with container
 */
if ( ! function_exists( 'eris_filter_post_content' ) ) :
function eris_filter_post_content( $cached_html, $url, $attr, $post_id ) {
	if ( false !== strpos( $url, 'video' ) || false !== strpos( $url, 'youtube' ) || false !== strpos( $url, 'vimeo' ) || false !== strpos( $url, 'hulu' ) || false !== strpos( $url, 'animoto' ) || false !== strpos( $url, 'dailymotion' ) || false !== strpos( $url, 'educreations' ) || false !== strpos( $url, 'sproutvideo' ) || false !== strpos( $url, 'ted.com' )|| false !== strpos( $url, 'vine.co' ) || false !== strpos( $url, 'wistia' ) || false !== strpos( $url, 'kck.st' ) ) {
		$cached_html = '<div class="entry-video">' . $cached_html . '</div>';
	}
	return $cached_html;
}
endif;
add_filter( 'embed_oembed_html', 'eris_filter_post_content', 99, 4 );


/**
 * Dispaly header logo
 */
if ( ! function_exists( 'eris_display_logo_title' ) ) :
function eris_display_logo_title() {

	$retina_class   = 'standard-logo';
	$headline_class = 'screen-reader-text';

	if ( has_custom_logo() ) {
		$logo = get_custom_logo();
	}

	if ( isset( $logo ) ) :
		// Display logo
		printf( '<a href="%1$s" rel="home" class="%2$s">%3$s</a>', esc_url( home_url( '/' ) ), $retina_class, $logo );
	else :
		$headline_class = '';
	endif;

	if ( '' != get_bloginfo( 'name' ) ) {
		if ( is_front_page() && is_home() ) : ?>
			<h1 class="site-title <?php echo esc_attr( $headline_class ); ?>"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
		<?php else : ?>
			<p class="site-title <?php echo esc_attr( $headline_class ); ?>"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
		<?php endif;
	}

}
endif;
