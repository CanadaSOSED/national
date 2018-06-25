<?php
//connect to db
require_once('include/portal_db_config.php');
/*
function OutreachAmountRemaining($user_id, $trip_id) {
   //get information about the trip
   $sqlselect = mysql_query("SELECT * FROM VolunteerTrip, NGO_Projects, NGO_Communities
                  WHERE TripID = '" . $trip_id . "' AND VolunteerTrip.ProjectID = NGO_Projects.ProjectID
                  AND NGO_Projects.NGOcommID = NGO_Communities.NGOcommID") or die(mysql_error());
   $rowselect = mysql_fetch_array($sqlselect);

   //get the total amount they have paid.. subtract that from the total amount that is owed
   //see if a volunteer
   $UserTripParticipantsResult = mysql_query("SELECT * FROM lm_user_profiles, VolunteerTripParticipants WHERE lm_user_profiles.user_id = VolunteerTripParticipants.user_id AND VolunteerTripParticipants.user_id = '" . $user_id . "' AND TripID = '" . $trip_id . "'") or die(mysql_error());
   $ParticipantInfo = mysql_fetch_array($UserTripParticipantsResult);
   $Scholarship = 0;

   //get basic cost    
   if ($ParticipantInfo['ActiveVolunteer'] == 0) {
      $basicCost      = $rowselect['NonVolunteerCost'];
      $ScholarshipInt = 0;
   } else {
      $basicCost = $rowselect['BasicCost'];
   }

   //any scholarship?
   $sqlScholarship = mysql_query("SELECT * FROM Finance_VolunteerScholarships WHERE user_id =  '" . $user_id . "' AND TripID='" . $trip_id . "'") or die(mysql_error());
   
   if (mysql_num_rows($sqlScholarship) > 0) {
      $ScholarshipArray = mysql_fetch_array($sqlScholarship);
      $Scholarship      = $ScholarshipArray['Amount'];
      $ScholarshipInt = 1;
   } else {
      $ScholarshipInt = 0;
   }

   //get flight cost   
   if ($ParticipantInfo['FlightBookedIndependently'] == 1) {
      $flight = 0;
   } else {      
      if ($ParticipantInfo['FlightCost'] != '0') {
         $flight = $ParticipantInfo['FlightCost'];
      } else {
         $flight = $rowselect['FlightCost'];
      }
   }

   //if no individual AddedCost, use the trip added Cost, otherwise always use the individual   
   if ($ParticipantInfo['AddedCost'] == '0') {
      $addedCost = $rowselect['AddedCost'];
   } else {
      $addedCost = $ParticipantInfo['AddedCost'];
   }

   $amt   = 0;
   $split = 0;
   //Any group fundraising that is split:
   $sql5 = mysql_query("SELECT SUM(TotalAmt) AS Total FROM DonationRevenue, CashTransactions WHERE CashTransactions.DonID = DonationRevenue.DonID AND TripID = '" . $trip_id . "' AND SplitDonation = '1'") or die(mysql_error());
   $SplitSum = mysql_fetch_array($sql5);
   
   if ($SplitSum['Total'] != NULL) {
      //number of active participants
      $UserTripParticipantsResult = mysql_query("SELECT * FROM lm_user_profiles, VolunteerTripParticipants WHERE lm_user_profiles.user_id = VolunteerTripParticipants.user_id AND VolunteerTripParticipants.Status = '1' AND VolunteerTripParticipants.TripID = '" . $trip_id . "' ") or die(mysql_error());
      $ACTIVEParticipantsNum = mysql_num_rows($UserTripParticipantsResult);
      $amt                   = $SplitSum['Total'] / $ACTIVEParticipantsNum;
      $split                 = 1;
   }

   //subtract payments already
   $sql6 = mysql_query("SELECT TotalAmt AS Total, DonationRevenue.DonID AS ID, 'Cheque' AS Type
               FROM DonationRevenue, CashTransactions 
               WHERE CashTransactions.DonID = DonationRevenue.DonID AND TripID = '" . $trip_id . "' AND Trip_user_id =  '" . $user_id . "' AND Deposited = '1'
               UNION 
               SELECT GrossAmount AS Total,DonationRevenue.MerchantRefID AS ID, 'PayPal' AS Type
               FROM DonationRevenue, CMSPaypalDetails 
               WHERE DonationRevenue.MerchantRefID = CMSPaypalDetails.MerchantRefID AND TripID = '" . $trip_id . "' AND Trip_user_id =  '" . $user_id . "' 
               UNION
               SELECT TotalAmt AS Total, DonationRevenue.DonID AS ID, 'ChequeNotDeposited' AS Type
               FROM DonationRevenue, CashTransactions 
               WHERE CashTransactions.DonID = DonationRevenue.DonID AND TripID = '" . $trip_id . "' AND Trip_user_id =  '" . $user_id . "' AND Deposited = '0'
               ") or die(mysql_error());
   $paymentTotal        = 0;
   $paymentNotDeposited = 0;
   
   if (mysql_num_rows($sql6) > 0) {
      while ($payments = mysql_fetch_array($sql6)) {
         
         if ($payments['Type'] == "Cheque") {
            $paymentTotal = $paymentTotal + $payments['Total'];
         }
         elseif ($payments['Type'] == "ChequeNotDeposited") {
            $paymentNotDeposited = $paymentNotDeposited + $payments['Total'];
         } else {
            $amount       = round(($payments['Total'] * .981) - .3, 1);
            $paymentTotal = $paymentTotal + $amount;
         }
      }
   }

   $totalCost = $basicCost + $flight + $addedCost;
   $contribution = $paymentTotal + $paymentNotDeposited + $Scholarship + $amt;
   $amountleft = $totalCost - $contribution;
   
   if ($amountleft < 3) {
      $amountleft = 0;
   }

   return $amountleft;
}
*/
?>
<style type="text/css">
   #pageContainer {
      font-family:Algerian;
   }

   .shift-up {
      margin-top: -50px;
   }

   input[type=text], select {
      border: 1px solid #A9A9A9;
   }
