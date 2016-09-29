<?php

/**
 * Storefront automatically loads the core CSS even if using a child theme as it is more efficient
 * than @importing it in the child theme style.css file.
 *
 * Uncomment the line below if you'd like to disable the Storefront Core CSS.
 *
 * If you don't plan to dequeue the Storefront Core CSS you can remove the subsequent line and as well
 * as the sf_child_theme_dequeue_style() function declaration.
 */
//add_action( 'wp_enqueue_scripts', 'sf_child_theme_dequeue_style', 999 );
add_filter('storefront_customizer_css', '__return_false');
add_filter('storefront_customizer_woocommerce_css', '__return_false');


/**
 * Dequeue the Storefront Parent theme core CSS
 */

//$shop_url = "https://canvasfoto.nl/shop/foto-print/foto-op-canvas-stappen/";

function sf_child_theme_dequeue_style() {
    //wp_dequeue_style( 'storefront-style' );
	//wp_dequeue_style( 'storefront-child-style' );
   // wp_dequeue_style( 'storefront-woocommerce-style' );
}
add_action( 'wp_enqueue_scripts', 'sf_child_theme_dequeue_style', 999 );

add_action( 'get_header', 'remove_storefront_sidebar' );

function remove_storefront_sidebar() {
	if ( is_product() ) {
		remove_action( 'storefront_sidebar', 'storefront_get_sidebar', 10 );
	}
}

add_action( 'widgets_init', 'child_register_sidebar_landingspagina' );

function child_register_sidebar_landingspagina(){
    register_sidebar(array(
        'name' => 'Landingspagina sidebar',
        'id' => 'landingspagina-sidebar',
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ));
}
add_action( 'widgets_init', 'child_register_sidebar_contact' );

function child_register_sidebar_contact(){
    register_sidebar(array(
        'name' => 'Contact sidebar',
        'id' => 'contact-sidebar',
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ));
}
add_action( 'widgets_init', 'child_register_sidebar_blog' );

function child_register_sidebar_blog(){
    register_sidebar(array(
        'name' => 'Blog sidebar',
        'id' => 'blog-sidebar',
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ));
}
/**
 * Show only the text "Vanaf" when there is a difference between
 * $product->min_variation_price AND $product->max_variation_price.
 */
add_filter('woocommerce_variable_price_html', 'custom_variation_price_ifdiffer', 10, 2);
function custom_variation_price_ifdiffer( $price, $product ) {
    if ($product->min_variation_price !== $product->max_variation_price) { 
        //$price = '<span class="from_price">Vanaf</span> ';
		$price = '';
        $price .= woocommerce_price($product->min_variation_price);
    }           
 
    return $price;
}
/**
 * Remove optie kiezen
 */
add_filter( 'woocommerce_dropdown_variation_attribute_options_args', 'mmx_remove_select_text');
function mmx_remove_select_text( $args ){
    $args['show_option_none'] = '';
    return $args;
}
remove_action( 'woocommerce_single_product_summary', 'toastie_wc_smsb_form_code', 31 );

//add_action( 'woocommerce_product_thumbnails', 'toastie_wc_smsb_form_code', 99 );
/**
 * Laat meerdere maten beschikbaar zien op de button 
 */
//add_filter( 'woocommerce_product_add_to_cart_text' , 'custom_woocommerce_product_add_to_cart_text' );
function custom_woocommerce_product_add_to_cart_text() {
    global $product;    
    $product_type = $product->product_type;  
    switch ( $product_type ) {
	case 'simple': return __( 'meer info', 'woocommerce' ); break;
	case 'variable': return __( 'meer info', 'woocommerce' ); break;
	case 'grouped': return __( 'meer info', 'woocommerce' ); break;
}
} 

//remove_action( 'woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_title', 10 );
//add_action( 'woocommerce_shop_loop_item_title', 'custom_woocommerce_template_loop_product_title', 10 );

function custom_woocommerce_template_loop_product_title() {
	echo '<h2>' . get_the_title() . '</h2>';

}

remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40 );
// Remove WooThemes Credit from Footer
add_action( 'init', 'custom_remove_footer_credit', 10 );
function custom_remove_footer_credit () {
    remove_action( 'storefront_footer', 'storefront_credit', 20 );
}
function add_taxonomies_to_pages() {
 register_taxonomy_for_object_type( 'post_tag', 'page' );
 register_taxonomy_for_object_type( 'category', 'page' );
 }
add_action( 'init', 'add_taxonomies_to_pages' );
 if ( ! is_admin() ) {
 add_action( 'pre_get_posts', 'category_and_tag_archives' );
 
 }
//voeg categorien toe aan pages 
function category_and_tag_archives( $wp_query ) {
$my_post_array = array('post','page');
 
 if ( $wp_query->get( 'category_name' ) || $wp_query->get( 'cat' ) )
 $wp_query->set( 'post_type', $my_post_array );
 
 if ( $wp_query->get( 'tag' ) )
 $wp_query->set( 'post_type', $my_post_array );
}
// exclude categories van de sidebar aan de hand van id's

