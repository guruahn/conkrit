<?php
/**
 * The Header for the template.
 *
 * @package WordPress
 */

$pp_theme_version = THEMEVERSION;
if ( ! isset( $content_width ) ) $content_width = 960;

if(session_id() == '') {
	session_start();
}
 
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<?php
$pp_advance_responsive = get_option('pp_advance_responsive');

if(!empty($pp_advance_responsive))
{
?>
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
<?php
}
?>

<?php
$pp_seo_enable = get_option('pp_seo_enable');

if(!empty($pp_seo_enable))
{
	if(is_home())
	{
		$pp_seo_home_title = get_option('pp_seo_home_title');
	}
	else if(is_single())
	{
		$page = get_page($post->ID);
		$current_page_id = $page->ID;
		
		$pp_seo_home_title = get_post_meta($current_page_id, 'post_seo_title', true);
	}
}
else
{
	$pp_seo_home_title = '';
}

if(empty($pp_seo_home_title))
{
?>
<title><?php wp_title('&lsaquo;', true, 'right'); ?><?php bloginfo('name'); ?></title>
<?php
} else {
?>
<title><?php echo $pp_seo_home_title; ?></title>
<?php
}
?>

<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />


<?php
if(!empty($pp_seo_enable))
{
	if(is_single())
	{
		$page = get_page($post->ID);
		$current_page_id = $page->ID;
		
		$pp_seo_meta_desc = get_post_meta($current_page_id, 'post_seo_desc', true);
	}
	else
	{
		$pp_seo_meta_desc = get_option('pp_seo_meta_desc');
	}
}
else
{
	$pp_seo_meta_desc = '';
}

if(!empty($pp_seo_meta_desc))
{
?>
<meta name="description" content="<?php echo $pp_seo_meta_desc; ?>" />
<?php
}
?>
<?php
if(!empty($pp_seo_enable))
{
	if(is_single())
	{
		$page = get_page($post->ID);
		$current_page_id = $page->ID;
		
		$pp_seo_meta_key = get_post_meta($current_page_id, 'post_seo_keyword', true);
	}
	else
	{
		$pp_seo_meta_key = get_option('pp_seo_meta_key');
	}
}
else
{
	$pp_seo_meta_key = '';
}

if(!empty($pp_seo_meta_key))
{
?>
<meta name="keywords" content="<?php echo $pp_seo_meta_key; ?>" />
<?php
}
?>

<?php
	/**
	*	Get favicon URL
	**/
	$pp_favicon = get_option('pp_favicon');
	
	if(!empty($pp_favicon))
	{
?>
		<link rel="shortcut icon" href="<?php echo $pp_favicon; ?>" />
<?php
	}
?>

<!-- Template stylesheet -->
<?php   
	$pp_advance_combine_css = get_option('pp_advance_combine_css');
	
	//If compress CSS files
	if(!empty($pp_advance_combine_css))
	{	
		if(!file_exists(get_stylesheet_directory_uri()."/cache/combined.css"))
		{
			$cssmin = new CSSMin();
    		
			$css_arr = array(
			    get_template_directory().'/css/jqueryui/custom.css',
			    get_template_directory().'js/flexslider/flexslider.css',
			    get_template_directory().'/css/slider-style.css',
			    get_template_directory().'/css/screen.css',
			    get_template_directory().'/js/fancybox/jquery.fancybox.css',
			    get_template_directory().'/js/mediaelement/mediaelementplayer.css',
			    get_template_directory().'//templates/custom-caption-css.php',
			);
			
   			$cssmin->addFiles($css_arr);
 			
    		// Set original CSS from all files
    		$cssmin->setOriginalCSS();
    		$cssmin->compressCSS();
 			
    		$css = $cssmin->printCompressedCSS();
    		
    		file_put_contents(get_template_directory()."/cache/combined.css", $css);
    	}
    	
		wp_enqueue_style("combined_css", get_stylesheet_directory_uri()."/cache/combined.css", false, $pp_theme_version);
	}
	else
	{
		 wp_enqueue_style("jqueryui_css", get_stylesheet_directory_uri()."/css/jqueryui/custom.css", false, $pp_theme_version, "all");
		wp_enqueue_style("flexslider_css", get_stylesheet_directory_uri()."/js/flexslider/flexslider.css", false, $pp_theme_version, "all");
		wp_enqueue_style("slider-style.css", get_stylesheet_directory_uri()."/css/slider-style.css", false, $pp_theme_version, "all");
		wp_enqueue_style("screen_css", get_stylesheet_directory_uri()."/css/screen.css", false, $pp_theme_version, "all");
		wp_enqueue_style("fancybox_css", get_stylesheet_directory_uri()."/js/fancybox/jquery.fancybox.css", false, $pp_theme_version, "all");
		wp_enqueue_style("mediaelementplayer_css", get_stylesheet_directory_uri()."/js/mediaelement/mediaelementplayer.css", false, $pp_theme_version, "all");
		wp_enqueue_style("cute_caption", get_stylesheet_directory_uri()."/templates/custom-caption-css.php", false, $pp_theme_version, "all");
	}
