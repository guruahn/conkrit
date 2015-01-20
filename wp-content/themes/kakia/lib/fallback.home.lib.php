<?php
	global $pp_homepage_content, $has_homepage_content;

	if(is_front_page() && empty($pp_homepage_content) && empty($has_homepage_content))
	{
		$pp_homepage_content = array($post->ID);
		$has_homepage_content = serialize($pp_homepage_content);
		
		include(TEMPLATEPATH.'/index.php');
		exit;
	}
?>