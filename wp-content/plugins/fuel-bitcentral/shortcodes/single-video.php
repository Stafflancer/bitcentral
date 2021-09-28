<?php

add_shortcode('FUEL-SingleVideo', 'fuel_bitcentral_single_story');

function fuel_bitcentral_single_story($data) {
    $content = '<div class="single-clip shortcode-video">';
    if (isset($data['id']) && (int) $data['id'] !== '') {
        $fuel_id = $data['id'];
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

        $content .= fuel_bitcentral_player_section($fuel_post_data, 'fuel-single-clip-shortcode-player', $shorcode_options);
    } else {
        $content .= '<h3 class="fuel-video-nofound">Video Not Found. Please check your shortcode.</h3>';
    }
    $content .= '</div>';
    return $content;
}
