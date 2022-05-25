<?php 

require '../PHPMailer/src/PHPMailer.php';
require '../PHPMailer/src/SMTP.php';
use App\Manager\UserManager;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\PHPMailer;
use App\Manager\PasswordResetManager;


//on vérifie le champ du mail

    //on vérifier l'existence de l'utilisateur avec son email
    $manager = new UserManager();
    $user = $manager->getUserById($id);
    $email = $user->getEmail();
    if(!$user)
    {
        $messageErrorEmail = '<p>L\'adresse email indiquée n\'est associée à aucun compte !</p>';
    }
    else 
    {
        date_default_timezone_set('Europe/Paris');
        
        
        //partie à mettre en place avec PHPMailer
        $output ='<!DOCTYPE html>';
        $output .='<html lang="en"><head><meta charset="UTF-8"><meta http-equiv="X-UA-Compatible" content="IE=edge"><meta name="viewport" content="width=device-width, initial-scale=1.0"><title>Admin MNS</title></head>';
        $output .='<body>';
        $output .='<p>Dear user,</p>';
        $output.='<p>Please click on the following link to reset your password.</p>';
        $output.='<p>-------------------------------------------------------------</p>';
        $output.='<p>'.$message.'</p>';		
        $output.='<p>-------------------------------------------------------------</p>'; 
        $output.='<p>Merci de faire le nécessaire,</p>';
        $output.='<p>Admin MNS Team</p>';
        $output .='</body>';
        $output .='</html>';
        $body = $output; 
        $subject = "Document invalidé - Admin MNS";
        
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
            $stmtMsg = '<p>Le document a bien été invalidé</p>';
            
        }
            
        
    }   








