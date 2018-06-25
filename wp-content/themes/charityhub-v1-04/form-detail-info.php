<?php

require_once('include/portal_db_config.php');


if ($_REQUEST['TripID'] == '324'){
$Community = 'El Tamarindo';
$description = 'Multi-use Sports Court';
$date = 'May 01 - May 15';
$cost = '$950.00 + Flight Cost';
$Destination = 'Honduras';
}elseif ($_REQUEST['TripID'] == '323'){
$Community = 'Pedro Arauz';
$description = 'Water Storage and Agriculture Training Centre';
$date = 'Feb 14 - Feb 21';
$cost = '$750.00 + Flight Cost';
$Destination = 'Nicaragua';
}elseif ($_REQUEST['TripID'] == '326')
{
$Community = 'Ovejeria Larama';
$description = 'New Classrooms and Educational Infrastructure';
$date = 'May 15 - May 30';
$cost = '$950.00 + Flight Cost';
$Destination = 'Bolivia';
}
elseif ($_REQUEST['TripID'] == '320')
{
$Community = 'Vista Hermosa';
$description = 'Eco-Library';
$date = 'Aug 15 - Aug 30';
$cost = '$950.00 + Flight Cost';
$Destination = 'Guatemala';
}
elseif ($_REQUEST['TripID'] == '321')
{
$Community = 'Los Pirineos';
$description = 'Kindergarden Construction';
$date = 'Aug 15 - Aug 30';
$cost = '$950.00 + Flight Cost';
$Destination = 'Honduras';
}
elseif ($_REQUEST['TripID'] == '322')
{
$Community = 'Pueblo Nuevo';
$description = 'Primary School Construction';
$date = 'Aug 15 - Aug 30';
$cost = '$950.00 + Flight Cost';
$Destination = 'Nicaragua';
}
  else
{
$Community = 'Pedro Arauz';
$description = 'Water Storage and Agriculture Training Centre';
$date = 'Feb 14 - Feb 21';
$cost = '$950.00 + Flight Cost';
$Destination = 'Nicaragua';
}


?>

TRIP TO: <?php echo $Destination; ?> (<?php echo $date; ?>) PROJECT: <?php echo $description; ?>