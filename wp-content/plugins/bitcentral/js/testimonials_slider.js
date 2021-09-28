// JavaScript Document

/*jQuery(document).ready(function(){
  jQuery('.slick-slider-testi').slick();
});
*/


jQuery(document).on('ready', function() {
	"use strict";
	jQuery(".slick-slider-testimonials").slick({
		dots: false,
		infinite: true,
		slidesToShow: 1,
		slidesToScroll: 1,
		arrows: true,
		//nextArrow: '<div class="slick-custom-next"><div class="post-next-button">&gt;</button></div>',
		//prevArrow: '<div class="slick-custom-prev"><div class="post-prev-button">&lt;</button></div>',
	});
	var resizeSlick;
	jQuery(window).resize(function() {
        window.clearTimeout(resizeSlick);
		resizeSlick = window.setTimeout(function(){
			jQuery('.slick-slider-testimonials').slick('setPosition');
		},500);
    });
});