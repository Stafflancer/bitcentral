<?php

add_shortcode('FUEL-SingleVideoByCategory', 'fuel_bitcentral_single_clip_by_category');

function fuel_bitcentral_single_clip_by_category($data) {
    $content = '<div class="single-clip-category shortcode-video">';
    if (isset($data['category']) && !empty($data['category'])) {
        $cat_name = $data['category'];
        $args = array(
            'post_type' => 'fuel',
            'posts_per_page' => 1,
            'tax_query' => array(
                array(
                    'taxonomy' => 'fuel_category',
                    'field' => 'slug',
                    'terms' => $cat_name
                ),
            ),
        );

        $query_fuel_video = get_posts($args);

        if ($query_fuel_video) {
            $fuel_id = $query_fuel_video[0]->ID;
            $fuel_post_data = fuel_bitcentral_get_fuel_postdata($fuel_id);
            $autoplay_check = isset($data['autoplay']) && $data['autoplay'] != '' ? $data['autoplay'] : '';
            $embed_check = isset($data['embed']) && $data['embed'] != '' ? $data['embed'] : '';
            $share_check = isset($data['share']) && $data['share'] != '' ? $data['share'] : '';

            if (isset($data['title'])) {
                if ($data['title'] != '') {
                    $title = $data['title'];
                } else {
                    $title = $fuel_post_data->title;
                }
            } else {
                $title = '';
            }
            $shorcode_options = (object) array(
                        'title' => $title,
                        'autoplay' => $autoplay_check,
                        'embed' => $embed_check,
                        'share' => $share_check
            );

            if (function_exists('fuel_bitcentral_preroll_addon_prepare')) {
                $shorcode_options = fuel_bitcentral_preroll_addon_prepare($data, $shorcode_options);
            }

            $content .= fuel_bitcentral_player_section($fuel_post_data, 'fuel-single-clip-category-shortcode-player', $shorcode_options);
        } else {
            $content .= '<h3 class="fuel-video-nofound">Video Not Found.</h3>';
        }
    } else {
        $content .= '<h3 class="fuel-video-nofound">Video Not Found. Please check your shortcode.</h3>';
    }
    $content .= '</div>';
    return $content;
}
