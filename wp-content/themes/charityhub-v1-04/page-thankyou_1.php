<?php
/*
Template Name: Thankyou Template
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
			<div id="banner-thankyou" class="page text-center">
				<div class="container banner-txt">
					<h1 class="banner-header txt-drop-shadow">Thank you!</h1>
		
					<p class="txt-drop-shadow">consectetur adipiscing elit. Pellentesque non accumsan tortor. Cras laoreet est viverra, maximus quam ac, porta diam. <br>Proin rutrum nibh quam. Ut sit amet odio vel purus convallis.</p>
		
				</div>
			</div>
			<!-- end banner-fundraiser -->
			
			<!-- goal -->
			<div id="goal" class="page">
				<div class="container gdlr-navigation-container fundraiser-box">
					<div class="row">
						<div class="col-lg-12 form-box">
							<div class="text-center">
								<h1 class="darkblue">CONNECT WITH US</h1>

								<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus vitae arcu arcu. Ut blandit venenatis dolor, fermentum vulputate enim. Aliquam eleifend dolor a ornare facilisis. Aliquam molestie sagittis nibh, ac laoreet diam ultricies ac. </p>
							</div>
							
							
							<div class="form-section">
								<?php echo do_shortcode( '[contact-form-7 id="2112" title="Thank You Form"]' ); ?>
							</div>
							
							
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