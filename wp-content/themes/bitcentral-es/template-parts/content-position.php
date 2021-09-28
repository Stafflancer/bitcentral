<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package synergy
 */

$image = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), 'full' );
if($image[0]){
	$image = $image[0];
} else{
	$image = "/wp-content/uploads/2021/02/single-careers-banner-min.png";
}
?>

<section class="common-banner single-careers-banner bg-cover" style="background-image: url('<?php echo $image; ?>');">
	<div class="container">
		<div class="inner d-flex flex-row-wrap">
			<div class="text-block white-text">
				<div class="custom-breadcrumb d-flex flex-row-wrap align-items-center">
					<a href="/careers/">Careers</a>
					<div class="divider">/</div>
					<span>Job Opening</span>
				</div>
			</div>
		</div>
	</div>
</section>

<section class="single-careers-main">
	<div class="container">
		<div class="text-group m-auto">
			<div class="content">
				<h3><?php the_title(); ?></h3>
				<?php if(get_field('location')){ ?>
					<div class="ct-row">
						<div class="title">LOCATION</div>
						<p><?php the_field('location'); ?></p>
					</div>
				<?php } ?>
				<?php if(get_field('seniority_level')){ ?>
					<div class="ct-row">
						<div class="title">SENIORITY LEVEL</div>
						<p><?php the_field('seniority_level'); ?></p>
					</div>
				<?php } ?>
				<?php if(get_field('industry')){ ?>
					<div class="ct-row">
						<div class="title">INDUSTRY</div>
						<p><?php the_field('industry'); ?></p>
					</div>
				<?php } ?>
				<?php if(get_field('employment_type')){ ?>
					<div class="ct-row">
						<div class="title">EMPLOYMENT TYPE</div>
						<p><?php the_field('employment_type'); ?></p>
					</div>
				<?php } ?>
				<?php if(get_field('department')){ ?>
					<div class="ct-row">
						<div class="title">DEPARTMENT</div>
						<p><?php the_field('department'); ?></p>
					</div>
				<?php } ?>
			</div>
		</div>
		<?php if(get_field('job_functions')){ ?>
			<div class="text-group m-auto">
				<div class="section-title">JOB FUNCTIONS</div>
				<div class="content">
					<?php the_field('job_functions'); ?>
				</div>
			</div>
		<?php } ?>
		<?php if(get_field('essential_duties_&_responsibilities')){ ?>
			<div class="text-group m-auto">
				<div class="section-title">ESSENTIAL DUTIES & RESPONSIBILITIES:</div>
				<div class="content">
					<?php the_field('essential_duties_&_responsibilities'); ?>
				</div>
			</div>
		<?php } ?>
			<div class="text-group m-auto">
				<?php if(get_field('required_experience_&_qualifications')){ ?>
					<div class="section-title">REQUIRED EXPERIENCE & QUALIFICATIONS</div>
					<div class="content">
						<?php the_field('required_experience_&_qualifications'); ?>
					</div>
				<?php }?>
				<div class="content">
					<?php the_field('footnotes'); ?>
					<a href="mailto:jobs@bitcentral.com" target="_blank" class="common-btn">Apply for this position</a>
				</div>
			</div>
	</div>
</section>