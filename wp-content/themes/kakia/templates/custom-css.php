<?php header("Content-type: text/css; charset: UTF-8"); ?> 

<?php
require_once( '../../../../wp-load.php' );
?>

<?php
	$pp_body_font = get_option('pp_body_font');
	
	if(!empty($pp_body_font))
	{
?>
body, input[type=submit], input[type=button], a.button, input[type=submit].medium, input[type=button].medium, a.button.medium, input[type=submit].large, input[type=button].large, a.button.large { font-family:<?php echo $pp_body_font; ?>; }
<?php
	}
	
?>

<?php
	$pp_body_font_size = get_option('pp_body_font_size');
	
	if(!empty($pp_body_font_size))
	{
?>
body { font-size:<?php echo $pp_body_font_size; ?>px; }
<?php
	}
?>

<?php
	$pp_blog_title_font_color = get_option('pp_blog_title_font_color');
	
	if(!empty($pp_blog_title_font_color))
	{
?>
.post_header h3 a { color:<?php echo $pp_blog_title_font_color; ?>; }
<?php
	}
?>

<?php
	$pp_dropcap_bg_color = get_option('pp_dropcap_bg_color');
	
	if(!empty($pp_dropcap_bg_color))
	{
?>
.dropcap1 { background:<?php echo $pp_dropcap_bg_color; ?>; }
<?php
	}
?>

<?php
	$pp_pricing_active_bg_color = get_option('pp_pricing_active_bg_color');
	
	if(!empty($pp_pricing_active_bg_color))
	{
?>
.pricing_box.large .header { background:<?php echo $pp_pricing_active_bg_color; ?>; }
.pricing_box.large { border:1px solid <?php echo $pp_pricing_active_bg_color; ?>; }
<?php
	}
?>

<?php
	$pp_pricing_default_bg_color = get_option('pp_pricing_default_bg_color');
	
	if(!empty($pp_pricing_default_bg_color))
	{
?>
.pricing_box .header { background:<?php echo $pp_pricing_default_bg_color; ?>; }
<?php
	}
?>

<?php
	$pp_pricing_border_color = get_option('pp_pricing_border_color');
	
	if(!empty($pp_pricing_border_color))
	{
?>
.pricing_box .header, #content_wrapper .pricing_box ul li { border-bottom:1px solid <?php echo $pp_pricing_border_color; ?>; }
.pricing_box { border:1px solid <?php echo $pp_pricing_border_color; ?>; }
<?php
	}
?>

<?php
	$pp_footer_header_font_size = get_option('pp_footer_header_font_size');
	
	if(!empty($pp_footer_header_font_size))
	{
?>
#footer ul li.widget .widgettitle { font-size:<?php echo $pp_footer_header_font_size; ?>px; }
<?php
	}
	
?>

<?php
	$pp_sidebar_header_font_size = get_option('pp_sidebar_header_font_size');
	
	if(!empty($pp_sidebar_header_font_size))
	{
?>
#content_wrapper .sidebar .content .sidebar_widget li .widgettitle, h2.widgettitle { font-size:<?php echo $pp_sidebar_header_font_size; ?>px; }
<?php
	}
	
?>

<?php
	$pp_h1_font_color = get_option('pp_h1_font_color');
	
	if(!empty($pp_h1_font_color))
	{
?>
h1,h2,h3,h4,h5,h6 { color:<?php echo $pp_h1_font_color; ?>; }
<?php
	}
?>

<?php
	$pp_page_header_font_color = get_option('pp_page_header_font_color');
	
	if(!empty($pp_page_header_font_color))
	{
?>
.caption_header h1, .caption_header, .caption_header a { color:<?php echo $pp_page_header_font_color; ?>; }
<?php
	}
?>

<?php
	$pp_h1_size = get_option('pp_h1_size');
	
	if(!empty($pp_h1_size))
	{
?>
h1 { font-size:<?php echo $pp_h1_size; ?>px; }
<?php
	}
	if($pp_h1_size < 46)
	{
?>
h1 { letter-spacing: 0; }
<?php
	}
?>

<?php
	$pp_h2_size = get_option('pp_h2_size');
	
	if(!empty($pp_h2_size))
	{
?>
h2 { font-size:<?php echo $pp_h2_size; ?>px; }
<?php
	}
	
?>

<?php
	$pp_h3_size = get_option('pp_h3_size');
	
	if(!empty($pp_h3_size))
	{
?>
h3 { font-size:<?php echo $pp_h3_size; ?>px; }
<?php
	}
	
?>

<?php
	$pp_h4_size = get_option('pp_h4_size');
	
	if(!empty($pp_h4_size))
	{
?>
h4 { font-size:<?php echo $pp_h4_size; ?>px; }
<?php
	}
	
?>

<?php
	$pp_h5_size = get_option('pp_h5_size');
	
	if(!empty($pp_h5_size))
	{
?>
h5 { font-size:<?php echo $pp_h5_size; ?>px; }
<?php
	}
?>

