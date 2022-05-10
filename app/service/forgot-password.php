<?php 
require '../src/Manager/UserManager.php';

require '../PHPMailer/src/PHPMailer.php';
require '../PHPMailer/src/SMTP.php';
use App\Manager\UserManager;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\PHPMailer;
use App\Manager\PasswordResetManager;


//on vérifie le champ du mail
$email = (!empty($_POST['email']) )? $_POST['email']:null;

if(!$email)
{
    $message = 'Merci de renseigner votre email !' ;
}
else
{
    //on vérifier l'existence de l'utilisateur avec son email
    $manager = new UserManager();
    $user = $manager->getUserByEmail($email);

    if(!$user)
    {
        $messageErrorEmail = '<p>L\'adresse email indiquée n\'est associée à aucun compte !</p>';
    }
    else 
    {
        date_default_timezone_set('Europe/Paris');
        $expFormat = mktime(
        date("H")+1, date("i"), date("s"), date("m") ,date("d"), date("Y")
        );
        $expDate = date("Y-m-d H:i:s",$expFormat); // on récupère la date d'expiration de la clé en faisant la date et l'heure actuelle + 1h
        $key = bin2hex(random_bytes(32)); //genere un tolken de 32 caractères

        // on insère le tolken unique,  la date d'expiration et l'email de user dans la table password-reset-temp 
        require '../src/Manager/PasswordResetManager.php';
        $passwordResetManager = new PasswordResetManager();
        $passwordResetManager->createPasswordResetTemp($email,$key,$expDate);
        $success .= '<p>An email has been sent to you with instructions on how to reset your password.</p>';
        
        //partie à mettre en place avec PHPMailer
        $output ='<!DOCTYPE html>';
        $output .='<html lang="en"><head><meta charset="UTF-8"><meta http-equiv="X-UA-Compatible" content="IE=edge"><meta name="viewport" content="width=device-width, initial-scale=1.0"><title>Admin MNS</title></head>';
        $output .='<body>';
        $output .='<p>Dear user,</p>';
        $output.='<p>Please click on the following link to reset your password.</p>';
        $output.='<p>-------------------------------------------------------------</p>';
        $output.='<p><a href="51.77.211.62/?area=security&controller=security&action=resetPassword&key="'.$key.'&email='.$email.'>Cliquez-ici</a></p>';		
        $output.='<p>-------------------------------------------------------------</p>';
        $output.='<p>Please be sure to copy the entire link into your browser.';
        $output.= 'The link will expire after 1 hour for security reason.</p>';
        $output.='<p>If you did not request this forgotten password email, no action is needed, your password will not be reset. However, you may want to log into your account and change your security password as someone may have guessed it.</p> ';  	
        $output.='<p>Thanks,</p>';
        $output.='<p>Admin MNS Team</p>';
        $output .='</body>';
        $output .= '<style>body{width:100%;height=100%;padding=12px;backgound-color:#151B36;color:#fff;}</style>';
        $output .='</html>';
        $body = $output; 
        $subject = "Password Recovery - Admin MNS";
        
        $email_to = $email;
        $fromserver = "noreply@adminmns.com"; 
        
        $mail = new PHPMailer(true);
        $mail->CharSet = 'UTF-8';
        $mail->Encoding = 'base64';
            //Server settings
        $mail->SMTPDebug = 0;                      //Enable verbose debug output
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host       = 'ssl0.ovh.net.';                     //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mail->Username   = 'support@tirepied.re';                     //SMTP username
        $mail->Password   = 'Cljdlv1463!';                               //SMTP password
        $mail->SMTPSecure = 'ssl';            //Enable implicit TLS encryption
        $mail->Port       = 465;
        $mail->IsHTML(true);
        $mail->From = "support@tirepied.re";
        $mail->FromName = "Admin MNS";
        $mail->Sender = $fromserver; // indicates ReturnPath header
        $mail->Subject = $subject;
        $mail->Body = $body;
        $mail->AddAddress($email_to);
        $mail->send();

        if(!$mail->Send())
        {
            echo "Mailer Error: " . $mail->ErrorInfo;
        }
        else
        {
            $success = '<p>An email has been sent to you with instructions on how to reset your password.</p>';
        }
            
        // catch (throw Exception $e)
        // {
        //     echo "Message could not be sent. Mailer Error: . $mail->ErrorInfo";
        // }
        // require("PHPMailer/PHPMailerAutoload.php");
        // $mail = new PHPMailer();
        // $mail->IsSMTP();
        // $mail->Host = "mail.yourwebsite.com"; // Enter your host here
        // $mail->SMTPAuth = true;
        // $mail->Username = "noreply@yourwebsite.com"; // Enter your email here
        // $mail->Password = "password"; //Enter your password here
        // $mail->Port = 25;
        // $mail->IsHTML(true);
        // $mail->From = "noreply@yourwebsite.com";
        // $mail->FromName = "AllPHPTricks";
        // $mail->Sender = $fromserver; // indicates ReturnPath header
        // $mail->Subject = $subject;
        // $mail->Body = $body;
        // $mail->AddAddress($email_to);
        // if(!$mail->Send())
        // {
        //     echo "Mailer Error: " . $mail->ErrorInfo;
        // }
        // else
        // {
        //     $success = '<p>An email has been sent to you with instructions on how to reset your password.</p>';
        // }
    }   

}








