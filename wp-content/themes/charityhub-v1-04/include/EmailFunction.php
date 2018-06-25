<?php
//Email function with standard HTML that puts SOS logo , facebook and twitter icon in the message part
require_once(dirname(__FILE__) . '/PHPMailer_v2.0.4/class.phpmailer.php');
require_once(dirname(__FILE__) . '/../../../../wp-config.php');
function EmailHTMLFunction($replyEmail, $fromName, $toEmail, $toName, $subject, $message) 
{
	$htmlStyleTop = '
	<center>
    <table cellspacing="0" cellpadding="0" border="1" 
    style="width:500pt;border-top:6.0pt;border-left:1.0pt;border-bottom:4.5pt;border-right:1.0pt;border-color:#999999;border-style:solid; margin-left:auto; margin-right:auto;">
    <tr>
    <td style="border:none;padding:11.25pt 11.25pt 11.25pt 11.25pt">
    <p class="MsoNormal" style="line-height:13.5pt">
    <span style="font-size:9.0pt;font-family:"Verdana"><center>
    <img src="http://www.studentsofferingsupport.ca/portal/images/newLOGO.jpg"></center>
    <u></u>
    <u></u>
    </span>
    </p>';

    $htmlStyleBottom = '
    <div style = "height:40px"></div>
    <div align="right">
    Follow us!&nbsp;&nbsp;&nbsp;&nbsp;
    <br/>
    <a href = "https://www.facebook.com/StudentsOfferingSupport">
    <img src="http://www.studentsofferingsupport.ca/portal/images/facebook-icon1_opt.png" height = "40px" width = "40px"></a>
    <a href = "https://twitter.com/SOSheadoffice">
    <img src="http://www.studentsofferingsupport.ca/portal/images/twittericon_opt.png" height = "40px" width = "40px"></a>
    </div>
    </td>
    </tr>
    </table>
    </center>';

	$mail = new PHPMailer();
			
	$mail->IsSMTP();                                      // set mailer to use SMTP
	//$mail->Host = "localhost";
        $mail->Host = "64.15.159.85";
	$mail->SMTPAuth = true;     // turn on SMTP authentication
	$mail->Username = "info@studentsofferingsupport.ca";  // SMTP username
	$mail->Password = "MailerMars@2012!."; // SMTP password
	$mail->Priority=1;
		
	$mail->From = "info@studentsofferingsupport.ca";
	$mail->FromName = $fromName;
	$mail->AddAddress($toEmail);
	$mail->AddReplyTo($replyEmail);
		
	$mail->WordWrap = 90;                                 // set word wrap to 90 characters
	$mail->IsHTML(true);                                  // set email format to HTML
	$mail->Subject = $subject;
	
	$check_query = mysql_query("SELECT * FROM wp_users WHERE user_email = '".$toEmail."'");
	if (mysql_num_rows($check_query) > 0){
		$check = mysql_fetch_array($check_query);
		$subscribe = $check['Subscribe'];
	}
	else{
		$subscribe = 0;
	}
	if ($subscribe == 1){
		$email = urlencode($toEmail);
		$message .= "
		<br>
		<a href = 'http://www.soscampus.com/wp-content/themes/sos/cgi-bin/handle-unsubscribe.php?email=".$email."&subscribe=1'>
		Unsubscribe from all newsletters and notifications of upcoming volunteer openings, Exam-AIDs, and trips.</a>";
	}
	$message .= 
	"<br>326 1/2 Bloor Street W.<br>
	Toronto, Ontario<br>
	M5S 1W5";
	
   	$mail->Body = $htmlStyleTop.$message.$htmlStyleBottom;
    
	$mail->Send();
	
	sleep(3);
	
}
?>