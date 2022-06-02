<?php

namespace App\Controller\Admin;

use Core\Controller;
use App\Entity\Trainee;
use App\Entity\Training;
use App\Manager\TraineeManager;
use App\Manager\TrainingManager;
use App\Manager\ClassroomManager;
use App\Manager\TraineeTrainingManager;

class TraineeController extends Controller{

    public function index(){}

    public function addTraineeToClassroom()
    {
        require_once '../app/service/admin-check.php';
        $data = [];

        if(isset($_POST['submit']))
        {
            $id_classroom = $_POST['classroom'];
            $id_user = $_POST['id_user'];
       

            $manager = new TraineeManager();

            $req = $manager->updateClassroom($id_classroom , $id_user );
            if($req)
            {
                header("Location:/?area=admin&controller=home");
            }

        }


        if(!empty($_GET['id']))
        {
            $id_user = $_GET['id'];
            
            $manager = new TraineeManager();
            $user = $manager->getTraineeById($id_user);

            $manager = new TraineeTrainingManager();
            $training = $manager->getTrainingId($id_user);
         
            $manager = new TrainingManager();
            $trainingInfos = $manager->getAllTrainingInfosByTraining(intval($training['id_training']));
         

            $manager = new ClassroomManager();
            $classrooms = $manager->getClassroomsByTraining($training['id_training']);
            
           if($classrooms)
           {
               $data['classrooms'] = $classrooms;
           }
        }

        $data['user'] = $user;
        $data['trainingInfos'] = $trainingInfos;
        $path= 'pages/admin/administration/addTraineeToClassroom.html.twig';
        $layOut='base-admin';
// var_dump($data); exit;
        $this->renderView($path, $data);
    }

}