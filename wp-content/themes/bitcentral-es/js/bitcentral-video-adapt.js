// JavaScript Document

// Resize
function bc_vid_adapt() {
	var bc_vid_container = document.getElementById( 'bc_vid_container' );
	var bc_vid_video = document.getElementById( 'bc_vid_video' );

	var container_width = bc_vid_container.offsetWidth;
	var container_height = bc_vid_container.offsetHeight;

	bc_vid_video.style.height = 'auto';
	bc_vid_video.style.width = container_width + 'px';

	if ( bc_vid_video.offsetHeight < container_height ) {
		bc_vid_video.style.height = container_height + 'px';
		bc_vid_video.style.width = 'auto';
	}

	//video
	bc_vid_video.style.top = (((bc_vid_video.offsetHeight - container_height) / 2) * -1) + 'px';
	bc_vid_video.style.left = (((bc_vid_video.offsetWidth - container_width) / 2) * -1) + 'px';
}

// events
window.addEventListener( 'load', function () {
	bc_vid_adapt();
	window.setTimeout( bc_vid_adapt(), 1000 );
	//window.setTimeout(bc_vid_adapt(),5000);
	window.addEventListener( 'resize', bc_vid_adapt );
} );