<?php
/**
 * Customizer Custom Colors
 *
 * Here you can define your own CSS rules
 *
 * @package  Eris
 */

/*
 *
 * Sections
 *
 */
$wp_customize->add_section( 'eris_colors_section', array(
    'title'    => esc_html__( 'General Theme Colors', 'eris' ),
    'priority' => 0,
    'panel'    => 'eris_colors_panel'
) );

$wp_customize->add_section( 'eris_header_colors_section', array(
    'title'    => esc_html__( 'Header Colors', 'eris' ),
    'priority' => 1,
    'panel'    => 'eris_colors_panel'
) );

$wp_customize->add_section( 'eris_slider_colors_section', array(
    'title'    => esc_html__( 'Portfolio Slider Colors', 'eris' ),
    'priority' => 2,
    'panel'    => 'eris_colors_panel'
) );

$wp_customize->add_section( 'eris_footer_colors_section', array(
    'title'    => esc_html__( 'Footer Colors', 'eris' ),
    'priority' => 3,
    'panel'    => 'eris_colors_panel'
) );


/**
 *
 * Settings
 *
 */

/* GENERAL COLORS */

// Body BG color
$wp_customize->add_setting( 'eris_body_bg_color', array(
    'default'           => '#fff',
    'sanitize_callback' => 'eris_sanitize_color'
));

$wp_customize->add_control(
    new WP_Customize_Color_Control(
        $wp_customize,
        'eris_body_bg_color',
        array(
            'label'    => esc_html__( 'Background Color', 'eris' ),
            'section'  => 'eris_colors_section',
            'priority' => 0
        ) )
);

// Body BG color
$wp_customize->add_setting( 'eris_slider_bg_color', array(
    'default'           => '#e8eaec ',
    'sanitize_callback' => 'eris_sanitize_color'
));

$wp_customize->add_control(
    new WP_Customize_Color_Control(
        $wp_customize,
        'eris_slider_bg_color',
        array(
            'label'    => esc_html__( 'Slider Background Color', 'eris' ),
            'section'  => 'eris_header_colors_section',
            'priority' => 0
        ) )
);

// Headings color
$wp_customize->add_setting( 'eris_heading_color', array(
    'default'           => '#000',
    'sanitize_callback' => 'eris_sanitize_color'
));

$wp_customize->add_control(
    new WP_Customize_Color_Control(
        $wp_customize,
        'eris_heading_color',
        array(
            'label'    => esc_html__( 'Headings Color', 'eris' ),
            'section'  => 'eris_colors_section',
            'priority' => 1
        ) )
);

$wp_customize->add_setting( 'eris_heading_hover_color', array(
    'default'           => '#747474',
    'sanitize_callback' => 'eris_sanitize_color'
));

$wp_customize->add_control(
    new WP_Customize_Color_Control(
        $wp_customize,
        'eris_heading_hover_color',
        array(
            'label'    => esc_html__( 'Headings Link Hover Color', 'eris' ),
            'section'  => 'eris_colors_section',
            'priority' => 2
        ) )
);

// Paragraph color
$wp_customize->add_setting( 'eris_paragraph_color', array(
    'default'           => '#5d5d5d',
    'sanitize_callback' => 'eris_sanitize_color'
));

$wp_customize->add_control(
    new WP_Customize_Color_Control(
        $wp_customize,
        'eris_paragraph_color',
        array(
            'label'    => esc_html__( 'Paragraph / Text Color', 'eris' ),
            'section'  => 'eris_colors_section',
            'priority' => 3
        ) )
);

// Link color
$wp_customize->add_setting( 'eris_link_color', array(
    'default'           => '#000',
    'sanitize_callback' => 'eris_sanitize_color'
));

$wp_customize->add_control(
    new WP_Customize_Color_Control(
        $wp_customize,
        'eris_link_color',
        array(
            'label'    => esc_html__( 'Link Color', 'eris' ),
            'section'  => 'eris_colors_section',
            'priority' => 4
        ) )
);

// Link Hover color
$wp_customize->add_setting( 'eris_link_hover_color', array(
    'default'           => '#5d5d5d',
    'sanitize_callback' => 'eris_sanitize_color'
));

$wp_customize->add_control(
    new WP_Customize_Color_Control(
        $wp_customize,
        'eris_link_hover_color',
        array(
            'label'    => esc_html__( 'Link Hover Color', 'eris' ),
            'section'  => 'eris_colors_section',
            'priority' => 5
        ) )
);

// Meta Link color
$wp_customize->add_setting( 'eris_meta_link_color', array(
    'default'           => '#000',
    'sanitize_callback' => 'eris_sanitize_color'
));

$wp_customize->add_control(
    new WP_Customize_Color_Control(
        $wp_customize,
        'eris_meta_link_color',
        array(
            'label'    => esc_html__( 'Meta Data Link Color', 'eris' ),
            'section'  => 'eris_colors_section',
            'priority' => 6
        ) )
);

// Meta Link Hover color
$wp_customize->add_setting( 'eris_meta_link_hover_color', array(
    'default'           => '#808080',
    'sanitize_callback' => 'eris_sanitize_color'
));

$wp_customize->add_control(
    new WP_Customize_Color_Control(
        $wp_customize,
        'eris_meta_link_hover_color',
        array(
            'label'    => esc_html__( 'Meta Data Hover Color', 'eris' ),
            'section'  => 'eris_colors_section',
            'priority' => 7
        ) )
);

/* HEADER COLORS */

