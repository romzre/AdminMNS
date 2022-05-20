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
        
        $this->renderView($path, $data);
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
    
        if(isset($_POST['submit_add']))
        {
            //Verifier le champ
            //Ajouter dans la bdd TypeOfDoc
            // Ajouter dans la table d'association Training TypeOfDoc
            var_dump($_POST);
            var_dump('add'); exit;
            $manager = new TrainingManager();
        }

        if(isset($_POST['submit_edit']))
        {
            //Verifier le champ
            //Modifier le TypeOfDoc "WHERE TypeOfDOc.id = :id"
            var_dump($_POST);
            var_dump('edit'); exit;
            $manager = new TrainingManager();
        }

        if(isset($_POST['submit_delete']))
        {
            //DELETE 
            var_dump($_POST);
            var_dump('delete'); exit;
            $manager = new TrainingManager();
        }


        $manager = new TrainingDocsManager();

        $docs = $manager->getAllTrainingDocsByTraining(intval($_GET['id']));
        foreach ($docs as $doc ) {
            $documents[$doc['id_typeOfDoc']] = $doc['wording_typeOfDoc'];
            
        }
        for ($i=0; $i < count($docs) ; $i++) { 
            array_pop($docs[$i]);
            array_pop($docs[$i]);
        }
        $docs= $docs[0];
        $data = compact('admin', 'docs' , 'documents');

        $path= 'pages/admin/training.gestion.html.twig';
        
        $this->renderView($path, $data);
    }



}