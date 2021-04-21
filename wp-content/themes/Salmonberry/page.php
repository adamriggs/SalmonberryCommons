<?php get_header(); ?>

<?php
    $sidebar_image = get_field('sidebar_image');

    // echo('<pre>');
    // print_r(isset($sidebar_image));
    // echo('</pre>');
?>

<div id="primary" class="content-area">
	<main id="main" class="site-main single-page" role="main">
        <section class="row">
            <div class="col-3">
                <?php
                    if(isset($sidebar_image) && $sidebar_image != '') {
                        $sidebar_image_url = $sidebar_image['sizes']['medium'];
                ?>
                    <img src="<?php echo $sidebar_image_url; ?>">
                <?php
                    } else {
                ?>
                    <img src="<?php echo get_template_directory_uri() . '/images/logo-tall.svg'; ?>">
                <?php 
                    }
                ?>
            </div>

            <div class="col-6">
        		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                    <?php the_post_thumbnail(); ?>
        			<?php the_content(); ?>
        		<?php endwhile; endif; ?>
            </div>

            <div class="col-3">

            </div>
        </section>
	</main>
</div>

<?php get_footer(); ?>
