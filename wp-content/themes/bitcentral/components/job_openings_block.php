<?php if (get_row_layout() == 'job_openings_block'): ?>

	<section class="job-openings-block">
		<div class="container">
			<div class="wrap m-auto">
				<div class="section-title"><?php the_sub_field('label'); ?></div>
				<div class="listing">
					<?php
					$positions = get_sub_field('positions');
					foreach ($positions as $p):
						$positions_list = get_post($p);
						$image = wp_get_attachment_image_src(get_post_thumbnail_id($p), 'full');
						?>
						<div class="ct-row d-flex flex-row-wrap">
							<div class="name-col">
								<h3><?php echo $positions_list->post_title; ?></h3>
							</div>
							<div class="text-col">
								<div class="national"><?php the_field('location', $p); ?></div>
								<p><?php the_field('employment_type', $p); ?></p>
							</div>
							<div class="date-col">
								<div class="date"><?php echo get_the_date('M d', $p); ?></div>
								<div class="new">NEW!</div>
							</div>
							<div class="link">
								<div class="common-link-style">
									<a href="<?php the_permalink($p); ?>">Learn more<?php echo svg_icon('arrow-right'); ?></a>
								</div>
							</div>
						</div>
					<?php endforeach;
					wp_reset_postdata(); ?>
				</div>
				<div class="bottom-line">
					<?php the_sub_field('footnote'); ?>
				</div>
			</div>
		</div>
	</section>

<?php endif; ?>