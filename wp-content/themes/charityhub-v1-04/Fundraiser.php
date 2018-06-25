<?php
//connect to db
require_once('include/portal_db_config.php');
?>
<!-- jQuery library -->
<script src="<?php echo bloginfo('url');?>/wp-content/themes/charityhub-v1-04/javascript/jquery.js"></script>

<style>
	.body-wrapper {
		background-color: #F3F9E4;
	}

	.shift-up-1 {
		margin-top: -50px;
	}
	.shift-up-2 {
		margin-top: -100px;
	}

	#page_container {
    	margin-top: -175px;
    	font-family: Arial;
    	border: 2px solid #ddd;
    	background-color: #ffffff;
    	border-radius: 1em;
    	border-top: 10px solid rgb(98, 205, 255);
    	padding: 10px;
    	min-width: 915px;
   	}

	#title_container {
		text-align: center;  
	}

	#trip_title {
		font-weight: bold;
		color: rgb(98, 205, 255);
	}

	.column_container {
		margin-left: auto;
		margin-right: auto;
		white-space: nowrap;
		
		display: flex;
	}

	.left_column {
		width: 60%;
		float: left;
		margin: 0px;
		border: 1px solid #ddd;
		flex: 1;
	}

	.right_column {
		width: 35%;
		float: right;
		margin: 0px;
		border: 1px solid #ddd;
		flex: 1;
	}

	.fundraising_progress_bar {
		font-family: arial;
		font-size: 80%;
		width: 250px;
		margin-left:auto;
		margin-right:auto;
	}

	.progress_bar_title {
		font-size: 16px; 
		overflow: visible;
	}

	.barholder {
		background-color: #ffffff;
		padding: 2px;
		border: 1px solid black;
		height: 25px;
	}

	.fill {
		height: 100%;
		margin-top: 0px;
		background-color: rgb(98, 205, 255);
	}

	.panels {
		
		margin: 5px;
		padding: 10px;
	}

	.orangeButton {
		-moz-box-shadow:inset 0px 1px 0px 0px #fce2c1;
		-webkit-box-shadow:inset 0px 1px 0px 0px #fce2c1;
		box-shadow:inset 0px 1px 0px 0px #fce2c1;
		background:-webkit-gradient(linear, left top, left bottom, color-stop(0.05, #ffc477), color-stop(1, #fb9e25));
		background:-moz-linear-gradient(top, #ffc477 5%, #fb9e25 100%);
		background:-webkit-linear-gradient(top, #ffc477 5%, #fb9e25 100%);
		background:-o-linear-gradient(top, #ffc477 5%, #fb9e25 100%);
		background:-ms-linear-gradient(top, #ffc477 5%, #fb9e25 100%);
		background:linear-gradient(to bottom, #ffc477 5%, #fb9e25 100%);
		filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#ffc477', endColorstr='#fb9e25',GradientType=0);
		background-color:#ffc477;
		-moz-border-radius:6px;
		-webkit-border-radius:6px;
		border-radius:6px;
		border:1px solid #eeb44f;
		display:inline-block;
		cursor:pointer;
		color:#ffffff;
		font-family:Arial;
		font-size:15px;
		font-weight:bold;
		padding:6px 24px;
		text-decoration:none;
		text-shadow:0px 1px 0px #cc9f52;
		width: 200px;
	}

	.orangeButton:hover {
		background:-webkit-gradient(linear, left top, left bottom, color-stop(0.05, #fb9e25), color-stop(1, #ffc477));
		background:-moz-linear-gradient(top, #fb9e25 5%, #ffc477 100%);
		background:-webkit-linear-gradient(top, #fb9e25 5%, #ffc477 100%);
		background:-o-linear-gradient(top, #fb9e25 5%, #ffc477 100%);
		background:-ms-linear-gradient(top, #fb9e25 5%, #ffc477 100%);
		background:linear-gradient(to bottom, #fb9e25 5%, #ffc477 100%);
		filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#fb9e25', endColorstr='#ffc477',GradientType=0);
		background-color:#fb9e25;
	}

	.orangeButton:active {
		position:relative;
		top:1px;
	}

	.donateNow {
		font-size: 24px;
		border-radius: 10px;
		margin-left: 8px;
		float: left;
	}

	#fundraising_image {
		background-color: rgb(98, 205, 255);
		margin: 5px;
		padding: 10px;
	}

	#profile_picture {
		width: 64px;
		height: 64px;
	}

	#profile {
		border: none;
	}

	#social {
		border: none;
	}

	#volunteer_name {
		text-align: center;
		border-radius: 1em;
	}

	#picture_column {
		border-radius: 1em;
	}

	.description {
		white-space: normal;
		text-align: justify;
	}

	.donations_number {
		background-color: #F3F9E4;
		font-family:Arial;
		font-size: 20px;
		font-weight:bold;
		height: 35px;
		border-top-left-radius: 1em;
		border-top-right-radius: 1em;
		border: 1px solid #ddd;
	}

	.donation {
		border: 1px solid #ddd;
		border-top: none;
		white-space: normal;
		text-align: left;
		padding: 10px;
		line-height: 20px;
	}

	.donation_amount {
		font-size: 40px;
		color: rgb(98, 205, 255);
	}

	.donation_entry {
		padding: 10px;
	}

	#donations_panel {
		padding-top: 0;
	}

	.remove_border {
		border: none;
	}

	#popupContainer {
		width:100%;
		height:100%;
		opacity:.95;
		top:0;
		left:0;
		display:none;
		position:fixed;
		background-color:#313131;
		overflow:auto;
	}
	img#close {
		position:absolute;
		right:-14px;
		top:-14px;
		cursor:pointer;
	}
	div#popupContact {
		position:absolute;
		left:50%;
		top:17%;
		margin-left:-202px;
	}
	form {
		max-width:300px;
		min-width:250px;
		padding:10px 50px;
		border:2px solid gray;
		border-radius:10px;
		background-color:#fff;
	}
	h2 {
		background-color:#f3f3f3;
		color: rgb(98, 205, 255);
		padding:20px 35px;
		margin:-10px -50px;
		text-align:center;
		border-radius:10px 10px 0 0;
	}
	hr {
		margin:10px -50px;
		border:0;
		border-top:1px solid #ccc;
	}
	input[type=text] {
		width:82%;
		padding:10px;
		margin-top:30px;
		border:1px solid #ccc;
		padding-left:45px;
		font-size:16px;
	}
	#name {
		background-image:url("<?php echo bloginfo('url');?>/wp-content/themes/charityhub-v1-04/images/icons/contact-name.png");
		background-size: 32px 32px;
		background-repeat:no-repeat;
		background-position:5px 7px;
	}
	#email {
		background-image:url("<?php echo bloginfo('url');?>/wp-content/themes/charityhub-v1-04/images/icons/contact-email.png");
		background-size: 32px 32px;
		background-repeat:no-repeat;
		background-position:5px 7px;
	}
	textarea {
		background-image:url("<?php echo bloginfo('url');?>/wp-content/themes/charityhub-v1-04/images/icons/contact-message.png");
		background-size: 32px 32px;
		background-repeat:no-repeat;
		background-position:5px 7px;
		width:82%;
		height:95px;
		padding:10px;
		resize:none;
		margin-top:30px;
		border:1px solid #ccc;
		padding-left:40px;
		font-size:16px;
		margin-bottom:30px;
	}
	#submit {
		text-decoration:none;
		width:100%;
		text-align:center;
		display:block;
		background-color:rgb(98, 205, 255);
		color:#fff;
		border:1px solid rgb(98, 205, 255);
		padding:10px 0;
		font-size:20px;
		cursor:pointer;
		border-radius:5px;
	}

	#EmailSuccess {
		color: green;
		border: 1px solid green;
		padding: 15px;
		margin: 15px;
		font-weight: bold;
	}

	#EmailFailure {
		color: red;
		border: 1px solid red;
		padding: 15px;
		margin: 15px;
		font-weight: bold;
	}
