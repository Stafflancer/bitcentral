<?php if( get_row_layout() == 'general_content_with_title_block' ): ?>

<section class="general-content-title-block">
    <div class="container">
    	<?php 
			if(get_sub_field('alignment') == 'Left'){ $alignment = 'text-left'; }
			elseif(get_sub_field('alignment') == 'Center'){ $alignment = 'text-center'; }

			if(get_sub_field('content_width') == '100'){ $width = 'col-lg-12'; }
			elseif(get_sub_field('content_width') == '92'){ $width = 'col-lg-11'; }
			elseif(get_sub_field('content_width') == '83'){ $width = 'col-lg-10'; }
			elseif(get_sub_field('content_width') == '75'){ $width = 'col-lg-8'; }
			elseif(get_sub_field('content_width') == '66'){ $width = 'col-lg-7'; }
		?>
    	<div class="<?php echo $width.' '.$alignment; ?> wrap m-auto"> <!-- 'col-lg-12' 'col-lg-11' 'col-lg-10' 'col-lg-9' 'col-lg-8' 'col-lg-7' 'text-center' 'text-left' -->
            <div class="text-block">
            	<div class="section-title"><?php the_sub_field('label'); ?></div>
                <h2><?php the_sub_field('heading'); ?></h2>
                <?php the_sub_field('content'); ?>
            </div>
        </div>
    </div>
</section>

<?php endif; ?>