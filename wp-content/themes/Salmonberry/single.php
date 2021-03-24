<?php get_header(); ?>

<div id="primary" class="content-area">
	<main id="main" class="site-main post" role="main">
        <section class="post__container">
            <?php include get_template_directory() . '/inc/featured.php'; ?>
            <div class="post__content">
                <?php the_content(); ?>
            </div>
        </section>
        <section class="posts__nav row">
            <div class="col-6"><?php previous_post_link(); ?></div>
            <div class="col-6 end"><?php next_post_link(); ?></div>
        </section>
	</main>
</div>

<?php get_footer(); ?>
