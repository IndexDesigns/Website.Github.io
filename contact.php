<?php
if (isset ($_POST['email'])) {

	// Here is the email to information
	$email_to ="jfillingham85@gmail.com";
	$email_subject ="Website Contact Form";
	$email_from ="Index Designs"

	// error code

	function died($error) {
		echo "We are are sorry, but there were error(s) found with the form you submitted.";
		echo "These errors appear below.<br/><br/>";
		echo $error. "<br/><br/>";
		echo "Please go back and fix these errors.<br/>";
		die();
	}

	// validation

	if(!isset($_POST['name'])) ||
	!isset ($_POST['email']) ||
	!isset($_POST['subject']) {
		died("We are sorry but there appears to be a problem with the from you submitted.");
	}




	$name = $_POST['name'];
	$email = $_POST['email'];
	$subject = $_POST['subject'];

	$error_message ="";
	$email_exp = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/';
	if(!preg_match($email_exp, $email)) {
		$error_message .='The Email address you entered does not appear to be valid.<br/>';
	}

	$string_exp = "/^[A-Za-z.'-]+$/";
	if(!preg_match($string_exp, $name)) {
		$error_message .= 'The name you entered does not appear to be valid.<br/>';
	}

	if(strlen($subject) < 2) {
		$error_message .= 'The subject you entered does not appear to be valid.<br/>'
	}

	if(strlen($error_message) > 0) {
		died($error_message);
	}

	$email_message = "Form Details below.\n\n";

	function clean_string($string) {
		$bad = array("content-type", "bcc:", "to:", "cc:", "href:");
		return str_replace($bad, "", $string);
	}

	$email_message .= "Name:" . clean_string($name) . "\n";
	$email_message .= "Email:" . clean_string($email) . "\n";
	$email_message .= "Subject:" . clean_string($subject) . "\n";

	// create email headers
	$header = 'From: ' .$email_From . "\r\n". 'Reply-To:' . $email. "\r\n" . 'X-Mailer: PHP/' . phpversion(); @mail($email_to, $email_subject, $email_message, $headers);

?>

<!-- success message goes here-->
Thank you for contacting us. We will be in touch with you shortly. <br/>
Please click <a href="index.html">here</a> to go back to the home page.


<?php
	}
?>