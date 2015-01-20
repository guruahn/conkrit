<?php
/**
 * The main template file for display tag page.
 *
 * @package WordPress
*/

get_header(); 

$page_sidebar = 'Blog Sidebar';
?>
		
</div>

<div class="page_caption">
	<div class="caption_inner">
		<div class="caption_header">
			<h1 class="cufon"><span><?php printf( __( ' %s', '' ), '' . single_cat_title( '', false ) . '' ); ?></span></h1>
		</div>
	</div>
	<br class="clear"/>
</div>
<br class="clear"/>

<!-- Begin content -->
<div id="content_wrapper">
    
    <div class="inner">
    
    	<!-- Begin main content -->
    	<div class="inner_wrapper">
    	
    		<div class="standard_wrapper">
    		
    			<div class="sidebar_content">
					
				<?php
				
				global $more; $more = false;
				
				$num_of_posts = $wp_query->post_count;
				$cur_post = 0;
				
				if (have_posts()) : while (have_posts()) : the_post();
				
					$cur_post++;
					$image_thumb = '';
												
					if(has_post_thumbnail(get_the_ID(), 'large'))
					{
					    $cur_post++;
						$image_thumb = '';
																
						if(has_post_thumbnail(get_the_ID(), 'blog'))
						{
							$image_id = get_post_thumbnail_id(get_the_ID());
							$image_thumb = wp_get_attachment_image_src($image_id, 'blog', true);
						}
					}
				?>
						
						<!-- Begin each blog post -->
						<div id="post-<?php the_ID(); ?>" <?php post_class(); ?> class="post_wrapper">
						
							<?php
						        if(isset($image_thumb[0]))
						        {
						    ?>	
						    <a href="<?php the_permalink(); ?>">
						    	<div class="post_img_wrapper">
							    	<img src="<?php echo $image_thumb[0]; ?>" alt=""/>
							    	<div class="post_img_overlay"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/icon_link.png" alt="" class=""/></div>
							    </div>
						    </a>
						    
						    <?php
						    	}
						    ?>
						    
						    <br class="clear"/>
						    
						    <div class="post_header_wrapper">
						    	<div class="post_date">
								    <div class="month"><?php the_time('M'); ?></div>
								    <div class="date"><?php the_time('j'); ?></div>
								    <div class="year"><?php the_time('Y'); ?></div>
								    <a class="post_date_comment" href="<?php the_permalink(); ?>"><?php comments_number('Leave a Comment', '<h4>1</h4> Comment', '<h4>%</h4> Comments'); ?></a>
								</div>
						    	<div class="post_header">
						    		<h3><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?>								
						    			</a>
						    		</h3>
						    		<div class="post_detail">
						    			<div class="post_detail_item">
											<?php echo _e( 'Date:', THEMEDOMAIN ); ?> <?php echo get_the_time('d M Y'); ?>
										</div>
								    	<div class="post_detail_item">
											<?php echo _e( 'Posted by:', THEMEDOMAIN ); ?> <?php echo get_the_author(); ?>
								    	</div>
								    	<div class="post_detail_item">
											<a href="<?php the_permalink(); ?>"><?php comments_number('Leave a Comment', 'Comment: 1', 'Comment: %'); ?></a>
								    	</div>
									</div>
						    	</div>
						    </div>
						    
						    <div class="post_excerpt">
						    <?php
						    	$pp_blog_display_full = get_option('pp_blog_display_full');
						    	
						    	if(!empty($pp_blog_display_full))
						    	{
						    		the_content();
						    	}
						    	else
						    	{
						    		the_excerpt();
						    ?>
						    		<br/>
						    		<a class="button" href="<?php the_permalink(); ?>"><?php echo _e( 'Read The Rest', THEMEDOMAIN ); ?> →</a>
						    
						    <?php
						    	}
						    	
						    	$pp_blog_share = get_option('pp_blog_share');
						    	
						    	if(!empty($pp_blog_share))
						    	{
						    ?>	
						    
						    	<br class="clear"/><br/><hr/>
						    
							    <div class="post_social">
							    
								    <iframe src="//www.facebook.com/plugins/like.php?href=<?php echo urlencode(get_permalink()); ?>&amp;send=false&amp;layout=button_count&amp;width=200&amp;show_faces=false&amp;action=like&amp;colorscheme=light&amp;font&amp;height=21&amp;appId=268239076529520" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:110px; height:21px;" allowTransparency="true"></iframe>
								    
								    <!-- Place this tag where you want the +1 button to render -->
									<g:plusone size="medium" href="<?php echo get_permalink(); ?>"></g:plusone>
									
									<!-- Place this render call where appropriate -->
									<script type="text/javascript">
									  (function() {
									    var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
									    po.src = 'https://apis.google.com/js/plusone.js';
									    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
									  })();
									</script>
			    		
								    <a href="https://twitter.com/share" class="twitter-share-button" data-count="horizontal" data-text="<?php the_title(); ?>" data-url="<?php echo get_permalink(); ?>">Tweet</a><script type="text/javascript" src="//platform.twitter.com/widgets.js"></script>
								    
								    <a href="http://pinterest.com/pin/create/button/?url=<?php echo urlencode(get_permalink()); ?>" class="pin-it-button" count-layout="horizontal"><img border="0" src="//assets.pinterest.com/images/PinExt.png" title="Pin It" /></a>
							    
							    </div>
							    
							<?php
								}
							?>
							    
						    </div>
						    
						    <br class="clear"/>
						
						</div>
						
						<br class="clear"/><hr/><br class="clear"/><br/>
						
						<!-- End each blog post -->

					<?php endwhile; endif; ?>
					
					<?php
					if(($wp_query->query_vars['paged'] == 0 && $wp_query->max_num_pages > 1) OR ($wp_query->query_vars['paged'] > 0 && $wp_query->query_vars['paged'] <= $wp_query->max_num_pages))
					{
					?>
						<div class="pagination"><p><?php posts_nav_link(' '); ?></p></div>
					<?php
					}
					?>
						
					</div>
					
					<div class="sidebar_wrapper">
					
					    <div class="sidebar_top"></div>
					
					    <div class="sidebar">
					    
					    	<div class="content">
					    
					    		<ul class="sidebar_widget">
					    		<?php dynamic_sidebar($page_sidebar); ?>
					    		</ul>
					    	
					    	</div>
					
					    </div>
					    <br class="clear"/>
					
					    <div class="sidebar_bottom"></div>
					</div>
					
				</div>
				<!-- End main content -->
				
				<br class="clear"/>
				
			</div>
			
		</div>
		<!-- End content -->
				

<?php get_footer(); ?>