</style>

<script>
	// Validating Empty Email Field
	function check_empty() {
		if (document.getElementById('name').value == "" || document.getElementById('email').value == "" || document.getElementById('msg').value == "") {
			alert("Fill All Fields !");
			return false;
		} else {
			//alert("Form validated...");
			return true;
		}
	}
	//Function To Display Popup
	function div_show() {
		//document.getElementById('popupContainer').style.display = "block";
		$('#popupContainer').fadeIn();
		$("#LoadingImageContainer").hide();
		$("#ContactForm").show();
	}
	//Function to Hide Popup
	function div_hide(){
		//document.getElementById('popupContainer').style.display = "none";
		$('#popupContainer').fadeOut();
	}

	$(function () {
		$('#ContactForm').submit(function(event) {
			if (check_empty()) {
				$("#LoadingImageContainer").show();
				$("#LoadingImage").show();
				$("#ContactForm").hide();

		        var formData = {
		            'name'              : $('input[name=name]').val(),
		            'email'             : $('input[name=email]').val(),
		            'message'    		: $('textarea#msg').val(),
		            'ContactEmail'		: $('input[name=ContactEmail]').val()
		        };

		        var formURL = '<?php echo bloginfo("url");?>' + '/wp-content/themes/charityhub-v1-04/SendContactEmail.php';
				$.ajax({
					type: 'POST',
					url: formURL,
					data: formData,
					dataType: 'json',
					encode: true,
					error: function (jqXHR, textStatus, errorThrown) {
			            alert(errorThrown);
			        },
					success: function (sentConfirmation) {
						if(sentConfirmation == "Email sent succesfully.") {
							$("#LoadingImage").hide();
							$("#EmailSuccess").show();
						}
						else {
							$("#LoadingImage").hide();
							$("#EmailFailure").show();
						}
					}
				});  
        	}

        	// stop the form from submitting the normal way and refreshing the page
	        event.preventDefault();	      
		});		
	});
