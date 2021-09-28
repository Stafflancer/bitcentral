<?php
/**
 * bitcentral functions and definitions
 *
 * @link    https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package bitcentral
 */

if (!defined('BITCENTRAL_VERSION')) {
	// Replace the version number of the theme on each release.
	define('BITCENTRAL_VERSION', '1.2.0');
}

/**
 * WordPress cleanup.
 */
require_once('inc/cleanup.php');

if (!function_exists('bitcentral_setup')) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function bitcentral_setup()
	{
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on bitcentral, use a find and replace
		 * to change 'bitcentral' to the name of your theme in all the template files.
		 */
		load_theme_textdomain('bitcentral', get_template_directory() . '/languages');

		// Operation cleanup
		add_action('init', 'bitcentral_head_cleanup');

		// Remove WP version from RSS
		add_filter('the_generator', 'bitcentral_rss_version');

		// Remove pesky injected css for recent comments widget
		add_filter('wp_head', 'bitcentral_remove_wp_widget_recent_comments_style', 1);

		// Clean up comment styles in the head
		add_action('wp_head', 'bitcentral_remove_recent_comments_style', 1);

		// Clean up gallery output in wp
//        add_filter('gallery_style', 'bitcentral_gallery_style');

		// Cleaning up random code around images
		add_filter('the_content', 'bitcentral_filter_ptags_on_images');

		// Add default posts and comments RSS feed links to head.
		add_theme_support('automatic-feed-links');

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support('title-tag');

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support('post-thumbnails');

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus(array(
			'menu-1' => esc_html__('Primary', 'bitcentral'),
		));
		
		register_nav_menus(array(
			'menu-2' => esc_html__('Resources Menu', 'bitcentral'),
		));
		
		register_nav_menus(array(
			'menu-3' => esc_html__('Top Menu', 'bitcentral'),
		));

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support('html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		));

		// Set up the WordPress core custom background feature.
		add_theme_support('custom-background', apply_filters('bitcentral_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		)));

		// Add theme support for selective refresh for widgets.
		add_theme_support('customize-selective-refresh-widgets');

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support('custom-logo', array(
			'width'       => 290,
			'height'      => 60,
			'flex-width'  => true,
			'flex-height' => true,
		));
	}
endif;
add_action('after_setup_theme', 'bitcentral_setup');

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function bitcentral_content_width()
{
	$GLOBALS['content_width'] = apply_filters('bitcentral_content_width', 640);
}

add_action('after_setup_theme', 'bitcentral_content_width', 0);

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function bitcentral_widgets_init()
{
	register_sidebar([
		'name'          => esc_html__('Sidebar', 'bitcentral'),
		'id'            => 'sidebar-1',
		'description'   => esc_html__('Add widgets here.', 'bitcentral'),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	]);

	register_sidebar([
		'name' => 'CTA footer',
		'id'   => 'cta_footer',
	]);

	register_sidebar([
		'name' => 'Taxonomy Hero Block',
		'id'   => 'taxonomy_hero_block',
	]);
}

add_action('widgets_init', 'bitcentral_widgets_init');

/**
 * Enqueue scripts and styles.
 */
function bitcentral_scripts()
{
	wp_enqueue_style('bitcentral-owl-css', get_template_directory_uri() . '/css/owl.carousel.min.css');
	wp_enqueue_style('bitcentral-subtleslideshow-css', get_template_directory_uri() . '/css/subtle-slideshow.css');
	wp_enqueue_style('bitcentral-bootstrap-css', get_template_directory_uri() . '/css/bootstrap.min.css');
	wp_enqueue_style('bitcentral-animate-css', get_template_directory_uri() . '/css/animate.min.css');
	wp_enqueue_style('bitcentral-odometer-css', get_template_directory_uri() . '/css/odometer.css');
	wp_enqueue_style('bitcentral-fonts', get_template_directory_uri() . '/css/fonts.css', [], BITCENTRAL_VERSION);
	wp_enqueue_style('bitcentral-style', get_stylesheet_uri(), [], BITCENTRAL_VERSION);
	wp_enqueue_style('bitcentral-responsive', get_template_directory_uri() . '/css/responsive.css');
	wp_style_add_data('bitcentral-style', 'rtl', 'replace');

	wp_enqueue_script('jquery');
//    wp_enqueue_script('bitcentral-navigation', get_template_directory_uri() . '/js/navigation.js', [], BITCENTRAL_VERSION, true);
//    wp_enqueue_script('bitcentral-smoothscroll', get_template_directory_uri() . '/js/jquery.smooth-scroll.js', ['jquery'], '2.2.0', true);
	wp_enqueue_script('bitcentral-wow', get_template_directory_uri() . '/js/wow.min.js', [], '0.1.12', true);
	wp_enqueue_script('bitcentral-owl-js', get_template_directory_uri() . '/js/owl.carousel.min.js', [], '2.2.0', true);
	wp_enqueue_script('bitcentral-subtleslideshow-js', get_template_directory_uri() . '/js/jquery.subtle-slideshow.js', [], '20151215', true);
	wp_enqueue_script('bitcentral-odometer', get_template_directory_uri() . '/js/odometer.min.js', [], '0.4.6', true);
	wp_enqueue_script('bitcentral-bootstrap-js', get_template_directory_uri() . '/js/bootstrap.min.js', [], '4.0.0', true);
	wp_enqueue_script('bitcentral-custom', get_template_directory_uri() . '/js/custom.js', [], BITCENTRAL_VERSION, true);

	if (is_singular() && comments_open() && get_option('thread_comments')) {
		wp_enqueue_script('comment-reply');
	}
}

add_action('wp_enqueue_scripts', 'bitcentral_scripts');

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if (defined('JETPACK__VERSION')) {
	require get_template_directory() . '/inc/jetpack.php';
}

/*=== create component function ====*/
/**
 * Get all the components in the [theme]/components/ directory.
 */
function get_components()
{
	$dir = get_template_directory() . '/components';
	foreach (array_filter(glob($dir . '/*.*'), 'is_file') as $file) {
		component($file);
	}
}

/**
 * Include template components and set up content data
 */
function component($file, $c = null)
{
	global $content_component;
	$content = $c;
	require $file;
}
/*====== end component code =======*/

/*====== enable php code on widget =======*/
function php_execute($html)
{
	if (strpos($html, "<" . "?php") !== false) {
		ob_start();
		eval("?" . ">" . $html);
		$html = ob_get_contents();
		ob_end_clean();
	}

	return $html;
}

add_filter('widget_text', 'php_execute', 100);

/*===== remove extra p tag from widget ======*/
remove_filter('widget_text_content', 'wpautop');

/*====== Footer option =======*/
if (function_exists('acf_add_options_page')) {
	acf_add_options_page([
		'page_title' => 'Theme General Settings',
		'menu_title' => 'Theme Settings',
		'menu_slug'  => 'theme-general-settings',
		'capability' => 'edit_posts',
		'redirect'   => true,
		'position'   => 2.1,
	]);

	acf_add_options_sub_page([
		'page_title'  => 'Header Settings',
		'menu_title'  => 'Header',
		'parent_slug' => 'theme-general-settings',
	]);

	acf_add_options_sub_page([
		'page_title'  => 'Footer Settings',
		'menu_title'  => 'Footer',
		'parent_slug' => 'theme-general-settings',
	]);
}

require_once('inc/ns_functions.php');

// ******************** Crunchify Tips - Clean up WordPress Header START ********************** //
function crunchify_remove_version()
{
	return '';
}

add_filter('the_generator', 'crunchify_remove_version');

remove_action('wp_head', 'wp_resource_hints', 2);
remove_action('wp_head', 'rest_output_link_wp_head', 10);
remove_action('wp_head', 'wp_oembed_add_discovery_links', 10);
remove_action('template_redirect', 'rest_output_link_header', 11);

remove_action('wp_head', 'rsd_link');
remove_action('wp_head', 'wlwmanifest_link');
remove_action('wp_head', 'wp_shortlink_wp_head');
remove_action('wp_head', 'print_emoji_detection_script', 7);
remove_action('wp_print_styles', 'print_emoji_styles');
// ******************** Clean up WordPress Header END ********************** //

//Remove JQuery migrate
/*
function dequeue_jquery_migrate( $scripts ) {
	if ( ! is_admin() && ! empty( $scripts->registered['jquery'] ) ) {
		$scripts->registered['jquery']->deps = array_diff( $scripts->registered['jquery']->deps, [ 'jquery-migrate' ] );
	}
}
add_action( 'wp_default_scripts', 'dequeue_jquery_migrate' );
*/

//Remove wp-embed.min.js
function my_deregister_scripts()
{
	wp_dequeue_script('wp-embed');
}

add_action('wp_footer', 'my_deregister_scripts');

// Enqueue scripts and styles
add_action('wp_enqueue_scripts', 'disable_loading_css_js', 9999);

function disable_loading_css_js()
{
	if (is_front_page() && !is_user_logged_in()) {
		wp_dequeue_script('search-filter-plugin-build');
		wp_dequeue_script('search-filter-plugin-chosen');
		wp_dequeue_script('jquery-ui-datepicker');
		wp_dequeue_script('fuel-player-script');

		wp_dequeue_style('bitcentral-animate-css');
		wp_dequeue_style('search-filter-plugin-styles');
		wp_dequeue_style('fuel-fontawesome');
	}
}

function my_output_buffer_callback($buffer, $phase){
	if(is_user_logged_in()) return $buffer;

	if ($phase & PHP_OUTPUT_HANDLER_FINAL || $phase & PHP_OUTPUT_HANDLER_END) {
		// Here you can manipulate the $buffer
		$lazy_load_script = '<script>var script_loaded=!1;function loadJSscripts(){if(!script_loaded){script_loaded=!0;var t=document.getElementsByTagName("script");for(i=0;i<t.length;i++)if(null!==t[i].getAttribute("data-src")){var e=document.createElement("script");e.src=t[i].getAttribute("data-src"),document.body.appendChild(e)}document.dispatchEvent(new CustomEvent("StartAsyncLoading"));}}window.addEventListener("scroll",function(t){setTimeout(function(){loadJSscripts()},500);}),window.addEventListener("mousemove",function(){setTimeout(function(){loadJSscripts()},500);}),window.addEventListener("touchstart",function(){setTimeout(function(){loadJSscripts()},500);}),window.addEventListener?window.addEventListener("load",function(){setTimeout(loadJSscripts,4e3)},!1):window.attachEvent?window.attachEvent("onload",function(){setTimeout(loadJSscripts,4e3)}):window.onload=loadJSscripts;</script>';

		$buffer = str_replace('</body>', $lazy_load_script."\n</body>", $buffer);
		$buffer = str_replace('window.lazySizesConfig.loadMode=1;', 'window.lazySizesConfig.loadMode=1;window.lazySizesConfig.expand=10;', $buffer);

		if (is_front_page()) {
			$buffer = str_replace('bitcentral-hero2.jpg', 'bitcentral-hero1.jpg', $buffer);
		}

		return $buffer;
	}

	return $buffer;
}

ob_start('my_output_buffer_callback');

add_filter( 'autoptimize_filter_imgopt_lazyload_placeholder', function ( $in ) {
	$my_own_placeholder = 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAQAAAC1HAwCAAAAC0lEQVR42mNkqAcAAIUAgUW0RjgAAAAASUVORK5CYII=';

	return $my_own_placeholder;
} );

add_filter('autoptimize_filter_html_before_minify', function ( $buffer ) {
	$buffer =  str_replace('bg-cover" style="background:', 'bg-cover" style="background-image:', $buffer);
	$buffer =  str_replace('bg-cover parallax" style="background:', 'bg-cover parallax" style="background-image:', $buffer);
	$buffer =  str_replace('bg-cover parallax-img" style="background:', 'bg-cover parallax-img" style="background-image:', $buffer);

	return $buffer;
});


