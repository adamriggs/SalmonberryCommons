<div class="home__tertiary__row row">
    <?php
        $cat_obj = get_term_by( 'id', $cat_id, 'product_cat');
        $cat_name = $cat_obj->name;
        $cat_slug = $cat_obj->slug;
        $cat_url = get_term_link( $cat_obj->term_id, 'product_cat' );

        // echo('<pre>');
        // print_r($cat_url);
        // echo('</pre>');
    ?>
    <div class="home__tertiary__row__head row">
        <div class="col-6">
            <div class="home__tertiary__arrow__container--down">
                <img class="home__tertiary__arrow arrow__down" src="<?php echo get_template_directory_uri() . '/images/arrow-down-short.svg' ?>">
            </div>
            <a href="<?php echo $cat_url; ?>"><h3><?php echo $cat_name; ?></h3></a>
        </div>
        <div class="home__tertiary__shopall row col-6 end bottom">
            <div class="home__tertiary__arrow__container--right row">
                <img class="home__tertiary__arrow arrow__right" src="<?php echo get_template_directory_uri() . '/images/arrow-right.svg' ?>">
            </div>
            <a href="<?php echo $cat_url; ?>"><h3>Shop All</h3></a>
        </div>
    </div>

    <div class="row between">
        <?php  
            $args = array(
                'post_type'      => 'product',
                'posts_per_page' => 4,
                'product_cat'    => $cat_slug
            );

            $loop = new WP_Query( $args );

            while ( $loop->have_posts() ) : $loop->the_post();
                $button_text = "Add to Cart";
                $button_class = "";
                global $product;
                if ( ! $product->managing_stock() && ! $product->is_in_stock() ) {
                    $button_text = "Out of Stock";
                    $button_class = "out-of-stock";
                }
                $product = wc_get_product( get_the_id() );
                $product_url = get_permalink( get_the_id() );
                $product_id = $product->get_id();
        ?>
                <div class="col-3 row">
                    <a href="<?php echo get_permalink(); ?>">
                        <div class="product__image background__image row middle" style="background-image: url(<?php echo the_post_thumbnail_url(); ?>);"><?php the_excerpt(); ?></div>
                        <h5 class="product__row"><?php echo get_the_title(); ?></h5>
                    </a>
                    
                    <div class="product__row__button center">
                        <h5 class="product__row center"><?php echo '$' . $product->get_price(); ?></h5>
                        <h5 class="product__row__add add-one-item <?php echo $button_class; ?>" data-product-id="<?php echo $product_id ?>"><?php echo $button_text; ?></h5>
                        <span data-product-id="<?php echo $product_id ?>"class="product__text__add__success">+1</span>
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
                </div>
        <?php
            endwhile;

            wp_reset_query();
        ?>
    </div>
</div>