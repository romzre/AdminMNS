<?php
$samePass = true;
// $message = "";
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
    
    $array_input = extract($_POST,EXTR_PREFIX_SAME, 'mns_');
    require '../templates/pages/register.tpl.php';
}
else
{
    require '../templates/pages/register.tpl.php';
    
}

