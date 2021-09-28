<?php if (get_row_layout() == 'tabbed_content_block'):
    $label_slug   = sanitize_title(get_sub_field('label'));
	?>
	<section class="tabbed-content-block">
		<div class="container">
			<div class="wrap m-auto">
				<div class="section-title"><?php the_sub_field('label'); ?></div>
			</div>
		</div>
		<div class="tab-list">
			<ul class="nav nav-tabs" id="myTab" role="tablist">
                <?php
                $cnt = 0;
                while (have_rows('tabs')) : the_row();
                    $active       = ($cnt == 0) ? ' active' : '';
                    $heading_slug = sanitize_title(get_sub_field('heading'));
                    ?>
					<li class="nav-item">
						<a id="<?php echo $heading_slug; ?>" class="nav-link<?php echo $active; ?>" data-toggle="tab"
						   href="#tab-<?php echo $label_slug.'-'.$cnt; ?>" role="tab" aria-controls="control-<?php echo $cnt; ?>"
						   aria-selected="true"><?php the_sub_field('heading'); ?></a>
					</li>
                    <?php $cnt++; endwhile;
                wp_reset_postdata(); ?>
			</ul>

			<div id="<?php echo $label_slug; ?>" class="tab-content">
                <?php
                $cnt = 0;
                while (have_rows('tabs')) : the_row();
                    $active = ($cnt == 0) ? ' show active' : '';
                    ?>
					<div class="tab-pane fade<?php echo $active; ?>" id="tab-<?php echo $label_slug.'-'.$cnt; ?>" role="tabpanel" aria-labelledby="<?php echo $heading_slug; ?>">
						<div class="img bg-cover" style="background-image: url('<?php the_sub_field('image'); ?>');"></div>
						<div class="content d-flex flex-row-wrap">
							<div class="col-lg-6 p-0">
								<div class="left-col no-dot">
									<div class="text">
                                        <?php the_sub_field('left_content'); ?>
									</div>
								</div>
							</div>
							<div class="col-lg-6 p-0">
								<div class="right-col">
									<div class="text">
                                        <?php the_sub_field('right_content'); ?>
									</div>
								</div>
							</div>
							<div class="col-lg-12 p-0">
								<div class="bottom-content">
                                    <?php the_sub_field('bottom_content'); ?>
								</div>
							</div>
						</div>
					</div>
                    <?php
	                $cnt++;
                    endwhile;
                wp_reset_postdata(); ?>
			</div>
		</div>
	</section>
<?php endif; ?>