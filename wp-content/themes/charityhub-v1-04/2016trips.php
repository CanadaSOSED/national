<?php
//connect to db
require_once('include/portal_db_config.php');
?>

<?php
$tripsQuery = mysql_query("SELECT * FROM `VolunteerTrip` WHERE YEAR = '2017'") or die(mysql_error());

if (mysql_num_rows($tripsQuery) <=  0) {
?>
	<p>
	We are currently working on organizing trips for 2017. For any trip related question, feel free to email us at <a href="mailto:trips@studentsofferingsupport.ca"> trips@studentsofferingsupport.ca. </a>
	</p>

<?php

}

else {


?>

<table class="style-2"><code>
<tbody>
<tr>
<th>Destination</th>
<th>Dates</th>
<th>Cost</th>
<th>Departure City</th>
<th>Community: Project</th>
<th>More info / apply</th>
</tr>

<?php

$year = 2017;
/*------------------------------------------------*/
	//Old query with duplicates of Joint trips.
	/*$query1 = "SELECT VolunteerTrip.TripID, VolunteerTrip.DepartureCity, NGO_Communities.Country, NGO_Communities.Name, NGO_Projects.ProjectName, VolunteerTrip.School, TypeName, VolunteerTrip.EarliestDate, VolunteerTrip.LatestDate, VolunteerTrip.FlightCost, VolunteerTrip.NonVolunteerCost, VolunteerTrip.OpenForApplications, VolunteerTrip.BasicCost, Chapters.Website FROM VolunteerTrip, NGO_Projects, NGO_Communities, TripType, Chapters WHERE VolunteerTrip.TypeID = TripType.TypeID AND 
	VolunteerTrip.ProjectID = NGO_Projects.ProjectID AND NGO_Projects.NGOcommID = NGO_Communities.NGOcommID AND Year = '$year' AND 
	TripType.TypeName <> 'Fake' AND VolunteerTrip.OpenForApplications = 1 AND VolunteerTrip.School = Chapters.School ORDER BY EarliestDate ASC"; */
	
//new query to remove duplicates.. but new query to get a TRIPID for this unique entry.
	$query1 = "SELECT DISTINCT VolunteerTrip.DepartureCity, NGO_Communities.Country, NGO_Communities.Name, NGO_Projects.ProjectName, TypeName, VolunteerTrip.EarliestDate, VolunteerTrip.LatestDate, VolunteerTrip.FlightCost, VolunteerTrip.NonVolunteerCost, VolunteerTrip.OpenForApplications, VolunteerTrip.BasicCost FROM VolunteerTrip, NGO_Projects, NGO_Communities, TripType, Chapters WHERE VolunteerTrip.TypeID = TripType.TypeID AND 
	VolunteerTrip.ProjectID = NGO_Projects.ProjectID AND NGO_Projects.NGOcommID = NGO_Communities.NGOcommID AND Year = '$year' AND 
	TripType.TypeName <> 'Fake' AND VolunteerTrip.OpenForApplications = 1 AND VolunteerTrip.School = Chapters.School ORDER BY EarliestDate ASC";
	
	$result1 = mysql_query($query1, $dbb1) or die ("Error in query: $query. ".mysql_error());
	
	while($row1 = mysql_fetch_array($result1)) {
		
		list($EDyear1,$EDmonth1,$EDday1) = explode("-",$row1["EarliestDate"]);
		list($LDyear1,$LDmonth1,$LDday1) = explode("-",$row1["LatestDate"]);
		$totalprice1 = $row1["FlightCost"] + $row1["NonVolunteerCost"];
	
			echo '<tr>';
	echo '			<td>';


	echo $row1['Country'];

	echo '			</td>';
		
				echo '<td>';
					echo ''.date('M',mktime(0, 0, 0, $EDmonth1, 1)).' '.$EDday1.' '.$EDyear1.'';
				echo ' - ';
					echo ''.date('M',mktime(0, 0, 0, $LDmonth1, 1)).' '.$LDday1.' '.$LDyear1.'';
				echo '</td>';
				echo '<td>';
	if($row1["FlightCost"] != 0){
		echo'			$'.number_format((float)$totalprice1, 2, '.', '').'';
	}
	else {
		echo' $'.number_format((float)$totalprice1, 2, '.', '').' + Flight Cost';
	}
				echo '</td>';
echo '<td>';
echo $row1['DepartureCity'];
echo '</td>';
echo '<td>';
echo $row1["Name"].': '.$row1["ProjectName"];
echo '</td>';
				echo '<td>';
	
	$query2 = "SELECT TripID FROM VolunteerTrip, NGO_Projects, NGO_Communities, TripType WHERE VolunteerTrip.TypeID = TripType.TypeID AND 
	VolunteerTrip.ProjectID = NGO_Projects.ProjectID AND NGO_Projects.NGOcommID = NGO_Communities.NGOcommID AND Year = '$year' AND 
	TripType.TypeName <> 'Fake' AND VolunteerTrip.OpenForApplications = 1 AND VolunteerTrip.DepartureCity = '".$row1['DepartureCity']."' AND NGO_Communities.Country  = '".$row1['Country']."' AND VolunteerTrip.EarliestDate  = '".$row1['EarliestDate']."' AND NGO_Communities.Name  = '".$row1['Name']."'";
	
	$result2 = mysql_query($query2, $dbb1) or die ("Error in query: $query. ".mysql_error());
	
	$row2 = mysql_fetch_array($result2);
	
	
	echo'<a class="gdlr-button small" href="http://www.sosvolunteertrips.org/Trip-Info/?TripID='.$row2['TripID'].'"  target="_self" style="color:#ffffff; background-color:#94d64f; border-color:#368799; margin-bottom:0px;"> Info / Apply! </a>';
echo '</td>';


//REMOVE THIS WHEN PERIOD IS OVER
if ($row2['TripID']==372) {
	echo '<td>';
	echo '<p style="color:red">Sign Up By Wednesday, March 23, 2017 to receive a $200.00 Trip Scholarship!!</p>';
	echo '</td>';
}




echo '</tr>';

} ?>


</tbody>
</table>
<br/>


<?php
	}




?>


