// JavaScript Document
jQuery(document).on('ready', function() {
	jQuery(".slick-slider-posts").slick({
		dots: false,
		infinite: false,
		slidesToShow: 3,
		slidesToScroll: 3,
		nextArrow: '<div class="slick-next"><div class="post-next-button">&gt;</button></div>',
		prevArrow: '<div class="slick-prev"><div class="post-prev-button">&lt;</button></div>',
		responsive: [
			{
			  breakpoint: 768,
			  settings: {
				slidesToShow: 2,
				slidesToScroll: 2
			  }
			}
		]
	});
	jQuery('.slick-slider-posts').on('init reInit setPosition', function(slick){
		//jQuery(this).height(jQuery(this).height());
		var maxHeight = 1;
		jQuery(this).find('.slick-slide').each(function() {
			jQuery(this).height('auto');
			maxHeight = maxHeight > jQuery(this).height() ? maxHeight : jQuery(this).height();
		});
	
		jQuery(this).find('.slick-slide').each(function() {
			jQuery(this).height(maxHeight);
		});
	});
	var resizeSlick;
	jQuery(window).resize(function() {
        window.clearTimeout(resizeSlick);
		resizeSlick = window.setTimeout(function(){
			jQuery('.slick-slider-posts').slick('setPosition');
		},500);
    });
});