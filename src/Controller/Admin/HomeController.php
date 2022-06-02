<?php

namespace App\Controller\Admin;

use Core\Controller;
use App\Manager\TraineeManager;
use App\Manager\TrainingManager;
use App\Manager\ClassroomManager;
use App\Manager\TrainingDocsManager;

class HomeController extends Controller {
    
    /**
     * index affiche la première page aprés la connexion lorsque l'utilisateur est administrateur
     *
     * @return void
     */
    public function index()
    {
        require_once '../app/service/admin-check.php';
   
        require '../src/Manager/TraineeManager.php';

        $manager = new TraineeManager();
        $trainees = $manager->getAllTrainees();

        $manager = new ClassroomManager();
        $classrooms = $manager->getAll();
        
        foreach ($trainees as $key => $trainee) 
        {
            $array = [];
            foreach ($classrooms as $classroom) 
            {
                if($classroom->getIdClassroom() == $trainee['id_classroom'])
                {
                    $trainee['classroom'] = $classroom->getName();
                }
            }
            $trainees[$key] = $trainee;
        }
       
        $data = compact('admin');
        $data['trainees'] = $trainees; 

        $path= 'pages/admin/administration/trainees.html.twig';
        $this->renderView($path, $data);

    }
    
    /**
     * candidates permet d'afficher les personnes qui doivent transmettre les pieces justificatives pour pouvoir etre stagiaire de la formation
     *
     * @return void
     */
    public function candidates()
    {
        require_once '../app/service/admin-check.php';

        $manager = new TraineeManager();

        $candidates = $manager->getAllCandidates();
     
        $manager = new TrainingDocsManager();
        $trainingDoc = $manager->getAllDocTraining();
        $DocValid = $manager->getAllDocValid();
        $DocsNull = $manager->getAllDocNull();

        foreach ($candidates as $key => $candidat) 
        {
            $compt1= 0;
            $compt2= 0;
            
            foreach ($DocsNull as $doc) 
            {
                if($doc['id_user'] == $candidat['id_user'])
                {
                    $compt1++;

                }

            }
            foreach ($DocValid as $doc) 
            {
                if($doc['id_user'] == $candidat['id_user'])
                {
                    $compt2++;

                }
                
            }
            $candidat['Nbdoc'] = $compt1;
            $candidat['NbdocValid'] = $compt2;
            // Compter le pourcentage pour chaque candidat
            foreach ($trainingDoc as $training) 
            {
                if($training['id_training'] == $candidat['id_training'])
                {
                 
                    $percent = $candidat['NbdocValid']/$training['nbDocs']*100;
                }
                
            }
            $candidat['percent'] = $percent;
            $candidates[$key] = $candidat;
        }  
        
        $manager = new TrainingManager();
        
        $List_training = $manager->getAllwithAllisValid();

        $data = compact('admin' ,'candidates' , 'trainingDoc' , 'DocValid', 'List_training');
   
        $path= 'pages/admin/administration/candidates.html.twig';
        $this->renderView($path, $data);
        
    }
    
    /**
     * trainees permet d'afficher tout les stagiaires de la formation
     *
     * @return void
     */
    // public function trainees()
    // {
    //     require_once '../app/service/admin-check.php';
   
    //     require '../src/Manager/TraineeManager.php';

    //     $manager = new TraineeManager();
    //     $trainees = $manager->getAllTrainees();

    //     $manager = new ClassroomManager();
    //     $classrooms = $manager->getAll();
        
    //     foreach ($trainees as $key => $trainee) 
    //     {
    //         $array = [];
    //         foreach ($classrooms as $classroom) 
    //         {
    //             if($classroom->getIdClassroom() == $trainee['id_classroom'])
    //             {
    //                 $trainee['classroom'] = $classroom->getName();
    //             }
    //         }
    //         $trainees[$key] = $trainee;
    //     }
       
    //     $data = compact('admin');
    //     $data['trainees'] = $trainees; 

    //     $path= 'pages/admin/administration/trainees.html.twig';
    //     $this->renderView($path, $data);

    // }
}