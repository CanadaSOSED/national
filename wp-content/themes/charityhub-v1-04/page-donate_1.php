<?php
/*
Template Name: Donate Template
*/
get_header();
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
			<div id="banner-donate" class="page text-center">
				<div class="container banner-txt">
					<h1 class="banner-header txt-drop-shadow">Lorem Ipsum Dolor</h1>
		
					<p class="txt-drop-shadow">consectetur adipiscing elit. Pellentesque non accumsan tortor. Cras laoreet est viverra, maximus quam ac, porta diam. <br>Proin rutrum nibh quam. Ut sit amet odio vel purus convallis.</p>
		
				</div>
			</div>
			<!-- end banner-donate -->
			
			<!-- goal -->
			<div id="goal" class="page">
				<div class="container gdlr-navigation-container fundraiser-box">
					<div class="row">
						<div class="col-lg-12 form-box">
							<div class="container text-center divider-bottom">
								<h1 class="darkblue">OUR GOAL</h1>

								<div class="progress-bar-group"> <!-- Progress bar start -->
									<div class="progress-bar-outline">
										<div class="progress-bar-fill">
											<div class="progress-bar-number">
												$1500
											</div>
										</div>
									</div>
									<span class="start-point">$0</span>
									<span class="end-point">$2500</span>
								</div> <!-- Progress bar end -->

								<div class="social-sharing">
									<p>Don’t forget to share the love</p>
								<?php echo do_shortcode( '[addtoany]' ); ?> <!-- Sharing Plugin -->
								</div>
							</div>	

							<div class="col-lg-12 p-t-100 text-center">         
								<h2 class="p-b-30"><strong>Volunteer Trip Contribution Form</strong></h2>
								         
								<p>Please fill out the form below accurately to ensure that your payment is processed correctly <br>and that the donor information is correct, so tax receipts can be generated properly!</p>
								         
								<p><strong>Participant Name:</strong></p>
								<p><strong>Trip To:</strong></p>
							</div>

							<div class="col-lg-12 p-t-50 p-b-100 text-center">         
								<h2 class="p-b-30"><strong>Donor Information for Tax Purposes</strong></h2>
								         
								<p>For this payment you (or the donor) is eligible for a tax receipt. <br>Please fill out the form below if you (or the donor) wish to get a tax receipt:</p>
							</div>
							<form class=""> 
								<div class="col-lg-6"> <!-- Left Form Column -->
									<div class="donate-field-group">
										<p>First Name</p>
										<input type="text" name="first_name">
									</div>

									<div class="donate-field-group">
										<p>Credit Card Number</p>
										<input type="text" name="cc_number">
									</div>

									<div class="donate-field-group">
										<p>Expiry Month</p>
										<select type="text" name="cc_expire_month">
											<option value="1">January</option>
											<option value="2">February</option>
											<option value="3">March</option>
											<option value="4">April</option>
											<option value="5">May</option>
											<option value="6">June</option>
											<option value="7">July</option>
											<option value="8">August</option>
											<option value="9">September</option>
											<option value="10">October</option>
											<option value="11">November</option>
											<option value="12">December</option>
										</select>
									</div>

									<div class="donate-field-group">
										<p>Card Type</p>
										<select type="text" name="cc_type">
											<option value="mastercard">MasterCard</option>
											<option value="visa">Visa</option>
										</select>
									</div>

									<div class="donate-field-group">
										<p>Address</p>
										<input type="text" name="address">
									</div>

									<div class="donate-field-group">
										<p>City</p>
										<input type="text" name="city">
									</div>
									
									<div class="donate-field-group">
										<p>Phone Number</p>
										<input type="tel" name="phone_number">
									</div>

									<div class="donate-field-group">
										<p>Currency</p>
										<select type="text" name="currency">
											<option value="cad">CAD</option>
											<option value="usd">USD</option>
										</select>
									</div>
									
								</div> <!-- End Left Form Column -->

								<div class="col-lg-6"> <!-- Right Form Column -->
									<div class="donate-field-group">
										<p>Last Name</p>
										<input type="text" name="last_name">
									</div>

									<div class="donate-field-group">
										<p>CVV /CSC</p>
										<input type="text" name="ccv_number">
									</div>

									<div class="donate-field-group">
										<p>Expiry Year</p>
										<select type="text" name="cc_expire_year">
											<?php 
												$startYear = (int)date('Y');
												$endYear = $startYear + 20;
												for($i=$startYear;$i<=$endYear;$i++)
												{
												    echo '<option value='.$i.'>'.$i.'</option>';
												}
											?>
										</select>
									</div>

									<div class="donate-field-group">
									<p>Country</p>
									<select type="text" name="cc_type">
										<option value="canada">Canada</option>
										<option value="us">US</option>
									</select>
								</div>
								
								<div class="donate-field-group">
									<p>Province / State</p>
									<select type="text" name="province_state">
										<option value="" disabled=""> Please Choose One </option>
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
										<p>Postal Code</p>
										<input type="text" name="postal_code">
									</div>
									
									<div class="donate-field-group">
										<p>Email</p>
										<input type="email" name="email">
									</div>
									
									<div class="donate-field-group">
										<p>Enter Your Donation Amount</p>
										<div class="dollar-icon"></div>
										<input type="number" name="donation_amount">
									</div>
								</div> <!-- End Right Form Column -->
								<div class="col-lg-12 text-center">
									<div class="donate-field-group">
										<input type="submit" name="submit" value="Continue to payment page" class="continue-btn">
									</div>
								</div>
							</form>
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