<?php if( get_row_layout() == 'cards_with_background_images_block' ): ?>

<section class="cards-background-images-block">
	<div class="container">
		<div class="wrap m-auto">
			<div class="title-block">
				<h2><?php the_sub_field('heading'); ?></h2>
			</div>
		</div>
		<div class="bottom-part m-auto">
			<?php
			$right_image = get_sub_field('right_image');
			$description = get_sub_field('description');
			$bg_color = get_sub_field('background_color');
			if(get_sub_field('insert_image')){$img = 'img-true'; $enable = 0;}else{$img = 'img-false'; $enable = 1;} ?>
			<div class="ct-row d-flex flex-row-wrap <?php echo $img; ?>">
				<?php
				$cnt = 0;
				while( have_rows('cards') ) : the_row(); ?>
					<div class="post-col">
						<div class="text-block">
							<div class="img bg-cover" style="background-image: url('<?php the_sub_field('image'); ?>');"></div>
							<div class="text">
								<h3><?php the_sub_field('heading'); ?></h3>
								<?php the_sub_field('content'); ?>
							</div>
						</div>
					</div>
					<?php
					if($enable == 0){
						if($cnt == 3){
						?>
						<div class="right-img">
							<?php if($bg_color == 'Disable'){ $color = 'no-blue-overlay'; }else{$color = '';} ?>
							<div class="img-graph-block <?php echo $color; ?>">
								<div class="graph-img">
									<img src="<?php echo $right_image; ?>" alt="">
								</div>
								<div class="text">
									<p><?php echo $description; ?></p>
								</div>
							</div>
						</div>
						<?php
						}
					}
					?>
				<?php
					$cnt++;
					endwhile;
					wp_reset_postdata();
				?>
			</div>
		</div>
		<?php $btn = get_sub_field('button');
		if(!empty($btn['url'])){ ?>
			<div class="bottom-btn text-center">
				<a href="<?php echo $btn['url']; ?>" class="common-btn"><?php echo $btn['title']; ?></a>
			</div>
		<?php } ?>
	</div>
</section>

<?php endif; ?>