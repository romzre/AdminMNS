<?php 
require '../app/Manager/UserManager.php';
require '../app/Manager/AdminManager.php';

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


//on vérifier l'existence de l'utilisateur

$manager = new UserManager();
$user = $manager->getByEmail($email);
if(!$user)
{
    header('Location: ./?page=login&error_account');
    exit;
}

//on vérifie le mot de passe
if($user['password_user']!==$password)
// if(!password_verify($password, $user['password_user']) // à intégrer lorsqu'on aura hacher les mdp
{
    header('Location: ./?page=login&error_account');
    exit;

}
//on ouvre une session et on stock l'id_user
session_start();
$id_user = $user['id_user'];
$_SESSION['id_user'] = $id_user;

//on vérifie si l'utilisateur est un admin
$adminManager = new AdminManager();
$admin=$adminManager->get($id_user);


if ($admin)
{
    $_SESSION['is_admin'] = 1;
    header('Location: /?page=admin');
}
else{
    $_SESSION['is_admin'] = 0;
    header('Location: ./?page=dashboard-trainee');
}