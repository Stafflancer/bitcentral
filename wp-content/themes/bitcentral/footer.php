<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package bitcentral
 */

?>
	<footer id="colophon" class="site-footer">
		<div class="footer-top">
			<img src="<?php echo get_stylesheet_directory_uri(); ?>/images/circles-footer.png" class="decorative-circles position-absolute d-none d-md-block" width="600" height="238" alt="Decorative Circles">
			<div class="container">
				<div class="menu-row d-flex flex-wrap justify-content-between white-text">
					<div class="menu-col first-menu">
						<?php wp_nav_menu( ['menu' => 'Footer Menu'] ); ?>
					</div>
					<div class="menu-col">
						<?php wp_nav_menu( ['menu' => 'Support'] ); ?>
						<?php while( have_rows('support_menu','option') ) : the_row(); ?>
							<div class="text"><?php the_sub_field('toll_free'); ?></div>
							<div class="text"><?php the_sub_field('local_support'); ?></div>
							<div class="text"><a href="mailto:<?php the_sub_field('support_email'); ?>"><?php the_sub_field('support_email'); ?></a></div>
						<?php endwhile; wp_reset_postdata(); ?>
					</div>
					<div class="menu-col">
						<?php wp_nav_menu( ['menu' => 'Contact'] ); ?>
						<?php while( have_rows('contact_menu','option') ) : the_row(); ?>
							<div class="text"><?php the_sub_field('sales'); ?></div>
							<div class="text"><a href="mailto:<?php the_sub_field('sales_email'); ?>"><?php the_sub_field('sales_email'); ?></a></div>
						<?php endwhile; wp_reset_postdata(); ?>
					</div>
					<div class="menu-col">
						<?php wp_nav_menu( ['menu' => 'Company'] ); ?>
					</div>
					<div class="menu-col newsletter-col">
						<?php wp_nav_menu( ['menu' => 'Resources'] ); ?>
						<?php while( have_rows('signup','option') ) : the_row(); ?>
							<div class="subscribe-form">
								<h5><?php the_sub_field('heading'); ?></h5>
								<?php echo do_shortcode('[gravityform id="'.get_sub_field('signup_form').'" title="false" description="false" ajax="false" tabindex="490"]'); ?>
							</div>
						<?php endwhile; wp_reset_postdata(); ?>
					</div>
				</div>
				<?php while( have_rows('support_form','option') ) : the_row(); ?>
					<div class="support-block d-flex flex-wrap align-items-center white-text">
						<p><?php the_sub_field('heading'); ?></p>
						<div class="subscribe-form">
							<a href="https://secure.logmeinrescue.com/Customer/Code.aspx" class="common-yellow-btn" target="_blank">Connect to Technician</a>
						</div>
					</div>
				<?php endwhile; wp_reset_postdata(); ?>
			</div>
		</div>
		<div class="bottom-row">
			<div class="container">
				<div class="inside d-flex flex-wrap align-items-center justify-content-between">
					<div class="logo">
						<a href="<?php echo get_site_url(); ?>">
							<img src="<?php echo get_stylesheet_directory_uri(); ?>/images/logo-white.svg" alt="Logo White" width="270" height="56">
						</a>
					</div>
					<div class="social-list">
						<?php
						while( have_rows('social_media','option') ) : the_row(); ?>
							<ul class="d-flex flex-wrap align-items-center justify-content-center">
								<?php if(get_sub_field('linekdin')){?><li><a href="<?php the_sub_field('linekdin'); ?>" target="_blank"><?php echo svg_icon('linkedin'); ?></a></li><?php } ?>
								<?php if(get_sub_field('twitter')){?><li><a href="<?php the_sub_field('twitter'); ?>" target="_blank"><?php echo svg_icon('twitter'); ?></a></li><?php } ?>
								<?php if(get_sub_field('facebook')){?><li><a href="<?php the_sub_field('facebook'); ?>" target="_blank"><?php echo svg_icon('facebook'); ?></a></li><?php } ?>
							</ul>
						<?php
						endwhile;
						wp_reset_postdata(); ?>
					</div>
					<div class="copyright">©<?php echo date('Y'); ?> Bitcentral, Inc. All Rights Reserved.</div>
				</div>
			</div>
		</div>
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php while( have_rows('core_news_videos','option') ) : the_row(); ?>
	<?php while( have_rows('product_videos') ) : the_row(); ?>
		<!-- Modal -->
		<div class="modal fade video-modal" id="core_news_menuvideoModal" tabindex="-1" role="dialog" aria-labelledby="videoModalLabel" aria-hidden="true">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<img src="<?php echo get_template_directory_uri(); ?>/images/close-icon.svg" alt="Close">
					</button>
					<div class="modal-body">
						<div class="section-title">Product Video</div>
						<div class="video">
							<video controls poster="<?php the_sub_field('image'); ?>">
								<source src="<?php the_sub_field('video'); ?>" type="video/mp4">
								Your browser does not support the video tag.
							</video>
						</div>
						<div class="content">
							<h3><?php the_sub_field('heading'); ?></h3>
							<p><?php the_sub_field('description'); ?></p>
						</div>
					</div>
				</div>
			</div>
		</div>
		<?php endwhile; wp_reset_postdata(); ?>

		<?php while( have_rows('brochure_videos') ) : the_row(); ?>
		<!-- Modal -->
		<div class="modal fade video-modal" id="brochure_news_menuvideoModal" tabindex="-1" role="dialog" aria-labelledby="videoModalLabel" aria-hidden="true">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<img src="<?php echo get_template_directory_uri(); ?>/images/close-icon.svg" alt="Close">
					</button>
					<div class="modal-body">
						<div class="section-title">Product Video</div>
						<div class="video">
							<video controls poster="<?php the_sub_field('image'); ?>">
								<source src="<?php the_sub_field('videos'); ?>" type="video/mp4">
								Your browser does not support the video tag.
							</video>
						</div>
						<div class="content">
							<h3><?php the_sub_field('heading'); ?></h3>
							<p><?php the_sub_field('description'); ?></p>
						</div>
					</div>
				</div>
			</div>
		</div>
		<?php endwhile; wp_reset_postdata(); ?>
