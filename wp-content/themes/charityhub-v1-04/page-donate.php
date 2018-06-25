<?php
/*
Template Name: Donate Template
*/
get_header();
?>
<?php
//connect to db
require_once('include/portal_db_config.php');

?>
<script src="<?php echo bloginfo('url');?>/wp-content/themes/charityhub-v1-04/javascript/jquery.js"></script>

<script>
  //  alert('ok');
	
var valid = true ;
	$(function () {
            
            
		$('#PaymentForm').submit(function(event) {
                    
                        valid = true;
			$('input').css("border","0px #fff solid");
                       
                       if($('#firstname').val() === "" || $('#firstname').val() == null){$('#firstname').css("border","1px red solid"); valid = false;}
     			if($('#state').val() === "" || $('#state').val() == null){$('#state').css("border","1px red solid"); valid = false;}
                  
			if($('#lastname').val() === "" || $('#lastname').val() == null){$('#lastname').css("border","1px red solid"); valid = false;}
                       if($('#address').val() === "" || $('#address').val() == null){$('#address').css("border","1px red solid"); valid = false;}
                       if($('#city').val() === "" || $('#city').val() == null){$('#city').css("border","1px red solid"); valid = false;}
                       if($('#postalcode').val() === "" || $('#postalcode').val() == null){$('#postalcode').css("border","1px red solid"); valid = false;}
                       if($('#phone').val() === "" || $('#phone').val() == null){$('#phone').css("border","1px red solid"); valid = false;}
                       if($('#email').val() === "" || $('#email').val() == null){$('#email').css("border","1px red solid"); valid = false;}
                       if($('#amount').val() === "" || $('#amount').val() == null || $('#amount').val() <= 0){$('#amount').css("border","1px red solid"); valid = false;}
                      //  alert('OKAY');
                      
                      if(!valid){alert('Required* fields are needed to submit charitable receipts - please ensure they are complete')}
                      
                        return valid;
        	// stop the form from submitting the normal way and refreshing the page
	        event.preventDefault();	      
		});		
	});
</script>

