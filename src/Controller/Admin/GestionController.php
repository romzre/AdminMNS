<?php

namespace App\Controller\Admin;

use Core\Controller;
use App\Entity\Training;
use App\Manager\TrainingManager;
use App\Manager\TrainingDocsManager;



class GestionController extends Controller{


    public function index(){
        
        require_once '../app/service/admin-check.php';
   
        
        $manager = new TrainingManager();

        $gestion = $manager->getAll();
        $data = compact('admin', 'gestion');
     
        $path= 'pages/admin/index.gestion.html.twig';
        $layOut='base-admin';
        
        $this->renderView($path, $data, $layOut);
    }

    public function training()
    {
        require_once '../app/service/admin-check.php';

        if(isset($_POST['submit']))
        {
            $data = [];
            foreach ($_POST as $key => $value) {
                $data[$key] = htmlspecialchars($value);
            }
            $manager = new TrainingManager();
            array_pop($data);
            $manager->updateTraining($data);
            header("location:/?area=admin&controller=gestion&action=training&id=".$_POST['id']);
            exit;
        }
    
        $manager = new TrainingDocsManager();

        $docs = $manager->getAllTrainingDocsByTraining(intval($_GET['id']));
        foreach ($docs as $doc ) {
            $documents[$doc['id_typeOfDoc']] = $doc['wording_typeOfDoc'];
        }

        $data = compact('admin', 'docs' , 'documents');
var_dump($data); exit;
        $path= 'pages/admin/training.gestion.html.twig';
        $layOut='base-admin';
        
        $this->renderView($path, $data, $layOut);
    }



}