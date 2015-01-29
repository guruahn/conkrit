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
        <div class="caption_bg">
            <?php if ( has_post_thumbnail() ) : ?>
                <?php the_post_thumbnail(); ?>
            <?php endif; ?>
        </div>
        <?php
        //printr(get_nav_menu_locations());
        if ( ( $locations = get_nav_menu_locations() ) && isset( $locations[ 'primary-menu' ] ) ) {
            $menu = wp_get_nav_menu_object( $locations[ 'primary-menu' ] );
            $menu_items = wp_get_nav_menu_items($menu->term_id);
            //($menu_items);
            $menu = wp_get_nav_menu_items($menu->term_id,array(
                'posts_per_page' => -1,
                'meta_key' => '_menu_item_object_id',
                'meta_value' => $post->ID // the currently displayed post
            ));

            //$menu = $menu[0];

            if(!$menu[0]->post_title){
                $menu[0]->post_title = $page->post_title;
            }
            //printr($menu);

            foreach($menu_items as $item){
                if( $item->ID == $menu[0]->menu_item_parent){
                    $parent = $item;
                }
            }
            if(!$parent->post_title){
                $parent->post_title = get_the_title( $parent->object_id );
            }
            $menu[] = $parent;
            foreach($menu_items as $item){
                if( $item->ID == $parent->menu_item_parent){
                    $parent_of_parent = $item;
                }
            }
            if(!$parent_of_parent->post_title){
                $parent_of_parent->post_title = get_the_title( $parent_of_parent->object_id );
            }
            $menu[] = $parent_of_parent;
            //printr($menu);
        }

        ?>
        <div class="breadcrumbs">
            <a href="/" ><span>home</span></a>
            <?php
            for($i=count($menu)-1 ; $i >= 0 ; $i--){
                $breadcrumb = '<span>'.$menu[$i]->post_title.'</span>';
                if($menu[$i]->url && $i != 0) $breadcrumb = '<a href="'.$menu[$i]->url.'" >'.$breadcrumb.'</a>';
                echo $breadcrumb;
            }
            foreach($menu as $item){

            }
            ?>
        </div>
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