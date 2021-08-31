<?php
/**
 * Customizer Custom CSS
 *
 * Here you can define your own CSS rules
 *
 * @package  Eris
 */

/* --- Section --- */

// Custom CSS section
$wp_customize->add_section( 'footer_section', array(
    'title'    => esc_html__( 'Footer Copyright', 'eris' ),
    'panel'    => 'theme_options_panel',
    'priority' => 210
) );

/* --- Settings --- */

// Enable footer_title Section
$wp_customize->add_setting( 'footer_title_enable', array(
    'default'           => 1,
    'sanitize_callback' => 'eris_sanitize_select'
) );

$wp_customize->add_control( 'footer_title_enable', array(
    'label'    => esc_html__( 'Check to enable footer logo / title', 'eris' ),
    'section'  => 'footer_section',
    'priority' => 0,
    'type'     => 'checkbox'
) );

// Footer Copyright text
$wp_customize->add_setting( 'eris_footer_copyright', array(
    'default'           => '',
    'sanitize_callback' => 'eris_sanitize_text',
) );

$wp_customize->add_control( 'eris_footer_copyright', array(
    'label'    => esc_html__( 'Footer Copyright Text', 'eris' ),
    'section'  => 'footer_section',
    'priority' => 1,
    'settings' => 'eris_footer_copyright',
    'type'     => 'textarea'
) );
