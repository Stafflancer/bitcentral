<?php
/**
 * The template for displaying all category fuel posts
 */
get_header();
$fuel_category_object = get_queried_object();
//echo '<pre>';
//print_r($fuel_category_object);
//exit;
$fuel_cat_id = $fuel_category_object->term_id;

$args = array(
    'post_type' => 'fuel',
    'posts_per_page' => 1,
    'orderby' => 'menu_order',
    'order' => 'ASC',
    'tax_query' => array(
        array(
            'taxonomy' => 'fuel_category',
            'field' => 'term_id',
            'terms' => $fuel_cat_id
        )
    )
);
$fuel_posts = new WP_Query($args);
?>
<div class="fuel-bitcentral-category-page">
    <?php if ($fuel_posts->have_posts()) : ?>
        <?php while ($fuel_posts->have_posts()) : $fuel_posts->the_post(); ?>
            <?php $fuel_current_post_id = get_the_ID(); ?>
            <div class="fuel-single-content-container">
                <article id="fuel-post-<?php echo get_the_ID(); ?>" class="fuel-article-section">
                    <?php
                    $fuel_post_data = fuel_bitcentral_get_fuel_postdata(get_the_ID());
                    $options = (object) array();
                    if (function_exists('fuel_bitcentral_preroll_addon_prepare')) {
                        $player_options = fuel_bitcentral_preroll_addon_prepare($fuel_post_data, $options);
                    }
                    ?>
                    <?php echo fuel_bitcentral_player_section($fuel_post_data, 'fuel-single-post-player', $player_options); ?>                                                                                  
                </article>
            </div>
        <?php endwhile; ?>
    <?php endif; ?>
    <?php wp_reset_postdata(); ?>

    <?php
    $args_fuel_archive = array(
        'post_type' => 'fuel',
        'posts_per_page' => -1,
        'orderby' => 'menu_order',
        'order' => 'ASC',
        'post__not_in' => array($fuel_current_post_id),
        'tax_query' => array(
            array(
                'taxonomy' => 'fuel_category',
                'field' => 'id',
                'terms' => $fuel_cat_id,
            ),
        ),
    );
    $query_archive_fuel_posts = new WP_Query($args_fuel_archive);
    if ($query_archive_fuel_posts->have_posts()) :
        ?>
        <div class="fuel-related-stories">
            <div class="fuel-related-stories-container">
                <h4 class="fuel-related-stories-heading"><span>Related Stories</span></h4>
                <?php echo fuel_bitcentral_tiles_ul($query_archive_fuel_posts, 'false'); ?>
            </div>
        </div>
        <?php
    endif;
    ?>
</div>
<?php
get_footer();

