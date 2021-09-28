<?php
/**
 * Template Name: Drive LandingPage
 *
 * @package WordPress
 * @subpackage main theme
 * @since main theme
 */
?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo('charset'); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<?php wp_head(); ?>
	<style>
		body {
		    padding-bottom: 0px !important;
		}
		#st-2 { display: none !important; }
		.site-header .request-btn {
		    background: #DAA900;
		    border-color: #DAA900;
		    padding: 10px 50px;
		}/*
		.site-header .request-btn:before {
		    content: '';
		    background: #DAA900;
		    height: 51px;
		}*/
		.site-header .request-btn:hover  {
		    background: #00538B;
		    border-color: #00538B;
		}
		.site-header .request-btn:hover:before, .dlp_ex_btn a:hover:before, .skdl_reg_btn a:hover:before, .speaker_reg_btn a:hover:before, .contact_reg_btn:hover:before { display: none; }
		.dlp_excpt {
		    margin: 0 0 10px 0 !important;
		    padding: 0;
		}
		.section-title.dlp_excpt:before, .site-header.fixed .top-row { display: none; }
		.container {
		    max-width: 1650px;
		}
		.general-content-block {
		    padding: 100px 0;
		}
		.site-header.fixed .request-btn {
		    padding: 7px 50px 5px 50px;
		    top: 0px;
		}
		h1.slider_title {
			font-size: 120px !important;
			letter-spacing: 0px;
			color: #FFFFFF;
		}
		h1.slider_title span {
			color: #DAA900;
		}
		.dlp_sub_title {
		    font-size: 45px;
		    color: #fff;
		    font-weight: bold;
		    display: block;
		    padding: 15px 0;
		}
		.dlp_p_txt {
		    font-size: 25px;
		    color: #fff;
		    display: block;
		    padding: 15px 0;
		}
		.dlp_da_btn {
		    margin-top: 25px;
		}
		.dlp_da_btn a {
			background: #DAA900;
		}
		.dlp_da_btn a:hover {
			background: #00538B;
		}
		.dlp_ex_btn .common-btn:before {
			display: none !important;
		}
		.dlp_ex_btn a:hover, .skdl_reg_btn a:hover, .speaker_reg_btn a:hover, .contact_reg_btn:hover {
			background: #00538B;
		}
		.bulbs_list {
		    margin-left: 75px !important;
		}
		.day_sub_title {
			color: #00538B;
			font-size: 25px;
			font-weight: bold;
		}
		.att_main_row1 {
		    border-right: 1px solid #707070;
		    padding: 0 0 100px 50px;
		    margin: 0 !important;
		}
		.att_main_row2 {
		    padding: 0 0 0 70px;
		    margin: 0 !important;
		}
		.meet_team h2 {
		    padding: 0 50px;
		}
		.speakers_col {
		    padding: 0 75px;
		}
		.speaker_reg_btn {
		    position: relative;
		    bottom: 115px;
		}
		.team-listing-block .wrap {
		    margin: 0 !important;
		}
		.team-listing-block {
			padding: 100px 0 0 0;
		}
		.scdl_item {
			margin-top: 75px;
		}
		.sdl_time {
			font-size: 18px;
			font-weight: bold;
			color: #00538B;
		}
		.sdl_txt h3 {
			font-size: 25px;
		}
		.user_inf {
		    margin: 30px 0;
		    font-size: 16px;
		    color: #505050;
		}
		.user_inf img {
			border-radius: 50%;
		}
		.user_inf .txta_speak {
		    padding: 25px 55px 0 0;
		}
		.sdl_txt p {
			font-weight: medium;
			font-size: 18px;
			color: #505050;
		}
		.sdl_txt {
		    padding: 0 75px 0 0;
		}
		.skdl_reg_btn {
		    position: relative;
		    bottom: 30px;
		}
		body:after {
		    content: '';
		    top: 170px;
		    height: calc(100% - 170px);
		}
		body:before {
		    content: '';
		    top: 255px;
		    height: calc(100% - 255px);
		}
		#attend {
		    padding-top: 100px;
		    padding-bottom: 0px;
		}
		@media screen and (max-width: 1650px) and (min-width: 1400px) {
			.site-header .request-btn:before {
			    height: 48px;
			}
		}
		@media screen and (max-width: 1550px) {
			.site-header .request-btn:before {
			    height: 51px;
			}
			.site-header .request-btn {
			    padding: 12px 25px;
			}
			.user_inf .txta_speak {
			    padding: 10px 55px 0 0;
			}
		}
		@media screen and (max-width: 1199px) {
			.site-header .request-btn:before, .site-header.fixed .request-btn:before {
			    height: 32px;
			}
			.site-header .request-btn {
			    padding: 5px 25px;
			}
			.site-header .top-row { display: none; }
			#mega-menu-wrap-menu-1 .mega-menu-toggle {
			    position: relative;
			    top: 0px;
			}
			.site-header .request-btn, .site-header.fixed .request-btn {
			    top: 0px;
			}
			.user_inf .txta_speak {
			    padding: 00px 55px 0 0;
			}
		}
		@media screen and (max-width: 990px) {
			.dlp_excpt {
			    margin: 20px 0 10px 0 !important;
			    padding: 0;
			}
			.bulbs_list {
			    margin-left: 0px !important;
			}
			.meet_team h2 {
			    padding: 0 0px;
			}
			.speakers_col {
			    padding: 0 0px;
			}
			.att_main_row1 {
    			border-right: 0px solid #707070;
    			border-bottom: 1px solid #707070;
    		}
    		.skdl_reg_btn {
			    bottom: -30px;
			}
			.speaker_reg_btn {
			    bottom: 35px;
			}
			#attend {
			    padding-top: 30px;
			}
			.scdl_item {
			    margin-top: 10px;
			}
			.sdl_txt {
			    padding: 0 60px 0 15px;
			}
			.att_main_row1 {
			    padding: 0 0 20px 50px;
			}
			.att_main_row2 {
			    padding: 30px 0 0 50px;
			}
		}
		@media screen and (max-width: 820px) {
			h1.slider_title {
			    font-size: 80px !important;
			}
			.dlp_sub_title {
			    font-size: 34px;
			    padding: 5px 0;
			}
			.dlp_p_txt {
			    font-size: 22px;
			    padding: 10px 0;
			}
		}
		@media screen and (max-width: 560px) {
			h1.slider_title {
			    font-size: 42px !important;
			}
			.dlp_sub_title {
			    font-size: 28px;
			    padding: 5px 0;
			    line-height: 30px;
			}
			.dlp_p_txt {
			    font-size: 20px;
			    padding: 10px 0;
			}
			.speaker_reg_btn {
			    bottom: 0px;
			    padding: 35px 0;
			}
		}
		@media screen and (max-width: 385px) {
			.dlp_p_txt span {
				display: none;
			}
		}
	</style>
