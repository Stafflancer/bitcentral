<?php
//Product UI
function render_products_slider($atts) {
	
	/*echo "<pre>";
	print_r($atts);
	echo "</pre>";*/
	
	$c_lang = WPGlobus::Config()->language;
    
	$download_brochure_btn = get_theme_mod( 'custom_setting_btn2');
	$schedule_demo_btn = get_theme_mod( 'custom_setting_btn3');
	
	
	
	$download_brochure_btn = ( !empty($download_brochure_btn)   ?   apply_filters( 'the_title', $download_brochure_btn )   :   '' );
	$schedule_demo_btn = ( !empty($schedule_demo_btn)   ?   apply_filters( 'the_title', $schedule_demo_btn )   :   '' );

	
	

	$initial = (isset($atts['initial']) ? $atts['initial'] : NULL); //$initial = $atts['initial'] ? $atts['initial'] : NULL;
	$initialSlide = 0;
	$gotoSlide = 0;
	$cur_post_type = get_post_type();
	//echo $cur_post_type;
	$slug = ( !empty($cur_post_type) && $cur_post_type == 'product'  ?  $initial  :  '');
	
	wp_enqueue_style('slick_css',plugins_url( '/css/slick.css', __FILE__ ),array(),"0.201");
	wp_enqueue_script( 'slick_js', plugins_url( '/js/slick.min.js', __FILE__ ));
	wp_enqueue_script( 'products_slider_js', plugins_url( '/js/products_slider.js', __FILE__ ),array(),"0.50");
	
	$q_args = array(
			'name'        => $slug,
			'post_type'	=> 'product',
			'post_status' => 'publish',
			'orderby'	=> 'title',
			'order'		=> 'ASC',
			'posts_per_page'	=> -1,
			'meta_query'    => array(
				array(
					'key'       => 'product_ui',
					'value'     => '1',
					'compare'   => '=',
				),
			)
		);
		
		
		# get intial slide index
		$post_list = get_posts($q_args);
		foreach ( $post_list as $product) {		
					
			$gallery_images = acf_photo_gallery('ui_screenshot_gallery', $product->ID);
		
			if( count($gallery_images) ) {
				foreach($gallery_images as $image) {
					if($product->post_name==$initial && $gotoSlide==0 ){
						$gotoSlide = $initialSlide;
					}
					$initialSlide++;
				}
			}			
		}
	
	
		/*echo "<pre>";
		print_r($slideIndex);
		print_r($atts);
		print_r($q_args);
		echo "<br>".$gotoSlide;
		echo "</pre>";*/
		
		
		
		
		
		$html = '<section class="slick-slider-center slick-slider slide-desc" initialslide="'.$gotoSlide.'">';
		
		$post_query = new WP_Query( $q_args );
		
		// The Loop
		if ( $post_query->have_posts() ) {
			while ( $post_query->have_posts() ) {
				$post_query->the_post();
				$post_id = get_the_id();
				$post_title = get_the_title();
				$post_url = get_the_permalink();
				$post_logo_id = get_post_meta($post_id,'ui_logo',true);
				$post_logo = wp_get_attachment_image_src($post_logo_id,'full',false);				
				$post_descr = get_the_excerpt($post_id);
				$resource_id = get_post_meta($post_id,'product_brochure',true);
				$product_description = get_field('product_slider_description');
				if ($resource_id) {
					$resource = get_post($resource_id);
					$resource_slug = $resource->post_name;

					//$resource_url = '/'.$c_lang.'/resources/download/?form_resource='.$resource_slug;
					$url_slug = get_permalink(11239);
					$url_slug = apply_filters( 'the_title', $url_slug );
					$resource_url = $url_slug.'?form_resource='.$resource_slug;
					
					$url_schedule = get_permalink(11222);
					$url_schedule = apply_filters( 'the_title', $url_schedule );
					
				} else {
					$resource_url = $post_url;
				}
				
				$gallery_images = acf_photo_gallery('ui_screenshot_gallery', $post_id);
				
				
				if( count($gallery_images) ) {
					foreach($gallery_images as $image) {
							
							$post_slide_id = $image['id'];
							$post_slide = wp_get_attachment_image_src($post_slide_id,'product-slide',false);
							$post_slide_full = array($image['full_image_url']);
							
							$html .= '
							 <div>
							  <a href="'.$post_slide_full[0].'" class="slick-img product-ui-zoom" data-fancybox="images">
								<img src="'.$post_slide[0].'" alt="Central Control Screenshot">
								<div class="slick-extra slick-zoom"><i class="fa fa-search-plus"></i></div>
							  </a>
							  
							  <div class="slick-info slick-extra">
								<a href="'.$post_url.'"><img src="'.$post_logo[0].'" alt="'.$post_title.'" /></a>
								
								<div class="bc_social_icons">
									<div class="bc_social_icon">
										<span class="fa fa-twitter"></span>
										<a class="bc_icon_element-link js-share" href="https://twitter.com/share?text='.urlencode($post_title.'™ - Bitcentral: '.$post_descr).'&url='.urlencode($post_url).'" title="Twitter"></a>
									</div>
									<div class="bc_social_icon">
										<span class="fa fa-linkedin"></span>
										<a class="bc_icon_element-link js-share" href="https://www.linkedin.com/shareArticle?mini=true&url='.urlencode($post_url).'&title='.urlencode($post_title.'™ - Bitcentral ').'&summary='.urlencode($post_descr).'&source=Bitcentral" title="LinkedIn"></a>
									</div>
									<div class="bc_social_icon">
										<span class="fa fa-facebook"></span>
										<a class="bc_icon_element-link js-share" href="https://www.facebook.com/sharer/sharer.php?u='.urlencode($post_url).'" title="Facebook"></a>
									</div>
								</div>
								
								<div class="vc_btn3-container download-button vc_btn3-center up-btn">
									<a style="background-color:#a4343a; color:#ffffff;" class="vc_general vc_btn3 vc_btn3-size-md vc_btn3-shape-square vc_btn3-style-custom" href="'.$resource_url.'">'.$download_brochure_btn.'</a>
								</div>
								
								<div class="vc_btn3-container download-button vc_btn3-center">
									<a style="background-color:#a4343a; color:#ffffff;" class="vc_general vc_btn3 vc_btn3-size-md vc_btn3-shape-square vc_btn3-style-custom" href="'.$url_schedule.'">'.$schedule_demo_btn.'</a>
								</div>
								<div class="product-description">
									<p>'.$product_description.'</p>
								</div>
							  </div>
							  
							</div>';
					}
				}
			}
			
			/* Restore original Post Data */
			wp_reset_postdata();
		}
	
	$html .= '</section>
  <div class="clearfix"><div></div></div>
  ';
  $string = trim(preg_replace('/\s+/', ' ', $html));
  return $string;
	
}
add_shortcode( 'products_slider', 'render_products_slider', 100 );

