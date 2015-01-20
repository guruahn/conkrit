<?php
function ppb_text_func($atts, $content) {

	//extract short code attr
	extract(shortcode_atts(array(
		'size' => 'one_third'
	), $atts));

	$return_html = '<div class="'.$size.'">'.$content.'</div>';

	return $return_html;

}

add_shortcode('ppb_text', 'ppb_text_func');


function ppb_divider_func($atts, $content) {

	//extract short code attr
	extract(shortcode_atts(array(
		'size' => 'one'
	), $atts));

	$return_html = '<div class="divider '.$size.'">&nbsp;</div>';

	return $return_html;

}

add_shortcode('ppb_divider', 'ppb_divider_func');


function ppb_service_func($atts, $content) {

	remove_filter('the_content', 'pp_formatter', 99);

	//extract short code attr
	extract(shortcode_atts(array(
		'size' => 'one',
		'items' => 4,
		'title' => '',
		'service_cat' => '',
	), $atts));
	
	if(!is_numeric($items))
	{
		$items = -1;
	}

	//Get service items
	$args = array(
	    'numberposts' => $items,
	    'order' => 'ASC',
	    'orderby' => 'menu_order',
	    'post_type' => array('services'),
	);
	
	if(!empty($service_cat))
	{
		$args['service_cats'] = $service_cat;
	}

	$services_arr = get_posts($args);
	$return_html = '';

	if(!empty($services_arr))
	{
		$return_html.= '<div class="'.$size.'">';
		
		if(!empty($title))
		{
			$return_html.= '<div class="ppb_title"><h4>'.$title.'</h4></div>';
			$return_html.= '<br class="clear"/>';
		}
		
		switch($size)
		{
			case 'one':
			default:
				$column_class = 'one_fourth';
			break;
			case 'two_third':
				$column_class = 'one_third';
			break;
			case 'one_half':
				$column_class = 'one_half';
			break;
			case 'one_third':
			case 'one_fourth':
				$column_class = 'one';
			break;
		}
		
		foreach($services_arr as $key => $service)
		{
			$image_url = '';
			
			if(($key+1)%4==0 && $size=='one')
			{
				$column_class.= ' last';
			}

			if(has_post_thumbnail($service->ID, 'full'))
			{
			    $image_id = get_post_thumbnail_id($service->ID);
			    $image_url = wp_get_attachment_image_src($image_id, 'full', true);
			}

			$return_html.= '<div class="'.$column_class.' ppb_serivce_wrapper">';
			$return_html.= '<img src="'.$image_url[0].'" class="alignleft" alt=""/><h5 class="middle">'.$service->post_title.'</h5><br/>';
			$return_html.= $service->post_content;
			$return_html.= '</div>';
		}
	}
	else
	{
		$return_html.= 'Empty service item. Please make sure you have created it or check the short code.';
	}

	$return_html.= '</div>';

	return $return_html;

}

add_shortcode('ppb_service', 'ppb_service_func');


function ppb_styled_box_func($atts, $content) {
	//extract short code attr
	extract(shortcode_atts(array(
		'title' => '',
		'size' => 'one',
		'style' => '',
		'color' => '',
	), $atts));

	switch(strtolower($color))
	{
		case 'black':
		    $bg_color = '#000000';
		    $text_color = '#ffffff';
		break;
		default:

		case 'gray':
		    $bg_color = '#666666';
		    $text_color = '#ffffff';
		break;

		case 'white':
		    $bg_color = '#f5f5f5';
		    $text_color = '#444444';
		break;

		case 'blue':
		    $bg_color = '#004a80';
		    $text_color = '#ffffff';
		break;

		case 'yellow':
		    $bg_color = '#f9b601';
		    $text_color = '#ffffff';
		break;

		case 'red':
		    $bg_color = '#9e0b0f';
		    $text_color = '#ffffff';
		break;

		case 'orange':
		    $bg_color = '#fe7201';
		    $text_color = '#ffffff';
		break;

		case 'green':
		    $bg_color = '#7aad34';
		    $text_color = '#ffffff';
		break;

		case 'pink':
		    $bg_color = '#d2027d';
		    $text_color = '#ffffff';
		break;

		case 'purple':
		    $bg_color = '#582280';
		    $text_color = '#ffffff';
		break;
	}

	$bg_color_light = '#'.hex_lighter(substr($bg_color, 1), 20);
	$border_color = '#'.hex_lighter(substr($bg_color, 1), 10);

	$return_html = '<div class="'.$size.'">';
	$return_html.= '<div class="styled_box_title" style="border:1px solid '.$border_color.';background: '.$bg_color.';color:'.$text_color.' '.$style.'">'.$title.'</div><br class="clear"/>';
	$return_html.= '<div class="styled_box_content '.$size.'" style="border:1px solid '.$border_color.';border-top:0;">'.$content.'</div>';
	$return_html.= '</div>';

	return $return_html;

}