</head>

<body <?php body_class(); ?>>
<?php if ( function_exists( 'gtm4wp_the_gtm_tag' ) ) { gtm4wp_the_gtm_tag(); } ?>
<?php wp_body_open(); ?>
<div id="page" class="site">
	<header id="masthead" class="site-header">
		<div class="top-row" style="background: transparent; padding-top: 39px;">
			<div class="container">
			</div>
		</div>
		<div class="main-head">
			<div class="container">
				<div class="inner">
					<div class="site-branding">
						<div class="main-logo">
							<a href="<?php echo get_site_url(); ?>">
								<img src="<?php echo get_stylesheet_directory_uri(); ?>/images/logo.svg" alt="Logo Main" width="222" height="46">
							</a>
						</div>
						<div class="white-logo">
							<a href="<?php echo get_site_url(); ?>">
								<img src="<?php echo get_stylesheet_directory_uri(); ?>/images/logo-white.svg" alt="Logo White" width="270" height="56">
							</a>
						</div>
					</div><!-- .site-branding -->
					<div class="right-block d-flex justify-content-end align-items-center">
						<nav id="site-navigation" class="main-navigation">
							<div class="nav-toggle"><i></i></div>
							<div id="mega-menu-wrap-menu-1" class="mega-menu-wrap">
								<div class="mega-menu-toggle">
									<div class="mega-toggle-blocks-left"></div>
									<div class="mega-toggle-blocks-center"></div>
									<div class="mega-toggle-blocks-right">
										<div class="mega-toggle-block mega-menu-toggle-animated-block mega-toggle-block-1" id="mega-toggle-block-1">
											<button aria-label="Toggle Menu" class="mega-toggle-animated mega-toggle-animated-slider" type="button" aria-expanded="false"><span class="mega-toggle-animated-box"><span class="mega-toggle-animated-inner"></span></span></button>
										</div>
									</div>
								</div>
								<ul id="mega-menu-menu-1" class="mega-menu max-mega-menu mega-menu-horizontal" data-event="hover" data-effect="fade_up" data-effect-speed="200" data-effect-mobile="slide" data-effect-speed-mobile="200" data-mobile-force-width="false" data-second-click="go" data-document-click="collapse" data-vertical-behaviour="accordion" data-breakpoint="1199" data-unbind="true" data-mobile-state="collapse_all" data-hover-intent-timeout="300" data-hover-intent-interval="100" style="">
									<?php
										if( have_rows('dlp_head_menu') ) {
										    while( have_rows('dlp_head_menu') ) {
										    	the_row();
												echo '<li class="mega-menu-item mega-menu-item-type-post_type mega-menu-item-object-page mega-align-bottom-left mega-menu-flyout mega-menu-item-28" id="mega-menu-item-28">
														<a class="mega-menu-link" href="' . get_sub_field('link') . '" tabindex="0">' . get_sub_field('label') . '</a>
													</li>';
										    }
										}
									?>
								</ul>
							</div>
						</nav>
						<?php if(get_field('dlp_color_button_label')) { ?>
							<a href="<?php echo get_field('dlp_color_button_url'); ?>" class="request-btn"><?php echo get_field('dlp_color_button_label'); ?></a>
						<?php } ?>
					</div>
				</div>
			</div>
		</div>
		<div class="top-row" style="background: transparent; padding-top: 39px;">
			<div class="container">
			</div>
		</div>
	</header><!-- #masthead -->

