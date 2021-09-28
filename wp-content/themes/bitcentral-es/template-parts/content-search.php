<?php
/**
 * Template part for displaying results in search pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package bitcentral
 */

?>

<div class="search-result-main">
	<div class="container">
		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<header class="entry-header">
				<?php the_title( sprintf( '<h3 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h3>' ); ?>

			</header><!-- .entry-header -->

			<div class="entry-summary">
				<?php the_excerpt(); ?>
			</div><!-- .entry-summary -->

			<footer class="entry-footer">
				<?php bitcentral_entry_footer(); ?>
				<hr />
			</footer><!-- .entry-footer -->
		</article><!-- #post-<?php the_ID(); ?> -->