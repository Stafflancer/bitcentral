<?php if( get_row_layout() == 'subpage_cards_with_color_dot_block' ): ?>

<section class="subpage-cards-color-dot-block">
	<div class="container">
		<div class="wrap m-auto">
			<div class="title-block">
				<div class="section-title"><?php the_sub_field('heading'); ?></div>
	    		<p><?php the_sub_field('content'); ?></p>
	    	</div>
		</div>
		<div class="bottom-wrap m-auto">
			<div class="listing d-flex flex-wrap">
				<?php while( have_rows('cards') ) : the_row();
					if(get_sub_field('dot_color') == 'Green'){$color = 'green-dot';}
					elseif(get_sub_field('dot_color') == 'Red'){$color = 'red-dot';}
					elseif(get_sub_field('dot_color') == 'Blue'){$color = 'blue-dot';}
					elseif(get_sub_field('dot_color') == 'Yellow'){$color = 'yellow-dot';}
					$sub_page = get_sub_field('page_url');
					$image = wp_get_attachment_image_src( get_post_thumbnail_id( $sub_page ), 'full' );
				?>
					<div class="card-col <?php echo $color; ?>">
						<a href="<?php the_permalink($sub_page); ?>">
							<div class="img">
								<div class="bg-img bg-cover" style="background-image: url('<?php echo $image[0]; ?>');"></div>
							</div>
							<div class="text-block">
								<h3><?php the_sub_field('heading'); ?></h3>
								<?php the_sub_field('content'); ?>
								<div class="learn-more"><?php the_sub_field('button_text'); ?><?php echo svg_icon('arrow-right'); ?></div>
							</div>
						</a>
					</div>
				<?php endwhile; wp_reset_postdata(); ?>
			</div>
		</div>
	</div>
</section>

<?php endif; ?>