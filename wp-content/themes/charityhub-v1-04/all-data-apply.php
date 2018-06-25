<?php

if (isset($_REQUEST['TripID']))
{
$tripID = $_REQUEST['TripID'];
}
else if (isset($_REQUEST['formtripid']))
{
$tripID = $_REQUEST['formtripid'];
}
//this works when using $dbb2 in the mysql_query below...
$dbb2 = mysql_connect("localhost", "canadaso","D_L_326bloor!") or die ('Cannot connect to the database: ' . mysql_error());
mysql_select_db("canadaso_portal", $dbb2);

//but in this include, which has the same code as above, but calls the DB $dbb1.. if you replace the mysql_query to use $dbb1.. it says error.. wtf??
require_once('include/portal_db_config.php');

$query1 = "SELECT VolunteerTrip.TripID, VolunteerTrip.DetailedTripDesc, VolunteerTrip.DepartureCity, NGO_Communities.Country, NGO_Communities.Name, NGO_Projects.ProjectName, VolunteerTrip.School, TypeName, VolunteerTrip.EarliestDate, VolunteerTrip.LatestDate, VolunteerTrip.FlightCost, VolunteerTrip.NonVolunteerCost, VolunteerTrip.OpenForApplications, VolunteerTrip.BasicCost FROM VolunteerTrip, NGO_Projects, NGO_Communities, TripType WHERE VolunteerTrip.TypeID = TripType.TypeID AND VolunteerTrip.ProjectID = NGO_Projects.ProjectID AND NGO_Projects.NGOcommID = NGO_Communities.NGOcommID AND TripID = '$tripID'"; 
	
	$result1 = mysql_query($query1, $dbb2) or die ("Error in query: $query1. ".mysql_error());
	
	while($row1 = mysql_fetch_array($result1)) {
	
	$Community = $row1['Name']; 
	$Country = $row1['Country']; 
	$Departure = $row1['DepartureCity']; 
	$description = $row1['ProjectName'];
	
	if ($row1['DetailedTripDesc'] == "")
	{
		$tripDetails  = "At the beginning of your two week outreach trip, you'll arrive with your group and will be met by your NGO partner at the airport. Upon arrival in your community, your group will have the chance to settle in and rest up after your travel. Our groups generally work for about 6 hours a day, Monday to Friday on the project site. You'll have the late afternoon/evenings and a couple rest days throughout to relax, explore the local area and participate in the local community. In the past many groups will try out milking cows, making tortillas, or join in in a game of soccer,  volleyball or baseball with the local children throughout their time."; 
	}
	else
	{
		$tripDetails = $row1['DetailedTripDesc'];
	}
	
	
	
		$trip_date=$row1['EarliestDate'];
		$trip_end_date=$row1['LatestDate'];
			
		$text_date_start = date("M d,Y", strtotime($trip_date));
		$text_date_end = date("M d,Y", strtotime($trip_end_date));
	
		$date = $text_date_start." - ".$text_date_end;
	
	
	$trip_flight_cost=$row1['FlightCost'];
	if ($trip_flight_cost != '0')
		{
		
			$cost = $row1['NonVolunteerCost']+$trip_flight_cost;
			$cost = "$".$cost." (All participant fees AND flight!)";
		
		}
	else
		{
			$cost = "$".$row1['NonVolunteerCost']." (NOT including flight)";
		}
	
	
	}

?>
<h2>Outreach Trip Details:</h2>
<p style="color:black; font-size:12px;"> 
<span class="span-desc"><span class="trip-basic-heading">Country:</span><span class="span-desc-detail"><?php echo $Country;?></span></br>
<span class="span-desc"><span class="trip-basic-heading">Community Name:</span><span class="span-desc-detail"><?php echo $Community;?></span></br>
<span class="span-desc"><span class="trip-basic-heading">Departure City:</span><span class="span-desc-detail"><?php echo $Departure;?></span></br>
<span class="span-desc"><span class="trip-basic-heading">Trip Dates:</span><span class="span-desc-detail"><?php echo $date;?></span></br>
<span class="span-desc"><span class="trip-basic-heading">Trip Fees:</span><span class="span-desc-detail"><?php echo $cost;?></span></br>
<span class="span-desc"><span class="trip-basic-heading">Trip Description:</span><span class="span-desc-detail"><br/><?php echo $tripDetails;?></span></br></p>
</span>
