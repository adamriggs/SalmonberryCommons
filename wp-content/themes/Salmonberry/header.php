<!DOCTYPE html>
<!-- 
██████╗  █████╗ ███████╗██╗ ██████╗    ██╗    ██╗███████╗██████╗ ███████╗██╗████████╗███████╗     █████╗  ██████╗ ███████╗███╗   ██╗ ██████╗██╗   ██╗
██╔══██╗██╔══██╗██╔════╝██║██╔════╝    ██║    ██║██╔════╝██╔══██╗██╔════╝██║╚══██╔══╝██╔════╝    ██╔══██╗██╔════╝ ██╔════╝████╗  ██║██╔════╝╚██╗ ██╔╝
██████╔╝███████║███████╗██║██║         ██║ █╗ ██║█████╗  ██████╔╝███████╗██║   ██║   █████╗      ███████║██║  ███╗█████╗  ██╔██╗ ██║██║      ╚████╔╝ 
██╔══██╗██╔══██║╚════██║██║██║         ██║███╗██║██╔══╝  ██╔══██╗╚════██║██║   ██║   ██╔══╝      ██╔══██║██║   ██║██╔══╝  ██║╚██╗██║██║       ╚██╔╝  
██████╔╝██║  ██║███████║██║╚██████╗    ╚███╔███╔╝███████╗██████╔╝███████║██║   ██║   ███████╗    ██║  ██║╚██████╔╝███████╗██║ ╚████║╚██████╗   ██║   
╚═════╝ ╚═╝  ╚═╝╚══════╝╚═╝ ╚═════╝     ╚══╝╚══╝ ╚══════╝╚═════╝ ╚══════╝╚═╝   ╚═╝   ╚══════╝    ╚═╝  ╚═╝ ╚═════╝ ╚══════╝╚═╝  ╚═══╝ ╚═════╝   ╚═╝   
 -->
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>" />
    <meta name="viewport" content="width=device-width" />
<!--     <link rel="apple-touch-icon" sizes="180x180" href="<?php echo get_template_directory_uri(); ?>/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="<?php echo get_template_directory_uri(); ?>/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo get_template_directory_uri(); ?>/favicon-16x16.png">
    <link rel="manifest" href="<?php echo get_template_directory_uri(); ?>/site.webmanifest">
    <link rel="mask-icon" href="<?php echo get_template_directory_uri(); ?>/safari-pinned-tab.svg" color="#000000">
    <meta name="msapplication-TileColor" content="#000000">
    <meta name="theme-color" content="#ffffff"> -->
    <?php wp_head(); ?>

