<?php

$message = "";
if (isset($_POST['submit-register'])) 
{
    var_dump($_POST); exit;
}


require '../templates/pages/register.tpl.php';