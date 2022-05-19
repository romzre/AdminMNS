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

        $gestion = $manager->getAllwithAllYear();
        $data = compact('admin', 'gestion');
     
        $path= 'pages/admin/gestion/index.gestion.html.twig';
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
    
        if(isset($_POST['submit_add']))
        {
            //Verifier le champ
            if(empty($_POST['Iddoc']))
            {
                $champ = $_POST['doc'];
            }
            //Ajouter dans la bdd TypeOfD)
            
            //Ajouter dans la bdd TypeOfDoc
            // Ajouter dans la table d'association Training TypeOfDoc
            $manager = new TrainingDocsManager();
            $check = $manager->checkTrainingTypeOfDocExist($champ);
            if($check)
            {
                // Le doc existe dans la table
                // Vérifier si le doc est associé à la formation
             
                $idTypeOfDoc = $check['id_typeOfDoc'];
                $id = $manager->checkTrainingHasTypeOfDoc(intval($_GET['id']), $idTypeOfDoc);
             
                if($id)
                {
                    $message = 'Ce document existe déja pour cette formation';
                }
                else
                {
                    $manager->insertTrainingTypeOfDoc(intval($_GET['id']), $idTypeOfDoc );
                    $message = 'Votre document a été associé à la formation';
                }
            }
            else
            {
                $id = $manager->insertTypeOfDoc($champ);
                $manager->insertTrainingTypeOfDoc($_GET['id'] , $id );
                $message = 'Votre document a été créé et associé à la formation';
            }
        }

        if(isset($_POST['submit_edit']))
        {
            //Verifier le champ
            //Modifier le TypeOfDoc "WHERE TypeOfDOc.id = :id
            $manager = new TrainingDocsManager();
            $stmt = $manager->updateWording_TypeOfDoc($_POST['Iddoc'],$_POST['doc']);
            $message = 'Le nom de votre document a été modifié';
        }
 
        if(isset($_POST['delete']) && $_POST['delete'] == '')
        {
            //DELETE 
           
            $manager = new TrainingDocsManager();
            $stmt = $manager->deleteTrainingDocs($_GET['id'] , $_POST['id_typeOfDoc']);
            $message = 'Votre document a bien été supprimé';
        }


        
        $manager = new TrainingManager();
        $docs = $manager->getAllTrainingInfosByTraining(intval($_GET['id']));

        $manager = new TrainingDocsManager();
       $Alldocuments =  $manager->getAllTrainingDocs(intval($_GET['id']));
     
        foreach ($Alldocuments as $doc ) 
        {
            if($doc['id_typeOfDoc'] != null && $doc['wording_typeOfDoc'] != null)
            {
                $documents[$doc['id_typeOfDoc']] = $doc['wording_typeOfDoc'];
            }
        
        }

        $docs= $docs[0];
        
        $data = compact('admin');
        if(!empty($docs))
        {
            $data['docs'] = $docs;
        }
        if(!empty($documents))
        {
            $data['documents'] = $documents;
        }
        if(!empty($message))
        {
            $data['message'] = $message;
        }
  
        $path= 'pages/admin/gestion/training.gestion.html.twig';
        $layOut='base-admin';
        
        $this->renderView($path, $data, $layOut);
    }

    public function addTraining()
    {
        $data= [];

        if(isset($_POST['submit']))
        {
            if(!empty($_POST['title_formation']))
            {
                $title = htmlspecialchars($_POST['title_formation']);
            }

            if(!empty($_POST['capacity_training']))
            {
                $capacity_training = htmlspecialchars($_POST['capacity_training']);
            }

            if(!empty($_POST['trainingYear']))
            {
                $trainingYear = htmlspecialchars($_POST['trainingYear']);
            }

            $data = [
                "title_formation" => $title,
                "capacity_training" => $capacity_training,
                "trainingYear" => $trainingYear,
            ];

            $manager = new TrainingManager();

            $id = $manager->insertTraining($data);

            header("Location:/?area=admin&controller=gestion&action=training&id=".$id);
        }
 
        $path= 'pages/admin/gestion/addTraining.gestion.html.twig';
        $layOut='base-admin';
        
        $this->renderView($path, $data, $layOut);
    }

}