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
                    </div>
                <div class="outreach-proj-details">

                    <span class="span-left" style="padding-left: 150px; text-decoration: underline;">Project Details:</span>

                    <span class="span-right1 outreach_proj_desc" style="overflow: auto; height: 200px; text-align: justify; padding-right: 8px;" title="John will lead a group of engineer students from the Institute for Sustainable Energy from the University of Toronto to visit the community and other contacts in Managua for 3-5 days in early October 2014. The group  will collect data and evaluate the site conditions to help inform the design team of the reality on the ground."></span>

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
                <div class="outreach-trip-cost">
                    <div class="outreach-trip-cost-title"><span class="span-left">Trip Cost:</span>
                    </div>
                   
                </div>
                &nbsp;
                <div class="outreach-trip-itinerary">
                    <div class="outreach-proj-details" style="height: 10px;"><span class="span-left" style="padding-left: 70px; text-decoration: underline;">Brief Itinerary/Project Description:</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--outreach-trip-details end-->
    <div class="clear" style="clear: both;"></div>
</div>



