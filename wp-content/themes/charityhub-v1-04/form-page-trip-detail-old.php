<?php

//connect to db

require_once('include/portal_db_config.php');

if($_REQUEST['TripID'] == '324'){
	$Community = 'El Tamarindo';
	$date = 'May 01 2015 - May 15 2015';
}
elseif($_REQUEST['TripID'] == '323'){
	$Community = 'Pedro Arauz';
	$date = 'Feb 14 2015 - Feb 21 2015';
}
elseif($_REQUEST['TripID'] == '326'){
	$Community = 'Ovejeria Larama';
	$date = 'May 15 2015 - May 30 2015';
}
elseif($_REQUEST['TripID'] == '320'){
	$Community = 'Vista Hermosa';
	$date = 'Aug 15 2015 - Aug 30 2015';
}
elseif($_REQUEST['TripID'] == '321'){
	$Community = 'Los Pirineos';
	$date = 'Aug 15 2015 - Aug 30 2015';
}
elseif($_REQUEST['TripID'] == '322'){
	$Community = 'Pueblo Nuevo';
	$date = 'Aug 15 2015 - Aug 30 2015';
	

}
else{
	$Community = 'Pedro Arauz';
	$date = 'Feb 14 2015 - Feb 21 2015';
}

?>
<?php echo $Community;?> <?php echo $date;?>
