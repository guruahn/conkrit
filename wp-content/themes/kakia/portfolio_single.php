<?php
/**
 * The main template file for display single portfolio page.
 *
 * @package WordPress
*/

get_header(); 

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

//Get portfolio gallery ID
$portfolio_gallery_id = get_post_meta($current_page_id, 'portfolio_gallery_id', true);


//Get slider animation
$pp_portfolio_slider_animation = get_option('pp_portfolio_slider_animation');
if(empty($pp_portfolio_slider_animation))
{
    $pp_portfolio_slider_animation = 'fade';
}
?>
		
</div>

<div class="page_caption">
	<div class="caption_inner">
		<div class="caption_header">
			<h1 class="cufon"><span><?php the_title(); ?></span></h1>
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
    		<div class="portfolio_single_navi">
    			<?php next_post_link('%link', '→'); ?>
    			<?php previous_post_link('%link', '←'); ?>
    		</div>
    	
    		<?php
    		
    		$pp_portfolio_enable_feat = get_option('pp_portfolio_enable_feat');
    		if(!empty($pp_portfolio_enable_feat))
    		{
    			//If display featured image
    			if(empty($portfolio_gallery_id))
    			{
			    	$image_thumb = '';
			    								
			    	if(has_post_thumbnail(get_the_ID(), 'slide'))
			    	{
			    	    $image_id = get_post_thumbnail_id(get_the_ID());
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
			<div id="slider_wrapper" <?php if($pp_portfolio_slider_animation=='slide') { ?>class="slide"<?php } ?>>
				<div id="portfolio_slider" class="flexslider">
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
		    		$all_photo_arr = get_posts( $args );
		    		
		    		foreach($all_photo_arr as $key => $photo_item)
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
			    $j('#portfolio_slider').flexslider({
			    	animation: "<?php echo $pp_portfolio_slider_animation; ?>",
			    	<?php
					if(empty($pp_portfolio_slider_autoplay))
					{
					?>
					slideshow: false,
					<?php
					}
					?>
					slideshowSpeed: <?php echo $pp_portfolio_slider_timer*1000; ?>
			    });
			});
			</script>
			<?php
				}
			}
			?>
    		
    	</div>
    	
    	<?php

			if (have_posts()) : while (have_posts()) : the_post();

				if(!empty($pp_portfolio_enable_feat))
				{
					echo '<br class="clear"/>';
				}
    		    the_content();
    		    echo '<br class="clear"/>';
    		    
    		endwhile; endif; 
    		
    	?>
    	
    	<?php 
    		//If enable recent portfolios
    		$pp_portfolio_enable_recent = get_option('pp_portfolio_enable_recent');
    		$pp_portfolio_recent_items = get_option('pp_portfolio_recent_items');
    		if(empty($pp_portfolio_recent_items))
    		{
    			$pp_portfolio_recent_items = 12;
    		}
    		
    		if(!empty($pp_portfolio_enable_recent))
			{
    			echo do_shortcode('[portfolio2 title="'.__( 'Recent Portfolios', THEMEDOMAIN ).'" items="'.$pp_portfolio_recent_items.'" set_id="" pause_time="10"]');
    		}
    	?>
    	<!-- End main content -->
    </div>
</div>
				

<?php get_footer(); ?>