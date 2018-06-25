<?php
/*
Template Name: Fundraiser Template
*/
get_header();
?>
<?php
//connect to db
require_once('include/portal_db_config.php');

?>
<?php
if (!isset($_GET['id']) ) {
	?>
	<div class="shift-up-1">
		<h1 class="shift-up-1">Error: Invalid link! Check the link that you were sent and try again. If the problem contines, email info@studentsofferingsupport.ca.</h1>
	</div>
	<?php
}
else {
    
    
	// Get volunteer status of the user
//	$volunteerStatusQuery = mysql_query("SELECT ActiveVolunteer FROM VolunteerTripParticipants WHERE user_id = '" . $_GET['user_id'] . "' AND TripID = '" . $_GET['trip_id'] . "'") or die(mysql_error());
//	$volunteerStatus = mysql_fetch_array($volunteerStatusQuery);
//
//	// Get information of the volunteer trip
//	$tripQuery = mysql_query("SELECT * FROM VolunteerTrip WHERE TripID = '" . $_GET['trip_id'] . "'") or die(mysql_error());
//	$trip = mysql_fetch_array($tripQuery);
//
//	// Determing the pricing information for this specific user's volunteer trip
//	$tripPrice = $trip['FlightCost'];
//	if($volunteerStatus['ActiveVolunteer'] == 1) { $tripPrice += $trip['BasicCost']; }
//	else { $tripPrice += $trip['NonVolunteerCost']; }
//
//	//get information about the user
//	$userQuery = mysql_query("SELECT * FROM lm_user_profiles WHERE user_id = '" . $_GET['user_id'] . "'") or die(mysql_error());
//	$user = mysql_fetch_array($userQuery);

	//get information about the fundraiser profile
	$fundraiserQuery = mysql_query("SELECT * FROM fundraiser_profiles WHERE unique_id = '" . $_GET['id'] . "'") or die(mysql_error());
//	$fundraiser = mysql_fetch_array($fundraiserQuery);
//
//	//get information about donations
//	$donationsQuery = mysql_query("SELECT * FROM DonationRevenue WHERE TripID = '" . $_GET['trip_id'] . "' 
//										AND Trip_user_ID = '" . $_GET['user_id'] . "' AND FundraisingDonation = 1") or die(mysql_error());

	
        // Array that holds information of all the donations
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
            if($body_Image == null || $body_Image == ""){
            
                $body_Image = "/images/fundraiser/about-photo.jpg" ;
            
            }
        }
		
	$donationGoalPercentage = (($donationCollected * 100)/$donationGoal) ;
         if ($donationGoalPercentage < 10)
	{
		$donationGoalPercentage = 10;
	}


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
			<div id="banner-fundraiser" class="page text-center">
				<div class="container banner-txt">
					<h1 class="banner-header txt-drop-shadow"><?php echo $header_image ; ?></h1>
		
					<p class="txt-drop-shadow"><?php echo $subheader_image ; ?></p>
		
				</div>
			</div>
			<!-- end banner-fundraiser -->
			
		
			<!-- WHERE WE WORK -->
			<div id="main-content-section" class="page">
				<div class="container">
					<div class="row">
						<div class="col-lg-7 main-content-col">
							<h1 class="darkblue p-b-50"><?php echo $body_Header ; ?></h1>

							<?php echo $body_Text ; ?>

						</div>

						<div class="col-lg-5 donation-sidebar desktop-sidebar">
							<h2 class="darkblue"><strong>OUR GOAL</strong></h2>

							<div class="progress-bar-group"> 
								<div class="progress-bar-outline">
	                                <div style="width:<?php echo $donationGoalPercentage ;?>%;" class="progress-bar-fill">
										<div class="progress-bar-number">
											$<?php echo $donationCollected ;?>
										</div>
									</div>
								</div>
								<span class="start-point">$0</span>
								<span class="end-point">$<?php echo $donationGoal ;?></span>
							</div>

							<h2 class="darkblue"><strong>RECENT DONATIONS</strong></h2>
							<p>Scroll to read more</p>
							<div class="donation-scroll">
							
							<?php 
							
							$donationsQuery = mysql_query("SELECT * FROM CMSPaypalDetails, fundraiser_donors  WHERE fundraiser_donors.transaction_id = CMSPaypalDetails.MerchantRefID AND fundraiser_donors.trip_id = '" .$_GET['id']. "' ORDER BY create_date DESC") or die(mysql_error());

							while($row = mysql_fetch_array($donationsQuery)) 
							{
           						
							if ($row['Anonomous'] == 1)
							{
							$row['donor_firstname'] = 'Anonymous';
							$row['donor_lastname'] = 'Donor';
							}

           						echo '<!-- Donor Info Box -->
								<div class="donor-info-box">
									<div class="donor-info-top">
										<div class="donation-amount">'.intval($row['GrossAmount']).'</div>								

										<div class="donor-name">'.$row['donor_firstname'].' '.$row['donor_lastname'].'
											<p class="donor-position">'.$row['ConnectiontoSOS'].'</p>
										</div>
									</div>
								</div>
								<!-- End Donor Info Box -->';
							}				
													
							?>
								
							</div>
							
						</div>
					</div>

				</div>
				
			</div>
			<!-- END WHERE WE WORK -->
		
			<!-- TRIPS -->
			<div id="donate-cta-banner" class="page text-center swap-donate">
				<div class="container">
					<div class="row ">
						<!-- left -->
						<div class="left col-lg-12">
							<h1 class="white txt-drop-shadow">Want to give your support? <br>click below to donate</h1>
							<div>
								<a href="/donate?id=<?php echo $_GET['id'] ;?>" class="donate-btn">Donate Today</a>
							</div>
						</div>
						<!-- right -->
						
					</div>
				</div>
			</div>
			<!-- END TRIPS -->

			<div class="container">
				<div class="row">
					<div class="col-lg-12 donation-sidebar mobile-sidebar">
							<h2 class="darkblue"><strong>OUR GOAL</strong></h2>

							<div class="progress-bar-group hide-sidebar"> 
								<div class="progress-bar-outline">
	                                <div style="width:<?php echo $donationGoalPercentage ;?>%;" class="progress-bar-fill">
										<div class="progress-bar-number">
											$<?php echo $donationCollected ;?>
										</div>
									</div>
								</div>
								<span class="start-point">$0</span>
								<span class="end-point">$<?php echo $donationGoal ;?></span>
							</div>

