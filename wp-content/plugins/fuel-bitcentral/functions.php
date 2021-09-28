<?php

add_action('init', 'fuel_bitcentral_register_cpt_fuel');

function fuel_bitcentral_register_cpt_fuel() {

    /**
     * Post Type: Fuel.
     */
    $labels = array(
        "name" => __("Fuel", "fuel-bitcentral"),
        "singular_name" => __("Fuel", "fuel-bitcentral"),
    );

    $args = array(
        "label" => __("Fuel", "fuel-bitcentral"),
        "labels" => $labels,
        "description" => "",
        "public" => true,
        "publicly_queryable" => true,
        "show_ui" => true,
        "delete_with_user" => false,
        "show_in_rest" => true,
        "rest_base" => "",
        "rest_controller_class" => "WP_REST_Posts_Controller",
        "has_archive" => false,
        "show_in_menu" => true,
        "show_in_nav_menus" => true,
        "exclude_from_search" => false,
        "capability_type" => "post",
        "map_meta_cap" => true,
        "hierarchical" => false,
        "rewrite" => array("slug" => "fuel", "with_front" => true),
        "query_var" => true,
        "supports" => array("title", "editor", "thumbnail", "revisions"),
    );

    register_post_type("fuel", $args);
}

add_action('admin_init', 'fuel_bitcentral_posttype_page_attributes');
function fuel_bitcentral_posttype_page_attributes(){
    add_post_type_support( 'fuel', 'page-attributes' );
}

function fuel_bitcentral_order_column($post_columns) {
    $post_columns['menu_order'] = "Order";
    return $post_columns;
}
add_action('manage_edit-fuel_columns', 'fuel_bitcentral_order_column');

function fuel_bitcentral_show_order_column($name){
    global $post;

    switch ($name) {
        case 'menu_order':
            $order = $post->menu_order;
            echo $order;
            break;
        default:
            break;
    }
}
add_action('manage_fuel_posts_custom_column','fuel_bitcentral_show_order_column');

function fuel_bitcentral_order_column_register_sortable($columns){
    $columns['menu_order'] = 'menu_order';
    return $columns;
}
add_filter('manage_edit-fuel_sortable_columns','fuel_bitcentral_order_column_register_sortable');

add_action('init', 'fuel_bitcentral_register_fuel_category');

function fuel_bitcentral_register_fuel_category() {

    /**
     * Taxonomy: Fuel Categories.
     */
    $labels = array(
        "name" => __("Fuel Categories", "fuel-bitcentral"),
        "singular_name" => __("Fuel Category", "fuel-bitcentral"),
    );

    $args = array(
        "label" => __("Fuel Categories", "fuel-bitcentral"),
        "labels" => $labels,
        "public" => true,
        "publicly_queryable" => true,
        "hierarchical" => true,
        "show_ui" => true,
        "show_in_menu" => true,
        "show_in_nav_menus" => true,
        "query_var" => true,
        "rewrite" => array('slug' => 'fuel_category', 'with_front' => true,),
        "show_admin_column" => true,
        "show_in_rest" => true,
        "rest_base" => "fuel_category",
        "rest_controller_class" => "WP_REST_Terms_Controller",
        "show_in_quick_edit" => false,
    );
    register_taxonomy("fuel_category", array("fuel"), $args);

    $labels_tags = array(
        'name' => _x('Fuel Tags', 'fuel-bitcentral'),
        'singular_name' => _x('Fuel Tag', 'fuel-bitcentral'),
        'search_items' => __('Search Fuel Tags', 'fuel-bitcentral'),
        'popular_items' => __('Popular Fuel Tags', 'fuel-bitcentral'),
        'all_items' => __('All Fuel Tags', 'fuel-bitcentral'),
        'parent_item' => null,
        'parent_item_colon' => null,
        'edit_item' => __('Edit Fuel Tag', 'fuel-bitcentral'),
        'update_item' => __('Update Fuel Tag', 'fuel-bitcentral'),
        'add_new_item' => __('Add New Fuel Tag', 'fuel-bitcentral'),
        'new_item_name' => __('New Fuel Tag Name', 'fuel-bitcentral'),
        'separate_items_with_commas' => __('Separate Fuel Tags with commas', 'fuel-bitcentral'),
        'add_or_remove_items' => __('Add or remove Fuel Tags', 'fuel-bitcentral'),
        'choose_from_most_used' => __('Choose from the most used Fuel Tags', 'fuel-bitcentral'),
        'not_found' => __('No Fuel Tags found.', 'fuel-bitcentral'),
        'menu_name' => __('Fuel Tags', 'fuel-bitcentral'),
    );

    $args_tags = array(
        'hierarchical' => false,
        'labels' => $labels_tags,
        'show_ui' => true,
        'show_admin_column' => true,
        'update_count_callback' => '_update_post_term_count',
        'query_var' => true,
        'rewrite' => array('slug' => 'fuel_tag', 'with_front' => true),
    );

    register_taxonomy('fuel_tag', array("fuel"), $args_tags);
}

