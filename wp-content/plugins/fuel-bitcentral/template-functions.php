<?php

function fuel_bitcentral_sharing_header_option() {
    global $post;
    $output = '<meta property="og:type" content="article"/>';
    $output .= '<meta property="og:title" content="' . get_the_title($post->ID) . '"/>';
    $output .= '<meta property="og:image" content="' . get_the_post_thumbnail_url($post->ID) . '"/>';
    $output .= '<meta property="og:description" content="' . get_the_content($post->ID) . '"/>';
    $output .= '<meta property="og:url" content="' . get_the_permalink($post->ID) . '"/>';
    echo $output;
}

function fuel_bitcentral_tiles_ul($query_related, $carousel = 'false', $shortcode_cat_name = '', $shortcode_option = array()) {
    $html = '';
    if ($query_related) {
        if ($query_related->have_posts()) {
            if ($carousel === 'true') {
                $html .= '<ul class="fuel-related-carousel-tiles-ul">';
            } else {
                $html .= '<ul class="fuel-related-tiles-ul">';
            }
            while ($query_related->have_posts()) : $query_related->the_post();
                $fuel_post_data = fuel_bitcentral_get_fuel_postdata(get_the_ID());
                $fuel_category = get_the_terms(get_the_ID(), 'fuel_category');

                $category_title = '';
                $category_url = '';
                if (is_tax()) {
                    $fuel_category_object = get_queried_object();
                    foreach ($fuel_category as $fuel_cat) {
                        if ($fuel_cat->slug === $fuel_category_object->slug) {
                            $category_title = $fuel_cat->name;
                            $category_url = get_term_link($fuel_cat->term_id, 'fuel_category');
                        }
                    }
                } else if ($shortcode_cat_name) {
                    $tile_cat = get_term_by('slug', $shortcode_cat_name, 'fuel_category');
                    $category_title = $tile_cat->name;
                    $category_url = get_term_link($tile_cat->term_id, 'fuel_category');
                } else {
                    $category_title = $fuel_category[0]->name;
                    $category_url = get_term_link($fuel_category[0]->term_id, 'fuel_category');
                }

                if (isset($shortcode_option->tiles_category) && $shortcode_option->tiles_category === 'on') {
                    $display_category = 'on';
                } elseif (isset($shortcode_option->tiles_category) && $shortcode_option->tiles_category === 'off') {
                    $display_category = 'off';
                } else {
                    if (fuel_bitcentral_player_settings()->category) {
                        $display_category = 'on';
                    }
                }

                $html .= '<li data-tile="' . get_the_ID() . '">';
                $html .= '<a class="fuel-related-tile-image" href="' . esc_url($fuel_post_data->url) . '">
                            <img width="640" height="360" alt="" src="' . $fuel_post_data->tile_image . '">
                          </a>';
                $html .= '<div class="fuel-related-info">';
                if ($display_category === 'on') {
                    $html .= '<div class="fuel-category"><a href="' . esc_url($category_url) . '"><span>' . $category_title . '</span></a></div>';
                }
                $html .= '<div class="fuel-share">';
                $html .= fuel_bitcentral_player_share_section($fuel_post_data, array(), 'is_tile');
                $html .= '</div>';
                if (fuel_bitcentral_player_settings()->tile_heading) {
                    $tile_heading = mb_strimwidth($fuel_post_data->title, 0, 50, '...');
                } else {
                    $tile_heading = $fuel_post_data->title;
                }
                $html .= '<a class="fuel-title-hyperlink" href="' . esc_url($fuel_post_data->url) . '"><h3 class="fuel-title" title="' . $fuel_post_data->title . '">' . $tile_heading . '</h3></a>';
                $html .= '</div>';
                $html .= '</li>';
            endwhile;
            $html .= '</ul>';
        }
        wp_reset_postdata();
    }
    return $html;
}

