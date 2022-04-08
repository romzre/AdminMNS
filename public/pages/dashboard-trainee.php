<?php session_start();?>
<?php require '../app/Manager/UserManager.php';
require '../app/Manager/TraineeManager.php';

$traineeManager=new TraineeManager();
$trainee=$traineeManager->getAllInfos($_SESSION['id_user']);


require '../templates/pages/dashboard-trainee.tpl.php'; ?>