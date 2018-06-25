<?php
/*
Template Name: Thankyou Template
*/
get_header();

require_once('include/portal_db_config.php');

$donorFirstName = "";
$donorLastName = "";
$donorEmail = "";
$donationAmount = 0 ;
$donationCurrency = "" ;
$fundraiserQuery = mysql_query("SELECT * FROM fundraiser_donors WHERE uniqueid = '" . $_GET['uid'] . "'") or die(mysql_error());
if($row = mysql_fetch_array($fundraiserQuery)) {
    
    $donorFirstName = $row['donor_firstname'];
    $donorLastName = $row['donor_lastname'];
    $donorEmail = $row['donor_email'];
    $donationAmount = $row['donor_amount'] ;
    $donationCurrency = $row['donor_currency'] ;
    
}

$to = $donorEmail;
$subject = "Thank you for your donation";

$message = '

<center>
    <table cellspacing="0" cellpadding="0" border="1" 
    style="width:500pt;border-top:6.0pt;border-left:1.0pt;border-bottom:4.5pt;border-right:1.0pt;border-color:#999999;border-style:solid; margin-left:auto; margin-right:auto;">
    <tr>
    <td style="border:none;padding:11.25pt 11.25pt 11.25pt 11.25pt">
    <p class="MsoNormal" style="line-height:13.5pt">
    <span style="font-size:9.0pt;font-family:"Verdana"><center>
    <img src="http://www.studentsofferingsupport.ca/portal/images/newLOGO.jpg"></center>
    <u></u>
    <u></u>
    </span>
    </p>
	<div style="margin: 20px; font-family: Open Sans;">
	<br/><p>To '.$donorFirstName.',</p> 
<p>Thank you for your donation. Your support is greatly appreciated to all of us at Students Offering Support. </p>
<p>We will be e-mailing out charitable receipts when our fundraising period ends. You should receive your receipt no later than October 31st and should have received an email confirmation (check spam and mark us as safe!). </p>
<p>During this time, we are hoping to reach as many SOS supporters as possible. If you know of other volunteers, trip participants and supporters and would be able to share this message with them, we would be so grateful. </p>
<p>Thank you again, and please do not hesitate to stay in touch on <a href="http://www.facebook.com/StudentsOfferingSupport">Facebook</a> or <a href="http://www.twitter.com/SOSheadoffice">Twitter</a>. </p>
<p>All the best, </p>
<p>The Students Offering Support team</p> 
</div>
	
	
	
    <div style = "height:40px"></div>
    <div align="right">
    Follow us!&nbsp;&nbsp;&nbsp;&nbsp;
    <br/>
    <a href = "https://www.facebook.com/StudentsOfferingSupport">
    <img src="http://www.studentsofferingsupport.ca/portal/images/facebook-icon1_opt.png" height = "40px" width = "40px"></a>
    <a href = "https://twitter.com/SOSheadoffice">
    <img src="http://www.studentsofferingsupport.ca/portal/images/twittericon_opt.png" height = "40px" width = "40px"></a>
    </div>
    </td>
    </tr>
    </table>
    </center>
	
';

$headers = array('Content-Type: text/html; charset=UTF-8' , 'From: Students Offering Support <info@studentsofferingsupport.ca>');

//wp_mail( $to, $subject, $message, $headers, $attachments );
wp_mail( $to, $subject, $message, $headers );


