<?php if( get_row_layout() == 'subpage_cards_with_background_images_block' ): ?>

<section class="subpage-cards-block">
	<div class="container">
		<div class="wrap m-auto">
			<div class="listing d-flex flex-wrap">
				<?php while( have_rows('cards') ) : the_row();
					$sub_page = get_sub_field('subpage');
					$image = wp_get_attachment_image_src( get_post_thumbnail_id( $sub_page ), 'full' );
				?>
					<div class="card-col">
						<a href="<?php the_permalink($sub_page); ?>">
							<div class="inside">
								<div class="img bg-cover" style="background-image: url('<?php echo $image[0]; ?>');"></div>
							</div>
							<div class="content">
								<div class="section-title"><?php the_sub_field('label'); ?></div>
								<h3><?php echo $sub_page->post_title; ?></h3>
								<p><?php the_sub_field('excerpt'); ?></p>
								<div class="learn-more">Learn more <?php echo svg_icon('arrow-right'); ?></div>
							</div>
						</a>
					</div>
				<?php endwhile; wp_reset_postdata(); ?>
			</div>
		</div>
	</div>
</section>

<?php endif; ?>