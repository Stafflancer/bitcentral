<?php

function fuel_bitcentral_player($data = array(), $player_class = '', $shorcode_options = array()) {
    $player = '';
    if ($data) {
        $player .= '<fuel-video plugin-version="' . FUEL_BITCENTRAL_CURRENT_VERSION . '" id="fuel-single-post-player" class="' . $player_class . '" ';
        if ($data->player_additional_image) {
            $player .= 'data-poster-image="' . esc_url($data->player_additional_image) . '" ';
        } else {
            $player .= 'data-poster-image="' . esc_url($data->featured_image) . '" ';
        }


        if (function_exists('fuel_bitcentral_preroll_addon_settings')) {
            if (fuel_bitcentral_preroll_addon_settings()->preroll) {
                $player .= fuel_bitcentral_preroll_addon_rendering($data, $shorcode_options);
            }
        }

        if (isset($shorcode_options->autoplay) && !empty($shorcode_options->autoplay)) {
            if ($shorcode_options->autoplay === 'on') {
                $player .= 'data-autoplay ';
            } else if ($shorcode_options->autoplay === 'off') {
                $player .= '';
            }
        } else {
            if (fuel_bitcentral_player_settings()->autoplay) {
                $player .= 'data-autoplay ';
            }
        }

        if (fuel_bitcentral_player_settings()->floating) {
            $player .= 'data-floating="true" ';
        }
        $player .= 'preload="auto" ';
        if ($data->swc_id) {
            $player .= 'data-swc="' . $data->swc_id . '" ';
        }
        $player .= 'data-channel="' . $data->channel_id . '">';
        $player .= '</fuel-video>';
    }

    return $player;
}

function fuel_bitcentral_player_embed($data = array()) {
    $embed = '';
    if ($data) {
        $embed_icon_url = FUEL_BITCENTRAL_PLUGIN_ROOT_URL . '/assets/images/embed-code.png';
        $player = '<script type="text/javascript" id="fuel-player-script" src="' . FUEL_BITCENTRAL_SCRIPT_URL . '"></script>';
        $player .= fuel_bitcentral_player($data, 'single-fuel-player');
        $embed .= '<div class="fuel-player-embed">';
        $embed .= '<a href="javascript:void(0);" onclick="copyToClipboardFUEL(\'.fuel_embeded_code\');">';
        $embed .= '<img width="26" src="' . esc_url($embed_icon_url) . '" title="Embed" alt="Embed">';
        $embed .= '</a>';
        $embed .= '<input type="hidden" name="fuel_embeded_code" value="' . esc_html($player) . '" class="fuel_embeded_code">';
        $embed .= '</div>';
    }
    return $embed;
}

function fuel_bitcentral_player_share_section($data = array(), $shorcode_options = array(), $is_tile = '') {
    $share = '';
    if ($data) {
        $globla_main_share = fuel_bitcentral_player_settings()->share;
        $global_main_embed = fuel_bitcentral_player_settings()->embed;
        $global_social_share = fuel_bitcentral_player_settings()->social_share;
        $global_social_options = array(
            'facebook' => fuel_bitcentral_player_settings()->social_share_facebook,
            'twitter' => fuel_bitcentral_player_settings()->social_share_twitter,
            'linkedin' => fuel_bitcentral_player_settings()->social_share_linkedin,
            'email' => fuel_bitcentral_player_settings()->social_share_email
        );

        $main_share_on = 'off';
        $main_social_share = 'off';
        $main_embed = 'off';

        if ($shorcode_options->share === 'on') {
            $main_share_on = 'on';
            $main_social_share = 'on';
        } elseif ($globla_main_share && $shorcode_options->share !== 'off') {
            $main_share_on = 'on';
            if ($global_social_share) {
                $main_social_share = 'on';
            }
        }

        if ($shorcode_options->embed === 'on') {
            $main_share_on = 'on';
            $main_embed = 'on';
        } elseif ($global_main_embed && $shorcode_options->embed !== 'off') {
            $main_embed = 'on';
        }

        if ($main_share_on == 'on') {
            if (($is_tile == 'is_tile' && $main_social_share == 'on') || ($is_tile == '')) {
                $player = '<script type="text/javascript" id="fuel-player-script" src="' . FUEL_BITCENTRAL_SCRIPT_URL . '"></script>';
                $player .= fuel_bitcentral_player($data, 'single-fuel-player');
                $share .= '<div class="fuel-player-share">';

                $share .= '<div class="fuel-share-area">';
                $share .= '<a href="javascript:void(0);">';
                $share .= '<i class="fas fa-share" post-url="' . $data->url . '" post-title="' . $data->title . '" embed-shortcode="' . $main_embed . '" social-share="' . $main_social_share . '" social-options=' . json_encode($global_social_options) . ' is-tiles="' . $is_tile . '"></i>';
                $share .= '</a>';
                if ($main_embed == 'on') {
                    $share .= '<input type="hidden" name="fuel_embeded_code" value="' . esc_html($player) . '" class="fuel_embeded_code">';
                }
                $share .= '</div>';
                $share .= '</div>';
            }
        }
    }
    return $share;
}

function fuel_bitcentral_player_section($data = array(), $player_class = '', $shorcode_options = array()) {
    $section = '';
    if ($data) {
        $section .= '<div class="bitcentral-fuel-player-section">';
        if (fuel_bitcentral_player_settings()->title_position == 'top' || !fuel_bitcentral_player_settings()->title_position) {
            $section .= fuel_bitcentral_player_title_section($data, $shorcode_options);
        }

        $section .= '<div class="fule-video-section">';

        $section .= fuel_bitcentral_player($data, $player_class, $shorcode_options);

        $section .= '<div class="fuel-meta">';

        if (fuel_bitcentral_player_settings()->tags) {
            if (isset($shorcode_options->page_type) && $shorcode_options->page_type === 'single-fuel-page') {
                $section .= fuel_bitcentral_player_tag_section($data);
            }
        }
        if (fuel_bitcentral_player_settings()->title_position == 'bottom') {
            $section .= fuel_bitcentral_player_title_section($data, $shorcode_options);
        }
        $section .= fuel_bitcentral_player_share_section($data, $shorcode_options);
        $section .= '</div>';

        $section .= '</div>';
        $section .= '</div>';
    }
    return $section;
}

function fuel_bitcentral_player_title_section($data = array(), $shorcode_options = array()) {
    $title .= '<div class="fuel-title">';
    if (isset($shorcode_options->title)) {
        if ($shorcode_options->title !== '') {
            $title .= '<h1 class="fuel-title-heading">' . $shorcode_options->title . '</h1>';
        }
    } else {
        $title .= '<h1 class="fuel-title-heading">' . $data->title . '</h1>';
    }
    $title .= '</div>';
    return $title;
}

function fuel_bitcentral_player_tag_section($data) {
    $fuel_tags = get_the_terms($data->fuel_id, 'fuel_tag');
    $html_tags = '';
    $html_tags .= '<div class="fuel-player-tag">';
    if ($fuel_tags) {
        foreach ($fuel_tags as $fuel_tag) {
            $tag_title = $fuel_tag->name;
            $tag_url = get_term_link($fuel_tag->term_id, 'fuel_tag');
            $html_tags .= '<a href="' . esc_url($tag_url) . '"><span>' . $tag_title . '</span></a>';
        }
    }
    $html_tags .= '</div>';
    return $html_tags;
}
