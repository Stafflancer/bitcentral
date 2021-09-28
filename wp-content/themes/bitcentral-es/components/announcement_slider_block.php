<?php if( get_row_layout() == 'announcement_slider_block' ): ?>

<section class="announcement-slider-block">
	<div class="container">
		<div class="inside d-flex flex-wrap">
			<div class="title">
				<div class="section-title"><?php the_sub_field('label'); ?></div>
			</div>
			<div class="news-list owl-carousel">
				<?php while( have_rows('sliders') ) : the_row();
					if(empty(get_sub_field('image'))){ $img = 'no-img'; }
					else{$img = ''; }
				?>
					<div class="item d-flex flex-wrap <?php echo $img; ?>">
						<?php if(get_sub_field('image')){ ?>
							<div class="img">
								<img src="<?php the_sub_field('image'); ?>" alt="Announcement Image">
							</div>
						<?php } ?>
						<div class="heading">
							<h3><?php the_sub_field('heading'); ?></h3>
						</div>
						<div class="text">
							<?php the_sub_field('content'); ?>
						</div>
						<?php $btn = get_sub_field('button');
						if(!empty($btn['url'])){ ?>
							<div class="link">
								<div class="common-link-style">
									<a href="<?php echo $btn['url']; ?>" target="<?php echo $btn['target']; ?>">
										<?php echo $btn['title']  . svg_icon('arrow-right'); ?>
									</a>
								</div>
							</div>
						<?php } ?>
					</div>
				<?php endwhile; wp_reset_postdata(); ?>
			</div>
		</div>
	</div>
</section>

<?php endif; ?>