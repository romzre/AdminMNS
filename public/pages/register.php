<?php
require '../app/Entity/Form.php';

$form = new Form();
$users = $form->getUsers();
var_dump($users); exit;

$message = "";
if (isset($_POST['submit'])) 
{
    var_dump($_POST); exit;
}


require '../templates/pages/register.tpl.php';