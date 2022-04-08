<?php

session_start();

// Vérification qu'un utilisateur est bien connecté
if(!isset($_SESSION['id_user']))
{
    header('Location: /');
    exit;
} 
else 
// Vérification que l'utilisateur est bien un administrateur 
{
    require_once '../app/Manager/AdminManager.php';
    $adminManager=new AdminManager();
    $admin=$adminManager->get($_SESSION['id_user']);

    if(!$admin){
        header('Location: /');
        exit;
    }

}
