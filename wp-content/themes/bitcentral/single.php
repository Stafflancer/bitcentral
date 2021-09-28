<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package bitcentral
 */

get_header();
?>

<!--    <div class="post-title">-->
<!--        <header class="entry-header">-->
<!--         <div class="container">-->
<!--            --><?php
//        if ( is_singular() ) :
//            the_title( '<h1 class="entry-title">', '</h1>' );
//        else :
//            the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
//        endif;
//
//        if ( 'post' === get_post_type() ) :
//            ?>
<!--            <div class="entry-meta">-->
<!--                --><?php
//                bitcentral_posted_on();
//                bitcentral_posted_by();
//                ?>
<!--            </div>-->
<!--        --><?php //endif; ?>
<!--         </div>-->
<!--       </header>-->
<!--    </div>-->

	<section class="common-banner single-news-banner">
	    <div class="container">
	        <div class="inner d-flex flex-row-wrap">
	            <div class="text-block white-text">
	                <div class="custom-breadcrumb d-flex flex-row-wrap align-items-center">
	                    <a href="/resources/">Blog</a>
	                </div>
	                <h1><?php the_title(); ?></h1>
	            </div>
	        </div>
	    </div>
	</section>

    <main id="primary" class="site-main">
        <div class="container">
            <?php
            while ( have_posts() ) : the_post();
                get_template_part( 'template-parts/content', get_post_type() );

                the_post_navigation([
                    'prev_text' => '<span class="nav-subtitle">' . esc_html__( 'Previous:', 'bitcentral' ) . '</span> <span class="nav-title">%title</span>',
                    'next_text' => '<span class="nav-subtitle">' . esc_html__( 'Next:', 'bitcentral' ) . '</span> <span class="nav-title">%title</span>',
                ]);

                // If comments are open or we have at least one comment, load up the comment template.
                if ( comments_open() || get_comments_number() ) :
                    comments_template();
                endif;
            endwhile; // End of the loop.
            ?>
        </div>
    </main><!-- #main -->

<?php
//get_sidebar();
get_footer();