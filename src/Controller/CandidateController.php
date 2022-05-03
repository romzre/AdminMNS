<?php 

require_once '../core/Controller.php';
require_once '../src/Manager/TraineeManager.php';
require_once '../src/Manager/TrainingManager.php';

class CandidateController extends Controller {

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

        //     // //on récupère son nombre d'absence injustifiées
        //     // $absenceManager = new AbsenceManager();
        //     // $nbUnjustifiedAbsences = $absenceManager->getNbOfUnjustifiedAbsencesByUser($_SESSION['id_user']);
            
        //     // //on récupère son nombre de retards injustifiés
        //     // $delayManager = new DelayManager();
        //     // $nbUnjustifiedDelays = $delayManager->getNbOfUnjustifiedDelaysByUser($_SESSION['id_user']);

            
            $data['training'] =$training;
            $data['candidate']=$candidate;

            $path= 'pages/candidate/index.html.twig';
            $layOut='base-candidate';

            var_dump($data);

            $this->renderView($path, $data, $layOut);
        }
        else
        {
            header('Location: /');
        }
        
    }
}