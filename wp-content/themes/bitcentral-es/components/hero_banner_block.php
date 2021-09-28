<?php if( get_row_layout() == 'hero_banner_block' ): ?>

<section class="common-banner bg-cover" style="background-image: url('<?php the_sub_field('image'); ?>');">
	<div class="container">
		<div class="inner d-flex flex-row-wrap">
			<div class="text-block white-text">
				<h1><?php the_sub_field('heading'); ?></h1>
				<p><?php the_sub_field('content'); ?></p>
			</div>
		</div>
	</div>
</section>

<?php endif; ?>