?>

	<div class="gdlr-content">

		<!-- Above Sidebar Section-->
		<?php global $gdlr_post_option, $above_sidebar_content, $with_sidebar_content, $below_sidebar_content; ?>
		<?php if(!empty($above_sidebar_content)){ ?>
			<div class="above-sidebar-wrapper"><?php gdlr_print_page_builder($above_sidebar_content); ?></div>
		<?php } ?>
		
		<!-- Sidebar With Content Section-->
		<?php 
			if( !empty($gdlr_post_option['sidebar']) && ($gdlr_post_option['sidebar'] != 'no-sidebar' )){
				global $gdlr_sidebar;
				
				$gdlr_sidebar = array(
					'type'=>$gdlr_post_option['sidebar'],
					'left-sidebar'=>$gdlr_post_option['left-sidebar'], 
					'right-sidebar'=>$gdlr_post_option['right-sidebar']
				); 
				$gdlr_sidebar = gdlr_get_sidebar_class($gdlr_sidebar);
		?>
			<div class="with-sidebar-wrapper">
				<div class="with-sidebar-container container">
					<div class="with-sidebar-left <?php echo $gdlr_sidebar['outer']; ?> columns">
						<div class="with-sidebar-content <?php echo $gdlr_sidebar['center']; ?> columns">
							<?php 
								if( !empty($with_sidebar_content) ){
									gdlr_print_page_builder($with_sidebar_content, false);
								}
								if( !empty($gdlr_post_option['show-content']) && $gdlr_post_option['show-content'] != 'disable' ){
									get_template_part('single/content', 'page');
								}
							?>							
						</div>
						<?php get_sidebar('left'); ?>
						<div class="clear"></div>
					</div>
					<?php get_sidebar('right'); ?>
					<div class="clear"></div>
				</div>				
			</div>				
		<?php 
			}else{ 
				if( !empty($with_sidebar_content) ){ 
					echo '<div class="with-sidebar-wrapper">';
					gdlr_print_page_builder($with_sidebar_content);
					echo '</div>';
				}
				if( empty($gdlr_post_option['show-content']) || $gdlr_post_option['show-content'] != 'disable' ){
					get_template_part('single/content', 'page');
				}
			} 
		?>

		
		<!-- Below Sidebar Section-->
		<?php if(!empty($below_sidebar_content)){ ?>
			<div class="below-sidebar-wrapper"><?php gdlr_print_page_builder($below_sidebar_content); ?></div>
		<?php } ?>

		
	</div><!-- gdlr-content -->
	<!-- Alfonz Code for new homepage design -->
		
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link href="<?php bloginfo('template_directory') ?>/stylesheet/bootstrap.min.css" rel="stylesheet">
		<link href="<?php bloginfo('template_directory') ?>/fontawesome/css/font-awesome.min.css" rel="stylesheet">
		<link href="<?php bloginfo('template_directory') ?>/stylesheet/homepage.css" rel="stylesheet">
		<link href="<?php bloginfo('template_directory') ?>/stylesheet/fundraiser.css" rel="stylesheet">
			
		<script src="<?php bloginfo('template_directory') ?>/javascript/bootstrap.min.js"></script>
		
		<div id="">
	
			<!-- banner-fundraiser -->
			<div id="banner-thankyou" class="text-center">
				<div class="container banner-txt">
					<h1 class="banner-header txt-drop-shadow">Thank you!</h1>
		
					<p class="txt-drop-shadow"></p>
		
				</div>
			</div>
			<!-- end banner-fundraiser -->
			
			<!-- goal -->
			<div id="goal" class="page">
				<div class="container gdlr-navigation-container fundraiser-box">
					<div class="row">
						<div class="col-lg-12 form-box">
							<div class="text-center">
								<h1 class="darkblue">THANK YOU & STAY CONNECTED</h1>
</br></br>
								<p>Thank you for your donation. Your support is greatly appreciated to all of us at Students Offering Support. You should have received an e-mail from PayPal with your confirmation of your donation, and you should also have an email from us (yet, it may have gone into spam). </p>
<p>We will be e-mailing out charitable receipts when our fundraising period ends. You should receive them no later than October 31st.  </p>
<p>If you are interested in getting involved, be it as a volunteer with the head office, or if interested in helping see if your company would be interested in getting involved - please send us an email at info@studentsofferingsupport.ca</p>

<p>To return to the main fundraising page, <a href="../fundraiser/?id=<?php echo $_GET['id']; ?>">click here</a></p>
<p>Thank you for your support!</p>
							</div>
							
							
							<!-- <div class="form-section">
								<?php echo do_shortcode( '[contact-form-7 id="2112" title="Thank You Form"]' ); ?>
							</div> -->
							
							
						</div>
						
					</div>
				</div>	

				<div class="form-bg">

				</div>
			</div>
			<!-- END goal -->
		
		
		</div>
	
	<!-- End Alfonz code -->
	
<?php get_footer(); ?>