?>

<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>

<?php
	wp_enqueue_script("jquery", get_stylesheet_directory_uri()."/js/jquery.js", false, $pp_theme_version);
	wp_enqueue_script("jquery_UI_js", get_stylesheet_directory_uri()."/js/jquery-ui.js", false, $pp_theme_version);
	wp_enqueue_script("swfobject.js", get_stylesheet_directory_uri()."/swfobject/swfobject.js", false, $pp_theme_version);
	
	//Get Google Webfont
	if(isset($_SESSION['pp_font_family']))
	{
		$pp_font = $_SESSION['pp_font_family'];
	}
	else
	{
		$pp_font = get_option('pp_font_family');
	}
	$pp_font = urlencode($pp_font);
	if(!empty($pp_font))
	{
        if( $pp_font == "Open+Sans+Condensed") $pp_font = "Open+Sans+Condensed:300,700,300italic";
		wp_enqueue_style('google_fonts', "http://fonts.googleapis.com/css?family=".$pp_font."&subset=latin,cyrillic-ext,greek-ext,cyrillic", false, "", "all");
	}
	else
	{
		wp_enqueue_style('google_fonts', get_stylesheet_directory_uri()."/css/gfont.css", false, "", "all");
	}
	//End Get Google Webfont

    //Get NanumBarunGothic Webfont
    wp_enqueue_style('nanum_fonts', "//cdn.jsdelivr.net/font-nanum/1.0/nanumbarungothic/nanumbarungothic.css", false, "", "all");
    //End Get NanumBarunGothic Webfont
	
	//Get Theme Layout
	if(isset($_SESSION['pp_theme_layout']))
	{
		$pp_theme_layout = $_SESSION['pp_theme_layout'];
	}
	else
	{
		$pp_theme_layout = get_option('pp_theme_layout');
	}
	
	if($pp_theme_layout == 'boxed')
	{
		if(!empty($pp_advance_combine_css))
		{
			if(!file_exists(get_stylesheet_directory_uri()."/cache/combined_boxed.css"))
			{
				$cssmin = new CSSMin();
	    		
				$css_arr = array(
				    get_template_directory().'/css/boxed.css',
				);
				
	   			$cssmin->addFiles($css_arr);
	 			
	    		// Set original CSS from all files
	    		$cssmin->setOriginalCSS();
	    		$cssmin->compressCSS();
	 			
	    		$css = $cssmin->printCompressedCSS();
	    		
	    		file_put_contents(get_template_directory()."/cache/combined_boxed.css", $css);
	    	}
	    	
			wp_enqueue_style("combined_boxed_css", get_stylesheet_directory_uri()."/cache/combined_boxed.css", false, THEMEVERSION);
		}
		else
		{
			wp_enqueue_style('boxed', get_stylesheet_directory_uri()."/css/boxed.css", false, "", "all");
		}
	}
	else
	{
		$pp_advance_enable_switcher = get_option('pp_advance_enable_switcher');
		
		if(!empty($pp_advance_enable_switcher))
		{
			wp_enqueue_style('boxed', get_stylesheet_directory_uri()."/css/empty.css", false, "", "all");
		}
	}
	//End Get Theme Layout
	
	//Get all theme javascripts
	wp_enqueue_script("jquery");
	wp_enqueue_script("google_maps", "http://maps.google.com/maps/api/js?sensor=false", false, THEMEVERSION);
	wp_enqueue_script("jquery_UI_js", get_stylesheet_directory_uri()."/js/jquery-ui.js", false, THEMEVERSION);
	wp_enqueue_script("swfobject.js", get_stylesheet_directory_uri()."/swfobject/swfobject.js", false, THEMEVERSION);
	
	//Get all theme javascripts
	$js_path = get_template_directory()."/js/";
	$js_arr = array(
	    'fancybox/jquery.fancybox.pack.js',
	    'jquery.easing.js',
	    'gmap.js',
	    'jquery.validate.js',
	    'browser.js',
	    'jquery.isotope.js',
	    'flexslider/jquery.flexslider-min.js',
	    'reflection.js',
	    'jwplayer.js',
	    'hint.js',
	    'mediaelement/mediaelement-and-player.min.js',
	    'cute/modernizr.js',
	    'cute/cute.slider.js',
	    'cute/cute.transitions.all.js',
	    'cute/respond.min.js',
	    'custom.js',
	);
	$js = "";

	$pp_advance_combine_js = get_option('pp_advance_combine_js');
	
	if(!empty($pp_advance_combine_js))
	{	
		if(!file_exists(get_template_directory()."/cache/combined.js"))
		{
			foreach($js_arr as $file) {
				if($file != 'jquery.js' && $file != 'jquery-ui.js')
				{
    				$js .= JSMin::minify(file_get_contents($js_path.$file));
    			}
			}
			
			file_put_contents(get_template_directory()."/cache/combined.js", $js);
		}

		wp_enqueue_script("combined_js", get_stylesheet_directory_uri()."/cache/combined.js", false, THEMEVERSION);
	}
	else
	{
		foreach($js_arr as $file) {
			if($file != 'jquery.js' && $file != 'jquery-ui.js')
			{
				wp_enqueue_script($file, get_stylesheet_directory_uri()."/js/".$file, false, THEMEVERSION);
			}
		}
	}
	
	wp_register_script("script-contact-form", get_stylesheet_directory_uri()."/templates/script-contact-form.php", false, THEMEVERSION, true);
	$params = array(
	  'ajaxurl' => curPageURL(),
	  'ajax_nonce' => wp_create_nonce('tgajax-post-contact-nonce'),
	);
	wp_localize_script( 'script-contact-form', 'tgAjax', $params );
	wp_enqueue_script("script-contact-form", get_stylesheet_directory_uri()."/templates/script-contact-form.php", false, THEMEVERSION, true);
