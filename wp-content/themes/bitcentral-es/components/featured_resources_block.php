<?php if( get_row_layout() == 'featured_resources_block' ): ?>

<section class="featured-resources-block">
	<div class="container">
		<div class="wrap m-auto">
			<?php while( have_rows('resources') ) : the_row();
				if(get_sub_field('image_position') == 'Left'){$position = 'img-left'; }
				elseif(get_sub_field('image_position') == 'Right'){$position = 'img-right'; }
				$resources = get_sub_field('resource');
				$image = wp_get_attachment_image_src( get_post_thumbnail_id($resources), 'full' );
			?>
				<div class="ct-row d-flex flex-wrap align-items-center <?php echo $position; ?>"> <!-- 'img-left' 'img-right' -->
					<div class="img-block">
						<a href="<?php the_permalink($resources); ?>">
							<div class="img bg-cover" style="background-image: url('<?php echo $image[0]; ?>');"></div>
						</a>
					</div>
					<div class="text-block">
						<div class="section-title asasdasd">
							<?php $postType   = get_post_type_object( get_post_type($resources) );
							$post_type = esc_html( $postType->labels->singular_name );
							echo $post_type; ?>
						</div>
						<h2><?php echo get_the_title($resources); ?></h2>
						<p><?php echo get_the_excerpt($resources); ?></p>
						<div class="read-more">
							<a href="<?php the_permalink($resources); ?>">
								<span class="lang-en"><?php the_sub_field('button_text'); ?> <?php echo svg_icon('arrow-right'); ?></span>
								
							</a>
						</div>
					</div>
				</div>
			<?php endwhile;
			wp_reset_postdata(); ?>
		</div>
	</div>
</section>

<?php endif; ?>