<section class="common-banner bg-cover" style="background-image: url('<?php echo get_field('dlp_bg'); ?>');">
    <div class="container">
        <div class="inner" style="padding: 0 0 0 0px;">
            <div class="text-block white-text text-center" style="max-width: 100%;">
            	<?php
            		echo '<h1 class="slider_title">' . get_field("dlp_title") . '</h1>';
            		echo '<span class="dlp_sub_title">' . get_field("dlp_sub_title") . '</span>';
            		echo '<span class="dlp_p_txt">' . get_field("dlp_text_slide_#1") . ' <span>|</span> ' . get_field("dlp_text_slide_#2") . '</span>';
            		echo '<div class="bottom-btn text-center dlp_da_btn">
			                <a href="' . get_field("dlp_slider_button_url") . '" class="common-btn">' . get_field("dlp_slider_button_label") . '</a>
			            </div>';
            	?>
            </div>
        </div>
    </div>
</section>

<section class="general-content-block" style="padding-bottom: 50px;">
    <div class="container">
		<div class="row">
			<div class="col-lg-6 text-left m-auto">
                <?php
                	$dlps_img = get_field("dlp_ex_img");
                	if ($dlps_img) {
                		echo '<img src="' . $dlps_img . '" />';
                	}
                ?>
            </div>
            <div class="col-lg-6 text-left m-auto">
                <div class="text-block">
                	<div class="section-title dlp_excpt"><?php echo get_field('dlp_ex_pre_title'); ?></div>
                    <h2><?php echo get_field('dlp_ex_title'); ?></h2>
                    <p><?php echo get_field('dlp_ex_desc_text'); ?></p>
                    <?php
	                    echo '<div class="bottom-btn text-left dlp_ex_btn">
				                <a href="' . get_field("dlp_ex_button_url") . '" class="common-btn">' . get_field("dlp_ex_button_label") . '</a>
				            </div>';
                    ?>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="columns-icons-block" id="attend">
	<div class="container">
		<div class="section-title" style="margin: 0 0 0 0;"><?php echo get_field('dlp_attnd_pre_title'); ?></div>
		<div class="wrap m-auto wide">
			<div class="listing owl-carousel bulbs_list">
				<?php
					if( have_rows('dlp_attnd_items') ) {
					    while( have_rows('dlp_attnd_items') ) {
					    	the_row();
					    	echo '<div class="item">
									<div class="icon d-flex align-items-center justify-content-center blue-bg">
										<img src="' . get_sub_field('icon') . '">
									</div>
									<h3>' . get_sub_field('title') . '</h3>
									<p>' . get_sub_field('descr') . '</p>
								</div>';
					    }
					}
				?>
			</div>
	    </div>
	</div>
