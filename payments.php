<?php

require_once('wp-content/themes/charityhub-v1-04/include/portal_db_config.php');


?>

<?php 

// Check if paypal request or response
if (!isset($_POST["txn_id"]) && !isset($_POST["txn_type"])){
    
    
    $nine_digit_random_number = mt_rand(100000000, 999999999);
    $id = $_REQUEST['id'];
    $first_name = $_REQUEST['first_name'];
    $last_name = $_REQUEST['last_name'];
    $address = $_REQUEST['address'];
    $city = $_REQUEST['city'];
    $phone_number = $_REQUEST['phone_number'];
    $currency = $_REQUEST['currency'];
    $country = $_REQUEST['cc_type'];
    $province_state = $_REQUEST['province_state'];
    $postal_code = $_REQUEST['postal_code'];
    $email = $_REQUEST['email'];
    $amount = $_REQUEST['donation_amount'];
    $connection = "";
    $listdonation = 0 ;
    $brandname = "" ;
    
    
    if(isset($_REQUEST['connection'])){
        if($_REQUEST['connection'] != ""){
        $connection = $_REQUEST['connection'];
    }
    else{$connection = "";}
    }
    
    
    if(isset($_REQUEST['brandname'])){
        if($_REQUEST['brandname'] != ""){
        $brandname = $_REQUEST['brandname'];
    }
    else{$brandname = "";}
    }
    
    if(isset($_REQUEST['list-donation'])){
        if($_REQUEST['list-donation'] != ""){
        $listdonation = $_REQUEST['list-donation'];
    }
    else{$listdonation = 0;}
    }
    
    // PayPal settings
    $paypal_email = 'goverholt@studentsofferingsupport.ca';
    $return_url = "http://sosvolunteertrips.org/fundraiser-thank-you/?id=$id&uid=$nine_digit_random_number";
    $cancel_url = "http://sosvolunteertrips.org/fundraiser/?id=$id";
    $notify_url = "http://sosvolunteertrips.org/payments.php?id=$id&uid=$nine_digit_random_number";

    $item_name = 'Volunteer Trip Contribution - '.$tripid.'| UID : '.$userid;
    $item_amount = intval($amount);
    
    
    $querystring = '';
 
    // Firstly Append paypal account to querystring
    $querystring .= "?business=".urlencode($paypal_email)."&";
    $querystring .= "cmd=".urlencode("_xclick")."&";
    $querystring .= "no_note=".urlencode("1")."&";
    $querystring .= "bn=".urlencode(stripslashes("PP-BuyNowBF:btn_buynow_LG.gif:NonHostedGuest"))."&";
    $querystring .= "lc=".urlencode(stripslashes($country))."&";
    $querystring .= "item_name=".urlencode(stripslashes($item_name))."&";
    $querystring .= "item_number=".urlencode(($nine_digit_random_number))."&";
    $querystring .= "currency_code=".urlencode(stripslashes($currency))."&";
    $querystring .= "amount=".urlencode(stripslashes($item_amount))."&";
    $querystring .= "first_name=".urlencode(stripslashes($first_name))."&";
    $querystring .= "last_name=".urlencode(stripslashes($last_name))."&";
    $querystring .= "payer_email=".urlencode(stripslashes($email))."&";
    
    
    $querystring .= "custom=".urlencode(stripslashes("$first_name | $last_name | $postal_code | $address | $country | $province_state | $city | $id | $nine_digit_random_number ") )."&";
    
    
    //loop for posted values and append to querystring
    //    foreach($_POST as $key => $value) {
    //        $value = urlencode(stripslashes($value));
    //        $querystring .= "$key=$value&";
    //    }
    // 
    
    $querystring .= "return=".urlencode(stripslashes($return_url))."&";
    $querystring .= "cancel_return=".urlencode(stripslashes($cancel_url))."&";
    $querystring .= "cbt=".urlencode(stripslashes($brandname))."&";
    $querystring .= "notify_url=".urlencode($notify_url);
    
    $sql = mysql_query("INSERT INTO `fundraiser_donors` (donor_firstname, donor_lastname, donor_address, donor_country, donor_state , donor_city , donor_postalcode , donor_currency , 	donor_amount , donor_payment_status , payment_started_at , trip_id , donor_phone , donor_email , uniqueid , user_id  ,ConnectiontoSOS ,Anonomous, connection_link , list_enable) VALUES (
				'".$first_name."' ,
                                '".$last_name."' ,
                                '".$address."' ,
                                '".$country."' ,
                                '".$province_state."' ,
                                '".$city."' ,
                                '".$postal_code."' ,
                                '".$currency."' ,
                                '".$item_amount."' ,
                                'INITIATED' ,
                                '".date("Y-m-d H:i:s")."' ,
				'".$id."' ,
				'".$phone_number."' ,
				'".$email."' ,
				'".$nine_digit_random_number."',
                                '".$id."',
                                '".$connection."',
                                '".$listdonation."',
                                '".$connection."',
                                '".$listdonation."'
				)", $dbb1);
    
    
    
    $sqlx = mysql_query("INSERT INTO `DonationRevenue` (RandNum, School, DonorFirstName , DonorLastName , DStreetAddress, DPostal, DCity , DProvince , DCountry , DEmail , DateSubmit ,Year, Type , Trip_user_id ,Email, TripID ) VALUES (
				'".$nine_digit_random_number."' ,
                                'Canada' ,
                                '".$first_name."' ,
                                '".$last_name."' ,
                                '".$address."' ,
                                '".$postal_code."' ,
                                '".$city."' ,
                                '".$province_state."' ,
                                '".$country."' ,
                                '".$email."' ,
                                '".date("Y-m-d H:i:s")."' ,
                                '".date("Y")."' ,
                                'Donation' ,
                                '".$id."',
                                '".$email."' ,
				'".$id."' 
				
                                
				)", $dbb1);

    // Redirect to paypal IPN
    header('location:https://www.paypal.com/cgi-bin/webscr'.$querystring);
    exit();
//   echo $querystring ;
} 
   
 else {
     
   $req = 'cmd=_notify-validate';
    foreach ($_POST as $key => $value) {
        $value = urlencode(stripslashes($value));
        $value = preg_replace('/(.*[^%^0^D])(%0A)(.*)/i','${1}%0D%0A${3}',$value);// IPN fix
        $req .= "&$key=$value";
    }
    
    // assign posted variables to local variables
    $data['item_name']          = $_POST['item_name'];
    $data['item_number']        = $_POST['item_number'];
    $data['payment_status']     = $_POST['payment_status'];
    $data['payment_amount']     = $_POST['mc_gross'];
    $data['payment_currency']   = $_POST['mc_currency'];
    $data['txn_id']             = $_POST['txn_id'];
    $data['receiver_email']     = $_POST['receiver_email'];
    $data['payer_email']        = $_POST['payer_email'];
    $data['custom']             = $_POST['custom'];
        
    // post back to PayPal system to validate
    $header = "POST /cgi-bin/webscr HTTP/1.0\r\n";
    $header .= "Content-Type: application/x-www-form-urlencoded\r\n";
    $header .= "Content-Length: " . strlen($req) . "\r\n\r\n";
    
    $fp = fsockopen ('ssl://www.paypal.com', 443, $errno, $errstr, 30);
    
    if (!$fp) {
        // HTTP ERROR
        
    } else {
        fputs($fp, $header . $req);
        while (!feof($fp)) {
            $res = fgets ($fp, 1024);
            if (strcmp($res, "VERIFIED") == 0) {
              //  $sql = mysql_query("INSERT INTO `fundraiser_donors` (donor_firstname) VALUES ('PERFECT".$data['item_number']."') ", $dbb1);
                // Used for debugging
                // mail('user@domain.com', 'PAYPAL POST - VERIFIED RESPONSE', print_r($post, true));
                        
                // Validate payment (Check unique txnid &amp;amp;amp; correct price)

                // PAYMENT VALIDATED &amp;amp;amp; VERIFIED!
               //
                
                    $sql2 = mysql_query(" UPDATE  `fundraiser_donors` SET  donor_payment_status = 'COMPLETED', payment_completed_at = '".date("Y-m-d H:i:s")."'  , transaction_id = '".$data['txn_id']."'  WHERE uniqueid = '".$data['item_number']."'  ", $dbb1);
                    $sql2x = mysql_query(" UPDATE  `DonationRevenue` SET   MerchantRefID = '".$data['txn_id']."'  WHERE RandNum = '".$data['item_number']."'  ", $dbb1);

                    $uid = $_REQUEST['user_id'];
                    $tid = $_REQUEST['trip_id'];
                    $amt = intval($data['payment_amount']);
                    $ttype = $_POST["txn_type"];
                    $postvar = serialize($_POST);
                    
                    $sql2 = mysql_query(" UPDATE  `fundraiser_profiles` SET  donation_collection = (donation_collection + ".$amt." )  WHERE unique_id = '".$_GET['id']."'  ", $dbb1);
                    
                    $sql3 = mysql_query(" INSERT INTO `CMSPaypalDetails` (MerchantRefID, GrossAmount, Currency, TransactionType, PayTransactionPost , create_date ) VALUES (
				'".$data['txn_id']."' ,
                                '".$data['payment_amount']."' ,
                                '".$data['payment_currency']."' ,
                                'C' ,
                                '".$postvar."' ,
                                '".date("Y-m-d H:i:s")."' 
				)", $dbb1);
                    
                    
                    
            
            } else if (strcmp ($res, "INVALID") == 0) {
            
                // PAYMENT INVALID &amp;amp;amp; INVESTIGATE MANUALY!
                // E-mail admin or alert user
                    $sql2 = mysql_query(" UPDATE  `fundraiser_donors` SET  donor_payment_status = 'CANCELED', payment_completed_at = '".date("Y-m-d H:i:s")."'  , transaction_id = '".$data['txn_id']."'  WHERE uniqueid = '".$data['item_number']."'  ", $dbb1);

                // Used for debugging
                //@mail("user@domain.com", "PAYPAL DEBUGGING", "Invalid Response
                 //   $data ="<pre>".print_r($post, true)."</pre>" ;
            }
        }
    fclose ($fp);
    }
}
    
    
    

?>
