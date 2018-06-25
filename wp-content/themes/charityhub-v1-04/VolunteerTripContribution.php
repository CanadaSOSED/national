<?php
//connect to db
require_once('include/portal_db_config.php');

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
   #overlay {
    position: fixed;
    left: 0;
    top: 0;
    bottom: 0;
    right: 0;
    background: #000;
    opacity: 0.8;
    filter: alpha(opacity=80);
    
}
#loading {
    width: 50px;
    height: 57px;
    position: absolute;
    top: 50%;
    left: 50%;
    margin: -28px 0 0 -25px;
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
         <form class="shift-up" method="POST" action="?user_id=<?php echo $_GET['user_id'] ?>&trip_id=<?php echo $_GET['trip_id'] ?>"><br>
             <input class="shift-up" type="submit" value="Confirm Details" name="confirm" id="confirm">
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
<img style="width: 80px; height: 40px;" src="<?php bloginfo('template_url'); ?>/images/paypal.PNG" alt=""/>
         <form id="donation-form" action="" method="post" >       
         <table class=" shift-up" style=" width: 60%;" >
    <tr>
        <td style="text-align: right">Firstname : </td> <td><input style=" float: left;" id="firstname1" type="text" name="firstname1" value=""></td> 
        <td style="text-align: right">Lastname : </td> <td><input style=" float: left;" id="firstname1" type="text" name="firstname1" value=""></td> 
        
    </tr>
     <tr>
        <td style="text-align: right">Credit Card Number : </td> <td><input style=" float: left;" id="firstname1" type="text" name="firstname1" value=""></td> 
        <td style="text-align: right">CVV /CSC : </td> <td><input style=" float: left;" id="firstname1" type="text" name="firstname1" value=""></td> 
        
    </tr>
     <tr>
        <td style="text-align: right">Expiry Month : </td> <td><select  style=" width: 100%" autocomplete="off"   class="selectbox"  id="exp_month" name="exp_month" >
                                                                <option value="">Expiry Month</option>
                                                                <option value="1">January</option>
                                                                <option value="2">February</option>
                                                                <option value="3">March</option>
                                                                <option value="4">April</option>
                                                                <option value="5">May</option>
                                                                <option value="6">June</option>
                                                                <option value="7">July</option>
                                                                <option value="8">August</option>
                                                                <option value="9">September</option>
                                                                <option value="10">October</option>
                                                                <option value="11">November</option>
                                                                <option value="12">December</option>
                                                                </select></td> 
        <td style="text-align: right">Expiry Year : </td> <td><select  style=" width: 100%" autocomplete="off"  id="exp_year"  class="selectbox"  name="exp_year">
                                                                <option value="">Expiry Year</option>
                                                                <option value="2016">2016</option>
                                                                <option value="2017">2017</option>
                                                                <option value="2018">2018</option>
                                                                <option value="2019">2019</option>
                                                                <option value="2020">2020</option>
                                                                <option value="2021">2021</option>
                                                                <option value="2021">2022</option>
                                                                <option value="2021">2023</option>
                                                                <option value="2021">2024</option>
                                                                <option value="2021">2025</option>
                                                                <option value="2021">2026</option>
                                                                <option value="2021">2027</option>
                                                                <option value="2021">2028</option>
                                                                <option value="2021">2029</option>
                                                                <option value="2021">2030</option>
                                                                <option value="2021">2031</option>
                                                                <option value="2021">2032</option>
                                                                <option value="2021">2033</option>
                                                                <option value="2021">2034</option>
                                                                <option value="2021">2035</option>

                                                           </select></td> 
        
    </tr>
     <tr>
        <td style="text-align: right">Card Type : </td> <td><select  style=" width: 100%" >
                          <option>Select</option>
                          <option value="mastercard">Master Card</option>
                          <option value="visa">Visa</option>
                      </select></td> 
        <td style="text-align: right">Country : </td> 
        <td><select  style=" width: 100%" name="payee_country" id="country" required>
                        <option value="ca" selected="selected">Canada</option>
                        <option value="us">US</option>
                      </select>
        </td> 
        
    </tr>
     <tr>
        <td style="text-align: right">Address : </td> <td><input style=" float: left;" id="firstname1" type="text" name="firstname1" value=""></td> 
        <td style="text-align: right">Province / State : </td> <td><select name="payee_province" id="payee_province" required>
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
                     </select></td> 
        
    </tr>
    <tr>
        <td style="text-align: right">City : </td> <td><input style=" float: left;" id="firstname1" type="text" name="firstname1" value=""></td> 
        <td style="text-align: right">Zip/Postal code : </td> <td><input style=" float: left;" id="firstname1" type="text" name="firstname1" value=""></td> 
        
    </tr>
    <tr>
        <td style="text-align: right">Phone : </td> <td><input style=" float: left;" id="firstname1" type="text" name="firstname1" value=""></td> 
        <td style="text-align: right">Email : </td> <td><input style=" float: left;" id="firstname1" type="text" name="firstname1" value=""></td> 
        
    </tr>
    <tr>
        <td style="text-align: right; ">Currency: </td> <td><select style=" width: 100%" >
                          <option>Select</option>
                          <option value="CAD">CAD</option>
                          <option value="USD">USD</option>
                      </select></td> 
                      <td style="text-align: right">Amount : </td> <td><input style=" float: left;" id="firstname1" type="text" name="firstname1" value=""></td> 
        
    </tr>
</table>
         <input style="margin-left: 30%;" id="createpayment1" value="Donate !" name="submit" type="submit">
        
 </form><!--<button id="next">ok</button>-->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script type="text/javascript">
             
         $( document ).ready(function() {
           
    
     var paymentAction = function(data, textStatus, jqXHR)
    {
        removeloading();
        if(data.paymentStatus == "completed" && data.registrationStatus == "success" ){
            alert('Your account has been registered succesfully!');
            window.location = 'login.'+site_suffix;

        }
        else if(data.paymentStatus == "failed"){
            alert('Please Enter Valid Card Details !!!');
        }

    };
          
           
           
           $( "#createpayment1" ).click(function($e) {
 
  $e.preventDefault();
  
  loading();
  $.ajax({
  type: "POST",
  url: "http://sosvolunteertrips.org/wp-content/themes/charityhub-v1-04/include/PayPal-PHP-SDK/paypal/rest-api-sdk-php/sosCampus/payments/CreatePayment.php",
  data: $("#donation-form").serialize(),
  success: paymentAction,
  dataType: "json"
    });
  
 }); 
  
  
 var loading = function() {
        // add the overlay with loading image to the page
        var over = '<div id="overlay">' +
            '<img id="loading" src="http://bit.ly/pMtW1K">' +
            '</div>';
        $(over).appendTo('body');

    };

   
var removeloading = function() {
       $('#overlay').remove();
};


           
           
         });
         
         </script>
        </div>
   <?php
   echo 'Current PHP version: ' . phpversion();
   }
}
?>
</div>