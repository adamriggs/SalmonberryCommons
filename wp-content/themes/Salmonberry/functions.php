<?php

add_theme_support( 'menus' );
add_theme_support( 'post-thumbnails' );
add_theme_support( 'title-tag' );

add_action('wp_enqueue_scripts', 'main_load_scripts');
function main_load_scripts() {
	// if ( !is_admin() ) wp_deregister_script('jquery');
	wp_enqueue_style('main', get_template_directory_uri() . '/dist/main.css?v=' . time());
	wp_enqueue_style('hamburger', get_template_directory_uri() . '/dist/hamburger.css?v=' . time());
	wp_enqueue_script('main', get_template_directory_uri() . '/dist/main-bundle.js', [], time());
  wp_enqueue_script('woo', get_template_directory_uri() . '/dist/woo-bundle.js', [], time());

  $data = array( 
        'ajax_url' => admin_url( 'admin-ajax.php' ),
        'nonce'    => wp_create_nonce( 'nonce' )
    );
  wp_localize_script( 'main', 'ajax_data', $data );
}

if( function_exists('acf_add_options_page') ) {
	acf_add_options_page(array(
		'page_title' 	=> 'Theme Settings',
		'menu_title'	=> 'Theme Settings',
		'menu_slug' 	=> 'theme-settings',
		'capability'	=> 'edit_posts',
	));
}

if ( !function_exists('write_log') ) {
   function write_log ( $log )  {
      if ( is_array( $log ) || is_object( $log ) ) {
         error_log( print_r( $log, true ) );
      } else {
         error_log( $log );
      }
   }
}

if ( !function_exists('no_orphans') ) {
  function no_orphans($string) {
    $pos = strrpos($string, " ");
    return substr_replace($string, '&nbsp;', $pos, 1);
  }
}

// disable the gutenburg editor
add_filter('use_block_editor_for_post', '__return_false', 10);

function create_post_types() {
  register_post_type('producers',
        array(
            'labels' => array(
                'name' => __('Producers'),
                'singular_name' => __('Producer')
            ),
            'public' => true,
            'has_archive' => false,
            'rewrite' => array(
                'slug' => 'producers'
            ),
            'supports' => array('title', 'editor', 'thumbnail'),
        )
    );

  register_post_type('delivery-regions',
        array(
            'labels' => array(
                'name' => __('Delivery Regions'),
                'singular_name' => __('Delivery Region')
            ),
            'public' => true,
            'has_archive' => true,
            'rewrite' => array(
                'slug' => 'delivery-regions'
            ),
            'supports' => array('title', 'editor'),
        )
    );
}

add_action( 'init', 'create_post_types' );

// add woocommerce theme support
function salmonberry_add_woocommerce_support() {
  add_theme_support( 'woocommerce', array(
    'thumbnail_image_width' => 150,
    'single_image_width'    => 300,

        'product_grid'          => array(
            'default_rows'    => 3,
            'min_rows'        => 2,
            'max_rows'        => 8,
            'default_columns' => 4,
            'min_columns'     => 2,
            'max_columns'     => 5,
        ),
  ) );
}
add_action( 'after_setup_theme', 'salmonberry_add_woocommerce_support' );

// update cart with new quantity 
function salmonberry_update_cart_process(){
    if( !wp_verify_nonce( $_POST['nonce'], 'nonce' ) ){
       die();
    }
    if( !isset($_POST['hash']) || !isset($_POST['quantity']) ){
       exit;
    }
    $cart_item_key = $_POST['hash'];
    if( !isset( WC()->cart->get_cart()[ $cart_item_key ] ) ){
       exit;
    }
    $values = WC()->cart->get_cart()[ $cart_item_key ];

    $_product = $values['data'];

    // Sanitize
    $quantity = apply_filters( 'woocommerce_stock_amount_cart_item',    apply_filters( 'woocommerce_stock_amount', preg_replace( "/[^0-9\.]/", '', filter_var($_POST['quantity'], FILTER_SANITIZE_NUMBER_INT)) ), $cart_item_key );

    if ( '' === $quantity || $quantity == $values['quantity'] ) {
      exit;
    }

    // Update cart validation
    $passed_validation  = apply_filters( 'woocommerce_update_cart_validation', true, $cart_item_key, $values, $quantity );

    if ( $passed_validation ) {
        WC()->cart->set_quantity( $cart_item_key, $quantity, false );
    }

    // Recalc our totals
    WC()->cart->calculate_totals();

    $product_id = $values['product_id'];
    $values = WC()->cart->get_cart()[ $cart_item_key ];
    $values['cart_total'] = WC()->cart->get_cart_contents_count();
    $values['product_id'] = $product_id; //when the product count is zero the product id isn't part of $values unless you add it back in
    wp_die(json_encode($values));
}
add_action( 'wp_ajax_salmonberry_update_cart', 'salmonberry_update_cart_process' );    // If called from admin panel
add_action( 'wp_ajax_nopriv_salmonberry_update_cart', 'salmonberry_update_cart_process' );

