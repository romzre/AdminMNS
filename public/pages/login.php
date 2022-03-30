<?php require '../templates/pages/login.tpl.php';

if ($_POST['submit']) 
{
    var_dump($_POST);
    require '../app/service/login-check.php';
}