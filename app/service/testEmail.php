<?php 
require '../src/Manager/UserManager.php';

require '../PHPMailer/src/PHPMailer.php';
require '../PHPMailer/src/SMTP.php';

use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\PHPMailer;

$output ='<!DOCTYPE html>';
        $output .='<html lang="en"><head><meta charset="UTF-8"><meta http-equiv="X-UA-Compatible" content="IE=edge"><meta name="viewport" content="width=device-width, initial-scale=1.0"><title>Admin MNS</title></head>';
        $output .='<body>';
        $output .='<p>Dear user,</p>';
        $output .='<p>Please click on the following link to reset your password.</p>';
        $output .='<p>-------------------------------------------------------------</p>';
        $output .='<p><a href="51.77.211.62/?area=security&controller=security&action=resetPassword&key=&email=">Cliquez-ici</a></p>';		
        $output .='<p>-------------------------------------------------------------</p>';
        $output .='<p>Please be sure to copy the entire link into your browser.';
        $output .= 'The link will expire after 1 hour for security reason.</p>';
        $output .='<p>If you did not request this forgotten password email, no action is needed, your password will not be reset. However, you may want to log into your account and change your security password as someone may have guessed it.</p> ';  	
        $output .='<p>Thanks,</p>';
        $output .='<p>Admin MNS Team</p>';
        $output .='</body>';
        $output .='</html>';
        $body = $output; 
$subject = "TEST";

$email_to = "albrogio@gmail.com";
$fromserver = "noreply@tirepied.re"; 

$mail = new PHPMailer(true);
$mail->CharSet = 'UTF-8';
$mail->Encoding = 'base64';
    //Server settings
$mail->SMTPDebug = 4;                      //Enable verbose debug output
$mail->isSMTP();                                            //Send using SMTP
$mail->Host       = 'ssl0.ovh.net.';                     //Set the SMTP server to send through
$mail->SMTPAuth   = true;                                   //Enable SMTP authentication
$mail->Username   = 'support@tirepied.re';                     //SMTP username
$mail->Password   = 'Cljdlv1463!';                               //SMTP password
$mail->SMTPSecure = 'ssl';            //Enable implicit TLS encryption
$mail->Port       = 465;
$mail->IsHTML(true); 
$mail->From = "support@tirepied.re";
$mail->FromName = "ORGANE";
$mail->Sender = $fromserver; // indicates ReturnPath header
$mail->Subject = $subject;
$mail->Body = $body;
$mail->AddAddress($email_to);
$mail->send();