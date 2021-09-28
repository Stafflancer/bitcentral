// JavaScript Document
jQuery(".exec-link a").fancybox({
	'hideOnContentClick': true,
	'type' : 'inline',
	'margin' : 0,
	'padding' : 0,
	'border' : 0,
});

function click_hash() {
	var theHash = window.location.hash;
	if (jQuery(theHash).hasClass('exec-link')) {
		window.setTimeout(function(){
			jQuery(theHash+' a.exec-image').click();
		},1000);
	}
}

jQuery(document).ready(function(e) {
   click_hash(); 
});