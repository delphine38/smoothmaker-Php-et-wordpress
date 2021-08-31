<?php
/**
 * Post metaboxes configuration
 *
 * @package  Eris
 */


$prefix     = 'eris_';
$meta_boxes = array(
    array(
        'id'       => 'post_format_gallery',
        'title'    => esc_html__( 'Gallery Fields', 'eris' ),
        'pages'    => array( 'post' ),
        'context'  => 'normal',
        'priority' => 'high',
        'fields'   => array(
            array(
                'label' => esc_html__( 'Repeatable', 'eris' ),
                'name'  => esc_html__( 'Gallery images', 'eris' ),
                'desc'  => '',
                'id'    => $prefix . 'repeatable',
                'type'  => 'repeatable'
            )
        )
    ),
    array(
        'id'       => 'post_format_link',
        'title'    => esc_html__( 'Link', 'eris' ),
        'pages'    => array( 'post' ),
        'context'  => 'normal',
        'priority' => 'high',
        'fields'   => array(
            array(
                'name' => esc_html__( 'Link Text', 'eris' ),
                'desc' => '',
                'id'   => $prefix . 'link_text',
                'type' => 'textarea',
                'std'  => '',
                'options' => array(
                    'rows' => '4',
                    'cols' => '12'
                )
            ),
            array(
                'name' => esc_html__( 'Link Title', 'eris' ),
                'desc' => '',
                'id'   => $prefix . 'link_title',
                'type' => 'text',
                'std'  => ''
            ),
            array(
                'name' => esc_html__( 'Link Url', 'eris' ),
                'desc' => '',
                'id'   => $prefix . 'link_url',
                'type' => 'text',
                'std'  => ''
            )
        )
    ),
    array(
        'id'       => 'post_format_quote',
        'title'    => esc_html__( 'Quote Text', 'eris' ),
        'pages'    => array( 'post' ),
        'context'  => 'normal',
        'priority' => 'high',
        'fields'   => array(
            array(
                'name' => esc_html__( 'Quote Text', 'eris' ),
                'desc' => '',
                'id'   => $prefix . 'quote',
                'type' => 'textarea',
                'std'  => '',
                'options' => array(
                    'rows' => '4',
                    'cols' => '12'
                )
            ),
            array(
                'name' => esc_html__( 'Quote Author', 'eris' ),
                'desc' => '',
                'id'   => $prefix . 'quote_author',
                'type' => 'text',
                'std'  => ''
            )
        )
    ),
    array(
        'id'       => 'post_format_video',
        'title'    => esc_html__( 'Video Link', 'eris' ),
        'pages'    => array( 'post', 'gallery', 'event' ),
        'context'  => 'normal',
        'priority' => 'high',
        'fields'   => array(
            array(
                'name' => esc_html__( 'Video Link', 'eris' ),
                'desc' => esc_html__( 'Paste your video link (e.g. http://www.youtube.com/watch?v=zMtKfSSGkIY or https://vimeo.com/64814911)', 'eris' ),
                'id'   => $prefix . 'video_link',
                'type' => 'text',
                'std'  => '',
                'options' => array(
                    'rows' => '4',
                    'cols' => '12'
                )
            )
        )
    ),
    array(
        'id'       => 'post_format_audio',
        'title'    => esc_html__( 'Audio Options', 'eris' ),
        'pages'    => array( 'post' ),
        'context'  => 'normal',
        'priority' => 'high',
        'fields'   => array(
            array(
                'name' => esc_html__( 'Audio Link', 'eris' ),
                'desc' => esc_html__( 'Paste your audio link or audio embed HTML code', 'eris' ),
                'id'   => $prefix . 'audio_link',
                'type' => 'textarea',
                'std'  => '',
                'options' => array(
                    'rows' => '4',
                    'cols' => '12'
                )
            ),
        )
    ),
    array(
        'id'       => 'portfolio_display_type',
        'title'    => esc_html__( 'Display type', 'eris' ),
        'pages'    => array( 'portfolio', 'jetpack-portfolio' ),
        'context'  => 'side',
        'priority' => 'high',
        'fields'   => array(
            array(
                'name' => esc_html__( 'Display layout', 'eris' ),
                'desc' => esc_html__( 'Select how you wish to display this project', 'eris' ),
                'id'   => $prefix . 'portfolio_display_type',
                'type' => 'select',
                'std'  => '',
                'options' => array(
                    esc_html__( 'Standard', 'eris' ) => 'standard',
                    esc_html__( 'Split', 'eris' )    => 'split',
                )
            ),
        )
    )

);
