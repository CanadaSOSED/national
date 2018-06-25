<?php
$tripId = $_REQUEST['TripID'];
$query1 = "SELECT VolunteerTrip.TripID,ContactEmail, VolunteerTrip.DetailedTripDesc, VolunteerTrip.DetailedTripDesc, VolunteerTrip.DetailedProjectDesc, VolunteerTrip.DepartureCity, NGO_Communities.Country, NGO_Communities.Name, NGO_Projects.ProjectName, VolunteerTrip.School, TypeName, VolunteerTrip.EarliestDate, VolunteerTrip.LatestDate, VolunteerTrip.FlightCost, VolunteerTrip.NonVolunteerCost, VolunteerTrip.OpenForApplications, VolunteerTrip.BasicCost FROM VolunteerTrip, NGO_Projects, NGO_Communities, TripType WHERE VolunteerTrip.TypeID = TripType.TypeID AND VolunteerTrip.ProjectID = NGO_Projects.ProjectID AND NGO_Projects.NGOcommID = NGO_Communities.NGOcommID AND TripID = '$tripId'"; 
$dbb1 = mysql_connect("localhost", "canadaso","D_L_326bloor!") or die ('Cannot connect to the database: ' . mysql_error());
mysql_select_db("canadaso_portal", $dbb1);
$result1 = mysql_query($query1, $dbb1) or die ("Error in query: $query1. ".mysql_error());
$row1 = mysql_fetch_array($result1);
$date = $row1['EarliestDate'];
$month = date("M", strtotime($date));

echo $row1['Country']." in ".$month;
?> 