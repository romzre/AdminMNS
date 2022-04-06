<?php

$message = "";
if (isset($_POST['submit-register'])) 
{
    if(empty($_POST['FirstName_user']))
    {
        $messageFN = 'Votre prénom est obligatoire';
    }
    if(empty($_POST['FamilyName_user']))
    {
        $messageFaN = 'Votre nom est obligatoire';
    }
    if(empty($_POST['birthdate']))
    {
        $messageDb = 'Votre date de naissance est obligatoire';
    }
    if(empty($_POST['email_user']))
    {
        $messageEmail = 'Votre email est obligatoire';
    }
    if(empty($_POST['password_user']))
    {
        $messagePass = 'Votre mot de passe est obligatoire';
    }
    if(empty($_POST['confirm_password']))
    {
        $messageConfPass = 'Ce champ est obligatoire';
    }
    require '../templates/pages/register.tpl.php';
}
else
{
    require '../templates/pages/register.tpl.php';
    
}