?>

<!--[if IE]>
<link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/css/ie.css?v=<?php echo $pp_theme_version; ?>.css" type="text/css" media="all"/>
<![endif]-->

<?php
if(isset($_SESSION['pp_skin']) && !empty($_SESSION['pp_skin']))
{
	wp_enqueue_style("custom_skins", get_stylesheet_directory_uri()."/templates/custom-skins.php", false, $pp_theme_version, "all");
}
else
{
	$pp_advance_enable_custom = get_option('pp_advance_enable_custom');

	if(!empty($pp_advance_enable_custom))
	{
		wp_enqueue_style("custom_css", get_stylesheet_directory_uri()."/templates/custom-css.php", false, $pp_theme_version, "all");
	}
}

?>

<?php
if(!empty($pp_advance_responsive))
{
    if(!empty($pp_advance_combine_css))
    {
    	if(!file_exists(get_stylesheet_directory_uri()."/cache/combined_grid.css"))
    	{
    		$cssmin = new CSSMin();
    		
    		$css_arr = array(
    		    get_template_directory().'/css/grid.css',
    		);
    		
   			$cssmin->addFiles($css_arr);
 			
    		// Set original CSS from all files
    		$cssmin->setOriginalCSS();
    		$cssmin->compressCSS();
 			
    		$css = $cssmin->printCompressedCSS();
    		
    		file_put_contents(get_template_directory()."/cache/combined_grid.css", $css);
    	}
    	
    	wp_enqueue_style("combined_grid_css", get_stylesheet_directory_uri()."/cache/combined_grid.css", false, THEMEVERSION);
    }
    else
    {
    	wp_enqueue_style('grid', get_stylesheet_directory_uri()."/css/grid.css", false, "", "all");
    }
}
?>

