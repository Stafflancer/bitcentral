<?php if( get_row_layout() == 'media_object_rows_block' ): ?>

<section class="media-object-rows-block">
    <div class="container">
        <div class="wrap m-auto">
        	<?php while( have_rows('content_rows') ) : the_row();
        		if(get_sub_field('image_position')== 'Left'){$position = 'img-left'; }
        		elseif(get_sub_field('image_position')== 'Right'){$position = 'img-right'; }
        	?>
	            <div class="ct-row d-flex flex-row-wrap align-items-center <?php echo $position; ?>"> <!-- 'img-left' 'img-right' -->
	                <div class="img wow zoomIn" data-wow-delay="0.35s">
	                    <img src="<?php the_sub_field('image'); ?>" alt="">
	                </div>
	                <div class="text-block wow fadeIn" data-wow-delay="0.20s">
	                    <h3><?php the_sub_field('heading'); ?></h3>
	                    <p><?php the_sub_field('content'); ?></p>
	                </div>
	            </div>
	        <?php endwhile; wp_reset_postdata(); ?>
        </div>
    </div>
</section>

<?php endif; ?>