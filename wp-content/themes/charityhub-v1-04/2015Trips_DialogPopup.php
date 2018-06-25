<?php

if(isset($_GET['Newsletter']))
{
	echo '

	 <link rel="stylesheet" href="//code.jquery.com/ui/1.11.1/themes/smoothness/jquery-ui.css">
	  <script src="//code.jquery.com/jquery-1.10.2.js"></script>
	  <script src="//code.jquery.com/ui/1.11.1/jquery-ui.js"></script>
	  <link rel="stylesheet" href="/resources/demos/style.css">
	  <script>
	  $(function() {
		$( "#dialog-message" ).dialog({
			
		width: 387,
		 modal: true,
		 height: 316,
		  }
		);
	  });
	  </script>
	';

	if ($_GET['Newsletter'] == 'Success')
	{
	echo '
	 
	<div id="dialog-message" title="Success!">
		<img src="http://www.sosvolunteertrips.org/wp-content/themes/charityhub-v1-04/images/2015tripsNewsletter_Success.jpg" />
	</div>';
	}
	else
	{
	echo '
	 
	<div id="dialog-message" title="Failed!">
		<img src="http://www.sosvolunteertrips.org/wp-content/themes/charityhub-v1-04/images/2015tripsNewsletter_Failure.jpg" />
	</div>';
	}
}

?>