<?php header("Content-type: text/css; charset: UTF-8"); ?> 

<?php
require_once( '../../../../wp-load.php' );

if(session_id() == '') {
	session_start();
}
?>

<?php
$custom_skin_arr = array();

wp_reset_query();
global $wpdb;

$pp_skins_obj = array();

$wpdb->query("SELECT * FROM `".$wpdb->prefix."options` WHERE `option_name` = '".$_SESSION['pp_skin']."'");
$pp_skins_obj = $wpdb->last_result;
$skin_settings_arr = unserialize($pp_skins_obj[0]->option_value);

foreach($skin_settings_arr['settings'] as $key => $skin_setting)
{
    if(!empty($skin_setting))
    {
    	$custom_skin_arr[$key] = $skin_setting;
    }
}

?>

<?php
	$pp_blog_title_font_color = $custom_skin_arr['pp_blog_title_font_color'];
	
	if(!empty($pp_blog_title_font_color))
	{
?>
.post_header h3 a { color:<?php echo $pp_blog_title_font_color; ?>; }
<?php
	}
?>

<?php
	$pp_dropcap_bg_color = $custom_skin_arr['pp_dropcap_bg_color'];
	
	if(!empty($pp_dropcap_bg_color))
	{
?>
.dropcap1 { background:<?php echo $pp_dropcap_bg_color; ?>; }
<?php
	}
?>

<?php
	$pp_pricing_active_bg_color = $custom_skin_arr['pp_pricing_active_bg_color'];
	
	if(!empty($pp_pricing_active_bg_color))
	{
?>
.pricing_box.large .header { background:<?php echo $pp_pricing_active_bg_color; ?>; }
.pricing_box.large { border:1px solid <?php echo $pp_pricing_active_bg_color; ?>; }
<?php
	}
?>

<?php
	$pp_pricing_default_bg_color = $custom_skin_arr['pp_pricing_default_bg_color'];
	
	if(!empty($pp_pricing_default_bg_color))
	{
?>
.pricing_box .header { background:<?php echo $pp_pricing_default_bg_color; ?>; }
<?php
	}
?>

<?php
	$pp_pricing_border_color = $custom_skin_arr['pp_pricing_border_color'];
	
	if(!empty($pp_pricing_border_color))
	{
?>
.pricing_box .header, #content_wrapper .pricing_box ul li { border-bottom:1px solid <?php echo $pp_pricing_border_color; ?>; }
.pricing_box { border:1px solid <?php echo $pp_pricing_border_color; ?>; }
<?php
	}
?>

<?php
	$pp_h1_font_color = $custom_skin_arr['pp_h1_font_color'];
	
	if(!empty($pp_h1_font_color))
	{
?>
h1,h2,h3,h4,h5,h6 { color:<?php echo $pp_h1_font_color; ?>; }
<?php
	}
?>

<?php
	$pp_page_header_font_color = $custom_skin_arr['pp_page_header_font_color'];
	
	if(!empty($pp_page_header_font_color))
	{
?>
.caption_header h1, .caption_header, .caption_header a { color:<?php echo $pp_page_header_font_color; ?>; }
<?php
	}
?>

<?php
	$pp_font_color = $custom_skin_arr['pp_font_color'];
	
	if(!empty($pp_font_color))
	{
?>
body { color:<?php echo $pp_font_color; ?>; }
<?php
	}
	
?>

<?php
	$pp_link_color = $custom_skin_arr['pp_link_color'];
	
	if(!empty($pp_link_color))
	{
?>
a, .tagline_text, .portfolio_desc h5, .portfolio_desc h6 { color:<?php echo $pp_link_color; ?>; }
<?php
	}
	
?>

<?php
	$pp_hover_link_color = $custom_skin_arr['pp_hover_link_color'];
	
	if(!empty($pp_hover_link_color))
	{
?>
a:hover, .post_header h3 a:hover, .sidebar_wrapper a:hover, .sidebar_wrapper a:active, .sidebar_wrapper ul.twitter a, #footer .sidebar_widget li ul.twitter a, .colorful, .ppb_desc a, .filter li a.active { color:<?php echo $pp_hover_link_color; ?>; } { color:<?php echo $pp_hover_link_color; ?>; }

.colorful_bg, .widget_tag_cloud div a:hover, .meta-tags a:hover, #footer .widget_tag_cloud div a:hover, #footer .meta-tags a:hover { background:<?php echo $pp_hover_link_color; ?>; }

#menu_wrapper div .nav li.current-menu-item a, #menu_wrapper div .nav li.current-menu-parent a, #menu_wrapper div .nav li.current-menu-ancestor > a { color: <?php echo $pp_hover_link_color; ?>; }

#menu_wrapper .nav ul li ul, #menu_wrapper div .nav li ul { border-top: 3px solid <?php echo $pp_hover_link_color; ?>; }
<?php
	}	
?>

<?php
	$pp_active_link_color = $custom_skin_arr['pp_active_link_color'];
	
	if(!empty($pp_active_link_color))
	{
?>
a:active, .top_info a:active { color:<?php echo $pp_active_link_color; ?>; }
<?php
	}	
?>

