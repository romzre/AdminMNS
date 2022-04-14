<?php
require '../app/Manager/TraineeManager.php';
$manager = new TraineeManager();

$registered = $manager->getAllRegistered();
