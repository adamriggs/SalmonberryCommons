<?php 

    if ( ! defined( 'ABSPATH' ) ) {
        exit; // Exit if accessed directly
    }

    get_header();

    $cart_item_quantities = WC()->cart->get_cart_item_quantities();

    $button_text = "Add to Cart";
    $product_status = "";

    // echo('<pre>');
    // print_r($product_status);
    // echo('</pre>');

?>

<div id="primary" class="content-area">
	<main id="main" class="site-main product" role="main">
        <section class="product__container">
            <div class="product__content row">

                <?php if (have_posts()) : while (have_posts()) : the_post(); ?>

                    <?php
                        $product = wc_get_product( get_the_id() );
                        $product_id = $product->get_id();
                        $cart_id = WC()->cart->generate_cart_id($product_id);
                        $cart_item_key = WC()->cart->find_product_in_cart($cart_id);
                        $cart_item_quantity = isset($cart_item_quantities[$product_id]) ? $cart_item_quantities[$product_id] : '0';

                        if ( ! $product->managing_stock() && ! $product->is_in_stock() ) {
                            $button_text = "Out of Stock";
                            $product_status = "out-of-stock";
                        }

                        $quantity = get_field('quantity');
                        $producers = get_field('producers');
                        $delivery = get_field('delivery_pickup');

                        echo('<pre>');
                        print_r($quantity);
                        echo('</pre>');
                    ?>
                    
                    <div class="product__image col-6 background__image" style="background-image: url(<?php echo the_post_thumbnail_url(); ?>);"></div>
                    
                    <div class="product__text col-6">
                        <h1><?php the_title(); ?></h1>
                        <?php if($quantity) { ?>
                            <div><h3 class="blue"><?php echo $quantity; ?></h3></div>
                        <?php } ?>

                        <?php if($producers && count($producers) > 0) { ?>
                            <div><p>Featuring Ingredients From 
                                <?php
                                    $i = count($producers) - 1;
                                    foreach($producers as $producer) { 
                                        echo '<a href="/producers/#' . $producer->ID . '">' . $producer->post_title . '</a>';
                                        if($i > 0) { echo ', '; }
                                        $i--;
                                    }
                                ?>

                            </p></div>
                        <?php } ?>

                        <h3 class="blue"><?php echo '$' . $product->get_price(); ?></h3><span>&nbsp each</span>

                        <div class="product__text__add row middle">
                            <button class="add-one-item <?php echo $product_status; ?>" data-product-id="<?php echo $product_id; ?>" data-cart-item-key="<?php echo $cart_item_key; ?>" data-cart-item-quantity="<?php echo $cart_item_quantity; ?>"><?php echo $button_text; ?></button>
                            <span data-product-id="<?php echo $product_id; ?>" class="product__text__add__success">+1</span>
                            <span data-product-id="<?php echo $product_id ?>"class="product__text__add__progress">
                                <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                width="528.919px" height="528.918px" viewBox="0 0 528.919 528.918" style="enable-background:new 0 0 528.919 528.918;"
                                xml:space="preserve">
                                    <g>
                                        <path d="M70.846,324.059c3.21,3.926,8.409,3.926,11.619,0l69.162-84.621c3.21-3.926,1.698-7.108-3.372-7.108h-36.723
                                        c-5.07,0-8.516-4.061-7.427-9.012c18.883-85.995,95.625-150.564,187.207-150.564c105.708,0,191.706,85.999,191.706,191.706
                                        c0,105.709-85.998,191.707-191.706,191.707c-12.674,0-22.95,10.275-22.95,22.949s10.276,22.949,22.95,22.949
                                        c131.018,0,237.606-106.588,237.606-237.605c0-131.017-106.589-237.605-237.606-237.605
                                        c-116.961,0-214.395,84.967-233.961,196.409c-0.878,4.994-5.52,9.067-10.59,9.067H5.057c-5.071,0-6.579,3.182-3.373,7.108
                                        L70.846,324.059z"/>
                                    </g>
                                </svg>
                            </span>
                        </div>

                        <?php the_content(); ?>

                        <?php
                            if($delivery) {
                        ?>
                            <h1>Delivery / Pickup</h1>
                            <?php echo $delivery; ?>
                        <?php
                            }
                        ?>

                        <div class="hr orange"></div>


                        <?php if($producers && count($producers) > 0) { ?>
                            <div class="product__text__producers">
                                <?php
                                    $i = count($producers) - 1;
                                    foreach($producers as $producer) {
                                ?>

                                        <a href="/producers/#<?php echo $producer->ID; ?>"><h4 class="blue"><?php echo $producer->post_title; ?></h4></a>
                                        <p><?php echo get_the_excerpt($producer->ID); ?></p>
                                <?php
                                    }
                                ?>

                            </div>
                        <?php } ?>
                    </div>

                <?php endwhile; endif; ?>

            </div>
        </section>

        <?php
            global $product; // If not set…

            if( ! is_a( $product, 'WC_Product' ) ){
                $product = wc_get_product(get_the_id());
            }

            $args = array(
                'posts_per_page' => 4,
                'columns'        => 4,
                'orderby'        => 'rand',
                'order'          => 'desc',
            );

            $args['related_products'] = array_filter( array_map( 'wc_get_product', wc_get_related_products( $product->get_id(), $args['posts_per_page'], $product->get_upsell_ids() ) ), 'wc_products_array_filter_visible' );
            $args['related_products'] = wc_products_array_orderby( $args['related_products'], $args['orderby'], $args['order'] );

            // echo('<pre>');
            // print_r($args);
            // echo('</pre>');

            // Set global loop values.
            wc_set_loop_prop( 'name', 'related' );
            wc_set_loop_prop( 'columns', $args['columns'] );

            wc_get_template( 'single-product/related.php', $args );

            // $loop = new WP_Query($args);

            // while($loop->have_posts()) : $loop->the_post();
            //     the_title();
            // endwhile;
        ?>

	</main>
</div>

<?php get_footer(); ?>
