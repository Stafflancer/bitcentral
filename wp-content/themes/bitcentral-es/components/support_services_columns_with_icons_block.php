<?php if( get_row_layout() == 'support_services_columns_with_icons_block' ): ?>

<section class="support-services-block">
	<div class="container">
		<div class="wrap m-auto narrow"> <!--'narrow' 'wide' -->
			<div class="title-block">
				<?php if(get_sub_field('label')){?><div class="section-title"><?php the_sub_field('label'); ?></div><?php } ?>
				<?php if(get_sub_field('header')){ ?><h2>“<?php the_sub_field('header'); ?>”</h2><?php } ?>
				<?php the_sub_field('content'); ?>
			</div>
			<div class="listing owl-carousel">
				<?php while( have_rows('columns') ) : the_row(); ?>
					<div class="item">
						<?php if(get_sub_field('icon_color') == "Red"){ $color = 'red-bg'; }
							elseif(get_sub_field('icon_color') == "Green"){ $color = 'green-bg'; }
							elseif(get_sub_field('icon_color') == "Blue"){ $color = 'blue-bg'; }
						?>
						<div class="icon d-flex align-items-center justify-content-center <?php echo $color; ?>"> <!-- 'red-bg' 'green-bg' 'blue-bg' 'yellow-bg' -->
							<img src="<?php the_sub_field('icon'); ?>">
						</div>
						<h3><?php the_sub_field('heading'); ?></h3>
						<p><?php the_sub_field('content'); ?></p>
					</div>
				<?php endwhile; wp_reset_postdata(); ?>
			</div>
			<?php $btn = get_sub_field('button');
			if(!empty($btn['url'])){ ?>
				<div class="bottom-btn text-center">
	                <a href="<?php echo $btn['url']; ?>" class="common-btn"><?php echo $btn['title']; ?></a>
	            </div>
	        <?php } ?>
		</div>
	</div>
</section>

<?php endif; ?>