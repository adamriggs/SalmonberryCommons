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
                $name = $producer->post_name;
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

                <?php
                    $args = array (
                            'post_type'         => 'product',
                            // 'post_status'       => 'publish',
                            'meta_query'        => array (
                                // 'relation' => 'AND',
                                array (
                                    'key'       => 'producers',
                                    // 'value'     => $producer->post_name,
                                    'value'     => strPrettify($name),
                                    'compare'   => '=',
                                    // 'value'     => '',
                                    // 'compare'   => '!='
                                )
                            ),
                    );

                        // echo('<pre>');
                        // print_r(strPrettify($name));
                        // echo('</pre>');

                    $loop = new WP_Query( $args );

                    if (have_posts()) : while ( $loop->have_posts() ) : $loop->the_post();


                        // $p = get_field('producers');
                        // echo('<pre>');
                        // print_r($p);
                        // echo('</pre>');
                        echo get_the_title() . ',';

                    endwhile;
                    endif;
                    wp_reset_query();
                ?>
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