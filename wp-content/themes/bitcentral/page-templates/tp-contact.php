<?php 
/*
Template Name: contact
*/
get_header(); ?>

<section class="common-banner bg-cover" style="background: url('https://dev-bitcentral.pantheonsite.io/wp-content/uploads/2021/02/contact-banner.png');">
	<div class="container">
		<div class="inner d-flex flex-row-wrap">
			<div class="text-block white-text">
				<h1>Contact Us</h1>
				<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, do eius mod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad min im veniam, quis nostrud exercitati ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
			</div>
		</div>
	</div>
</section>

<section class="contact-form-block">
	<div class="container">
		<div class="wrap m-auto">
			<div class="row">
				<div class="col-lg-6">
					<div class="title-block">
						<div class="ct-row">
							<div class="section-title">Corporate Headquarters</div>
							<p>4340 Von Karman Ave. Suite 400 Newport Beach, CA 92660</p>
						</div>
						<div class="ct-row">
							<div class="section-title">Sales Inquiries</div>
							<p>+1.949.253.9000</p>
							<a href="mailto:sales@bitcentral.com">sales@bitcentral.com</a>
						</div>
						<div class="ct-row">
							<div class="section-title">Support</div>
							<p>Toll Free: 800.272.4004</p>
							<p>Local Support: +1.949.417.4199</p>
							<a href="mailto:support@bitcentral.com">support@bitcentral.com</a>
						</div>
					</div>
				</div>
				<div class="col-lg-6">
					<div class="form-block">
						<?php echo do_shortcode('[gravityform id="4" title="false" description="false" ajax="true" tabindex="49"]'); ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

<section class="contact-links-block">
	<div class="container">
		<div class="row">
			<div class="col-lg-6">
				<div class="img-block">
					<div class="inside-img">
						<div class="img bg-cover" style="background: url('https://dev-bitcentral.pantheonsite.io/wp-content/uploads/2021/02/careers-img.png');"></div>
					</div>
					<a href="#" class="common-green-btn">careers</a>
				</div>
			</div>
			<div class="col-lg-6">
				<div class="img-block">
					<div class="inside-img">
						<div class="img bg-cover" style="background: url('https://dev-bitcentral.pantheonsite.io/wp-content/uploads/2021/02/request-link-img.png');"></div>
					</div>
					<a href="#" class="common-btn">request a demo</a>
				</div>
			</div>
		</div>
	</div>
</section>

<?php get_footer(); ?>