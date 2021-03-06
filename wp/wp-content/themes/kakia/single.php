<?php
/**
 * The main template file for display single post page.
 *
 * @package WordPress
*/

//If portfolio or gallery content then go to another template
if($post->post_type == 'portfolios')
{
	include (TEMPLATEPATH . "/portfolio_single.php");
    exit;
}

if($post->post_type == 'gallery')
{
	include (TEMPLATEPATH . "/gallery.php");
    exit;
}

if($post->post_type == 'events')
{
	include (TEMPLATEPATH . "/event_single.php");
    exit;
}

if($post->post_type == 'sermons')
{
	include (TEMPLATEPATH . "/sermon_single.php");
    exit;
}

get_header(); 

$page = get_page($post->ID);
$current_page_id = $page->ID;
$page_sidebar = 'Blog Sidebar';

?>
		
	</div>
	
	<div class="page_caption">
    	<div class="caption_inner">
    		<div class="caption_header">
    			<h1 class="cufon"><span><?php echo _e( 'The Blog', THEMEDOMAIN ); ?></span></h1>
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
	    		
	    			<?php
					if (have_posts()) : while (have_posts()) : the_post();
					?>
	    		
	    			<div class="sidebar_content">
						
						<?php
							$image_thumb = '';
							$pp_blog_single_img = get_option('pp_blog_single_img');
														
							if(!empty($pp_blog_single_img) && has_post_thumbnail(get_the_ID(), 'blog'))
							{
							    $image_id = get_post_thumbnail_id(get_the_ID());
							    $image_thumb = wp_get_attachment_image_src($image_id, 'blog', true);
							}
						?>
						
						<!-- Begin each blog post -->
						<div id="post-<?php the_ID(); ?>" <?php post_class(); ?> class="post_wrapper">
						
							<?php
						        if(isset($image_thumb[0]))
						        {
						    ?>	
						    	<div class="post_img_wrapper">
							    	<img src="<?php echo $image_thumb[0]; ?>" alt=""/>
							    </div>
						    
						    <?php
						    	}
						    ?>
						    
						    <br class="clear"/>
						    
						    <div class="post_header_wrapper">
						    	<div class="post_date">
								    <div class="date"><?php the_time('j'); ?></div>
								    <div class="month"><?php the_time('M'); ?></div>
								    <div class="year"><?php the_time('Y'); ?></div>
								</div>
						    	<div class="post_header">
						    		<h3><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?>								
						    			</a>
						    		</h3>
						    		<div class="post_detail">
						    			<div class="post_detail_item">
											<?php echo _e( 'Date:', THEMEDOMAIN ); ?> <?php echo get_the_time('d M Y'); ?>&nbsp;/
										</div>
								    	<div class="post_detail_item">
											<?php echo _e( 'Posted by:', THEMEDOMAIN ); ?> <?php echo get_the_author(); ?>&nbsp;/
								    	</div>
								    	<div class="post_detail_item">
											<a href="<?php the_permalink(); ?>"><?php comments_number('Leave a Comment', 'Comment: 1', 'Comment: %'); ?></a>
								    	</div>
									</div>
						    	</div>
						    </div>
						    
						    <div class="post_excerpt">
						    <?php
						    	the_content();
						    	
						    	$pp_blog_share = get_option('pp_blog_share');
						    	
						    	if(!empty($pp_blog_share))
						    	{
						    ?>	
						    
						    	<br class="clear"/><br/>
						    
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
						
						<!-- End each blog post -->
						
						
						<?php comments_template( '' ); ?>
						
						<?php wp_link_pages(); ?>
						
						<?php endwhile; endif; ?>

					</div>
					
					<div class="sidebar_wrapper">
						<div class="sidebar_top" style="border:0"></div>
					
						<div class="sidebar">
							
							<div class="content">
							
								<ul class="sidebar_widget">
									<?php dynamic_sidebar($page_sidebar); ?>
								</ul>
								
							</div>
						
						</div>
						
						<div class="sidebar_bottom"></div>
						<br class="clear"/>
					
					</div>
					
				</div>
				<!-- End main content -->
				
				<br class="clear"/>
			</div>
		</div>
				

<?php get_footer(); ?>