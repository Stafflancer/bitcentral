<?php if( get_row_layout() == 'contact_us_links_block' ): ?>

<section class="contact-links-block">
	<div class="container">
		<div class="row">
			<?php $count=0; while( have_rows('columns') ) : the_row(); ?>
				<div class="col-lg-6">
					<div class="img-block">
						<div class="inside-img">
							<div class="img bg-cover" style="background-image: url('<?php the_sub_field('image'); ?>');"></div>
						</div>
						<?php
						if($count == '0'){$class= 'common-green-btn'; }else{$class= 'common-btn'; }
						$btn = get_sub_field('button');
						if(!empty($btn['url'])){ ?>
							<a href="<?php echo $btn['url']; ?>" class="<?php echo $class; ?>"><?php echo $btn['title']; ?></a>
						<?php } ?>
					</div>
				</div>
			<?php $count++; endwhile; wp_reset_postdata(); ?>
		</div>
	</div>
</section>

<?php endif; ?>