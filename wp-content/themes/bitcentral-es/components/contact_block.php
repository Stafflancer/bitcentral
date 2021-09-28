<?php if( get_row_layout() == 'contact_block' ): ?>

<section class="contact-form-block">
	<div class="container">
		<div class="wrap m-auto">
			<div class="row">
				<div class="col-lg-6">
					<div class="title-block">
						<?php while( have_rows('corporate') ) : the_row(); ?>
							<div class="ct-row">
								<div class="section-title"><?php the_sub_field('title'); ?></div>
								<?php the_sub_field('content'); ?>
							</div>
						<?php endwhile; wp_reset_postdata(); ?>
						<?php while( have_rows('sales') ) : the_row(); ?>
							<div class="ct-row">
								<div class="section-title"><?php the_sub_field('title'); ?></div>
								<?php the_sub_field('content'); ?>
							</div>
						<?php endwhile; wp_reset_postdata(); ?>
						<?php while( have_rows('support') ) : the_row(); ?>
							<div class="ct-row">
								<div class="section-title"><?php the_sub_field('title'); ?></div>
								<?php the_sub_field('content'); ?>
							</div>
						<?php endwhile; wp_reset_postdata(); ?>
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