<?php 

use App\Manager\UserManager;
use App\Manager\AdminManager;
use App\Manager\TraineeManager;


//on vérifie le champ du mail
$email = !empty($_POST['email']) ? $_POST['email']:null;
echo $email;

if(!$email)
{
    header('Location: ./?area=security&controller=security&email_error');
    exit;
}

//on vérifie le champ du password
$password = !empty($_POST['password'])?$_POST['password']:null;

if(!$password)
    {
        header('Location: ./?area=security&controller=security&password_error');
        exit;
    }


//on vérifier l'existence de l'utilisateur

$manager = new UserManager();
$user = $manager->getUserByEmail($email);


if(!$user)
{
    header('Location: ./?area=security&controller=security&error_account');
    exit;
}

//on vérifie le mot de passe

if(!password_verify($password, $user['password']))

{
    header('Location: ./?area=security&controller=security&error_account');
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
    header('Location: /?area=admin&controller=home');
}
else{
   

    //on vérifie si le user est un stagiaire ou un candidat et en fonction en le redirige sur le bon espace
    $traineeManager = new TraineeManager();
    $completeDossier = $traineeManager->checkCompleteDossier($id_user);

    if($completeDossier)
    {
        header('Location: ./?area=trainee&controller=home');
    }
    //on vérifie qu'il est candidat
    $isRegistered=$traineeManager->isRegistered($id_user);
    
    if($isRegistered)
    {
        header('Location: ./?area=candidate&controller=home');
    }
    
}