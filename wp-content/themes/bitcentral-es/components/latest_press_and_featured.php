<?php if( get_row_layout() == 'latest_press_and_featured' ): ?>

<section class="latest-press-videos-block">
	<div class="container">
		<div class="row m-0">
			<div class="col-xl-3 p-0">
				<div class="vertical-post">
					<div class="listing d-flex flex-wrap">
						<?php while( have_rows('news_listing') ) : the_row();
							$news = get_sub_field('news');
						?>
							<div class="post-col">
								<a href="<?php the_permalink($news); ?>">
									<div class="date">
										<span class="month"><?php echo get_the_date('M', $news); ?></span>
										<span class="no"><?php echo get_the_date('d', $news); ?></span>
										<span class="year"><?php echo get_the_date('Y', $news); ?></span>
									</div>
									<div class="section-title">
										<?php
											$terms = wp_get_post_terms( $news, 'news_type' );
											if ( ! empty( $terms ) && ! is_wp_error( $terms ) ) {
												$taxonomy = $terms[0]->name;
												echo $taxonomy;
											}
										?>
									</div>
									<h3><?php echo get_the_title($news); ?></h3>
									<div class="read-more"><?php the_sub_field('button_text'); ?> <?php echo svg_icon('arrow-right'); ?></div>
								</a>
							</div>
						<?php endwhile; wp_reset_postdata(); ?>
					</div>
					<div class="view-more">
						<?php $btn = get_sub_field('news_link');
						if(!empty($btn['url'])){ ?>
							<a href="<?php echo $btn['url']; ?>" class="all-link">
								<?php echo $btn['title']; ?><?php echo svg_icon('arrow-right'); ?>
							</a>
						<?php } ?>
					</div>
				</div>
			</div>
			<div class="col-xl-9 p-0">
				<div class="grid-post">
					<div class="listing d-flex flex-wrap">
						<?php while( have_rows('videos') ) : the_row();
							$video = get_sub_field('video');
							$image = wp_get_attachment_image_src( get_post_thumbnail_id( $video ), 'full' );
						?>
							<div class="post-col">
								<a href="<?php the_permalink($video); ?>">
									<div class="img bg-cover" style="background-image: url('<?php echo $image[0]; ?>');"></div>
									<div class="content">
										<div class="section-title">
											<?php
												$postType  = get_post_type_object( get_post_type($video) );
												$post_type = esc_html( $postType->labels->singular_name );
												echo $post_type;
											?>
										</div>
										<h3><?php echo get_the_title($video); ?></h3>
										<p><?php echo get_the_excerpt($video); ?></p>
										<div class="read-more"><?php the_sub_field('button_text'); ?> <?php echo svg_icon('arrow-right'); ?></div>
									</div>
								</a>
							</div>
						<?php endwhile; wp_reset_postdata(); ?>
					</div>
					<div class="view-more text-center">
						<?php $btn_video = get_sub_field('video_link');
						if(!empty($btn_video['url'])){ ?>
							<a href="<?php echo $btn_video['url']; ?>" class="all-link">
								<?php echo $btn_video['title']; ?><?php echo svg_icon('arrow-right'); ?>
							</a>
						<?php } ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

<?php endif; ?>