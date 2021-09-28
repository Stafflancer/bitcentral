<?php if( get_row_layout() == 'our_awards_carousel_block' ): ?>

<section class="resources-listing awards-carousel-block">
	<div class="container">
		<div id="awardslist" class="group-main awards-list">
			<div class="wrap m-auto">
				<div class="section-title"><?php echo get_sub_field('label') ?></div>
			</div>
			<div class="grid-post">
				<div class="listing d-flex flex-wrap awards-slider owl-carousel">
					<?php
					$awards = get_sub_field('awards');
					$delay = 0.25;
					foreach( $awards as $p):
						$awards_list = get_post($p);
						$image = wp_get_attachment_image_src( get_post_thumbnail_id( $p ), 'full' );
					?>
						<div class="post-col">
							<a href="<?php the_permalink(); ?>">
								<div class="date">
									<span class="month"><?php echo get_the_date('M', $p); ?></span>
									<span class="no"><?php echo get_the_date('d', $p); ?></span>
									<span class="year"><?php echo get_the_date('Y', $p); ?></span>
								</div>
								<div class="award-img">
									<img src="<?php the_field('logo', $p); ?>" alt="">
								</div>
								<div class="content">
									<h3><?php echo $awards_list->post_title; ?></h3>
								</div>
							</a>
						</div>
					<?php endforeach; wp_reset_postdata(); ?>
				</div>
			</div>
		</div>
	</div>
</section>

<?php endif; ?>