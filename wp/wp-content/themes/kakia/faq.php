<?php
/**
 * Template Name: FAQ Page Fullwidth
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
    				//Display FAQs
    				$temp = $wp_query; 
					$wp_query = null; 
					$wp_query = new WP_Query(); 
					$wp_query->query('showposts=-1&post_type=faq&orderby=menu_order&order=ASC');
					
			    	while ($wp_query->have_posts()) : $wp_query->the_post(); 
			    	
						echo do_shortcode('[accordion close="1" title="'.get_the_title().'"]'.get_the_content().'[/accordion]');
						
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