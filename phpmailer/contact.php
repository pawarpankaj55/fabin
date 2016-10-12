<?php

//SMTP needs accurate times, and the PHP time zone MUST be set
//This should be done in your php.ini, but this is how to do it if you don't have access to that
date_default_timezone_set('Etc/UTC');

require 'PHPMailerAutoload.php';


// Email address verification
function isEmail($email) {
	return filter_var($email, FILTER_VALIDATE_EMAIL);
}

if($_POST) {

    // Enter the email where you want to receive the message


	//Create a new PHPMailer instance
	$mail = new PHPMailer();
	//Tell PHPMailer to use SMTP
	$mail->isSMTP();
	//Enable SMTP debugging
	// 0 = off (for production use)
	// 1 = client messages
	// 2 = client and server messages
	//$mail->SMTPDebug = 2;
	//Ask for HTML-friendly debug output
	//$mail->Debugoutput = 'html';
	//Set the hostname of the mail server
	$mail->Host = "smtp.gmail.com";

	//enable this if you are using gmail smtp, for mandrill app it is not required
	$mail->SMTPSecure = 'tls';                            

	//Set the SMTP port number - likely to be 25, 465 or 587
	$mail->Port = 25;
	//Whether to use SMTP authentication
	$mail->SMTPAuth = true;
	//Username to use for SMTP authentication
	$mail->Username = "PAWARPANKAJ55@GMAIL.COM";
	//Password to use for SMTP authentication
	$mail->Password = "pa9028871812";

    //$emailTo = 'pawarpankaj55@gmail.com';

    $name = addslashes(trim($_POST['name']));
    $clientEmail = addslashes(trim($_POST['email']));
    $subject = addslashes(trim($_POST['subject']));
    $message = addslashes(trim($_POST['message']));

    $array = array('nameMessage' => '', 'emailMessage' => '', 'subjectMessage' => '', 'messageMessage' => '');

    if($name == '') {
    	$array['nameMessage'] = 'Empty name!';
    }
    if(!isEmail($clientEmail)) {
        $array['emailMessage'] = 'Invalid email!';
    }
    if($subject == '') {
        $array['subjectMessage'] = 'Empty subject!';
    }
    if($message == '') {
        $array['messageMessage'] = 'Empty message!';
    }

	//Set who the message is to be sent from
	$mail->setFrom($clientEmail, 'Pankaj Pawar');
	//Set an alternative reply-to address
	$mail->addReplyTo($clientEmail, 'Reply-to Name');
	//Set who the message is to be sent to
	$mail->addAddress('pawarpankaj55@gmail.com', 'Pankaj Pawar');
	//Set the subject line
	$mail->Subject = 'Send mail from localhost';

	$mail->Body = 'Hello, this is my message '.$message;
	//Read an HTML message body from an external file, convert referenced images to embedded,
	//convert HTML into a basic plain-text alternative body
	//$mail->msgHTML(file_get_contents('contents.html'), dirname(__FILE__));
	//Replace the plain text body with one created manually
	//$mail->AltBody = 'This is a plain-text message body';
	//Attach an image file
	//$mail->addAttachment('images/phpmailer_mini.png');


    if($name != '' && isEmail($clientEmail) && $subject != '' && $message != '') {		
		$mail->send();
    }
	echo json_encode($array);
}

?>
