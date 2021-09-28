<?php

add_shortcode('FUEL-TilesByTag', 'fuel_bitcentral_tiles_by_tag');

function fuel_bitcentral_tiles_by_tag($atts) {
    ob_start();
    extract(shortcode_atts(array(
        'tag' => '',
        'max' => '',
        'heading' => ''
                    ), $atts));

    $content = '<div class="fuel-related-stories tiles-by-tag">
                <div class="fuel-related-stories-container">';
    if (!empty($tag) && !empty($max)) {

        $fuel_tags = str_replace(' ', '', $tag);
        $fuel_tags = explode(",", $fuel_tags);
        $posts_fuel_count = (int) $max;
        $heading = $heading;

        $fuel_tag_args = array(
            'post_type' => 'fuel',
            'posts_per_page' => $posts_fuel_count,
            'orderby' => 'menu_order',
            'order' => 'ASC',
            'tax_query' => array(
                array(
                    'taxonomy' => 'fuel_tag',
                    'field' => 'slug',
                    'terms' => $fuel_tags,
                ),
            )
        );
        $query_fuel_tags = new WP_Query($fuel_tag_args);
        if ($query_fuel_tags->have_posts()) {
            if ($heading) {
                $content .= '<h4 class="fuel-related-stories-heading"><span>' . $heading . '</span></h4>';
            }
            $content .= fuel_bitcentral_tiles_tag_ul($query_fuel_tags, 'false');
        } else {
            $content .= "<h3 class='fuel-video-nofound'>No Video Found in <strong>$tag_name</strong>.</h3>";
        }
    } else {
        $content .= '<h3 class="fuel-video-nofound">Video Not Found. Please check your shortcode.</h3>';
    }
    $content .= '</div></div>';
    return $content;
}

?>