<?php
	/* Always have wp_head() just before the closing </head>
	 * tag of your theme, or you will break many plugins, which
	 * generally use this hook to add elements to <head> such
	 * as styles, scripts, and meta tags.
	 */
	wp_head();
?>
</head>

<?php

/**
*	Get Current page object
**/
if(!is_null($post))
{
	$page = get_page($post->ID);
}


/**
*	Get current page id
**/
$current_page_id = '';

if(isset($page->ID))
{
    $current_page_id = $page->ID;
}
?>

<body <?php body_class(); ?>>

	<?php
		$pp_slider_timer = get_option('pp_slider_timer'); 
				
		if(empty($pp_slider_timer))
		{
		    $pp_slider_timer = 5;
		}
	?>
	<input type="hidden" id="slider_timer" name="slider_timer" value="<?php echo $pp_slider_timer; ?>"/>
	
	<input type="hidden" id="pp_blogurl" name="pp_blogurl" value="<?php echo home_url(); ?>"/>
	
	<input type="hidden" id="pp_stylesheet_directory" name="pp_stylesheet_directory" value="<?php echo get_stylesheet_directory_uri(); ?>"/>
	<?php
		$pp_footer_style = get_option('pp_footer_style');
	?>
	<input type="hidden" id="pp_footer_style" name="pp_footer_style" value="<?php echo $pp_footer_style; ?>"/>
	
	<!-- Begin template wrapper -->
	<div id="wrapper">
			
		<div class="header_bg">	
		
			<!-- Begin header -->
			<div id="header_wrapper">
				
				<!-- Begin main nav -->
				<div id="menu_wrapper">
				
				    <div class="logo">
				    	<!-- Begin logo -->
				    
				    	<?php
				    		//get custom logo
				    		$pp_logo = get_option('pp_logo');
				    		
				    		if(empty($pp_logo))
				    		{
				    			$pp_logo = get_stylesheet_directory_uri().'/images/logo.png';
				    		}
				    
				    	?>
				    	
				    	<a id="custom_logo" href="<?php echo home_url(); ?>"><img src="<?php echo $pp_logo?>" alt=""/></a>
				    	
				    	<!-- End logo -->
				    	
				    </div>
				    
<!-- Begin top bar -->
<div id="top_bar">
	<!-- <div class="top_bar_wrapper">
		<div class="top_social">
			<form role="search" method="get" id="searchform" class="searchform" action="http://conkrit.com:8080/">
				<div>
					<label class="screen-reader-text" for="s">검색:</label>
					<input type="text" value="" name="s" id="s" title="Enter keywords..." class="blur">
					<input type="submit" id="searchsubmit" value="검색">
				</div>
			</form>
		</div> 
	</div>
	<div class="top_contact_info">
	    <ul>
    		<li><a href="#" class="user_contact">Contact Us</a></li>
    		<li><a href="#" class="user_login">Log in</a> |</li>
    	</ul>
	</div> -->
