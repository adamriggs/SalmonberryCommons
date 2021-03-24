<?php

    if ( ! defined( 'ABSPATH' ) ) {
        exit;
    }

    $product = wc_get_product( get_the_id() );
    $product_url = get_permalink( get_the_id() );
    $product_id = $product->get_id();
    $cart_id = WC()->cart->generate_cart_id($product_id);
    $cart_item_key = WC()->cart->find_product_in_cart($cart_id);
    $cart_item_quantities = WC()->cart->get_cart_item_quantities();
    $cart_item_quantity = isset($cart_item_quantities[$product_id]) ? $cart_item_quantities[$product_id] : '0';

    // $button_text = "Add to Cart";
    $button_class = "";
    global $product;
    if ( ! $product->managing_stock() && ! $product->is_in_stock() ) {
        // $button_text = "Out of Stock";
        $button_class = "out-of-stock";
    }

    // echo('<pre>');
    // print_r($cart_item_key);
    // echo('</pre>');
?>

<div class="product__tile row">
    <a class="product__tile__link" href="<?php echo $product_url; ?>">
        <div class="product__image background__image row middle" style="background-image: url(<?php echo the_post_thumbnail_url(); ?>);"><?php the_excerpt(); ?></div>
        
        <div class="product__text">
            <h3 class="product__row"><?php the_title(); ?></h3>
        </div>
    </a>

    <div class="product__buttons">
        <h4 class="blue"><?php echo '$' . $product->get_price(); ?></h4>
        <div class="product__tile__cart row between middle <?php echo $button_class; ?>">
                <span class="product__tile__cart__add add-one-item" data-product-id="<?php echo $product_id ?>" data-cart-item-key="<?php echo $cart_item_key; ?>" data-cart-item-quantity="<?php echo $cart_item_quantity; ?>">+</span>

                <span class="product__tile__cart__status display-item" data-product-id="<?php echo $product_id ?>" data-cart-item-key="<?php echo $cart_item_key; ?>"><?php echo $cart_item_quantity; ?> in cart</span>

                <span class="product__tile__cart__remove remove-one-item" data-product-id="<?php echo $product_id ?>" data-cart-item-key="<?php echo $cart_item_key; ?>" data-cart-item-quantity="<?php echo $cart_item_quantity; ?>">&ndash;</span>
        </div>
        <div class="product__tile__out row between middle center <?php echo $button_class; ?>">
            Out of Stock
        </div>
        <!-- <button class="product__add__cart add-one-item <?php echo $button_class; ?>" data-product-id="<?php echo $product_id ?>" ><?php echo $button_text; ?></button> -->
    </div>

</div>