<?php endwhile; wp_reset_postdata(); ?>

<?php while( have_rows('central_control_videos','option') ) : the_row(); ?>
	<?php while( have_rows('product_videos') ) : the_row(); ?>
		<!-- Modal -->
		<div class="modal fade video-modal" id="central_control_menuvideoModal" tabindex="-1" role="dialog" aria-labelledby="videoModalLabel" aria-hidden="true">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<img src="<?php echo get_template_directory_uri(); ?>/images/close-icon.svg" alt="Close">
					</button>
					<div class="modal-body">
						<div class="section-title">Product Video</div>
						<div class="video">
							<video controls poster="<?php the_sub_field('image'); ?>">
								<source src="<?php the_sub_field('video'); ?>" type="video/mp4">
								Your browser does not support the video tag.
							</video>
						</div>
						<div class="content">
							<h3><?php the_sub_field('heading'); ?></h3>
							<p><?php the_sub_field('description'); ?></p>
						</div>
					</div>
				</div>
			</div>
		</div>
	<?php
	endwhile;
	wp_reset_postdata();
	?>
	<?php while( have_rows('brochure_videos') ) : the_row(); ?>
		<!-- Modal -->
		<div class="modal fade video-modal" id="central_brochure_news_menuvideoModal" tabindex="-1" role="dialog" aria-labelledby="videoModalLabel" aria-hidden="true">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<img src="<?php echo get_template_directory_uri(); ?>/images/close-icon.svg" alt="Close">
					</button>
					<div class="modal-body">
						<div class="section-title">Product Video</div>
						<div class="video">
							<video controls poster="<?php the_sub_field('image'); ?>">
								<source src="<?php the_sub_field('videos'); ?>" type="video/mp4">
								Your browser does not support the video tag.
							</video>
						</div>
						<div class="content">
							<h3><?php the_sub_field('heading'); ?></h3>
							<p><?php the_sub_field('description'); ?></p>
						</div>
					</div>
				</div>
			</div>
		</div>
	<?php endwhile; wp_reset_postdata(); ?>
<?php endwhile; wp_reset_postdata(); ?>

<?php while( have_rows('fuel_videos','option') ) : the_row(); ?>
	<?php while( have_rows('product_videos') ) : the_row(); ?>
		<!-- Modal -->
		<div class="modal fade video-modal" id="fuel_menuvideoModal" tabindex="-1" role="dialog" aria-labelledby="videoModalLabel" aria-hidden="true">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<img src="<?php echo get_template_directory_uri(); ?>/images/close-icon.svg" alt="Close">
					</button>
					<div class="modal-body">
						<div class="section-title">Product Video</div>
						<div class="video">
							<video controls poster="<?php the_sub_field('image'); ?>">
								<source src="<?php the_sub_field('video'); ?>" type="video/mp4">
								Your browser does not support the video tag.
							</video>
						</div>
						<div class="content">
							<h3><?php the_sub_field('heading'); ?></h3>
							<p><?php the_sub_field('description'); ?></p>
						</div>
					</div>
				</div>
			</div>
		</div>
		<?php endwhile; wp_reset_postdata(); ?>
		<?php while( have_rows('brochure_videos') ) : the_row(); ?>
		<!-- Modal -->
		<div class="modal fade video-modal" id="fuel_brochure_news_menuvideoModal" tabindex="-1" role="dialog" aria-labelledby="videoModalLabel" aria-hidden="true">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<img src="<?php echo get_template_directory_uri(); ?>/images/close-icon.svg" alt="Close">
					</button>
					<div class="modal-body">
						<div class="section-title">Product Video</div>
						<div class="video">
							<video controls poster="<?php the_sub_field('image'); ?>">
								<source src="<?php the_sub_field('videos'); ?>" type="video/mp4">
								Your browser does not support the video tag.
							</video>
						</div>
						<div class="content">
							<h3><?php the_sub_field('heading'); ?></h3>
							<p><?php the_sub_field('description'); ?></p>
						</div>
					</div>
				</div>
			</div>
		</div>
		<?php endwhile; wp_reset_postdata(); ?>
<?php endwhile; wp_reset_postdata(); ?>

<?php
$classes = get_body_class();
if (in_array('page-fuel', $classes)) {
	?>
	<script>
		// Menu anchorlink click function
		jQuery( '.mega-sub-menu .mega-menu-item .menu-link-group .menu-col ul li a' ).on( 'click', function ( event ) {
			var headerheight = jQuery( '.site-header' ).height();
			if ( this.hash !== '' ) {
				event.preventDefault();
				var hash = this.hash;
				jQuery( 'html, body' ).animate( {
					scrollTop: jQuery( hash ).offset().top - headerheight
				}, 0 );
			}
		} );
	</script>
<?php } ?>
<?php wp_footer(); ?>
<?php get_template_part( 'template-parts/svg-icons', 'defs' ); ?>
</body>
</html>