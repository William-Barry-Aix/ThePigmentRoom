<?php
/**
 * Active Callback
 * 
 * @package Blossom_Pin
*/

function blossom_pin_banner_ac( $control ){
    $banner      = $control->manager->get_setting( 'ed_banner_section' )->value();
    $slider_type = $control->manager->get_setting( 'slider_type' )->value();
    $control_id  = $control->id;
    
    if ( $control_id == 'header_image' && $banner == 'static_banner' ) return true;
    if ( $control_id == 'header_video' && $banner == 'static_banner' ) return true;
    if ( $control_id == 'external_header_video' && $banner == 'static_banner' ) return true;
    if ( $control_id == 'banner_title' && $banner == 'static_banner' ) return true;
    if ( $control_id == 'banner_subtitle' && $banner == 'static_banner' ) return true;
    if ( $control_id == 'banner_label' && $banner == 'static_banner' ) return true;
    if ( $control_id == 'banner_link' && $banner == 'static_banner' ) return true;
    
    if ( $control_id == 'slider_type' && $banner == 'slider_banner' ) return true;          
    
    if ( $control_id == 'slider_cat' && $banner == 'slider_banner' && $slider_type == 'cat' ) return true;
    if ( $control_id == 'no_of_slides' && $banner == 'slider_banner' && $slider_type == 'latest_posts' ) return true;
    
    return false;
}

/**
 * Active Callback For Breadcrumbs
 * 
 * @package Blossom_Pin
*/

function blossom_pin_breadcrumbs( $control ){
    $breadcrumbs      = $control->manager->get_setting( 'ed_breadcrumb' )->value();
    $control_id  = $control->id;
    
    if ( $control_id == 'home_text' && $breadcrumbs ) return true;
    
    return false;
}

/**
 * Active Callback for local fonts
*/
function blossom_pin_ed_localgoogle_fonts(){
    $ed_localgoogle_fonts = get_theme_mod( 'ed_localgoogle_fonts' , false );

    if( $ed_localgoogle_fonts ) return true;
    
    return false; 
}

/**
 * Active Callback for instagram
*/
function blossom_pin_instagram_ac( $control ){

    $ed_insta   = $control->manager->get_setting( 'ed_instagram' )->value();
    $control_id = $control->id;

    if ( $control_id == 'instagram_shortcode' && $ed_insta ) return true;

    return false;
}