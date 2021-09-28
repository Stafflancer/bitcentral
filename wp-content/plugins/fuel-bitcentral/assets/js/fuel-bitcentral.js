jQuery(document).on('ready', function () {
    jQuery('.fuel-related-carousel-tiles-ul').slick({
        dots: false,
        infinite: false,
        centerMode: false,
        speed: 600,
        slidesToShow: 4,
        slidesToScroll: 1,
        responsive: [
            {
                breakpoint: 1024,
                settings: {
                    slidesToShow: 3,
                    slidesToScroll: 1
                }
            },
            {
                breakpoint: 600,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 1
                }
            },
            {
                breakpoint: 480,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1
                }
            }
        ]
    });

    jQuery('.fuel-overlaper').click(function () {
        jQuery('.fuel-popup-video').html('');
        jQuery('.fuel-popup-container').hide();
    });

    jQuery('.fuel-gallery-tlies-anchor').click(function (e) {
        e.preventDefault();
        var current = jQuery(this);
        var fuel_id = current.parent('li').attr('data-tile');
        jQuery.ajax({
            type: "post",
            dataType: "json",
            url: fuelajax.ajaxurl,
            data: {action: "fuel_player", fuel_id: fuel_id},
            beforeSend: function () {
                current.parents('.fuel-bitcentral-gallery').find('.fuel-gallery-player-main').html('');
                jQuery('html, body').animate({scrollTop: jQuery(".fuel-bitcentral-gallery").position().top}, 'slow');
                jQuery('.fuel-gallery-player-loader').show();

            },
            complete: function () {
                jQuery('.fuel-gallery-player-loader').hide();
            },
            success: function (response) {
                if (response.response == "success") {
                    current.parents('.fuel-bitcentral-gallery').find('.fuel-gallery-player-main').html(htmlDecode(response.player));
                    current.parents('.fuel-bitcentral-gallery').find('.fuel-gallery-player-caption').remove();

                } else {
                    alert("Error");
                }
            }
        });
    });

    jQuery('.shortcode-video').parents('.vc_row-fluid').css("overflow", "unset");

});

function htmlDecode(value) {
    return jQuery('<div/>').html(value).text();
}



var a2a_config = a2a_config || {};
a2a_config.num_services = 4;
a2a_config.prioritize = ["facebook", "twitter", "linkedin", "email"];

function socialWindow(url) {
    var left = (screen.width - 570) / 2;
    var top = (screen.height - 570) / 2;
    var params = "menubar=no,toolbar=no,status=no,width=570,height=570,top=" + top + ",left=" + left;
    window.open(url, "NewWindow", params);
}

jQuery(document).ready(function () {



});

jQuery('body').append("<div class='fuel-share-popup-wrap'></div>");

jQuery(".fa-share").click(function () {
    jQuery(".fuel-share-popup-wrap").show();
    var _post_url = jQuery(this).attr('post-url');
    var _post_title = jQuery(this).attr('post-title');
    var _embed_shortcode = jQuery(this).attr('embed-shortcode');
    var _social_shortcode = jQuery(this).attr('social-share');
    var _is_tile = jQuery(this).attr('is-tiles');
    var _social_options = JSON.parse(jQuery(this).attr('social-options'));

    var fule_share_popup = '<div class="fuel-share-popup-container">';
    fule_share_popup += '<div class="fuel-share-text">Share</div>';
    fule_share_popup += '<div class="fuel-share-close">X</div>';
    fule_share_popup += '<ul>';
    if (_embed_shortcode == 'on' && _is_tile == '') {
        fule_share_popup += '<li class="social-share fuel-embed"><a href="javascript:void(0);" onclick="copyToClipboardFUEL(\'.fuel_embeded_code\');"><span class="fuel-social-share fuel-embed-icon"><i class="fas fa-code"></i><span class="fuel-share-icon-text">Embed</span></span></a></li>';
    }
    if (_social_shortcode == 'on') {
        if (_social_options.facebook == 'on') {
            fule_share_popup += '<li class="social-share facebook" fb-post-url="' + _post_url + '"><span class="fuel-social-share fuel-facebook-icon"><i class="fab fa-facebook-f"></i><span class="fuel-share-icon-text">Facebook</span></span></li>';
        }
        if (_social_options.twitter == 'on') {
            fule_share_popup += '<li class="social-share twitter" tw-post-url="' + _post_url + '" tw-post-title="' + _post_title + '"><span class="fuel-social-share fuel-twitter-icon"><i class="fab fa-twitter"></i><span class="fuel-share-icon-text">Twitter</span></span></li>';
        }
        if (_social_options.linkedin == 'on') {
            fule_share_popup += '<li class="social-share linkedin" li-post-url="' + _post_url + '"><span class="fuel-social-share fuel-linkedin-icon"><i class="fab fa-linkedin-in"></i><span class="fuel-share-icon-text">Linkedin</span></span></li>';
        }
        if (_social_options.email == 'on') {
            fule_share_popup += '<li class="social-share fuel-email"><a href="mailto:?subject=' + _post_title + '&body=' + _post_url + '"><span class="fuel-social-share fuel-email-icon"><i class="fas fa-envelope"></i><span class="fuel-share-icon-text">Email</span></span></a></li>';
        }
    }
    
    fule_share_popup += '</ul>';
    fule_share_popup += '<div class="fuel-embed-massege">Embed code is copied to clipboard</div>';
    fule_share_popup += '</div>';

    jQuery(".fuel-share-popup-wrap").html(fule_share_popup);

    jQuery(".social-share.facebook").on("click", function () {
        var facebookUrl = jQuery(this).attr("fb-post-url");
        var FBurl = "https://www.facebook.com/sharer.php?u=" + facebookUrl;
        socialWindow(FBurl);
    });

    jQuery(".social-share.twitter").on("click", function () {
        var TwitterUrl = jQuery(this).attr("tw-post-url");
        var Twittertext = jQuery(this).attr("tw-post-title");
        TWurl = "https://twitter.com/intent/tweet?url=" + TwitterUrl + "&text=" + Twittertext;
        socialWindow(TWurl);
    });

    jQuery(".social-share.linkedin").on("click", function () {
        var LinkInUrl = jQuery(this).attr("li-post-url");
        LIurl = "https://www.linkedin.com/shareArticle?mini=true&url=" + LinkInUrl;
        socialWindow(LIurl);
    });

    jQuery(".fuel-share-close").click(function () {
        jQuery(".fuel-share-popup-wrap").hide();
        jQuery(".fuel-share-popup-wrap").html('');
    });
});

function copyToClipboardFUEL(element) {
    var tempFUELplayer = jQuery('<input>');
    jQuery('body').append(tempFUELplayer);
    tempFUELplayer.val(jQuery(element).val()).select();
    document.execCommand('copy');
    tempFUELplayer.remove();

    jQuery('.fuel-embed-massege').fadeIn("fast", function () {
        jQuery(".fuel-embed-massege").fadeOut(2000);
    });

    return false;

}

jQuery('body').on('click', '.fuel-share-area a', function () {
    jQuery('.fuel-share-popup-wrap').append('<div class="pop-overlay">');
}).on('click', '.fuel-share-popup-wrap .pop-overlay', function () {
    jQuery('.fuel-share-popup-wrap').hide();
});