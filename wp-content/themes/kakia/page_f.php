<?php
/**
 * Template Name: Page Fullwidth
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

// Check if use page builder
$ppb_form_data_order = '';
$ppb_form_item_arr = array();
$ppb_enable = get_post_meta($current_page_id, 'ppb_enable', true);
?>	
</div>

<div class="page_caption">
	<div class="caption_header">
        <?php if ( has_post_thumbnail() ) : ?>
            <div class="caption_bg">
                <?php the_post_thumbnail(); ?>
            </div>
        <?php endif; ?>
        <?php
        breadcrumbs('primary-menu');
        ?>

	</div>
	<br class="clear"/>
</div>


<!-- Begin content -->
<div id="content_wrapper">

    <div class="inner">
    
    	<!-- Begin main content -->
    	<div class="inner_wrapper">
    	
    		<div class="standard_wrapper">
                <div class="title">
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

<?php
}
?>		
    			<?php if ( empty($ppb_enable) && have_posts() ) {
    				while ( have_posts() ) : the_post(); ?>		
    	
    				<?php the_content(); break;  ?>

    			<?php endwhile; 
	    			}
	    			else //Display Page Builder Content
	    			{
	    				pp_apply_builder($current_page_id);
    				}
    			?>
    
    		</div>
    		<br class="clear"/>
    		
   		 </div>
   	 	<!-- End main content -->
   	 	
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