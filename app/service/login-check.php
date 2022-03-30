<?php 
require '../app/Manager/UserManager.php';

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


//on vérifier l'existance de l'utilisateur

$manager = new UserManager();
$user=$manager->get($email);
var_dump($user);exit;

if(!$user)
{
    header('Location: ./?page=login&error_account');
    exit;
}

//on vérifie le mot de passe
if($user['password']!==$password)
{
    header('Location: ./?page=login&error_account');
    exit;

}
//on ouvre une session et on stock le user_id
session_start();
$_SESSION['user_id'] = $user['id'];
$_SESSION['is_admin'] = $user['is_admin'];

// if ($user['is_admin']==1)
// {
//     header('Location: ./admin/index.php');
// }
// else{
    header('Location: ./?page=dashboard');
