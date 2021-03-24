<?php
    if ( ! defined( 'ABSPATH' ) ) {
        exit; // Exit if accessed directly
    }

    get_header();

    if ( is_product_category() ){
        global $wp_query;
        $cat = $wp_query->get_queried_object();
        $thumbnail_id = get_term_meta( $cat->term_id, 'thumbnail_id', true );
        $image = wp_get_attachment_url( $thumbnail_id );
    }

    $cart_item_quantities = WC()->cart->get_cart_item_quantities();

    // echo('<pre>');
    // print_r($cat);
    // echo('</pre>');
?>

<div id="primary" class="content-area">
	<main id="main" class="site-main product__archive" role="main">
        <section class="product__container">
            <div class="product__header row">
                <div class="product__header__text col-4">
                    <h1><?php if(isset($cat->name)) { echo($cat->name); } else { echo "Shop"; } ?></h1>
                    <p><?php if(isset($cat->description)) echo $cat->description; ?></p>
                </div>

                <div class="product__header__image col-8">
                    <img src="<?php if(isset($image)) echo $image; ?>">
                </div>
            </div>
            <div class="product__grid">

                <?php 
                    if (have_posts()) : while (have_posts()) : the_post();
                        include get_template_directory() . '/inc/product-tile.php';
                    endwhile; endif; 
                ?>

            </div>
        </section>
	</main>
</div>

<?php get_footer(); ?>
