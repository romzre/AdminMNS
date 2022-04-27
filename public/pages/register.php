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
<<<<<<< HEAD
        $msg = "Les mots de passes ne sont pas identiques";
        $array_input = extract($_POST,EXTR_PREFIX_SAME,'mns_');
        require '../templates/pages/register.tpl.php';
=======
        $message = "Les mots de passes ne sont pas identiques";
>>>>>>> a5ad38d70cf6a9c5f1bdfa57597e1a8ed0c55adf
       
    }   

   
}
else
{
    require '../templates/pages/register.tpl.php';
    
}

