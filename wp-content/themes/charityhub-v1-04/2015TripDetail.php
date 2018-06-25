<!DOCTYPE html>
<html>
<style>
div.scholarship {
    width: 500px;
    padding: 4px;
    border: 5px solid gray;
    margin: 0;
}
</style>
</html>
<?php

//connect to db

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
	
	$ProjectDetails = $row1['DetailedProjectDesc'];
	
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
	
	
	
	
		//REMOVE THIS WHEN PERIOD IS OVER
		if ($row1['TripID']==372){ 
			echo '<center><div class="scholarship">';
			echo '<p style="color:red; font-size:20px;"><b>Sign Up By Wednesday, March 23, 2016 to receive a $200.00 Trip Scholarship!!</b></p>';
			echo '</div></center>';
		}
	
	
	
	}
?>

<div class="outreach-desc-boxs" style="width: 91%;">
    <div class="outreach-proj-det" style="margin-left: 15px;">
        <div class="outreach-proj-det-box"><span class="span-proj-det">PROJECT DETAILS:</span>
            <div class="outreach-proj-det-wrap">
                <div class="outreach-proj-det-partnering">
                    <div class="outreach-proj-det-partnering-title"><span class="span-left">Partnering Community:</span>
                    </div>
                    <div class="outreach-proj-det-partnering-info">

                        <span class="span-right span-bold"><?php echo $Community;?>	</span>

                    </div>
                </div>
                <div class="outreach-proj-desc">
                    <div class="outreach-proj-desc-title"><span class="span-left">Project Description:</span>
                    </div>
                    <div class="outreach-proj-desc-info"><span class="span-right span-bold"><?php echo $description;?>	</span>
                    </div>
                </div>
                <div class="outreach-proj-details">

                    <span class="span-left" style="padding-left: 150px;"><br/>Project Details:</span>

                    <span class="span-right1 outreach_proj_desc" style="overflow: auto; height: 200px; margin:15px; text-align: justify; padding-right: 8px;" title=""><?php echo $ProjectDetails;?></span>

                </div>
            </div>
        </div>
        <!--outreach-proj-det-box end-->

    </div>
    <!--outreach-proj-det end-->
    <div class="outreach-trip-details">
        <div class="outreach-trip-details-box"><span class="span-trip-details">OUTREACH TRIP DETAILS:</span>
            <div class="outreach-trip-details-wrap">
                <div class="outreach-trip-date">
                    <div class="outreach-trip-date-title"><span class="span-left">Trip Dates:</span>
                    </div>
                    <div class="outreach-trip-date-days" style="margin-top: -17px;"><span class="span-right span-bold">
<?php echo $date;?> </span>
                    </div>
                </div>
				 <div class="outreach-trip-date">
                    <div class="outreach-trip-date-title"><span class="span-left">Departuring City:</span>
                    </div>
                    <div class="outreach-trip-date-days" style="margin-top: -17px;"><span class="span-right span-bold">
<?php echo $Departure;?> </span>
                    </div>
                </div>
                <div class="outreach-trip-cost">
                    <div class="outreach-trip-cost-title"><span class="span-left">Trip Fees:</span>
                    </div>
                    <div class="outreach-trip-cost-info" style="margin-top: -2.1em;"><span class="span-right"><span class="span-right">
<span class="span-bold"><?php echo $cost;?>
</span> 
                    </div>
                </div>
                <div class="outreach-proj-details">
                  <span class="span-left">Trip Description:</span>

				<span class="span-right1 outreach_proj_desc" style="overflow: auto; height: 200px; margin:15px; text-align: justify; padding-right: 8px;" title=""><?php echo $tripDetails;?></span>
					
				
                   
                </div>
            </div>
        </div>
    </div>
    <!--outreach-trip-details end-->
    <div class="clear" style="clear: both;"></div>
</div>