<h2 class="darkblue"><strong>RECENT DONATIONS</strong></h2>
							<p>Scroll to read more</p>
							<div class="donation-scroll">
							
							<?php 
							
							$donationsQuery = mysql_query("SELECT * FROM CMSPaypalDetails, fundraiser_donors  WHERE fundraiser_donors.transaction_id = CMSPaypalDetails.MerchantRefID AND fundraiser_donors.trip_id = '" .$_GET['id']. "' ORDER BY create_date DESC ") or die(mysql_error());

							while($row = mysql_fetch_array($donationsQuery)) 
							{
           						
							if ($row['Anonomous'] == 1)
							{
							$row['donor_firstname'] = 'Anonymous';
							$row['donor_lastname'] = 'Donor';
							}

           						echo '<!-- Donor Info Box -->
								<div class="donor-info-box">
									<div class="donor-info-top">
										<div class="donation-amount">'.intval($row['GrossAmount']).'</div>								

										<div class="donor-name">'.$row['donor_firstname'].' '.$row['donor_lastname'].'
											<p class="donor-position">'.$row['ConnectiontoSOS'].'</p>
										</div>
									</div>
								</div>
								<!-- End Donor Info Box -->';
							}				
													
							?>
								
							</div>							
					

						</div>
				</div>
			</div>
		
		</div>
	
	<!-- End Alfonz code -->
        
        
<?php 
         }
         
        ?>
        
        
<?php get_footer(); ?>