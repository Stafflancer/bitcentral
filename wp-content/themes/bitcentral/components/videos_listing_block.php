<?php if( get_row_layout() == 'videos_listing_block' ):
    $brochure_cpt = get_post_type_object('brochure');
    $case_study_cpt = get_post_type_object('case_study');
    $white_paper_cpt = get_post_type_object('white_paper');
    $product_video_cpt = get_post_type_object('product_video');
    ?>

<section class="resources-listing">
	<div class="sticky-link-group">
		<ul class="d-flex flex-row-wrap align-items-center justify-content-center">
			<li><a href="/resources/" class="scroll">Featured Resources</a></li>
			<li><a href="<?php echo $brochure_cpt->rewrite['slug']; ?>/" class="scroll"><?php echo $brochure_cpt->label; ?></a></li>
			<li><a href="<?php echo $case_study_cpt->rewrite['slug']; ?>/" class="scroll"><?php echo $case_study_cpt->label; ?></a></li>
			<li><a href="<?php echo $white_paper_cpt->rewrite['slug']; ?>/" class="scroll"><?php echo $white_paper_cpt->label; ?></a></li>
			<li><a href="<?php echo $product_video_cpt->rewrite['slug']; ?>/" class="scroll active"><?php echo $product_video_cpt->label; ?></a></li>
		</ul>
	</div>

	<div class="container">
		<div id="video-list" class="group-main video-list">
			<div class="grid-post">
				<div class="listing d-flex flex-wrap">
					<?php
					$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
					$product_video = array( 'post_type' => 'product_video', 'post_status' => 'publish', 'posts_per_page' => '12','paged' => $paged );
					$my_query  = new WP_Query( $product_video );
					while ( $my_query->have_posts() ) : $my_query->the_post();
					$image = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'full' );
					?>
						<div class="post-col">
							<a href="<?php the_permalink(); ?>">
								<div class="img bg-cover" style="background-image: url('<?php echo $image[0]; ?>');"></div>
								<div class="content">
									<div class="section-title">Product Video</div>
									<h3><?php the_title(); ?></h3>
									<p><?php the_excerpt(); ?></p>
									<div class="read-more">Learn more<?php echo svg_icon('arrow-right'); ?></div>
								</div>
							</a>
						</div>
					<?php endwhile;
					wp_reset_postdata(); ?>
				</div>
				<div class="pagination">
					<?php wp_pagenavi( array( 'query' => $my_query ) ); ?>
				</div>
			</div>
		</div>
	</div>
</section>

<?php endif; ?>