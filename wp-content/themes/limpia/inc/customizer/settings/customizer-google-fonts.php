<?php
/**
 * Customize Google Fonts
 *
 * @package Eris
 */

// Kirki config

Kirki::add_config( 'eris', array(
	'capability'  => 'edit_theme_options',
	'option_type' => 'option',
	'option_name' => 'eris',
) );

/* --- Section --- */

// Front Page Slider Section
Kirki::add_section( 'google_fonts_section', array(
	'title'       => esc_html__( 'Font Settings', 'eris' ),
	'description' => esc_html__( 'Choose fonts for your content', 'eris' ),
	'priority'    => 200
) );

/* --- Settings --- */

/* --- Settings --- */
Kirki::add_field( 'eris', array(
	'type'        => 'typography',
	'settings'    => 'font_paragraph_settings',
	'label'       => esc_attr__( 'Paragraphs', 'eris' ),
	'section'     => 'google_fonts_section',
	'default'     => array(
		'font-family'    => '"sk-modernist", "Helvetica Neue", Helvetica, Arial, sans-serif',
		'variant'        => 'regular',
		'subsets'        => array( 'latin-ext' ),
	),
	'priority'    => 10,
	'output'      => array(
		array(
			'element' => 'body, input, textarea, keygen, select, button, body #site-navigation #primary-menu li a, body .jp-carousel-wrap, .jp-carousel-wrap .jp-carousel-light #carousel-reblog-box input#carousel-reblog-submit, .jp-carousel-wrap #jp-carousel-comment-form-button-submit, .jp-carousel-wrap textarea#jp-carousel-comment-form-comment-field, .portfolio-item h2',
		),
	),
) );

Kirki::add_field( 'eris', array(
	'type'        => 'typography',
	'settings'    => 'font_heading_settings',
	'label'       => esc_attr__( 'Headings', 'eris' ),
	'section'     => 'google_fonts_section',
	'default'     => array(
		'font-family'    => '"sk-modernist", "Helvetica Neue", Helvetica, Arial, sans-serif',
		'variant'        => 'bold',
		'subsets'        => array( 'latin-ext' ),
	),
	'priority'    => 20,
	'output'      => array(
		array(
			'element' => 'h1, h2, h3, h4, h5, h6, .entry-content h2 a, .emphasis',
		),
	),
) );

Kirki::add_field( 'eris', array(
	'type'        => 'typography',
	'settings'    => 'font_nav_settings',
	'label'       => esc_attr__( 'Navigation', 'eris' ),
	'section'     => 'google_fonts_section',
	'default'     => array(
		'font-family'    => '"sk-modernist", "Helvetica Neue", Helvetica, Arial, sans-serif',
		'variant'        => 'regular',
		'subsets'        => array( 'latin-ext' ),
	),
	'priority'    => 30,
	'output'      => array(
		array(
			'element' => 'body #site-navigation #primary-menu li a',
		),
	),
) );