</script>

<?php


if (!isset($_GET['user_id']) || !isset($_GET['trip_id'])) {
	?>
	<div class="shift-up-1">
		<h1 class="shift-up-1">Error: Invalid link.  Please include your user id and trip id in the url.</h1>
	</div>
	<?php
}
else {
	// Get volunteer status of the user
	$volunteerStatusQuery = mysql_query("SELECT ActiveVolunteer FROM VolunteerTripParticipants WHERE user_id = '" . $_GET['user_id'] . "' AND TripID = '" . $_GET['trip_id'] . "'") or die(mysql_error());
	$volunteerStatus = mysql_fetch_array($volunteerStatusQuery);

	// Get information of the volunteer trip
	$tripQuery = mysql_query("SELECT * FROM VolunteerTrip WHERE TripID = '" . $_GET['trip_id'] . "'") or die(mysql_error());
	$trip = mysql_fetch_array($tripQuery);

	// Determing the pricing information for this specific user's volunteer trip
	$tripPrice = $trip['FlightCost'];
	if($volunteerStatus['ActiveVolunteer'] == 1) { $tripPrice += $trip['BasicCost']; }
	else { $tripPrice += $trip['NonVolunteerCost']; }

	//get information about the user
	$userQuery = mysql_query("SELECT * FROM lm_user_profiles WHERE user_id = '" . $_GET['user_id'] . "'") or die(mysql_error());
	$user = mysql_fetch_array($userQuery);

	//get information about the fundraiser profile
	$fundraiserQuery = mysql_query("SELECT * FROM fundraiser_profiles WHERE TripID = '" . $_GET['trip_id'] . "' 
										AND user_ID = '" . $_GET['user_id'] . "'") or die(mysql_error());
	$fundraiser = mysql_fetch_array($fundraiserQuery);

	//get information about donations
	$donationsQuery = mysql_query("SELECT * FROM DonationRevenue WHERE TripID = '" . $_GET['trip_id'] . "' 
										AND Trip_user_ID = '" . $_GET['user_id'] . "' AND FundraisingDonation = 1") or die(mysql_error());

	// Array that holds information of all the donations
	$donations = array();
	$totalDonationAmount = 0;

	if (mysql_num_rows($donationsQuery) > 0) {
		// Fetch donation information to populate array of all donations
		while($row = mysql_fetch_array($donationsQuery)) {
			$DonID = $row['DonID'];
			$DonorFirstName = $row['DonorFirstName'];
			$DonorLastName = $row['DonorLastName'];
			$DateSubmit = $row['DateSubmit'];

			// If the donation was made by paypal
			if(isset($row['MerchantRefID']) && $row['MerchantRefID'] != '') {
				// Get this donation's paypal details
				 $paypalQuery = mysql_query("SELECT * from CMSPaypalDetails WHERE MerchantRefID='" . $row['MerchantRefID'] . "'") or die(mysql_error());
				 $paypal = mysql_fetch_array($paypalQuery);

				 // Fetch the donation amount
				 $amount = $paypal['GrossAmount'];

				 // Add to the total donation amount
				 $totalDonationAmount += $amount;
			}
			// If the donation was made by cheque
			else {
				// Get this donation's cheque details
				$chequeQuery = mysql_query("SELECT * from CashTransactions WHERE DonID='" . $row['DonID'] . "'") or die(mysql_error());
				$cheque = mysql_fetch_array($chequeQuery);

				// Fetch the donation amount
				$amount = $cheque['TotalAmt'];

				// Add to the total donation amount
				 $totalDonationAmount += $amount;
			}

			// Push donation information to array of all donations
			array_push($donations, array($amount, $DonorFirstName, $DonorLastName, $DateSubmit, $DonID));
		}
	}
?>
	<div id="page_container">
		<div id="title_container" style="margin-top: -50px">
			<h1 id="trip_title"><?php echo $fundraiser['Title']; ?> </h1>
		<div>

		<div class="column_container" style="margin-top: -100px">
		    <div class="left_column remove_border">
	           	<img src="<?php echo $fundraiser['FundraiserPictureURL']; ?>" alt="fundraising image" id="fundraising_image">
	        </div>

	        <div class="right_column remove_border">
	        	<div class="panels">
		            <div class="fundraising_progress_bar">
						<div class="progress_bar_title"><b>$<?php echo $totalDonationAmount; ?></b> of $<?php echo ($fundraiser['DonationGoal'] - $tripPrice); ?></div>
						<div class="frame">
							<div class="barholder">
								<?php
									$goalPercentage = $totalDonationAmount/($fundraiser['DonationGoal'] - $tripPrice)*100;
									if($goalPercentage > 100) { $goalPercentage = 100; }
								?>
								<div class="fill" style="width: <?php echo $goalPercentage; ?>%;">&nbsp;</div>
							</div>
							<span class="start" style="float: left;">$0</span>
							<span class="goal" style="float: right;">$<?php echo ($fundraiser['DonationGoal'] - $tripPrice); ?></span>
						</div>
						<div style="clear: both;"></div>
					</div>

					<br>
					<a href="http://sosvolunteertrips.org/volunteer-trip-contribution/?user_id=<?php echo $_GET['user_id']; ?>&trip_id=<?php echo $_GET['trip_id']; ?>" class="orangeButton donateNow">Donate Now</a>
					<a href="<?php echo $fundraiser['Facebook']; ?>" class="orangeButton" style="font-size: 24px;">Share on Facebook</a>
				</div>
	        </div>

	        <div style="clear:both"></div>
		</div>
		
		<div class="column_container" style="margin-top: -50px">
		    <div class="left_column remove_border">
		    	<div class="panels">
	        		<p class="description">
	        			<?php echo $fundraiser['Description']; ?>
	        		</p>
	        	</div>
	        </div>

	        <div class="right_column remove_border">
	        	<div class="panels" id="donations_panel">
	        		<div class="donations_number">
	        			<p><?php echo count($donations); ?> Donations</p>
	        		</div>

	   				<?php
	   				// Display all the donations
	   				foreach($donations as &$donation) {
	   					?>
		        		<div class="donation">
		        			<p class="donation_entry">
		        				<span class="donation_amount">$<?php echo $donation[0]; ?></span><br>
		        				<b><?php echo $donation[1] . " " . $donation[2]; ?></b><br>
		        				<?php 
		        					// Calculate difference between current date and donation submission date
		        					$now = time();
								    $your_date = strtotime($donation[3]);
								    $datediff = $now - $your_date;
								    $daysAgo = floor($datediff/(60*60*24));
		        				?>
		        				<?php echo $daysAgo; ?> days ago<br>
		   						<br>
		        			</p>
		        		</div>
		        		<?php
	        		}
	        		?>

	        	</div>
	        </div>

	        <div style="clear:both"></div>
		</div>

		<div class="column_container" style="margin-top: -50px">
		    <div class="left_column remove_border">
		    	<div class="panels">
	        		<div id="social" class="column_container">
	        			<div class="left_column remove_border">
	        				<!-- Facebook -->
						    <a href="<?php echo $fundraiser['Facebook']; ?>" target="_blank">
						    	<img src="<?php echo bloginfo('url');?>/wp-content/themes/charityhub-v1-04/images/icons/facebook.png" alt="Facebook" />
						    </a>
	        			</div>
	        			<div class="right_column remove_border">
	        				<!-- Twitter -->
						    <a href="<?php echo $fundraiser['Twitter']; ?>" target="_blank">
						        <img src="<?php echo bloginfo('url');?>/wp-content/themes/charityhub-v1-04/images/icons/twitter.png" alt="Twitter" />
						    </a>
	        			</div>
	        			<div class="right_column remove_border">
	        				<!-- Email -->					   
					        <img src="<?php echo bloginfo('url');?>/wp-content/themes/charityhub-v1-04/images/icons/email.png" alt="Email" style="cursor:pointer" onclick="div_show()" />
						    
						    <!-- Popup Div Starts Here -->
						    <div id="popupContainer">
								<div id="popupContact">
									<!-- Contact Us Form -->
									<form id="ContactForm" name="ContactForm">
										<img id="close" src="<?php echo bloginfo('url');?>/wp-content/themes/charityhub-v1-04/images/icons/contact-closebutton.png" onclick ="div_hide()">
										<h2><b>Contact Me</b></h2>
										<hr>
										<input type="hidden" name="ContactEmail" value="<?php echo $fundraiser['Email']; ?>">
										<input id="name" name="name" placeholder="Name" type="text"><br>
										<input id="email" name="email" placeholder="Email" type="text"><br>
										<textarea id="msg" name="message" placeholder="Message"></textarea><br>
										<input type="submit" id="submit" value="Send">
									</form>

									<!-- Ajax Loader Gif -->
									<div id="LoadingImageContainer" style="display: none">
										<form>
											<img id="close" src="<?php echo bloginfo('url');?>/wp-content/themes/charityhub-v1-04/images/icons/contact-closebutton.png" onclick ="div_hide()">
											<img id="LoadingImage" style="display:none" src="<?php echo bloginfo('url');?>/wp-content/themes/charityhub-v1-04/images/icons/ajax-loader.gif" />
											<div id="EmailSuccess" style="display:none">Email sent succesfully!</div>
											<div id="EmailFailure" style="display:none">Email failed to send.</div>
										</form>
									</div>
								</div>
							</div>
							<!-- Popup Div Ends Here -->
	        			</div>
	        		</div>
	        	</div>
	        </div>

	        <div class="right_column remove_border">
	        	<div class="panels">
	        		<div id="profile" class="column_container">
	        			<div class="left_column" id="picture_column">
	        				<div class="panels">
	        					<img src="<?php echo $fundraiser['ProfilePictureURL']; ?>" alt="profile picture" id="profile_picture">
	        				</div>
	        			</div>
	        			<div class="right_column" id="volunteer_name">
	        				<div class="panels">
		        				Created <?php echo date('M d, Y', strtotime($fundraiser['CreateDate'])); ?><br>
		        				<b><?php echo $user['FirstName'] . " " . $user['LastName']; ?></b>
	        				</div>
	        			</div>
	        		</div>
	        	</div>
	        </div>

	        <div style="clear:both"></div>
		</div>

		
	</div>
<?php
}
?>