function exclude_widget_categories($args){
	$exclude = "295,293,9,1,14,8"; // The IDs of the excluding categories
	$args["exclude"] = $exclude;
	return $args;
}
//add_filter("widget_categories_args","exclude_widget_categories");

// eigen logo gebruiken
//add_action( 'init', 'storefront_custom_logo' );
function storefront_custom_logo() {
	remove_action( 'storefront_header', 'storefront_site_branding', 20 );
	add_action( 'storefront_header', 'storefront_display_custom_logo', 20 );
}

function storefront_display_custom_logo() {
?>
	<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="site-logo-link" rel="home">
	<img src="<?php echo get_site_url(); ?>/img/canvas-logo.png" alt="<?php echo get_bloginfo( 'name' ); ?>" />
	</a>
<?php
}
//mobile footer
//add_filter( 'storefront_handheld_footer_bar_links', 'add_home_link' );
function add_home_link( $links ) {
	$new_links = array(
	
		'account' => array(
			'priority' => 10,
			'callback' => 'footer_account_link',
		),
		'canvas-start' => array(
			'priority' => 20,
			'callback' => 'footer_canvas_link',
		)
	);

	$links = array_merge( $new_links, $links );

	return $links;
}

function footer_canvas_link() {
	echo '<a class="mobile-canvas-start" href="' .get_permalink('2144'). '">' . __( 'Verstuur je foto en bestel' ) . '</a>';
}
function footer_account_link() {
	echo '<a href="' . esc_url( home_url( '/' ) ) . '">' . __( 'Home' ) . '</a>';
}
//add_filter( 'storefront_handheld_footer_bar_links', 'remove_handheld_footer_links' );
function remove_handheld_footer_links( $links ) {
	unset( $links['my-account'] );
	unset( $links['search'] );
	return $links;
}
//add_action( 'pre_get_posts', 'custom_pre_get_posts_query' );


/**
 * Remove specific category ID's from the WooCommerce shop page
 */
//add_action( 'pre_get_posts', 'uw_remove_product_cats_shop_page' );
function uw_remove_product_cats_shop_page( $query ) {

	// Comment out the line below to hide products in the admin as well
	if ( is_admin() ) return;
	
	if ( is_shop() && $query->is_main_query() ) {
 
		$query->set( 'tax_query', array(
			array(
				'taxonomy' => 'product_cat',
				'field' => 'ID',
				'terms' => array( 14, 8, 210 ),
				'operator' => 'NOT IN'
			)
		) );
	
	}
 
}
// remove default sorting dropdown in StoreFront Theme
 
//add_action('init','remove_ordering_shop');
 
function remove_ordering_shop() {
	remove_action( 'woocommerce_after_shop_loop', 'woocommerce_result_count', 20 );
	remove_action( 'woocommerce_before_shop_loop', 'woocommerce_result_count', 20 );
	
	remove_action( 'woocommerce_after_shop_loop', 'woocommerce_catalog_ordering', 10 );
	remove_action( 'woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 10 );
}
function usp_Shortcode() {
	return '
<div class="ucp-bar">
    <ul>
        <li class="clear">
            <img alt="canvas foto Beoordeeld als "Uitstekend" width="50" height="50" src="https://canvasfoto.nl/img/icons/beker.png">
            <a href="#">Beoordeeld als "Uitstekend"<span class="stars"><span class="fa fa-star"></span><span class="fa fa-star"></span><span class="fa fa-star"></span><span class="fa fa-star"></span><span class="fa fa-star"></span></span></a>
        </li>
        <li class="clear">
            <img alt="canvas foto Gratis verzending" width="50" height="50" src="https://canvasfoto.nl/img/icons/bezorging.png">
            <a href="https://canvasfoto.nl/retourbeleid/">Gratis verzending! <span>Ook gratis retour!</span></a>
        </li>
        <li class="clear">
            <img alt="canvas foto Spoed bestelling" width="50" height="50" src="https://canvasfoto.nl/img/icons/racket.png">
            <a href="https://canvasfoto.nl/contact-canvas/"> Spoed bestelling? <span>Neem contact met ons op!</span></a>
        </li>
        <li class="clear">
            <img alt="canvas foto Handgemaakt met liefde" width="50" height="50" src="https://canvasfoto.nl/img/icons/hartje.png">
            <a href="https://canvasfoto.nl/waarom-wij/canvas-fotos/">Handgemaakt met liefde<span>Met kwaliteitsgarantie</span></a>
        </li>
    </ul>
    </div>';
}
add_shortcode('usp', 'usp_Shortcode');
//remove_action( 'woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30 );
/**
 * Custom prijs berekening
 */
//include('woocommerce/order-canvas-materiaal/prijsberekening.php');
//include('woocommerce/orderform-canvas/prijsberekening.php');
//include('woocommerce/orderform-steigerhout/prijsberekening.php');

?>
