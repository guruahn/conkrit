<?php
/**
 * The main template file.
 *
 * @package WordPress
 */
				
get_header(); 
?>

<?php
//Check if enable slider
$pp_slider_display = get_option('pp_slider_display');

if(!empty($pp_slider_display))
{

//Check slider engine
$pp_slider_type = get_option('pp_slider_type');

if(isset($_SESSION['pp_home_style']) && ($_SESSION['pp_home_style']==5))
{
    $pp_slider_type = 'cute';
}

if(isset($_SESSION['pp_home_style']) && ($_SESSION['pp_home_style']==3))
{
    $pp_slider_type = 'revslider';
}

//Check if revslider activated
include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
$is_revslider_active = is_plugin_active('revslider/revslider.php');

if($pp_slider_type == 'revslider' && !$is_revslider_active)
{
	$pp_slider_type = 'layerslider';
}

if($pp_slider_type=='layerslider')
{
	//Select which layerslider
	$pp_slider_layerslider_id = get_option('pp_slider_layerslider_id');
	
	//Check if demo slider purpose
	if(isset($_SESSION['pp_home_style']) && ($_SESSION['pp_home_style']==2 OR $_SESSION['pp_home_style']==5))
	{
		$pp_slider_layerslider_id = 4; //Select fullwidth slider
	}

	if(!empty($pp_slider_layerslider_id))
	{
		//Get WPDB Object
		global $wpdb;
		
		//Table name
		$table_name = $wpdb->prefix . "layerslider";
		
		//Get sliders
		$slider_obj = $wpdb->get_results( "SELECT * FROM $table_name WHERE flag_hidden = '0' AND flag_deleted = '0' AND id = '$pp_slider_layerslider_id' ORDER BY date_c ASC LIMIT 100" );
		$slider_data = json_decode($slider_obj[0]->data);
		
		$is_fullwidth_slider = FALSE;
		$slider_css_style = '';
		$slider_bg_css_style = '';
		$slider_width = $slider_data->properties->width;
		$slider_height = $slider_data->properties->height;
		
		if(isset($slider_data->properties->forceresponsive))
		{
			$is_fullwidth_slider = TRUE;
			$slider_css_style = 'style="margin-top:0;height:'.$slider_height.'px;"';
			$slider_bg_css_style = 'style="height:'.$slider_height.'px;background:none;"';
		}
		else
		{
			$slider_css_style = 'style="width:'.$slider_width.'px;height:'.$slider_height.'px;"';
			$slider_bg_css_style = 'style="width:'.$slider_width.'px;height:'.($slider_height+50).'px;"';
		}
?>
<div class="slider_wrapper_bg" <?php echo $slider_bg_css_style; ?>>
	
	<div id="slider_wrapper" class="layerslider" <?php echo $slider_css_style; ?>>
		<?php echo do_shortcode('[layerslider id="'.$pp_slider_layerslider_id.'"]'); ?>
	</div>
</div>
<?php
	}
}
elseif($pp_slider_type=='revslider')
{
	//Select which revslider
	$pp_slider_revslider_id = get_option('pp_slider_revslider_id');
	
	if(!empty($pp_slider_revslider_id))
	{
		putRevSlider($pp_slider_revslider_id);
	}
}
elseif($pp_slider_type=='cute')
{
	//Check if slides is empty
	$slider_arr = get_posts('numberposts=1&order=ASC&orderby=menu_order&post_type=slides');
?>
<div class="slider_wrapper_bg">
	
	<div id="slider_wrapper" class="cute">
	
	    <?php
	    	include (TEMPLATEPATH . "/templates/template-slider-cuteslider.php");
	    ?>
	    
	</div>
</div>
<?php
} //end if cute slider

} //end if enable slider
?>

</div>
<!-- End header bg -->

<?php
$pp_homepage_enable_header = get_option('pp_homepage_enable_header');

//Check if demo slider purpose
if(isset($_SESSION['pp_home_style']) && ($_SESSION['pp_home_style']==2 OR  $_SESSION['pp_home_style']==3))
{
	$pp_homepage_enable_header = TRUE;
}

if(!empty($pp_homepage_enable_header))
{
?>
<div class="tagline_wrapper">
	<div class="tagline">
		<?php
			$pp_homepage_header_text = get_option('pp_homepage_header_text');
			
			if(!empty($pp_homepage_header_text))
			{
		?>
			<h2><?php echo stripslashes($pp_homepage_header_text); ?></h2>
		<?php
			}
		?>
		
		<?php
			$pp_homepage_description_text = get_option('pp_homepage_description_text');
			
			if(!empty($pp_homepage_description_text))
			{
				echo stripslashes($pp_homepage_description_text);
			}
		?>
	</div>
</div>
<?php
}
?>

<!-- Begin content -->
<div id="content_wrapper">

