<?php
$samePass = true;
$message = NULL;

if (isset($_POST['submit-register'])) 
{ 
    if($_POST['password_user'] === $_POST['confirm_password'])
    {
        require '../app/service/register-check.php';
    }
    else
    {
        $samePass = false;
        $msg = "Les mots de passes ne sont pas identiques";
    }   
    if($reqRegister)
    {
        $message = "Votre demande d'inscription a bien été pris en compte. Un email vous sera envoyé dés que votre espace sera disponible.";
    }
    else
    {
        $message = "Une erreur est survenu lors de votre inscription. Veuillez renouvelez l'opération.";
    }    
    $array_input = extract($_POST,EXTR_PREFIX_SAME, 'mns_');
    require '../templates/pages/register.tpl.php';
}
else
{
    require '../templates/pages/register.tpl.php';
    
}

