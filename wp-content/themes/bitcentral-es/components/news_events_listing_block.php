<?php if (get_row_layout() == 'news_events_listing_block'): ?>
    <section class="resources-listing">
        <div class="sticky-link-group">
            <ul class="d-flex flex-row-wrap align-items-center justify-content-center">
                <li><a class="active" href="javascript:void(0);"><span>Latest</span></a></li>
                <?php
                $taxonomy = get_taxonomy('news_type');
                $taxonomy_slug = $taxonomy->rewrite['slug'];
                $terms = get_terms('news_type', ['hide_empty' => 0, 'parent' => 0]);

                foreach ($terms as $term) :
                    ?>
                    <li><a href="<?php echo $taxonomy_slug . '/' . $term->slug; ?>"><?php echo $term->name; ?></a></li>
                <?php endforeach; ?>
            </ul>
        </div>

        <div class="container">
            <?php
            $news_type_terms = get_terms('news_type');
            foreach ($news_type_terms as $news_type) {
                $args  = [
                    'post_type'      => 'news_event',
                    'tax_query'      => [
                        [
                            'taxonomy' => 'news_type',
                            'field'    => 'slug',
                            'terms'    => $news_type->slug,
                        ],
                    ],
                    'posts_per_page' => '4',
                ];
                $loop  = new WP_Query($args);
                $image = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'full');

                if ('article' == $news_type->slug || 'press-release' == $news_type->slug) {
                    ?>
                    <div id="<?php echo $news_type->slug; ?>" class="group-main press-list">
                        <div class="wrap m-auto">
                            <div class="section-title"><?php echo $news_type->name; ?></div>
                        </div>
                        <div class="grid-post">
                            <div class="listing d-flex flex-wrap">
                                <?php
                                if ($loop->have_posts()) {
                                    while ($loop->have_posts()) : $loop->the_post();
                                        ?>
                                        <div class="post-col">
                                            <a href="<?php the_permalink(); ?>">
                                                <div class="date">
                                                    <span class="month"><?php echo get_the_date('M'); ?></span>
                                                    <span class="no"><?php echo get_the_date('d'); ?></span>
                                                    <span class="year"><?php echo get_the_date('Y'); ?></span>
                                                </div>
                                                <div class="content">
                                                    <h3><?php the_title(); ?></h3>
                                                    <div class="read-more"><?php the_sub_field('button_text'); ?><?php echo svg_icon('arrow-right'); ?></div>
                                                </div>
                                            </a>
                                        </div>
                                    <?php
                                    endwhile;
                                }
                                ?>
                            </div>
                            <div class="view-all text-center">
                                <a href="<?php echo $taxonomy_slug . '/' . $news_type->slug . '/'; ?>">All <?php echo $news_type->name; ?></a>
                            </div>
                        </div>
                    </div>
                    <?php
                } elseif ('blog' == $news_type->slug) {
                    ?>
                    <div id="<?php echo $news_type->slug; ?>" class="group-main blog-list">
                        <div class="wrap m-auto">
                            <div class="section-title"><?php echo $news_type->name; ?></div>
                        </div>
                        <div class="grid-post">
                            <div class="listing d-flex flex-wrap">
                                <?php
                                if ($loop->have_posts()) {
                                    while ($loop->have_posts()) : $loop->the_post();
                                        $image = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'full');
                                        ?>
                                        <div class="post-col">
                                            <a href="<?php the_permalink(); ?>">
                                                <div class="img bg-cover" style="background-image: url('<?php echo $image[0]; ?>');"></div>
                                                <div class="content">
                                                    <h3><?php the_title(); ?></h3>
                                                    <div class="read-more">Learn more<?php echo svg_icon('arrow-right'); ?></div>
                                                </div>
                                            </a>
                                        </div>
                                    <?php
                                    endwhile;
                                }
                                ?>
                            </div>
                            <div class="view-all text-center">
                                <a href="<?php echo $taxonomy_slug . '/' . $news_type->slug . '/'; ?>">Our <?php echo $news_type->name; ?></a>
                            </div>
                        </div>
                    </div>
                    <?php
                } elseif ('awards' == $news_type->slug) {
                    ?>
                    <div id="<?php echo $news_type->slug; ?>" class="group-main awards-list">
                        <div class="wrap m-auto">
                            <div class="section-title"><?php echo $news_type->name; ?></div>
                        </div>
                        <div class="grid-post">
                            <div class="listing d-flex flex-wrap">
                                <?php
                                if ($loop->have_posts()) {
                                    while ($loop->have_posts()) : $loop->the_post();
                                        ?>
                                        <div class="post-col award-inner">
                                            <a href="#">
                                                <div class="date">
                                                    <span class="month"><?php echo get_the_date('M'); ?></span>
                                                    <span class="no"><?php echo get_the_date('d'); ?></span>
                                                    <span class="year"><?php echo get_the_date('Y'); ?></span>
                                                </div>
                                                <div class="award-img">
                                                    <img src="<?php the_field('logo'); ?>" alt="">
                                                </div>
                                                <div class="content">
                                                    <h3><?php the_title(); ?></h3>
                                                </div>
                                            </a>
                                        </div>
                                    <?php endwhile;
                                } ?>
                            </div>
                            <div class="view-all text-center">
                                <a href="<?php echo $taxonomy_slug . '/' . $news_type->slug . '/'; ?>">All <?php echo $news_type->name; ?></a>
                            </div>
                        </div>
                    </div>
                    <?php
                } elseif ('go-lives' == $news_type->slug || 'events' == $news_type->slug) {
                    ?>
                    <div id="<?php echo $news_type->slug; ?>" class="group-main lives-list">
                        <div class="wrap m-auto">
                            <div class="section-title"><?php echo $news_type->name; ?></div>
                        </div>
                        <div class="grid-post">
                            <div class="listing d-flex flex-wrap">
                                <?php
                                if ($loop->have_posts()) {
                                    while ($loop->have_posts()) : $loop->the_post();
                                        $image = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'full');
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
                                    <?php endwhile;
                                } ?>
                            </div>
                            <div class="view-all text-center">
                                <a href="<?php echo $taxonomy_slug . '/' . $news_type->slug . '/'; ?>">All <?php echo $news_type->name; ?></a>
                            </div>
                        </div>
                    </div>
                    <?php
                }
                wp_reset_postdata();
            }
            ?>
        </div>

        <script>
            jQuery( function () {
                var header = jQuery( 'header' ),
                    menu = jQuery( '.common-banner' ),
                    heightThreshold = jQuery( '.resources-listing' ).offset().top - 70,
                    heightThreshold_end = jQuery( '.resources-listing' ).offset().top + jQuery( '.resources-listing' ).height();

                jQuery( window ).scroll( function () {
                    var scroll = jQuery( window ).scrollTop();

                    if ( scroll >= heightThreshold && scroll <= heightThreshold_end ) {
                        jQuery( '.sticky-link-group' ).addClass( 'sticky' );
                    } else {
                        jQuery( '.sticky-link-group' ).removeClass( 'sticky' );
                    }
                } );
            } );

            function onTaskCloneScroll() {
                var scrollPos = jQuery( document ).scrollTop();

                jQuery( '.sticky-link-group ul li a' ).each( function () {
                    var currLink = jQuery( this ),
                        refElement = jQuery( currLink.attr( 'href' ) ),
                        top_position = refElement.position().top + 250;

                    if ( top_position <= scrollPos && top_position + refElement.height() > scrollPos ) {
                        jQuery( '.sticky-link-group ul li a' ).removeClass( 'active' );
                        currLink.addClass( 'active' );
                    }
                } );
            }

            jQuery( document ).on( 'scroll', onTaskCloneScroll );

            jQuery( '.sticky-link-group ul li' ).click( function () {
                var selectedId = jQuery( this ).find( 'a' ).attr( 'href' ),
                    topSet = -160;

                setTimeout( function () {
                    jQuery.smoothScroll( {
                        scrollTarget: selectedId,
                        speed: 400,
                        offset: topSet
                    } );
                }, 0 );
            } );
        </script>
    </section>
<?php endif; ?>