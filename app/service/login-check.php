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


//on vérifier l'existence de l'utilisateur

$manager = new UserManager();
$user = $manager->getUserByEmail($email);

if(!$user)
{
    header('Location: ./?page=login&error_account');
    exit;
}

//on vérifie le mot de passe

if(!password_verify($password, $user['password']))

{
    header('Location: ./?page=login&error_account');
    exit;

}
//on ouvre une session et on stock l'id_user
session_start();
$id_user = $user['id_user'];
$_SESSION['id_user'] = $id_user;

//on vérifie si l'utilisateur est un admin
require_once '../app/Manager/AdminManager.php';
$adminManager = new AdminManager();
$admin=$adminManager->get($id_user);

if ($admin)
{
    header('Location: /?page=admin');
}
else{
    require '../app/Manager/TraineeManager.php';

    //on vérifie si le user est un stagiaire ou un candidat et en fonction en le redirige sur le bon espace
    $traineeManager = new TraineeManager();
    $completeDossier=$traineeManager->checkCompleteDossier($id_user);

    if(!$completeDossier)
    {
        header('Location: ./?page=dashboard-candidate');
    }
    else {
        header('Location: ./?page=dashboard-trainee');
    }
    
}