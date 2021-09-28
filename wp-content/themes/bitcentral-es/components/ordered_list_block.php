<?php if( get_row_layout() == 'ordered_list_block' ): ?>

<section class="ordered-list-block">
    <div class="container">
        <div class="wrap m-auto">
            <div class="title-block">
                <div class="section-title"><?php the_sub_field('label'); ?></div>
                <h2><?php the_sub_field('heading'); ?></h2>
            </div>
        </div>
        <div class="listing m-auto">
            <div class="inside d-flex flex-row-wrap">
            	<?php while( have_rows('list') ) : the_row(); ?>
	                <div class="text-block d-flex flex-row-wrap">
	                	<?php if(get_sub_field('color')  == 'Red'){$color = 'red-border';}
	                		elseif(get_sub_field('color')  == 'Green'){$color = 'green-border';}
	                		elseif(get_sub_field('color')  == 'Blue'){$color = 'blue-border';}
	                		elseif(get_sub_field('color')  == 'Yellow'){$color = 'yellow-border';}
	                		elseif(get_sub_field('color')  == 'Black'){$color = 'black-border';}
	                		elseif(get_sub_field('color')  == 'Grey'){$color = 'grey-border';}
	                	?>
	                    <div class="icon <?php echo $color; ?>"></div> <!-- 'red-border' 'green-border' 'blue-border' 'yellow-border' 'black-border' 'grey-border' -->
	                    <div class="content">
	                        <h3><?php the_sub_field('heading'); ?></h3>
	                        <?php the_sub_field('content'); ?>
	                    </div>
	                </div>
	            <?php endwhile; wp_reset_postdata(); ?>
            </div>
        </div>
    </div>
</section>

<?php endif; ?>