function fuel_bitcentral_tiles_tag_ul($query_related, $carousel = 'false', $shortcode_tag_name = '') {
    $html = '';

    if ($query_related) {
        if ($query_related->have_posts()) {
            if ($carousel === 'true') {
                $html .= '<ul class="fuel-related-carousel-tiles-ul">';
            } else {
                $html .= '<ul class="fuel-related-tiles-ul">';
            }
            while ($query_related->have_posts()) : $query_related->the_post();
                $fuel_post_data = fuel_bitcentral_get_fuel_postdata(get_the_ID());
                $fuel_tags = get_the_terms(get_the_ID(), 'fuel_tag');

                $tag_title = '';
                $tag_url = '';
                if (is_tax()) {
                    $html_tags = '';
                    $fuel_tag_object = get_queried_object();
                    foreach ($fuel_tags as $fuel_tag) {
                        if ($fuel_tag->slug === $fuel_tag_object->slug) {
                            $tag_title = $fuel_tag->name;
                            $tag_url = get_term_link($fuel_tag->term_id, 'fuel_tag');
                        }
                    }
                    $html_tags .= '<div class="fuel-tag"><a href="' . esc_url($tag_url) . '"><span>' . $tag_title . '</span></a></div>';
                } else {
                    $html_tags = '';
                    foreach ($fuel_tags as $fuel_tag) {
                        $tag_title = $fuel_tag->name;
                        $tag_url = get_term_link($fuel_tag->term_id, 'fuel_tag');
                        $html_tags .= '<div class="fuel-tag"><a href="' . esc_url($tag_url) . '"><span>' . $tag_title . '</span></a></div>';
                    }
                    $tag_title = $fuel_tags[0]->name;
                    $tag_url = get_term_link($fuel_tags[0]->term_id, 'fuel_tag');
                }

                $html .= '<li data-tile="' . get_the_ID() . '" class="post-id-' . get_the_ID() . '">';
                $html .= '<a class="fuel-related-tile-image" href="' . esc_url($fuel_post_data->url) . '">
                            <img width="640" height="360" alt="" src="' . $fuel_post_data->tile_image . '">
                          </a>';
                $html .= '<div class="fuel-related-info">';
                $html .= '<div class="fuel-share">';
                $html .= fuel_bitcentral_player_share_section($fuel_post_data, array(), 'is_tile');
                $html .= '</div>';
                if (fuel_bitcentral_player_settings()->tile_heading) {
                    $tile_heading = mb_strimwidth($fuel_post_data->title, 0, 50, '...');
                } else {
                    $tile_heading = $fuel_post_data->title;
                }

                $html .= '<a class="fuel-title-hyperlink" href="' . esc_url($fuel_post_data->url) . '"><h3 class="fuel-title" title="' . $fuel_post_data->title . '">' . $tile_heading . '</h3></a>';

                $html .= '</div>';
                $html .= '</li>';
            endwhile;
            $html .= '</ul>';
        }
        wp_reset_postdata();
    }
    return $html;
}

function fuel_bitcentral_tiles_ul_gallery_array($category = array(), $no_of_posts) {
    $data_fuel = array();
    if ($category && (int) $no_of_posts) {
        $all_fuel_categories = get_terms('fuel_category');
        $args = array(
            'post_type' => 'fuel',
            'posts_per_page' => $no_of_posts,
            'orderby' => 'menu_order',
            'order' => 'ASC',
            'tax_query' => array(
                array(
                    'taxonomy' => 'fuel_category',
                    'field' => 'slug',
                    'terms' => ($category == 'all') ? fuel_m_explode($all_fuel_categories, 'slug') : explode(',', $category),
                ),
            ),
        );

        $query_fuel_gallery = new WP_Query($args);
        if ($query_fuel_gallery->have_posts()) {
            $i = 1;
            while ($query_fuel_gallery->have_posts()) : $query_fuel_gallery->the_post();
                if ($i === 1) {
                    $fuel_post_data = fuel_bitcentral_get_fuel_postdata(get_the_ID());
                    $data_fuel['main_tile'][get_the_ID()] = $fuel_post_data;
                } else {
                    $fuel_post_data = fuel_bitcentral_get_fuel_postdata(get_the_ID());
                    $data_fuel['child_tiles'][get_the_ID()] = $fuel_post_data;
                }
                $i++;
            endwhile;
        }
        wp_reset_postdata();
    }
    return $data_fuel;
}
