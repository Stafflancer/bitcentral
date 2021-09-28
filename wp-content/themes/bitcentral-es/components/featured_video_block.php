<?php if (get_row_layout() == 'featured_video_block'): ?>

	<section class="featured-video-block">
		<div class="container">
			<div class="wrap m-auto">
				<div class="title-block">
					<div class="section-title"><?php the_sub_field('label'); ?></div>
					<h2><?php the_sub_field('heading'); ?></h2>
                    <?php the_sub_field('content'); ?>
				</div>
                <?php
                $page_id    = get_sub_field('video');
                $image      = wp_get_attachment_image_src(get_post_thumbnail_id($page_id), 'full');
                $video_type = get_field('video_type', $page_id);
                ?>
				<div class="video">
                    <?php
                    if ($video_type == 'vimeo'): ?>
						<iframe src="<?php the_field('vimeo_url', $page_id); ?>" frameborder="0"
						        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
						        allowfullscreen></iframe>
                    <?php endif; ?>

                    <?php if ($video_type == 'html'): ?>
						<video controls poster="<?php echo $image[0]; ?>">
							<source src="<?php the_field('webm_video', $page_id); ?>" type="video/webm">
							<source src="<?php the_field('ogv_video', $page_id); ?>" type="video/ogv">
							<source src="<?php the_field('mp4_video', $page_id); ?>" type="video/mp4">
							Your browser does not support the video tag.
						</video>
                    <?php endif; ?>

                    <?php if ($video_type == 'fuel'):
                        echo do_shortcode(get_field('fuel_shortcode', $page_id));
                    endif; ?>
				</div>
			</div>
		</div>
	</section>

<?php endif; ?>