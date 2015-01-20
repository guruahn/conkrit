<?php
/**
 * The main template file for display gallery page.
 *
 * @package WordPress
*/

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
		    		if(!empty($page->post_content))
		    		{
		    			echo pp_apply_content($page->post_content);
		    		}
		    	?>
		    	
		    	<!-- Begin portfolio content -->
		    	
		    	<?php
		    		$menu_sets_query = '';

		    		$portfolio_items = -1;
		    		
		    		$portfolio_sort = get_option('pp_gallery_sort'); 
		    		if(empty($portfolio_sort))
		    		{
		    			$portfolio_sort = 'DESC';
		    		}
		    		
		    		$args = array( 
		    			'post_type' => 'attachment', 
		    			'numberposts' => $portfolio_items, 
		    			'post_status' => null, 
		    			'post_parent' => $post->ID,
		    			'order' => 'ASC',
		    			'orderby' => 'menu_order',
		    		); 								
		    		$all_photo_arr = get_posts( $args );
		
		    		if(isset($all_photo_arr) && !empty($all_photo_arr))
		    		{

		    	?>
		    	
		    	<div class="portfolio-content section content clearfix"> 
		    		<?php

		    		    foreach($all_photo_arr as $key => $portfolio_item)
		    		    {
		    		    	$image_url = wp_get_attachment_image_src($portfolio_item->ID, 'portfolio4', true);
				        	$full_image_url = wp_get_attachment_image_src($portfolio_item->ID, 'full', true);
		    		    	
		    		    	$portfolio_item_class = 'one_fourth';
		    		    	if(($key+1) % 4 == 0)
		    		    	{	
		    		    		$portfolio_item_class.= ' last';
		    		    	}
		    		?>
		    		    			<div class="<?php echo $portfolio_item_class?> gallery">
		    		    			<div class="portfolio200_shadow">
		    		    				<a title="<?php echo $portfolio_item->post_title; ?>" href="<?php echo $full_image_url[0]?>" rel="gallery">
		    		    					<img src="<?php echo $image_url[0]?>" alt="" class="portfolio_img" />
		    		    					<div class="portfolio200_overlay">
				        						<div class="overlay_icon_circle">
				        							<img src="<?php echo get_stylesheet_directory_uri(); ?>/images/icon_image.png" alt="" class=""/>
				        						</div>
				        					</div>
		    		    				</a>
		    		    			</div>
		    		    			</div>
		    		
		    		<?php
		    		    }
		    		    //End foreach loop
		    		    
		    		?>
		    			
		    	</div>
		    	
		    	<?php
		    			
		    	}
		    	//End if have portfolio items
		    	?>
		    	    
		    </div>
		    <!-- End main content -->
		    
		    <br class="clear"/>
	</div>		
</div>
<!-- End content -->				

<?php get_footer(); ?>