<?php
/*
 * WP_HEAD GOODNESS
 * The default wordpress head is a mess. Let's clean it up by removing all the junk we don't need.
 */

function bitcentral_head_cleanup()
{
    // Category feeds
    // remove_action('wp_head', 'feed_links_extra', 3);
    // Post and comment feeds
    // remove_action('wp_head', 'feed_links', 2);
    // EditURI link
    remove_action('wp_head', 'rsd_link');
    // windows live writer
    remove_action('wp_head', 'wlwmanifest_link');
    // previous link
    remove_action('wp_head', 'parent_post_rel_link', 10);
    // start link
    remove_action('wp_head', 'start_post_rel_link', 10);
    // links for adjacent posts
    remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10);
    // WP version
    remove_action('wp_head', 'wp_generator');
    // remove WP version from css
    //add_filter( style_loader_src', 'bitcentral_remove_wp_ver_css_js', 9999);
    // remove Wp version from scripts
    //add_filter('script_loader_src', 'bitcentral_remove_wp_ver_css_js', 9999);
}

// Remove WP version from RSS
function bitcentral_rss_version() { return ''; }

// Remove WP version from scripts
function bitcentral_remove_wp_ver_css_js($src)
{
    if (strpos($src, 'ver=')) {
        $src = remove_query_arg('ver', $src);
    }

    return $src;
}

// Remove injected CSS for recent comments widget
function bitcentral_remove_wp_widget_recent_comments_style()
{
    if (has_filter('wp_head', 'wp_widget_recent_comments_style')) {
        remove_filter('wp_head', 'wp_widget_recent_comments_style');
    }
}

// Remove injected CSS from recent comments widget
function bitcentral_remove_recent_comments_style()
{
    global $wp_widget_factory;
    if (isset($wp_widget_factory->widgets['WP_Widget_Recent_Comments'])) {
        remove_action('wp_head', array(
            $wp_widget_factory->widgets['WP_Widget_Recent_Comments'],
            'recent_comments_style',
        ));
    }
}

// Remove injected CSS from gallery
function bitcentral_gallery_style($css)
{
    return preg_replace("!<style>(.*?)</style>!s", '', $css);
}

/*
 * Random cleanup items
 */

// Remove the p from around imgs (http://css-tricks.com/snippets/wordpress/remove-paragraph-tags-from-around-images/)
function bitcentral_filter_ptags_on_images($content){
    return preg_replace('/<p>\s*(<a .*>)?\s*(<img .* \/>)\s*(<\/a>)?\s*<\/p>/iU', '\1\2\3', $content);
}