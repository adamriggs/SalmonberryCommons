<?php
/*
Template Name: Producers
*/
get_header(); ?>

<div id="primary" class="content-area">
    <main id="main" class="site-main single-page" role="main">
        
        <?php
            $args = array(
                    'post_type'     => 'producers',
                    'post_status'   => 'publish'
            );

            $loop = new WP_Query( $args );

            if (have_posts()) : while ( $loop->have_posts() ) : $loop->the_post();
        ?>

        <section class="row">
            <div class="col-3">
                <?php the_post_thumbnail('medium'); ?>
            </div>

            <div class="col-6">
                <h1 id="<?php echo get_the_id(); ?>"><?php the_title(); ?></h1>
                <?php the_content(); ?>
            </div>

            <div class="col-3">

            </div>
        </section>

        <?php
            endwhile;
            endif;
            wp_reset_query();
        ?>
        
    </main>
</div>

<?php get_footer(); ?>