<div class="inner">

    <!-- Begin main content -->
    <div class="inner_wrapper">

    <div class="standard_wrapper">
    	
    	<?php 
    			global $wp_query, $pp_homepage_content;
    	
    			if(isset($_SESSION['pp_home_style']))
				{
				    switch($_SESSION['pp_home_style'])
				    {
				    	case 1:
				    		$pp_homepage_content = array(5844, 5358, 5866);
				    		break;
				    	case 2:
				    		$pp_homepage_content = array(3411);
				    		break;
				    	case 3:
				    		$pp_homepage_content = array(5413);
				    		break;
				    	case 4:
				    		$pp_homepage_content = array(5418);
				    		break;
				    	case 5:
				    		$pp_homepage_content = array(5891);
				    		break;
				    	default:
				    		$pp_homepage_content = array(3411);
				    		break;
				    }
				    $has_homepage_content = get_option('pp_homepage_content');
				}
				elseif(empty($pp_homepage_content))
				{
				    $pp_homepage_content = unserialize(get_option('pp_homepage_content_sort_data'));
				    $has_homepage_content = get_option('pp_homepage_content');
				}

    			if(is_array($pp_homepage_content) && !empty($pp_homepage_content) && !empty($has_homepage_content))
    			{
    				$count_content = count($pp_homepage_content);
    			
    				foreach($pp_homepage_content as $key => $pp_homepage)
    				{
    					if(!empty($pp_homepage))
    					{
	    					$template_name = get_post_meta( $pp_homepage, '_wp_page_template', true );
	
	    					if(empty($template_name) OR $template_name == 'default')
	    					{
	    						$obj_home = get_page($pp_homepage);
	    					
	    						//Check if use WPML plugin and get current language
	    						if(defined('ICL_LANGUAGE_CODE'))
	    						{
	    							//Get page ID of translated page
	    							$pp_translated_home = icl_object_id( $obj_home->ID, 'page', false, ICL_LANGUAGE_CODE );
	    							$obj_translated_home = get_page($pp_translated_home);
	    							$pp_home_content = $obj_translated_home->post_content;
	    							
	    							//Assign current page ID
	    							$current_page_id = $pp_translated_home;
	    						}
	    						else
	    						{
	    							//Get Homepage content
	    					    	$pp_home_content = $obj_home->post_content;
	    					    	
	    					    	//Assign current page ID
	    					    	$current_page_id = $pp_homepage;
	    						}
	    					    
	    					    $page_style = get_post_meta($pp_homepage, 'page_style', true);
	    						$page_sidebar = get_post_meta($pp_homepage, 'page_sidebar', true);
	    						
	    						if(empty($page_sidebar))
	    						{
	    							$page_sidebar = 'Page Sidebar';
	    						}
	    						
	    						if(empty($page_style))
	    						{
	    							$page_style = 'Fullwidth';
	    						}
	    						
	    						$add_sidebar = FALSE;
	    						$sidebar_class = '';
	    						
	    						if($page_style == 'Right Sidebar')
	    						{
	    							$add_sidebar = TRUE;
	    							$page_class = 'sidebar_content';
	    						}
	    						elseif($page_style == 'Left Sidebar')
	    						{
	    							$add_sidebar = TRUE;
	    							$page_class = 'sidebar_content';
	    							$sidebar_class = 'left_sidebar';
	    						}
	    						else
	    						{
	    							$page_class = 'inner_wrapper';
	    						}
	    					    
	    		?>
	    		
	    	<?php
	    		if($add_sidebar && $page_style == 'Left Sidebar')
	    		{
	    	?>
	    		<div class="sidebar_wrapper <?php echo $sidebar_class; ?>">
	    		
	    			<div class="sidebar_top <?php echo $sidebar_class; ?>"></div>
	    		
	    			<div class="sidebar <?php echo $sidebar_class; ?> <?php echo $sidebar_home; ?>">
	    			
	    				<div class="content">
	    			
	    					<ul class="sidebar_widget">
	    					<?php dynamic_sidebar($page_sidebar); ?>
	    					</ul>
	    				
	    				</div>
	    		
	    			</div>
	    			<br class="clear"/>
	    	
	    			<div class="sidebar_bottom <?php echo $sidebar_class; ?>"></div>
	    		</div>
	    	<?php
	    		}
	    	?>
	    	
	    	<?php if($add_sidebar) { ?>
	    		<div class="sidebar_content <?php echo $sidebar_class; ?>">
	    	<?php } ?>
	    	
	    	<?php 
	    		$ppb_enable = get_post_meta($pp_homepage, 'ppb_enable', true);
	    		
	    		if(!$ppb_enable)
	    		{
	    			echo pp_apply_content($pp_home_content); 
	    		}
	    		else
	    		{
		    		pp_apply_builder($pp_homepage);
	    		}
	    	?>
	    	<br class="clear"/>
	    	
	    	<?php if($add_sidebar) { ?>
	    		</div>
	    	<?php } ?>
	    	
	    	<?php
	    		if($add_sidebar && $page_style == 'Right Sidebar')
	    		{
	    	?>
	    	
	    		<div class="sidebar_wrapper <?php echo $sidebar_class; ?>">
	    		
	    			<div class="sidebar_top <?php echo $sidebar_class; ?>"></div>
	    		
	    			<div class="sidebar <?php echo $sidebar_class; ?> <?php echo $sidebar_home; ?>">
	    			
	    				<div class="content">
	    			
	    					<ul class="sidebar_widget">
	    					<?php dynamic_sidebar($page_sidebar); ?>
	    					</ul>
	    				
	    				</div>
	    		
	    			</div>
	    			<br class="clear"/>
	    	
	    			<div class="sidebar_bottom <?php echo $sidebar_class; ?>"></div>
	    		</div>
	    	<?php
	    		}
	    	?>
	    		
	    		<?php
	    					}
	    					else
	    					{
	    					    $hide_header = TRUE;
	
	    					    if($key > 0)
	    					    {
	    					    	//echo '<br class="clear"/>';
	    					    }
	    					    
	    					    if(file_exists(TEMPLATEPATH.'/'.$template_name))
	    					    {
	    					    	//Assign current page ID
	    					    	$current_page_id = $pp_homepage;
	    					    	
	    					    	include(TEMPLATEPATH.'/'.$template_name);
	    					    }
	    					}
    					
    					} //end if page is empty
    					
    				}
    			}
    			else
			    {
			     		echo '<div class="notice">Please setup homepage content using Wordpress Dashboard > Theme Settings > Homepage</div>';
			    }
    		?>
    </div>

</div>

</div>

<?php get_footer(); ?>