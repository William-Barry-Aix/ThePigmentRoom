<?php
/**
 * Blossom Pin Appearance Settings
 *
 * @package Blossom_Pin
 */

function blossom_pin_customize_register_appearance( $wp_customize ) {
    
    /** Appearance Settings */
    $wp_customize->add_panel( 
        'appearance_settings',
         array(
            'priority'    => 50,
            'capability'  => 'edit_theme_options',
            'title'       => __( 'Appearance Settings', 'blossom-pin' ),
            'description' => __( 'Customize Typography & Background Image', 'blossom-pin' ),
        ) 
    );
    
    /** Typography */
    $wp_customize->add_section(
        'typography_settings',
        array(
            'title'    => __( 'Typography', 'blossom-pin' ),
            'priority' => 15,
            'panel'    => 'appearance_settings',
        )
    );
    
    /** Primary Font */
    $wp_customize->add_setting(
		'primary_font',
		array(
			'default'			=> 'Nunito',
			'sanitize_callback' => 'blossom_pin_sanitize_select'
		)
	);

	$wp_customize->add_control(
		new Blossom_Pin_Select_Control(
    		$wp_customize,
    		'primary_font',
    		array(
                'label'	      => __( 'Primary Font', 'blossom-pin' ),
                'description' => __( 'Primary font of the site.', 'blossom-pin' ),
    			'section'     => 'typography_settings',
    			'choices'     => blossom_pin_get_all_fonts(),	
     		)
		)
	);
    
    /** Secondary Font */
    $wp_customize->add_setting(
		'secondary_font',
		array(
			'default'			=> 'Cormorant Garamond',
			'sanitize_callback' => 'blossom_pin_sanitize_select'
		)
	);

	$wp_customize->add_control(
		new Blossom_Pin_Select_Control(
    		$wp_customize,
    		'secondary_font',
    		array(
                'label'	      => __( 'Secondary Font', 'blossom-pin' ),
                'description' => __( 'Secondary font of the site.', 'blossom-pin' ),
    			'section'     => 'typography_settings',
    			'choices'     => blossom_pin_get_all_fonts(),	
     		)
		)
	);
    
    /** Font Size*/
    $wp_customize->add_setting( 
        'font_size', 
        array(
            'default'           => 18,
            'sanitize_callback' => 'blossom_pin_sanitize_number_absint'
        ) 
    );
    
    $wp_customize->add_control(
		new Blossom_Pin_Slider_Control( 
			$wp_customize,
			'font_size',
			array(
				'section'	  => 'typography_settings',
				'label'		  => __( 'Font Size', 'blossom-pin' ),
				'description' => __( 'Change the font size of your site.', 'blossom-pin' ),
                'choices'	  => array(
					'min' 	=> 10,
					'max' 	=> 50,
					'step'	=> 1,
				)                 
			)
		)
	);

    $wp_customize->add_setting(
        'ed_localgoogle_fonts',
        array(
            'default'           => false,
            'sanitize_callback' => 'blossom_pin_sanitize_checkbox',
        )
    );
    
    $wp_customize->add_control(
        new Blossom_Pin_Toggle_Control( 
            $wp_customize,
            'ed_localgoogle_fonts',
            array(
                'section'       => 'typography_settings',
                'label'         => __( 'Load Google Fonts Locally', 'blossom-pin' ),
                'description'   => __( 'Enable to load google fonts from your own server instead from google\'s CDN. This solves privacy concerns with Google\'s CDN and their sometimes less-than-transparent policies.', 'blossom-pin' )
            )
        )
    );   

    $wp_customize->add_setting(
        'ed_preload_local_fonts',
        array(
            'default'           => false,
            'sanitize_callback' => 'blossom_pin_sanitize_checkbox',
        )
    );
    
    $wp_customize->add_control(
        new Blossom_Pin_Toggle_Control( 
            $wp_customize,
            'ed_preload_local_fonts',
            array(
                'section'       => 'typography_settings',
                'label'         => __( 'Preload Local Fonts', 'blossom-pin' ),
                'description'   => __( 'Preloading Google fonts will speed up your website speed.', 'blossom-pin' ),
                'active_callback' => 'blossom_pin_ed_localgoogle_fonts'
            )
        )
    );   

    ob_start(); ?>
        
        <span style="margin-bottom: 5px;display: block;"><?php esc_html_e( 'Click the button to reset the local fonts cache', 'blossom-pin' ); ?></span>
        
        <input type="button" class="button button-primary blossom-pin-flush-local-fonts-button" name="blossom-pin-flush-local-fonts-button" value="<?php esc_attr_e( 'Flush Local Font Files', 'blossom-pin' ); ?>" />
    <?php
    $blossom_pin_flush_button = ob_get_clean();

    $wp_customize->add_setting(
        'ed_flush_local_fonts',
        array(
            'sanitize_callback' => 'wp_kses_post',
        )
    );
    
    $wp_customize->add_control(
        'ed_flush_local_fonts',
        array(
            'label'         => __( 'Flush Local Fonts Cache', 'blossom-pin' ),
            'section'       => 'typography_settings',
            'description'   => $blossom_pin_flush_button,
            'type'          => 'hidden',
            'active_callback' => 'blossom_pin_ed_localgoogle_fonts'
        )
    );

    /* Note */
    $wp_customize->add_setting(
        'typography_text',
        array(
            'default'           => '',
            'sanitize_callback' => 'wp_kses_post' 
        )
    );

    $wp_customize->add_control(
        new Blossom_Pin_Note_Control( 
            $wp_customize,
            'typography_text',
            array(
                'section'     => 'typography_settings',
                'description' => sprintf( __( '%1$sThis feature is available in Pro version.%2$s %3$sUpgrade to Pro%4$s ', 'blossom-pin' ),'<div class="featured-pro"><span>', '</span>', '<a href="https://blossomthemes.com/wordpress-themes/blossom-pin-pro/?utm_source=blossom_pin&utm_medium=customizer&utm_campaign=upgrade_to_pro" target="_blank">', '</a></div>' ),
            )
        )
    );


    $wp_customize->add_setting( 
        'typography_img_settings', 
        array(
            'default'           => 'one',
            'sanitize_callback' => 'blossom_pin_sanitize_radio'
        ) 
    );

    $wp_customize->add_control(
        new Blossom_Pin_Radio_Image_Control(
            $wp_customize,
            'typography_img_settings',
            array(
                'section'     => 'typography_settings',
                'choices'     => array(
                    'one'       => get_template_directory_uri() . '/images/pro/typography.png',
                ),
            )
        )
    );
    
    /** Move Background Image section to appearance panel */
    $wp_customize->get_section( 'background_image' )->panel    = 'appearance_settings';
    $wp_customize->get_section( 'background_image' )->priority = 10;
}
add_action( 'customize_register', 'blossom_pin_customize_register_appearance' );