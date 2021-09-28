<?php
/*
Plugin Name: Bitcentral
Description: Bitcentral's custom functions, hooks and filters.
Plugin URI: https://bitcentral.com
Author: Bitcentral, Inc.
Author URI: https://bitcentral.com
Version: 0.2
License: GPL2

This is a private plugin for the use of Bitcentral.com and its affiliates.
*/

// Custom Shortcodes
//require_once('shortcodes.php');

// Resources
require_once('resources.php');

// Allow upload of ogv videos
function bitcentral_myme_types($mime_types)
{
    $mime_types['ogv'] = 'video/ogg'; //Adding ogv extension
    $mime_types['ogg'] = 'audio/ogg'; //Adding ogv extension

    return $mime_types;
}

add_filter('upload_mimes', 'bitcentral_myme_types');

function bc_valid_video_extentions($valid_extensions)
{
    //$extensions = $valid_extensions;
    $valid_extensions[] = 'ogv';
    $valid_extensions[] = 'webm';

    return $valid_extensions;
}

add_filter('toolset_valid_video_extentions', 'bc_valid_video_extentions', 10, 1);

function bitcentral_plugin_css()
{
    global $post;

    if (get_post_type() == 'product') {
        //wp_enqueue_style('slick_css',plugins_url( '/css/slick.css', __FILE__ ),array(),"0.201");
    } else {
        if ($post->post_name == 'support-service') {
            wp_enqueue_style('slick_css', plugins_url('/css/slick-testimonials.css', __FILE__), array(), "0.152");
        } else {
            if ($post->post_name == 'resources' || $post->post_name == 'news-events') {
                wp_enqueue_style('slick_css', plugins_url('/css/slick-posts.css', __FILE__), array(), "0.136");
            }
        }
    }
}

add_action('wp_enqueue_scripts', 'bitcentral_plugin_css', 15);

function bitcentral_fancybox()
{
    wp_enqueue_style('fancybox_css', plugins_url('/css/jquery.fancybox.min.css', __FILE__));
    wp_enqueue_script('fancybox_js', plugins_url('/js/jquery.fancybox.min.js', __FILE__), array(), false, true);
}

add_action('wp_enqueue_scripts', 'bitcentral_fancybox', 11);

function bitcentral_admin_css()
{
    wp_enqueue_style('bitcentral-admin-css', plugins_url('/css/admin.css', __FILE__), array(), "0.19");
}

add_action('admin_enqueue_scripts', 'bitcentral_admin_css', 15);

function bitcentral_add_editor_styles()
{
    add_editor_style(plugins_url('/css/admin.css?ver=1', __FILE__));
}

add_action('admin_init', 'bitcentral_add_editor_styles');

add_action("location_edit_form", function ($tag, $taxonomy) {
    ?>
    <style>
	    .term-description-wrap {
            display: none;
        }
    </style><?php
}, 10, 2);

function bc_excerpt($excerpt)
{
    $limit    = 300;
    $end      = '...';
    $limit    = $limit - mb_strlen($end); // Take into account $end string into the limit
    $valuelen = mb_strlen($excerpt);

    return $limit < $valuelen ? mb_substr($excerpt, 0, mb_strrpos($excerpt, ' ', $limit - $valuelen)) . $end : $excerpt;
}

add_filter('get_the_excerpt', 'bc_excerpt');

// Admin Location
function dropdown_meta_box_callback($post, $box)
{
    $defaults = ['taxonomy' => 'category'];
    //$taxonomy = "location";
    if (!isset($box['args']) || !is_array($box['args'])) {
        $args = [];
    } else {
        $args = $box['args'];
    }
    extract(wp_parse_args($args, $defaults), EXTR_SKIP);
    $tax = get_taxonomy($taxonomy);
    ?>

    <div id="taxonomy-<?php echo $taxonomy; ?>" class="categorydiv">
        <?php
        $name = ($taxonomy == 'category') ? 'post_category' : 'tax_input[' . $taxonomy . ']';

        echo "<input type='hidden' name='{$name}[]' value='0' />"; // Allows for an empty term set to be sent. 0 is an invalid Term ID and will be ignored by empty() checks.

        $term_obj = wp_get_object_terms($post->ID, "$taxonomy"); //_log($term_obj[0]->term_id)

        if (is_array($term_obj)) {
            wp_dropdown_categories([
                'taxonomy'         => $taxonomy,
                'hide_empty'       => 0,
                'name'             => "{$name}[]",
                'selected'         => $term_obj[0]->slug,
                'orderby'          => 'name',
                'hierarchical'     => 0,
                'show_option_none' => '&mdash;',
                'class'            => 'widefat',
                'value_field'      => 'slug',
            ]);
        }
        ?>
    </div>
    <?php
}

// Yoast admin
add_filter('wpseo_metabox_prio', function () {
    return 'low';
});

function bitcentral_admin_menu()
{
    $post_types = [
        'post',
        'page',
        'product',
        'solution',
        'resource',
    ];
    foreach ($post_types as $type) {
        remove_submenu_page('edit.php?post_type=' . $type, 'edit-tags.php?taxonomy=search-post&amp;post_type=' . $type);
    }

}

add_action('admin_menu', 'bitcentral_admin_menu');