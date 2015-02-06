<?php
/**
 * Template Name: Contact
 * The main template file for display contact page.
 *
 * @package WordPress
*/

include (get_template_directory() . "/lib/fallback.home.lib.php");

/**
*	if not submit form
**/

if(!isset($_POST['your_name']))
{

if(!isset($hide_header) OR !$hide_header)
{
	get_header(); 
}

/**
*	Get Current page object
**/
$page = get_page($post->ID);

/**
*	Get current page id
**/

if(!isset($current_page_id) && isset($page->ID))
{
    $current_page_id = $page->ID;
}

//Get page Sidebar
$page_sidebar = get_post_meta($current_page_id, 'page_sidebar', true);
if(empty($page_sidebar))
{
	$page_sidebar = 'Contact Sidebar';
}

//If display on homepage then disable header
if(!isset($hide_header) OR !$hide_header)
{
?>
		
</div>

<div class="page_caption">
    <div class="caption_header">
        <?php if ( has_post_thumbnail() ) : ?>
            <div class="caption_bg">
                <?php the_post_thumbnail(); ?>
            </div>
        <?php endif; ?>
        <?php
        breadcrumbs('primary-menu');
        ?>

    </div>
    <br class="clear"/>
</div>

<!-- Begin content -->
<div id="content_wrapper">

    <div class="inner">
    
    	<!-- Begin main content -->
    	<div class="inner_wrapper">
    	
    	<div class="standard_wrapper">
            <div class="title">
                <h1 class="cufon"><span><?php the_title(); ?></span></h1>
                <?php
                $page_description = get_post_meta($current_page_id, 'page_description', true);

                if(!empty($page_description))
                {
                    ?>
                    <span class="page_description"><?php echo $page_description; ?></span>
                <?php
                }
                ?>
            </div>
    		<?php
	    		$pp_contact_email = get_option('pp_contact_email');
				$pp_contact_email_display = get_option('pp_contact_email_display');
				$pp_contact_phone = get_option('pp_contact_phone');
				$pp_contact_address = get_option('pp_contact_address');
				
				if(!empty($pp_contact_email) OR !empty($pp_contact_email_display) OR !empty($pp_contact_phone) OR !empty($pp_contact_address))
				{
			?>
				<p class="contact_text">콘크릿에 대해 더 궁금하시다면 언제든지 연락 주세요!</p>
	    		<div class="contact_style1_info">
	    			<h2>
	    			<?php
					   	/*
						if(!empty($pp_contact_email) && !empty($pp_contact_email_display))
					   	{	
					   		echo $pp_contact_email.' ';
					   	}
							    		
					   	if(!empty($pp_contact_phone))
					   	{
					   		echo _e( 'Tel. ', THEMEDOMAIN ).' '.$pp_contact_phone;
					   	}
					   	*/
					?>
	    			</h2>
	    			<?php
	    			   	/*
						if(!empty($pp_contact_address))
	    			   	{
					   		echo $pp_contact_address;
					   	}
	    			   	*/
					?>
	    		</div>
	    	<?php
	    		}
	    	?>
    	
    		<?php
			    //Check if display contact map
			    $pp_contact_display_map = get_option('pp_contact_display_map');
			    
			    if(!empty($pp_contact_display_map))
			    {
			    	$pp_contact_lat = get_option('pp_contact_lat');
			    	$pp_contact_long = get_option('pp_contact_long');
			    	$pp_contact_map_zoom = get_option('pp_contact_map_zoom');
			?>
			    	<div class="map_shadow">
			    		<div id="map_contact"></div>
			    	</div>
			    	<script>
			    		$j(document).ready(function(){ 
			    			$j("#map_contact").gMap({ zoom: <?php echo $pp_contact_map_zoom; ?>, markers: [ { latitude: '<?php echo $pp_contact_lat; ?>', longitude: '<?php echo $pp_contact_long; ?>' } ], mapTypeControl: false, zoomControl: false, scrollwheel: false });
			    		});
			    	</script>
			<?php
			    }
			?>
					
<?php
}
?>

			<!-- <div class="sidebar_wrapper">
			    
			    <div class="sidebar">
			    	
			    	<div class="content">
			    	
			    		<ul class="sidebar_widget">
			    		<?php dynamic_sidebar($page_sidebar); ?>
			    		</ul>
			    		
			    	</div>
			    
			    </div>
			    <br class="clear"/>
					
			    <div class="sidebar_bottom"></div>
			
			</div> -->
				
			<div class="">
			
				<?php 
				    if ( have_posts() ) while ( have_posts() ) : the_post(); ?>		
				
				    		<?php the_content(); break; ?>
				
				<?php endwhile; ?>
			    
			    <?php
			    	//Begin contact form
			    	$pp_contact_form = unserialize(get_option('pp_contact_form_sort_data'));
			    ?>
			    <form id="contact_form" class="style1" method="post" action="<?php echo curPageURL(); ?>">
			    <div class="one_half">
			    	<?php 
			    		if(is_array($pp_contact_form) && !empty($pp_contact_form))
			    		{
			    			foreach($pp_contact_form as $form_input)
			    			{
			    				switch($form_input)
			    				{
			    					case 1:
			    	?>
			        				<input id="your_name" name="your_name" type="text" title="<?php echo _e( '담당자', THEMEDOMAIN ); ?>" style="width:90%"/>	
			    	<?php
			    					break;
			    					
			    					case 2:
			    	?>
			    					
			        				<input id="email" name="email" type="text" title="<?php echo _e( '이메일', THEMEDOMAIN ); ?>" style="width:90%"/>		
			    	<?php
			    					break;
			    					
			    					case 4:
			    	?>
			    					
			        				<input id="address" name="address" type="text" title="<?php echo _e( 'Address', THEMEDOMAIN ); ?>" style="width:28%"/>		
			    	<?php
			    					break;
			    					
			    					case 5:
			    	?>
			    					
			        				<input id="phone" name="phone" type="text" title="<?php echo _e( '전화번호', THEMEDOMAIN ); ?>" style="width:90%"/>		
			    	<?php
			    					break;
			    					
			    					case 6:
			    	?>
			    					
			        				<input id="mobile" name="mobile" type="text" title="<?php echo _e( 'Mobile', THEMEDOMAIN ); ?>" style="width:28%"/>			
			    	<?php
			    					break;
			    					
			    					case 7:
			    	?>
			    					
			        				<input id="company" name="company" type="text" title="<?php echo _e( '고객사', THEMEDOMAIN ); ?>" style="width:90%"/>			
			    	<?php
			    					break;
			    					
			    					case 8:
			    	?>
			    					
			        				<input id="country" name="country" type="text" title="<?php echo _e( 'Country', THEMEDOMAIN ); ?>" style="width:28%;"/>			
			    	<?php
			    					break;
			    					
			    					case 3:
			    	?>
			    					
			        				</div><div class="one_half last"><textarea id="message" name="message" rows="7" cols="10" title="<?php echo _e( '프로젝트 문의', THEMEDOMAIN ); ?>" style="width:95%;height:147px"></textarea></div>				
			    	<?php
			    					break;
			    				}
			    			}
			    		}
			    	?>
			    	
			    	<?php
			    		$pp_contact_enable_captcha = get_option('pp_contact_enable_captcha');
			    		
			    		if(!empty($pp_contact_enable_captcha))
			    		{
			    	?>
			    		
			    		<br class="clear"/>
			    		<div id="captcha-wrap">
							<div class="captcha-box">
								<img src="<?php echo get_stylesheet_directory_uri(); ?>/get_captcha.php" alt="" id="captcha" />
							</div>
							<div class="text-box">
								<label>Type the two words:</label>
								<input name="captcha-code" type="text" id="captcha-code">
							</div>
							<div class="captcha-action">
								<img src="<?php echo get_stylesheet_directory_uri(); ?>/images/refresh.jpg"  alt="" id="captcha-refresh" />
							</div>
						</div>
					
					<?php
					}
					?>
			
			        <br class="clear"/><br/>
			    	<div class="btns_center"><input type="submit" value="<?php echo _e( '상담문의 남기기', THEMEDOMAIN ); ?>" /></div><br/>
			    </form>
			    <div id="reponse_msg"></div>
			    <br/><br/><br/>
			    
			</div>
				
		<?php
		if(!isset($hide_header) OR !$hide_header)
		{
		?>	
			</div>
			<!-- End main content -->
			
							
			<br class="clear"/>

			</div>
		</div>
		<!-- End content -->

		<?php get_footer(); ?>
		
		<?php
		}
		?>
		
		</div>
			
		<!-- End main content -->
		<br class="clear"/>
				
	</div>
			
</div>
<!-- End content -->
				
<?php
}

