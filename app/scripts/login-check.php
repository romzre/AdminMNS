<?php 
//on vérifie le champ du mail
$email = !empty($_POST['email']) ? $_POST['email']:null;
if(!$email)
{
    header('Location: ./?page=login&email_error');
    exit;
}

//on vérifie le champ du password
$password = !empty($_POST['password'])?$_POST['password']:null;

if(!$password)
    {
        header('Location: ./?page=login&password_error');
        exit;
    }
//connexion BDD
require 'includes/dbConnect.php';

//Récupération de l'utilisateur depuis la BDD

$sql = "SELECT * from user WHERE email= '".$email."';";

$res= mysqli_query($mysqli, $sql);
$user= mysqli_fetch_assoc($res);


//on vérifier l'existance de l'utilisateur
if(!$user)
{
    header('Location: login.php?error_account');
    exit;
}

//on vérifie le mot de passe
if($user['password']!==$password)
{
    header('Location: login.php?error_account');
    exit;

}
//on ouvre une session et on stock le user_id
session_start();
$_SESSION['user_id'] = $user['id'];
$_SESSION['is_admin'] = $user['is_admin'];

if ($user['is_admin']==1)
{
    header('Location: ./admin/index.php');
}
else{
    header('Location: ./user/index.php');
}