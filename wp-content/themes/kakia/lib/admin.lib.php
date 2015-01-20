<?php
/*
	Begin creating admin options
*/

$themename = THEMENAME;
$shortname = SHORTNAME;

$pp_slider_items = get_option('pp_slider_items');
if(empty($pp_slider_items))
{
	$pp_slider_items = 5;
}

$slides = get_posts(array(
	'post_type' => 'slides',
	'numberposts' => $pp_slider_items,
));
$wp_slides = array(
	0		=> "Choose a slide"
);
foreach ($slides as $slide_list ) {
       $wp_slides[$slide_list->ID] = $slide_list->post_title;
}

$categories = get_categories('hide_empty=0&orderby=name');
$wp_cats = array(
	0		=> "Choose a category"
);
foreach ($categories as $category_list ) {
       $wp_cats[$category_list->cat_ID] = $category_list->cat_name;
}

$pages = get_pages(array('parent' => -1));
$wp_pages = array(
	0		=> "Choose a page",
);
foreach ($pages as $page_list ) {
	$template_name = get_post_meta( $page_list->ID, '_wp_page_template', true );
	
	//exclude contact template
	if($template_name != 'contact.php')
	{
       $wp_pages[$page_list->ID] = $page_list->post_title;
    }
}

//Get WPDB Object
global $wpdb;

//Table name
$table_name = $wpdb->prefix . "layerslider";

//Get LayerSliders
$wp_layersliders = array();

if(get_option('pp_layerslider_activated', '0') == '1') {
	$sliders_obj = $wpdb->get_results( "SELECT * FROM $table_name WHERE flag_hidden = '0' AND flag_deleted = '0' ORDER BY date_c ASC LIMIT 100" );
	$wp_layersliders = array(
		0		=> "Choose a slider",
	);
	foreach ($sliders_obj as $slider ) {
		$wp_layersliders[$slider->id] = $slider->name;
	}
}

// Get Rev Sliders
include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
$is_revslider_active = is_plugin_active('revslider/revslider.php');
$wp_revsliders = array();

if($is_revslider_active)
{
	$wp_revsliders = array(
		0		=> "Choose a slide",
	);
	$revslider_objs = new RevSlider();
	$revslider_obj_arr = $revslider_objs->getArrSliders();
	
	foreach($revslider_obj_arr as $revslider_obj)
	{
		$wp_revsliders[$revslider_obj->getAlias()] = $revslider_obj->getTitle();
	}
}

$api_url = (!empty($_SERVER['HTTPS'])) ? "https://".$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'] : "http://".$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'];


