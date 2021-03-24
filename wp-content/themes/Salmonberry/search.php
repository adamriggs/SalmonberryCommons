<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package WordPress
 * @subpackage Twenty_Twenty_One
 * @since Twenty Twenty-One 1.0
 */

get_header();

if ( have_posts() ) {
	?>
	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
			<header class="page-header alignwide">
				<h1 class="page-title">
					<?php
					printf(
						/* translators: %s: search term. */
						esc_html__( 'Results for "%s"', 'twentytwentyone' ),
						'<span class="page-description search-term">' . esc_html( get_search_query() ) . '</span>'
					);
					?>
				</h1>
			</header><!-- .page-header -->

			<?php include get_template_directory() . '/inc/search-form.php'; ?>

			<div class="search-result-count default-max-width">
				<?php
				printf(
					esc_html(
						/* translators: %d: the number of search results. */
						_n(
							'We found %d result for your search.',
							'We found %d results for your search.',
							(int) $wp_query->found_posts,
							'twentytwentyone'
						)
					),
					(int) $wp_query->found_posts
				);
				?>
			</div><!-- .search-result-count -->
			<div class="search__results">
				<?php
					// Start the Loop.
					while ( have_posts() ) {
						the_post();
						?>
		 				<a href="<?php the_permalink(); ?>">
							<h4><?php the_title(); ?></h4>
						</a>
						<?php the_excerpt(); ?>

						<?php
					} // End the loop.
} else {
		echo('<div class="site-main">');
		echo('<p>No results match your search terms');
		include get_template_directory() . '/inc/search-form.php';
}
				?>
			</div>
		</div>
	</main>
</div>

<?php
get_footer();
?>
