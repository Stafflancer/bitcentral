jQuery(document).ready(function () {
    eqHeight();

    new WOW().init();

    if (!("ontouchstart" in document.documentElement)) {
        document.documentElement.className += " no-touch";
    } else {
        document.documentElement.className += " touch";
    }

    //Smooth scrolling
    jQuery( 'a[href*="#"]' )
        // Remove links that don't actually link to anything
        .not( '[href="#"]' )
        .not( '[href="javascript:void(0);"]' )
        .not( '.nav-link' )
        .not( '.hero-banner-block a' )
        .click( function () {
            // On-page links
            if (
                location.hostname === this.hostname &&
                location.pathname.replace( /^\//, '' ) === this.pathname.replace( /^\//, '' )
            ) {
                window.location.href = location.protocol + '//' + location.hostname + location.pathname + '/' + this.hash;
            }
        } );

    jQuery( '.hero-banner-block a[href*="#"]' ).click( function ( event ) {
        // On-page links
        if (
            location.hostname === this.hostname &&
            location.pathname.replace( /^\//, '' ) === this.pathname.replace( /^\//, '' )
        ) {
            // Figure out element to scroll to
            var target = jQuery( this.hash );
            // target = target.length ? target : jQuery( '[name=' + this.hash.slice( 1 ) + ']' );

            // Does a scroll target exist?
            if ( target.length ) {
                // Only prevent default if animation is actually gonna happen
                event.preventDefault();
                var headerHeight = jQuery('.site-header').height();

                if (target.hasClass('nav-link')) {
                    target.tab('show');
                }

                jQuery( 'html, body' ).animate( {
                    scrollTop: target.offset().top - headerHeight
                }, 250, function () {
                    // Callback after animation
                    // Must change focus!
                    var jQueryTarget = jQuery( target );
                    jQueryTarget.focus();

                    if ( jQueryTarget.is( ':focus' ) ) { // Checking if the target was focused
                        return false;
                    } else {
                        jQueryTarget.attr( 'tabindex', '-1' ); // Adding tabindex for elements not focusable
                        jQueryTarget.focus(); // Set focus again
                    }
                } );
            }
        }
    });

    if (window.location.hash) {
        // Smooth scroll to the anchor id
        var $target = jQuery(window.location.hash);

        if ( $target.length ) {
            jQuery('html, body').animate({
                scrollTop: 70,
            }, 0, 'swing', function(){
                var headerHeight = jQuery('.site-header').height();

                if ($target.hasClass('nav-link')) {
                    $target.tab('show');
                    $target = jQuery(window.location.hash).closest('.tabbed-content-block');
                }

                jQuery('html, body').animate({
                    scrollTop: $target.offset().top - headerHeight
                }, 100);
            });
        }
    }

    jQuery(".nav-toggle").on("click touchstart", function (event) {
        event.preventDefault();
        event.stopPropagation();
        jQuery("body").toggleClass("menu-open");
        jQuery(".main-navigation ul li").removeClass("open");
    });

    jQuery(".site-header .inner .right-block .search a").on("click", function (event) {
        event.preventDefault();
        event.stopPropagation();
        jQuery("body").toggleClass('search-open');
        jQuery(".site-header .search-form-main").slideToggle();
    });

    if (jQuery('#kenburning').length){
        jQuery('#kenburning').slideshow({
            randomize: false,      // Randomize the play order of the slides.
            slideDuration: 6000,  // Duration of each individual slide.
            fadeDuration: 1000,    // Duration of the fading transition. Should be shorter than slideDuration.
            animate: true,        // Turn css animations on or off.
            pauseOnTabBlur: false, // Pause the slideshow when the tab is out of focus. This prevents glitches with setTimeout().
            enableLog: false      // Enable log messages to the console. Useful for debugging.
        });
    }

    jQuery('.ts-slider').owlCarousel({
        loop: true,
        margin: 0,
        dots: true,
        autoplay: true,
        autoplaySpeed: 300,
        autoplayTimeout: 5000,
        items: 1,
        nav: true,
        autoHeight:true,
        responsiveClass: true
    });

    jQuery('.img-slider').owlCarousel({
        loop: true,
        margin: 0,
        dots: true,
        autoplay: true,
        autoplaySpeed: 300,
        autoplayTimeout: 5000,
        items: 1,
        nav: true,
        autoHeight:true,
        responsiveClass: true
    });

    jQuery('.news-list').owlCarousel({
        loop: true,
        margin: 0,
        dots: true,
        autoplay: false,
        autoplaySpeed: 300,
        autoplayTimeout: 5000,
        items: 1,
        nav: false,
        autoHeight:true,
        responsiveClass: true
    });

    setTimeout(function () {
        jQuery('.content-rows-slides-block .img-slide').owlCarousel({
            loop: true,
            margin: 0,
            dots: true,
            autoplay: false,
            autoplaySpeed: 300,
            autoplayTimeout: 5000,
            items: 1,
            nav: true,
            autoHeight:true,
            responsiveClass: true
        });
    }, 1000);

    jQuery('.awards-slider').owlCarousel({
        loop: true,
        margin: 40,
        dots: true,
        autoplay: false,
        autoplaySpeed: 300,
        autoplayTimeout: 5000,
        items: 4,
        nav: true,
        responsiveClass: true,
        responsive: {
            0: {
                items: 1,
                margin: 0
            },
            480: {
                items: 1,
                margin: 0
            },
            768: {
                items: 2,
                margin: 20
            },
            1024: {
                items: 3,
                margin: 20
            },
            1199: {
                items: 4,
                margin: 30
            },
            1280: {
                items: 4,
                margin: 40
            }
        }
    });

    //jQuery('.site-header .inner .main-navigation ul.menu li').addClass('focus');

    jQuery('#videoModal, #menuvideoModal').on('hidden.bs.modal', function (e) {
        jQuery('video').trigger('pause');
        jQuery("#videoModal iframe").attr("src", jQuery("#videoModal iframe").attr("src"));
    });

    jQuery(".modal.video-modal").each(function(){
        jQuery('.modal').on('hidden.bs.modal', function (e) {
            jQuery(this).find("iframe").attr("src", jQuery(this).find("iframe").attr("src"));
        });
    });
});

jQuery.mb_slider = function(){
    if (jQuery(window).width() < 768)
    {
        jQuery('.columns-icons-block .listing, .support-services-block .listing').owlCarousel({
            loop:false,
            margin:0,
            autoplay:false,
            autoplayTimeout:5000,
            autoplaySpeed:500,
            items:1,
            dots: true,
            nav: false,
            responsiveClass:true,
            autoHeight:true
        });

        jQuery('.benefits-icons-block .listing').owlCarousel({
            loop:false,
            margin:0,
            autoplay:false,
            autoplayTimeout:5000,
            autoplaySpeed:500,
            items:1,
            dots: true,
            nav: false,
            responsiveClass:true,
            autoHeight:true
        });

        jQuery('.logos-block .listing').owlCarousel({
            loop:true,
            margin:0,
            autoplay:false,
            autoplayTimeout:5000,
            autoplaySpeed:500,
            items:2,
            dots: false,
            nav: true,
            responsiveClass:true,
            autoHeight:true
        });
    } else {
        jQuery('.columns-icons-block .listing, .support-services-block .listing,  .benefits-icons-block .listing, .logos-block .listing').owlCarousel('destroy');
    }
}

jQuery(window).on('load', function () {
    eqHeight();
    jQuery.mb_slider();
}).on('resize', function () {
    eqHeight();
    jQuery.mb_slider();
}).on('scroll', function () {
    var sticky = jQuery('.site-header'),
        scroll = jQuery(window).scrollTop();

    (scroll >= 70) ? sticky.addClass('fixed') : sticky.removeClass('fixed');
});

function eqHeight() {
    setTimeout(function () {
        equalHeight('.grid-post .listing .post-col a .content h3');
        equalHeight('.grid-post .listing .post-col a .content p');
        equalHeight('.subpage-cards-color-dot-block .card-col a .text-block');
    }, 300);
}

equalHeight = function (container) {
    if (jQuery(window).width() > 767) {
        var currentTallest = 0,
            currentRowStart = 0,
            rowDivs = [],
            $el,
            topPosition = 0;

        jQuery(container).each(function () {
            $el = jQuery(this);
            jQuery($el).height('auto')
            topPostion = $el.offset().top;

            if (currentRowStart !== topPostion) {
                for (currentDiv = 0; currentDiv < rowDivs.length; currentDiv++) {
                    rowDivs[currentDiv].innerHeight(currentTallest);
                }

                rowDivs.length = 0; // empty the array
                currentRowStart = topPostion;
                currentTallest = $el.innerHeight();
                rowDivs.push($el);
            } else {
                rowDivs.push($el);
                currentTallest = (currentTallest < $el.innerHeight()) ? ($el.innerHeight()) : (currentTallest);
            }

            for (currentDiv = 0; currentDiv < rowDivs.length; currentDiv++) {
                rowDivs[currentDiv].innerHeight(currentTallest);
            }
        });
    } else {
        jQuery(container).height('auto');
    }
};

equalHeightNoAuto = function (container) {
    var currentTallest = 0,
        currentRowStart = 0,
        rowDivs = [],
        $el,
        topPosition = 0;

    jQuery(container).each(function () {
        $el = jQuery(this);
        jQuery($el).height('auto')
        topPostion = $el.offset().top;

        if (currentRowStart !== topPostion) {
            for (currentDiv = 0; currentDiv < rowDivs.length; currentDiv++) {
                rowDivs[currentDiv].innerHeight(currentTallest);
            }
            rowDivs.length = 0; // empty the array
            currentRowStart = topPostion;
            currentTallest = $el.innerHeight();
            rowDivs.push($el);
        } else {
            rowDivs.push($el);
            currentTallest = (currentTallest < $el.innerHeight()) ? ($el.innerHeight()) : (currentTallest);
        }

        for (currentDiv = 0; currentDiv < rowDivs.length; currentDiv++) {
            rowDivs[currentDiv].innerHeight(currentTallest);
        }
    });
};

equalHeightNoRow = function (container) {
    if (jQuery(window).width() > 767) {
        var currentTallest = 0,
            currentRowStart = 0,
            rowDivs = [],
            jQueryel

        jQuery(container).each(function () {
            jQueryel = jQuery(this);
            jQuery(jQueryel).innerHeight('auto')
            rowDivs.push(jQueryel);
            currentTallest = (currentTallest < jQueryel.innerHeight()) ? (jQueryel.innerHeight()) : (currentTallest);

            for (currentDiv = 0; currentDiv < rowDivs.length; currentDiv++) {
                rowDivs[currentDiv].innerHeight(currentTallest);
            }
        });
    } else {
        jQuery(container).height('auto');
    }
}