<?php
	$pp_h6_size = get_option('pp_h6_size');
	
	if(!empty($pp_h6_size))
	{
?>
h6 { font-size:<?php echo $pp_h6_size; ?>px; }
<?php
	}	
?>

<?php
	$pp_page_header_font_size = get_option('pp_page_header_font_size');
	
	if(!empty($pp_page_header_font_size))
	{
?>
.caption_header h1 { font-size:<?php echo $pp_page_header_font_size; ?>px; }
<?php
	}
	if($pp_page_header_font_size < 72)
	{
?>
.caption_header h1 { letter-spacing: 0; }
<?php
	}
?>

<?php
	$pp_font_color = get_option('pp_font_color');
	
	if(!empty($pp_font_color))
	{
?>
body { color:<?php echo $pp_font_color; ?>; }
<?php
	}
	
?>

<?php
	$pp_link_color = get_option('pp_link_color');
	
	if(!empty($pp_link_color))
	{
?>
a, .tagline_text, .portfolio_desc h5, .portfolio_desc h6 { color:<?php echo $pp_link_color; ?>; }
<?php
	}
	
?>

<?php
	$pp_hover_link_color = get_option('pp_hover_link_color');
	
	if(!empty($pp_hover_link_color))
	{
?>
a:hover, .post_header h3 a:hover, .sidebar_wrapper a:hover, .sidebar_wrapper a:active, .sidebar_wrapper ul.twitter a, #footer .sidebar_widget li ul.twitter a, .colorful, .ppb_desc a, .filter li a.active { color:<?php echo $pp_hover_link_color; ?>; }

.colorful_bg, .widget_tag_cloud div a:hover, .meta-tags a:hover, #footer .widget_tag_cloud div a:hover, #footer .meta-tags a:hover { background:<?php echo $pp_hover_link_color; ?>; }

#menu_wrapper div .nav li.current-menu-item a, #menu_wrapper div .nav li.current-menu-parent a, #menu_wrapper div .nav li.current-menu-ancestor > a { color: <?php echo $pp_hover_link_color; ?>; }

#menu_wrapper .nav ul li ul, #menu_wrapper div .nav li ul { border-top: 3px solid <?php echo $pp_hover_link_color; ?>; }
<?php
	}	
?>

<?php
	$pp_active_link_color = get_option('pp_active_link_color');
	
	if(!empty($pp_active_link_color))
	{
?>
a:active, .top_info a:active { color:<?php echo $pp_active_link_color; ?>; }
<?php
	}	
?>

<?php
	$pp_button_bg_color = get_option('pp_button_bg_color');
	
	if(!empty($pp_button_bg_color))
	{
?>
input[type=submit], input[type=button], a.button, input[type=submit]:active, input[type=button]:active, a.button:active, .tagline, .portfolio200_overlay .overlay_icon_circle, .portfolio460_overlay .overlay_icon_circle, .portfolio305_overlay .overlay_icon_circle, .portfolio195_overlay .overlay_icon_circle, .post_img_overlay .overlay_icon_circle, .blog_thumb_overlay .overlay_icon_circle, .post_full_img_overlay .overlay_icon_circle, .post_half_img_overlay .overlay_icon_circle, .post_third_img_overlay .overlay_icon_circle, .ls-layer h6, .colorful_bg, .pagination span, .pagination a:hover, .flex-control-nav li a.active, .flex-control-nav li a:hover, .ajax_close, .ajax_close:hover, .ajax_close:active, .ajax_next:hover, .ajax_prev:hover, .portfolio_single_navi a:hover {  background-color: <?php echo $pp_button_bg_color; ?>; }

#wrapper { border-top: 5px solid <?php echo $pp_button_bg_color; ?>; }
.ui-tabs .ui-tabs-nav li.ui-tabs-selected { border-top: 3px solid <?php echo $pp_button_bg_color; ?>; }

<?php
	}
	
?>

<?php
	$pp_button_font_color = get_option('pp_button_font_color');
	
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
	$pp_button_border_color = get_option('pp_button_border_color');
	
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
    $pp_footer_display_sidebar = get_option('pp_footer_display_sidebar');
    
    if(empty($pp_footer_display_sidebar))
    {
?>
#footer { background-image: none; }
<?php
    }
?>

<?php
	$pp_font_family = get_option('pp_font_family');
    
    if(!empty($pp_font_family))
    {
?>
h1, h2, h3, h4, h5, h6, input[type=submit], input[type=button], a.button, #menu_wrapper .nav ul, #menu_wrapper div .nav, .post_header, .member_position, .portfolio_sub_header { font-family: '<?php echo $pp_font_family; ?>'; }	
<?php
	}
?>

<?php
    $pp_menu_font_size = get_option('pp_menu_font_size');
    $pp_menu_uppercase = get_option('pp_menu_uppercase');
    
    if(!empty($pp_menu_uppercase))
    {
    	$pp_menu_uppercase = 'uppercase';
    }
    else
    {
    	$pp_menu_uppercase = 'none';
    }
    
    if(!empty($pp_menu_font_size))
    {
?>
#menu_wrapper .nav ul li a, #menu_wrapper div .nav li a { font-size: <?php echo $pp_menu_font_size; ?>px;text-transform: <?php echo $pp_menu_uppercase; ?> }
<?php
    }
