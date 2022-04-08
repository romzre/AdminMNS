<?php session_start();?>
<?php require '../app/Manager/UserManager.php';
require '../app/Manager/TraineeManager.php';

$traineeManager=new TraineeManager();
$trainee=$traineeManager->getAllInfos('69');

require '../templates/pages/dashboard-trainee.tpl.php'; ?>