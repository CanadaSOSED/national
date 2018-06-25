<?php
/*
Template Name: Fundraiser Template
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
	
			<!-- banner-fundraiser -->
			<div id="banner-fundraiser" class="page text-center">
				<div class="container banner-txt">
					<h1 class="banner-header txt-drop-shadow">Lorem ipsum dolor <br>sit amet</h1>
		
					<p class="txt-drop-shadow">consectetur adipiscing elit. Pellentesque non accumsan tortor. Cras laoreet est viverra, maximus quam ac, porta diam. <br>Proin rutrum nibh quam. Ut sit amet odio vel purus convallis.</p>
		
				</div>
			</div>
			<!-- end banner-fundraiser -->
			
			<!-- goal -->
			<div id="goal" class="page text-center">
				<div class="container gdlr-navigation-container fundraiser-box">
					<div class="row">
						<div class="col-lg-6">
							<div class="videoWrapper">
							    <!-- Copy & Pasted from YouTube -->
							    <iframe width="560" height="315" src="https://www.youtube.com/embed/0kL6EHOsU_A" frameborder="0" allowfullscreen></iframe>
							</div>
							
						</div>

						<div class="col-lg-6">
							<div class="fundraiser-box-right">
								A big thanks goes out to our generous donors who’ve helped us get this far. Can we count on your help as well?
								<div>
									<a href="#" class="donate-btn">Donate Today</a>
								</div>
							</div>
						</div>
						
					</div>
				</div>	

				<div class="goal-txt">
					<div class="container text-center title-fix">
						<h1 class="darkblue">OUR GOAL</h1>

						<div class="progress-bar-group"> 
							<div class="progress-bar-outline">
								<div class="progress-bar-fill">
									<div class="progress-bar-number">
										$1500
									</div>
								</div>
							</div>
							<span class="start-point">$0</span>
							<span class="end-point">$2500</span>
						</div>

						<div class="social-sharing">
						<p>Don’t forget to share the love</p>
							<?php echo do_shortcode( '[addtoany]' ); ?>
							
						</div>
					</div>	
				</div>
			</div>
			<!-- END goal -->
		
			<!-- WHERE WE WORK -->
			<div id="main-content-section" class="page">
				<div class="container">
					<div class="row">
						<div class="col-lg-7 main-content-col">
							<h1 class="darkblue p-b-50">LOREM IPSUM DOLOR</h1>

							<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus vitae arcu arcu. Ut blandit venenatis dolor, fermentum vulputate enim. Aliquam eleifend dolor a ornare facilisis. Aliquam molestie sagittis nibh, ac laoreet diam ultricies ac. Duis elementum sagittis diam, vitae aliquet ex hendrerit at. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Nunc elementum nisi ut neque feugiat, at consectetur nibh commodo.</p>
							<p>
								Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Ut eu lacus porttitor nisl rutrum auctor. Nulla a elit varius quam consectetur dictum. Maecenas posuere velit tellus, nec sollicitudin mi sodales id. In eget porttitor mauris, ut eleifend ante. Sed sagittis dolor vel tortor consectetur tincidunt. Donec dapibus ipsum vehicula, placerat leo quis, fermentum elit. Fusce sem nisi, dictum ut lectus tincidunt, faucibus euismod quam.
							</p>

							<p>
								Aliquam interdum urna ut est bibendum, ac facilisis velit ultrices. Praesent convallis pulvinar est ac maximus. Suspendisse dui nibh, auctor in auctor eu, aliquam nec justo. Cras libero urna, molestie ac mattis eget, fringilla non tellus. Duis iaculis non velit in cursus. Nunc bibendum nunc volutpat condimentum suscipit. Mauris in lacinia est.
							</p>

							<img src="<?php bloginfo('template_url'); ?>/images/fundraiser/about-photo.jpg" class="about-img">

							<h1 class="darkblue p-b-50">ABOUT US</h1>

							<p>
								Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Ut eu lacus porttitor nisl rutrum auctor. Nulla a elit varius quam consectetur dictum. Maecenas posuere velit tellus, nec sollicitudin mi sodales id. In eget porttitor mauris, ut eleifend ante. Sed sagittis dolor vel tortor consectetur tincidunt. Donec dapibus ipsum vehicula, placerat leo quis, fermentum elit. Fusce sem nisi, dictum ut lectus tincidunt, faucibus euismod quam.
							</p>

							<p>
								Aliquam interdum urna ut est bibendum, ac facilisis velit ultrices. Praesent convallis pulvinar est ac maximus. Suspendisse dui nibh, auctor in auctor eu, aliquam nec justo. Cras libero urna, molestie ac mattis eget, fringilla non tellus. Duis iaculis non velit in cursus. Nunc bibendum nunc volutpat condimentum suscipit. Mauris in lacinia est.
							</p>
						</div>

						<div class="col-lg-5 donation-sidebar">
							<h2 class="darkblue">RECENT DONATIONS</h2>

							<!-- Donor Info Box -->
							<div class="donor-info-box">
								<div class="donor-info-top">
									<div class="donation-amount">$50</div>
									<div class="donor-name">
										Samwise Gamgee 
										<p class="donor-position">Volunteer</p>
									</div>
								</div>
								<div class="donor-comment">
									Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus vitae arcu arcu. Ut blandit venenatis dolor, fermentum vulputate enim. Aliquam eleifend.
									<a href="#">Read More...</a>
								</div>
							</div>
							<!-- End Donor Info Box -->

							<!-- Donor Info Box -->
							<div class="donor-info-box">
								<div class="donor-info-top">
									<div class="donation-amount">$100</div>
									<div class="donor-name">
										Peregrin Took 
										<p class="donor-position">Volunteer</p>
									</div>
								</div>
								<div class="donor-comment">
									Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus vitae arcu arcu. Ut blandit venenatis dolor, fermentum vulputate enim. Aliquam eleifend.
									<a href="#">Read More...</a>
								</div>
							</div>
							<!-- End Donor Info Box -->

							<!-- Donor Info Box -->
							<div class="donor-info-box">
								<div class="donor-info-top">
									<div class="donation-amount">$1000</div>
									<div class="donor-name">
										Meriadoc Brandybuck 
										<p class="donor-position">Volunteer</p>
									</div>
								</div>
								<div class="donor-comment">
									Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus vitae arcu arcu. Ut blandit venenatis dolor, fermentum vulputate enim. Aliquam eleifend.
									<a href="#">Read More...</a>
								</div>
							</div>
							<!-- End Donor Info Box -->

							<!-- Donor Info Box -->
							<div class="donor-info-box">
								<div class="donor-info-top">
									<div class="donation-amount">$10</div>
									<div class="donor-name">
										Frodo Baggins 
										<p class="donor-position">Volunteer</p>
									</div>
								</div>
								<div class="donor-comment">
									Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus vitae arcu arcu. Ut blandit venenatis dolor, fermentum vulputate enim. Aliquam eleifend.
									<a href="#">Read More...</a>
								</div>
							</div>
							<!-- End Donor Info Box -->

							<!-- Donor Info Box -->
							<div class="donor-info-box">
								<div class="donor-info-top">
									<div class="donation-amount">$15</div>
									<div class="donor-name">
										Rosie Cotton 
										<p class="donor-position">Volunteer</p>
									</div>
								</div>
								<div class="donor-comment">
									Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus vitae arcu arcu. Ut blandit venenatis dolor, fermentum vulputate enim. Aliquam eleifend.
									<a href="#">Read More...</a>
								</div>
							</div>
							<!-- End Donor Info Box -->

							<a href="#">
								<div class="more-donations-btn">See More Donations</div>
							</a>

						</div>
					</div>

				</div>
				
			</div>
			<!-- END WHERE WE WORK -->
		
			<!-- TRIPS -->
			<div id="donate-cta-banner" class="page text-center">
				<div class="container">
					<div class="row">
						<!-- left -->
						<div class="left col-lg-12">
							<h1 class="white txt-drop-shadow">Want to give your support? <br>click below to donate</h1>
							<div>
								<a href="#" class="donate-btn">Donate Today</a>
							</div>
						</div>
						<!-- right -->
						
					</div>
				</div>
			</div>
			<!-- END TRIPS -->
		
		</div>
	
	<!-- End Alfonz code -->
	
<?php get_footer(); ?>