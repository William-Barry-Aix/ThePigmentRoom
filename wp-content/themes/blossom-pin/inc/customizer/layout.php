<?php
/**
 * Blossom Pin Layout Settings
 *
 * @package Blossom_Pin
 */

function blossom_pin_customize_register_layout( $wp_customize ) {
	
    /** Home Page Layout Settings */
    $wp_customize->add_panel(
        'layout_settings',
        array(
            'title'       => __( 'Layout Settings', 'blossom-pin' ),
            'capability'  => 'edit_theme_options',
            'priority'    => 55,
        )
    );

     /** Header Layout Settings */
     $wp_customize->add_section(
        'header_layout',
        array(
            'title'    => __( 'Header Layout', 'blossom-pin' ),
            'priority' => 9,
            'panel'    => 'layout_settings',
        )
    );

    /* Note */
    $wp_customize->add_setting(
        'header_layout_img_text',
        array(
            'default'           => '',
            'sanitize_callback' => 'wp_kses_post' 
        )
    );

    $wp_customize->add_control(
        new Blossom_Pin_Note_Control( 
            $wp_customize,
            'header_layout_img_text',
            array(
                'section'     => 'header_layout',
                'priority'    => 50,
                'description' => sprintf( __( '%1$sThis feature is available in Pro version.%2$s %3$sUpgrade to Pro%4$s ', 'blossom-pin' ),'<div class="featured-pro"><span>', '</span>', '<a href="https://blossomthemes.com/wordpress-themes/blossom-pin-pro/?utm_source=blossom_pin&utm_medium=customizer&utm_campaign=upgrade_to_pro" target="_blank">', '</a></div>' ),
            )
        )
    );


    $wp_customize->add_setting( 
        'header_layout_settings', 
        array(
            'default'           => 'one',
            'sanitize_callback' => 'blossom_pin_sanitize_radio'
        ) 
    );

    $wp_customize->add_control(
        new Blossom_Pin_Radio_Image_Control(
            $wp_customize,
            'header_layout_settings',
            array(
                'section'     => 'header_layout',
                'priority'    => 50,
                'choices'     => array(
                    'one'       => get_template_directory_uri() . '/images/pro/header-layout.png',
                ),
            )
        )
    );

    /** Slider Layout Settings */
     $wp_customize->add_section(
        'slider_layout_settings',
        array(
            'title'    => __( 'Slider Layout', 'blossom-pin' ),
            'priority' => 9,
            'panel'    => 'layout_settings',
        )
    );

    /* Note */
    $wp_customize->add_setting(
        'slider_layout_img_text',
        array(
            'default'           => '',
            'sanitize_callback' => 'wp_kses_post' 
        )
    );

    $wp_customize->add_control(
        new Blossom_Pin_Note_Control( 
            $wp_customize,
            'slider_layout_img_text',
            array(
                'section'     => 'slider_layout_settings',
                'priority'    => 50,
                'description' => sprintf( __( '%1$sThis feature is available in Pro version.%2$s %3$sUpgrade to Pro%4$s ', 'blossom-pin' ),'<div class="featured-pro"><span>', '</span>', '<a href="https://blossomthemes.com/wordpress-themes/blossom-pin-pro/?utm_source=blossom_pin&utm_medium=customizer&utm_campaign=upgrade_to_pro" target="_blank">', '</a></div>' ),
            )
        )
    );


    $wp_customize->add_setting( 
        'slider_layout_settings', 
        array(
            'default'           => 'one',
            'sanitize_callback' => 'blossom_pin_sanitize_radio'
        ) 
    );

    $wp_customize->add_control(
        new Blossom_Pin_Radio_Image_Control(
            $wp_customize,
            'slider_layout_settings',
            array(
                'section'     => 'slider_layout_settings',
                'priority'    => 50,
                'choices'     => array(
                    'one'       => get_template_directory_uri() . '/images/pro/slider-layout.png',
                ),
            )
        )
    );

    /** Home Page Layout Settings */
     $wp_customize->add_section(
        'blog_layout',
        array(
            'title'    => __( 'Home Page Layout', 'blossom-pin' ),
            'panel'    => 'layout_settings',
        )
    );

    /* Note */
    $wp_customize->add_setting(
        'home_page_img_layout_text',
        array(
            'default'           => '',
            'sanitize_callback' => 'wp_kses_post' 
        )
    );

    $wp_customize->add_control(
        new Blossom_Pin_Note_Control( 
            $wp_customize,
            'home_page_img_layout_text',
            array(
                'section'     => 'blog_layout',
                'priority'    => 50,
                'description' => sprintf( __( '%1$sThis feature is available in Pro version.%2$s %3$sUpgrade to Pro%4$s ', 'blossom-pin' ),'<div class="featured-pro"><span>', '</span>', '<a href="https://blossomthemes.com/wordpress-themes/blossom-pin-pro/?utm_source=blossom_pin&utm_medium=customizer&utm_campaign=upgrade_to_pro" target="_blank">', '</a></div>' ),
            )
        )
    );


    $wp_customize->add_setting( 
        'home_page_layout_settings', 
        array(
            'default'           => 'one',
            'sanitize_callback' => 'blossom_pin_sanitize_radio'
        ) 
    );

    $wp_customize->add_control(
        new Blossom_Pin_Radio_Image_Control(
            $wp_customize,
            'home_page_layout_settings',
            array(
                'section'     => 'blog_layout',
                'priority'    => 50,
                'choices'     => array(
                    'one'       => get_template_directory_uri() . '/images/pro/home-layout.png',
                ),
            )
        )
    );

    /** Archive Page Layout Settings */
     $wp_customize->add_section(
        'archive_layout',
        array(
            'title'    => __( 'Archive Page Layout', 'blossom-pin' ),
            'panel'    => 'layout_settings',
        )
    );

    /* Note */
    $wp_customize->add_setting(
        'archive_page_img_layout_text',
        array(
            'default'           => '',
            'sanitize_callback' => 'wp_kses_post' 
        )
    );

    $wp_customize->add_control(
        new Blossom_Pin_Note_Control( 
            $wp_customize,
            'archive_page_img_layout_text',
            array(
                'section'     => 'archive_layout',
                'priority'    => 50,
                'description' => sprintf( __( '%1$sThis feature is available in Pro version.%2$s %3$sUpgrade to Pro%4$s ', 'blossom-pin' ),'<div class="featured-pro"><span>', '</span>', '<a href="https://blossomthemes.com/wordpress-themes/blossom-pin-pro/?utm_source=blossom_pin&utm_medium=customizer&utm_campaign=upgrade_to_pro" target="_blank">', '</a></div>' ),
            )
        )
    );


    $wp_customize->add_setting( 
        'archive_page_layout_settings', 
        array(
            'default'           => 'one',
            'sanitize_callback' => 'blossom_pin_sanitize_radio'
        ) 
    );

    $wp_customize->add_control(
        new Blossom_Pin_Radio_Image_Control(
            $wp_customize,
            'archive_page_layout_settings',
            array(
                'section'     => 'archive_layout',
                'priority'    => 50,
                'choices'     => array(
                    'one'       => get_template_directory_uri() . '/images/pro/archive-layout.png',
                ),
            )
        )
    );

    /** Single Post Layout Settings */
     $wp_customize->add_section(
        'single_post_layout_image_section',
        array(
            'title'    => __( 'Single Post Layout', 'blossom-pin' ),
            'panel'    => 'layout_settings',
        )
    );

    /* Note */
    $wp_customize->add_setting(
        'single_post_layout_text',
        array(
            'default'           => '',
            'sanitize_callback' => 'wp_kses_post' 
        )
    );

    $wp_customize->add_control(
        new Blossom_Pin_Note_Control( 
            $wp_customize,
            'single_post_layout_text',
            array(
                'section'     => 'single_post_layout_image_section',
                'description' => sprintf( __( '%1$sThis feature is available in Pro version.%2$s %3$sUpgrade to Pro%4$s ', 'blossom-pin' ),'<div class="featured-pro"><span>', '</span>', '<a href="https://blossomthemes.com/wordpress-themes/blossom-pin-pro/?utm_source=blossom_pin&utm_medium=customizer&utm_campaign=upgrade_to_pro" target="_blank">', '</a></div>' ),
            )
        )
    );


    $wp_customize->add_setting( 
        'single_post_layout_settings', 
        array(
            'default'           => 'one',
            'sanitize_callback' => 'blossom_pin_sanitize_radio'
        ) 
    );

    $wp_customize->add_control(
        new Blossom_Pin_Radio_Image_Control(
            $wp_customize,
            'single_post_layout_settings',
            array(
                'section'     => 'single_post_layout_image_section',
                'choices'     => array(
                    'one'       => get_template_directory_uri() . '/images/pro/single-layout.png',
                ),
            )
        )
    );

    $wp_customize->add_section(
        'sidebar_layout_settings',
        array(
            'title'       => __( 'General Sidebar Layout', 'blossom-pin' ),
            'description' => __( 'Change Page, Post and General sidebar layout from here.', 'blossom-pin' ),
            'capability'  => 'edit_theme_options',
            'panel'       => 'layout_settings',
        )
    );
    
    /** Page Sidebar layout */
    $wp_customize->add_setting( 
        'page_sidebar_layout', 
        array(
            'default'           => 'right-sidebar',
            'sanitize_callback' => 'blossom_pin_sanitize_radio'
        ) 
    );
    
    $wp_customize->add_control(
		new Blossom_Pin_Radio_Image_Control(
			$wp_customize,
			'page_sidebar_layout',
			array(
				'section'	  => 'sidebar_layout_settings',
				'label'		  => __( 'Page Sidebar Layout', 'blossom-pin' ),
				'description' => __( 'This is the general sidebar layout for pages. You can override the sidebar layout for individual page in respective page.', 'blossom-pin' ),
				'choices'	  => array(
                    'centered'      => esc_url( get_template_directory_uri() . '/images/1cc.jpg' ),
					'left-sidebar'  => esc_url( get_template_directory_uri() . '/images/2cl.jpg' ),
                    'right-sidebar' => esc_url( get_template_directory_uri() . '/images/2cr.jpg' ),
				)
			)
		)
	);
    
    /** Post Sidebar layout */
    $wp_customize->add_setting( 
        'post_sidebar_layout', 
        array(
            'default'           => 'right-sidebar',
            'sanitize_callback' => 'blossom_pin_sanitize_radio'
        ) 
    );
    
    $wp_customize->add_control(
		new Blossom_Pin_Radio_Image_Control(
			$wp_customize,
			'post_sidebar_layout',
			array(
				'section'	  => 'sidebar_layout_settings',
				'label'		  => __( 'Post Sidebar Layout', 'blossom-pin' ),
				'description' => __( 'This is the general sidebar layout for posts. You can override the sidebar layout for individual post in respective post.', 'blossom-pin' ),
				'choices'	  => array(
                    'centered'      => esc_url( get_template_directory_uri() . '/images/1cc.jpg' ),
					'left-sidebar'  => esc_url( get_template_directory_uri() . '/images/2cl.jpg' ),
                    'right-sidebar' => esc_url( get_template_directory_uri() . '/images/2cr.jpg' ),
				)
			)
		)
	);
    
    /** Default Sidebar layout */
    $wp_customize->add_setting( 
        'layout_style', 
        array(
            'default'           => 'right-sidebar',
            'sanitize_callback' => 'blossom_pin_sanitize_radio'
        ) 
    );
    
    $wp_customize->add_control(
		new Blossom_Pin_Radio_Image_Control(
			$wp_customize,
			'layout_style',
			array(
				'section'	  => 'sidebar_layout_settings',
				'label'		  => __( 'Default Sidebar Layout', 'blossom-pin' ),
				'description' => __( 'This is the general sidebar layout for whole site.', 'blossom-pin' ),
				'choices'	  => array(
					'no-sidebar'    => esc_url( get_template_directory_uri() . '/images/1c.jpg' ),
                    'left-sidebar'  => esc_url( get_template_directory_uri() . '/images/2cl.jpg' ),
                    'right-sidebar' => esc_url( get_template_directory_uri() . '/images/2cr.jpg' ),
				)
			)
		)
	);
    
    $wp_customize->add_section( 
        'pagination_settings',
         array(
            'capability'  => 'edit_theme_options',
            'title'       => esc_html__( 'Pagination', 'blossom-pin' ),
            'panel'       => 'layout_settings',
        ) 
    );

    /** Pagination Type */
    $wp_customize->add_setting(
        'pagination_type',
        array(
            'default'           => 'default',
            'sanitize_callback' => 'blossom_pin_sanitize_select',
        )
    );
    
    $wp_customize->add_control(
        'pagination_type',
        array(
            'label'       => esc_html__( 'Pagination Type', 'blossom-pin' ),
            'description' => esc_html__( 'Select pagination type.', 'blossom-pin' ),
            'section'     => 'pagination_settings',
            'type'        => 'radio',
            'choices'     => array(
                'default'         => esc_html__( 'Default (Next / Previous)', 'blossom-pin' ),
                'infinite_scroll' => esc_html__( 'AJAX (Auto Infinite Scroll)', 'blossom-pin' ),
            )
        )
    ); 
    
    /* Note */
    $wp_customize->add_setting(
        'pagination_layout_text',
        array(
            'default'           => '',
            'sanitize_callback' => 'wp_kses_post' 
        )
    );

    $wp_customize->add_control(
        new Blossom_Pin_Note_Control( 
            $wp_customize,
            'pagination_layout_text',
            array(
                'section'     => 'pagination_settings',
                'description' => sprintf( __( '%1$sThis feature is available in Pro version.%2$s %3$sUpgrade to Pro%4$s ', 'blossom-pin' ),'<div class="featured-pro"><span>', '</span>', '<a href="https://blossomthemes.com/wordpress-themes/blossom-pin-pro/?utm_source=blossom_pin&utm_medium=customizer&utm_campaign=upgrade_to_pro" target="_blank">', '</a></div>' ),
            )
        )
    );


    $wp_customize->add_setting( 
        'pagination_layout_settings', 
        array(
            'default'           => 'one',
            'sanitize_callback' => 'blossom_pin_sanitize_radio'
        ) 
    );

    $wp_customize->add_control(
        new Blossom_Pin_Radio_Image_Control(
            $wp_customize,
            'pagination_layout_settings',
            array(
                'section'     => 'pagination_settings',
                'choices'     => array(
                    'one'       => get_template_directory_uri() . '/images/pro/pagination.png',
                ),
            )
        )
    );
    
}
add_action( 'customize_register', 'blossom_pin_customize_register_layout' );