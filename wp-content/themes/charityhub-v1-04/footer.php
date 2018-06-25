	<?php global $theme_option; ?>
	<div class="clear" ></div>
	</div><!-- content wrapper -->

	<?php 
		// page style
		global $gdlr_post_option;
		if( empty($gdlr_post_option) || empty($gdlr_post_option['page-style']) ||
			  $gdlr_post_option['page-style'] == 'normal' || 
			  $gdlr_post_option['page-style'] == 'no-header'){ 
	?>	
	<footer class="footer-wrapper" >
		<?php if( $theme_option['show-footer'] != 'disable' ){ ?>
		<div class="footer-container container">
			<?php 	
				$i = 1;
				$theme_option['footer-layout'] = empty($theme_option['footer-layout'])? '1': $theme_option['footer-layout'];
				$gdlr_footer_layout = array(
					'1'=>array('twelve columns'),
					'2'=>array('three columns', 'three columns', 'three columns', 'three columns'),
					'3'=>array('three columns', 'three columns', 'six columns',),
					'4'=>array('four columns', 'four columns', 'four columns'),
					'5'=>array('four columns', 'four columns', 'eight columns'),
					'6'=>array('eight columns', 'four columns', 'four columns'),
				);
			?>
			<?php foreach( $gdlr_footer_layout[$theme_option['footer-layout']] as $footer_class ){ ?>
				<div class="footer-column <?php echo $footer_class; ?>" id="footer-widget-<?php echo $i; ?>" >
					<?php dynamic_sidebar('Footer ' . $i); ?>
				</div>
			<?php $i++; ?>
			<?php } ?>
			<div class="clear"></div>
		</div>
		<?php } ?>
		
		<?php if( $theme_option['show-copyright'] != 'disable' ){ ?>
		<div class="copyright-wrapper">
			<div class="copyright-container container">
				<div class="copyright-left">
					<?php echo $theme_option['copyright-left-text']; ?>
				</div>
				<div class="copyright-right">
					<?php echo $theme_option['copyright-right-text']; ?>
				</div>
				<div class="clear"></div>
			</div>
		</div>
		<?php } ?>
	</footer>
	<?php } // page style ?>
</div> <!-- body-wrapper -->
<script language="JavaScript" type="text/javascript">

function changeTab(tab_id){
    jQuery(".tabs2 .tab[id^=tab_menu]").removeClass("selected");
	document.getElementById("tab_menu_"+tab_id).className="tab selected";
	jQuery(".curvedContainer2 .tabcontent2").css("display","none");
	jQuery(".curvedContainer2 #tab_content_"+tab_id).css("display","block");
}

jQuery(document).ready(function() { 
// js to add a "selected" class to a clicked tab. This will change the div to "block" to show the div, and
// change the unselected tabs to "none" to hide them.
jQuery(".curvedContainer2 #tab_content_5").css("display","block");
    jQuery(".tabs2 .tab[id^=tab_menu]").click(function() { 
        var curMenu=jQuery(this);
        jQuery(".tabs2 .tab[id^=tab_menu]").removeClass("selected");
        curMenu.addClass("selected");

        var index=curMenu.attr("id").split("tab_menu_")[1];

        jQuery(".curvedContainer2 .tabcontent2").css("display","none");
		
		jQuery(".curvedContainer2 #tab_content_"+index).css("display","block");
    });	
	jQuery('.outreach_read_more').click(function(e) {		e.preventDefault();		if(jQuery(this).hasClass('less')) {			jQuery(this).parent().prev().animate({				'height': 190			},{duration: 300},"easein");					jQuery(this).html('more&hellip;');			jQuery(this).removeClass('less');		} else {					jQuery(this).parent().prev().animate({				'height': $(this).parent().prev()[0].scrollHeight			},{duration: 300},"easein");			jQuery(this).html('less&hellip;');			jQuery(this).addClass('less');		}	});
//	$('.outreach_trip_desc,.outreach_proj_desc').animate({'height': '190px'	});

});

</script>
<?php wp_footer(); ?>
</body>
</html>