<?php if (get_row_layout() == 'cards_full_width_block'): ?>

	<section class="cards-full-width-block">
		<div class="container">
			<div class="wrap m-auto">
				<div class="section-title"><?php the_sub_field('label'); ?></div>
				<?php
				$count = 0;
				while (have_rows('cards')) : the_row(); ?>
					<div class="ct-row">
						<div class="img bg-cover" style="background-image: url('<?php the_sub_field('background_image'); ?>');"></div>
						<div class="content d-flex flex-row-wrap">
							<div class="col-lg-6 p-0">
								<?php while (have_rows('left_column')) : the_row();
									if (get_sub_field('add_color')) {
										if (get_sub_field('dot_color') == 'Green') {
											$color = 'green-dot';
										} elseif (get_sub_field('dot_color') == 'Red') {
											$color = 'red-dot';
										} elseif (get_sub_field('dot_color') == 'Blue') {
											$color = 'blue-dot';
										} elseif (get_sub_field('dot_color') == 'Yellow') {
											$color = 'yellow-dot';
										}
									} else {
										$color = 'no-dot';
									}
									?>
									<div class="left-col <?php echo $color; ?>">
										<div class="text">
											<h3><?php the_sub_field('heading'); ?></h3>
											<?php the_sub_field('content'); ?>
										</div>
									</div>
								<?php endwhile;
								wp_reset_postdata();

								if (get_sub_field('add_video')) {
									$video      = get_sub_field('video');
									$video_list = get_post($video);
									$image      = wp_get_attachment_image_src(get_post_thumbnail_id($video), 'full');
									?>
									<div class="video-small">
										<div class="img bg-cover" style="background-image: url('<?php echo $image[0]; ?>');"></div>
										<div class="common-link-style">
											<a href="javascript:void(0);" data-toggle="modal" data-target="#videoModal-<?php echo $count; ?>">
												Watch video<?php echo svg_icon('arrow-right'); ?>
											</a>
										</div>
									</div>
								<?php } ?>
							</div>
							<?php while (have_rows('right_column')) : the_row(); ?>
								<div class="col-lg-6 p-0">
									<div class="right-col">
										<div class="text">
											<?php the_sub_field('content'); ?>
										</div>
									</div>
								</div>
							<?php endwhile;
							wp_reset_postdata(); ?>
						</div>

						<?php if (get_sub_field('add_video')) {
							$class = 'video';
						} else {
							$class = '';
						} ?>
						<?php if (get_sub_field('background_color') == 'Disable') {
							$bgcolor = 'no-blue-overlay';
						} else {
							$bgcolor = '';
						} ?>
						<div class="bottom-full-image <?php echo $class . ' ' . $bgcolor; ?>">
							<div class="graph-img">
								<?php
								$bottom_video        = get_sub_field('bottom_video');
								$bottom_video_poster = get_sub_field('bottom_video_poster');
								if (!empty($bottom_video)) { ?>
									<video poster="<?php echo $bottom_video_poster; ?>" autoplay loop muted>
										<source src="<?php the_sub_field('bottom_video'); ?>" type="video/mp4">
									</video>
								<?php } elseif (get_sub_field('bottom_image')) { ?>
									<img src="<?php the_sub_field('bottom_image'); ?>" alt="">
								<?php } ?>
							</div>
							<div class="text">
								<p><?php the_sub_field('image_description'); ?></p>
							</div>
						</div>
					</div>
					<?php
					$count++;
				endwhile;
				wp_reset_postdata(); ?>
			</div>
			<?php $btn = get_sub_field('button');
			if (!empty($btn['url'])) { ?>
				<div class="bottom-btn text-center">
					<a href="<?php echo $btn['url']; ?>" class="common-btn"><?php echo $btn['title']; ?></a>
				</div>
			<?php } ?>
		</div>
	</section>
	<?php
	$cnt = 0;
	while (have_rows('cards')) : the_row();
		$video      = get_sub_field('video');
		$video_list = get_post($video);
		$image      = wp_get_attachment_image_src(get_post_thumbnail_id($video), 'full');
		?>
		<!-- Modal -->
		<div class="modal fade video-modal" id="videoModal-<?php echo $cnt; ?>" tabindex="-1" role="dialog"
			 aria-labelledby="videoModalLabel" aria-hidden="true">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<img src="<?php echo get_template_directory_uri(); ?>/images/close-icon.svg" alt="Close">
					</button>
					<div class="modal-body">
						<div class="section-title">Product Video</div>
						<?php
						if (get_field('video', $video)) {
							?>
							<video controls poster="<?php echo $image[0]; ?>">
								<source src="<?php echo get_field('video', $video); ?>" type="video/mp4">
								Your browser does not support the video tag.
							</video>
						<?php } else { ?>
							<iframe src="<?php echo get_field('url', $video); ?>" frameborder="0"
									allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
									allowfullscreen></iframe>
						<?php } ?>
						<div class="content">
							<h3><?php echo $video_list->post_title; ?></h3>
							<p><?php echo $video->post_content; ?></p>
						</div>
					</div>
				</div>
			</div>
		</div>
		<?php
		$cnt++;
	endwhile;
	wp_reset_postdata();
	?>
<?php endif; ?>