add_shortcode('ppb_styled_box', 'ppb_styled_box_func');


function ppb_gallery_func($atts, $content) {

	//extract short code attr
	extract(shortcode_atts(array(
		'gallery_id' => '',
		'width' => 205,
		'height' => 205,
		'items' => -1,
		'size' => 'one',
		'title' => '',
	), $atts));
	
	if(!is_numeric($width))
	{
		$width = 205;
	}
	if(!is_numeric($height))
	{
		$height = 205;
	}
	if(!is_numeric($items))
	{
		$items = -1;
	}

	//Get gallery items
	$args = array( 
        'post_type' => 'attachment', 
        'numberposts' => $items, 
        'post_status' => null, 
        'post_parent' => $gallery_id,
        'order' => 'ASC',
        'orderby' => 'menu_order',
    );

	$images_arr = get_posts($args);
	$return_html = '<div class="'.$size.'">';
	if(!empty($title))
	{
	    $return_html.= '<div class="ppb_title"><h4>'.$title.'</h4></div>';
	    $return_html.= '<br class="clear"/>';
	}
	
	if(!empty($images_arr))
	{
		foreach($images_arr as $key => $image)
		{
			$image_url = $image->guid;
			
			$return_html.= '<div style="float:left;margin-right:10px;margin-bottom:10px">';
			$return_html.= '<a rel="gallery" href="'.$image_url.'">';
			$return_html.= '<img src="'.get_bloginfo( 'stylesheet_directory' ).'/timthumb.php?src='.$image_url.'&amp;h='.$height.'&amp;w='.$width.'&amp;zc=1" alt="" class="post_img"/>';
			$return_html.= '</a>';
			$return_html.= '</div>';
		}
	}
	else
	{
		$return_html.= 'Empty gallery item. Please make sure you have upload image to it or check the short code.';
	}

	$return_html.= '</div>';

	return $return_html;

}

add_shortcode('ppb_gallery', 'ppb_gallery_func');


function ppb_tabs_func($atts, $content) {

	extract(shortcode_atts(array(
		'tab1_title' => '',
		'tab1_content' => '',
		'tab2_title' => '',
		'tab2_content' => '',
		'tab3_title' => '',
		'tab3_content' => '',
		'tab4_title' => '',
		'tab4_content' => '',
		'tab5_title' => '',
		'tab5_content' => '',
		'title' => '',
		'size' => 'one',
	), $atts));
	
	$tabs_arr = array();
	
	$tabs_arr[1]['title'] = $tab1_title;
	$tabs_arr[2]['title'] = $tab2_title;
	$tabs_arr[3]['title'] = $tab3_title;
	$tabs_arr[4]['title'] = $tab4_title;
	$tabs_arr[5]['title'] = $tab5_title;
	
	$tabs_arr[1]['content'] = $tab1_content;
	$tabs_arr[2]['content'] = $tab2_content;
	$tabs_arr[3]['content'] = $tab3_content;
	$tabs_arr[4]['content'] = $tab4_content;
	$tabs_arr[5]['content'] = $tab5_content;

	$return_html = '<div class="'.$size.'">';
	
	if(!empty($title))
	{
	    $return_html.= '<div class="ppb_title"><h4>'.$title.'</h4></div>';
	    $return_html.= '<br class="clear"/>';
	}
	
	$return_html.= '<div class="tabs"><ul>';

	for($i=1;$i<=5;$i++)
	{
		if(!empty($tabs_arr[$i]['title']))
		{
			$return_html.= '<li><a href="#tabs-'.($i).'">'.urldecode($tabs_arr[$i]['title']).'</a></li>';
		}
	}

	$return_html.= '</ul>';
	
	for($i=1;$i<=5;$i++)
	{
		if(!empty($tabs_arr[$i]['content']))
		{
			$return_html.= do_shortcode('[tab id="'.$i.'"]'.urldecode($tabs_arr[$i]['content']).'[/tab]');
		}
	}
	
	$return_html.= '</div>';
	$return_html.= '</div>';

	

	return $return_html;

}

