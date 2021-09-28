<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package bitcentral
 */
?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo('charset'); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<?php
	if (is_front_page()) {
		echo '<link rel="preload" href="' . get_home_url() . '/wp-content/uploads/2021/05/bitcentral-hero1.jpg" as="image">';
	}
	echo '<link rel="preload" href="' . get_home_url() . '/wp-includes/css/dashicons.min.css?ver='.get_bloginfo( 'version' ).'" as="style" onload="this.rel=\'stylesheet\'">';
	?>
	<?php wp_head(); ?>
	<script type='text/javascript' src='https://platform-api.sharethis.com/js/sharethis.js#property=60c033afff11bd00120fa05f&product=sop' async='async'></script>
</head>

<body <?php body_class(); ?>>
<?php if ( function_exists( 'gtm4wp_the_gtm_tag' ) ) { gtm4wp_the_gtm_tag(); } ?>
<?php wp_body_open(); ?>
<div id="page" class="site">
	<header id="masthead" class="site-header">
		<div class="top-row">
			<div class="container">
				<div class="text-right">
					<?php $btn = get_field('help_link','option');
					if(!empty($btn['url'])){ ?>
						<a href="<?php echo $btn['url']; ?>" target="<?php echo $btn['target']; ?>"><?php echo $btn['title']; ?></a>
					<?php } ?>
					<span>|</span>
					<a href="#">English</a>
				</div>
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
							<?php
							wp_nav_menu(
								[
									'theme_location' => 'menu-1',
									'menu_id'        => 'primary-menu',
								]
							);
							?>
						</nav><!-- #site-navigation -->
						<div class="search">
							<a href="javascript:void(0);"><i class="dashicons dashicons-search" style="font-size: 30px;"></i></a>
						</div>
						<?php $btn = get_field('request_demo_button','option');
						if(!empty($btn['url'])){ ?>
							<a href="<?php echo $btn['url']; ?>" class="request-btn"><?php echo $btn['title']; ?></a>
						<?php } ?>
					</div>
				</div>
				<div class="search-form-main">
					<form role="search" method="get" class="search-form" action="<?php echo home_url( '/' ); ?>">
						<input type="search" class="search-field"
							placeholder="<?php echo esc_attr_x( 'Search …', 'placeholder' ) ?>"
							value="<?php echo get_search_query() ?>" name="s"
							title="<?php echo esc_attr_x( 'Search for:', 'label' ) ?>" />
						<input type="submit" class="search-submit" value="<?php echo esc_attr_x( 'Search', 'submit button' ) ?>" />
					</form>
				</div>
			</div>
		</div>
	</header><!-- #masthead -->