<?php if( get_row_layout() == 'carousel_with_side_images_block' ): ?>

<section class="carousel-side-images-block">
	<div class="container">
		<div class="wrap m-auto">
			<div class="section-title"><?php the_sub_field('label'); ?></div>
			<div class="listing d-flex flex-row-wrap">
				<div id="sync1" class="owl-carousel owl-theme left-text-slider">
					<?php while( have_rows('slides') ) : the_row(); ?>
					  <div class="item">
						<h3><?php the_sub_field('content'); ?></h3>
					  </div>
					<?php endwhile; wp_reset_postdata(); ?>
				</div>

				<div id="sync2" class="owl-carousel owl-theme right-img-slider">
					<?php while( have_rows('slides') ) : the_row(); ?>
						<div class="item bg-cover" style="background-image: url('<?php the_sub_field('image'); ?>');"></div>
					<?php endwhile; wp_reset_postdata(); ?>
				</div>
			</div>
		</div>
	</div>

	<script type="text/javascript">
		jQuery( document ).ready( function () {
			var sync1 = jQuery( '#sync1' ),
				sync2 = jQuery( '#sync2' ),
				slidesPerPage = 1, // Globally define number of elements per page
				syncedSecondary = true;

			sync1.owlCarousel( {
				items: 1,
				slideSpeed: 2000,
				nav: true,
				autoplay: true,
				dots: true,
				loop: true,
				responsiveRefreshRate: 200,
			} ).on( 'changed.owl.carousel', syncPosition );

			sync2
				.on( 'initialized.owl.carousel', function () {
					sync2.find( '.owl-item' ).eq( 0 ).addClass( 'current' );
				} )
				.owlCarousel( {
					items: slidesPerPage,
					dots: false,
					nav: false,
					smartSpeed: 200,
					slideSpeed: 500,
					slideBy: slidesPerPage, //alternatively you can slide by 1, this way the active slide will stick to the first item in the second carousel
					responsiveRefreshRate: 100
				} ).on( 'changed.owl.carousel', syncPosition2 );

			function syncPosition( el ) {
				//if you set loop to false, you have to restore this next line
				//var current = el.item.index;

				//if you disable loop you have to comment this block
				var count = el.item.count - 1;
				var current = Math.round( el.item.index - (el.item.count / 2) - .5 );

				if ( current < 0 ) {
					current = count;
				}
				if ( current > count ) {
					current = 0;
				}
				//end block

				sync2
					.find( '.owl-item' )
					.removeClass( 'current' )
					.eq( current )
					.addClass( 'current' );
				var onscreen = sync2.find( '.owl-item.active' ).length - 1;
				var start = sync2.find( '.owl-item.active' ).first().index();
				var end = sync2.find( '.owl-item.active' ).last().index();

				if ( current > end ) {
					sync2.data( 'owl.carousel' ).to( current, 100, true );
				}
				if ( current < start ) {
					sync2.data( 'owl.carousel' ).to( current - onscreen, 100, true );
				}
			}

			function syncPosition2( el ) {
				if ( syncedSecondary ) {
					var number = el.item.index;
					sync1.data( 'owl.carousel' ).to( number, 100, true );
				}
			}

			sync2.on( 'click', '.owl-item', function ( e ) {
				e.preventDefault();
				var number = jQuery( this ).index();
				sync1.data( 'owl.carousel' ).to( number, 300, true );
			} );
		} );
	</script>
</section>

<?php endif; ?>