//if submit form
else
{
	check_ajax_referer( 'tgajax-post-contact-nonce', 'tg_security' );

	/*
	|--------------------------------------------------------------------------
	| Mailer module
	|--------------------------------------------------------------------------
	|
	| These module are used when sending email from contact form
	|
	*/
	
	//Get your email address
	$contact_email = get_option('pp_contact_email');
	
	//Enter your email address, email from contact form will send to this addresss. Please enter inside quotes ('myemail@email.com')
	define('DEST_EMAIL', $contact_email);
	
	//Change email subject to something more meaningful
	define('SUBJECT_EMAIL', __( 'Email from contact form', THEMEDOMAIN ));
	
	//Thankyou message when message sent
	define('THANKYOU_MESSAGE', __( 'Thank you! We will get back to you as soon as possible', THEMEDOMAIN ));
	
	//Error message when message can't send
	define('ERROR_MESSAGE', __( 'Oops! something went wrong, please try to submit later.', THEMEDOMAIN ));
	
	
	/*
	|
	| Begin sending mail
	|
	*/
	
	$from_name = $_POST['your_name'];
	$from_email = $_POST['email'];
	
	$mime_boundary_1 = md5(time());
    $mime_boundary_2 = "1_".$mime_boundary_1;
    $mail_sent = false;
 
    # Common Headers
    $headers = "";
    $headers .= 'From: '.$from_name.'<'.$from_email.'>'.PHP_EOL;
    $headers .= 'Reply-To: '.$from_name.'<'.$from_email.'>'.PHP_EOL;
    $headers .= 'Return-Path: '.$from_name.'<'.$from_email.'>'.PHP_EOL;        // these two to set reply address
    $headers .= "Message-ID: <".$now."webmaster@".$_SERVER['SERVER_NAME'].">";
    $headers .= "X-Mailer: PHP v".phpversion().PHP_EOL;                  // These two to help avoid spam-filters
	
	$message = 'Name: '.$from_name.PHP_EOL;
	$message.= 'Email: '.$from_email.PHP_EOL.PHP_EOL;
	$message.= 'Message: '.PHP_EOL.$_POST['message'].PHP_EOL.PHP_EOL;
	
	if(isset($_POST['address']))
	{
		$message.= 'Address: '.$_POST['address'].PHP_EOL;
	}
	
	if(isset($_POST['phone']))
	{
		$message.= 'Phone: '.$_POST['phone'].PHP_EOL;
	}
	
	if(isset($_POST['mobile']))
	{
		$message.= 'Mobile: '.$_POST['mobile'].PHP_EOL;
	}
	
	if(isset($_POST['company']))
	{
		$message.= 'Company: '.$_POST['company'].PHP_EOL;
	}
	
	if(isset($_POST['country']))
	{
		$message.= 'Country: '.$_POST['country'].PHP_EOL;
	}
	    
	
	if(!empty($from_name) && !empty($from_email) && !empty($message))
	{
		mail(DEST_EMAIL, SUBJECT_EMAIL, $message, $headers);
	
		echo THANKYOU_MESSAGE;
		
		exit;
	}
	else
	{
		echo ERROR_MESSAGE;
		
		exit;
	}
	
	/*
	|
	| End sending mail
	|
	*/
}

?>