<?php
	$pp_button_bg_color = $custom_skin_arr['pp_button_bg_color'];
	
	if(!empty($pp_button_bg_color))
	{
?>
input[type=submit], input[type=button], a.button, input[type=submit]:active, input[type=button]:active, a.button:active, .tagline, .portfolio200_overlay .overlay_icon_circle, .portfolio460_overlay .overlay_icon_circle, .portfolio305_overlay .overlay_icon_circle, .portfolio195_overlay .overlay_icon_circle, .post_img_overlay .overlay_icon_circle, .blog_thumb_overlay .overlay_icon_circle, .post_full_img_overlay .overlay_icon_circle, .post_half_img_overlay .overlay_icon_circle, .post_third_img_overlay .overlay_icon_circle, .ls-layer h6, .colorful_bg, .pagination span, .pagination a:hover {  background-color: <?php echo $pp_button_bg_color; ?>; }

#wrapper { border-top: 5px solid <?php echo $pp_button_bg_color; ?>; }

<?php
	}
	
?>

<?php
	$pp_button_font_color = $custom_skin_arr['pp_button_font_color'];
	
	if(!empty($pp_button_font_color))
	{
?>
input[type=submit], input[type=button], a.button { 
	color: <?php echo $pp_button_font_color; ?>;
}
input[type=submit]:hover, input[type=button]:hover, a.button:hover
{
	color: <?php echo $pp_button_font_color; ?>;
}
<?php
	}
	
?>

<?php
	$pp_button_border_color = $custom_skin_arr['pp_button_border_color'];
	
	if(!empty($pp_button_border_color))
	{
?>
input[type=submit], input[type=button], a.button { 
	border: 1px solid <?php echo $pp_button_border_color; ?>;
}
<?php
	}
	
?>

<?php
    $pp_menu_link_color = $custom_skin_arr['pp_menu_link_color'];
    
    if(!empty($pp_menu_link_color))
    {
?>
#menu_wrapper .nav ul li a, #menu_wrapper div .nav li a { color: <?php echo $pp_menu_link_color; ?>; }
<?php
    }
?>

<?php
    $pp_menu_link_hover_color = $custom_skin_arr['pp_menu_link_hover_color'];
    
    if(!empty($pp_menu_link_hover_color))
    {
?>
#menu_wrapper .nav ul li a.hover, #menu_wrapper .nav ul li a:hover, #menu_wrapper div .nav li a.hover, #menu_wrapper div .nav li a:hover, #menu_wrapper .nav ul li ul li a:hover, #menu_wrapper .nav ul li ul li a:hover, #menu_wrapper div .nav li ul li a:hover, #menu_wrapper div .nav li ul li a:hover, #menu_wrapper div .nav li.current-menu-item ul li a:hover, #menu_wrapper div .nav li.current-menu-parent ul li a:hover { color: <?php echo $pp_menu_link_hover_color; ?>; }
<?php
    }
?>

<?php
    $pp_submenu_link_color = $custom_skin_arr['pp_submenu_link_color'];
    
    if(!empty($pp_submenu_link_color))
    {
?>
#menu_wrapper div .nav li ul li a, #menu_wrapper div .nav li.current-menu-item ul li a, #menu_wrapper div .nav li ul li.current-menu-item a, #menu_wrapper .nav ul li ul li a, #menu_wrapper .nav ul li.current-menu-item ul li a, #menu_wrapper .nav ul li ul li.current-menu-item a, #menu_wrapper div .nav li.current-menu-parent ul li a, #menu_wrapper div .nav li ul li.current-menu-parent a { color: <?php echo $pp_submenu_link_color; ?>; }
<?php
    }
?>

<?php
    $pp_submenu_hover_color = $custom_skin_arr['pp_submenu_hover_color'];
    
    if(!empty($pp_submenu_hover_color))
    {
?>
#menu_wrapper .nav ul li ul li a:hover, #menu_wrapper .nav ul li ul li a:hover, #menu_wrapper div .nav li ul li a:hover, #menu_wrapper div .nav li ul li a:hover { color: <?php echo $pp_submenu_hover_bg_color; ?>; }
<?php
    }
?>

<?php
    $pp_before_title_border_color = $custom_skin_arr['pp_before_title_border_color'];
    
    if(!empty($pp_before_title_border_color))
    {
?>
.page_caption { border-color: <?php echo $pp_before_title_border_color; ?>; }
<?php
    }
?>

<?php
    $pp_footer_widget_title_color = $custom_skin_arr['pp_footer_widget_title_color'];
    
    if(!empty($pp_footer_widget_title_color))
    {
?>
#footer ul li.widget .widgettitle { color: <?php echo $pp_footer_widget_title_color; ?>; }
<?php
    }
?>

<?php
    $pp_footer_font_color = $custom_skin_arr['pp_footer_font_color'];
    
    if(!empty($pp_footer_font_color))
    {
?>
#footer { color: <?php echo $pp_footer_font_color; ?>; }
<?php
    }
?>

<?php
    $pp_footer_link_color = $custom_skin_arr['pp_footer_link_color'];
    
    if(!empty($pp_footer_link_color))
    {
?>
#footer a, #footer a:hover, #footer a:active { color: <?php echo $pp_footer_link_color; ?>; }
<?php
    }
?>

<?php
    $pp_below_footer_color = $custom_skin_arr['pp_below_footer_color'];
    
    if(!empty($pp_below_footer_color))
    {
?>
#copyright { color: <?php echo $pp_below_footer_color; ?>; }
<?php
    }
?>

<?php
    $pp_below_footer_background_color = $custom_skin_arr['pp_below_footer_background_color'];
    
    if(!empty($pp_below_footer_background_color))
    {
?>
#copyright { background-color: <?php echo $pp_below_footer_background_color; ?>; }
<?php
	}
?>