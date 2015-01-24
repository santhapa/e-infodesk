
<?php

//SMTP needs accurate times, and the PHP time zone MUST be set
//This should be done in your php.ini, but this is how to do it if you don't have access to that
date_default_timezone_set('Etc/UTC');


//Create a new PHPMailer instance
$mail = new PHPMailer();

$mail->IsSMTP();
 $mail->Port       = 25;
//Tell PHPMailer to use SMTP
        
        
$mail->SetFrom(constant("mailFrom"), 'eInfoDesk Team');
$mail->AddReplyTo(constant("mailReplyTo"), $_SESSION['userFName']);
//Set who the message is to be sent to
$mail->AddAddress('san.loggingin@gmail.com', 'You');
//Set the subject line
$mail->Subject = 'Testing';
//Read an HTML message body from an external file, convert referenced images to embedded, convert HTML into a basic plain-text alternative body
$mail->MsgHTML("Hello I am testing");
//Replace the plain text body with one created manually
$mail->AltBody = 'This is a plain-text message body';
//Attach an image file
//$mail->AddAttachment('images/phpmailer_mini.gif');

//Send the message, check for errors
if(!$mail->Send()) {
  echo "Mailer Error: " . $mail->ErrorInfo;
} else {
  echo "Message sent!";
}
?>