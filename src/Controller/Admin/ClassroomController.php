<?php

namespace App\Controller\Admin;

use App\Entity\Training;
use Core\Controller;
use App\Manager\TrainingManager;
use App\Manager\ClassroomManager;


class ClassroomController extends Controller{

    public function index(){


        require_once '../app/service/admin-check.php';
        $data = [];

        $manager = new ClassroomManager();

        $classrooms = $manager->getAllWithTrainings();
        $trainees = $manager->getClassroomsWithTrainee();
        if(!empty($trainees))
        {
            $data['trainees'] = $trainees;
        }
        $data['classrooms'] = $classrooms;

        $path= 'pages/admin/gestion/classroom/classroom.gestion.html.twig';
        $layOut='base-admin';
        
        $this->renderView($path, $data);

    }

    public function view(){
    
        require_once '../app/service/admin-check.php';
        $data = [];

        $manager = new ClassroomManager();

        if(!empty($_GET['id']))
        {
            $data['class'] = $manager->getClassroom(intval($_GET['id']));
            $classroom = $manager->getClassroomWithTrainees(intval($_GET['id']));
        }
        if(!empty($classroom))
        {
            $data['classroom'] = $classroom;
        }

        $path= 'pages/admin/gestion/classroom/ViewClassroom.gestion.html.twig';
        $layOut='base-admin';
        
        $this->renderView($path, $data);
    }


    public function addClassroom()
    {
        require_once '../app/service/admin-check.php';
        $data = [];

        $manager = new TrainingManager();
        $trainings = $manager->getAll();


        $data = [
            "current_date" => date('Y-m'),
            "current_dateN" => date('Y-m',mktime(0, 0, 0, date('m')+1, 0,date('Y')+1 )),
            "trainings" => $trainings
        ];

        if(isset($_POST['submit']))
        {
            
            
            if(!empty($_POST['id_training']))
            {
                $id_training = intval(htmlspecialchars($_POST['id_training']));
                
            }

            if(!empty($_POST['classroomMYB']))
            {
                $classroomMYrB = htmlspecialchars($_POST['classroomMYB']);
                $array_yearB = explode("-",$classroomMYrB);
                $yearB = substr(ucfirst($array_yearB[0]) , 2 , 2);
                
                
            }
            if(!empty($_POST['classroomMYE']))
            {
                $classroomMYrE = htmlspecialchars($_POST['classroomMYE']);
                $array_yearE = explode("-",$classroomMYrE);
                $yearE = substr(ucfirst($array_yearE[0]) , 2 , 2);
                
            }
            
            // CODE DE LA CLASSE 
            // code de la formation + num de la classe + Année de debut + année de fin

            $manager = new TrainingManager();
            $training =  $manager->getAllTrainingInfosByTraining($id_training);
        
            $code = $training->getCodeTraining();

            $manager = new ClassroomManager();
            $classrooms = $manager->getClassroomsByTraining($id_training);
            $nb = !empty($classrooms) ? count($classrooms)+1 : 1;

            $name = $code.$nb."-".$yearB."-".$yearE;
            
            $newClass = [
                'name' => $name,
                'classroomMYB' => $classroomMYrB,
                'classroomMYE' => $classroomMYrE,
                'num_classroom' => $nb,
                'id_training' => $id_training
            ];

            $manager = new ClassroomManager();

            $req = $manager->insert($newClass);
            if($req)
            {
                header("Location:/?area=admin&controller=classroom");
                exit;
            }
            else
            {
                $data['msg'] = 'Une erreur s\'est produite lors de l\'ajout de la classe';
                $path= 'pages/admin/gestion/classroom/addClassroom.gestion.html.twig';
                $layOut='base-admin';
        
                $this->renderView($path, $data);
                exit;
            }
        }
// var_dump($data); exit;

        $path= 'pages/admin/gestion/classroom/addClassroom.gestion.html.twig';
        $layOut='base-admin';
        
        $this->renderView($path, $data);
    }

}
