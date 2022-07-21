<?php

use App\Manager\AdminManager;

session_start();

// Check if the user is connecter
if(!isset($_SESSION['id_user']))
{
    header('Location: /');
    exit;
} 
else 
// Check if the user is an admib
{
    
    $adminManager=new AdminManager();
    $admin=$adminManager->get($_SESSION['id_user']);

    if(!$admin){
        header('Location: /');
        exit;
    }

}
