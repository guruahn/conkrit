<?php
//Get all galleries
$args = array(
    'numberposts' => -1,
    'post_type' => array('gallery'),
);

$galleries_arr = get_posts($args);
$galleries_select = array();
$galleries_select[''] = '';

foreach($galleries_arr as $gallery)
{
    $galleries_select[$gallery->ID] = $gallery->post_title;
}

//Get all portfolio sets
$sets_obj = get_terms('portfoliosets', 'hide_empty=0&hierarchical=0&parent=0');
$sets_select = array();
$sets_select[''] = '';

foreach($sets_obj as $key => $set_item)
{
    $sets_select[$set_item->slug] = $set_item->name;	
}

//Get all service categories
$service_cat_obj = get_terms('service_cats', 'hide_empty=0&hierarchical=0&parent=0');
$service_cat_select = array();
$service_cat_select[''] = '';

foreach($service_cat_obj as $key => $service_cat)
{
    $service_cat_select[$service_cat->slug] = $service_cat->name;	
}

//Get all categories
$cat_obj = get_categories();
$cat_select = array();
$cat_select[''] = '';

foreach($cat_obj as $key => $cat_item)
{
    $cat_select[$cat_item->cat_ID] = $cat_item->cat_name;	
}

$ppb_shortcodes = array(
    'ppb_text' => array(
    	'title' =>  'Text Block',
    	'attr' => array(),
    	'desc' => array(),
    	'content' => TRUE
    ),
    'ppb_divider' => array(
    	'title' =>  'Divider',
    	'attr' => array(),
    	'desc' => array(),
    	'content' => FALSE
    ),
    'ppb_service' => array(
    	'title' =>  'Service',
    	'attr' => array(
    		'service_cat' => array(
    			'Title' => 'Filter by service category',
    			'type' => 'select',
    			'options' => $service_cat_select,
    			'desc' => 'You can choose to display only some service items from certain category',
    		),
    		'items' => array(
    			'type' => 'jslider',
    			'from' => 1,
    			'to' => 50,
    			'desc' => 'Enter number of service items to display (number value only)',
    		),
    	),
    	'desc' => array(),
    	'content' => FALSE
    ),
    'ppb_styled_box' => array(
    	'title' =>  'Styled Box',
    	'attr' => array(
    		'color' => array(
    			'type' => 'select',
    			'options' => array(
    				'gray' => 'gray', 
    				'white' => 'white', 
    				'blue' => 'blue', 
    				'yellow' => 'yellow',
    				'red' => 'red', 
    				'orange' => 'orange', 
    				'green' => 'green', 
    				'pink' => 'pink', 
    				'purple' => 'purple'
    			),
    			'desc' => 'Select color style of the styled box',
    		),
    	),
    	'desc' => array(),
    	'content' => TRUE
    ),
    'ppb_gallery' => array(
    	'title' =>  'Gallery',
    	'attr' => array(
    		'gallery_id' => array(
    			'Title' => 'Select Gallery',
    			'type' => 'select',
    			'options' => $galleries_select,
    			'desc' => 'Select the gallery contents',
    		),
    		'width' => array(
    			'type' => 'text',
    			'desc' => 'Enter width in pixels for gallery image (number value only)',
    		),
    		'height' => array(
    			'type' => 'text',
    			'desc' => 'Enter height in pixels for gallery image (number value only)',
    		),
    		'items' => array(
    			'type' => 'text',
    			'desc' => 'Enter number of images to display (number value only)',
    		),
    	),
    	'desc' => array(),
    	'content' => FALSE
    ),
    'ppb_tabs' => array(
    	'title' =>  'Tabs',
    	'attr' => array(
    		'tab1_title' => array(
    			'type' => 'text',
    			'title' => 'Tab 1 title',
    			'desc' => 'Enter title for Tab 1',
    		),
    		'tab1_content' => array(
    			'type' => 'textarea',
    			'title' => 'Tab 1 content',
    			'desc' => 'Enter content for Tab 1',
    		),
    		
    		'tab2_title' => array(
    			'type' => 'text',
    			'title' => 'Tab 2 title',
    			'desc' => 'Enter title for Tab 2',
    		),
    		'tab2_content' => array(
    			'type' => 'textarea',
    			'title' => 'Tab 2 content',
    			'desc' => 'Enter content for Tab 2',
    		),
    		
    		'tab3_title' => array(
    			'type' => 'text',
    			'title' => 'Tab 3 title',
    			'desc' => 'Enter title for Tab 3',
    		),
    		'tab3_content' => array(
    			'type' => 'textarea',
    			'title' => 'Tab 3 content',
    			'desc' => 'Enter content for Tab 3',
    		),
    		
    		'tab4_title' => array(
    			'type' => 'text',
    			'title' => 'Tab 4 title',
    			'desc' => 'Enter title for Tab 4',
    		),
    		'tab4_content' => array(
    			'type' => 'textarea',
    			'title' => 'Tab 4 content',
    			'desc' => 'Enter content for Tab 4',
    		),
    		
    		'tab5_title' => array(
    			'type' => 'text',
    			'title' => 'Tab 5 title',
    			'desc' => 'Enter title for Tab 5',
    		),
    		'tab5_content' => array(
    			'type' => 'textarea',
    			'title' => 'Tab 5 content',
    			'desc' => 'Enter content for Tab 5',
    		),
    	),
    	'desc' => array(),
    	'content' => FALSE
    ),
    'ppb_toggle' => array(
    	'title' =>  'Toggle',
    	'attr' => array(
    		'toggle1_title' => array(
    			'type' => 'text',
    			'title' => 'Toggle 1 title',
    			'desc' => 'Enter title for Toggle 1',
    		),
    		'toggle1_content' => array(
    			'type' => 'textarea',
    			'title' => 'Toggle 1 content',
    			'desc' => 'Enter content for Toggle 1',
    		),
    		
    		'toggle2_title' => array(
    			'type' => 'text',
    			'title' => 'Toggle 2 title',
    			'desc' => 'Enter title for Toggle 2',
    		),
    		'toggle2_content' => array(
    			'type' => 'textarea',
    			'title' => 'Toggle 2 content',
    			'desc' => 'Enter content for Toggle 2',
    		),
    		
    		'toggle3_title' => array(
    			'type' => 'text',
    			'title' => 'Toggle 3 title',
    			'desc' => 'Enter title for Toggle 3',
    		),
    		'toggle3_content' => array(
    			'type' => 'textarea',
    			'title' => 'Toggle 3 content',
    			'desc' => 'Enter content for Toggle 3',
    		),
    		
    		'toggle4_title' => array(
    			'type' => 'text',
    			'title' => 'Toggle 4 title',
    			'desc' => 'Enter title for Toggle 4',
    		),
    		'toggle4_content' => array(
    			'type' => 'textarea',
    			'title' => 'Toggle 4 content',
    			'desc' => 'Enter content for Toggle 4',
    		),
    		
    		'toggle5_title' => array(
    			'type' => 'text',
    			'title' => 'Toggle 5 title',
    			'desc' => 'Enter title for Toggle 5',
    		),
    		'toggle5_content' => array(
    			'type' => 'textarea',
    			'title' => 'Toggle 5 content',
    			'desc' => 'Enter content for Toggle 5',
    		),
    	),
    	'desc' => array(),
    	'content' => FALSE
    ),
    'ppb_tagline' => array(
    	'title' =>  'Tagline',
    	'attr' => array(
    		'header_text' => array(
    			'title' => 'Header Text',
    			'type' => 'text',
    			'desc' => 'Enter text for tagline header',
    		),
    		'description' => array(
    			'type' => 'text',
    			'desc' => 'Enter short description text for the tagline',
    		),
    	),
    	'desc' => array(),
    	'content' => FALSE
    ),
    'ppb_portfolio' => array(
    	'title' =>  'Portfolio',
    	'attr' => array(
    		'portfolio_url' => array(
    			'title' => 'Portfolio URL',
    			'type' => 'text',
    			'desc' => 'Enter URL of your portfolio page',
    		),
    		'set_id' => array(
    			'Title' => 'Filter by portfolio set',
    			'type' => 'select',
    			'options' => $sets_select,
    			'desc' => 'You can choose to display only some portfolios from certain set',
    		),
    		'items' => array(
    			'type' => 'text',
    			'desc' => 'Enter number of portfolios to display (number value only)',
    		),
    	),
    	'desc' => array(),
    	'content' => FALSE
    ),
    'ppb_blog' => array(
    	'title' =>  'Blog',
    	'attr' => array(
    		'blog_url' => array(
    			'title' => 'Blog URL',
    			'type' => 'text',
    			'desc' => 'Enter URL of your blog page',
    		),
    		'cat_id' => array(
    			'Title' => 'Filter by category',
    			'type' => 'select',
    			'options' => $cat_select,
    			'desc' => 'You can choose to display only some posts from certain category',
    		),
    		'items' => array(
    			'type' => 'text',
    			'desc' => 'Enter number of posts to display (number value only)',
    		),
    	),
    	'desc' => array(),
    	'content' => FALSE
    ),
);
?>