</section>

<section class="statistics-block" id="ahenda" style="padding: 100px 0 0 0;">
	<div class="container">
		<div class="section-title" style="padding-bottom: 45px;"><?php echo get_field('dlp_agenda_pre_title'); ?></div>
		<div class="row">
			<div class="col-lg-6 text-left m-auto att_main_row1">
				<?php
				$group_var = get_field('dlp_agenda_group');

				echo '<h2>' . $group_var['dlp_agenda_lt_title'] . '</h2>';
				echo '<span class="day_sub_title">' . $group_var['dlp_agenda_lt_sub_title'] . '</span>';

				if( have_rows('dlp_agenda_group') ) {
					while ( have_rows('dlp_agenda_group') ) {
						the_row();
						if( have_rows('events_rep_1') ) {
						    while( have_rows('events_rep_1') ) {
						    	the_row();
						    	echo '<div class="row scdl_item">
										<div class="col-lg-3 sdl_time">' . get_sub_field('time') . '</div>
										<div class="col-lg-9 sdl_txt">
											<h3>' . get_sub_field('title') . '</h3>
											<div class="row user_inf">
												<div class="col-3"><img src="' . get_sub_field('foto') . '" /></div>
												<div class="col-9 txta_speak">' . get_sub_field('name') . '</div>
											</div>
											<p>' . get_sub_field('descr') . '</p>
										</div>
									</div>';
						    }
						}
					}
				}
				?>
			</div>
			<div class="col-lg-6 text-left m-auto att_main_row2">
				<?php
				$group_var = get_field('dlp_agenda_group');

				echo '<h2>' . $group_var['dlp_agenda_rt_title'] . '</h2>';
				echo '<span class="day_sub_title">' . $group_var['dlp_agenda_rt_sub_title'] . '</span>';

				if( have_rows('dlp_agenda_group') ) {
					while ( have_rows('dlp_agenda_group') ) {
						the_row();
						if( have_rows('events_rep_2') ) {
						    while( have_rows('events_rep_2') ) {
						    	the_row();
						    	echo '<div class="row scdl_item">
										<div class="col-lg-3 sdl_time">' . get_sub_field('time') . '</div>
										<div class="col-lg-9 sdl_txt">
											<h3>' . get_sub_field('title') . '</h3>
											<div class="row user_inf">
												<div class="col-3"><img src="' . get_sub_field('foto') . '" /></div>
												<div class="col-9 txta_speak">' . get_sub_field('name') . '</div>
											</div>
											<p>' . get_sub_field('descr') . '</p>
										</div>
									</div>';
						    }
						}
					}
				}
				?>
			</div>
		</div>
		<div class="row skdl_reg_btn">
			<div class="col-lg-10 text-center m-auto">
				<a href="<?php echo get_field('dlp_speak_button_url'); ?>" class="common-btn"><?php echo get_field('dlp_speak_button_label'); ?></a>
            </div>
        </div>
	</div>
</section>

<section class="team-listing-block" id="speakers">
	<div class="container">
		<div class="wrap m-auto">
			<div class="title-block meet_team">
				<div class="section-title" style="padding-bottom: 45px;"><?php echo get_field('dlp_speak_pre_title'); ?></div>
				<h2><?php echo get_field('dlp_speak_title'); ?></h2>
			</div>
		</div>
		
		<div class="listing m-auto d-flex flex-row-wrap four-col speakers_col">
			<div class="inner d-flex flex-row-wrap justify-content-center">
				<?php
					if( have_rows('dlp_speak_speakers') ):
					    while ( have_rows('dlp_speak_speakers') ) : the_row();

					        if( get_row_layout() == 'speaker' ):
					        	$url_spk = get_sub_field('link') ? get_sub_field('link') : 'javascript:void(0);';
					        	echo '<div class="team-col">
										<a href="' . $url_spk . '" data-toggle="modal" data-target="#memberModal-0">
											<div class="profile bg-cover" style="background-image: url(' . get_sub_field('photo') . ');"></div>
											<div class="content">
												<h3>' . get_sub_field('name') . '</h3>
												<p>' . get_sub_field('descr') . '</p>
											</div>
										</a>
									</div>';
					        endif;

					    endwhile;
					endif;
				?>
			</div>
		</div>

		<div class="row speaker_reg_btn">
			<div class="col-lg-10 text-center m-auto">
				<a href="<?php echo get_field('dlp_speak_button_url'); ?>" class="common-btn"><?php echo get_field('dlp_speak_button_label'); ?></a>
            </div>
        </div>
	</div>
