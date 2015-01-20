<?php
    	//Get slider items setting
    	$pp_slider_items = get_option('pp_slider_items');
    	if(empty($pp_slider_items))
    	{
    		$pp_slider_items = 5;
    	}
    	
    	//Get slider timer setting
    	$pp_slider_timer = get_option('pp_slider_timer');
    	if(empty($pp_slider_timer))
    	{
    		$pp_slider_timer = 5;
    	}
    
    	$slider_arr = get_posts('numberposts='.$pp_slider_items.'&order=ASC&orderby=menu_order&post_type=slides');

    	if(!empty($slider_arr))
    	{
    		$pp_homepage_transition = get_option('pp_homepage_transition');
?>

    	<div id="cute_slider" data-width="960" data-height="430" data-usethumb="false" data-overpause='true' data-force="<?php if($pp_homepage_transition == '2D') { echo '2d'; } ?>">
    		<ul data-type="slides">
    		<?php
    			$slide_count = count($slider_arr);
    			
    		    foreach($slider_arr as $key => $gallery_item)
    		    {
    		    	//Get slide content type
    			    $slide_type = get_post_meta($gallery_item->ID, 'slide_type', true);
    			    	
    		       	$image_url = '';
    		       
    		       	if(has_post_thumbnail($gallery_item->ID, 'slide'))
    		       	{
    		       		$image_id = get_post_thumbnail_id($gallery_item->ID);
    		       		$image_url = wp_get_attachment_image_src($image_id, 'slide', true);
    		       		$thumb_url = wp_get_attachment_image_src($image_id, 'slide_thumb', true);
    		       	}
    		       					
    		       	$hyperlink_url = get_post_meta($gallery_item->ID, 'slide_link_url', true);
    		       	$slide_display_content = get_post_meta($gallery_item->ID, 'slide_display_content', true);
    		       	
    		       	$slide_transition = get_post_meta($gallery_item->ID, 'slide_transition', true);
    		       	if(empty($slide_transition))
    		       	{
	    		       	$slide_transition = 'tr1';
    		       	}
    		       	if($slide_transition == 'random')
    		       	{
    		       		$slide_transition = '';
    		       		for ($i = 1; $i <= 5; $i++) {
	    		       		$slide_transition .= 'tr'.rand(1, 64);
	    		       		
	    		       		if($i != 5)
	    		       		{
		    		       		$slide_transition.= ',';
	    		       		}
	    		       	}
    		       	}
    		       	
    		       	$slide_video_id = get_post_meta($gallery_item->ID, 'slide_video_id', true);
    		       	
    		       	if($pp_homepage_transition == '2D' && $slide_transition > 41)
    		       	{
	    		       	$slide_transition = 1;
    		       	}
    		       	?>
    		           
    		           <li data-delay="<?php echo $pp_slider_timer; ?>" data-trans3d="tr<?php echo $slide_transition; ?>" data-trans2d="tr<?php echo $slide_transition; ?>">
    		           	<?php
    		           		if(isset($image_url[0]) && isset($thumb_url[0]))
    		           		{
    		           	?>
    		           		<img src="<?php echo $image_url[0];?>" data-src="<?php echo $image_url[0];?>" data-thumb="<?php echo $thumb_url[0]; ?>" alt=""/>
    		           		
    		           		<?php
    		           			switch($slide_type)
    		           			{
    		           			case 'Image':
    		           			default:
    		           		?>
	    		           			<a data-type="link" href="<?php echo $hyperlink_url; ?>" ></a>
	    		           	<?php
	    		           		break;
	    		           		
	    		           		case 'Vimeo Video'
	    		           	?>
	    		           			<a data-type="video" href="http://player.vimeo.com/video/<?php echo $slide_video_id; ?>" ></a>
	    		           	<?php
	    		           		break;
	    		           		
	    		           		case 'Youtube Video'
	    		           	?>
	    		           			<a data-type="video" href="http://www.youtube.com/embed/<?php echo $slide_video_id; ?>" ></a>
	    		           	<?php
	    		           		break;
	    		           	?>
	    		           	?>
	    		           	<?php
	    		           		}
	    		           	?>
    		           		
    		           	<?php
    		           		}
    		           	?>
    		           
    		           <?php if(!empty($slide_display_content)) { ?>
    		           <ul data-type="captions">
						    <li class="caption_<?php echo $key+1; ?> caption_bg" data-delay="200" data-effect="fade">
						        <h4><?php echo htmlentities($gallery_item->post_title); ?></h4>
						        <?php echo pp_apply_content($gallery_item->post_content); ?>
						    </li>
    		           </ul>
    		           <?php } ?>
    		           
    		           </li>
    		   
    		  <?php
    		  }
    		   //end foreach
    		  ?>
    		</ul>
    		
    		<ul data-type="controls">
    			<li data-type="captions"> </li>			
			    <li data-type="link"> </li>
			    <li data-type="video"> </li>
			    <li data-type="next"> </li>
			    <li data-type="previous"> </li>
			</ul>
    	</div>

<?php 
    	}
?>

<?php
    $pp_slider_autoplay = get_option('pp_slider_autoplay');
?>

<script type="text/javascript"> 
Cute.ModuleLoader.css3d_files    =  ['<?php echo get_stylesheet_directory_uri()?>/js/cute/cute.css3d.module.js'];
Cute.ModuleLoader.canvas_files  =  ['<?php echo get_stylesheet_directory_uri()?>/js/cute/cute.canvas.module.js'];
Cute.ModuleLoader.dom2d_files  =  ['<?php echo get_stylesheet_directory_uri()?>/js/cute/cute.2d.module.js'];
var myslider = new Cute.Slider();
myslider.setup("cute_slider" , "slider_wrapper");
</script>