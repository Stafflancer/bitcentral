<?php

add_shortcode('FUEL-Channel', 'fuel_bitcentral_single_channel');

function fuel_bitcentral_single_channel($data) {
    $content = '<div class="single-channel shortcode-video">';
    if (isset($data['id']) && $data['id'] !== '' && isset($data['image']) && !empty($data['image'])) {
        $channel_id = $data['id'];
        $image_url = $data['image'];
        $autoplay_check = isset($data['autoplay']) && $data['autoplay'] != '' ? $data['autoplay'] : '';
        $embed_check = isset($data['embed']) && $data['embed'] != '' ? $data['embed'] : '';
        $share_check = isset($data['share']) && $data['share'] != '' ? $data['share'] : '';

        if (isset($data['title'])) {
            if ($data['title'] != '') {
                $title = $data['title'];
            } else {
                $title = '';
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

        $player_options = (object) array(
                    'url' => $_SERVER['REQUEST_URI'],
                    'title' => $title,
                    'featured_image' => '',
                    'video_link' => '',
                    'player_additional_image' => $image_url,
                    'tile_additional_image' => '',
                    'tile_image' => '',
                    'channel_id' => $channel_id,
                    'swc_id' => ''
        );


        $content .= fuel_bitcentral_player_section($player_options, 'fuel-single-channel-shortcode-player', $shorcode_options);
    } else {
        $content .= '<h3 class="fuel-video-nofound">Video Not Found. Please check your shortcode.</h3>';
    }
    $content .= '</div>';
    return $content;
}
