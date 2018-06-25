<?php 
if(isset($_POST['email']))
{
require_once('include/EmailFunction.php');

$message = "Hey Allison, Add ->".$_POST['name']." at email - ".$_POST['email']." to the list for more trrrips!";

EmailHTMLFunction("info@studentsofferingsupport.ca", "SOS Volunteer Trips Site", "trips@studentsofferingsupport.ca", "Allison", "New Person interested in trrrrips!",$message); 

header("Location:http://www.sosvolunteertrips.org/2015-trips/?Newsletter=Success");
}
else
{
header("Location:http://www.sosvolunteertrips.org/2015-trips/?Newsletter=Fail");
}

?>