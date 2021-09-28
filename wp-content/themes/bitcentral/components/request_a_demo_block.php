<?php if( get_row_layout() == 'request_a_demo_block' ): ?>

<section class="request-demo-block">
	<div class="container">
		<div class="wrap m-auto">
			<div class="row">
				<div class="col-lg-6">
					<div class="title-block">
						<div class="section-title"><?php the_sub_field('label'); ?></div>
						<h2><?php the_sub_field('heading'); ?></h2>
						<p><?php the_sub_field('content'); ?></p>
					</div>
				</div>
				<div class="col-lg-6">
					<div class="form-block">
						<?php echo do_shortcode('[gravityform id="'.get_sub_field('form').'" title="false" description="false" ajax="false" tabindex="49"]'); ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

<?php endif; ?>