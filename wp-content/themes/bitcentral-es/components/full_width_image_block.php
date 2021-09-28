<?php if (get_row_layout() == 'full_width_image_block'): ?>

	<section class="full-image-block">
		<div class="container">
			<?php $paralax = get_sub_field('add_parallax') ? ' parallax-img' : ''; ?>
			<div class="wrap m-auto text-center bg-cover<?php echo $paralax; ?>" style="background-image: url('<?php the_sub_field('image'); ?>');">
				<img src="<?php the_sub_field('image'); ?>" alt="">
			</div>
		</div>
	</section>

<?php endif; ?>