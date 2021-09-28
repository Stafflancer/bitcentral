<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package synergy
 */
$image = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), 'full' );
$white_paper_cpt = get_post_type_object('white_paper');
?>
<section class="common-banner bg-cover blue-overlay" style="background-image: url('<?php echo $image[0]; ?>');">
	<div class="container">
		<div class="inner d-flex flex-row-wrap">
			<div class="text-block white-text">
				<div class="custom-breadcrumb d-flex flex-row-wrap align-items-center">
					<a href="/resources/">Resources</a>
					<div class="divider">/</div>
					<a href="<?php echo $white_paper_cpt->rewrite['slug']; ?>/"><?php echo $white_paper_cpt->label; ?></a>
				</div>
				<h1><?php the_title(); ?></h1>
			</div>
		</div>
	</div>
</section>

<section class="request-demo-block">
	<div class="container">
		<div class="wrap m-auto">
			<div class="row">
				<div class="col-lg-6">
					<div class="title-block">
						<div class="section-title">Download</div>
						<h2><?php the_title(); ?></h2>
						<?php the_content(); ?>
					</div>
				</div>
				<div class="col-lg-6">
					<div class="form-block">
						<?php echo do_shortcode('[gravityform id="10" title="false" description="false" ajax="false" tabindex="49"]'); ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

<section class="related-two-col">
	<div class="container">
		<div class="two-col d-flex flex-row-wrap">
			<?php $related_case_study = get_field('related_case_study');
			if(!empty($related_case_study)){ ?>
				<div class="group-main">
					<div class="wrap m-auto">
						<div class="section-title">Related Case Studies</div>
					</div>
					<div class="grid-post">
						<div class="listing d-flex flex-wrap">
							<?php
							foreach( $related_case_study as $p):
								$related_case_study_list = get_post($p);
								$image = wp_get_attachment_image_src( get_post_thumbnail_id( $p ), 'full' );
							?>
								<div class="post-col">
									<a href="<?php the_permalink($p); ?>">
										<div class="img bg-cover" style="background-image: url('<?php echo $image[0]; ?>');"></div>
										<div class="content">
											<div class="section-title">
											<?php
												$postType  = get_post_type_object( get_post_type($p) );
												$post_type = esc_html( $postType->labels->singular_name );
												echo $post_type;
											?>
											</div>
											<h3><?php echo $related_case_study_list->post_title; ?></h3>
											<div class="read-more">Learn more<?php echo svg_icon('arrow-right'); ?></div>
										</div>
									</a>
								</div>
							<?php
							endforeach;
							wp_reset_postdata(); ?>
						</div>
					</div>
				</div>
			<?php } ?>
			<?php $related_white_paper = get_field('related_white_paper');
				if(!empty($related_white_paper)){
			?>
				<div class="group-main">
					<div class="wrap m-auto">
						<div class="section-title">Related White Papers and E-books</div>
					</div>
					<div class="grid-post">
						<div class="listing d-flex flex-wrap">
							<?php
							foreach( $related_white_paper as $p):
								$related_white_paper_list = get_post($p);
								$image = wp_get_attachment_image_src( get_post_thumbnail_id( $p ), 'full' );
							?>
								<div class="post-col">
									<a href="<?php the_permalink($p); ?>">
										<div class="img bg-cover" style="background-image: url('<?php echo $image[0]; ?>');"></div>
										<div class="content">
											<div class="section-title">
											<?php
												$postType  = get_post_type_object( get_post_type($p) );
												$post_type = esc_html( $postType->labels->singular_name );
												echo $post_type;
											?>
											</div>
											<h3><?php echo $related_white_paper_list->post_title; ?></h3>
											<div class="read-more">Learn more<?php echo svg_icon('arrow-right'); ?></div>
										</div>
									</a>
								</div>
							<?php
							endforeach;
							wp_reset_postdata(); ?>
						</div>
					</div>
				</div>
			<?php } ?>
		</div>
	</div>
</section>