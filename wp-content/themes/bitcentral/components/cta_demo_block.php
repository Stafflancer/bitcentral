<?php if( get_row_layout() == 'cta_demo_block' ):
	$bg_image     = get_sub_field('image');
	$bg_image_url = $bg_image['sizes']['1536x1536']
	?>
<section class="cta-demo-block bg-cover parallax" style="background-image: url('<?php echo esc_url($bg_image_url); ?>');">
	<div class="container">
		<div class="wrap m-auto">
			<div class="text-block white-text">
				<div class="section-title"><?php the_sub_field('label'); ?></div>
				<h2><?php the_sub_field('heading'); ?></h2>
				<p><?php the_sub_field('content'); ?></p>
				<div class="bottom-btn d-flex flex-wrap align-items-center">
					<?php $btn = get_sub_field('button');
					if(!empty($btn['url'])){ ?>
						<a href="<?php echo $btn['url']; ?>" class="common-btn"><?php echo $btn['title']; ?></a>
					<?php } ?>
					<p><?php the_sub_field('phone'); ?></p>
				</div>
			</div>
		</div>
	</div>
</section>

<?php endif; ?>