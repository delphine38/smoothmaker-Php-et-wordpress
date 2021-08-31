<?php
/**
 * Customizer Layout
 *
 * Settings for paging type
 *
 * @package  Eris
 */

/**
 * Section
 */
$wp_customize->add_section( 'paging_settings', array(
    'title'    => esc_html__( 'Paging Settings', 'eris' ),
    'panel'    => 'theme_options_panel',
    'priority' => 120
) );

/**
 * Settings
 */

// Paging Settings
$wp_customize->add_setting( 'paging_setting', array(
    'default'           => 'infinite-scroll',
    'sanitize_callback' => 'eris_sanitize_select',
) );

$wp_customize->add_control( 'paging_setting', array(
    'label'    => esc_html__( 'Choose Archives Paging Type', 'eris' ),
    'priority' => 0,
    'section'  => 'paging_settings',
    'type'     => 'select',
    'choices'  => array(
        'infinite-scroll' => esc_html__( 'Infinite Post Load', 'eris' ),
        'standard-paging' => esc_html__( 'Standard Paging', 'eris' )
    ),
) );

// Infinite Scroll Settings
$wp_customize->add_setting( 'infinite_scroll_type', array(
    'default'           => 'click',
    'sanitize_callback' => 'eris_sanitize_select',
) );

$wp_customize->add_control( 'infinite_scroll_type', array(
    'label'       => esc_html__( 'Choose infinite load type', 'eris' ),
    'description' => esc_html__( '( If infinite scroll choosen )', 'eris' ),
    'priority'    => 1,
    'section'     => 'paging_settings',
    'type'        => 'select',
    'choices'     => array(
        'scroll' => esc_html__( 'On scroll', 'eris' ),
        'click'  => esc_html__( 'On click', 'eris' )
    ),
) );