$options = array (
 
//Begin admin header
array( 
		"name" => $themename." Options",
		"type" => "title"
),
//End admin header


//Begin first tab "General"
array( 
		"name" => "General",
		"type" => "section",
		"icon" => "gear.png",
)
,

array( "type" => "open"),

array( "name" => "<h2>Theme Layout</h2>Page Layout Style",
	"desc" => "Select layout style for global theme setting",
	"id" => $shortname."_theme_layout",
	"type" => "select",
	"options" => array(
		'fullwidth' => 'Fullwidth Layout',
		'boxed' => 'Boxed Layout',
	),
	"std" => 'fullwidth',
),

array( "name" => "<h2>Website Identity</h2>Custom Logo",
	"desc" => "Choose an image that you want to use as the logo in header",
	"id" => $shortname."_logo",
	"type" => "image",
	"std" => "",
),

array( "name" => "Custom Favicon",
	"desc" => "A favicon is a 16x16 pixel icon that represents your site; paste the URL to a .ico image that you want to use as the image",
	"id" => $shortname."_favicon",
	"type" => "image",
	"std" => "",
),

array( "name" => "<h2>Advanced Settings</h2>Google Analytics Code",
	"desc" => "Get analytics on your site. Simply give us your Google Analytics code",
	"id" => $shortname."_ga_code",
	"type" => "textarea",
	"std" => ""
),

array( "name" => "Custom CSS",
	"desc" => "You can add your custom CSS here",
	"id" => $shortname."_custom_css",
	"type" => "textarea",
	"std" => ""
),

array( "name" => "Enable style switcher",
	"desc" => "Display style switcher like you saw on live demo site",
	"id" => $shortname."_advance_enable_switcher",
	"type" => "iphone_checkboxes",
	"std" => 1
),
	
array( "type" => "close"),
//End first tab "General"


//Begin first tab "Skins"
array( 
		"name" => "Skins",
		"type" => "section",
		"icon" => "color-swatch.png",
),

array( "type" => "open"),

array( "name" => "Save current settings as Skin",
	"desc" => "Skin manager helps you save all settings (except homepage, contact fields and advanced settings) to a skin so you can easily enable it later. Below are your current available skins.",
	"id" => $shortname."_skin",
	"type" => "skin",
	"std" => ""
),
	
array( "type" => "close"),
//End first tab "Skins"


//Begin first tab "Font"
array( 
		"name" => "Font",
		"type" => "section",
		"icon" => "edit.png",
)
,

array( "type" => "open"),

array( "name" => "<h2>Body Font Settings</h2>Body Font Size (in pixels)",
	"desc" => "Select font size for main content",
	"id" => $shortname."_body_font_size",
	"type" => "jslider",
	"size" => "40px",
	"std" => "13",
	"from" => 12,
	"to" => 24,
	"step" => 1,
),
array( "name" => "<h2>Main Menu Font Settings</h2>Main Menu Font Size (in pixels)",
	"desc" => "Select font size for 1st level menu",
	"id" => $shortname."_menu_font_size",
	"type" => "jslider",
	"size" => "40px",
	"std" => "13",
	"from" => 11,
	"to" => 24,
	"step" => 1,
),
array( "name" => "Sub Main Menu Font Size (in pixels)",
	"desc" => "Select font size for 2nd and 3rd level menu",
	"id" => $shortname."_submenu_font_size",
	"type" => "jslider",
	"size" => "40px",
	"std" => "12",
	"from" => 11,
	"to" => 24,
	"step" => 1,
),
array( "name" => "Enable/disable Main Menu text uppercase",
	"desc" => "If you enable this option, your 1st level menu font will be uppercase",
	"id" => $shortname."_menu_uppercase",
	"type" => "iphone_checkboxes",
	"std" => 1
),
array( "name" => "<h2>Header Font Settings</h2>Header Font (using Google Webfonts API)",
	"desc" => "Select font style your header",
	"id" => $shortname."_font",
	"type" => "font",
	"std" => ''
),
array( "name" => "Page Header Font Size (in pixels)",
	"desc" => "Select font size for every page header",
	"id" => $shortname."_page_header_font_size",
	"type" => "jslider",
	"size" => "72px",
	"std" => "36",
	"from" => 20,
	"to" => 72,
	"step" => 1,
),
array( "name" => "Footer Header Font Size (in pixels)",
	"desc" => "Select font size for footer widgets header",
	"id" => $shortname."_footer_header_font_size",
	"type" => "jslider",
	"size" => "40px",
	"std" => "18",
	"from" => 11,
	"to" => 32,
	"step" => 1,
),
array( "name" => "Sidebar Header Font Size (in pixels)",
	"desc" => "Select font size for page's sidebar widgets header",
	"id" => $shortname."_sidebar_header_font_size",
	"type" => "jslider",
	"size" => "40px",
	"std" => "18",
	"from" => 11,
	"to" => 32,
	"step" => 1,
),
array( "name" => "H1 Size (in pixels)",
	"desc" => "Select font size for H1",
	"id" => $shortname."_h1_size",
	"type" => "jslider",
	"size" => "40px",
	"std" => "50",
	"from" => 13,
	"to" => 60,
	"step" => 1,
),
array( "name" => "H2 Size (in pixels)",
	"desc" => "Select font size for H2",
	"id" => $shortname."_h2_size",
	"type" => "jslider",
	"size" => "40px",
	"std" => "30",
	"from" => 13,
	"to" => 60,
	"step" => 1,
),
array( "name" => "H3 Size (in pixels)",
	"desc" => "Select font size for H3",
	"id" => $shortname."_h3_size",
	"type" => "jslider",
	"size" => "40px",
	"std" => "26",
	"from" => 13,
	"to" => 60,
	"step" => 1,
),
array( "name" => "H4 Size (in pixels)",
	"desc" => "Select font size for H4",
	"id" => $shortname."_h4_size",
	"type" => "jslider",
	"size" => "40px",
	"std" => "24",
	"from" => 13,
	"to" => 60,
	"step" => 1,
),
array( "name" => "H5 Size (in pixels)",
	"desc" => "Select font size for H5",
	"id" => $shortname."_h5_size",
	"type" => "jslider",
	"size" => "40px",
	"std" => "20",
	"from" => 13,
	"to" => 60,
	"step" => 1,
),
array( "name" => "H6 Size (in pixels)",
	"desc" => "Select font size for H6",
	"id" => $shortname."_h6_size",
	"type" => "jslider",
	"size" => "40px",
	"std" => "14",
	"from" => 13,
	"to" => 60,
	"step" => 1,
),
	
array( "type" => "close"),
//End first tab "Font"


//Begin first tab "Colors"
array( 
		"name" => "Custom-Colors",
		"type" => "section",
		"icon" => "color.png",
)
,

array( "type" => "open"),

array( "name" => "<h2>Overall Elements Colors</h2>Overall Elements Background Color",
	"desc" => "Select color for button and overall elements background",
	"id" => $shortname."_button_bg_color",
	"type" => "colorpicker",
	"size" => "60px",
	"std" => "#67c901"
),

array( "name" => "Button Font Color",
	"desc" => "Select color for button font",
	"id" => $shortname."_button_font_color",
	"type" => "colorpicker",
	"size" => "60px",
	"std" => "#ffffff"
),

array( "name" => "Button Border Color",
	"desc" => "Select color for button border",
	"id" => $shortname."_button_border_color",
	"type" => "colorpicker",
	"size" => "60px",
	"std" => "#4f9b00"
),

array( "name" => "<h2>General Text and Link Colors</h2>Font Color",
	"desc" => "Select font color for main content font",
	"id" => $shortname."_font_color",
	"type" => "colorpicker",
	"size" => "60px",
	"std" => "#777777"
),

array( "name" => "Link Color",
	"desc" => "Select font color for main content link",
	"id" => $shortname."_link_color",
	"type" => "colorpicker",
	"size" => "60px",
	"std" => "#00a2d3"
),

array( "name" => "Hover Link Color",
	"desc" => "Select font color for main content hover state link",
	"id" => $shortname."_hover_link_color",
	"type" => "colorpicker",
	"size" => "60px",
	"std" => "#58d3f5"
),

array( "name" => "Active Link Color",
	"desc" => "Select font color for main content active state link",
	"id" => $shortname."_active_link_color",
	"type" => "colorpicker",
	"size" => "60px",
	"std" => "#444444"
),

array( "name" => "Header Tags Font Color",
	"desc" => "Select font color for H1, H2, H3, H4, H5, H6 headers",
	"id" => $shortname."_h1_font_color",
	"type" => "colorpicker",
	"size" => "60px",
	"std" => "#444444"
),

array( "name" => "Page Header Font Color",
	"desc" => "Select font color for page header",
	"id" => $shortname."_page_header_font_color",
	"type" => "colorpicker",
	"size" => "60px",
	"std" => "#000000"
),

array( "name" => "<h2>Top Sections Colors</h2>Main Menu Link Color",
	"desc" => "Select font color for 1st level menu",
	"id" => $shortname."_menu_link_color",
	"type" => "colorpicker",
	"size" => "60px",
	"std" => "#444444"
),

array( "name" => "Main Menu Hover Link Color",
	"desc" => "Select font color for 1st level menu hover state",
	"id" => $shortname."_menu_link_hover_color",
	"type" => "colorpicker",
	"size" => "60px",
	"std" => "#444444"
),

array( "name" => "Sub Menu Link Color",
	"desc" => "Select font color for 2nd and 3rd level menu",
	"id" => $shortname."_submenu_link_color",
	"type" => "colorpicker",
	"size" => "60px",
	"std" => "#999999"
),

array( "name" => "Sub Menu Link Hover Color",
	"desc" => "Select font color for 2nd and 3rd level menu hover state",
	"id" => $shortname."_submenu_hover_color",
	"type" => "colorpicker",
	"size" => "60px",
	"std" => "#183243"
),

array( "name" => "<h2>Mid Sections Colors</h2>Blog Post Title Font Color",
	"desc" => "Select font color for blog post title",
	"id" => $shortname."_blog_title_font_color",
	"type" => "colorpicker",
	"size" => "60px",
	"std" => "#00A2D3"
),

array( "name" => "Dropcap Background Color",
	"desc" => "Select background color for dropcap shortcode",
	"id" => $shortname."_dropcap_bg_color",
	"type" => "colorpicker",
	"size" => "60px",
	"std" => "#183243"
),

array( "name" => "Pricing Table Active Header Background Color",
	"desc" => "Select background color for pricing table active header shortcode",
	"id" => $shortname."_pricing_active_bg_color",
	"type" => "colorpicker",
	"size" => "60px",
	"std" => "#8AB2BA"
),

array( "name" => "Pricing Table Default Header Background Color",
	"desc" => "Select background color for pricing table default header shortcode",
	"id" => $shortname."_pricing_default_bg_color",
	"type" => "colorpicker",
	"size" => "60px",
	"std" => "#F9F9F9"
),

array( "name" => "Pricing Table Border Color",
	"desc" => "Select border color for pricing table shortcode",
	"id" => $shortname."_pricing_border_color",
	"type" => "colorpicker",
	"size" => "60px",
	"std" => "#EBEBEB"
),

array( "name" => "<h2>Footer Sections Colors</h2>Footer Widget Title Color",
	"desc" => "Select font color for footer widgets title",
	"id" => $shortname."_footer_widget_title_color",
	"type" => "colorpicker",
	"size" => "60px",
	"std" => "#ffffff"
),

array( "name" => "Footer Font Color",
	"desc" => "Select font color for footer content",
	"id" => $shortname."_footer_font_color",
	"type" => "colorpicker",
	"size" => "60px",
	"std" => "#E5E5E5"
),

array( "name" => "Footer Link Color",
	"desc" => "Select link color for the footer content",
	"id" => $shortname."_footer_link_color",
	"type" => "colorpicker",
	"size" => "60px",
	"std" => "#ffffff"
),


array( "name" => "Below Footer Font Color",
	"desc" => "Select font color for the below footer area",
	"id" => $shortname."_below_footer_color",
	"type" => "colorpicker",
	"size" => "60px",
	"std" => "#E5E5E5"
),

array( "name" => "Below Footer Background Color",
	"desc" => "Select background color for area below footer",
	"id" => $shortname."_below_footer_background_color",
	"type" => "colorpicker",
	"size" => "60px",
	"std" => "#000000"
),

array( "type" => "close"),
//End first tab "Colors"


//Begin second tab "Homepage"
array( "name" => "Homepage",
	"type" => "section",
	"icon" => "home.png",
),
array( "type" => "open"),

array( "name" => "<h2>Header Settings</h2>Enable/disable homepage header and description text",
	"desc" => "If you enable this option, on your homepage header will display under main slider content",
	"id" => $shortname."_homepage_enable_header",
	"type" => "iphone_checkboxes",
	"std" => 1
),

array( "name" => "Enter homepage header text",
	"desc" => "Header text to describe your business, site etc.",
	"id" => $shortname."_homepage_header_text",
	"type" => "text",
	"std" => ""
),

array( "name" => "Enter homepage description text",
	"desc" => "Short description text to describe your business, site etc.",
	"id" => $shortname."_homepage_description_text",
	"type" => "text",
	"std" => ""
),

array( "name" => "<h2>Content Settings</h2>Select and sort pages on your homepage.",
	"sort_title" => "Homepage Content Manager",
	"desc" => "Select pages and drag&drop to order them. *Note: Please make sure you set Wordpress admin > Settings > Reading > Front page display to \"Your latest posts\".",
	"id" => $shortname."_homepage_content",
	"type" => "sortable",
	"options" => $wp_pages,
	"options_disable" => array(1, 2, 3),
	"std" => ''
),

array( "name" => "<h2>Slider Settings</h2>Enable/disable Homepage Slider",
	"desc" => "If you enable this option, slider content will display on homepage under main menu",
	"id" => $shortname."_slider_display",
	"type" => "iphone_checkboxes",
	"std" => 1
),

array( "name" => "Select Slider Engine",
	"desc" => "Select which slider engine you want to use LayerSlider or CUTE Slider",
	"id" => $shortname."_slider_type",
	"type" => "select",
	"options" => array(
		'layerslider' => 'LayerSlider',
		'revslider' => 'Revolution Slider',
		'cute' => 'CUTE Slider',
	),
	"std" => ''
),

array( "name" => "<h2>LayerSlider Settings</h2>Select slider for homepage (if you selected LayerSlider engine)",
	"desc" => "If you selected LayerSlider as slider engine. Please select which LayerSlider you would like to display on homepage",
	"id" => $shortname."_slider_layerslider_id",
	"type" => "select",
	"options" => $wp_layersliders,
	"std" => ''
),

array( "name" => "<h2>Revolution Slider Settings</h2>Select slider for homepage (if you selected Revolution Slider engine)",
	"desc" => "If you selected Revolution Slider as slider engine. Please select which Revolution Slider you would like to display on homepage",
	"id" => $shortname."_slider_revslider_id",
	"type" => "select",
	"options" => $wp_revsliders,
	"std" => ''
),

array( "name" => "<h2>CUTE Slider Settings</h2>CUTE Slider Transition Style",
	"desc" => "If you selected CUTE Slider as slider engine. Please select transition effect",
	"id" => $shortname."_homepage_transition",
	"type" => "select",
	"options" => array(
		'2D' => '2D Effect',
		'3D' => '3D Effect',
	),
	"std" => ''
),

array( "name" => "Slider items",
	"desc" => "How many items you want display in slider?",
	"id" => $shortname."_slider_items",
	"type" => "jslider",
	"size" => "40px",
	"std" => "5",
	"from" => 1,
	"to" => 10,
	"step" => 1,
),

array( "name" => "Slider timer (in second)",
	"desc" => "Enter number of seconds for slider timer",
	"id" => $shortname."_slider_timer",
	"type" => "jslider",
	"size" => "40px",
	"std" => "5",
	"from" => 1,
	"to" => 30,
	"step" => 1,
),

array( "name" => "Enable/disable Autoplay for Slider",
	"desc" => "If you enable this option, CUTE Slider will automatically play through all slides",
	"id" => $shortname."_slider_autoplay",
	"type" => "iphone_checkboxes",
	"std" => 1
),


array( "type" => "close"),
//End second tab "Homepage"


//Begin second tab "Portfolio"
array( "name" => "Portfolio",
	"type" => "section",
	"icon" => "folder-open-image.png",
),

array( "type" => "open"),

array( "name" => "<h2>Portfolio Page Settings</h2>Portfolio items per page",
	"desc" => "How many items you want display per page?",
	"id" => $shortname."_portfolio_items",
	"type" => "jslider",
	"size" => "40px",
	"std" => "12",
	"from" => 1,
	"to" => 50,
	"step" => 1,
),

array( "name" => "<h2>Portfolio Single Page Recent Portfolios Settings</h2>Enable/disable portfolio item featured image and gallery",
	"desc" => "You can select to display or hide portfolio featured content on single portfolio page",
	"id" => $shortname."_portfolio_enable_feat",
	"type" => "iphone_checkboxes",
	"std" => 1
),
array( "name" => "Enable/disable Recent portfolios on portfolio single page",
	"desc" => "If you enable this option, recent portfolios widget will display on single portfolio page",
	"id" => $shortname."_portfolio_enable_recent",
	"type" => "iphone_checkboxes",
	"std" => 1
),
array( "name" => "Recent Portfolios items",
	"desc" => "How many items you want display in recent portfolios widget?",
	"id" => $shortname."_portfolio_recent_items",
	"type" => "jslider",
	"size" => "40px",
	"std" => "12",
	"from" => 1,
	"to" => 40,
	"step" => 1,
),

array( "type" => "close"),
//End second tab "Portfolio"


//Begin second tab "Blog"
array( "name" => "Blog",
	"type" => "section",
	"icon" => "book-open-bookmark.png",
),

array( "type" => "open"),

array( "name" => "Display full post content on blog page",
	"desc" => "If you enable this option, blog page will display post's content insted of excerpt",
	"id" => $shortname."_blog_display_full",
	"type" => "iphone_checkboxes",
	"std" => 1
),

array( "name" => "Enable/disable post's featured image on single post page",
	"desc" => "If you enable this option, single post page will display its featured image",
	"id" => $shortname."_blog_single_img",
	"type" => "iphone_checkboxes",
	"std" => 1
),

array( "name" => "Enable/disable post's social share buttons",
	"desc" => "If you enable this option, blog page will display share buttons under post's content",
	"id" => $shortname."_blog_share",
	"type" => "iphone_checkboxes",
	"std" => 1
),

array( "type" => "close"),
//End second tab "Blog"


//Begin second tab "Sidebar"
array( "name" => "Sidebar",
	"type" => "section",
	"icon" => "application-sidebar-expand.png",
),

array( "type" => "open"),

array( "name" => "Add a new sidebar",
	"desc" => "Enter new sidebar name",
	"id" => $shortname."_sidebar0",
	"type" => "text",
	"std" => "",
),
array( "type" => "close"),
//End second tab "Sidebar"


//Begin first tab "Contact"
array( 
		"name" => "Contact",
		"type" => "section",
		"icon" => "mail-receive.png",
)
,

array( "type" => "open"),

array( "name" => "<h2>Contact info Settings</h2>Company Phone Number",
	"desc" => "Enter your company phone number",
	"id" => $shortname."_contact_phone",
	"type" => "text",
	"std" => ""
),

array( "name" => "Company email address",
	"desc" => "Enter which email address will be sent from contact form",
	"id" => $shortname."_contact_email",
	"type" => "text",
	"std" => ""
),

array( "name" => "Company address",
	"desc" => "Enter which address will be displayed on contact page",
	"id" => $shortname."_contact_address",
	"type" => "text",
	"std" => ""
),

array( "name" => "Display email address on top bar",
	"desc" => "If you enable this option, it will display your email address on the top of every pages",
	"id" => $shortname."_contact_email_display",
	"type" => "iphone_checkboxes",
	"std" => 1
),

array( "name" => "Select and sort contents on your contact page. Use fields you want to show on your contact form",
	"sort_title" => "Contact Form Manager",
	"desc" => "",
	"id" => $shortname."_contact_form",
	"type" => "sortable",
	"options" => array(
		0 => 'Empty field',
		1 => 'Name',
		2 => 'Email',
		3 => 'Message',
		4 => 'Address',
		5 => 'Phone',
		6 => 'Mobile',
		7 => 'Company Name',
		8 => 'Country',
	),
	"options_disable" => array(1, 2, 3),
	"std" => ''
),

array( "name" => "<h2>Address and Map Settings</h2>Show map in contact page",
	"desc" => "Select display map in contact page",
	"id" => $shortname."_contact_display_map",
	"type" => "iphone_checkboxes",
	"std" => 1
),
array( "name" => "Address Latitude",
	"desc" => "<a href=\"http://www.tech-recipes.com/rx/5519/the-easy-way-to-find-latitude-and-longitude-values-in-google-maps/\">Find here</a>",
	"id" => $shortname."_contact_lat",
	"type" => "text",
	"std" => ""
),
array( "name" => "Address Longtitude",
	"desc" => "<a href=\"http://www.tech-recipes.com/rx/5519/the-easy-way-to-find-latitude-and-longitude-values-in-google-maps/\">Find here</a>",
	"id" => $shortname."_contact_long",
	"type" => "text",
	"std" => ""
),
array( "name" => "Map Zoom level",
	"desc" => "Select zoom level of main contact map.",
	"id" => $shortname."_contact_map_zoom",
	"type" => "jslider",
	"size" => "40px",
	"std" => "12",
	"from" => 1,
	"to" => 18,
	"step" => 1,
),

array( "name" => "<h2>Captcha Settings</h2>Enable/disable Captcha",
	"desc" => "If you enable this option, contact page will display captcha image to prevent possible spam",
	"id" => $shortname."_contact_enable_captcha",
	"type" => "iphone_checkboxes",
	"std" => 1
),
	
array( "type" => "close"),
//End first tab "Contact"




//Begin second tab "Footer"
array( "name" => "Footer",
	"type" => "section",
	"icon" => "layout-select-footer.png",
),

array( "type" => "open"),

array( "name" => "<h2>Footer Layouts and Styles Settings</h2>Show Footer Sidebar",
	"desc" => "If you enable this option, you can add widgets to \"Footer Sidebar\" using Appearance > Widgets",
	"id" => $shortname."_footer_display_sidebar",
	"type" => "iphone_checkboxes",
	"std" => 1
),
array( "name" => "Footer Sidebar styles",
	"desc" => "Select the style for Footer Sidebar",
	"id" => $shortname."_footer_style",
	"type" => "radio",
	"options" => array(
		'1' => '<div style="float:left;width:50px;height:40px" class="pp_checkbox_wrapper"><img src="'.get_bloginfo( 'stylesheet_directory' ).'/functions/images/1column.png"/></div>',
		'2' => '<div style="float:left;width:50px;height:40px" class="pp_checkbox_wrapper"><img src="'.get_bloginfo( 'stylesheet_directory' ).'/functions/images/2columns.png"/></div>',
		'3' => '<div style="float:left;width:50px;height:40px" class="pp_checkbox_wrapper"><img src="'.get_bloginfo( 'stylesheet_directory' ).'/functions/images/3columns.png"/></div>',
		'4' => '<div style="float:left;width:50px;height:40px" class="pp_checkbox_wrapper"><img src="'.get_bloginfo( 'stylesheet_directory' ).'/functions/images/4columns.png"/></div>',
	),
),

array( "name" => "<h2>Footer Left Content (Support HTML)</h2>Footer Content",
	"desc" => "You can text and HTML in here",
	"id" => $shortname."_footer_text",
	"type" => "textarea",
	"std" => ""
),

//End second tab "Footer"

//Begin fifth tab "Social Profiles"
array( "type" => "close"),
array( 	"name" => "Social-Profiles",
		"type" => "section",
		"icon" => "social.png",
),
array( "type" => "open"),
	
array( "name" => "<h2>Accounts Settings</h2>Facebook Profile ID",
	"desc" => "",
	"id" => $shortname."_facebook_username",
	"type" => "text",
	"std" => ""
),
array( "name" => "Twitter Username",
	"desc" => "",
	"id" => $shortname."_twitter_username",
	"type" => "text",
	"std" => ""
),
array( "name" => "Google Plus URL",
	"desc" => "",
	"id" => $shortname."_google_username",
	"type" => "text",
	"std" => ""
),
array( "name" => "Flickr Username",
	"desc" => "",
	"id" => $shortname."_flickr_username",
	"type" => "text",
	"std" => ""
),
array( "name" => "Youtube Username",
	"desc" => "",
	"id" => $shortname."_youtube_username",
	"type" => "text",
	"std" => ""
),
array( "name" => "Vimeo Username",
	"desc" => "",
	"id" => $shortname."_vimeo_username",
	"type" => "text",
	"std" => ""
),
array( "name" => "Tumblr Username",
	"desc" => "",
	"id" => $shortname."_tumblr_username",
	"type" => "text",
	"std" => ""
),
array( "name" => "Digg Username",
	"desc" => "",
	"id" => $shortname."_digg_username",
	"type" => "text",
	"std" => ""
),
array( "name" => "Dribbble Username",
	"desc" => "",
	"id" => $shortname."_dribbble_username",
	"type" => "text",
	"std" => ""
),
array( "name" => "Linkedin URL",
	"desc" => "",
	"id" => $shortname."_linkedin_username",
	"type" => "text",
	"std" => ""
),

array( "type" => "close"),
//End fifth tab "Social Profiles"


//Begin second tab "Advance"
array( "name" => "Advance",
	"type" => "section",
	"icon" => "wrench-screwdriver.png",
),

array( "type" => "open"),

array( "name" => "<h2>SEO Settings</h2>Enable Theme SEO plugin",
	"desc" => "Note: if you use another SEO plugin, please turn off theme SEO feature",
	"id" => $shortname."_seo_enable",
	"type" => "iphone_checkboxes",
	"std" => 1
),
array( "name" => "Homepage Title",
	"desc" => "Enter your homepage title",
	"id" => $shortname."_seo_home_title",
	"type" => "text",
	"std" => ""

),

array( "name" => "Meta Keywords",
	"desc" => "Enter your site keywords (separate by comma ,)",
	"id" => $shortname."_seo_meta_key",
	"type" => "textarea",
	"std" => ""

),

array( "name" => "Meta Description",
	"desc" => "Enter your site description",
	"id" => $shortname."_seo_meta_desc",
	"type" => "textarea",
	"std" => ""

),

array( "name" => "<h2>Javascript and CSS Settings</h2>Enable/disable custom colors and fonts",
	"desc" => "If you want to use theme default color and font setting. You can disable this option and it will speed up your site load time",
	"id" => $shortname."_advance_enable_custom",
	"type" => "iphone_checkboxes",
	"std" => 1
),

array( "name" => "Enable/disble Responsive Feature",
	"desc" => "You can enable/disable reponsive design for mobile devices",
	"id" => $shortname."_advance_responsive",
	"type" => "iphone_checkboxes",
	"std" => 1
),

array( "name" => "Combine and compress theme's javascript files",
	"desc" => "Combine and compress all javascript files to one. Help reduce page load time",
	"id" => $shortname."_advance_combine_js",
	"type" => "iphone_checkboxes",
	"std" => 1
),

array( "name" => "Combine and compress theme's CSS files",
	"desc" => "Combine and compress all CSS files to one. Help reduce page load time",
	"id" => $shortname."_advance_combine_css",
	"type" => "iphone_checkboxes",
	"std" => 1
),

array( "name" => "<h2>Utilities Tools</h2>Restore Default Settings",
	"desc" => "Restore default theme settings. Be careful once you active this, all settings will be changed to default one and it can't be undone.",
	"id" => $shortname."_advance_restore_default",
	"type" => "html",
	"html" => '<br/><input type="submit" id="'.$shortname.'_advance_restore_default" class="button" value="Click here to start restoring settings"><input type="hidden" id="pp_restore_flg" name="pp_restore_flg" value="0"/>',
),

array( "name" => "Clear Cache",
	"desc" => "Try to clear cache when you enable javascript and CSS compression and theme went wrong",
	"id" => $shortname."_advance_clear_cache",
	"type" => "html",
	"html" => '<br/><a id="'.$shortname.'_advance_clear_cache" href="'.$api_url.'" class="button">Click here to start clearing cache files</a>',
),
array( "type" => "close"),
//End second tab "Advance"

 
array( "type" => "close")
 
);
?>