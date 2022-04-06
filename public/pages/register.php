<?php

$message = "";
if (isset($_POST['submit-register'])) 
{
   
    $array_input = extract($_POST,EXTR_PREFIX_SAME, 'mns_');

    require '../templates/pages/register.tpl.php';
}
else
{
    require '../templates/pages/register.tpl.php';
    
}

