<?php header("Content-type: text/css; charset: UTF-8"); ?> 

<?php
require_once( '../../../../wp-load.php' );

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

foreach($slider_arr as $key => $gallery_item)
{
	//Get slide title, content and image position
	$slide_content_top = get_post_meta($gallery_item->ID, 'slide_content_top', true);
	if(empty($slide_content_top))
	{
	    $slide_content_top = 0;
	}
	$slide_content_left = get_post_meta($gallery_item->ID, 'slide_content_left', true);
	if(empty($slide_content_left))
	{
	    $slide_content_left = 0;
	}
?>
.caption_<?php echo $key+1; ?> { top:<?php echo $slide_content_top; ?>%;left:<?php echo $slide_content_left; ?>%; }
<?php
}
?>