<?php
/**
* A Simple Category Template
*/

get_header();

$taxonomy = get_taxonomy('news_type');
$taxonomy_slug = $taxonomy->rewrite['slug'];
$news_events_cpt = get_post_type_object('news_event');
$news_type = wp_get_post_terms( get_the_ID(), 'news_type' )[0];

if ( ! empty( $news_type ) && ! is_wp_error( $news_type ) ) {
    $news_type_name = $news_type->name;
    $news_type_slug = $news_type->slug;
}
?>
<section class="common-banner bg-cover" style="background-image: url('/wp-content/uploads/2021/02/Resources-banner-min-2.png');">
    <div class="container">
        <div class="inner d-flex flex-row-wrap">
            <div class="text-block white-text">
                <div class="custom-breadcrumb d-flex flex-row-wrap align-items-center">
                    <a href="<?php echo $news_events_cpt->rewrite['slug'] . '/'; ?>"><?php echo $news_events_cpt->label; ?></a>
                    <div class="divider">/</div>
                    <span><?php echo $news_type_name; ?></span>
                </div>
                <?php dynamic_sidebar('taxonomy_hero_block'); ?>
            </div>
        </div>
    </div>
</section>

<section class="resources-listing">
    <div class="sticky-link-group">
        <ul class="d-flex flex-row-wrap align-items-center justify-content-center">
            <?php
                $terms = get_terms('news_type', ['hide_empty' => 0, 'parent' =>0]);

                foreach($terms as $term) :
                    $class = ($news_type_name == $term->name) ? 'active' : '';
                ?>
                <li><a href="<?php echo $taxonomy_slug . '/' . $term->slug . '/'; ?>" class="<?php echo $class; ?>"><?php echo $term->name; ?></a></li>
                <?php
                endforeach;
                ?>
        </ul>
    </div>

    <div class="container">
        <?php
        // Check if there are any posts to display
        if ( have_posts() ) :
        ?>
        <div id="<?php echo $news_type_slug; ?>" class="group-main <?php echo $news_type_slug;?>-list">
            <div class="grid-post">
                <div class="listing d-flex flex-wrap">
                <?php while ( have_posts() ) : the_post();
                    $image = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'full' );
                ?>
                <?php if('article' == $news_type_slug || 'press-release' == $news_type_slug){ ?>
                    <div class="post-col">
                        <a href="<?php the_permalink(); ?>">
                            <div class="date">
                                <span class="month"><?php echo get_the_date('M', get_the_ID()); ?></span>
                                <span class="no"><?php echo get_the_date('d', get_the_ID()); ?></span>
                                <span class="year"><?php echo get_the_date('Y', get_the_ID()); ?></span>
                            </div>
                            <div class="content">
                                <h3><?php the_title(); ?></h3>
                                <div class="read-more">Learn more<?php echo svg_icon('arrow-right'); ?></div>
                            </div>
                        </a>
                    </div>
                <?php } elseif('blog' == $news_type_slug){?>
                    <div class="post-col">
                        <a href="<?php the_permalink(); ?>">
                            <div class="img bg-cover" style="background-image: url('<?php echo $image[0]; ?>');"></div>
                            <div class="content">
                                <h3><?php the_title(); ?></h3>
                                <div class="read-more">Learn more<?php echo svg_icon('arrow-right'); ?></div>
                            </div>
                        </a>
                    </div>
                <?php } elseif('awards' == $news_type_slug){?>
                    <div class="post-col award-inner">
                        <a href="#">
                            <div class="date">
                                <span class="month"><?php echo get_the_date('M', get_the_ID()); ?></span>
                                <span class="no"><?php echo get_the_date('d', get_the_ID()); ?></span>
                                <span class="year"><?php echo get_the_date('Y', get_the_ID()); ?></span>
                            </div>
                            <div class="award-img">
                                <img src="<?php the_field('logo'); ?>" alt="">
                            </div>
                            <div class="content">
                                <h3><?php the_title(); ?></h3>
                            </div>
                        </a>
                    </div>
                <?php } elseif('go-lives' == $news_type_slug || 'events' == $news_type_slug){?>
                    <div class="post-col">
                        <a href="<?php the_permalink(); ?>">
                            <div class="img bg-cover" style="background-image: url('<?php echo $image[0]; ?>');">
                                <div class="date">
                                    <span class="month"><?php echo get_the_date('M', get_the_ID()); ?></span>
                                    <span class="no"><?php echo get_the_date('d', get_the_ID()); ?></span>
                                    <span class="year"><?php echo get_the_date('Y', get_the_ID()); ?></span>
                                </div>
                            </div>
                            <div class="content">
                                <h3><?php the_title(); ?></h3>
                                <div class="read-more">Learn more<?php echo svg_icon('arrow-right'); ?></div>
                            </div>
                        </a>
                    </div>
                <?php } ?>
                <?php endwhile; ?>
                </div>
                <div class="pagination">
                    <?php wp_pagenavi(); ?>
                </div>
            </div>
        </div>
        <?php else: ?>
        <p>Sorry, no posts matched your criteria.</p>
        <?php endif; ?>
    </div>
</section>
<?php get_footer(); ?>