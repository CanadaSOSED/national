<?php
//connect to db
//require_once('include/portal_db_config.php');

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


$dbb1 = mysql_connect("localhost", "canadaso","D_L_326bloor!") or die ('Cannot connect to the database: ' . mysql_error());
mysql_select_db("canadaso_portal", $dbb1);

$year = 2015;
/*------------------------------------------------*/
	$query1 = "SELECT VolunteerTrip.TripID, NGO_Communities.Country, NGO_Communities.Name, NGO_Projects.ProjectName, VolunteerTrip.School, TypeName, VolunteerTrip.EarliestDate, VolunteerTrip.LatestDate, VolunteerTrip.FlightCost, VolunteerTrip.NonVolunteerCost, VolunteerTrip.OpenForApplications, VolunteerTrip.BasicCost, Chapters.Website FROM VolunteerTrip, NGO_Projects, NGO_Communities, TripType, Chapters WHERE VolunteerTrip.TypeID = TripType.TypeID AND 
	VolunteerTrip.ProjectID = NGO_Projects.ProjectID AND NGO_Projects.NGOcommID = NGO_Communities.NGOcommID AND Year = '$year' AND 
	TripType.TypeName <> 'Fake' AND VolunteerTrip.OpenForApplications = 1 AND VolunteerTrip.School = Chapters.School ORDER BY EarliestDate ASC";
	
	$result1 = mysql_query($query1, $dbb1) or die ("Error in query: $query. ".mysql_error());
	
	echo $query1;
	
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
echo 'Departure City';
echo '</td>';
echo '<td>';
echo $row1["Name"].': '.$row1["ProjectName"];
echo '</td>';
				echo '<td>';
	
	echo'	

	<a href="http://'.$row1["Website"].'/outreach-trip/?formid='.$row1["TripID"].'" target = "_blank">Info / Apply!</a>';
echo '</td>';
echo '</tr>';

} ?>


</tbody>
</table>