// Navigation color
$wp_customize->add_setting( 'eris_navigation_color', array(
    'default'           => '#000',
    'sanitize_callback' => 'eris_sanitize_color'
) );

$wp_customize->add_control(
    new WP_Customize_Color_Control(
        $wp_customize,
        'eris_navigation_color',
        array(
            'label'    => esc_html__( 'Navigation Color', 'eris' ),
            'section'  => 'eris_header_colors_section',
            'priority' => 1
        ) )
);

// Navigation hover color
$wp_customize->add_setting( 'eris_navigation_hover_color', array(
    'default'           => '#808080',
    'sanitize_callback' => 'eris_sanitize_color'
));

$wp_customize->add_control(
    new WP_Customize_Color_Control(
        $wp_customize,
        'eris_navigation_hover_color',
        array(
            'label'    => esc_html__( 'Navigation Hover Color', 'eris' ),
            'section'  => 'eris_header_colors_section',
            'priority' => 2
        ) )
);

// Logo color
$wp_customize->add_setting( 'eris_logo_color', array(
    'default'           => '#000',
    'sanitize_callback' => 'eris_sanitize_color'
));

$wp_customize->add_control(
    new WP_Customize_Color_Control(
        $wp_customize,
        'eris_logo_color',
        array(
            'label'    => esc_html__( 'Logo Color', 'eris' ),
            'section'  => 'eris_header_colors_section',
            'priority' => 3
        ) )
);

// Logo hover color
$wp_customize->add_setting( 'eris_logo_hover_color', array(
    'default'           => '#808080',
    'sanitize_callback' => 'eris_sanitize_color'
));

$wp_customize->add_control(
    new WP_Customize_Color_Control(
        $wp_customize,
        'eris_logo_hover_color',
        array(
            'label'    => esc_html__( 'Logo Hover Color', 'eris' ),
            'section'  => 'eris_header_colors_section',
            'priority' => 4
        ) )
);

// Logo description color
$wp_customize->add_setting( 'eris_logo_description_color', array(
    'default'           => '#000',
    'sanitize_callback' => 'eris_sanitize_color'
));

$wp_customize->add_control(
    new WP_Customize_Color_Control(
        $wp_customize,
        'eris_logo_description_color',
        array(
            'label'    => esc_html__( 'Logo Description Color', 'eris' ),
            'section'  => 'eris_header_colors_section',
            'priority' => 5
        ) )
);

/* FOOTER COLORS */

// Footer comments color
$wp_customize->add_setting( 'eris_comments_background_color', array(
    'default'           => '#eaedf3',
    'sanitize_callback' => 'eris_sanitize_color'
));

$wp_customize->add_control(
    new WP_Customize_Color_Control(
        $wp_customize,
        'eris_comments_background_color',
        array(
            'label'    => esc_html__( 'Comment Area Bg Color', 'eris' ),
            'section'  => 'eris_footer_colors_section',
            'priority' => 6
        ) )
);

// Footer Text color
$wp_customize->add_setting( 'eris_footer_text_color', array(
    'default'           => '#000',
    'sanitize_callback' => 'eris_sanitize_color'
));

$wp_customize->add_control(
    new WP_Customize_Color_Control(
        $wp_customize,
        'eris_footer_text_color',
        array(
            'label'    => esc_html__( 'Footer Text Color', 'eris' ),
            'section'  => 'eris_footer_colors_section',
            'priority' => 7
        ) )
);

// Footer links color
$wp_customize->add_setting( 'eris_footer_links_color', array(
    'default'           => '#000',
    'sanitize_callback' => 'eris_sanitize_color'
));

$wp_customize->add_control(
    new WP_Customize_Color_Control(
        $wp_customize,
        'eris_footer_links_color',
        array(
            'label'    => esc_html__( 'Footer Links Color', 'eris' ),
            'section'  => 'eris_footer_colors_section',
            'priority' => 8
        ) )
);

// Footer links hover color
$wp_customize->add_setting( 'eris_footer_links_hover_color', array(
    'default'           => '#5d5d5d',
    'sanitize_callback' => 'eris_sanitize_color'
));

$wp_customize->add_control(
    new WP_Customize_Color_Control(
        $wp_customize,
        'eris_footer_links_hover_color',
        array(
            'label'    => esc_html__( 'Footer Links Hover Color', 'eris' ),
            'section'  => 'eris_footer_colors_section',
            'priority' => 9
        ) )
);

/* HOME SLIDER COLORS */

// Slider title and arrows color
$wp_customize->add_setting( 'eris_slider_links_color', array(
    'default'           => '#000',
    'sanitize_callback' => 'eris_sanitize_color'
));

$wp_customize->add_control(
    new WP_Customize_Color_Control(
        $wp_customize,
        'eris_slider_links_color',
        array(
            'label'    => esc_html__( 'Title And Arrows Color', 'eris' ),
            'section'  => 'eris_slider_colors_section',
            'priority' => 0
        ) )
);

// Slider title and arrows hover color
$wp_customize->add_setting( 'eris_slider_links_hover_color', array(
    'default'           => '#808080',
    'sanitize_callback' => 'eris_sanitize_color'
));

$wp_customize->add_control(
    new WP_Customize_Color_Control(
        $wp_customize,
        'eris_slider_links_hover_color',
        array(
            'label'    => esc_html__( 'Title And Arrows Hover Color', 'eris' ),
            'section'  => 'eris_slider_colors_section',
            'priority' => 0
        ) )
);

