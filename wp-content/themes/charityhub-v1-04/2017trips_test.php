<?php
//connect to db
require_once('include/portal_db_config.php');
?>

<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

<script>
  var headertext = [];
  var headers = document.querySelectorAll("thead");
  var tablebody = document.querySelectorAll("tbody");

  for (var i = 0; i < headers.length; i++) {
	headertext[i]=[];
	for (var j = 0, headrow; headrow = headers[i].rows[0].cells[j]; j++) {
	  var current = headrow;
	  headertext[i].push(current.textContent);
	  }
  } 

  for (var h = 0, tbody; tbody = tablebody[h]; h++) {
	for (var i = 0, row; row = tbody.rows[i]; i++) {
	  for (var j = 0, col; col = row.cells[j]; j++) {
	    col.setAttribute("data-th", headertext[h][j]);
	  } 
	}
  }
</script>
</head>
<?php
$year = 2017;

$tripsQuery = mysql_query("SELECT * FROM `VolunteerTrip` WHERE YEAR = '$year'") or die(mysql_error());

if (mysql_num_rows($tripsQuery) <=  0) {
?>
	<p>
	We are currently working on organizing trips for 2017. For any trip related question, feel free to email us at <a href="mailto:trips@studentsofferingsupport.ca"> trips@studentsofferingsupport.ca. </a>
	</p>
<?php
}
else {
?>

<style>
	@media screen and (max-width: 767px) {     
    	    table { width: 100%; }

	    thead { display: none; }
	    
	    th { display: none; }

	    tr:nth-of-type(2n) { background-color: none; }

	    tr td:first-child { background: #f0f0f0; font-weight: bold; font-size:1.3em; }

	    tbody td { display: block;  text-align:center; }

	    tbody td:before { 
              content: attr(data-th); 
              display: block;
              text-align:center;  
           }
        }

</style>




<body>
<table class="style-2"><code>
<tbody>
<tr>
<th>Destination</th>
<th>Dates</th>
<th>Cost</th>
<th>Departure City</th>
<th>Funded By</th>
<th>Community: Project</th>
<th>More info / apply</th>
</tr>

<?php

/*------------------------------------------------*/
	//Old query with duplicates of Joint trips.
	/*$query1 = "SELECT VolunteerTrip.TripID, VolunteerTrip.DepartureCity, NGO_Communities.Country, NGO_Communities.Name, NGO_Projects.ProjectName, VolunteerTrip.School, TypeName, VolunteerTrip.EarliestDate, VolunteerTrip.LatestDate, VolunteerTrip.FlightCost, VolunteerTrip.NonVolunteerCost, VolunteerTrip.OpenForApplications, VolunteerTrip.BasicCost, Chapters.Website FROM VolunteerTrip, NGO_Projects, NGO_Communities, TripType, Chapters WHERE VolunteerTrip.TypeID = TripType.TypeID AND
	VolunteerTrip.ProjectID = NGO_Projects.ProjectID AND NGO_Projects.NGOcommID = NGO_Communities.NGOcommID AND Year = '$year' AND
	TripType.TypeName <> 'Fake' AND VolunteerTrip.OpenForApplications = 1 AND VolunteerTrip.School = Chapters.School ORDER BY EarliestDate ASC"; */

//new query to remove duplicates.. but new query to get a TRIPID for this unique entry.
	$query1 = "SELECT NGO_Communities.Country, VolunteerTrip.EarliestDate, VolunteerTrip.LatestDate, VolunteerTrip.FlightCost, VolunteerTrip.NonVolunteerCost, VolunteerTrip.BasicCost, VolunteerTrip.DepartureCity, VolunteerTrip.School, 
	NGO_Communities.Name, NGO_Projects.ProjectName FROM VolunteerTrip, NGO_Projects, NGO_Communities, TripType, Chapters WHERE VolunteerTrip.TypeID = TripType.TypeID AND VolunteerTrip.ProjectID = NGO_Projects.ProjectID AND 
	NGO_Projects.NGOcommID = NGO_Communities.NGOcommID AND Year = '$year' AND TripType.TypeName <> 'Fake' AND VolunteerTrip.OpenForApplications = 1 AND VolunteerTrip.School = Chapters.School ORDER BY EarliestDate ASC";

	$result1 = mysql_query($query1, $dbb1) or die ("Error in query: $query. ".mysql_error());

	while($row1 = mysql_fetch_array($result1)) {

		list($EDyear1,$EDmonth1,$EDday1) = explode("-",$row1["EarliestDate"]);
		list($LDyear1,$LDmonth1,$LDday1) = explode("-",$row1["LatestDate"]);
		$totalprice1 = $row1["FlightCost"] + $row1["NonVolunteerCost"];

	echo '<tr>';
	echo '<td>';
	echo $row1['Country'];
	echo '</td>';
	echo '<td>';
	  echo ''.date('M',mktime(0, 0, 0, $EDmonth1, 1)).' '.$EDday1.' '.$EDyear1.'';
	  echo ' - ';
	  echo ''.date('M',mktime(0, 0, 0, $LDmonth1, 1)).' '.$LDday1.' '.$LDyear1.'';
	echo '</td>';
	echo '<td>';
  	  if($row1["FlightCost"] != 0){
		echo' $'.number_format((float)$totalprice1, 2, '.', '').'';
	  }
	  else {
		echo' $'.number_format((float)$totalprice1, 2, '.', '').' + Flight Cost';
	  }
	echo '</td>';
	echo '<td>';
	echo $row1['DepartureCity'];
	echo '</td>';
	echo '<td>';
	echo $row1['School'];
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
</body>
<html>
<?php
	}
?>