</section>

<!--
<section class="general-content-block">
	<div class="container">
		<div class="row">
			<div class="col-lg-10 text-center m-auto">
				<div class="text-block">
					<h2>Questions? Want to learn more?</h2>
					<p>Contact us today and we’ll get back to you shortly.</p>
					<a href="<?php echo get_field('dlp_footer_btn_url'); ?>" class="common-btn"><?php echo get_field('dlp_footer_btn_label'); ?></a>
                </div>
            </div>
        </div>
    </div>
</section>
-->

<section class="cta-demo-block bg-cover parallax lazyloaded" data-bg="<?php echo get_field('dlp_footer_bg'); ?>" style="background-image: url(&quot;<?php echo get_field('dlp_footer_bg'); ?>&quot;);" id="contacts">
	<div class="container">
		<div class="wrap m-auto">
			<div class="text-block white-text text-center">
				<h2><?php echo get_field('dlp_footer_title'); ?></h2>
				<p style="margin-bottom: 40px;"><?php echo get_field('dlp_footer_descr'); ?></p>
				<a href="<?php echo get_field('dlp_footer_btn_url'); ?>" class="common-btn contact_reg_btn"><?php echo get_field('dlp_footer_btn_label'); ?></a>
			</div>
		</div>
	</div>
</section>

	<footer id="colophon" class="site-footer">
		<div class="bottom-row">
			<div class="container">
				<div class="inside d-flex flex-wrap align-items-center justify-content-between">
					<div class="logo">
						<a href="<?php echo get_site_url(); ?>">
							<img src="<?php echo get_stylesheet_directory_uri(); ?>/images/logo-white.svg" alt="Logo White" width="270" height="56">
						</a>
					</div>
					<div class="social-list">
						<?php
						while( have_rows('social_media','option') ) : the_row(); ?>
							<ul class="d-flex flex-wrap align-items-center justify-content-center">
								<?php if(get_sub_field('linekdin')){?><li><a href="<?php the_sub_field('linekdin'); ?>" target="_blank"><?php echo svg_icon('linkedin'); ?></a></li><?php } ?>
								<?php if(get_sub_field('twitter')){?><li><a href="<?php the_sub_field('twitter'); ?>" target="_blank"><?php echo svg_icon('twitter'); ?></a></li><?php } ?>
								<?php if(get_sub_field('facebook')){?><li><a href="<?php the_sub_field('facebook'); ?>" target="_blank"><?php echo svg_icon('facebook'); ?></a></li><?php } ?>
							</ul>
						<?php
						endwhile;
						wp_reset_postdata(); ?>
					</div>
					<div class="copyright">©<?php echo date('Y'); ?> Bitcentral, Inc. All Rights Reserved.</div>
				</div>
			</div>
		</div>
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php
$classes = get_body_class();
if (in_array('page-fuel', $classes)) {
	?>
	<script>
		// Menu anchorlink click function
		jQuery( '.mega-sub-menu .mega-menu-item .menu-link-group .menu-col ul li a' ).on( 'click', function ( event ) {
			var headerheight = jQuery( '.site-header' ).height();
			if ( this.hash !== '' ) {
				event.preventDefault();
				var hash = this.hash;
				jQuery( 'html, body' ).animate( {
					scrollTop: jQuery( hash ).offset().top - headerheight
				}, 0 );
			}
		} );
	</script>
<?php } ?>
<?php wp_footer(); ?>
<?php get_template_part( 'template-parts/svg-icons', 'defs' ); ?>

	<script>
		document.querySelectorAll('a[href^="#"]').forEach(anchor => {
		    anchor.addEventListener('click', function (e) {
		        e.preventDefault();

		        document.querySelector(this.getAttribute('href')).scrollIntoView({
		            behavior: 'smooth'
		        });
		        jQuery('.mega-toggle-animated-slider').trigger('click');
		    });
		});
	</script>

</body>
</html>

<?php