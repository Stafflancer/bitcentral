<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package synergy
 */

$taxonomy = get_taxonomy('news_type');
$taxonomy_slug = $taxonomy->rewrite['slug'];
$news_events_cpt = get_post_type_object('news_event');
$news_type = wp_get_post_terms( get_the_ID(), 'news_type' )[0];

if ( ! empty( $news_type ) && ! is_wp_error( $news_type ) ) {
    $news_type_name = $news_type->name;
    $news_type_slug = $news_type->slug;
}
?>
<section class="common-banner single-news-banner">
    <div class="container">
        <div class="inner d-flex flex-row-wrap">
            <div class="text-block white-text">
                <div class="custom-breadcrumb d-flex flex-row-wrap align-items-center">
                    <a href="<?php echo $news_events_cpt->rewrite['slug'] . '/'; ?>"><?php echo $news_events_cpt->label; ?></a>
                    <div class="divider">/</div>
                    <a href="<?php echo $taxonomy_slug . '/' . $news_type_slug . '/'; ?>"><?php echo $news_type_name; ?></a>
                </div>
                <h1><?php the_title(); ?></h1>
            </div>
        </div>
    </div>
</section>

<section class="single-news-content">
    <div class="container">
        <div class="date">
            <span class="month"><?php echo get_the_date('M'); ?></span>
            <span class="no"><?php echo get_the_date('d'); ?></span>
            <span class="year"><?php echo get_the_date('Y'); ?></span>
        </div>
        <div class="wrap m-auto">
            <div class="content">
                <?php the_content(); ?>
            </div>
        </div>
    </div>
</section>

<?php if( have_rows('videos') ){ ?>
<section class="general-content-video-block">
    <div class="container">
        <div class="wrap m-auto">
            <div class="title-block">
                <div class="section-title"><?php the_field('label'); ?></div>
                <h2><?php the_field('heading'); ?></h2>
                <p><?php the_field('content'); ?></p>
            </div>
            <div class="content">
                <?php while( have_rows('videos') ) : the_row(); ?>
                    <?php if(get_sub_field('heading')){ ?> <h2><?php the_sub_field('heading'); ?></h2> <?php } ?>
                    <iframe src="<?php the_sub_field('video'); ?>" width="640" height="360" frameborder="0" allow="autoplay; fullscreen; picture-in-picture" allowfullscreen></iframe>
                <?php endwhile; wp_reset_postdata(); ?>
            </div>
        </div>
    </div>
</section>
<?php } ?>

<div class="post-nav">
    <div class="container">
        <div class="wrap m-auto d-flex align-items-center justify-content-between">
             <?php
                the_post_navigation([
                    'prev_text' => esc_html__( 'previous', 'bitcentral' ),
                    'next_text' => esc_html__( 'Next', 'bitcentral' ),
                ]);
            ?>
        </div>
    </div>
</div>

<?php if( have_rows('cta_event_block') ):
    while( have_rows('cta_event_block') ) : the_row();
        if (get_field('heading') || get_field('heading')):
?>
<section class="cta-event-block bg-cover parallax-img" style="background-image: url('<?php the_sub_field('background_image'); ?>');">
    <div class="container">
        <div class="wrap m-auto">
            <div class="text-block white-text white-text">
                <div class="section-title"><?php the_sub_field('label'); ?></div>
                <h2><?php the_sub_field('heading'); ?></h2>
                <?php the_sub_field('content'); ?>
                <?php $btn = get_sub_field('button');
                if(!empty($btn['url'])){ ?>
                    <div class="bottom-btn">
                        <a href="<?php echo $btn['title']; ?>" class="common-btn"><?php echo $btn['title']; ?></a>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
</section>
<?php
        endif;
    endwhile;
endif;
?>

<section class="resources-listing">
    <div class="container">
        <div id="eventslist" class="group-main events-list">
            <div class="wrap m-auto">
                <div class="section-title">Related <?php
                        $terms = wp_get_post_terms( get_the_ID(), 'news_type' );
                        if ( ! empty( $terms ) && ! is_wp_error( $terms ) ) {
                            $taxonomy = $terms[0]->name;
                            echo $taxonomy;
                        }
                    ?>
                </div>
            </div>
            <div class="grid-post">
                <div class="listing d-flex flex-wrap">
                    <?php
                    $terms = get_the_terms( get_the_ID() , 'news_type');
                    //Pluck out the IDs to get an array of IDS
                    $term_ids = wp_list_pluck($terms, 'term_id');
                        $product = [
                            'post_type' => 'news_event',
                            'post_status' => 'publish',
                            'posts_per_page' => '4',
                            'tax_query' => [
                                [
                                    'taxonomy' => 'news_type',
                                    'field' => 'id',
                                    'terms' => $term_ids,
                                    'operator' => 'IN',
                                ]
                            ],
                            'post__not_in' => [get_the_ID()]
                        ];
                        $my_query  = new WP_Query( $product );
                        while ( $my_query->have_posts() ) : $my_query->the_post();
                        $image = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'full' );
                        ?>
                        <div class="post-col">
                            <a href="<?php the_permalink(); ?>">
                                <div class="img bg-cover" style="background-image: url('<?php echo $image[0]; ?>');">
                                    <div class="date">
                                        <span class="month"><?php echo get_the_date('M'); ?></span>
                                        <span class="no"><?php echo get_the_date('d'); ?></span>
                                        <span class="year"><?php echo get_the_date('Y'); ?></span>
                                    </div>
                                </div>
                                <div class="content">
                                    <h3><?php the_title(); ?></h3>
                                    <div class="read-more">Learn more<?php echo svg_icon('arrow-right'); ?></div>
                                </div>
                            </a>
                        </div>
                    <?php
                        endwhile;
                    wp_reset_postdata();
                    ?>
                </div>
            </div>
        </div>
    </div>
</section>