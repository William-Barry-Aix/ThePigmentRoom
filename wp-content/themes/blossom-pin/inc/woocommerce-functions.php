<?php
/**
 * Blossom Pin Woocommerce hooks and functions.
 *
 * @link https://docs.woothemes.com/document/third-party-custom-theme-compatibility/
 *
 * @package Blossom_Pin
 */

/**
 * Woocommerce related hooks
*/
remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0 );
remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10 );
remove_action( 'woocommerce_after_main_content',  'woocommerce_output_content_wrapper_end', 10 );
remove_action( 'woocommerce_sidebar',             'woocommerce_get_sidebar', 10 );

/**
 * Declare Woocommerce Support
*/
function blossom_pin_woocommerce_support() {
    global $woocommerce;
    
    add_theme_support( 'woocommerce', array(
        'gallery_thumbnail_image_width' => 300,
    ) );
    
    if( version_compare( $woocommerce->version, '3.0', ">=" ) ) {
        add_theme_support( 'wc-product-gallery-zoom' );
        add_theme_support( 'wc-product-gallery-lightbox' );
        add_theme_support( 'wc-product-gallery-slider' );
    }
}
add_action( 'after_setup_theme', 'blossom_pin_woocommerce_support');

/**
 * Woocommerce Sidebar
*/
function blossom_pin_wc_widgets_init(){
    register_sidebar( array(
		'name'          => esc_html__( 'Shop Sidebar', 'blossom-pin' ),
		'id'            => 'shop-sidebar',
		'description'   => esc_html__( 'Sidebar displaying only in woocommerce pages.', 'blossom-pin' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );    
}
add_action( 'widgets_init', 'blossom_pin_wc_widgets_init' );

/**
 * Before Content
 * Wraps all WooCommerce content in wrappers which match the theme markup
*/
function blossom_pin_wc_wrapper(){    
    ?>
        <main id="main" class="site-main" role="main">
    <?php
}
add_action( 'woocommerce_before_main_content', 'blossom_pin_wc_wrapper' );

/**
 * After Content
 * Closes the wrapping divs
*/
function blossom_pin_wc_wrapper_end(){
    ?>
        </main>
    </div>
    <?php
    do_action( 'blossom_pin_wo_sidebar' );
}
add_action( 'woocommerce_after_main_content', 'blossom_pin_wc_wrapper_end' );

/**
 * Callback function for Shop sidebar
*/
function blossom_pin_wc_sidebar_cb(){
    if( is_active_sidebar( 'shop-sidebar' ) ){
        echo '<aside id="secondary" class="widget-area" role="complementary">';
        dynamic_sidebar( 'shop-sidebar' );
        echo '</aside>'; 
    }
}
add_action( 'blossom_pin_wo_sidebar', 'blossom_pin_wc_sidebar_cb' );

/**
 * Removes the "shop" title on the main shop page
*/
add_filter( 'woocommerce_show_page_title' , '__return_false' );

if( ! function_exists( 'blossom_pin_wc_cart_count' ) ) :
/**
 * Woocommerce Cart Count
 * 
 * @link https://isabelcastillo.com/woocommerce-cart-icon-count-theme-header 
*/
function blossom_pin_wc_cart_count(){
    $cart_page = get_option( 'woocommerce_cart_page_id' );
    $count = WC()->cart->cart_contents_count; 
    if( $cart_page ){ ?>
    <div class="header-cart">
        <a href="<?php echo esc_url( wc_get_cart_url() ); ?>" class="cart" title="<?php esc_attr_e( 'View your shopping cart', 'blossom-pin' ); ?>">
            <svg xmlns="http://www.w3.org/2000/svg" width="17" height="17" viewBox="0 0 17 17"><path id="Path_4343" data-name="Path 4343" d="M5.1,13.6a1.7,1.7,0,1,0,1.7,1.7A1.7,1.7,0,0,0,5.1,13.6ZM0,0V1.7H1.7L4.76,8.16,3.57,10.2a3.02,3.02,0,0,0-.17.85,1.7,1.7,0,0,0,1.7,1.7H15.3v-1.7H5.44a.183.183,0,0,1-.17-.17v-.085L6.035,9.35h6.29A1.55,1.55,0,0,0,13.77,8.5l3.06-5.525A.468.468,0,0,0,17,2.55a.8.8,0,0,0-.85-.85H3.57L2.8,0ZM13.6,13.6a1.7,1.7,0,1,0,1.7,1.7A1.7,1.7,0,0,0,13.6,13.6Z" fill="#806e6a" /></svg>
            <span class="cart-count"><?php echo absint( $count ); ?></span>
        </a>
    </div>
    <?php
    }
}
endif;