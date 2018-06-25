<?php
	$name = $_POST['name'];
	$email = $_POST['email'];
	$ContactEmail = $_POST['ContactEmail'];
	$message = $_POST['message'];
	$subject = "Outreach Trip Donation Inquiry from " . $name;

	$headers = 'From: ' . $email . "\r\n" .
    'Reply-To: ' . $email . "\r\n" .
    'X-Mailer: PHP/' . phpversion();

    if(mail($ContactEmail, $subject, $message, $headers)) {
		echo json_encode("Email sent succesfully.");
	}
	else {
		echo json_encode("Email failed to send.");
	}
?>