?>

<?php
    $pp_submenu_font_size = get_option('pp_submenu_font_size');
    
    if(!empty($pp_submenu_font_size))
    {
?>
#menu_wrapper .nav ul li ul li a, #menu_wrapper div .nav li ul li a, #menu_wrapper div .nav li.current-menu-parent ul li a { font-size: <?php echo $pp_submenu_font_size; ?>px;text-transform: none; }
<?php
    }
?>

<?php
    $pp_menu_link_color = get_option('pp_menu_link_color');
    
    if(!empty($pp_menu_link_color))
    {
?>
#menu_wrapper .nav ul li a, #menu_wrapper div .nav li a { color: <?php echo $pp_menu_link_color; ?>; }
<?php
    }
?>

<?php
    $pp_menu_link_hover_color = get_option('pp_menu_link_hover_color');
    
    if(!empty($pp_menu_link_hover_color))
    {
?>
#menu_wrapper .nav ul li a.hover, #menu_wrapper .nav ul li a:hover, #menu_wrapper div .nav li a.hover, #menu_wrapper div .nav li a:hover, #menu_wrapper .nav ul li ul li a:hover, #menu_wrapper .nav ul li ul li a:hover, #menu_wrapper div .nav li ul li a:hover, #menu_wrapper div .nav li ul li a:hover, #menu_wrapper div .nav li.current-menu-item ul li a:hover, #menu_wrapper div .nav li.current-menu-parent ul li a:hover { color: <?php echo $pp_menu_link_hover_color; ?>; }
<?php
    }
?>

<?php
    $pp_submenu_link_color = get_option('pp_submenu_link_color');
    
    if(!empty($pp_submenu_link_color))
    {
?>
#menu_wrapper div .nav li ul li a, #menu_wrapper div .nav li.current-menu-item ul li a, #menu_wrapper div .nav li ul li.current-menu-item a, #menu_wrapper .nav ul li ul li a, #menu_wrapper .nav ul li.current-menu-item ul li a, #menu_wrapper .nav ul li ul li.current-menu-item a, #menu_wrapper div .nav li.current-menu-parent ul li a, #menu_wrapper div .nav li ul li.current-menu-parent a { color: <?php echo $pp_submenu_link_color; ?>; }
<?php
    }
?>

<?php
    $pp_submenu_hover_color = get_option('pp_submenu_hover_color');
    
    if(!empty($pp_submenu_hover_color))
    {
?>
#menu_wrapper .nav ul li ul li a:hover, #menu_wrapper .nav ul li ul li a:hover, #menu_wrapper div .nav li ul li a:hover, #menu_wrapper div .nav li ul li a:hover { color: <?php echo $pp_submenu_hover_bg_color; ?>; }
<?php
    }
?>

<?php
    $pp_before_title_border_color = get_option('pp_before_title_border_color');
    
    if(!empty($pp_before_title_border_color))
    {
?>
.page_caption { border-color: <?php echo $pp_before_title_border_color; ?>; }
<?php
    }
?>

<?php
    $pp_footer_widget_title_color = get_option('pp_footer_widget_title_color');
    
    if(!empty($pp_footer_widget_title_color))
    {
?>
#footer ul li.widget .widgettitle { color: <?php echo $pp_footer_widget_title_color; ?>; }
<?php
    }
?>

<?php
    $pp_footer_font_color = get_option('pp_footer_font_color');
    
    if(!empty($pp_footer_font_color))
    {
?>
#footer { color: <?php echo $pp_footer_font_color; ?>; }
<?php
    }
?>

<?php
    $pp_footer_link_color = get_option('pp_footer_link_color');
    
    if(!empty($pp_footer_link_color))
    {
?>
#footer a, #footer a:hover, #footer a:active { color: <?php echo $pp_footer_link_color; ?>; }
<?php
    }
?>

<?php
    $pp_below_footer_color = get_option('pp_below_footer_color');
    
    if(!empty($pp_below_footer_color))
    {
?>
#copyright { color: <?php echo $pp_below_footer_color; ?>; }
<?php
    }
?>

<?php
    $pp_below_footer_background_color = get_option('pp_below_footer_background_color');
    
    if(!empty($pp_below_footer_background_color))
    {
?>
#copyright { background-color: <?php echo $pp_below_footer_background_color; ?>; }
<?php
	}
?>

<?php
	$pp_slider_display = get_option('pp_slider_display');

	if(empty($pp_slider_display))
    {
?>
#menu_border_wrapper { border-bottom: 1px solid #ccc; }
<?php
	}
?>

<?php
/**
*	Get custom CSS
**/
$pp_custom_css = get_option('pp_custom_css');


if(!empty($pp_custom_css))
{
    echo stripslashes($pp_custom_css);
}
?>