<?php
    get_header();
    wp_enqueue_script('home', get_template_directory_uri() . '/dist/home-bundle.js', [], time());
?>

<?php

    $hero = get_field('hero');
    $hero_image = $hero['image'];
    $hero_image_desktop = $hero_image['sizes']['large'];
    $hero_image_mobile = $hero_image['sizes']['medium'];
    $hero_title = $hero['title'];
    $hero_subtitle = $hero['subtitle'];

    $secondary = get_field('explanation');
    $secondary_title = $secondary['title'];
    $secondary_steps = $secondary['steps'];

    $tertiary = get_field('products');
    $tertiary_title = $tertiary['title'];
    $tertiary_categories = $tertiary['categories'];

    // echo('<pre>');
    // print_r($tertiary_categories);
    // echo('</pre>');
?>

<div id="primary" class="content-area">
    <main id="main" class="site-main home" role="main">

        <section class="home__primary row">

            <div class="home__primary__text col-3">
                <div class="center">
                    <h1><?php echo $hero_title; ?></h1>
                </div>
                <div class="center">
                    <h3 class="h3__invert home__primary__text__subtitle"><?php echo $hero_subtitle; ?></h3>
                </div>
                <div class="home__primary__arrow">
                    <img class="arrow__down center" src="<?php echo get_template_directory_uri() . '/images/arrow-down.svg' ?>">
                </div>
            </div>

            <div class="col-9">
                <!-- <div style="width: 100%; height: 513px;"> -->
                    <!-- style="background-image: url(<?php echo $hero_image_desktop; ?>)" -->
                    <div class="home__primary__image background__image" style="background-image: url(<?php echo $hero_image_desktop; ?>)"><!-- <img src="<?php echo $hero_image_desktop; ?>"> --></div>
                <!-- </div> -->
            </div>

        </section>

        <section class="home__secondary row">
            <div class="col-12 center"><h1><?php echo $secondary_title; ?></h1></div>

            <div class="home__secondary__step__container row around">
                <?php
                    foreach($secondary_steps as $step) {
                ?>
                    <div class="home__secondary__step col-4 center">
                        <img src="<?php echo $step['image']['sizes']['medium']; ?>">
                        <h2><?php echo $step['title']; ?></h2>
                        <p><?php echo $step['text']; ?></p>
                    </div>
                <?php
                    }
                ?>
            </div>

            <div class="home__secondary__arrow__container row center">
                <img class="home__secondary__arrow arrow__down center" src="<?php echo get_template_directory_uri() . '/images/arrow-down.svg' ?>">
            </div>
        </section>

        <section class="home__tertiary row">
            <div class="home__tertiary__title col-12 center"><h1><?php echo $tertiary_title; ?></h1></div>

            <?php
                foreach($tertiary_categories as $cat) {
                    $cat_id = $cat;
                    include get_template_directory() . '/inc/product-row.php';
                }
            ?>
            
        </section>

    </main>
</div>

<?php get_footer(); ?>
