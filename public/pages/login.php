<?php require '../templates/pages/login.tpl.php';

if (isset($_POST['submit'])) 
{
    require '../app/service/login-check.php';
}