add_filter('manage_fuel_posts_columns', 'fuel_bitcentral_set_custom_edit_book_columns');

function fuel_bitcentral_set_custom_edit_book_columns($columns) {
    $columns['fuel_shortcode'] = __('Shortcode For Single Video');
    return $columns;
}

add_action('manage_fuel_posts_custom_column', 'fuel_bitcentral_custom_book_column', 10, 2);

function fuel_bitcentral_custom_book_column($column, $post_id) {
    switch ($column) {
        case 'fuel_shortcode' :
            echo '[FUEL-SingleVideo id=' . $post_id . ']';
            break;
    }
}

add_filter('manage_edit-fuel_category_columns', 'fuel_bitcentral_taxonomy_columns');

function fuel_bitcentral_taxonomy_columns($columns) {
    $columns['fuel_cat_shortcode'] = __('Shortcode');
    $columns['fuel_cat_carousal_shortcode'] = __('Shortcode For Carousal');

    return $columns;
}

add_filter('manage_fuel_category_custom_column', 'fuel_bitcentral_taxonomy_columns_content', 10, 3);

function fuel_bitcentral_taxonomy_columns_content($content, $column_name, $term_id) {
    if ('fuel_cat_shortcode' == $column_name) {
        $get_term_slug = get_term_by('id', $term_id, 'fuel_category');
        $content = '[FUEL-TilesByCategory category="' . $get_term_slug->slug . '" max="4"]';
    }

    if ('fuel_cat_carousal_shortcode' == $column_name) {
        $get_term_slug = get_term_by('id', $term_id, 'fuel_category');
        $content = '[FUEL-CarouselTiles category="' . $get_term_slug->slug . '" max="4"]';
    }
    return $content;
}

add_filter('manage_edit-fuel_category_columns', function ($columns) {
    if (isset($columns['description'])) {
        unset($columns['description']);
        return $columns;
    }
});

add_filter('parse_query', 'fuel_bitcentral_convert_id_to_term_in_query');

function fuel_bitcentral_convert_id_to_term_in_query($query) {
    global $pagenow;
    $post_type = 'fuel';
    $taxonomy = 'fuel_category';
    $q_vars = &$query->query_vars;
    if ($pagenow == 'edit.php' && isset($q_vars['post_type']) && $q_vars['post_type'] == $post_type && isset($q_vars[$taxonomy]) && is_numeric($q_vars[$taxonomy]) && $q_vars[$taxonomy] != 0) {
        $term = get_term_by('id', $q_vars[$taxonomy], $taxonomy);
        $q_vars[$taxonomy] = $term->slug;
    }
}

if (function_exists('acf_add_local_field_group')):

    acf_add_local_field_group(array(
        'key' => 'group_5ddbde7a0ee86',
        'title' => 'Fuel Assets',
        'fields' => array(
            array(
                'key' => 'field_5ddbdf2935a91',
                'label' => 'Video Link',
                'name' => 'video_link',
                'type' => 'url',
                'instructions' => '',
                'required' => 1,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'default_value' => '',
                'placeholder' => '',
            ),
            array(
                'key' => 'field_5ddbdf3a35a92',
                'label' => 'Image For Tiles',
                'name' => 'image_for_tiles',
                'type' => 'image',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'return_format' => 'url',
                'preview_size' => 'full',
                'library' => 'all',
                'min_width' => '',
                'min_height' => '',
                'min_size' => '',
                'max_width' => '',
                'max_height' => '',
                'max_size' => '',
                'mime_types' => '',
            ),
            array(
                'key' => 'field_5ddbdf6535a93',
                'label' => 'Image For Player Thumbnail',
                'name' => 'image_for_player_thumbnail',
                'type' => 'image',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'return_format' => 'url',
                'preview_size' => 'full',
                'library' => 'all',
                'min_width' => '',
                'min_height' => '',
                'min_size' => '',
                'max_width' => '',
                'max_height' => '',
                'max_size' => '',
                'mime_types' => '',
            ),
            array(
                'key' => 'field_5ddbdfa13688b',
                'label' => 'Channel ID',
                'name' => 'channel_id',
                'type' => 'text',
                'instructions' => '',
                'required' => 1,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'default_value' => '',
                'placeholder' => '',
                'prepend' => '',
                'append' => '',
                'maxlength' => '',
            ),
            array(
                'key' => 'field_5ddc5c2610847',
                'label' => 'SWC ID',
                'name' => 'swc_id',
                'type' => 'text',
                'instructions' => '',
                'required' => 1,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'default_value' => '',
                'placeholder' => '',
                'prepend' => '',
                'append' => '',
                'maxlength' => '',
            ),
        ),
        'location' => array(
            array(
                array(
                    'param' => 'post_type',
                    'operator' => '==',
                    'value' => 'fuel',
                ),
            ),
        ),
        'menu_order' => 0,
        'position' => 'normal',
        'style' => 'default',
        'label_placement' => 'top',
        'instruction_placement' => 'label',
        'hide_on_screen' => '',
        'active' => true,
        'description' => '',
    ));

