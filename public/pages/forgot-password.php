<?php 
$message = '';
$messageErrorEmail = '';
$success ='';

if (isset($_POST['submit'])) 
{
    require '../app/service/forgot-password.php';
}

require '../templates/pages/forgot-password.tpl.php';