</div>
<!-- End top bar -->
					
				    
				    <div id="menu_border_wrapper">
				
				    	<?php 	
				    	if ( has_nav_menu( 'primary-menu' ) ) 
				    	{
				    		//Get page nav
				    		wp_nav_menu( 
				    		    	array( 
				    		    		'menu_id'			=> 'main_menu',
				    		    		'menu_class'		=> 'nav',
				    		    		'theme_location' 	=> 'primary-menu',
				    		    		'container_class' 	=> 'menu-main-menu-container',
				    		    	) 
				    		); 
				    	}
				        else
				        {
				         		echo '<div class="notice">Please setup "Primary Menu" using Wordpress Dashboard > Appearance > Menus</div>';
				        }
				    	?>
				    
				    </div>
				
				</div>
				<!-- End main nav -->
		
		</div>
		
		<?php
			$pp_advance_enable_switcher = get_option('pp_advance_enable_switcher');
		
		    if(!empty($pp_advance_enable_switcher))
		    {
		?>
		<form action="<?php echo get_stylesheet_directory_uri(); ?>/switcher.php" method="get" id="form_option" name="form_option">
		    <div id="option_wrapper">
		    <div class="inner">
		    	<h5>Style Selector</h5><br/>
		    	
		    	Which theme layout you want to used?<br/>
		    	<select name="pp_theme_layout" id="pp_theme_layout" style="margin-top:5px">
		    	    <option value="fullwidth" <?php if($pp_theme_layout == 'fullwidth') { ?>selected=selected<?php } ?>>Fullwidth</option>
		    	    <option value="boxed" <?php if($pp_theme_layout == 'boxed') { ?>selected=selected<?php } ?>>Boxed</option>
		    	</select>
				
				<br/><br/>
		    
		    	Which predefined skin colors you want to used? (You can also set your own one using Theme Setting)<br/>
		    	<a class="skin_box" href="<?php echo get_stylesheet_directory_uri(); ?>/switcher.php?pp_skin=ps_1358005683" title="Orange" style="background:#f17007"></a>
		    	<a class="skin_box" href="<?php echo get_stylesheet_directory_uri(); ?>/switcher.php?pp_skin=ps_1358005617" title="Blue" style="background:#4fcaf0"></a>
		    	<a class="skin_box" href="<?php echo get_stylesheet_directory_uri(); ?>/switcher.php?pp_skin=ps_1358005723" title="Grey" style="background:#929aa1"></a>
		    	<a class="skin_box" href="<?php echo get_stylesheet_directory_uri(); ?>/switcher.php?pp_skin=ps_1358004403" title="Green" style="background:#9aca42"></a>
		    	<a class="skin_box" href="<?php echo get_stylesheet_directory_uri(); ?>/switcher.php?pp_skin=ps_1358005776" title="Red" style="background:#d41e1e"></a>
		    	<a class="skin_box" href="<?php echo get_stylesheet_directory_uri(); ?>/switcher.php?pp_skin=ps_1358005809" title="Pink" style="background:#ed6280"></a>
		    	<a class="skin_box" href="<?php echo get_stylesheet_directory_uri(); ?>/switcher.php?pp_skin=ps_1358005844" title="Ocean" style="background:#5ad1c1"></a>
		    	<a class="skin_box" href="<?php echo get_stylesheet_directory_uri(); ?>/switcher.php?pp_skin=ps_1358005876" title="Gold" style="background:#d6b962"></a>
		    	<a class="skin_box" href="<?php echo get_stylesheet_directory_uri(); ?>/switcher.php?pp_skin=ps_1358005918" title="Purple" style="background:#cbaae0"></a>
		    	<a class="skin_box" href="<?php echo get_stylesheet_directory_uri(); ?>/switcher.php?pp_skin=ps_1358005947" title="Purple Blue" style="background:#7dadff"></a>
		    	
		    	<br class="clear"/><br/><br/>
		    	<a class="button" href="<?php echo get_stylesheet_directory_uri(); ?>/switcher.php?reset=1" style="width:54px">Reset</a>
		    </div>
		    </div>
		    <div id="option_btn">
		    	<img src="<?php echo get_stylesheet_directory_uri(); ?>/images/color.png" alt=""/>
		    </div>
		</form>
		<?php
		    }
		?>
		
		<br class="clear"/>