// add product
function salmonberry_add_to_cart() {

    $product_id = apply_filters('woocommerce_add_to_cart_product_id', absint($_POST['product_id']));
    $quantity = empty($_POST['quantity']) ? 1 : wc_stock_amount($_POST['quantity']);
    $variation_id = absint($_POST['variation_id']);
    $passed_validation = apply_filters('woocommerce_add_to_cart_validation', true, $product_id, $quantity);
    $product_status = get_post_status($product_id);

    if ($passed_validation && WC()->cart->add_to_cart($product_id, $quantity, $variation_id) && 'publish' === $product_status) {

        do_action('woocommerce_ajax_added_to_cart', $product_id);

        if ('yes' === get_option('woocommerce_cart_redirect_after_add')) {
            wc_add_to_cart_message(array($product_id => $quantity), true);
        }

        // WC_AJAX :: get_refreshed_fragments();
    } else {

        $data = array(
            'error' => true,
            'product_url' => apply_filters('woocommerce_cart_redirect_after_error', get_permalink($product_id), $product_id));

        echo wp_send_json($data);
    }
    $cartId = WC()->cart->generate_cart_id( $product_id );
    $cartItemKey = WC()->cart->find_product_in_cart( $cartId );

    $output = WC()->cart->get_cart_contents()[$cartItemKey];
    $output['cart_total'] = WC()->cart->get_cart_contents_count();
    $output['product_id'] = $product_id;
    wp_die(json_encode($output));
}

add_action('wp_ajax_salmonberry_add_to_cart', 'salmonberry_add_to_cart');
add_action('wp_ajax_nopriv_salmonberry_add_to_cart', 'salmonberry_add_to_cart');

function new_excerpt_more($more) {
    return '...';
}
add_filter('excerpt_more', 'new_excerpt_more');

function custom_excerpt_length( $length ) {
    return 40;
}
add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );

add_filter( 'woocommerce_return_to_shop_redirect', 'st_woocommerce_shop_url' );
/**
 * Redirect WooCommerce Shop URL
 */

function st_woocommerce_shop_url(){
    return site_url();
}

// function winwar_first_sentence( $string ) {
 
//     $sentence = preg_split( '/(\.|!|\?)\s/', $string, 2, PREG_SPLIT_DELIM_CAPTURE );
//     $part1 = isset($sentence['0']) ? $sentence['0'] : '';
//     $part2 = isset($sentence['1']) ? $sentence['1'] : '';
//     return $part1 . $part2;
 
// } add_filter( 'get_the_excerpt', 'winwar_first_sentence', 10, 1 );

// add_action( 'pre_get_posts', 'custom_query_vars' );
// function custom_query_vars( $query ) {
//     if ( is_admin() ) {
//         return $query;
//     }

//     $cur_region = '';
//     if(isset($_COOKIE['salmonberry_region'])) {
//         $cur_region = $_COOKIE['salmonberry_region'];
//     }

//     // if ( is_post_type_archive( 'product' ) ) {
//     //     $args = array(
//     //         // 'relation' => 'OR',
//     //         array(
//     //             'meta_key'  => 'delivery_region',
//     //             'value'     => $cur_region,
//     //             'compare'   => 'LIKE'
//     //         ),
//     //         // array(
//     //         //     'meta_key'  => 'delivery_region',
//     //         //     // 'value'     => '',
//     //         //     'compare'   => '!='
//     //         // ),
//     //     );
//     //     $query->set( 'meta_query', $args ); 
//     // }

//     if( ( isset($query->query_vars['post_type']) && $query->query_vars['post_type'] == 'product' ) || ( isset($query->query_vars['is_archive']) && $query->query_vars['post_type'] == 'product' ) ) {
//         $args = array(
//             'relation' => 'OR',
//             array(
//                 'meta_key'  => 'delivery_region',
//                 'value'     => $cur_region,
//                 'compare'   => 'LIKE'
//             ),
//             array(
//                 'meta_key'  => 'delivery_region',
//                 // 'value'     => '',
//                 'compare'   => '!='
//             ),
//         );
//         $query->set( 'meta_query', $args ); 

//         // $query->set('orderby', 'meta_value');
//         // $query->set('meta_key', 'delivery_region');
//         // $query->set('meta_value', $cur_region);
//         // $query->set('meta_compare', 'LIKE');
//     }
//     return $query;
// }
