<?php

add_shortcode('FUEL-SingleVideoPopup', 'fuel_bitcentral_single_story_popup');

function fuel_bitcentral_single_story_popup($data) {
    if (isset($data['id']) && (int) $data['id'] !== '') {
        $fuel_id = $data['id'];
        $fuel_post_data = fuel_bitcentral_get_fuel_postdata($fuel_id);
        if (isset($data['title'])) {
            if ($data['title'] != '') {
                $title = $data['title'];
            } else {
                $title = $fuel_post_data->title;
            }
        } else {
            $title = '';
        }
        $player_options = (object) array(
                    'autoplay' => 'on'
        );
        if (function_exists('fuel_bitcentral_preroll_addon_prepare')) {
            $player_options = fuel_bitcentral_preroll_addon_prepare($fuel_post_data, $player_options);
        }
        $fuel_player_html = fuel_bitcentral_player($fuel_post_data, 'fuel-single-popup-shortcode-player', $player_options);
        wp_add_inline_script('fuel-bitcentral-script', 'var fuelpopupvideo_' . $fuel_id . '="' . esc_html($fuel_player_html) . '";jQuery(".single-fuel-video-popup").click(function(){jQuery(".fuel-popup-container").show(),jQuery("#popup-video-' . $fuel_id . '").html(htmlDecode(fuelpopupvideo_' . $fuel_id . '))});', 'after');
        $content = '<div class="single-fuel-video-popup shortcode-video-popup" style="background: url(' . $fuel_post_data->player_thunmbnail . ') !important;">';
        $content .= '<span class="fuel-popup-play-btn"></span>';
        $content .= '<h3>' . $title . '</h3>';
        $content .= '</div>';
        $content .= '<div class="fuel-popup-container">';
        $content .= '<div class="fuel-popup-video" id="popup-video-' . $fuel_id . '"></div>';
        $content .= '<span class="fuel-overlaper"></span>';
        $content .= '</div>';
    } else {
        $content = '<h3 class="fuel-video-nofound">Video Not Found. Please check your shortcode.</h3>';
    }

    return $content;
}
