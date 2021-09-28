<?php if( get_row_layout() == 'white_paper_listing_block' ):
    $brochure_cpt = get_post_type_object('brochure');
    $case_study_cpt = get_post_type_object('case_study');
    $white_paper_cpt = get_post_type_object('white_paper');
    $product_video_cpt = get_post_type_object('product_video');
    ?>

<section class="resources-listing">
	<div class="sticky-link-group">
		<ul class="d-flex flex-row-wrap align-items-center justify-content-center hide-static">
			<li><a href="/resources/" class="scroll">Featured Resources</a></li>
			<li><a href="<?php echo $brochure_cpt->rewrite['slug']; ?>/" class="scroll"><?php echo $brochure_cpt->label; ?></a></li>
			<li><a href="<?php echo $case_study_cpt->rewrite['slug']; ?>/" class="scroll"><?php echo $case_study_cpt->label; ?></a></li>
			<li><a href="<?php echo $white_paper_cpt->rewrite['slug']; ?>/" class="scroll active"><?php echo $white_paper_cpt->label; ?></a></li>
			<li><a href="<?php echo $product_video_cpt->rewrite['slug']; ?>/" class="scroll"><?php echo $product_video_cpt->label; ?></a></li>
		</ul>
		<?php
			wp_nav_menu(
				[
					'theme_location' => 'menu-2',
					'menu_id'        => 'resources-menu',
					'menu_class' => 'd-flex flex-row-wrap align-items-center justify-content-center'
				]
			);
		?>
	</div>

	<div class="container">
		<div id="white-paper-list" class="group-main white-paper-list">
			<div class="grid-post">
				<div class="listing d-flex flex-wrap">
					<?php
					$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
					$white_paper = ['post_type' => 'white_paper', 'post_status' => 'publish', 'posts_per_page' => '12','paged' => $paged];
					$my_query  = new WP_Query( $white_paper );
					while ( $my_query->have_posts() ) : $my_query->the_post();
					$image = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'full' );
					?>
						<div class="post-col">
							<a href="<?php the_permalink(); ?>">
								<div class="img bg-cover" style="background-image: url('<?php echo $image[0]; ?>');"></div>
								<div class="content">
									<div class="section-title"><?php echo get_sub_field('box_top_title'); ?></div>
									<h3><?php the_title(); ?></h3>
									<div class="read-more"><?php echo get_sub_field('learn_button_text'); ?><?php echo svg_icon('arrow-right'); ?></div>
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