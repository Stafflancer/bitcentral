<?php if( get_row_layout() == 'testimonials_carousel_block' ):
	if(get_sub_field('image_position')=='Left'){$position = 'style1';}
	elseif(get_sub_field('image_position')=='Right'){$position = 'style2';}
?>
<section class="testimonials-carousel-block <?php echo $position; ?>">
	<div class="container">
		<div class="wrap m-auto">
			<div class="title-block">
				<div class="section-title"><?php the_sub_field('label'); ?></div>
				<h2><?php the_sub_field('heading'); ?></h2>
				<?php the_sub_field('content'); ?>
				<div class="common-link-style">
					<?php $btn = get_sub_field('button');
					if(!empty($btn['url'])){ ?>
						<a href="<?php echo $btn['url']; ?>">
							<?php echo $btn['title']; ?><?php echo svg_icon('arrow-right'); ?>
						</a>
					<?php } ?>
				</div>
			</div>
		</div>
		<div class="bottom-row m-auto d-flex flex-wrap">
			<div class="bottom-img">
				<div class="img bg-cover parallax-img" style="background-image: url('<?php the_sub_field('image'); ?>');"></div>
			</div>
			<div class="ts-slider white-text owl-carousel">
				<?php
				$testimonials = get_sub_field('testimonials');
				foreach( $testimonials as $p):
					$testimonials_list = get_post($p);
				?>
				<div class="item">
					<p>“<?php echo $testimonials_list->post_content; ?></p>
					<div class="name"><?php echo $testimonials_list->post_title; ?></div>
				</div>
				<?php endforeach; wp_reset_postdata(); ?>
			</div>
		</div>
	</div>
</section>

<?php endif; ?>