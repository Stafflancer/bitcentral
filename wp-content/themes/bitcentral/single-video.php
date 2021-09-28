<?php
/**
 * The template for displaying all single posts
 *
 * @link    https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package accurate
 */

get_header();
?>


<main id="main" class="site-main">
	<?php
	while ( have_posts() ) : the_post();
		get_template_part( 'template-parts/content', 'video');
	endwhile;
    wp_reset_postdata();// End of the loop.
	?>
</main><!-- #main -->

<?php
get_footer();