<?php 
namespace App\Controller\Candidate;

use Core\Controller;
use App\Manager\TraineeManager;
use App\Manager\TrainingManager;


class HomeController extends Controller {

    public function index () {

        session_start();
        

        if(!empty($_SESSION['id_user']))
        {
            // on récupère les infos sur le candidat
            $candidateManager=new TraineeManager();
            $candidate=$candidateManager->getTraineeById($_SESSION['id_user']);

            //on récupère les infos sur la formation qu'il suit
            $trainingManager = new TrainingManager();
            $training = $trainingManager->getTraining($_SESSION['id_user']);
            var_dump($training);

        //     // //on récupère son nombre d'absence injustifiées
        //     // $absenceManager = new AbsenceManager();
        //     // $nbUnjustifiedAbsences = $absenceManager->getNbOfUnjustifiedAbsencesByUser($_SESSION['id_user']);
            
        //     // //on récupère son nombre de retards injustifiés
        //     // $delayManager = new DelayManager();
        //     // $nbUnjustifiedDelays = $delayManager->getNbOfUnjustifiedDelaysByUser($_SESSION['id_user']);

            
            $data['training'] =$training;
            $data['candidate']=$candidate;

            //on récupère les documents à fournir pour la formation 
            $trainingInfos=$trainingManager->getDocumentsByTraining($training->getIdTraining());
            var_dump($trainingInfos);

            $path= 'pages/candidate/index.html.twig';
            $layOut='base-candidate';

            $this->renderView($path, $data, $layOut);
        }
        else
        {
            header('Location: /');
        }
        
    }
}