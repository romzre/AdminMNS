<?php
require '../src/Manager/UserManager.php';

require '../PHPMailer/src/PHPMailer.php';
require '../PHPMailer/src/SMTP.php';

use App\Manager\UserManager;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\PHPMailer;
use App\Manager\PasswordResetManager;


//on vérifie le champ du mail
$email = (!empty($_POST['email'])) ? $_POST['email'] : null;

if (!$email) {
    $message = 'Merci de renseigner votre email !';
} else {
    //on vérifier l'existence de l'utilisateur avec son email
    $manager = new UserManager();
    $user = $manager->getUserByEmail($email);

    if (!$user) {
        $messageErrorEmail = '<p>L\'adresse email indiquée n\'est associée à aucun compte !</p>';
    } else {
        date_default_timezone_set('Europe/Paris');
        $expFormat = mktime(
            date("H") + 1,
            date("i"),
            date("s"),
            date("m"),
            date("d"),
            date("Y")
        );
        $expDate = date("Y-m-d H:i:s", $expFormat); // on récupère la date d'expiration de la clé en faisant la date et l'heure actuelle + 1h
        $key = bin2hex(random_bytes(32)); //genere un tolken de 32 caractères

        // on insère le tolken unique,  la date d'expiration et l'email de user dans la table password-reset-temp 
        require '../src/Manager/PasswordResetManager.php';
        $passwordResetManager = new PasswordResetManager();
        $passwordResetManager->createPasswordResetTemp($email, $key, $expDate);


        //partie à mettre en place avec PHPMailer
        $output = '<!DOCTYPE html>';
        $output .= '<html lang="en"><head><meta charset="UTF-8"><meta http-equiv="X-UA-Compatible" content="IE=edge"><meta name="viewport" content="width=device-width, initial-scale=1.0"><title>Admin MNS</title></head>';
        $output .= '<style>body{width:100%;height=100%;padding=12px;backgound-color:#151B36;color:#fff;}</style>';
        $output .= '<body>';
        $output .= '<p>Cher.e utilisateur.rice,</p>';
        $output .= '<p>Merci de cliquer sur le lien suivant pour réinitialiser votre mot de passePlease click on the following link to reset your password.</p>';
        $output .= '<p>-------------------------------------------------------------</p>';
        $output .= '<p><a href="admin.tirepied.re/?area=security&controller=security&action=resetPassword&key=' . $key . '&email=' . $email . '">Cliquez-ici</a></p>';
        $output .= '<p>-------------------------------------------------------------</p>';
        $output .= "<p>ou de copier coller l'intégalité du lien dans votre barre de recherche";
        $output .= 'Pour des raisons de sécurité, le lien expirera dans une heure</p>';
        $output .= "<p>Si vous n'êtes pas à l'origine de cette demande de réinitialisation, aucune action n'est nécessaire, votre mot de passe ne sera pas réinitialisé. Cependant, nous vous conseillons de vous connecter à votre compte et de modifier votre mot de passe car celui-ci est peut être compromis</p> ";
        $output .= '<p>Merci,</p>';
        $output .= "<p>L'équipe Admin MNS</p>";
        $output .= '</body>';
        $output .= '</html>';
        $body = $output;
        $subject = "Réinitialisation de votre mot de passe - Admin MNS";

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

        if (!$mail->Send()) {
            echo "Mailer Error: " . $mail->ErrorInfo;
        } else {
            $success = '<p>Un email vous a été envoyé avec les instructions pour réinitialiser votre mot de passe.</p>';
        }
    }
}
