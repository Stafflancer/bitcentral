<?php if( get_row_layout() == 'featured_resources_listing_block' ):
    $brochure_cpt = get_post_type_object('brochure');
    $case_study_cpt = get_post_type_object('case_study');
    $white_paper_cpt = get_post_type_object('white_paper');
    $product_video_cpt = get_post_type_object('product_video');
    ?>
<section class="resources-listing">
    <div class="sticky-link-group">
        <ul class="d-flex flex-row-wrap align-items-center justify-content-center">
            <li><a href="javascript:void(0);" class="scroll active">Featured Resources</a></li>
            <li><a href="<?php echo $brochure_cpt->rewrite['slug']; ?>/" class="scroll"><?php echo $brochure_cpt->label; ?></a></li>
            <li><a href="<?php echo $case_study_cpt->rewrite['slug']; ?>/" class="scroll"><?php echo $case_study_cpt->label; ?></a></li>
            <li><a href="<?php echo $white_paper_cpt->rewrite['slug']; ?>/" class="scroll"><?php echo $white_paper_cpt->label; ?></a></li>
            <li><a href="<?php echo $product_video_cpt->rewrite['slug']; ?>/" class="scroll"><?php echo $product_video_cpt->label; ?></a></li>
        </ul>
    </div>

    <div class="container">
        <?php while( have_rows('brochures') ) : the_row(); ?>
            <div id="brochures-list" class="group-main brochures-list">
                <div class="grid-post">
                    <div class="listing d-flex flex-wrap">
                        <?php
                        $brochure = get_sub_field('brochure');
                        foreach( $brochure as $p):
                            $brochure_list = get_post($p);
                            $image = wp_get_attachment_image_src( get_post_thumbnail_id( $p ), 'full' );
                        ?>
                            <div class="post-col">
                                <a href="<?php the_permalink($p); ?>">
                                    <div class="img bg-cover" style="background-image: url('<?php echo $image[0]; ?>');"></div>
                                    <div class="content">
                                        <div class="section-title">Brochure</div>
                                        <h3><?php echo $brochure_list->post_title; ?></h3>
                                        <div class="read-more">Learn more<?php echo svg_icon('arrow-right'); ?></div>
                                    </div>
                                </a>
                            </div>
                        <?php endforeach; wp_reset_postdata(); ?>
                    </div>
                    <?php $btn = get_sub_field('button');
                    if(!empty($btn['url'])){ ?>
                        <div class="view-all text-center">
                            <a href="<?php echo $btn['url']; ?>"><?php echo $btn['title']; ?></a>
                        </div>
                    <?php } ?>
                </div>
            </div>
        <?php endwhile; wp_reset_postdata(); ?>
        <?php while( have_rows('case_studies') ) : the_row(); ?>
            <div id="case-studies" class="group-main case-studies-list">
                <div class="grid-post">
                    <div class="listing d-flex flex-wrap">
                        <?php
                            $case_study = get_sub_field('case_study');
                            foreach( $case_study as $p):
                                $case_study_list = get_post($p);
                                $image = wp_get_attachment_image_src( get_post_thumbnail_id( $p ), 'full' );
                        ?>
                        <div class="post-col">
                            <a href="<?php the_permalink($p); ?>">
                                <div class="img bg-cover" style="background-image: url('<?php echo $image[0]; ?>');"></div>
                                <div class="content">
                                    <div class="section-title">Case Study</div>
                                    <h3><?php echo $case_study_list->post_title; ?></h3>
                                    <div class="read-more">Learn more<?php echo svg_icon('arrow-right'); ?></div>
                                </div>
                            </a>
                        </div>
                        <?php endforeach; wp_reset_postdata(); ?>
                    </div>
                    <?php $btn = get_sub_field('button');
                    if(!empty($btn['url'])){ ?>
                        <div class="view-all text-center">
                            <a href="<?php echo $btn['url']; ?>"><?php echo $btn['title']; ?></a>
                        </div>
                    <?php } ?>
                </div>
            </div>
        <?php endwhile; wp_reset_postdata(); ?>
        <?php while( have_rows('white_papers') ) : the_row(); ?>
            <div id="white-paper-list" class="group-main white-paper-list">
                <div class="grid-post">
                    <div class="listing d-flex flex-wrap">
                        <?php
                            $white_paper = get_sub_field('white_paper');
                            foreach( $white_paper as $p):
                                $white_paper_list = get_post($p);
                                $image = wp_get_attachment_image_src( get_post_thumbnail_id( $p ), 'full' );
                        ?>
                            <div class="post-col">
                                <a href="<?php the_permalink($p); ?>">
                                    <div class="img bg-cover" style="background-image: url('<?php echo $image[0]; ?>');"></div>
                                    <div class="content">
                                        <div class="section-title">White Paper</div>
                                        <h3><?php echo $white_paper_list->post_title; ?></h3>
                                        <div class="read-more">Learn more<?php echo svg_icon('arrow-right'); ?></div>
                                    </div>
                                </a>
                            </div>
                        <?php endforeach; wp_reset_postdata(); ?>
                    </div>
                    <?php $btn = get_sub_field('button');
                    if(!empty($btn['url'])){ ?>
                        <div class="view-all text-center">
                            <a href="<?php echo $btn['url']; ?>"><?php echo $btn['title']; ?></a>
                        </div>
                    <?php } ?>
                </div>
            </div>
        <?php endwhile; wp_reset_postdata(); ?>
        <?php while( have_rows('videos') ) : the_row(); ?>
            <div id="video-list" class="group-main video-list">
                <div class="grid-post">
                    <div class="listing d-flex flex-wrap">
                        <?php
                            $video = get_sub_field('video');
                            foreach( $video as $p):
                                $video_list = get_post($p);
                                $image = wp_get_attachment_image_src( get_post_thumbnail_id( $p ), 'full' );
                        ?>
                            <div class="post-col">
                                <a href="<?php the_permalink($p); ?>">
                                    <div class="img bg-cover" style="background-image: url('<?php echo $image[0]; ?>');"></div>
                                    <div class="content">
                                        <div class="section-title">Product Video</div>
                                        <h3><?php echo $video_list->post_title; ?></h3>
                                        <p><?php echo $video_list->post_excerpt; ?></p>
                                        <div class="read-more">Learn more<?php echo svg_icon('arrow-right'); ?></div>
                                    </div>
                                </a>
                            </div>
                        <?php endforeach; wp_reset_postdata(); ?>
                    </div>
                    <?php
                    $btn = get_sub_field('button');
                    if(!empty($btn['url'])){ ?>
                        <div class="view-all text-center">
                            <a href="<?php echo $btn['url']; ?>"><?php echo $btn['title']; ?></a>
                        </div>
                    <?php } ?>
                </div>
            </div>
        <?php
        endwhile;
        wp_reset_postdata();
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