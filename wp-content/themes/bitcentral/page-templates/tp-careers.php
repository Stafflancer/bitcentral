<?php 
/*
Template Name: careers
*/
get_header(); ?>

<section class="common-banner bg-cover" style="background: url('https://dev-bitcentral.pantheonsite.io/wp-content/uploads/2021/02/Careers-banner.png');">
	<div class="container">
		<div class="inner d-flex flex-row-wrap">
			<div class="text-block white-text">
				<div class="custom-breadcrumb d-flex flex-row-wrap align-items-center">
					<span>careers</span>
				</div>
				<h1>H1Headline here</h1>
				<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, do eius mod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad min im veniam, quis nostrud exercitati ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
			</div>
		</div>
	</div>
</section>

<section class="general-content-block">
    <div class="container">
    	<div class="wrap m-auto">
    		<div class="section-title">work here</div>
    	</div>
        <div class="row">
        	<div class="col-lg-7 text-left m-auto"> <!-- 'col-lg-12' 'col-lg-11' 'col-lg-10' 'col-lg-9' 'col-lg-8' 'col-lg-7' 'text-center' 'text-left' -->
                <div class="text-block">
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed sed quam pellentesque, pretium velit eget, ornare nibh. Aliquam et leo quis dolor ultricies tincidunt ac id nulla. Suspendisse potenti. In finibus feugiat urna, eget aliquet augue sollicitudin vel. Ut euismod augue eros, vel aliquam libero euismod vel. In ut ultricies velit. Sed a ultrices ex. Proin pharetra scelerisque ipsum, eget rutrum nisi vulputate vel. Praesent lectus nisi, egestas quis gravida eget, euismod non velit. Donec sit amet fermentum libero. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Praesent feugiat molestie nisl at mollis. Cras interdum quis dolor at rutrum. Aliquam tincidunt purus elit, quis tempus est interdum tristique. Nunc vehicula mi a est volutpat sollicitudin. Donec at dolor lobortis, bibendum lorem sit amet, molestie sapien.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="carousel-side-images-block">
    <div class="container">
        <div class="wrap m-auto">
            <div class="section-title">Our Values</div>
            <div class="listing d-flex flex-row-wrap">
                <div id="sync1" class="owl-carousel owl-theme left-text-slider">
                  <div class="item">
                    <h3>Honesty and integrity are what we stand for</h3>
                  </div>
                  <div class="item">
                    <h3>Honesty and integrity are what we stand for</h3>
                  </div>
                  <div class="item">
                    <h3>Honesty and integrity are what we stand for</h3>
                  </div>
                  <div class="item">
                    <h3>Honesty and integrity are what we stand for</h3>
                  </div>
                </div>

                <div id="sync2" class="owl-carousel owl-theme right-img-slider">
                  <div class="item bg-cover" style="background: url('https://dev-bitcentral.pantheonsite.io/wp-content/uploads/2021/02/Values-img.png');"></div>
                  <div class="item bg-cover" style="background: url('https://dev-bitcentral.pantheonsite.io/wp-content/uploads/2021/02/media-img-9.png');"></div>
                  <div class="item bg-cover" style="background: url('https://dev-bitcentral.pantheonsite.io/wp-content/uploads/2021/02/about-banner-min-3.png');"></div>
                  <div class="item bg-cover" style="background: url('https://dev-bitcentral.pantheonsite.io/wp-content/uploads/2021/02/Wellspring.png');"></div>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        
        jQuery(document).ready(function() {

              var sync1 = jQuery("#sync1");
              var sync2 = jQuery("#sync2");
              var slidesPerPage = 1; //globaly define number of elements per page
              var syncedSecondary = true;

              sync1.owlCarousel({
                items : 1,
                slideSpeed : 2000,
                nav: true,
                autoplay: true,
                dots: true,
                loop: true,
                responsiveRefreshRate : 200,
              }).on('changed.owl.carousel', syncPosition);

              sync2
                .on('initialized.owl.carousel', function () {
                  sync2.find(".owl-item").eq(0).addClass("current");
                })
                .owlCarousel({
                items : slidesPerPage,
                dots: false,
                nav: false,
                smartSpeed: 200,
                slideSpeed : 500,
                slideBy: slidesPerPage, //alternatively you can slide by 1, this way the active slide will stick to the first item in the second carousel
                responsiveRefreshRate : 100
              }).on('changed.owl.carousel', syncPosition2);

              function syncPosition(el) {
                //if you set loop to false, you have to restore this next line
                //var current = el.item.index;
                
                //if you disable loop you have to comment this block
                var count = el.item.count-1;
                var current = Math.round(el.item.index - (el.item.count/2) - .5);
                
                if(current < 0) {
                  current = count;
                }
                if(current > count) {
                  current = 0;
                }
                
                //end block

                sync2
                  .find(".owl-item")
                  .removeClass("current")
                  .eq(current)
                  .addClass("current");
                var onscreen = sync2.find('.owl-item.active').length - 1;
                var start = sync2.find('.owl-item.active').first().index();
                var end = sync2.find('.owl-item.active').last().index();
                
                if (current > end) {
                  sync2.data('owl.carousel').to(current, 100, true);
                }
                if (current < start) {
                  sync2.data('owl.carousel').to(current - onscreen, 100, true);
                }
              }
              
              function syncPosition2(el) {
                if(syncedSecondary) {
                  var number = el.item.index;
                  sync1.data('owl.carousel').to(number, 100, true);
                }
              }
              
              sync2.on("click", ".owl-item", function(e){
                e.preventDefault();
                var number = jQuery(this).index();
                sync1.data('owl.carousel').to(number, 300, true);
              });
            });

    </script>

