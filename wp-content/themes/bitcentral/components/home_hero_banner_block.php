<?php if( get_row_layout() == 'home_hero_banner_block' ):
	$single_image = get_sub_field('image');
?>

<section class="hero-banner-block bg-cover no-transition" style="background-image: url('<?php echo $single_image[0]; ?>');">
	<div class="container">
		<div class="inner d-flex flex-wrap align-items-center">
			<div class="text-block white-text">
				<p><?php the_sub_field('tagline'); ?></p>
				<h1><?php the_sub_field('heading'); ?></h1>
				<div class="bottom-btn">
					<?php while( have_rows('buttons') ) : the_row(); ?>
						<?php $btn = get_sub_field('button');
						if(!empty($btn['url'])){ ?>
							<a href="<?php echo $btn['url']; ?>" class="common-border-btn"><?php echo $btn['title']; ?></a>
						<?php } ?>
					<?php endwhile; wp_reset_postdata(); ?>
				</div>
			</div>
		</div>
	</div>
	<div id="kenburning" class="bg-slider">
		<?php $count = 0; $images = get_sub_field('image');
		    foreach( $images as $image_id ):
		    if($count % 2 == 0){$class = 'in';}else{$class='out';}
		?>
		  <div class="slide">
	        <span class="animate <?php echo $class; ?>" style="background-image: url('<?php echo $image_id; ?>')"></span>
	      </div>
	    <?php $count++; endforeach; ?>
	</div>
</section>

<?php endif; ?>