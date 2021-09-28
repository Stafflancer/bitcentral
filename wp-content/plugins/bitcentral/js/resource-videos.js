// JavaScript Document
var bc_iframe = document.querySelector('.resource-video-iframe iframe');

var bc_player = new Vimeo.Player(bc_iframe);
var bc_visible = false;

jQuery(document).ready(function () {
    //set default video
    var that = this;
    var defaultVid = jQuery('.resource-video-iframe').attr('data-id');
	
	console.log("doc ready start");

    function queryParameters() {
        var result = {};

        var params = window.location.search.split(/\?|\&/);

        params.forEach(function (it) {
            if (it) {
                var param = it.split("=");
                result[param[0]] = param[1];
            }
        });

        return result;
    }
    var hash = location.hash;
    var videoID = 0;
	if (queryParameters().video) {
        videoID = queryParameters().video;
        defaultVid = videoID;
        console.log('defaultVid: '+ videoID);
    } else {
        defaultVid = jQuery('.resource-video-iframe').attr('data-id');
        console.log('defaultVid not found: '+ defaultVid);
    }
    jQuery('#resource-video-' + defaultVid).addClass('resource-video-current');

    //show player function
    var showPlayer = function () {
        jQuery('.resource-video-iframe').css('z-index', 5);
        bc_visible = true;
    };
    var hidePlayer = function () {
        jQuery('.resource-video-iframe').css('z-index', 0);
        bc_visible = false;
        bc_player.pause();
    };
    var startPlayer = function () {
        bc_player.play();
		scrollToVideo();
    };
    var showAndPlay = function () {
        showPlayer();
        startPlayer();
    };
    var swapVideo = function (vid_id) {
        var video_obj = resource_videos[vid_id];
        var vid_title = video_obj.title;
        var vid_img = video_obj.vid_img;
        var vid_descr = video_obj.vid_descr;
        var vimeo_id = video_obj.vimeo_id;
        jQuery('.resource-video-iframe').attr('data-id', vid_id);
        if(queryParameters().video){
            jQuery('.resource-video-iframe iframe').attr('src', 'https://player.vimeo.com/video/' + vimeo_id);
            jQuery('.resource-video-iframe iframe').attr('data-vimeo-autoplay',true);
            jQuery('.resource-video-iframe iframe').attr('data-vimeo-muted',true);
            
        }else{
            jQuery('.resource-video-iframe iframe').attr('src', 'https://player.vimeo.com/video/' + vimeo_id);
        }
        jQuery('.resource-video-player-img img').attr('src', vid_img);
        jQuery('.resource-video-player-title').html(vid_title);
    };

    var clickActiveVideo = function () {
        jQuery('html, body').animate({
            scrollTop: (jQuery('.resource-video-iframe').offset().top - 50)
        }, 500, showAndPlay);
    };
    var clickInactiveVideo = function () {
        jQuery('html, body').animate({
            scrollTop: (jQuery('.resource-video-iframe').offset().top - 50)
        }, 500, showPlayer);
    };
	var scrollToVideo = function () {
		console.log("scrolling offset");
        jQuery('html, body').animate({
            scrollTop: (jQuery('.resource-video-iframe').offset().top - 50)
        }, 500, showPlayer);

    };
    var onEnded = hidePlayer;

    //play video from video player
    jQuery('.resource-video-player-img,.resource-video-player-caption,.resource-video-player h2').on('click', showAndPlay);
    //play video
    jQuery('.resource-video-desktop').on('click', function () {
        if (jQuery(this).hasClass('resource-video-current')) {
            clickActiveVideo();
            console.log("if");
        } else {
            console.log("else");
            var vid_id = jQuery(this).attr('data-id');
            jQuery('.resource-video-current').removeClass('resource-video-current');
            jQuery(this).addClass('resource-video-current');
            jQuery('.resource-video-iframe iframe').on('load', function () {
                bc_player.off('ended');
                delete bc_player;
                bc_player = new Vimeo.Player(document.querySelector('.resource-video-iframe iframe'));
                //jQuery('.resource-video-player-img,.resource-video-player-caption,.resource-video-player h2').on('click',showAndPlay);
                bc_player.on('ended', function () {
                    jQuery('.resource-video-iframe').css('z-index', 0);

                    bc_visible = false;
                });
            });
            swapVideo(vid_id);
            scrollToVideo();
            //hidePlayer();
           jQuery(".resource-video-player-img,.resource-video-player-caption,.resource-video-player h2").trigger("click",showAndPlay);
           
        }
    });
    bc_player.on('ended', hidePlayer);

    var resizeResourceVid;
    var mobileSize = jQuery(window).width() <= 768 ? true : false;
    jQuery(window).resize(function () {
        window.clearTimeout(resizeResourceVid);
        if (jQuery(window).width() <= 768 && mobileSize == false) {
            resizeResourceVid = window.setTimeout(function () {
                hidePlayer();
                mobileSize = true;
            }, 500);
        } else if (jQuery(window).width() > 768 && mobileSize == true) {
            mobileSize = false;
        }
    });
    
    if (videoID != "" && !mobileSize) {
        swapVideo(videoID);
        showAndPlay();        
    }
    else if(videoID != "" && mobileSize){
        jQuery("#resource-video-mobile-"+queryParameters().video+" .resource-video-img-wrapper a").fancybox().trigger("click");
    }
    // if(hash == "#video-gallery"){
    //     showAndPlay();
    // }
    // var showvg = true;
    // jQuery(window).scroll(function() {
    //    var hT = jQuery('#video-gallery').offset().top,
    //        hH = jQuery('#video-gallery').outerHeight(),
    //        wH = jQuery(window).height(),
    //        wS = jQuery(this).scrollTop();
    //        if (wS >= (hT+hH-wH)){
    //             if(showvg){
    //                 showAndPlay();
    //             }
    //             showvg = false;
    //        }
    // });

});

jQuery(".resource-video-mobile a").fancybox({
    
});

