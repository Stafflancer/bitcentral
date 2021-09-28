<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package synergy
 */

$videos_cpt = get_post_type_object('product_video');
?>
<section class="common-banner single-news-banner">
	<div class="container">
		<div class="inner d-flex flex-row-wrap">
			<div class="text-block white-text">
				<div class="custom-breadcrumb d-flex flex-row-wrap align-items-center">
					<a href="/resources/">Resources</a>
					<div class="divider">/</div>
					<a href="<?php echo $videos_cpt->rewrite['slug']; ?>/"><?php echo $videos_cpt->label; ?></a>
				</div>
				<h1><?php the_title(); ?></h1>
			</div>
		</div>
	</div>
</section>

<section class="general-content-video-block">
	<div class="container">
		<div class="wrap m-auto">
			<div class="title-block">
				<div class="section-title"><?php the_title(); ?></div>
				<p><?php the_field('content'); ?></p>
			</div>
			<div class="content">
				<?php the_content(); ?>
				<?php
				$video_type = get_field('video_type');
                if (has_post_thumbnail()) {
                    $poster_url = get_the_post_thumbnail_url(get_the_ID(), 'large');
                }
				?>
                <?php
                if ('vimeo' == $video_type): ?>
					<iframe src="<?php the_field('vimeo_url'); ?>" frameborder="0"
					        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
					        allowfullscreen></iframe>
					<?php if (get_field('video_description')): ?>
	                <p class="mt-3"><?php the_field('video_description'); ?></p>
					<?php endif; ?>
                <?php endif; ?>

                <?php if ('html' == $video_type): ?>
					<video controls preload="metadata"<?php if($poster_url) echo " poster='$poster_url'"; ?>>
						<source src="<?php the_field('webm_video'); ?>" type="video/webm">
						<source src="<?php the_field('ogv_video'); ?>" type="video/ogv">
						<source src="<?php the_field('mp4_video'); ?>" type="video/mp4">
						Your browser does not support the video tag.
					</video>
                <?php endif; ?>

                <?php if ('fuel' == $video_type):
                    echo do_shortcode(get_field('fuel_shortcode'));
                endif; ?>
			</div>
		</div>
	</div>
</section>
<div class="post-nav">
	<div class="container">
		<div class="wrap m-auto d-flex align-items-center justify-content-between">
			<?php
				the_post_navigation([
                    'prev_text' => esc_html__( 'previous', 'bitcentral' ),
                    'next_text' => esc_html__( 'Next', 'bitcentral' ),
				]);
			?>
		</div>
	</div>
</div>

<?php if( have_rows('cta_event_block') ):
	while( have_rows('cta_event_block') ) : the_row();
?>
<section class="cta-event-block bg-cover parallax-img" style="background-image: url('<?php the_sub_field('background_image'); ?>');">
	<div class="container">
		<div class="wrap m-auto">
			<div class="text-block white-text white-text">
				<div class="section-title"><?php the_sub_field('label'); ?></div>
				<h2><?php the_sub_field('heading'); ?></h2>
				<?php the_sub_field('content'); ?>
				<?php $btn = get_sub_field('button');
				if(!empty($btn['url'])){ ?>
					<div class="bottom-btn">
						<a href="<?php echo $btn['title']; ?>" class="common-btn"><?php echo $btn['title']; ?></a>
					</div>
				<?php } ?>
			</div>
		</div>
	</div>
</section>
<?php
	endwhile;
endif; ?>

<section class="resources-listing">
	<div class="container">
		<div id="eventslist" class="group-main events-list">
			<div class="wrap m-auto">
				<div class="section-title">Related Videos</div>
			</div>
			<div class="grid-post">
				<div class="listing d-flex flex-wrap">
					<?php
						$product = [
							'post_type' => 'product_video',
							'post_status' => 'publish',
							'posts_per_page' => '4',
							'post__not_in' => [get_the_ID()]
						];
						$my_query  = new WP_Query( $product );
						while ( $my_query->have_posts() ) : $my_query->the_post();
						$image = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'full' );
					?>
						<div class="post-col">
							<a href="<?php the_permalink(); ?>">
								<div class="img bg-cover" style="background-image: url('<?php echo $image[0]; ?>');">
								</div>
								<div class="content">
									<h3><?php the_title(); ?></h3>
									<div class="read-more">Learn more<?php echo svg_icon('arrow-right'); ?></div>
								</div>
							</a>
						</div>
					<?php
						endwhile;
					wp_reset_postdata(); ?>
				</div>
			</div>
		</div>
	</div>
</section>