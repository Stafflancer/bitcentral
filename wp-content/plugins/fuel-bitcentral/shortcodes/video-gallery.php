<?php

add_shortcode('FUEL-VideoGallery', 'fuel_bitcentral_video_gallery');

function fuel_bitcentral_video_gallery($data) {
//      ob_start();
    $content = '<div class="fuel-bitcentral-gallery">';
    if (isset($data['category']) && isset($data['max']) && !empty($data['category']) && !empty($data['max'])) {
        $cat_name = $data['category'];
        $no_of_tiles = $data['max'];
        $heading = isset($data['heading']) ? $data['heading'] : '';
        $fuel_gallery_tiles = fuel_bitcentral_tiles_ul_gallery_array($cat_name, $no_of_tiles);

        if ($fuel_gallery_tiles) {
            if ($heading) {
                $content .= '<div class="fuel-title"><h1 class="fuel-title-heading">' . $heading . '</h1></div>';
            }
            if ($fuel_gallery_tiles['main_tile']) {
                $fuel_gallery_id = array_key_first($fuel_gallery_tiles['main_tile']);
                $fuel_main_player_data = $fuel_gallery_tiles['main_tile'][$fuel_gallery_id];

                $shorcode_options = (object) array(
                            'autoplay' => 'off'
                );

                if (function_exists('fuel_bitcentral_preroll_addon_prepare')) {
                    $shorcode_options = fuel_bitcentral_preroll_addon_prepare($data, $shorcode_options);
                }

                $fuel_player_html = fuel_bitcentral_player($fuel_main_player_data, 'fuel-single-gallery-shortcode-player', $shorcode_options);
                $content .= '<div class="fuel-gallery-player-container">';
                $content .= '<div class="fuel-gallery-player-loader"><img class="fuel-gallery-player-loader-image" width="640" height="360" alt="" src="' . FUEL_BITCENTRAL_PLUGIN_ROOT_URL . '/assets/css/ajax-loader.gif"></div>';
                $content .= '<div class="fuel-gallery-player-main">' . $fuel_player_html . '</div>';

                $content .= '<div class="fuel-gallery-player-caption">';
                $content .= '<h2>';
                $content .= '<div class="fuel-gallery-player-icon">';
                $content .= '<img src="' . FUEL_BITCENTRAL_PLUGIN_ROOT_URL . '/assets/images/play-button.png" alt="Play">';
                $content .= '</div>';
                $content .= '<div class="fuel-gallery-player-title">' . $fuel_main_player_data->title . '</div>';
                $content .= '</h2>';
                $content .= '</div>';

                $content .= '</div>';
            }


            if ($fuel_gallery_tiles['child_tiles']) {
                $content .= '<div class="fuel-gallery-tiles">';
                $content .= '<ul class="fuel-related-tiles-ul">';
                foreach ($fuel_gallery_tiles['child_tiles'] as $fuel_post_id => $fuel_gallery_tile) {
                    $content .= '<li data-tile="' . $fuel_post_id . '">';
                    $content .= '<a class="fuel-related-tile-image fuel-gallery-tlies-anchor" href="javascript:void(0);">';
                    $content .= '<img width="640" height="360" alt="" src="' . $fuel_gallery_tile->tile_image . '"><i class="fas fa-play"></i>';
                    $content .= '</a>';
                    $content .= '<div class="fuel-related-info">';
                    $content .= '<h3 class="fuel-title" title="' . $fuel_gallery_tile->title . '">' . $fuel_gallery_tile->title . '</h3>';
                    $content .= apply_filters('the_content', get_post_field('post_content', $fuel_post_id));
                    $content .= '</div>';
                    $content .= '</li>';
                }
                $content .= '</ul>';
                $content .= '</div>';
            }
        }
    } else {
        $content .= '<h3 class="fuel-video-nofound">FUEL Video Not Found. Please check your shortcode.</h3>';
    }
    $content .= '</div>';
    wp_reset_postdata();
    return $content;
}

add_action("wp_ajax_fuel_player", "get_fuel_gallery_player_html");
add_action("wp_ajax_nopriv_fuel_player", "get_fuel_gallery_player_html");

function get_fuel_gallery_player_html() {
    $result['response'] = "";
    if (isset($_REQUEST["fuel_id"])) {
        $fuel_id = $_REQUEST["fuel_id"];
        $player_options = (object) array(
                    'autoplay' => 'on'
        );        
        $fuel_post_data = fuel_bitcentral_get_fuel_postdata($fuel_id);
        if (function_exists('fuel_bitcentral_preroll_addon_prepare')) {
            $player_options = fuel_bitcentral_preroll_addon_prepare($fuel_post_data, $player_options);
        }
        $fuel_player_html = fuel_bitcentral_player($fuel_post_data, 'fuel-single-popup-shortcode-player', $player_options);

        if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
            $result['player'] = esc_html($fuel_player_html);
            $result['fuel_title'] = $fuel_post_data->title;
            $result['response'] = "success";
        } else {
            header("Location: " . $_SERVER["HTTP_REFERER"]);
        }
    } else {
        $result['response'] = "error";
    }
    echo json_encode($result);
    die();
}
