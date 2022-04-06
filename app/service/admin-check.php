<?php

session_start();

// Vérification qu'un utilisateur est bien connecté
if(!isset($_SESSION['id_user']))
{
    header('Location: /');
    exit;
}
// Vérification que l'utilisateur est bien un administrateur
if($_SESSION['is_admin']!==1)
{
    header('Location: /?page=dashboard-trainee');
    exit;
}