<?php
if (!isset($_GET['id']) ) {
	?>
	<div class="shift-up-1">
		<h1 class="shift-up-1">Oops! Looks like you got to this page in a weird way. Check the link again or email it@studentsofferingsupport.ca if there is a problem.</h1>
	</div>
	<?php
}
else {
//        $userQuery = mysql_query("SELECT * FROM lm_user_profiles WHERE user_id = '" . $_GET['user_id'] . "'") or die(mysql_error());
//	$user = mysql_fetch_array($userQuery);
//        
//        $tripQuery = mysql_query("SELECT * FROM VolunteerTrip WHERE TripID = '" . $_GET['trip_id'] . "'") or die(mysql_error());
//	$trip = mysql_fetch_array($tripQuery);
        
	$fundraiserQuery = mysql_query("SELECT * FROM fundraiser_profiles WHERE unique_id = '" . $_GET['id'] . "'") or die(mysql_error());

	$donations = array();
	$totalDonationAmount = 0;
        $donationGoal = 0;
        $donationCollected = 0;
        if($row = mysql_fetch_array($fundraiserQuery)) {
            
            $donationGoal = intval($row['DonationGoal']);
            $donationCollected = intval($row['donation_collection']);
            $header_image = $row['header_image'] ;
            $subheader_image = $row['subheader_image'] ;
            $top_VideoEmbedhtml = $row['Top_VideoEmbedhtml'] ;
            $body_Header = $row['Body_Header'] ;
            $body_Text = $row['Body_Text'] ;
            $body_Image = $row['Body_Image'] ;
            $body_AboutUsText = $row['Body_AboutUsText'] ;
            $social_FacebookMsg = $row['Social_FacebookMsg'] ;
            $social_Tweet = $row['Social_Tweet'] ;
            $thankYou_Email = $row['ThankYou_Email'] ;
            $title = $row['Title'] ;
            
        }

	$donationGoalPercentage = (($donationCollected * 100)/$donationGoal) ;
         


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
	
			<!-- banner-donate -->
			<div id="banner-donate" class="text-center">
				<div class="container banner-txt">
					<h1 class="banner-header txt-drop-shadow"><?php echo $header_image ; ?></h1>
		
					<p class="txt-drop-shadow"><?php echo $subheader_image ; ?></p>
		
				</div>
			</div>
			<!-- end banner-donate -->
			
			<!-- goal -->
			<div id="goal" class="page">
				<div class="container gdlr-navigation-container fundraiser-box">
					<div class="row">
						<div class="col-lg-12 form-box">	

							<div class="col-lg-12 p-t-30 p-b-50 text-center">         
								<h1 class="p-b-30 darkblue"><strong>EVERY DONATION HELPS!</strong></h1>
								         
								<p>Thank you for your support. As a charitable organization (ID - 81495 0416 RR0001) we are able to issue charitable receipts for any donation $20 or more. Please make sure you fill in this form fully to ensure your receipt is processed properly. After this form, you will be taken to the payment page. </p>
							</div>

                            <form id="PaymentForm" action="http://sosvolunteertrips.org/payments.php" method="post" class=""> 
		
                                <input type="hidden" name="id" value="<?php echo $_GET['id'] ;?>"/>
                                <input type="hidden" name="brandname" value="<?php echo  $subheader_image ; ?>"/>
                                <div class="col-lg-12">
                                    <div class="donate-field-group">
										<div class="donation-amount-txt"><p>Enter Your Donation Amount*</p></div>
										<div class="dollar-icon"></div>
                                        <input value="75" id="amount" type="number" name="donation_amount" class="donation-amount-field">
									</div>
								</div>
                                                        
                                <div class="col-lg-6"> <!-- Left Form Column -->
									<div class="donate-field-group">
										<p>First Name*</p>
										<input id="firstname" type="text" name="first_name">
									</div>
                                                                    
                                                                    <div class="donate-field-group">
										<p>Last Name*</p>
										<input id="lastname" type="text" name="last_name">
									</div>

									<div class="donate-field-group">
										<p>Address*</p>
										<input id="address" type="text" name="address">
									</div>

									<div class="donate-field-group">
										<p>City*</p>
										<input id="city" type="text" name="city">
									</div>
									
									<div class="donate-field-group">
										<p>Phone Number*</p>
										<input id="phone" type="tel" name="phone_number">
									</div>

									
								</div> <!-- End Left Form Column -->

								<div class="col-lg-6"> <!-- Right Form Column -->
									

									<div class="donate-field-group">
									<p>Country</p>
									<select id="country" type="text" name="cc_type">
										<option  selected="selected" value="CA">Canada</option>
										<option value="US">US</option>
									</select>
								</div>
								
								<div class="donate-field-group">
									<p>Province / State*</p>
									<select id="state" type="text" name="province_state">
										<option value="" selected="selected"> Please Choose One </option>
										<option value="Alberta">Alberta</option>
										<option value="British Columbia">British Columbia</option>
										<option value="Manitoba">Manitoba</option>
										<option value="New Brunswick">New Brunswick</option>
										<option value="Newfoundland">Newfoundland and Labrador</option>
										<option value="Nova Scotia">Nova Scotia</option>
										<option value="NT">Northwest Territories</option>
										<option value="Nunavut">Nunavut</option>
										<option value="Ontario">Ontario</option>
										<option value="Prince Edward Island">Prince Edward Island</option>
										<option value="Quebec">Quebec</option>
										<option value="Saskatchewan">Saskatchewan</option>
										<option value="YT">Yukon</option>
										<option value="" disabled=""> - States - </option>
										<option value="AL">Alabama</option>
										<option value="AK">Alaska</option>
										<option value="AR">Arizona</option>
										<option value="CA">California</option>
										<option value="CO">Colorado</option>
										<option value="CT">Connecticut</option>
										<option value="DE">Delaware</option>
										<option value="DC">District Of Columbia</option>
										<option value="FL">Florida</option>
										<option value="GA">Georgia</option>
										<option value="HI">Hawaii</option>
										<option value="ID">Idaho</option>
										<option value="IL">Illinois</option>
										<option value="IN">Indiana</option>
										<option value="IA">Iowa</option>
										<option value="KS">Kansas</option>
										<option value="KY">Kentucky</option>
										<option value="LA">Louisiana</option>
										<option value="ME">Maine</option>
										<option value="MD">Maryland</option>
										<option value="MA">Massachusetts</option>
										<option value="MI">Michigan</option>
										<option value="MN">Minnesota</option>
										<option value="MS">Mississippi</option>
										<option value="MO">Missouri</option>
										<option value="MT">Montana</option>
										<option value="NE">Nebraska</option>
										<option value="NV">Nevada</option>
										<option value="NH">New Hampshire</option>
										<option value="NJ">New Jersey</option>
										<option value="NM">New Mexico</option>
										<option value="NY">New York</option>
										<option value="NC">North Carolina</option>
										<option value="ND">North Dakota</option>
										<option value="OH">Ohio</option>
										<option value="OK">Oklahoma</option>
										<option value="OR">Oregon</option>
										<option value="PA">Pennsylvania</option>
										<option value="RI">Rhode Island</option>
										<option value="SC">South Carolina</option>
										<option value="SD">South Dakota</option>
										<option value="TN">Tennessee</option>
										<option value="TX">Texas</option>
										<option value="UT">Utah</option>
										<option value="VT">Vermont</option>
										<option value="WA">Washington</option>
										<option value="WV">West Virginia</option>
										<option value="WI">Wisconsin</option>
										<option value="WY">Wyoming</option>
									</select>
									</div>

									<div class="donate-field-group">
										<p>Postal Code*</p>
										<input id="postalcode" type="text" name="postal_code">
									</div>
									
									<div class="donate-field-group">
										<p>Email*</p>
										<input id="email" type="email" name="email">
									</div>
									
									<div class="donate-field-group">
										<p>Currency</p>
										<select id="currency" type="text" name="currency">
											<option  selected="selected" value="CAD">CAD</option>
											<option value="USD">USD</option>
										</select>
									</div>
																	
								</div> <!-- End Right Form Column -->
								<div class="col-lg-12 text-center">

									<div class="donate-field-group">
										<p><b>Connection to SOS:</b><br/><i>ie: Waterloo SOS volunteer, Outreach trip participant, Board members, Head Office Staff, Friend of SOS, etc.</i></p>
										<input id="connection" type="text" width=60 name="connection">
									</div>
									<div class="donate-field-group" style="margin: 0px;">
										<div class="check-fix">
										<input id="list-donation" type="checkbox" value="1" name="list-donation">
										</div>
										<div style="text-align:left;">I want my donation to be anonymously listed on the main fundraiser page.</div>
										
									</div>
									<div class="donate-field-group">
										<input type="submit" name="submit" value="Continue to payment page" class="continue-btn">
<p><i>You will be taken to SOS' Paypal donation payment page where you can pay either with your Paypal account (if you have one) or any major credit card</i></p>
									</div>
								</div>
							</form>
						</div>
						
					</div>
				</div>	

				<div class="form-bg">

				</div>
			</div>io
			<!-- END goal -->
		
		
		</div>
	
	<!-- End Alfonz code -->
	<?php 
         }
         
        ?>
<?php get_footer(); ?>