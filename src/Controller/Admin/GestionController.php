<?php

namespace App\Controller\Admin;

use App\Entity\Classroom;
use Core\Controller;
use App\Entity\Training;
use App\Manager\ClassroomManager;
use App\Manager\TrainingManager;
use App\Manager\TrainingDocsManager;



class GestionController extends Controller{


    public function index(){
        
        require_once '../app/service/admin-check.php';
   
        
        $manager = new TrainingManager();

        $gestion = $manager->getAllwithAllisValid();
        $data = compact('admin', 'gestion');
     
        $path= 'pages/admin/gestion/index.gestion.html.twig';
        $layOut='base-admin';
        
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
        $training = $manager->getAllTrainingInfosByTraining(intval($_GET['id']));

        $manager = new TrainingDocsManager();

       $Alldocuments =  $manager->getAllTrainingDocs(intval($_GET['id']));
        if(!empty($Alldocuments[0]['id_typeOfDoc']))
        {
            foreach ($Alldocuments as $doc ) 
            {
                if($doc['id_typeOfDoc'] != null && $doc['wording_typeOfDoc'] != null)
                {
                    $documents[$doc['id_typeOfDoc']] = $doc['wording_typeOfDoc'];
                }
            
            }
            // var_dump($documents); exit;
            // $docs= $docs[0];
        }
        
        
        $data = compact('admin');
       
        if(!empty($training))
        {
            $data['training'] = $training;
        }
        if(!empty($documents))
        {
            $data['documents'] = $documents;
        }
        if(!empty($message))
        {
            $data['message'] = $message;
        }

        $path= 'pages/admin/gestion/training/training.gestion.html.twig';
        $layOut='base-admin';
        
        $this->renderView($path, $data);
    }

    public function addTraining()
    {
        $data= [];

        if(isset($_POST['submit']))
        {
            if(!empty($_POST['title_formation']))
            {
                $title = htmlspecialchars($_POST['title_formation']);
                $ArrayCodeName = explode(' ',$title);
                $codeName = "";
                foreach ($ArrayCodeName as $word) {
                    $codeName .= substr(ucfirst($word) , 0 , 1);
                   
                }
                
            }

            if(!empty($_POST['capacity_training']))
            {
                $capacity_training = htmlspecialchars($_POST['capacity_training']);
            }

            
            if(!empty($_POST['isValid']))
            {
              
                $isValid = intval($_POST['isValid']);
            }

            $data = [
                "title_formation" => $title,
                "capacity_training" => $capacity_training,
                "code_training" => $codeName,
                "isValid" => $isValid,
            ];

            $manager = new TrainingManager();

            $id = $manager->insertTraining($data);

            header("Location:/?area=admin&controller=gestion&action=training&id=".$id);
        }
 
        $path= 'pages/admin/gestion/training/addTraining.gestion.html.twig';
        $layOut='base-admin';
        
        $this->renderView($path, $data, $layOut);
    }

}