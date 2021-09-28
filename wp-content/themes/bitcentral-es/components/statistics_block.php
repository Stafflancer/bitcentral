<?php if( get_row_layout() == 'statistics_block' ): ?>

<section class="statistics-block">
	<div class="container" id="counter">
		<div class="wrap m-auto">
			<div class="ct-row d-flex flex-wrap align-items-center">
				<div class="title-block">
					<div class="section-title"><?php the_sub_field('label'); ?></div>
					<h2><?php the_sub_field('heading'); ?></h2>
					<p><?php the_sub_field('tagline'); ?></p>
				</div>
				<div class="listing d-flex">
					<?php $count = 0; while( have_rows('stats') ) : the_row(); ?>
						<div class="ct-col">
							<h3><?php the_sub_field('prefix'); ?> <div class="odometer odometer<?php echo $count; ?>" data-val ='<?php the_sub_field('number'); ?>'>00</div><span><?php the_sub_field('suffix'); ?></span></h3>
							<p><?php the_sub_field('description'); ?></p>
						</div>
					<?php $count++; endwhile; wp_reset_postdata(); ?>
				</div>
			</div>
		</div>
	</div>
	<script type="text/javascript">
		var a = 0;
        jQuery(window).scroll(function() {
        	var oTop = jQuery('#counter').offset().top - window.innerHeight;
            if (a == 0 && jQuery(window).scrollTop() > oTop) {
				var count = 0;
				jQuery('.listing .odometer').each(function() {
					var post_val = jQuery(this).attr("data-val");
			    	jQuery('.odometer'+count).html(post_val);
			    	count++;
			    });
			}
		});
	</script>
</section>

<?php endif; ?>