</section>

<section class="benefits-icons-block">
    <div class="container">
        <div class="title-wrap m-auto">
            <div class="section-title">benefits</div>
        </div>
        <div class="wrap m-auto">
            <div class="listing owl-carousel">
                <div class="item">
                    <div class="icon d-flex align-items-center justify-content-center blue-bg"> <!-- 'red-bg' 'green-bg' 'blue-bg' 'yellow-bg' -->
                        <img src="https://dev-bitcentral.pantheonsite.io/wp-content/uploads/2021/02/benefits-icon.svg">
                    </div>
                    <h3>Lorem ipsum dolor sit amet</h3>
                    <p>Cras euismod vitae tellus eget blandit. Integer mattis auctor nibh ac pharetra. Proin tempus, elit non commodo porttitor, nulla nulla molestie ante, id accumsan purus ligula eu risus. Mauris enim nibh, consectetur varius sapien vel, fermentum consequat mauris.</p>
                </div>
                <div class="item">
                    <div class="icon d-flex align-items-center justify-content-center blue-bg"> <!-- 'red-bg' 'green-bg' 'blue-bg' 'yellow-bg' -->
                        <img src="https://dev-bitcentral.pantheonsite.io/wp-content/uploads/2021/02/benefits-icon.svg">
                    </div>
                    <h3>Lorem ipsum dolor sit amet</h3>
                    <p>Cras euismod vitae tellus eget blandit. Integer mattis auctor nibh ac pharetra. Proin tempus, elit non commodo porttitor, nulla nulla molestie ante, id accumsan purus ligula eu risus. Mauris enim nibh, consectetur varius sapien vel, fermentum consequat mauris.</p>
                </div>
                <div class="item">
                    <div class="icon d-flex align-items-center justify-content-center blue-bg"> <!-- 'red-bg' 'green-bg' 'blue-bg' 'yellow-bg' -->
                        <img src="https://dev-bitcentral.pantheonsite.io/wp-content/uploads/2021/02/benefits-icon.svg">
                    </div>
                    <h3>Lorem ipsum dolor sit amet</h3>
                    <p>Cras euismod vitae tellus eget blandit. Integer mattis auctor nibh ac pharetra. Proin tempus, elit non commodo porttitor, nulla nulla molestie ante, id accumsan purus ligula eu risus. Mauris enim nibh, consectetur varius sapien vel, fermentum consequat mauris.</p>
                </div>
                <div class="item">
                    <div class="icon d-flex align-items-center justify-content-center blue-bg"> <!-- 'red-bg' 'green-bg' 'blue-bg' 'yellow-bg' -->
                        <img src="https://dev-bitcentral.pantheonsite.io/wp-content/uploads/2021/02/benefits-icon.svg">
                    </div>
                    <h3>Lorem ipsum dolor sit amet</h3>
                    <p>Cras euismod vitae tellus eget blandit. Integer mattis auctor nibh ac pharetra. Proin tempus, elit non commodo porttitor, nulla nulla molestie ante, id accumsan purus ligula eu risus. Mauris enim nibh, consectetur varius sapien vel, fermentum consequat mauris.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="job-openings-block">
    <div class="container">
        <div class="wrap m-auto">
            <div class="section-title">Job openings</div>
            <div class="listing">
                <div class="ct-row d-flex flex-row-wrap">
                    <div class="name-col">
                        <h3>Tech Writer – Remote</h3>
                    </div>
                    <div class="text-col">
                        <div class="national">National</div>
                        <p>Full-Time with Benefits</p>
                    </div>
                    <div class="date-col">
                        <div class="date">Nov 20</div>
                        <div class="new">NEW!</div>
                    </div>
                    <div class="link">
                        <div class="common-link-style">
                            <a href="#">
                                learn more
                                <svg xmlns="http://www.w3.org/2000/svg" width="27" height="25" viewBox="0 0 27 25">
                                  <text id="_" data-name="#
                                " transform="matrix(-1, 0, 0, 1, 27, 0)" fill="#00538b" font-size="25" font-family="ElegantIcons" letter-spacing="0.2em"><tspan x="0" y="23">#</tspan></text>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="ct-row d-flex flex-row-wrap">
                    <div class="name-col">
                        <h3>Director, Publisher Development, FUEL</h3>
                    </div>
                    <div class="text-col">
                        <div class="national">National</div>
                        <p>Full-Time with Benefits</p>
                    </div>
                    <div class="date-col">
                        <div class="date">Nov 20</div>
                        <div class="new">NEW!</div>
                    </div>
                    <div class="link">
                        <div class="common-link-style">
                            <a href="#">
                                learn more
                                <svg xmlns="http://www.w3.org/2000/svg" width="27" height="25" viewBox="0 0 27 25">
                                  <text id="_" data-name="#
                                " transform="matrix(-1, 0, 0, 1, 27, 0)" fill="#00538b" font-size="25" font-family="ElegantIcons" letter-spacing="0.2em"><tspan x="0" y="23">#</tspan></text>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="ct-row d-flex flex-row-wrap">
                    <div class="name-col">
                        <h3>Product Marketing Manager – Remote</h3>
                    </div>
                    <div class="text-col">
                        <div class="national">National</div>
                        <p>Full-Time with Benefits</p>
                    </div>
                    <div class="date-col">
                        <div class="date">Nov 20</div>
                        <div class="new">NEW!</div>
                    </div>
                    <div class="link">
                        <div class="common-link-style">
                            <a href="#">
                                learn more
                                <svg xmlns="http://www.w3.org/2000/svg" width="27" height="25" viewBox="0 0 27 25">
                                  <text id="_" data-name="#
                                " transform="matrix(-1, 0, 0, 1, 27, 0)" fill="#00538b" font-size="25" font-family="ElegantIcons" letter-spacing="0.2em"><tspan x="0" y="23">#</tspan></text>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="ct-row d-flex flex-row-wrap">
                    <div class="name-col">
                        <h3>Human Resource Director/HR Business Partner</h3>
                    </div>
                    <div class="text-col">
                        <div class="national">Orange County</div>
                        <p>Full-Time with Benefits</p>
                    </div>
                    <div class="date-col">
                        <div class="date">Nov 20</div>
                        <div class="new">NEW!</div>
                    </div>
                    <div class="link">
                        <div class="common-link-style">
                            <a href="#">
                                learn more
                                <svg xmlns="http://www.w3.org/2000/svg" width="27" height="25" viewBox="0 0 27 25">
                                  <text id="_" data-name="#
                                " transform="matrix(-1, 0, 0, 1, 27, 0)" fill="#00538b" font-size="25" font-family="ElegantIcons" letter-spacing="0.2em"><tspan x="0" y="23">#</tspan></text>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="ct-row d-flex flex-row-wrap">
                    <div class="name-col">
                        <h3>Sr. Director of Sales – Remote</h3>
                    </div>
                    <div class="text-col">
                        <div class="national">National</div>
                        <p>Full-Time with Benefits</p>
                    </div>
                    <div class="date-col">
                        <div class="date">Nov 20</div>
                        <div class="new">NEW!</div>
                    </div>
                    <div class="link">
                        <div class="common-link-style">
                            <a href="#">
                                learn more
                                <svg xmlns="http://www.w3.org/2000/svg" width="27" height="25" viewBox="0 0 27 25">
                                  <text id="_" data-name="#
                                " transform="matrix(-1, 0, 0, 1, 27, 0)" fill="#00538b" font-size="25" font-family="ElegantIcons" letter-spacing="0.2em"><tspan x="0" y="23">#</tspan></text>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="bottom-line">
                <p>We are always looking for good people to join our team and to send their resumes to  <a href="mailto:hr@bitcentral.com">hr@bitcentral.com</a></p>
            </div>
        </div>
    </div>
</section>


<?php get_footer(); ?>