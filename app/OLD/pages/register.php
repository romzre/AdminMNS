<?php
$samePass = true;
$message = NULL;
$email = NULL;
if (isset($_POST['submit-register'])) 
{ 

    if($_POST['password'] === $_POST['confirm_password'])

    {
        require '../app/service/register-check.php';
        require '../templates/pages/register-sucess.tpl.php';
    }
    else
    {
        $samePass = false;
        $message = "Les mots de passes ne sont pas identiques";
       
    }   

   
}
else
{
    require '../templates/pages/register.tpl.php';
    
}