function render_product_brochure() {
	global $post;
	
	$c_lang = WPGlobus::Config()->language;
	$download_brochure_btn = get_theme_mod( 'custom_setting_btn1');
	$download_brochure_btn = ( !empty($download_brochure_btn)   ?   apply_filters( 'the_title', $download_brochure_btn )   :   '' );
	
	$post_id = $post->ID;
	$resource_id = get_post_meta($post_id,'product_brochure',true);
	$default_img = 11398;
	if ($resource_id) {
		$resource = get_post($resource_id);
		$resource_slug = $resource->post_name;
		$resource_title = $resource->post_title;

		$url_slug = get_permalink(11239);
		$url_slug = apply_filters( 'the_title', $url_slug );
		
		// $resource_url = '/'.$c_lang.'/resources/download/?form_resource='.$resource_slug;
		$resource_url = $url_slug.'?form_resource='.$resource_slug;
	} else {
		return;
	};
	$resource_thumb_id = get_post_thumbnail_id($resource_id) ? get_post_thumbnail_id($resource_id) : $default_img;
	$resource_img_attr = array('alt' => $resource_title);
	$resource_img = wp_get_attachment_image($resource_thumb_id,'medium',false,$resource_img_attr);
	$html = '
	<div class="product-brochure">
		<div class="wpb_single_image vc_align_center">
			<a href="'.$resource_url.'">
				'.$resource_img.'
			</a>
		</div>
		<div class="vc_btn3-container download-button vc_btn3-center">
			<a style="background-color:#a4343a; color:#ffffff;" class="vc_general vc_btn3 vc_btn3-size-md vc_btn3-icon-right" href="'.$resource_url.'" title="Download PDF">'.$download_brochure_btn.' <i class="vc_btn3-icon fa fa-arrow-circle-o-down"></i></a>
		</div>
	</div>';
	return $html;
}
add_shortcode( 'product-brochure', 'render_product_brochure' );

