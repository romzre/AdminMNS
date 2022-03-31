<?php

$message = "";
if (isset($_POST['submit'])) 
{
    var_dump($_POST); exit;
}


require '../templates/pages/register.tpl.php';