<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package bitcentral
 */

get_header();
?>

	<main id="primary" class="site-main">

		<section class="common-banner bg-cover" style="background-image: url('<?php echo get_template_directory_uri(); ?>/images/support-banner.png');">
	        <div class="container">
	            <div class="inner d-flex flex-row-wrap">
	                <div class="text-block white-text">
	                    <h1 class="page-title"><?php esc_html_e( 'Oops! That page can&rsquo;t be found.', 'bitcentral' ); ?></h1>
	                    <p><?php esc_html_e( 'It looks like nothing was found at this location.', 'bitcentral' ); ?></p>
	                </div>
	            </div>
	        </div>
	    </section>

		<section class="error-404 not-found">

			<div class="page-content">

					<?php
					//get_search_form();

					//the_widget( 'WP_Widget_Recent_Posts' );
					?>
					<?php /*
					<div class="widget widget_categories">
						<h2 class="widget-title"><?php esc_html_e( 'Most Used Categories', 'bitcentral' ); ?></h2>
						<ul>
							<?php
							wp_list_categories(
								array(
									'orderby'    => 'count',
									'order'      => 'DESC',
									'show_count' => 1,
									'title_li'   => '',
									'number'     => 10,
								)
							);
							?>
						</ul>
					</div><!-- .widget -->
					*/ ?>

					<?php
					/* translators: %1$s: smiley */
					//$bitcentral_archive_content = '<p>' . sprintf( esc_html__( 'Try looking in the monthly archives. %1$s', 'bitcentral' ), convert_smilies( ':)' ) ) . '</p>';
					//the_widget( 'WP_Widget_Archives', 'dropdown=1', "after_title=</h2>$bitcentral_archive_content" );

					//the_widget( 'WP_Widget_Tag_Cloud' );
					?>

			</div><!-- .page-content -->
		</section><!-- .error-404 -->

	</main><!-- #main -->

<?php
get_footer();