function render_product_solution_divider() {
	return '<span class="product-solution-divider"></span>';
}
add_shortcode( 'product-solution-divider', 'render_product_solution_divider' );

function render_bc_video_capture() {
	$return = do_shortcode('[vc_row full_width="stretch_row_content_no_spaces"][vc_column parallax="content-moving" parallax_image="10585" parallax_speed_bg="1.25" el_class="product-video-clip"][vc_single_image image="10585" img_size="full" alignment="center" onclick="custom_link" link="#video-link"][vc_row_inner el_class="product-video-clip-caption"][vc_column_inner][vc_column_text]
<h2>Spotlight on Core News</h2>
[/vc_column_text][/vc_column_inner][/vc_row_inner][/vc_column][/vc_row]');
	return $return;
}
add_shortcode( 'bc-video-capture', 'render_bc_video_capture' );

//posts & resources
function render_posts_slider($atts) {
	$post_type = $atts['post-type'] ? $atts['post-type'] : 'post';

	wp_enqueue_script( 'slick_js', plugins_url( '/js/slick.min.js', __FILE__ ));
	wp_enqueue_script( 'posts_slider_js', plugins_url( '/js/posts_slider.js', __FILE__ ),array(),"0.137");
	wp_enqueue_style('slick_css',plugins_url( '/css/slick-posts.css', __FILE__ ),array(),"0.136");
	
	if ($post_type=="post") {
		
		$read_more_btn = get_theme_mod( 'custom_setting_btn9');
		$read_more_btn = apply_filters( 'the_title', $read_more_btn );
	
		
		$html = '<section class="slick-slider-posts slick-slider">
		';
		$post_default_img = $atts['placeholder'] ? $atts['placeholder'] : 11007;
		$posts_per_page = $atts['total'] ? $atts['total'] : 12;
		$post_category = $atts['category'];
				
		$q_args = array(
			'post_type'	=> 'post',
			'category_name' => $post_category,
			'posts_per_page' => $posts_per_page,
		);
		
		$post_query = new WP_Query( $q_args );
		
		// The Loop
		if ( $post_query->have_posts() ) {
			while ( $post_query->have_posts() ) {
				$post_query->the_post();
				$post_id = get_the_id();
				$post_title = get_the_title();
				$post_url = get_the_permalink();
				$post_date = strtotime(get_the_date());
				$post_thumb_id = get_post_thumbnail_id($post_id) ? get_post_thumbnail_id($post_id) : $post_default_img;
				$post_excerpt = get_the_excerpt();
				$post_img_attr = array(
					'alt'	=> $post_title
				);
				$post_thumbnail = wp_get_attachment_image($post_thumb_id,'post-thumbnail',false,$post_img_attr);
				$html .= '
				<div class="post-slide">
				  <a href="'.$post_url.'" class="slide-thumb">
					<div>'.$post_thumbnail.'</div>
				  </a>
				  <div class="post-slide-date">'.date("F j, Y",$post_date).'</div>
				  <h3><a href="'.$post_url.'" title="'.$post_title.'">'.$post_title.'</a></h3>
				  
				  <p>'.$post_excerpt.'</p>
				  <a class="excerpt-read-more" href="'.$post_url.'" title="Read '.$post_title.'" tabindex="0">'.$read_more_btn.'</a>
				</div>';
			}
			
			/* Restore original Post Data */
			wp_reset_postdata();
		}
		$html .= '</section>';
		return $html;
	}
	else if ($post_type!=NULL) {
		
		$post_default_img = $atts['placeholder'] ? $atts['placeholder'] : 578;
		$post_category = $atts['category'];
		
		$q_args = array(
			'post_type'	=> 'resource',
			'tax_query' => array(
				array(
					'taxonomy' => 'resource-type',
					'field'    => 'slug',
					'terms'    => $post_type,
					'operator' => 'IN',
				),
			),
			'posts_per_page' => -1,
			'orderby'	=> 'date',
		);
		
		$post_query = new WP_Query( $q_args );
		
		$post_count = $post_query->post_count;
		$post_class = $post_count < 3 ? " slick-static" : NULL;
		$html = '<section class="slick-slider-posts slick-slider'.$post_class.'">
		';
		
	  // The Loop
		if ( $post_query->have_posts() ) {
			while ( $post_query->have_posts() ) {
				$post_query->the_post();
				$post_id = get_the_id();
				$post = get_post($post_id);
				
				$c_lang = WPGlobus::Config()->language;
				
				$post_title = get_the_title();
				$post_title = ( !empty($post_title)   ?   apply_filters( 'the_title', $post_title )   :   '' );
				
				$post_slug = $post->post_name;
				$post_thumb_id = get_post_thumbnail_id($post_id) ? get_post_thumbnail_id($post_id) : $post_default_img;
				
				$post_excerpt = get_post_meta($post_id,'resource_description',true);				
				$post_excerpt = ( !empty($post_excerpt)   ?   apply_filters( 'the_content', $post_excerpt )   :   '' );
				
				$post_img_attr = array(
					'alt'	=> $post_title
				);
				$post_thumbnail = wp_get_attachment_image($post_thumb_id,'medium',false,$post_img_attr);
				

				//  -> /'.$c_lang.'/resources/download/?form_resource='.$post_slug.'
				$url_slug = get_permalink(11239);
				$url_slug = apply_filters( 'the_title', $url_slug );
				$resource_url = $url_slug.'?form_resource='.$post_slug;
				$html .= '
				
				<div class="resource-slide">
				  <a href="'.$resource_url.'" class="slide-thumb">
					'.$post_thumbnail.'
				  </a>
				  <h3><a href="'.$resource_url.'">'.$post_title.'</a></h3>
				  <p>'.$post_excerpt.'</p>
				</div>';
			}
			
			/* Restore original Post Data */
			wp_reset_postdata();
		}
		$html .= '
			</section>
		<div class="clearfix"><div></div></div>';
		return $html;
	}
}
add_shortcode( 'bc_posts_slider', 'render_posts_slider' );




//testimonial slider
function render_testimonials_slider($atts) {
	wp_enqueue_style('slick_css',plugins_url( '/css/slick-testimonials.css', __FILE__ ),array(),"0.201");
	wp_enqueue_script( 'slick_js', plugins_url( '/js/slick.min.js', __FILE__ ));
	wp_enqueue_script( 'testimonials_slider_js', plugins_url( '/js/testimonials_slider.js', __FILE__ ),array(),"0.136");
	
	//$html = '<section class="slick-slider-testi">';
	$html = '<section class="slick-slider-testimonials slick-slider">';
	
	$q_args = array(
		'post_type'			=> 'testimonial',
		'order'				=> 'ASC',
		'posts_per_page'	=> 0,
	);
	
	$t_query = new WP_Query( $q_args );
	// The Loop
	if ( $t_query->have_posts() ) {
		while ( $t_query->have_posts() ) {
			$t_query->the_post();
			
			$t_name 	= apply_filters( 'the_title', get_the_title() );
			$t_business = apply_filters( 'the_title', get_post_meta(get_the_id(),'testimonial-business',true) );
			$t_content 	= apply_filters( 'the_content', get_post_meta(get_the_id(),'testimonial',true) );
			
			/*$html .= '
			<div class="testimonial-slide">
				<blockquote>' . get_post_meta(get_the_id(),'testimonial',true) . '</blockquote>
				<div class="testimonial-name">' . get_the_title() . '</div>
				<div class="testimonial-business">' . get_post_meta(get_the_id(),'testimonial-business',true) . '</div>
			</div>';*/
			
			$html .= '
			<div class="testimonial-slide">
				<blockquote>' . $t_content . '</blockquote>
				<div class="testimonial-name">' . $t_name . '</div>
				<div class="testimonial-business">' . $t_business . '</div>
			</div>';
		}
		
		// Restore original Post Data
		wp_reset_postdata();
	}
	
	$html .= '</section>
	<div class="clearfix"></div>';
	return $html;
}
add_shortcode( 'support-testimonials', 'render_testimonials_slider' );

//exec slider
function render_exec($atts) {
	wp_enqueue_script( 'execs_js', plugins_url( '/js/execs.js', __FILE__ ),array(),"0.15");
	$exec_id = $atts['id'];
	$post = get_post($exec_id);
	$slug = $post->post_name;
	$name = get_the_title($exec_id);
	$thumb = get_the_post_thumbnail_url($exec_id,'exec-thumb');	
	$thumbID = get_post_thumbnail_id($exec_id);
	$img = get_the_post_thumbnail_url($exec_id,'full');
	$job = get_post_meta($exec_id,'job_title',true);
	$job = ( !empty($job)   ?   apply_filters( 'the_title', $job )   :   '' );
	
	$bio = str_replace("\n","<br>",get_post_meta($exec_id,'exec_bio',true));
	$bio = ( !empty($bio)   ?   apply_filters( 'the_content', $bio )   :   '' );
	
	add_action('wp_footer',function() use ($slug,$img,$name,$job,$bio) {
		echo '
		<div style="display:none">
			<div id="exec-'.$slug.'" class="exec-pop" style="display:none">
				<div class="exec-pop-image">
					<img src="'.$img.'" alt="'.$name.'" />
				</div>
				<div class="exec-pop-divider"></div>
				<div class="exec-pop-info">
					<div class="exec-pop-info-top">
						<img src="'.$img.'" alt="'.$name.'" class="exec-pop-image-m exec-pop-image" />
						<h3>'.$name.'</h3>
						<h4>'.$job.'</h4>
					</div>
					<div class="exec-pop-scroll">
						<div class="exec-pop-scroll-inner">
							<div class="exec-pop-image">
								<img src="'.$img.'" alt="'.$name.'" />
							</div>
							<h3>'.$name.'</h3>
							<h4>'.$job.'</h4>
							<p>'.$bio.'</p>
						</div>
					</div>
				</div>
			</div>
		</div>';
	},150);
	$html = '
	<li class="exec-link" id="exec-link-'.$slug.'">
		<a href="#exec-'.$slug.'" class="exec-image" data-fancybox><img width="277" height="277" data-id="'.$thumbID.'" src="'.$thumb.'" class="vc_single_image-img attachment-exec-thumb" alt="'.$name.'"></a>
		<h3><a href="#exec-'.$slug.'">'.$name.'</a></h3>
		'.$job.'
	</li>';
	return $html;
}
add_shortcode( 'about-exec', 'render_exec' );

//Resource Title
function render_resource_title() {
	$slug = $_GET['form_resource'];
	$post = get_page_by_path($slug,OBJECT,'resource');
	$post_id = $post->ID;
	$title = get_the_title($post);
	$title = apply_filters( 'the_title', $title );
	return $title;
}
add_shortcode( 'resource-title', 'render_resource_title' );

//Resource Headline
function render_resource_headline() {
	$slug = $_GET['form_resource'];
	$post = get_page_by_path($slug,OBJECT,'resource');
	$post_id = $post->ID;
	//return get_post_meta($post_id,'resource_headline',true);
	
	$title = get_post_meta($post_id,'resource_headline',true);
	$title = apply_filters( 'the_title', $title );
	return $title;
}
add_shortcode( 'resource-headline', 'render_resource_headline' );

//Resource Description
function render_resource_description() {
	$slug = $_GET['form_resource'];
	$post = get_page_by_path($slug,OBJECT,'resource');
	$post_id = $post->ID;
	//echo $post_id;
	//return '<p>'.get_post_meta($post_id,'resource_description',true).'</p>';
	
	$content = get_post_meta($post_id,'resource_description',true);
	$content = apply_filters( 'the_content', $content );
	return $content;
}
add_shortcode( 'resource-description', 'render_resource_description' );

//Home News/Events Widget
function render_home_news_events($atts) {
	$posts_per_page = $atts['total'] ? $atts['total'] : 3;
	$post_category = $atts['category'];
	$category_name = $post_category;
	
	if ($post_category=="news" || $post_category=="company-news") {
		$category_name = "company-news";
		$exclude_cat = get_category_by_slug('events');
		$exclude = $exclude_cat->ID;
	} else if ($post_category=="events") {
		$exclude_cat = get_category_by_slug('company-news');
		$exclude = $exclude_cat->ID;
	}
	
	$q_args = array(
		'post_type'	=> 'post',
		'category_name' => $category_name,
		'posts_per_page' => $posts_per_page,
		'category__not_in' => $exclude,
	);
	
	$post_query = new WP_Query( $q_args );
	
	$html = '';
	
	// The Loop
	if ( $post_query->have_posts() ) {
		while ( $post_query->have_posts() ) {
			$post_query->the_post();
			$post_id = get_the_id();
			$post_title = get_the_title();
			$post_url = get_the_permalink();
			$post_date = strtotime(get_the_date());
			$html .= '
			  <h3><a href='.$post_url.'">'.$post_title.'</a></h3>
			  <p>'.date("F j, Y",$post_date).'</p>';
		}
		/* Restore original Post Data */
		wp_reset_postdata();
	}
	return $html;

}
add_shortcode( 'home-news-events', 'render_home_news_events' );

//Download Resource Link
function render_resource_download_link() {
	$key = $_GET['key'];
	if ($key) {
		$q_args = array(
			'post_status' => array('private', 'publish'),
			'post_type'	=> 'resource-lead',
			'posts_per_page' => 1,
			'meta_key' => 'lead_key',
			'meta_value' => $key,
			'meta_query'    => array(
				'relation' => 'AND',
				array(
					'key'       => 'lead_key',
					'value'     => $key,
					'compare'   => '=',
				),
				array(
					'key'       => 'lead_key',
					'value'     => '',
					'compare'   => '!=',
				)
			)
		);
		
		$leads = get_posts( $q_args );
		$lead = $leads[0];
		wp_reset_postdata();
		if ($lead->ID) {
			$resource_id = get_post_meta($lead->ID,'lead_resource',true);

			$lead_file = get_post_meta($resource_id,'_resource_file',true);
			$lead_lang = get_post_meta($lead->ID,'lead_lang',true);


			$resource_title = get_the_title($resource_id);
			if(isset($lead_lang) && $lead_lang == "es"){
				$file = get_field( "downloadable_file_es",$resource_id); 
                                if(isset($file['title']) && $file['title'] != "" && isset($file['url']) && $file['url'] != ""){
                                    //$resource_title =  $file['title'];
                                    //$lead_file =  $file['title'];
									
									$path = parse_url($file['url'], PHP_URL_PATH);
									$lead_file = basename($path);
									
                                    $resource_file = $file['url'].'?key='.$key.'&t='.round(time()/1000);
                                }else{
                                    $resource_file = '/wp-content/uploads/resources/downloads/'.$lead_file.'?key='.$key.'&t='.round(time()/1000);
                                }
			}else{
				$resource_file = '/wp-content/uploads/resources/downloads/'.$lead_file.'?key='.$key.'&t='.round(time()/1000);
			}
			$html = '
				<div class="resource-download-file-wrapper">
					<h3>Download:</h3>
					<h2><a href="'.$resource_file.'" target="_blank">'.$resource_title.'</a></h2>
					<p><a href="'.$resource_file.'" target="_blank">'.$lead_file.'</a></p>
				</div>';
		} else {
			$html = '
				<div class="resource-download-file-wrapper" align="center">
					<h3>This link is invalid.</h3>
				</div>';
		}
	} else {
		$html = '<script type="text/javascript">window.location="'.get_site_url().'";</script>';
	}
	return $html;

}
add_shortcode( 'resource-download-link', 'render_resource_download_link' );

//Resource Description
function render_kfb_item($atts) {
	$bold_text = $atts['bold_text'];
	$post_text = $atts['post_text'];
	$image = $atts['image'];
	
	$img = wp_get_attachment_image( $image, array("full wp-img-{$image}"), false, 'width="100" height="100"' );
	
	return '
	<li>
		<div class="kfb-left">'.$img.'</div>
		<strong>'.trim($bold_text).'</strong> '.trim($post_text).'
	</li>';
}
add_shortcode( 'kfb-item', 'render_kfb_item' );