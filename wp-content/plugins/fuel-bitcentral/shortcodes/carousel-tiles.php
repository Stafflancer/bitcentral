<?php

add_shortcode('FUEL-CarouselTiles', 'fuel_bitcentral_carousel_tiles');

function fuel_bitcentral_carousel_tiles($data) {
    $content = '<div class="fuel-related-stories fuel-carousal">';
    $content .= '<div class="fuel-related-stories-container">';
    if (isset($data['category']) && isset($data['max']) && !empty($data['category']) && !empty($data['max'])) {
        $cat_name = $data['category'];
        $heading = isset($data['heading']) ? $data['heading'] : '';
        $posts_fuel_count = (int) $data['max'];
        $tiles_category = isset($data['tiles_category']) ? $data['tiles_category'] : '';

        $args = array(
            'post_type' => 'fuel',
            'posts_per_page' => $posts_fuel_count,
            'orderby' => 'menu_order',
            'order' => 'ASC',
            'tax_query' => array(
                array(
                    'taxonomy' => 'fuel_category',
                    'field' => 'slug',
                    'terms' => $cat_name,
                ),
            ),
        );
        $shorcode_options = (object) array(
                    'tiles_category' => $tiles_category
        );
        $query_related = new WP_Query($args);
        if ($query_related->have_posts()) {
            if ($heading) {
                $content .= '<h4 class="fuel-related-stories-heading"><a class="fuel-related-stories-heading-hyperlink" href="' . get_term_link($cat_name, 'fuel_category') . '"><span>' . $heading . '</span></a></h4>';
            }
            $content .= fuel_bitcentral_tiles_ul($query_related, 'true', $cat_name, $shorcode_options);
            if ($query_related->found_posts) {
                $content .= '<div class="view-all-fuel-button"><a href="' . get_term_link($cat_name, 'fuel_category') . '">View All (' . $query_related->found_posts . ')</a></div>';
            }
        } else {
            $content .= '<h3 class="fuel-video-nofound">Video Not Found.</h3>';
        }
    } else {
        $content .= '<h3 class="fuel-video-nofound">Video Not Found. Please check your shortcode.</h3>';
    }
    $content .= '</div></div>';
    return $content;
}