</style>

<script>
   function validateForm(tripPrice) {
      var DonationAmount = document.forms["donationForm"]["amount_to_be_paid"];

      if(Number(DonationAmount.value) == NaN) {
         alert("Invalid donation amount - please enter a number.");
         return false;
      }
      else {
         if (Number(DonationAmount.value) <= 0) {
            alert("Your donation amount must be more than $0.");
            return false;
         }
      }
      
      return true;
   }
</script>

<div id="pageContainer" class="shift-up">
<?php
if(!isset($_GET['user_id']) || !isset($_GET['trip_id'])) {
   ?>
   <h1>Error: Invalid link.  Please include your user id and trip id in the url</h1>
   <?php
}
else {
   // Paypal post back
   if (isset($_POST['txn_id'])) {
      // If paid by paypal 
      $ids = explode('|', $_POST['custom']);
      // Split up our string by '|'
      // Now $ids is an array containing your 2 values in the order you put them.
      $first_name_of_payee = $ids[0];
      // Our member id was the first value in the hidden custom field
      $last_name_of_payee  = $ids[1];
      // some_other_id was the second value in our string.
      $l_postal_zip        = $ids[2];
      // some_other_id was the second value in our string.
      $add_of_payee        = $ids[3];
      // some_other_id was the second value in our string.
      $payee_country       = $ids[4];
      // some_other_id was the second value in our string.
      $payee_province      = $ids[5];
      // some_other_id was the second value in our string.
      $payee_city          = $ids[6];
      $trip_id             = $ids[7];
      $user_id             = $ids[8];
      $date_submitted  = date("Y-m-d H:i:s");
      $sql_for_year    = "SELECT * FROM Year WHERE Active=1 and Locked=0";
      $get_fiscal_year = mysql_query($sql_for_year);
      $fiscal_year     = mysql_fetch_array($get_fiscal_year);
      $fiscal_year     = $fiscal_year['FiscalYear'];
      $amount_to_be_paid = $_GET['amt'];
      $amount_to_be_paid = $_POST['mc_gross'];
      $amt               = $_GET['amt'];
      $cc                = $_GET['cc'];
      $amt               = $_POST['mc_gross'];
      $cc                = $_POST['mc_currency'];
      $check             = mysql_query("SELECT * FROM DonationRevenue WHERE MerchantRefID = '" . $_POST['txn_id'] . "'");
      
      if ((mysql_num_rows($check) < 1) AND $first_name_of_payee) {
         $sql_query_toadd_by_cheque = "INSERT INTO DonationRevenue SET School='Canada' ,DonorFirstName='" . $first_name_of_payee . "',DonorLastName='" . $last_name_of_payee . "',DateSubmit='" . $date_submitted . "',Year='" . $fiscal_year . "',DStreetAddress='" . $add_of_payee . "',DPostal='" . $l_postal_zip . "',DProvince='" . $payee_province . "',DCity='" . $payee_city . "',DCountry='" . $payee_country . "',ReceiptIssued=1,Type='Trip',Trip_user_id='" . $user_id . "', TripID='" . $trip_id . "',PartDeposit =0,FundraisingDonation=1,MerchantRefID='" . $_POST['txn_id'] . "'";
         mysql_query($sql_query_toadd_by_cheque);
         $transaction_id_paypal = $_POST['txn_id'];
         foreach ($_GET as $key => $value) {
            $array_new["$key"] = $value;
         }
   
         $checkquery       = "SELECT * from CMSPaypalDetails where MerchantRefID='" . $transaction_id_paypal . "'";
         $checking_already = mysql_query($checkquery);
         $num_rows = mysql_num_rows($checking_already);
         
         if ($num_rows < 1) {
            $query = "INSERT into CMSPaypalDetails SET MerchantRefID='" . $transaction_id_paypal . "' ,GrossAmount='" . $amt . "',Currency='" . $cc . "',TransactionType='C',PayTransactionPost='" . $transaction_id_paypal . "',create_date='" . $date_submitted . "'";
            mysql_query($query);
            $Fee = round((($amt * 0.0192) + 0.3), 2);
            $fees = mysql_query("INSERT INTO Finance_PaypalFees (MerchantRefID, Fee, create_date) VALUES ('" . $transaction_id_paypal . "', '" . $Fee . "', '" . $date_submitted . "')");
         }
      }   
   }

   // Paid by cheque success
   if (isset($_GET['paid']) && $_GET['paid'] == true) {
      ?>
      <div class="shift-up">
         <h1 class="shift-up">Last Step - Mail your Cheques</h1>
         <p class="shift-up">Mail your cheque(s) to:<br>Students Offering Support</br>326 1/2 Bloor St West<br>Toronto, Ontario<br>M5S 1W5<br>Telephone: 647-909-0315<br><b><p><b>NOTE</b>: Please make the cheque(s) payable to 'Canada SOS' (we cannot accept cheques written to any other name). <br><b>Please write the participant's first name & last name in the memo of the cheque so we know who this is for!</b></p>
         <p class="shift-up">Upon receiving the cheque, you will get an e-mail confirming that it has been received!</p>
      </div>
      <?php
   }
   elseif(isset($_POST['submit']) || isset($_POST['confirm'])) {
      // Fetching GET variables
      $user_id = $_GET['user_id'];
      $trip_id = $_GET['trip_id'];

      // Fetching POST variables
      $first_name_of_payee = $_POST['first_name_of_payee'];
      $last_name_of_payee  = $_POST['last_name_of_payee'];
      $add_of_payee        = $_POST['add_of_payee'];
      $l_postal_zip        = $_POST['l_postal_zip'];
      $payee_country       = $_POST['payee_country'];
      $payee_city          = $_POST['payee_city'];
      $payee_province      = $_POST['payee_province'];
      $amount_to_be_paid   = $_POST['amount_to_be_paid'];
      $payment_method      = $_POST['payment_method'];

      if ($payment_method == 'paypal') {
         if($amount_to_be_paid > 0) {
            $amount_to_be_paid = $amount_to_be_paid + ($amount_to_be_paid * 0.019) + 0.3;
         }
         $amount_to_be_paid = round($amount_to_be_paid, 2);
      }

      if (isset($_POST['submit'])) {
         ?>
         <h1 class="shift-up">Tax Receipt for Student ID <?php echo $user_id; ?></h1>
         <table class="shift-up">
            <thead>
               <th>First Name</th>
               <th>Last Name</th>
               <th>Address</th>
               <th>Zip Code</th>
               <th>Country</th>
               <th>State</th>
               <th>Amount</th>
               <th>Payment Method</th>
            </thead>
            <tr>
               <td><?php echo $first_name_of_payee; ?></td>
               <td><?php echo $last_name_of_payee; ?></td>
               <td><?php echo $add_of_payee; ?></td>
               <td><?php echo $l_postal_zip; ?></td>
               <td><?php echo $payee_country; ?></td>
               <td><?php echo $payee_province; ?></td>
               <td>$<?php echo $amount_to_be_paid; ?></td>
               <td><?php echo $payment_method; ?></td>
            </tr>
         </table>
         <form class="shift-up" method="POST" action="?user_id=<?php echo $_GET['user_id'] ?>&trip_id=<?php echo $_GET['trip_id'] ?>"><br><input class="shift-up" type="submit" value="Confirm Details" name="confirm" id="confirm">
            <input type="hidden" name="payment_method" value="<?php echo $payment_method; ?>"  />
            <input type="hidden" name="first_name_of_payee" value="<?php echo $first_name_of_payee; ?>"  />
            <input type="hidden" name="last_name_of_payee" value="<?php echo $last_name_of_payee; ?>"  />
            <input type="hidden" name="l_postal_zip" value="<?php echo $l_postal_zip; ?>"  />
            <input type="hidden" name="add_of_payee" value="<?php echo $add_of_payee; ?>"  /> 
            <input type="hidden" name="payee_country" value="<?php echo $payee_country; ?>"  />
            <input type="hidden" name="payee_city"  value="<?php echo $payee_city; ?>"  required="required" />
            <input type="hidden" name="payee_province" value="<?php echo $payee_province; ?>"  />
            <input type="hidden" name="amount_to_be_paid" value="<?php echo $amount_to_be_paid; ?>"  /> 
         </form>
         <?php
      }
      else if(isset($_POST['confirm'])) {
         $date_submitted  = date("Y-m-d H:i:s");
         $sql_for_year    = "select * from Year where Active=1 and Locked=0";
         $get_fiscal_year = mysql_query($sql_for_year);
         $fiscal_year     = mysql_fetch_array($get_fiscal_year);
         $fiscal_year     = $fiscal_year['FiscalYear'];

         // If donor selects the payment by cheque
         if ($payment_method == 'cheque') 
         {
            //Redirect after final database entry to show thanks message
            $sql_query_toadd_by_cheque = "INSERT INTO DonationRevenue SET School='Canada' ,DonorFirstName='" . $first_name_of_payee . "',DonorLastName='" . $last_name_of_payee . "',DateSubmit='" . $date_submitted . "',Year='" . $fiscal_year . "',DStreetAddress='" . $add_of_payee . "',DPostal='" . $l_postal_zip . "',DProvince='" . $payee_province . "',DCity='" . $payee_city . "',DCountry='" . $payee_country . "',ReceiptIssued=1,Type='Trip',Trip_user_id='" . $user_id . "', TripID='" . $trip_id . "',PartDeposit =0,FundraisingDonation=1";
            mysql_query($sql_query_toadd_by_cheque);
            $DonID = mysql_insert_id();
            $sql_query_by_cheque = "INSERT INTO CashTransactions SET DonID='" . $DonID . "' ,ChequeAmt1='" . $amount_to_be_paid . "',TotalAmt='" . $amount_to_be_paid . "',School='Canada'";
            mysql_query($sql_query_by_cheque);
            ?>
            <script type="text/javascript">
               window.location.replace("http://sosvolunteertrips.org/volunteer-trip-contribution/?user_id=<?php echo $user_id; ?>&trip_id=<?php echo $trip_id; ?>&paid=true");
            </script> 
            <?php
         }
         // If donor selects the payment by paypal
         else if ($payment_method == 'paypal') {
            //This entry will update the Merchent Ref ID on return
            $toEmail = 'it@studentsofferingsupport.ca';
            $message = "Contribution Form Log:\n\nFirst Name: " . $first_name_of_payee . "\nLast Name: " . $last_name_of_payee . "\nAddress: " . $add_of_payee . "\nZip Code: " . $l_postal_zip . "\nCountry: " . $payee_country . "\nState: " . $payee_province . "\nAmount: " . $amount_to_be_paid . "\nPayment Method: " . $payment_method . "\nTimestamp: " . date('Y-m-d H:i:s');
            $subject = 'Volunteer Trip Contribution Form';
            $headers = 'From: Students Offering Support <sosvolunteertrip@vps231.canfone.com>' . PHP_EOL . 'Reply-To: Students Offering Support <sosvolunteertrip@vps231.canfone.com>' . PHP_EOL . 'X-Mailer: PHP/' . phpversion();
            // send email
            mail($toEmail, $subject, $message, $headers);
            ?>
            <form class="paypal" action="https://www.paypal.com/cgi-bin/webscr" method="post" id="paypal_form" style="display:none">  
               <input type="hidden" name="cmd" value="_xclick" /> 
               <input type="hidden" name="business" value="goverholt@studentsofferingsupport.ca"/>  
               <input type="hidden" name="no_note" value="1" />
               <input type="hidden" name="item_name" value="Volunteer Trip Contribution"/>  
               <input type="hidden" name="item_number" value="<?php echo $trip_id; ?>"/>  
               <input type="hidden" name="lc" value="CA" />
               <?php
               if ($trip_id == '295') {
                  ?>
                  <input type="hidden" name="currency_code" value="USD" />
                  <?php
               } else {
                  ?>
                  <input type="hidden" name="currency_code" value="CAD" />'
                  <?php
               }
               ?>
               <input type="hidden" name="bn" value="PP-BuyNowBF:btn_buynow_LG.gif:NonHostedGuest" />
               <input type="hidden" name="first_name" value="<?php echo $first_name_of_payee; ?>"  />
               <input type="hidden" name="last_name" value="<?php echo $last_name_of_payee; ?>"  /> 
               <input type="hidden" name="custom" value="<?php echo $first_name_of_payee . '|' . $last_name_of_payee . '|' . $l_postal_zip . '|' . $add_of_payee . '|' . $payee_country . '|' . $payee_province . '|' . $payee_city . '|' . $trip_id . '|' . $user_id; ?>"  />
               <input type="hidden" name="amount" value="<?php echo $amount_to_be_paid; ?>"/>  
               <input type="hidden" name="notify_url" value="http://sosvolunteertrips.org/volunteer-trip-contribution/?user_id=<?php echo $user_id; ?>&trip_id=<?php echo $trip_id; ?>"/> 
               <input type="submit" class="submit-button" value="Pay Now!" />
            </form>

            <script type="text/javascript">
               document.getElementById('paypal_form').submit();
            </script>
            <?php  
         }
      }
   }
   else {
      //get information about the user
      $sqlselect2 = mysql_query("SELECT * FROM lm_user_profiles WHERE user_id = '" . $_GET['user_id'] . "'") or die(mysql_error());
      $rowselect2 = mysql_fetch_array($sqlselect2);

      //get information about the trip
      $sqlselect = mysql_query("SELECT * FROM VolunteerTrip, NGO_Projects, NGO_Communities
                     WHERE TripID = '" . $_GET['trip_id'] . "' AND VolunteerTrip.ProjectID = NGO_Projects.ProjectID
                     AND NGO_Projects.NGOcommID = NGO_Communities.NGOcommID") or die(mysql_error());
      $rowselect     = mysql_fetch_array($sqlselect);
      $CommunityName = $rowselect['Name'];
      $Country = $rowselect['Country'];
      ?>
      <div class="container shift-up">
         <h1 class="shift-up">Volunteer Trip Contribution Form</h1>
         <p class="shift-up">Please fill out the form below accurately to ensure that your payment is processed correctly and that the donor information is correct,<br>so tax receipts can be generated properly!</p>
         <p class="shift-up"><b>Participant Name: <?php echo $rowselect2['FirstName'] . " " . $rowselect2['LastName']; ?><br>Trip To: <?php echo $CommunityName . " in " . $Country; ?></b></p>
      
         <h1 class="shift-up">Donor Information for Tax Purposes</h1>
         <p class="shift-up">For this payment you (or the donor) is eligible for a tax receipt. Please fill out the form below if you (or the donor) wish to get a<br>tax receipt:</p>

         <form id="donationForm" name="donationForm" class="shift-up" method="POST" onsubmit="return validateForm()" action="?user_id=<?php echo $_GET['user_id'] ?>&trip_id=<?php echo $_GET['trip_id'] ?>">
            <table border="1" class="shift-up" style="width:50%;">
               <tr>
                  <td>Donor First Name:</td>
                  <td><input id="first_name_of_payee" type="text" name="first_name_of_payee" required="required"  value=""></td>
               </tr>
               <tr>
                  <td>Donor Last Name:</td>
                  <td><input id="last_name_of_payee" type="text" name="last_name_of_payee" required="required" value=""></td>
               </tr>
               <tr>
                  <td>Donor Address:</td>
                  <td><input id="add_of_payee" type="text" name="add_of_payee" value=""></td>
               </tr>
               <tr>
                  <td>Postal Code / Zip Code:</td>
                  <td><input id="l_postal_zip" type="text" required="required"  name="l_postal_zip" value=""></td>
               </tr>
               <tr>
                  <td>Country:</td>
                  <td><select name="payee_country" id="country" required>
                        <option value="canada" selected="selected">Canada</option>
                        <option value="us">US</option>
                     </select>
                  </td>
               </tr>
                <tr>
                  <td colspan=2><b><i>NOTE: Only Canadian citizens are elible for a tax receipt as we are a Canadian Registered Charity</b></i></td>
               </tr>
               <tr>
                  <td>City:</td>
                  <td><input type="text" name="payee_city" required="required" /></td>
               </tr>

               <tr>
                  <td>Province / State:</td>
                  <td><select name="payee_province" id="payee_province" required>
                        <option value="">Choose one</option>
                        <option value="Alberta">Alberta</option>
                        <option value="British Columbia">British Columbia</option>
                        <option value="Manitoba">Manitoba</option>
                        <option value="New Brunswick">New Brunswick</option>
                        <option value="Newfoundland">Newfoundland and Labrador</option>
                        <option value="Nova Scotia">Nova Scotia</option>
                        <option value="NT">Northwest Territories</option>
                        <option value="Nunavut">Nunavut</option>
                        <option value="Ontario">Ontario</option>
                        <option value="Prince Edward Island">Prince Edward Island</option>
                        <option value="Quebec">Quebec</option>
                        <option value="Saskatchewan">Saskatchewan</option>
                        <option value="YT">Yukon</option>
                        <option value="" disabled> - States - </option>
                        <option value="AL">Alabama</option>
                        <option value="AK">Alaska</option>
                        <option value="AZ">Arizona</option>
                        <option value="AR">Arkansas</option>
                        <option value="CA">California</option>
                        <option value="CO">Colorado</option>
                        <option value="CT">Connecticut</option>
                        <option value="DE">Delaware</option>
                        <option value="DC">District Of Columbia</option>
                        <option value="FL">Florida</option>
                        <option value="GA">Georgia</option>
                        <option value="HI">Hawaii</option>
                        <option value="ID">Idaho</option>
                        <option value="IL">Illinois</option>
                        <option value="IN">Indiana</option>
                        <option value="IA">Iowa</option>
                        <option value="KS">Kansas</option>
                        <option value="KY">Kentucky</option>
                        <option value="LA">Louisiana</option>
                        <option value="ME">Maine</option>
                        <option value="MD">Maryland</option>
                        <option value="MA">Massachusetts</option>
                        <option value="MI">Michigan</option>
                        <option value="MN">Minnesota</option>
                        <option value="MS">Mississippi</option>
                        <option value="MO">Missouri</option>
                        <option value="MT">Montana</option>
                        <option value="NE">Nebraska</option>
                        <option value="NV">Nevada</option>
                        <option value="NH">New Hampshire</option>
                        <option value="NJ">New Jersey</option>
                        <option value="NM">New Mexico</option>
                        <option value="NY">New York</option>
                        <option value="NC">North Carolina</option>
                        <option value="ND">North Dakota</option>
                        <option value="OH">Ohio</option>
                        <option value="OK">Oklahoma</option>
                        <option value="OR">Oregon</option>
                        <option value="PA">Pennsylvania</option>
                        <option value="RI">Rhode Island</option>
                        <option value="SC">South Carolina</option>
                        <option value="SD">South Dakota</option>
                        <option value="TN">Tennessee</option>
                        <option value="TX">Texas</option>
                        <option value="UT">Utah</option>
                        <option value="VT">Vermont</option>
                        <option value="VA">Virginia</option>
                        <option value="WA">Washington</option>
                        <option value="WV">West Virginia</option>
                        <option value="WI">Wisconsin</option>
                        <option value="WY">Wyoming</option>
                     </select>
                  </td>
               </tr>
            </table>

            <h1 class="shift-up">Payment Information</h1>
            <!--
            <p class="shift-up">For this payment you (or the donor) is eligible for a tax receipt. Please fill out the form below if you (or the donor) wish to get a<br>tax receipt:</p>
            <h3 class="shift-up">Payment Summary</h3>
            -->
            <?php
               //get the total amount they have paid.. subtract that from the total amount that is owed
               //see if a volunteer

               /*
               $UserTripParticipantsResult = mysql_query("
               SELECT * FROM lm_user_profiles, VolunteerTripParticipants WHERE lm_user_profiles.user_id = VolunteerTripParticipants.user_id AND VolunteerTripParticipants.user_id = '" . $_GET['user_id'] . "' AND TripID = '" . $_GET['trip_id'] . "'") or die(mysql_error());
               $ParticipantInfo = mysql_fetch_array($UserTripParticipantsResult);
               $Scholarship = 0;
               
               //get basic cost            
               if ($ParticipantInfo['ActiveVolunteer'] == 0) {
                  $basicCost      = $rowselect['NonVolunteerCost'];
                  $ScholarshipInt = 0;
               } else {
                  $basicCost = $rowselect['BasicCost'];
                  //any scholarship?
                  $sqlScholarship = mysql_query("SELECT * FROM Finance_VolunteerScholarships WHERE user_id =  '" . $_GET['user_id'] . "' AND TripID='" . $_GET['trip_id'] . "'") or die(mysql_error());
                  
                  if (mysql_num_rows($sqlScholarship) > 0) {
                     $ScholarshipArray = mysql_fetch_array($sqlScholarship);
                     $Scholarship      = $ScholarshipArray['Amount'];
                     $ScholarshipInt   = 1;
                  } else {
                     $ScholarshipInt = 0;
                  }            
               }
               
               //get flight cost            
               if ($ParticipantInfo['FlightBookedIndependently'] == 1) {
                  $flight = 0;
               } else {               
                  if ($ParticipantInfo['FlightCost'] != '0') {
                     $flight = $ParticipantInfo['FlightCost'];
                  } else {
                     $flight = $rowselect['FlightCost'];
                  }            
               }
               
               //if no individual AddedCost, use the trip added Cost, otherwise always use the individual            
               if ($ParticipantInfo['AddedCost'] == '0') {
                  $addedCost = $rowselect['AddedCost'];
               } else {
                  $addedCost = $ParticipantInfo['AddedCost'];
               }
               
               $amt   = 0;
               $split = 0;
               //Any group fundraising that is split:
               $sql5 = mysql_query("SELECT SUM(TotalAmt) AS Total FROM DonationRevenue, CashTransactions WHERE CashTransactions.DonID = DonationRevenue.DonID AND TripID = '" . $_GET['trip_id'] . "' AND SplitDonation = '1'") or die(mysql_error());
               $SplitSum = mysql_fetch_array($sql5);
               
               if ($SplitSum['Total'] != NULL) {
                  //number of active participants
                  $UserTripParticipantsResult = mysql_query("SELECT * FROM lm_user_profiles, VolunteerTripParticipants WHERE lm_user_profiles.user_id = VolunteerTripParticipants.user_id AND VolunteerTripParticipants.Status = '1' AND VolunteerTripParticipants.TripID = '" . $_GET['trip_id'] . "' ") or die(mysql_error());
                  $ACTIVEParticipantsNum = mysql_num_rows($UserTripParticipantsResult);
                  $amt                   = $SplitSum['Total'] / $ACTIVEParticipantsNum;
                  $split                 = 1;
               }
               
               //subtract payments already
               $sql6 = mysql_query("SELECT TotalAmt AS Total, DonationRevenue.DonID AS ID, 'Cheque' AS Type
                  FROM DonationRevenue, CashTransactions 
                  WHERE CashTransactions.DonID = DonationRevenue.DonID AND TripID = '" . $_GET['trip_id'] . "' AND Trip_user_id =  '" . $_GET['user_id'] . "' AND Deposited = '1'
                  UNION 
                  SELECT GrossAmount*0.981-0.3 AS Total,DonationRevenue.MerchantRefID AS ID, 'PayPal' AS Type
                  FROM DonationRevenue, CMSPaypalDetails 
                  WHERE DonationRevenue.MerchantRefID = CMSPaypalDetails.MerchantRefID AND TripID = '" . $_GET['trip_id'] . "' AND Trip_user_id =  '" . $_GET['user_id'] . "' 
                  ") or die(mysql_error());
               $paymentTotal = 0;
               
               if (mysql_num_rows($sql6) > 0) {
                  while ($payments = mysql_fetch_array($sql6)) {                  
                     if ($payments['Type'] == "Cheque") {
                        $paymentTotal = $paymentTotal + $payments['Total'];
                     } else {
                        $amount       = $payments['Total'];
                        $paymentTotal = $paymentTotal + $amount;
                     }            
                  }            
               }
               */
            ?>
            <!--
            <ul class="shift-up">
               <li class="shift-up">Your Participant fee: $<?php echo number_format($basicCost, 2); ?></li>
               <li class="shift-up">Flight cost (if booked with SOS): $<?php echo number_format($flight, 2); ?></li>
               <?php
                  if ($addedCost != '0') {
                     ?>
                     <li class="shift-up">Added Costs: $<?php echo number_format($addedCost, 2); ?></li>
                     <?php
                  }
               ?>
            </ul>
            -->
            <?php
               // Calculate the totals

               /*
               $totalCost = $basicCost + $flight + $addedCost;
               $paid = $totalCost - OutreachAmountRemaining($_GET['user_id'], $_GET['trip_id']);
               $amountLeft = OutreachAmountRemaining($_GET['user_id'], $_GET['trip_id']);
               */
            ?>
            <!--
            <h4 class="shift-up">Total Trip Cost: $<?php echo number_format($totalCost, 2); ?></h4>
            <h4 class="shift-up">Amount Paid: $<?php echo $paid; ?></h4>
            <h4 class="shift-up">Amount Remaining: $<?php echo $amountLeft; ?></h4>
            <p class="shift-up"><i>For your 2nd payment, it needs to be at least $500 (or if the balance is less then $500, then the remainder)</i></p>
            <hr class="shift-up"/>
            -->
            <h4 style="margin-top:-100px">Donation Amount: </h4><input type="text" value="$" disabled style="width:9px; color:#A9A9A9; border-right:none"><input id="amount_to_be_paid" type="text" required="required" name="amount_to_be_paid">
            <?php
               /*
               if ($amountLeft <= 0) {
                  ?>
                  <p class="shift-up">no more needed!</p>
                  <input id="amount_to_be_paid" type="hidden" required="required" name="amount_to_be_paid" value="0">
                  <?php
               } else {
                  ?>
                  <input id="amount_to_be_paid" type="text" class="shift-up" width=5 required="required"  name="amount_to_be_paid"  
                     value="<?php
                              if ($amountLeft < 500) {
                                 echo number_format($amountLeft, 2);
                              } else {
                                 echo "500";
                              }
                              ?>" >
                  <?php
               }
               */
            ?>
            <h4>Payment Method:</h4><select name="payment_method">
               <option value="paypal" class="shift-up">Pay via PayPal</option>
               <option value="cheque" class="shift-up">Pay via Cheque</option>
            </select><br><br><br><input type="submit"  value="Submit" name="submit">
         </form>
      <div>
   <?php
   }
}
?>
</div>