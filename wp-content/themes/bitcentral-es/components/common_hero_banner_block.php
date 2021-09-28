<?php if (get_row_layout() == 'common_hero_banner_block'):
    if (get_sub_field('add_color_circle')) {
        if (get_sub_field('color_circle') == 'Green') {
            $color = ' left-green-color-round';
        } elseif (get_sub_field('color_circle') == 'Red') {
            $color = ' left-red-color-round';
        } elseif (get_sub_field('color_circle') == 'Blue') {
            $color = ' left-blue-color-round';
        } elseif (get_sub_field('color_circle') == 'Yellow') {
            $color = ' left-yellow-color-round';
        }
    }
    ?>

    <section class="common-banner bg-cover<?php echo $color; ?>" style="background-image: url('<?php the_sub_field('image'); ?>');">
        <div class="container">
            <div class="inner d-flex flex-row-wrap">
                <div class="text-block white-text">
                    <?php if (get_sub_field('breadcrumb')) { ?>
                        <div class="custom-breadcrumb d-flex flex-row-wrap align-items-center">
                            <?php
                            global $post;
                            $current = $post->ID;
                            $parent  = $post->post_parent;
                            $url     = get_permalink($parent);
                            if (!empty($parent)) {
                                $parent_title = get_the_title($parent);
                                ?>
                                <a href="<?php echo esc_url($url); ?>"><?php echo $parent_title; ?></a>
	                            <div class="divider">/</div>
                            <?php } ?>
	                        <span><?php the_title(); ?></span>
                        </div>
                    <?php } ?>
                    <h1><?php the_sub_field('heading'); ?></h1>
                    <?php the_sub_field('content'); ?>
                </div>
                <div class="bottom-text d-flex flex-row-wrap align-items-center white-text">
                    <h3><?php the_sub_field('phone'); ?></h3>
                    <?php $btn = get_sub_field('button');
                    if (!empty($btn['url'])) { ?>
                        <a href="<?php echo $btn['url']; ?>" target="<?php echo $btn['target']; ?>" class="connect-btn"><?php echo $btn['title']; ?></a>
                    <?php } ?>
                </div>
            </div>
        </div>
    </section>
<?php endif; ?>