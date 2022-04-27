<?php 
require '../src/Manager/UserManager.php';

//on vérifie le champ du mail
$email = !empty($_POST['email']) ? $_POST['email']:null;


if(!$email)
{
    header('Location: ./?controller=security&email_error');
    exit;
}

//on vérifie le champ du password
$password = !empty($_POST['password'])?$_POST['password']:null;

if(!$password)
    {
        header('Location: ./?controller=security&password_error');
        exit;
    }


//on vérifier l'existence de l'utilisateur

$manager = new UserManager();
$user = $manager->getUserByEmail($email);

if(!$user)
{
    header('Location: ./?controller=security&error_account');
    exit;
}

//on vérifie le mot de passe

if(!password_verify($password, $user['password']))

{
    header('Location: ./?controller=security&error_account');
    exit;

}

//on ouvre une session et on stock l'id_user
session_start();
$id_user = $user['id_user'];
$_SESSION['id_user'] = $id_user;

//on vérifie si l'utilisateur est un admin
require_once '../src/Manager/AdminManager.php';
$adminManager = new AdminManager();
$admin=$adminManager->get($id_user);

if ($admin)
{
    header('Location: /?controller=admin');
}
else{
    require '../src/Manager/TraineeManager.php';

    //on vérifie si le user est un stagiaire ou un candidat et en fonction en le redirige sur le bon espace
    $traineeManager = new TraineeManager();
    $completeDossier = $traineeManager->checkCompleteDossier($id_user);

    if(!$completeDossier)
    {
        header('Location: ./?controller=candidate');
    }
    //on vérifie qu'il est candidat
    $isRegistered=$traineeManager->isRegistered($id_user);
    if(!$isRegistered)
    {
        header('Location: ./?controller=trainee');
    }
    
}