<?php
/**
 * Template Name: Team Page
 * The main template file for display page.
 *
 * @package WordPress
*/

include (get_template_directory() . "/lib/fallback.home.lib.php");

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
else
{
	global $query_string;
	query_posts($query_string . "&page_id=".$current_page_id);
}

if(!isset($hide_header) OR !$hide_header)
{
	get_header(); 
}

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
    			<?php if ( (!isset($hide_header) OR !$hide_header) && have_posts() ) while ( have_posts() ) : the_post(); ?>
    	
    				<?php the_content(); break;  ?>

    			<?php endwhile; ?>
    			
    			<?php
    				//Display team member
    				$temp = $wp_query; 
					$wp_query = null; 
					$wp_query = new WP_Query(); 
					$wp_query->query('showposts=-1&post_type=team&orderby=menu_order&order=ASC');
					$key = 0;
					
			    	while ($wp_query->have_posts()) : $wp_query->the_post(); 
			        	$image_url = '';
			        	$member_ID = get_the_ID();
			    
			        	if(has_post_thumbnail($member_ID, 'portfolio3'))
			        	{
			        		$image_id = get_post_thumbnail_id($member_ID);
			        		$image_url = wp_get_attachment_image_src($image_id, 'portfolio3', true);
			        	}
			        	
			        	$last_class = '';
			        	if(($key+1) % 3 == 0)
			        	{	
			        		$last_class = ' last';
			        	}
			        	$key++;
			        	
			        	$member_position = get_post_meta($member_ID, 'member_position', true);
			        	$member_facebook = get_post_meta($member_ID, 'member_facebook', true);
			        	$member_twitter = get_post_meta($member_ID, 'member_twitter', true);
			        	$member_google = get_post_meta($member_ID, 'member_google', true);
			        	$member_linkedin = get_post_meta($member_ID, 'member_linkedin', true);
			    ?>
					<div class="one_third <?php echo $last_class; ?> member_item">
						<img src="<?php echo $image_url[0]?>" alt="" class="member_img" /><br/>
						<h4><?php the_title(); ?></h4>
						<span class="member_position"><?php echo $member_position; ?></span>
						<?php the_content(); ?>
						<ul class="social_wrapper team">
					    	<?php
					    		if(!empty($member_twitter))
					    		{
					    	?>
					    	<li><a title="Twitter" href="http://twitter.com/<?php echo $member_twitter; ?>"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/team_social/twitter.png" alt=""/></a></li>
					    	<?php
					    		}
					    	?>
					    	<?php
					    		if(!empty($member_facebook))
					    		{
					    	?>
					    	<li><a title="Facebook" href="http://facebook.com/<?php echo $member_facebook; ?>"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/team_social/facebook.png" alt=""/></a></li>
					    	<?php
					    		}
					    	?>
					    	<?php
					    		if(!empty($member_google))
					    		{
					    	?>
					    	<li><a title="Google+" href="<?php echo $member_google; ?>"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/team_social/google.png" alt=""/></a></li>
					    	<?php
					    		}
					    	?>
					    	<?php
					    		if(!empty($member_linkedin))
					    		{
					    	?>
					    	<li><a title="Linkedin" href="<?php echo $member_linkedin; ?>"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/team_social/linkedin.png" alt=""/></a></li>
					    	<?php
					    		}
					    	?>
					    </ul>
					</div>
					
				<?php
					endwhile;
	    			//End while loop
	    		?>
    
    		</div>
    		<br class="clear"/>
    		
   		 </div>
   	 	<!-- End main content -->
   	 	
	</div>
</div>
			
<?php 
if(!isset($hide_header) OR !$hide_header OR is_null($hide_header))
{
?>			
</div>
<?php get_footer(); ?>

<?php
}
?>