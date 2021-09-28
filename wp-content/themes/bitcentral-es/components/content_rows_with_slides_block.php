<?php if( get_row_layout() == 'content_rows_with_slides_block' ): ?>

<section class="content-rows-slides-block">
	<div class="container">
		<div class="wrap m-auto">
			<div class="section-title"><?php the_sub_field('label'); ?></div>
			<?php while( have_rows('rows') ) : the_row();
				if(get_sub_field('position') == 'Left'){ $position = 'img-left'; }
				elseif(get_sub_field('position') == 'Right'){ $position = 'img-right'; }
			?>
				<div class="ct-row d-flex flex-row-wrap <?php echo $position; ?>">
					<div class="text-block">
						<div class="img bg-cover" style="background-image: url('<?php the_sub_field('image'); ?>');"></div>
						<div class="text">
							<h3><?php the_sub_field('heading'); ?></h3>
							<p><?php the_sub_field('content'); ?></p>
						</div>
					</div>
					<div class="img-slide owl-carousel">
						<?php while( have_rows('slider') ) : the_row(); ?>
							<div class="item">
								<img src="<?php the_sub_field('image'); ?>" alt="">
								<div class="text white-text">
									<h3><?php the_sub_field('heading'); ?></h3>
									<p><?php the_sub_field('description'); ?></p>
								</div>
							</div>
						<?php endwhile; wp_reset_postdata(); ?>
					</div>
				</div>
			<?php endwhile; wp_reset_postdata(); ?>
		</div>
	</div>
</section>
<?php endif; ?>