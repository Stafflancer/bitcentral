<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package bitcentral
 */

get_header();
?>
<?php
if ( ! post_password_required() ) {
  if( have_rows('components') ):
    while ( have_rows('components') ) : the_row();
      get_components();
    endwhile;
  endif;
}else
{ ?>
	<div class="without-password">
		<?php  the_content(); ?>
	</div>
<?php }
?>
<?php
get_footer();