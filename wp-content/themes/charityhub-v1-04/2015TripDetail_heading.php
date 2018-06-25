<?php

require_once('include/portal_db_config.php');

if (isset($_REQUEST['TripID']))
{
$tripID = $_REQUEST['TripID'];
}
else if (isset($_REQUEST['formtripid']))
{
$tripID = $_REQUEST['formtripid'];
}

$query1 = "SELECT VolunteerTrip.TripID, VolunteerTrip.DetailedTripDesc, VolunteerTrip.DetailedTripDesc, VolunteerTrip.DetailedProjectDesc, VolunteerTrip.DepartureCity, NGO_Communities.Country, NGO_Communities.Name, NGO_Projects.ProjectName, VolunteerTrip.School, TypeName, VolunteerTrip.EarliestDate, VolunteerTrip.LatestDate, VolunteerTrip.FlightCost, VolunteerTrip.NonVolunteerCost, VolunteerTrip.OpenForApplications, VolunteerTrip.BasicCost FROM VolunteerTrip, NGO_Projects, NGO_Communities, TripType WHERE VolunteerTrip.TypeID = TripType.TypeID AND VolunteerTrip.ProjectID = NGO_Projects.ProjectID AND NGO_Projects.NGOcommID = NGO_Communities.NGOcommID AND TripID = '$tripID'"; 
$dbb1 = mysql_connect("localhost", "canadaso","D_L_326bloor!") or die ('Cannot connect to the database: ' . mysql_error());
mysql_select_db("canadaso_portal", $dbb1);
	
	$result1 = mysql_query($query1, $dbb1) or die ("Error in query: $query1. ".mysql_error());
	
	while($row1 = mysql_fetch_array($result1)) {
	
	$Community = $row1['Name']; 
	$Country = $row1['Country']; 
	$Departure = $row1['DepartureCity']; 
	$description = $row1['ProjectName'];
			$trip_date=$row1['EarliestDate'];
		$trip_end_date=$row1['LatestDate'];
			
		$text_date_start = date("M Y", strtotime($trip_date));
}


?>

<h4>TRIP TO: <?php echo $Country; ?> (<?php echo $text_date_start; ?>) PROJECT: <?php echo $description; ?></h4>



