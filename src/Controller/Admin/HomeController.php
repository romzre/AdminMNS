<?php

namespace App\Controller\Admin;

use Core\Controller;
use App\Manager\TraineeManager;
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

        $data = compact('admin', 'trainees');

        $path= 'pages/admin/trainees.html.twig';
        $layOut='base-admin';
        $this->renderView($path, $data, $layOut);

    }
    
    // /**
    //  * inscrits affiche les personnes qui souhaitent s'inscrire dans la formation. Ils ont fait la demande et doivent attendre le retour de l'adminsitrateur
    //  *
    //  * @return void
    //  */
    // public function inscrits()
    // {
    //     require_once '../app/service/admin-check.php';
   
    //     require '../src/Manager/TraineeManager.php';

    //     $manager = new TraineeManager();

    //     $registered = $manager->getAllRegistered();

    //     $data = compact('admin', 'registered');

    //     $path= 'pages/admin/index.html.twig';
    //     $layOut='base-admin';
    //     $this->renderView($path, $data, $layOut);

    // }
    
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
        
        for ($x=0; $x < count($candidates) ; $x++) { 
        
            for ($i=0; $i < count($DocValid) ; $i++) { 
                if($candidates[$x]['id_user'] == $DocValid[$i]['id_user'])
                {
                    if($DocValid[$i]['isValid'] != 0 || $DocValid[$i]['isValid'] != null)
                    {
                        for ($j=0; $j < count($trainingDoc) ; $j++) 
                        { 
                            if($trainingDoc[$j]['id_training'] == $DocValid[$i]['id_training'] )
                            {
                               
                                array_push($candidates[$x] , ['percent' => ($DocValid[$i]['isValid']/$trainingDoc[$j]['nbDocs']*100)]);
                                
                                // var_dump($candidates[$x]);
                            }
                        }
                    }
                    // else
                    // {
                    //     $candidat['percent'] = 0;
                    // }
                   
                }
            }
        }
        // var_dump($candidates); exit;
        $data = compact('admin' ,'candidates' , 'trainingDoc' , 'DocValid');
        $path= 'pages/admin/candidates.html.twig';
        $layOut='base-admin';
        $this->renderView($path, $data, $layOut);

    }
    
    /**
     * trainees permet d'afficher tout les stagiaires de la formation
     *
     * @return void
     */
    public function trainees()
    {
        require_once '../app/service/admin-check.php';
   
        require '../src/Manager/TraineeManager.php';

        $manager = new TraineeManager();

        $trainees = $manager->getAllTrainees();

        $data = compact('admin', 'trainees');

        $path= 'pages/admin/trainees.html.twig';
        $layOut='base-admin';
        $this->renderView($path, $data, $layOut);

    }
}