</head>
<body <?php body_class(); ?>>
    
    <header class="site-header row">
        <div class="header__desktop row middle col-12">
            <div class="header__left col-2 middle">
                <img src="<?php echo get_template_directory_uri() . '/images/sun-white.png'; ?>" />
                <div class="region__display">
                    <span class="region__display__text">Delivery Zone: At Large</span>
                    <a href="" class="region__display__change">Change</a>
                </div>
            </div>
            <div class="header__middle header__menu row col-8 middle">
                <a href="/" title="Salmonberry Common" class="col-12">
                    <img class="site-logo" src="<?php echo get_template_directory_uri() . '/images/logo-site.png'; ?>" />
                </a>
                <?php 
                    wp_nav_menu(array(
                        'menu' => 'primary',
                        'container' => 'nav',
                        'container_class' => 'menu col-12',
                        'menu_class' => 'row center around',
                    )); 
                ?>
            </div>
            <div class="header__right row col-2 end">

                <div class="header__right__top row middle">
                    <div class="header__right__top__left col-4">
                        <a href="https://www.thesalmonberry.fun" target="_blank"><img class="header__salmonberry" src="<?php echo get_template_directory_uri() . '/images/salmonberry.png'; ?>" /></a>
                    </div>
                    <div class="col-2"></div>
                    <div class="header__right__top__right col-6">
                        <a class="header__cart" href="/cart">
                            <img class="cart__icon" src="<?php echo get_template_directory_uri() . '/images/shopping-bag.svg'; ?>" />
                            <div class="cart-item-total middle"><?php echo WC()->cart->get_cart_contents_count(); ?></div>
                        </a>
                    </div>
                </div>

                <div class="header__right__bottom row center middle">
                    <div class="header__right__bottom__left col-4">
                        <div class="header__search row center">
                            <svg class="search__button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 6.61 6.61"><defs><style></style></defs><g id="Layer_2" data-name="Layer 2"><g id="HEADER"><path d="M6.4,5.62,4.84,4.29a.74.74,0,0,0-.48-.21A2.44,2.44,0,0,0,5,2.48,2.48,2.48,0,1,0,2.48,5a2.44,2.44,0,0,0,1.6-.59.74.74,0,0,0,.21.48L5.62,6.4a.56.56,0,1,0,.78-.78ZM2.48,4.13A1.65,1.65,0,1,1,4.13,2.48,1.65,1.65,0,0,1,2.48,4.13Z"/></g></g></svg>
                            <form method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>">
                                <input type="text" class="search__input background__image" name="s" placeholder="" value="<?php echo get_search_query(); ?>">
                            </form>
                        </div>
                    </div>
                    <div class="col-2"></div>
                    <div class="header__right__bottom__right col-6">
                        <!-- <img class="header__provisions" src="<?php echo get_template_directory_uri() . '/images/quality-provisions.svg'; ?>" /> -->
                        <div class="header__orderby">Order by Midnight Sunday</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="header__mobile row middle bottom">
            <a class="col-11" href="/" title="Salmonberry Commons">
                <img class="site-logo" src="<?php echo get_template_directory_uri() . '/images/logo-site.png'; ?>" />
            </a>
            <div class="header__menu__secondary col-1">
                <button id="hamburger-menu" class="hamburger hamburger--spin" type="button">
                  <span class="hamburger-box">
                    <span class="hamburger-inner"></span>
                  </span>
                </button>
                <div id="menu__mobile">
                    <div class="row between">
                        <a class="header__cart show" href="/cart">
                            <img class="cart__icon" src="<?php echo get_template_directory_uri() . '/images/shopping-bag-blue.svg'; ?>" />
                            <div class="cart-item-total middle"><?php echo WC()->cart->get_cart_contents_count(); ?></div>
                        </a>
                        <div class="search__mobile"><img class="search__button search__header" src="<?php echo get_template_directory_uri() . '/images/search.svg'; ?>" /><input type="text" class="search__input search__header">
                        </div>
                    </div>
                    <?php wp_nav_menu(array(
                        'menu' => 'primary',
                        'container' => 'nav',
                        'container_class' => 'menu row end',
                        'menu_class' => '',
                        'container_id' => ''
                    )); ?>
                </div>
            </div>
            <div class="region__display">
                <span class="region__display__text">Delivery Zone: At Large</span>
                <a href="" class="region__display__change">Change</a>
            </div>
        </div>

        <div class="region__selection hide remove">
            <div class="region__selection__container row center">
                <div class="region__selection__title">
                    <h1>Where are you located?</h1>
                </div>
                <section class="row center">
                    <?php
                        $args = array(
                            'post_type'     => 'delivery-regions',
                            'post_status'   => 'publish'
                        );

                        $loop = new WP_Query( $args );

                        // echo('<pre>');
                        // print_r($loop);
                        // echo('</pre>');

                        if (have_posts()) : while ( $loop->have_posts() ) : $loop->the_post();

                    ?>

                        <div class="region__option row col-4 middle">
                            <div class="region__option__text">
                                <h1><?php the_title(); ?></h1>
                                <?php the_content(); ?>
                            </div>
                            <div class="region__option__button__container">
                                <button data-region="<?php echo $post->post_name; ?>" class="region__option__button">Choose</button>
                            </div>
                        </div>

                    <?php
                        endwhile;
                        endif;
                        wp_reset_query();
                    ?>
                </section>
            </div>
        </div>
    </header>
    