endif;

function fuel_bitcentral_get_fuel_postdata($fuel_post_id) {
    if ($fuel_post_id) {
        $url = get_the_permalink($fuel_post_id);
        $title = get_the_title($fuel_post_id);
        $featured_image = get_the_post_thumbnail_url($fuel_post_id, 'full');
        $video_link = get_field('video_link', $fuel_post_id, true);
        $image_for_player_thumbnail = get_field('image_for_player_thumbnail', $fuel_post_id, true);
        $image_for_tiles = get_field('image_for_tiles', $fuel_post_id, true);
        $channel_id = get_field('channel_id', $fuel_post_id);
        $swc_id = get_field('swc_id', $fuel_post_id);

        return (object) array(
                    'fuel_id' => $fuel_post_id,
                    'url' => $url,
                    'title' => $title,
                    'featured_image' => $featured_image,
                    'video_link' => $video_link,
                    'player_additional_image' => $image_for_player_thumbnail,
                    'tile_additional_image' => $image_for_tiles,
                    'tile_image' => $image_for_tiles ? $image_for_tiles : $featured_image,
                    'player_thunmbnail' => $image_for_player_thumbnail ? $image_for_player_thumbnail : $featured_image,
                    'channel_id' => $channel_id,
                    'swc_id' => $swc_id
        );
    } else {
        return array();
    }
}

function fuel_bitcentral_player_settings() {   
    $fuel_player_settings = (object) array(
                'autoplay' => get_option('fuel_player_autoplay_control') === 'on' ? true : false,
                'title_position' => get_option('fuel_player_title_position_option') ? get_option('fuel_player_title_position_option') : false,
                'tile_heading' => get_option('fuel_tiles_heading_option') === 'show_full' ? false : true,
                'category' => get_option('fuel_tiles_category_option') === 'off' ? false : true,
                'category_script' => get_option('fuel_tiles_script_category_option') && get_option('fuel_tiles_script_category_option') === 'on' ? 'on' : 'off',
                'tags' => get_option('fuel_player_tag_option') === 'on' ? true : false,
                'floating' => get_option('fuel_player_floating_option') === 'enable' ? true : false,
                'share' => get_option('fuel_player_share_option') === 'enable' ? true : false,
                'embed' => get_option('fuel_player_embed_option') === 'enable' ? true : false,
                'social_share' => get_option('fuel_player_social_option') === 'enable' ? true : false,
                'social_share_facebook' => get_option('fuel_player_enable_facebook') === '1' ? 'on' : 'off',
                'social_share_twitter' => get_option('fuel_player_enable_twitter') === '1' ? 'on' : 'off',
                'social_share_linkedin' => get_option('fuel_player_enable_linkedIn') === '1' ? 'on' : 'off',
                'social_share_email' => get_option('fuel_player_enable_email') === '1' ? 'on' : 'off',
    );
    return $fuel_player_settings;
}

if (!function_exists('fuel_m_explode')) {

    function fuel_m_explode(array $array, $key = '') {
        if (!is_array($array) or $key == '')
            return;
        $output = array();

        foreach ($array as $v) {
            if (!is_object($v)) {
                return;
            }
            $output[] = $v->$key;
        }

        return $output;
    }

}

if (!function_exists('array_key_first')) {

    function array_key_first(array $arr) {
        foreach ($arr as $key => $unused) {
            return $key;
        }
        return NULL;
    }

}

if (!function_exists('fuel_bitcentral_filter_fuelposts_by_taxonomy')) {
    add_action('restrict_manage_posts', 'fuel_bitcentral_filter_fuelposts_by_taxonomy');

    function fuel_bitcentral_filter_fuelposts_by_taxonomy() {
        global $typenow;
        $post_type = 'fuel';
        $taxonomy = 'fuel_category';
        if ($typenow == $post_type) {
            $selected = isset($_GET[$taxonomy]) ? esc_html($_GET[$taxonomy]) : '';
            $info_taxonomy = get_taxonomy($taxonomy);
            wp_dropdown_categories(array(
                'show_option_all' => __("Show All {$info_taxonomy->label}"),
                'taxonomy' => $taxonomy,
                'name' => $taxonomy,
                'orderby' => 'name',
                'selected' => $selected,
                'show_count' => true,
                'hide_empty' => true,
            ));
        };
    }

}