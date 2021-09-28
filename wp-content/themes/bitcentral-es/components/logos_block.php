<?php if( get_row_layout() == 'logos_block' ): ?>

<section class="logos-block">
	<div class="container">
		<div class="wrap m-auto">
			<div class="title-block">
				<div class="section-title"><?php the_sub_field('label'); ?></div>
				<h2><?php the_sub_field('header'); ?></h2>
			</div>
		</div>
		<div class="listing owl-carousel m-auto">
			<?php while( have_rows('logos') ) : the_row(); ?>
				<div class="item">
					<img src="<?php the_sub_field('logo'); ?>" alt="Company Logo" width="200" height="150">
				</div>
			<?php endwhile; wp_reset_postdata(); ?>
		</div>
	</div>
</section>

<?php endif; ?>