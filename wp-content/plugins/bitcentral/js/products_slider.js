// JavaScript Document
jQuery(document).on('ready', function() {
	jQuery(".slick-slider-center").slick({
		dots: false,
		infinite: true,
		centerMode: true,
		slidesToShow: 1,
		slidesToScroll: 3,
		variableWidth: true,
		initialSlide: parseInt(jQuery('.slick-slider-center').attr('initialslide')),
		nextArrow: '<div class="slick-custom-next"><div class="product-next-button">&gt;</button></div>',
		prevArrow: '<div class="slick-custom-prev"><div class="product-prev-button">&lt;</button></div>',
	});
	var resizeSlick;
	jQuery(window).resize(function() {
		window.clearTimeout(resizeSlick);
		resizeSlick = window.setTimeout(function(){
			jQuery('.slick-slider-center').slick('setPosition');
		},500);
	});
});
jQuery('.product-ui-zoom').fancybox();