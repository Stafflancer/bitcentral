<?php
add_action('wp_enqueue_scripts', 'fuel_bitcentral_enqueue_style');
add_action('wp_enqueue_scripts', 'fuel_bitcentral_enqueue_script');
add_filter('single_template', 'fuel_bitcentral_single_template');
add_filter('template_include', 'fuel_bitcentral_taxonomy_template');
add_filter('script_loader_tag', 'fuel_bitcentral_script_attributes', 10, 3);

function fuel_bitcentral_enqueue_style() {
    wp_enqueue_style('fuel-main', FUEL_BITCENTRAL_PLUGIN_ROOT_URL . 'assets/css/fuel.css');
    wp_enqueue_style('fuel-slick', FUEL_BITCENTRAL_PLUGIN_ROOT_URL . 'assets/css/slick.css');
    wp_enqueue_style('fuel-slick-theme', FUEL_BITCENTRAL_PLUGIN_ROOT_URL . 'assets/css/slick-theme.css');
    wp_enqueue_style('fuel-fontawesome', 'https://use.fontawesome.com/releases/v5.8.2/css/all.css', [], null);
}

function fuel_bitcentral_enqueue_script() {
    wp_enqueue_script('fuel-player-script', FUEL_BITCENTRAL_SCRIPT_URL, array(), strtotime(date("Y/m/d")));
    wp_enqueue_script('fuel-slick-script', FUEL_BITCENTRAL_PLUGIN_ROOT_URL . 'assets/js/slick.js', array(), false, true);
    wp_enqueue_script('fuel-bitcentral-script', FUEL_BITCENTRAL_PLUGIN_ROOT_URL . 'assets/js/fuel-bitcentral.js', array(), false, true);
    wp_localize_script('fuel-bitcentral-script', 'fuelajax', array('ajaxurl' => admin_url('admin-ajax.php')));
}

function fuel_bitcentral_single_template($template) {
    global $post;
    if ($post->post_type == "fuel" && $template !== locate_template(array("single-fuel.php"))) {
        return FUEL_BITCENTRAL_PLUGIN_ROOT_DIR . "template/single-fuel.php";
    }
    return $template;
}

function fuel_bitcentral_taxonomy_template($template) {
    if (is_tax('fuel_category')) {
        $template = FUEL_BITCENTRAL_PLUGIN_ROOT_DIR . "template/taxonomy-fuel_category.php";
    }
    if (is_tax('fuel_tag')) {
        $template = FUEL_BITCENTRAL_PLUGIN_ROOT_DIR . "template/taxonomy-fuel_tag.php";
    }
    return $template;
}

function fuel_bitcentral_script_attributes($tag, $handle, $src) {
    $async_scripts = array('fuel-player-script');
    if (in_array($handle, $async_scripts)) {
        return '<script type="text/javascript" id="fuel-player-script" src="' . $src . '"></script>' . "\n";
    }
    return $tag;
}