add_shortcode('ppb_tabs', 'ppb_tabs_func');


function ppb_toggle_func($atts, $content) {

	extract(shortcode_atts(array(
		'toggle1_title' => '',
		'toggle1_content' => '',
		'toggle2_title' => '',
		'toggle2_content' => '',
		'toggle3_title' => '',
		'toggle3_content' => '',
		'toggle4_title' => '',
		'toggle4_content' => '',
		'toggle5_title' => '',
		'toggle5_content' => '',
		'title' => '',
		'size' => 'one',
	), $atts));
	
	$toggles_arr = array();
	
	$toggles_arr[1]['title'] = $toggle1_title;
	$toggles_arr[2]['title'] = $toggle2_title;
	$toggles_arr[3]['title'] = $toggle3_title;
	$toggles_arr[4]['title'] = $toggle4_title;
	$toggles_arr[5]['title'] = $toggle5_title;
	
	$toggles_arr[1]['content'] = $toggle1_content;
	$toggles_arr[2]['content'] = $toggle2_content;
	$toggles_arr[3]['content'] = $toggle3_content;
	$toggles_arr[4]['content'] = $toggle4_content;
	$toggles_arr[5]['content'] = $toggle5_content;

	$return_html = '<div class="'.$size.'">';
	if(!empty($title))
	{
		$return_html.= '<div class="ppb_title"><h4>'.$title.'</h4></div>';
		$return_html.= '<br class="clear"/>';
	}

	for($i=1;$i<=5;$i++)
	{
		if(!empty($toggles_arr[$i]['title']))
		{
			$return_html.= '<div class="pp_accordion_close"><h3><a href="#">'.urldecode($toggles_arr[$i]['title']).'</a></h3>';
			$return_html.= '<div><p>';
			$return_html.= pp_apply_content(urldecode($toggles_arr[$i]['content']));
			$return_html.= '</p></div></div>';
		}
	}
	
	$return_html.= '</div>';

	return $return_html;

}

add_shortcode('ppb_toggle', 'ppb_toggle_func');


function ppb_tagline_func($atts, $content) {

	extract(shortcode_atts(array(
		'title' => '',
		'size' => 'one',
		'header_text' => '',
		'description' => '',
	), $atts));
	
	$return_html = '<div class="'.$size.'">';
	$return_html.= '<div class="tagline"><h2>'.strip_tags(urldecode($header_text)).'</h2>';
	$return_html.= urldecode($description);
	$return_html.= '</div>';
	$return_html.= '</div>';
	

	return $return_html;

}

add_shortcode('ppb_tagline', 'ppb_tagline_func');


