<?php
//Created by: Lucille Hua
//Customize the original email function to satify specific needs

require_once(PORTAL_PATH. '/include/PHPMailer_v2.0.4/class.phpmailer.php');
require_once (PORTAL_PATH . '/include/SingleRowQuery.php');
require_once (PORTAL_PATH . '/include/Select.php');
require_once(PORTAL_PATH . '/Communication/functions.php');
require_once(PORTAL_PATH. '/include/PHPMailer_v2.0.4/class.phpmailer.php');

function EmailThreeFunction($fromEmail, $fromName, $toEmail, $toName, $fromEmail, $fromName, $address,$CC, $subject, $message) 
{
	
	$mail = new PHPMailer();
			
	$mail->IsSMTP();                                      // set mailer to use SMTP
	$mail->Host = "localhost";
	$mail->SMTPAuth = true;     // turn on SMTP authentication
	$mail->Username = "info@studentsofferingsupport.ca";  // SMTP username
	$mail->Password = "MailerMars@2012!."; // SMTP password
	$mail->Priority=1;
		
	$mail->From = $fromEmail;
	$mail->FromName = $fromName;
	$mail->AddAddress($toEmail);
	$mail->AddAddress($address);
	$mail->AddAddress($CC);
	$mail->AddReplyTo($fromEmail);
		
	$mail->WordWrap = 90;                                 // set word wrap to 90 characters
	$mail->IsHTML(true);                                  // set email format to HTML
	$mail->Subject = $subject;
		
	$mail->Body = $message;
		
	$mail->Send();
	
	sleep(3);
	
}

function EmailTwoFunction($fromEmail, $fromName, $toEmail, $toName, $fromEmail, $fromName,$CC, $subject, $message) 
{
	
	$mail = new PHPMailer();
			
	$mail->IsSMTP();                                      // set mailer to use SMTP
	$mail->Host = "localhost";
	$mail->SMTPAuth = true;     // turn on SMTP authentication
	$mail->Username = "info@studentsofferingsupport.ca";  // SMTP username
	$mail->Password = "MailerMars@2012!."; // SMTP password
	$mail->Priority=1;
		
	$mail->From = $fromEmail;
	$mail->FromName = $fromName;
	$mail->AddAddress($toEmail);
	$mail->AddAddress($CC);
	$mail->AddReplyTo($fromEmail);
		
	$mail->WordWrap = 90;                                 // set word wrap to 90 characters
	$mail->IsHTML(true);                                  // set email format to HTML
	$mail->Subject = $subject;
		
	$mail->Body = $message;
		
	$mail->Send();
	
	sleep(3);
	
}
//Gets the administrators' email address and form a loop to add CC to the specific email. 
//$sqlQuery should be a Query
//$parameters should be the column in the query that specifies the email address. It must have a single quote before and after the column name
//$CC should be zero if it does not have a specific email address assigned to 
function EmailAdministratorsFunction($fromEmail, $fromName, $toEmail, $toName, $fromEmail, $fromName, $sqlQuery, $CC, $subject, $message) 
{
	
	$mail = new PHPMailer();
			
	$mail->IsSMTP();                                      // set mailer to use SMTP
	$mail->Host = "localhost";
	$mail->SMTPAuth = true;     // turn on SMTP authentication
	$mail->Username = "info@studentsofferingsupport.ca";  // SMTP username
	$mail->Password = "MailerMars@2012!."; // SMTP password
	$mail->Priority=1;
		
	$mail->From = $fromEmail;
	$mail->FromName = $fromName;
	$mail->AddAddress($toEmail);
	while($Row = mysql_fetch_assoc($sqlQuery))
	{
		$address = $Row['PrimaryEmail'];
		$mail->AddAddress($address);
	}
	if($CC!='0')
	{
		$mail->AddAddress($CC);
	}
	$mail->AddReplyTo($fromEmail);
		
	$mail->WordWrap = 90;                                 // set word wrap to 90 characters
	$mail->IsHTML(true);                                  // set email format to HTML
	$mail->Subject = $subject;
		
	$mail->Body = $message;
		
	$mail->Send();
	
	sleep(3);
	
}


//Email function with standard HTML that puts SOS logo , facebook and twitter icon in the message part
function EmailWithHTMLFunction($fromEmail, $fromName, $toEmail, $toName, $subject, $message) 
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
	$mail->Host = "localhost";
	$mail->SMTPAuth = true;     // turn on SMTP authentication
	$mail->Username = "info@studentsofferingsupport.ca";  // SMTP username
	$mail->Password = "MailerMars@2012!."; // SMTP password
	$mail->Priority=1;
		
	$mail->From = $fromEmail;
	$mail->FromName = $fromName;
	$mail->AddAddress($toEmail);
	$mail->AddReplyTo($fromEmail);
		
	$mail->WordWrap = 90;                                 // set word wrap to 90 characters
	$mail->IsHTML(true);                                  // set email format to HTML
	$mail->Subject = $subject;
	
   	$mail->Body = $htmlStyleTop.$message.$htmlStyleBottom;
    
	$mail->Send();
	
	sleep(3);
	
}
?>