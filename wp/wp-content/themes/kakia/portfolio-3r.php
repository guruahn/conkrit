<?php
/**
 * Template Name: Portfolio 3 Columns + Right Sidebars
 * The main template file for display portfolio page.
 *
 * @package WordPress
*/

include (get_template_directory() . "/lib/fallback.home.lib.php");

if(!isset($hide_header) OR !$hide_header)
{
	get_header(); 
}

/**
*	Get Current page object
**/
$page = get_page($post->ID);

/**
*	Get current page id
**/

if(!isset($current_page_id) && isset($page->ID))
{
    $current_page_id = $page->ID;
}

//Get page Sidebar
$page_sidebar = get_post_meta($current_page_id, 'page_sidebar', true);
if(empty($page_sidebar))
{
	$page_sidebar = 'Portfolio Sidebar';
}

//If display on homepage then disable header
if(!isset($hide_header) OR !$hide_header)
{
?>		
</div>

<div class="page_caption">
	<div class="caption_inner">
		<div class="caption_header">
			<h1 class="cufon"><span><?php the_title(); ?></span></h1>
			<?php
			$page_description = get_post_meta($current_page_id, 'page_description', true);
			
			if(!empty($page_description))
			{
			?>
				<span class="page_description"><?php echo $page_description; ?></span>
			<?php
			}
			?>
		</div>
	</div>
	<br class="clear"/>
</div>
<br class="clear"/>

<!-- Begin content -->
<div id="content_wrapper">

    <div class="inner">
    
    	<!-- Begin main content -->
    	<div class="inner_wrapper">
    	
    	<div class="standard_wrapper">
<?php
}
?>				
		<div class="sidebar_content portfolio_r">
		
		<?php
		    if(!empty($page->post_content) && empty($term) && !is_home())
		    {
		    	echo pp_apply_content($page->post_content);
		    }
		    else if(!empty($term) && !is_home())
		    {
		    	echo pp_apply_content($obj_term->description);
		    }
		?>
		
		<!-- Begin portfolio content -->
		
		<?php
			//Display portfolio items
		    $pp_portfolio_items = get_option('pp_portfolio_items');
		    if(empty($pp_portfolio_items))
		    {
			    $pp_portfolio_items = 12;
		    }
		    
		    $temp = $wp_query; 
			$wp_query = null; 
			$wp_query = new WP_Query(); 
			$wp_query->query('showposts='.$pp_portfolio_items.'&post_type=portfolios&orderby=menu_order&order=ASC'.'&paged='.$paged);
			
			//Check featured content display setting
			$pp_portfolio_enable_feat = get_option('pp_portfolio_enable_feat');
		    
			//Get AJAX portfolio items
			$ajax_portfolios_arr = array();
			
			while ($wp_query->have_posts()) : $wp_query->the_post(); 
			
		    	$portfolio_type = get_post_meta(get_the_ID(), 'portfolio_type', true);
		    
		    	if($portfolio_type == 'AJAX Portfolio Content')
		    	{
		    		$portfolio_ID = get_the_ID();
		        	$portfolio_title = get_the_title();
		        	$portfolio_content = get_the_content();
		    	
		    		$ajax_portfolios_arr[] = array(
		    			'ID' => $portfolio_ID,
		    			'title' => $portfolio_title,
		    			'content' => $portfolio_content,
		    		);
		    	}
		    
		    endwhile;
		    
		    $count_ajax_items = count($ajax_portfolios_arr);
		    
		    foreach($ajax_portfolios_arr as $key => $portfolio_item)
		    {
		    	//Get portfolio gallery ID
		    	$portfolio_gallery_id = get_post_meta($portfolio_item['ID'], 'portfolio_gallery_id', true);
		    	
		    	//Get next and prev ajax item
		    	if(isset($ajax_portfolios_arr[$key+1]))
		    	{
			    	$portfolio_next_id = $ajax_portfolios_arr[$key+1]['ID'];
		    	}
		    	else
		    	{
			    	$portfolio_next_id = $ajax_portfolios_arr[0]['ID'];
		    	}
		    	
		    	if(isset($ajax_portfolios_arr[$key-1]))
		    	{
			    	$portfolio_prev_id = $ajax_portfolios_arr[$key-1]['ID'];
		    	}
		    	else
		    	{
			    	$portfolio_prev_id = $ajax_portfolios_arr[$count_ajax_items-1]['ID'];
		    	}
		?>
		    
		    	<div id="ajax_<?php echo $portfolio_item['ID']; ?>" class="ajax_portfolio_wrapper">
		    		<h4 class="portfolio_single_title"><?php echo $portfolio_item['title']; ?></h4>
		    		<a class="ajax_close" data-rel="<?php echo $portfolio_item['ID']; ?>">x</a>
		    		<a class="ajax_next ajax_portfolio_direction" data-rel="<?php echo $portfolio_next_id; ?>">→</a>
		    		<a class="ajax_prev ajax_portfolio_direction" data-rel="<?php echo $portfolio_prev_id; ?>">←</a>
					<?php
					if(!empty($pp_portfolio_enable_feat))
		    		{
		    			//If display featured image
		    			if(empty($portfolio_gallery_id))
		    			{
		    		    	$image_thumb = '';
		    		    								
		    		    	if(has_post_thumbnail($portfolio_item['ID'], 'slide'))
		    		    	{
		    		    	    $image_id = get_post_thumbnail_id($portfolio_item['ID']);
		    		    	    $image_thumb = wp_get_attachment_image_src($image_id, 'slide', true);
		    		    	}
		    		?>
		    				<img src="<?php echo $image_thumb[0]; ?>" alt="" class="portfolio_single_img img_shadow"/>
		    		<?php
		    			}
		    			//If display image gallery
		    			else
		    			{
		    		?>
		    		<br class="clear"/>
		    		<div id="portfolio_slider_<?php echo $portfolio_item['ID']; ?>" class="flexslider portfolio">
		    			<ul class="slides">
		    		<?php
		    				$args = array( 
		    	    			'post_type' => 'attachment', 
		    	    			'numberposts' => -1, 
		    	    			'post_status' => null, 
		    	    			'post_parent' => $portfolio_gallery_id,
		    	    			'order' => 'ASC',
		    	    			'orderby' => 'menu_order',
		    	    		); 								
		    	    		$portfolio_slider_arr = get_posts( $args );
		    	    		
		    	    		foreach($portfolio_slider_arr as $key => $photo_item)
		    	    		{
		    	    			$image_slide = wp_get_attachment_image_src($photo_item->ID, 'slide', true);
		    		?>
		    			
		    					<li>
		    						<img src="<?php echo $image_slide[0]; ?>" alt="<?php echo $photo_item->post_title; ?>"/>
		    					</li>
		    			
		    		<?php	
		    				}
		    		?>
		    			</ul>
		    		</div>
		    			
		    		<?php
		    			//Get portfolio slider settings
		    			$pp_portfolio_slider_timer = get_option('pp_portfolio_slider_timer');
		    			if(empty($pp_portfolio_slider_timer))
		    			{
		    				$pp_portfolio_slider_timer = 5;
		    			}
		    			
		    			$pp_portfolio_slider_autoplay = get_option('pp_portfolio_slider_autoplay');
		    		?>
		    		<script type="text/javascript"> 
		    		$j(window).load(function() {
		    		    $j('#portfolio_slider_<?php echo $portfolio_item['ID']; ?>').flexslider({
		    		    	animation: "fade",
		    		    	<?php
		    				if(empty($pp_portfolio_slider_autoplay))
		    				{
		    				?>
		    				slideshow: false,
		    				<?php
		    				}
		    				?>
		    				controlNav: true,
		    				slideshowSpeed: <?php echo $pp_portfolio_slider_timer*1000; ?>
		    		    });
		    		});
		    		</script>
		    		
		    		<?php
		    			}
		    		}
		    		?>	
		    			<div class="ajax_content">
		    				<?php echo pp_apply_content($portfolio_item['content']); ?>
		    			</div>
				</div>
		    
		<?php
		    }
		
		    if(have_posts())
		    {
		    	$key = 0;
		?>
		<div class="portfolio-content section content clearfix">
		 	<?php
	    	while ($wp_query->have_posts()) : $wp_query->the_post(); 
	        	$image_url = '';
	        	$portfolio_ID = get_the_ID();
	        	$portfolio_title = get_the_title();
	    
	        	if(has_post_thumbnail($portfolio_ID, 'portfolio3l'))
	        	{
	        		$image_id = get_post_thumbnail_id($portfolio_ID);
	        		$image_url = wp_get_attachment_image_src($image_id, 'portfolio3l', true);
	        		$full_image_url = wp_get_attachment_image_src($image_id, 'full', true);
	        	}
	        	
	        	$last_class = '';
	        	if(($key+1) % 3 == 0)
	        	{	
	        		$last_class = ' last';
	        	}
	        	$key++;
	        	
	        	$portfolio_link_url = get_post_meta($portfolio_ID, 'portfolio_link_url', true);
	        	
	        	if(empty($portfolio_link_url))
	        	{
	        		$permalink_url = get_permalink($portfolio_ID);
	        	}
	        	else
	        	{
	        		$permalink_url = $portfolio_link_url;
	        	}
	        	
	        	$portfolio_item_class = 'one_third';
	        	
	        	$portfolio_item_set = '';
				$portfolio_item_sets = wp_get_object_terms($portfolio_ID, 'portfoliosets');
				
				if(is_array($portfolio_item_sets))
				{
				    foreach($portfolio_item_sets as $set)
				    {
				    	$portfolio_item_set.= $set->slug.' ';
				    }
				}
	        	
	        	$pp_portfolio_image_height = 140;
	    ?>
			<div class="<?php echo $portfolio_item_class.' '.$last_class; ?>">
        			<div data-id="post-<?php echo $key+1; ?>" data-type="<?php echo $portfolio_item_set; ?>">
        			<?php
        				$portfolio_type = get_post_meta($portfolio_ID, 'portfolio_type', true);
        				$portfolio_video_id = get_post_meta($portfolio_ID, 'portfolio_video_id', true);
        				switch($portfolio_type)
        				{
        				case 'External Link':
        				default:
        			?>
        			<div class="portfolio195_shadow">
        				<a href="<?php echo $permalink_url; ?>">
        					<img src="<?php echo $image_url[0]?>" alt="" class="portfolio_img"/>
        					<div class="portfolio195_overlay">
        						<div class="overlay_icon_circle">
	        						<img src="<?php echo get_stylesheet_directory_uri(); ?>/images/icon_link.png" alt="" class=""/>
	        					</div>
        					</div>
        				</a>
        			</div>
        			
        			<?php
        				break;
        				//end external link
        				
        				case 'Portfolio Content':
        				default:
        			?>
        			<div class="portfolio195_shadow">
        				<a href="<?php echo get_permalink($portfolio_ID); ?>">
        					<img src="<?php echo $image_url[0]?>" alt="" class="portfolio_img"/>
        					<div class="portfolio195_overlay">
        						<div class="overlay_icon_circle">
	        						<img src="<?php echo get_stylesheet_directory_uri(); ?>/images/icon_link.png" alt="" class=""/>
	        					</div>
        					</div>
        				</a>
        			</div>
        			
        			<?php
        				break;
        				//end Portfolio Content
        				
        				case 'AJAX Portfolio Content':
        				
        				//Get portfolio gallery ID
        				$portfolio_gallery_id = get_post_meta($portfolio_ID, 'portfolio_gallery_id', true);
        			?>
        			<div class="portfolio195_shadow">
        				<a href="javascript:;" data-rel="<?php echo $portfolio_ID; ?>" class="ajax_portfolio_link">
        					<img src="<?php echo $image_url[0]?>" alt="" class="portfolio_img"/>
        					<div class="portfolio195_overlay">
        						<div class="overlay_icon_circle">
	        						<img src="<?php echo get_stylesheet_directory_uri(); ?>/images/icon_link.png" alt="" class=""/>
	        					</div>
        					</div>
        				</a>
        			</div>
        			
        			<?php
        				break;
        				//end AJAX Portfolio Content
        				
        				case 'Image':
        			?>
        			<div class="portfolio195_shadow">
        				<a href="<?php echo $full_image_url[0]; ?>" class="img_frame">
        					<img src="<?php echo $image_url[0]?>" alt="" class="portfolio_img"/>
        					<div class="portfolio195_overlay">
        						<div class="overlay_icon_circle">
	        						<img src="<?php echo get_stylesheet_directory_uri(); ?>/images/icon_image.png" alt="" class=""/>
	        					</div>
        					</div>
        				</a>
        			</div>
        			
        			<?php
        				break;
        				//end image
        				
        				case 'Youtube Video':
        			?>
        			<div class="portfolio195_shadow">
        				<a href="#video_<?php echo $portfolio_video_id; ?>" class="lightbox_youtube">
        					<img src="<?php echo $image_url[0]?>" alt="" class="portfolio_img"/>
        					<div class="portfolio195_overlay">
        						<div class="overlay_icon_circle">
	        						<img src="<?php echo get_stylesheet_directory_uri(); ?>/images/icon_video.png" alt="" class=""/>
	        					</div>
        					</div>
        				</a>
        			</div>
    									
    				<div style="display:none;">
    				    <div id="video_<?php echo $portfolio_video_id; ?>" style="width:900px;height:488px">
    				        
    				        <iframe title="YouTube video player" width="900" height="488" src="http://www.youtube.com/embed/<?php echo $portfolio_video_id; ?>?theme=dark&amp;rel=0&amp;wmode=transparent" frameborder="0" allowfullscreen></iframe>
    				        
    				    </div>	
    				</div>
    								
    				<?php
    				    break;
    				    //end youtube
    				
    				case 'Vimeo Video':
    				?>
    				<div class="portfolio195_shadow">
    				    <a href="#video_<?php echo $portfolio_video_id; ?>" class="lightbox_vimeo">
    				    	<img src="<?php echo $image_url[0]?>" alt="" class="portfolio_img"/>
    				    	<div class="portfolio195_overlay">
        						<div class="overlay_icon_circle">
	        						<img src="<?php echo get_stylesheet_directory_uri(); ?>/images/icon_video.png" alt="" class=""/>
	        					</div>
        					</div>
    				    </a>
    				</div>
    									
    				<div style="display:none;">
    				    <div id="video_<?php echo $portfolio_video_id; ?>" style="width:900px;height:506px">
    				    
    				        <iframe src="http://player.vimeo.com/video/<?php echo $portfolio_video_id; ?>?title=0&amp;byline=0&amp;portrait=0&amp;color=ffffff" width="900" height="506" frameborder="0"></iframe>
    				        
    				    </div>	
    				</div>
    								
    				<?php
    				    break;
    				    //end vimeo
    				    
    				    case 'Self-Hosted Video':
    				    
    				    //Get video URL
						$portfolio_mp4_url = get_post_meta($portfolio_ID, 'portfolio_mp4_url', true);
						$preview_image = wp_get_attachment_image_src($image_id, 'large', true);
    				?>
    				<div class="portfolio195_shadow">
    				    <a href="#video_self_<?php echo $key; ?>" class="lightbox_vimeo">
    				    	<img src="<?php echo $image_url[0]?>" alt="" class="portfolio_img"/>
    				    	<div class="portfolio195_overlay">
        						<div class="overlay_icon_circle">
	        						<img src="<?php echo get_stylesheet_directory_uri(); ?>/images/icon_video.png" alt="" class=""/>
	        					</div>
        					</div>
    				    </a>
    				</div>
    									
    				<div style="display:none;">
			    	    <div id="video_self_<?php echo $key; ?>" style="width:900px;height:488px">
			    	    
			    	        <div id="self_hosted_vid_<?php echo $key; ?>">JW Player goes here</div>
					
					    	<script type="text/javascript">
					    		jwplayer("self_hosted_vid_<?php echo $key; ?>").setup({
					    			flashplayer: "<?php echo get_stylesheet_directory_uri(); ?>/js/player.swf",
					    			file: "<?php echo $portfolio_mp4_url; ?>",
					    			image: "<?php echo $preview_image[0]; ?>",
					    			width: 900,
					    			height: 488,
					    		});
					    	</script>
			    	        
			    	    </div>	
			    	</div>
    								
    				<?php
    				    break;
    				    //end self-hosted
    				?>
    				
    				<?php
    				    }
    				?>
    				    
    				    <div class="portfolio_desc portfolio_desc_195">
    				    	<h6 class="cufon"><?php echo $portfolio_title?></h6>
    				    	<span>
    				    	<?php echo pp_substr(strip_tags(strip_shortcodes(get_the_excerpt())), 100); ?>																
    				    	</span>
    				    </div>
    				</div>
    			</div>
    			    
    			<?php
    			    endwhile;
    			    //End while loop
    			    
    			?>
    		</div>
    		<?php
    			
    		}
    		//End if have portfolio items
    		?>
    		
    		<br class="clear"/>
    		<?php
			 	if (function_exists("wpapi_pagination")) {
			 		wpapi_pagination($wp_query->max_num_pages);
			 	}
			 	
			 	$wp_query = null; 
			 	$wp_query = $temp;
			?>
    		</div>
		
		<div class="sidebar_wrapper">
		
		    <div class="sidebar_top"></div>
		
		    <div class="sidebar">
		    
		    	<div class="content">
		    	
		    		<ul class="sidebar_widget">
		    		<?php dynamic_sidebar($page_sidebar); ?>
		    		</ul>
		    	
		    	</div>
		
		    </div>
		    <br class="clear"/>
		
		    <div class="sidebar_bottom"></div>
		</div>
				
<?php
if(!isset($hide_header) OR !$hide_header)
{
?>				
		</div>
		<!-- End main content -->
					
		<br class="clear"/>
				
	</div>
			
</div>
<!-- End content -->
				

<?php get_footer(); ?>
<?php
}
else
{
?>
<br class="clear"/>
<?php
}
?>