<?php session_start();?>
<?php require '../app/Manager/UserManager.php';

$userManager = new UserManager();
$user=$userManager->getByUserId($_SESSION['id_user']);

require '../templates/pages/dashboard-trainee.tpl.php'; ?>