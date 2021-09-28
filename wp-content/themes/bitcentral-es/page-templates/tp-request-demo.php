<?php 
/*
Template Name: Request a demo
*/
get_header(); ?>

<section class="common-banner bg-cover" style="background: url('https://dev-bitcentral.pantheonsite.io/wp-content/uploads/2021/02/Request-banner-min.png');">
	<div class="container">
		<div class="inner d-flex flex-row-wrap">
			<div class="text-block white-text">
				<h1>Let’s Get Started</h1>
				<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, do eius mod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad min im veniam, quis nostrud exercitati ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
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
						<div class="section-title">request a demo</div>
						<h2>Bring efficiencies to <br>your media workflow.</h2>
						<p>Get in touch for a free, live demo today.</p>
					</div>
				</div>
				<div class="col-lg-6">
					<div class="form-block">
						<?php echo do_shortcode('[gravityform id="3" title="false" description="false" ajax="true" tabindex="49"]'); ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

<?php get_footer(); ?>