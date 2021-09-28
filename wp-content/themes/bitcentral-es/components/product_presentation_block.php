<?php if (get_row_layout() == 'product_presentation_block'): ?>

	<section class="product-presentation-block">
		<div class="container">
			<div class="wrap m-auto">
				<div class="listing d-flex flex-row-wrap">
					<?php while (have_rows('left_content')) : the_row();
						if (get_sub_field('circle_color') == 'Green') {
							$color = 'green-dot';
						} elseif (get_sub_field('circle_color') == 'Red') {
							$color = 'red-dot';
						} elseif (get_sub_field('circle_color') == 'Blue') {
							$color = 'blue-dot';
						} elseif (get_sub_field('circle_color') == 'Yellow') {
							$color = 'yellow-dot';
						}
						?>
						<div class="img-content <?php echo $color; ?>">
							<div class="img bg-cover" style="background-image: url('<?php the_sub_field('image'); ?>');"></div>
							<div class="text">
								<h3><?php the_sub_field('heading'); ?></h3>
								<?php the_sub_field('content'); ?>
							</div>
						</div>
					<?php endwhile;
					wp_reset_postdata(); ?>

					<?php while (have_rows('right_content')) : the_row(); ?>
						<div class="right-col">
							<div class="img-slider owl-carousel">
								<?php
								$images = get_sub_field('image_slides');
								foreach ($images as $image_id):
									?>
									<div class="item">
										<img src="<?php echo $image_id; ?>" alt="Product Image">
									</div>
								<?php endforeach; ?>
							</div>
							<?php if (get_sub_field('resources')) { ?>
								<div class="resources-list-small d-flex flex-row-wrap">
									<?php
									$resources = get_sub_field('resources');
									foreach ($resources as $p):
										$resources_list = get_post($p);
										$image = wp_get_attachment_image_src(get_post_thumbnail_id($p), 'full');
										?>
										<div class="list-col">
											<div class="section-title">
												<?php $postType = get_post_type_object(get_post_type($p));
												$post_type      = esc_html($postType->labels->singular_name);
												echo $post_type;
												?>
											</div>
											<h3><?php echo $resources_list->post_title; ?></h3>
											<div class="img bg-cover" style="background-image: url('<?php echo $image[0]; ?>');"></div>
											<div class="common-link-style">
												<a href="<?php the_permalink($p); ?>">
													<?php if ($post_type == 'Brochure') {
														$title = 'Download';
													} elseif ($post_type == 'Product Video') {
														$title = 'Watch';
													} elseif ($post_type == 'White Paper') {
														$title = 'View';
													} else {
														$title = 'View';
													}
													echo $title;
													?>
													<?php echo svg_icon('arrow-right'); ?>
												</a>
											</div>
										</div>
									<?php endforeach;
									wp_reset_postdata(); ?>
								</div>
							<?php } ?>
						</div>
					<?php endwhile;
					wp_reset_postdata(); ?>
				</div>
			</div>
		</div>
	</section>
<?php endif; ?>