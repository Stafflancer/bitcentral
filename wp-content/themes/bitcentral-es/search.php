<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package bitcentral
 */

get_header();
?>

	<main id="primary" class="site-main">
		<?php if ( have_posts() ) : ?>
			<section class="common-banner bg-cover" style="background-image: url('<?php echo get_template_directory_uri(); ?>/images/support-banner.png');">
				<div class="container">
					<div class="inner d-flex flex-row-wrap">
						<div class="text-block white-text">
							<h1 class="page-title">
								<?php
								/* translators: %s: search query. */
								printf( esc_html__( 'Search Results for: %s', 'bitcentral' ), '<span>' . get_search_query() . '</span>' );
								?>
							</h1>
						</div>
					</div>
				</div>
			</section>

			<?php
			/* Start the Loop */
			while ( have_posts() ) :
				the_post();
				/**
				 * Run the loop for the search to output the results.
				 * If you want to overload this in a child theme then include a file
				 * called content-search.php and that will be used instead.
				 */
				get_template_part( 'template-parts/content', 'search' );
			endwhile;

			the_posts_navigation();
		else :
			get_template_part( 'template-parts/content', 'none' );
		endif;
		?>
	</main><!-- #main -->
<?php
get_sidebar();
get_footer();