function ppb_portfolio_func($atts, $content) {
	
	extract(shortcode_atts(array(
		'title' => 'Recent Portfolios',
		'items' => 8,
		'set_id' => '',
		'size' => 'one',
		'portfolio_url' => '',
	), $atts));
	
	if(!is_numeric($items))
	{
		$items = -1;
	}

	$args = array(
	    'numberposts' => $items,
	    'order' => 'ASC',
	    'orderby' => 'menu_order',
	    'post_type' => array('portfolios'),
	);

	if(!empty($set_id))
	{
		$args['portfoliosets'] = $set_id;
	}

	$recent_portfolios_arr = get_posts($args);

	$return_html = '<div class="'.$size.' ppb_portfolio_wrapper">';
	
	if(!empty($title))
	{
		$return_html.= '<div class="ppb_title"><h4>'.$title.'</h4></div>';
		
		if(!empty($portfolio_url))
		{
			$return_html.= '<div class="ppb_desc"><a href="'.$portfolio_url.'">'.__( '/ View Full Portfolios', THEMEDOMAIN ).'</a></div>';
		}
		
		$return_html.= '<br class="clear"/>';
	}
	
	$column_class = '';
	$portfolio_item_size = '';
	$portfolio_item_img = '';
	
	if($size=='one')
	{
		$column_class = 'one_fourth';
		$portfolio_item_size = 200;
		$portfolio_item_img = 'portfolio4';
	}
	elseif($size=='two_third' OR $size=='two_third last')
	{
		$column_class = 'one_third';
		$portfolio_item_size = 195;
		$portfolio_item_img = 'portfolio3l';
	}
	elseif($size=='one_half' OR $size=='one_half last')
	{
		$column_class = 'one_half';
		$portfolio_item_size = 200;
		$portfolio_item_img = 'portfolio4';
	}
	elseif($size=='one_third' OR $size=='one_third last')
	{
		$column_class = 'one';
		$portfolio_item_size = 305;
		$portfolio_item_img = 'portfolio3';
	}
	elseif($size=='one_fourth' OR $size=='one_fourth last')
	{
		$column_class = 'one';
		$portfolio_item_size = 200;
		$portfolio_item_img = 'portfolio4';
	}
	
	foreach($recent_portfolios_arr as $key => $recent_portfolio)
	{
		$portfolio_type = get_post_meta($recent_portfolio->ID, 'portfolio_type', true);
	    $portfolio_video_id = get_post_meta($recent_portfolio->ID, 'portfolio_video_id', true);
	    $portfolio_link_url = get_post_meta($recent_portfolio->ID, 'portfolio_link_url', true);										

	    if(empty($portfolio_link_url))
	    {
	        $permalink_url = get_permalink($recent_portfolio->ID);
	    }
	    else
	    {
	        $permalink_url = $portfolio_link_url;
	    }

	    $image_url = '';						

	    if(has_post_thumbnail($recent_portfolio->ID, $portfolio_item_img))
	    {
	        $image_id = get_post_thumbnail_id($recent_portfolio->ID);
	        $image_url = wp_get_attachment_image_src($image_id, $portfolio_item_img, true);
	        $large_image_url = wp_get_attachment_image_src($image_id, 'original', true);
	    }

	    $return_html.= '<div class="'.$column_class.'">';

	    switch($portfolio_type)
	    {
	    	case 'External Link':

	    	default:
	    		$return_html.= '<div class="portfolio'.$portfolio_item_size.'_shadow">';
	    		$return_html.= '<a href="'.$permalink_url.'"><img src="'.$image_url[0].'" alt="" class="portfolio_img"/><div class="portfolio'.$portfolio_item_size.'_overlay"><div class="overlay_icon_circle"><img src="'.get_stylesheet_directory_uri().'/images/icon_link.png" alt="" class=""/></div></div></a>';
	    		$return_html.= '</div>';
	    	break;
	    	// end external link

	    	case 'Portfolio Content':
	    	default:
	    		$return_html.= '<div class="portfolio'.$portfolio_item_size.'_shadow">';
	    		$return_html.= '<a href="'.get_permalink($recent_portfolio->ID).'"><img src="'.$image_url[0].'" alt="" class="portfolio_img"/><div class="portfolio'.$portfolio_item_size.'_overlay"><div class="overlay_icon_circle"><img src="'.get_stylesheet_directory_uri().'/images/icon_link.png" alt="" class=""/></div></div></a>';
	    		$return_html.= '</div>';
	    	break;
	    	// end portfolio content

	    	case 'Image':
	    		$return_html.= '<div class="portfolio'.$portfolio_item_size.'_shadow">';
	    		$return_html.= '<a href="'.$large_image_url[0].'" class="img_frame"><img src="'.$image_url[0].'" alt="" class="portfolio_img"/><div class="portfolio'.$portfolio_item_size.'_overlay"><div class="overlay_icon_circle"><img src="'.get_stylesheet_directory_uri().'/images/icon_image.png" alt="" class=""/></div></div></a>';
	    		$return_html.= '</div>';
	    	break;
	    	// end image

	    	case 'Youtube Video':
	    		$return_html.= '<div class="portfolio'.$portfolio_item_size.'_shadow">';
	    		$return_html.= '<a href="#video_'.$portfolio_video_id.'" class="lightbox_youtube"><img src="'.$image_url[0].'" alt="" class="portfolio_img"/><div class="portfolio'.$portfolio_item_size.'_overlay"><div class="overlay_icon_circle"><img src="'.get_stylesheet_directory_uri().'/images/icon_video.png" alt="" class=""/></div></div></a>';
	    		$return_html.= '</div>';

	    		$return_html.= '<div style="display:none;">
	    					    <div id="video_'.$portfolio_video_id.'" style="width:900px;height:488px"><iframe width="900" height="488" src="http://www.youtube.com/embed/'.$portfolio_video_id.'?theme=dark&amp;rel=0&amp;wmode=opaque"></iframe></div>	

	    					</div>';

	    	break;
	    	// end youtube video

	    	case 'Vimeo Video':
	    		$return_html.= '<div class="portfolio'.$portfolio_item_size.'_shadow">';
	    		$return_html.= '<a href="#video_'.$portfolio_video_id.'" class="lightbox_vimeo"><img src="'.$image_url[0].'" alt="" class="portfolio_img"/><div class="portfolio'.$portfolio_item_size.'_overlay"><div class="overlay_icon_circle"><img src="'.get_stylesheet_directory_uri().'/images/icon_video.png" alt="" class=""/></div></div></a>';
	    		$return_html.= '</div>';

	    		$return_html.= '<div style="display:none;">
	    					    <div id="video_'.$portfolio_video_id.'" style="width:900px;height:506px"><iframe src="http://player.vimeo.com/video/'.$portfolio_video_id.'?title=0&amp;byline=0&amp;portrait=0" width="900" height="506"></iframe></div>	

	    					</div>';

	    	break;
	    	// end vimeo video

	    	case 'Self-Hosted Video':        

	        	//Get video URL
	        	$portfolio_mp4_url = get_post_meta($recent_portfolio->ID, 'portfolio_mp4_url', true);
	    		$preview_image = wp_get_attachment_image_src($image_id, 'large', true);

	    		$return_html.= '<div class="portfolio'.$portfolio_item_size.'_shadow">';
	    		$return_html.= '<a href="#video_self_'.$key.'" class="lightbox_vimeo"><img src="'.$image_url[0].'" alt="" class="portfolio_img"/><div class="portfolio'.$portfolio_item_size.'_overlay"><div class="overlay_icon_circle"><img src="'.get_stylesheet_directory_uri().'/images/icon_video.png" alt="" class=""/></div></div></a>';
	    		$return_html.= '</div>';

	    		$return_html.= '<div style="display:none;">
	        		    <div id="video_self_'.$key.'" style="width:900px;height:488px">
	        		        <div id="self_hosted_vid_'.$key.'">JW Player goes here</div>
	    					<script type="text/javascript">
	    						jwplayer("self_hosted_vid_'.$key.'").setup({
	    							flashplayer: "'.get_stylesheet_directory_uri().'/js/player.swf",
	    							file: "'.$portfolio_mp4_url.'",
	    							image: "'.$preview_image[0].'",
	    							width: 900,
	    							height: 488,
	    						});
	    					</script>
	        		    </div>	
	        		</div>';

	    	break;
	    	// end self-hosted video

	    }

	    $return_html.= '<div class="portfolio_desc portfolio_desc_'.$portfolio_item_size.'"><h6 class="portfolio_header">'.$recent_portfolio->post_title.'</h6>'.$recent_portfolio->post__xcerpt.'</div>';
	    $return_html.= '</div>';
	}
	
	$return_html.= '</div>';

	return $return_html;

}

