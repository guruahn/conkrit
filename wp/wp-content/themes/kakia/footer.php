<?php
/**
 * The template for displaying the footer.
 *
 * @package WordPress
 */
?>
	
	</div>
		
		</div>
		
		<!-- Begin footer -->
		<div id="footer">
			<?php
				$pp_footer_display_sidebar = get_option('pp_footer_display_sidebar');
			
				if(!empty($pp_footer_display_sidebar))
				{
					$pp_footer_style = get_option('pp_footer_style');
					$footer_class = '';
					
					switch($pp_footer_style)
					{
						case 1:
							$footer_class = 'one';
						break;
						case 2:
							$footer_class = 'two';
						break;
						case 3:
							$footer_class = 'three';
						break;
						case 4:
							$footer_class = 'four';
						break;
						default:
							$footer_class = 'four';
						break;
					}
					
			?>
			<ul class="sidebar_widget <?php echo $footer_class; ?>">
				<?php dynamic_sidebar('Footer Sidebar'); ?>
			</ul>
			
			<br class="clear"/>
			<?php
				}
			?>
			
		</div>
		<!-- End footer -->
		<div>
		<div>
		<div id="copyright" <?php if(empty($pp_footer_display_sidebar)) { echo 'style="border-top:0"'; } ?>>
			<div class="copyright_wrapper">
				<div class="left_wrapper">
				<?php
					/**
					 * Get footer left text
					 */
	
					$pp_footer_text = get_option('pp_footer_text');
					
					echo nl2br(stripslashes(html_entity_decode($pp_footer_text)));
				?>
				</div>
				
				<div class="right_wrapper">
					<ul class="social_wrapper">
				    	<?php
				    		$pp_twitter_username = get_option('pp_twitter_username');
				    		
				    		if(!empty($pp_twitter_username))
				    		{
				    	?>
				    	<li><a title="Twitter" href="http://twitter.com/<?php echo $pp_twitter_username; ?>"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/social_white/twitter.png" alt=""/></a></li>
				    	<?php
				    		}
				    	?>
				    	<?php
				    		$pp_facebook_username = get_option('pp_facebook_username');
				    		
				    		if(!empty($pp_facebook_username))
				    		{
				    	?>
				    	<li><a title="Facebook" href="http://facebook.com/<?php echo $pp_facebook_username; ?>"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/social_white/facebook.png" alt=""/></a></li>
				    	<?php
				    		}
				    	?>
				    	<?php
				    		$pp_flickr_username = get_option('pp_flickr_username');
				    		
				    		if(!empty($pp_flickr_username))
				    		{
				    	?>
				    	<li><a title="Flickr" href="http://flickr.com/people/<?php echo $pp_flickr_username; ?>"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/social_white/flickr.png" alt=""/></a></li>
				    	<?php
				    		}
				    	?>
				    	<?php
				    		$pp_youtube_username = get_option('pp_youtube_username');
				    		
				    		if(!empty($pp_youtube_username))
				    		{
				    	?>
				    	<li><a title="Youtube" href="http://youtube.com/user/<?php echo $pp_youtube_username; ?>"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/social_white/youtube.png" alt=""/></a></li>
				    	<?php
				    		}
				    	?>
				    	<?php
				    		$pp_vimeo_username = get_option('pp_vimeo_username');
				    		
				    		if(!empty($pp_vimeo_username))
				    		{
				    	?>
				    	<li><a title="Vimeo" href="http://vimeo.com/<?php echo $pp_vimeo_username; ?>"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/social_white/vimeo.png" alt=""/></a></li>
				    	<?php
				    		}
				    	?>
				    	<?php
				    		$pp_tumblr_username = get_option('pp_tumblr_username');
				    		
				    		if(!empty($pp_tumblr_username))
				    		{
				    	?>
				    	<li><a title="Tumblr" href="http://<?php echo $pp_tumblr_username; ?>.tumblr.com"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/social_white/tumblr.png" alt=""/></a></li>
				    	<?php
				    		}
				    	?>
				    	<?php
				    		$pp_google_username = get_option('pp_google_username');
				    		
				    		if(!empty($pp_google_username))
				    		{
				    	?>
				    	<li><a title="Google+" href="<?php echo $pp_google_username; ?>"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/social_white/google.png" alt=""/></a></li>
				    	<?php
				    		}
				    	?>
				    	<?php
				    		$pp_dribbble_username = get_option('pp_dribbble_username');
				    		
				    		if(!empty($pp_dribbble_username))
				    		{
				    	?>
				    	<li><a title="Dribbble" href="http://dribbble.com/<?php echo $pp_dribbble_username; ?>"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/social_white/dribbble.png" alt=""/></a></li>
				    	<?php
				    		}
				    	?>
				    	<?php
				    		$pp_digg_username = get_option('pp_digg_username');
				    		
				    		if(!empty($pp_digg_username))
				    		{
				    	?>
				    	<li><a title="Digg" href="http://digg.com/<?php echo $pp_digg_username; ?>"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/social_white/digg.png" alt=""/></a></li>
				    	<?php
				    		}
				    	?>
				    	<?php
				    		$pp_linkedin_username = get_option('pp_linkedin_username');
				    		
				    		if(!empty($pp_linkedin_username))
				    		{
				    	?>
				    	<li><a title="Linkedin" href="<?php echo $pp_linkedin_username; ?>"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/social_white/linkedin.png" alt=""/></a></li>
				    	<?php
				    		}
				    	?>
				    </ul>				
				</div>
				<br class="clear"/>
			</div>
			</div>
		
		</div>
	
	</div>
		

<?php
		/**
    	*	Setup Google Analyric Code
    	**/
    	include (TEMPLATEPATH . "/google-analytic.php");
?>

<?php
$pp_blog_share = get_option('pp_blog_share');
					    	
if(!empty($pp_blog_share))
{
?>
<script type="text/javascript" src="//assets.pinterest.com/js/pinit.js"></script>
<?php
}
?>

<?php
	/* Always have wp_footer() just before the closing </body>
	 * tag of your theme, or you will break many plugins, which
	 * generally use this hook to reference JavaScript files.
	 */

	wp_footer();
?>
</body>
</html>
