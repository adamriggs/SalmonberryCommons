<?php
/*
Template Name: Producers
*/
get_header(); ?>

<?php

    $producers = get_field('producers');

    // echo('<pre>');
    // print_r($producers);
    // echo('</pre>');
?>

<div id="primary" class="content-area">
    <main id="main" class="site-main single-page" role="main">
        
        <?php

            foreach($producers as $producer) {
                $producer = $producer['producer'];
                $id = $producer->ID;
                // echo('<pre>');
                // print_r($producer);
                // echo('</pre>');
        ?>

        <section class="row">
            <div class="col-3">
                <?php echo get_the_post_thumbnail($id, 'medium'); ?>
            </div>

            <div class="col-6">
                <h1 id="<?php echo $id; ?>"><?php echo $producer->post_title; ?></h1>
                <?php echo apply_filters('the_content', $producer->post_content); ?>
            </div>

            <div class="col-3">

            </div>
        </section>

        <?php
            }
        ?>
        
    </main>
</div>

<?php get_footer(); ?>