add_shortcode('ppb_portfolio', 'ppb_portfolio_func');


function ppb_blog_func($atts, $content) {
	
	extract(shortcode_atts(array(
		'title' => 'Recent News',
		'items' => 8,
		'cat_id' => '',
		'size' => 'one',
		'blog_url' => '',
	), $atts));
	
	if(!is_numeric($items))
	{
		$items = -1;
	}

	$args = array(
	    'numberposts' => $items,
	    'post_type' => array('post'),
	);

	if(!empty($cat_id))
	{
		$args['category'] = $cat_id;
	}

	$recent_posts_arr = get_posts($args);
	$return_html = '<div class="'.$size.'">';
	
	if(!empty($title))
	{
		$return_html.= '<div class="ppb_title"><h4>'.$title.'</h4></div>';
		
		if(!empty($blog_url))
		{
			$return_html.= '<div class="ppb_desc"><a href="'.$blog_url.'">'.__( '/ Read Our Blog', THEMEDOMAIN ).'</a></div>';
		}
		
		$return_html.= '<br class="clear"/>';
	}
	
	foreach($recent_posts_arr as $key => $recent_post)
	{
		if($size=='one')
		{
			$column_class = 'post_wrapper one_third';
			$overlay_class = 'post_third';
		}
		elseif($size=='two_third' OR $size=='two_third last')
		{
			$column_class = 'ppb_blog one_half';
			$overlay_class = 'post_third';
		}
		elseif($size=='one_half' OR $size=='one_half last')
		{
			$column_class = 'ppb_blog post_wrapper one_half';
			$overlay_class = 'ppb_blog post_half';
		}
		elseif($size=='one_third' OR $size=='one_third last')
		{
			$column_class = 'one';
			$overlay_class = 'ppb_blog post_half';
		}
		elseif($size=='one_fourth' OR $size=='one_fourth last')
		{
			$column_class = 'one';
			$overlay_class = 'ppb_blog post_half';
		}
	
		if(($size=='one' && ($key+1) % 3 == 0))
		{
			$column_class.= ' last';
		}
		elseif(($size=='two_third' OR $size=='two_third last') && ($key+1) % 2 == 0)
		{
			$column_class.= ' last';
		}
		
		//pp_debug($recent_post);
		$blog_title_html = '<h5><a href="'.get_permalink($recent_post->ID).'">'.get_the_title($recent_post->ID).'</a></h5>';
		
		if($size=='one' OR $size=='two_third' OR $size=='two_third last')
		{
			if(has_post_thumbnail($recent_post->ID, 'blog3'))
			{
			    $image_id = get_post_thumbnail_id($recent_post->ID);
			    $image_thumb = wp_get_attachment_image_src($image_id, 'blog3', true);
			}
		}
		elseif($size=='one_half' OR $size=='one_half last' OR $size=='one_third' OR $size=='one_third last')
		{
			$blog_title_html = '<h3><a href="'.get_permalink($recent_post->ID).'">'.get_the_title($recent_post->ID).'</a></h3>';
		
			if(has_post_thumbnail($recent_post->ID, 'blog2'))
			{
			    $image_id = get_post_thumbnail_id($recent_post->ID);
			    $image_thumb = wp_get_attachment_image_src($image_id, 'blog2', true);
			}
		}
		elseif($size=='one_fourth' OR $size=='one_fourth last')
		{
			$blog_title_html = '<h6><a href="'.get_permalink($recent_post->ID).'">'.get_the_title($recent_post->ID).'</a></h6>';
		
			if(has_post_thumbnail($recent_post->ID, 'blog2'))
			{
			    $image_id = get_post_thumbnail_id($recent_post->ID);
			    $image_thumb = wp_get_attachment_image_src($image_id, 'blog2', true);
			}
		}
		
		$return_html.= '<div class="'.$column_class.'">';
		
		if(isset($image_thumb[0]))
		{
			$return_html.= '<a href="'.get_permalink($recent_post->ID).'">';
			$return_html.= '<div class="'.$overlay_class.'_img_wrapper">';
			$return_html.= '<img src="'.$image_thumb[0].'" alt=""/>';
			$return_html.= '<div class="'.$overlay_class.'_img_overlay">';
			$return_html.= '<div class="overlay_icon_circle">';
			$return_html.= '<img src="'.get_stylesheet_directory_uri().'/images/icon_link.png" alt="" class=""/>';
			$return_html.= '</div>';
			$return_html.= '</div>';
			$return_html.= '</div></a><br class="clear"/>';

		}

		$return_html.= '<div class="post_header_wrapper">';
		$return_html.= '<div class="post_header half">';
		$return_html.= $blog_title_html;
		$return_html.= '<div class="post_detail">';
		$return_html.= '<div class="post_detail_item">';
		$return_html.= __( 'Date:', THEMEDOMAIN ).' '.date('d M Y', strtotime($recent_post->post_date));
		$return_html.= '</div>';
		$return_html.= '</div>';
		$return_html.= '</div>';
		$return_html.= '</div>';
		$return_html.= '<div class="post_excerpt half">'.pp_substr(strip_tags($recent_post->post_content), 220).'...<br/><br/>';
		$return_html.= '<a class="button" href="'.get_permalink($recent_post->ID).'">'.__( 'Read The Rest', THEMEDOMAIN ).' →</a>';
		$return_html.= '</div>';
		$return_html.= '</div>';
		
		if(($size=='two_third' OR $size=='two_third last') && (($key+1)%2==0))
		{
			$return_html.= '<br class="clear"/><br/><br/>';
		}
		
		if($size=='one_third' OR $size=='one_third last' OR $size=='one_fourth' OR $size=='one_fourth last')
		{
			$return_html.= '<br class="clear"/><br/><br/>';
		}
		
	}
	
	$return_html.= '</div>';

	return $return_html;

}

add_shortcode('ppb_blog', 'ppb_blog_func');
?>