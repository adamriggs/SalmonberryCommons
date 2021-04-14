<?php get_header(); ?>

<div id="primary" class="content-area">
	<main id="main" class="site-main single-page" role="main">
        <section class="row">
            <div class="col-3">
                <img src="<?php echo get_template_directory_uri() . '/images/logo-tall.svg'; ?>">
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
