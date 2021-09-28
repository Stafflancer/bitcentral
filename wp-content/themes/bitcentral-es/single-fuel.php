<?php
/**
 * The template for displaying all single fuel posts
 */
add_action('wp_head', 'fuel_bitcentral_sharing_header_option');

get_header();
?>
	<section class="common-banner single-news-banner">
		<div class="container">
			<div class="inner d-flex flex-row-wrap">
				<div class="text-block white-text">
					<h1><?php the_title(); ?></h1>
				</div>
			</div>
		</div>
	</section>

    <div class="site-main">
        <div class="fuel-bitcentral-single-page">
            <div class="container">
	            <div class="col-lg-10 mx-auto position-relative">
                <?php while (have_posts()) : the_post(); ?>
                    <div class="fuel-single-content-container">
                        <article id="fuel-post-<?php echo get_the_ID(); ?>" class="fuel-article-section">
                            <?php
                            $fuel_post_data = fuel_bitcentral_get_fuel_postdata(get_the_ID());
                            $options        = (object) array(
                                'page_type' => 'single-fuel-page',
                            );
                            if (function_exists('fuel_bitcentral_preroll_addon_prepare')) {
                                $player_options = fuel_bitcentral_preroll_addon_prepare($fuel_post_data, $options);
                            }
                            ?>
                            <?php echo fuel_bitcentral_player_section($fuel_post_data, 'fuel-single-post-player', $player_options); ?>
                        </article>
                    </div>
                <?php endwhile; ?>
                <?php wp_reset_postdata(); ?>
	            </div>

                <?php
                global $post;

                $all_taxonomy_ids             = [];
                $current_post_fuel_categories = get_the_terms($post->ID, 'fuel_category');
                foreach ($current_post_fuel_categories as $current_post_fuel_category) {
                    $all_taxonomy_ids[] = $current_post_fuel_category->term_id;
                }
                $query_related = new WP_Query([
                    'ignore_sticky_posts' => 0,
                    'posts_per_page'      => 30,
                    'post__not_in'        => array($post->ID),
                    'post_type'           => 'fuel',
                    'orderby'             => 'menu_order',
                    'order'               => 'ASC',
                    'tax_query'           => [
                        [
                            'field'    => 'id',
                            'taxonomy' => 'fuel_category',
                            'terms'    => $all_taxonomy_ids,
                        ],
                    ],
                ]);

                if ($query_related->have_posts()) :
                    ?>
                    <div class="fuel-related-stories">
                        <div class="fuel-related-stories-container">
                            <h4 class="fuel-related-stories-heading"><span>Related Stories</span></h4>
                            <?php echo fuel_bitcentral_tiles_ul($query_related, 'false'); ?>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
<?php
get_footer();