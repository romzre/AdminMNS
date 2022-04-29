<?php require_once '../core/Controller.php';
require '../src/manager/TraineeTrainingManager.php';
require '../src/manager/TraineeManager.php';
require '../src/manager/AbsenceManager.php';
require '../src/manager/DelayManager.php';

class TraineeController extends Controller {

    public function index()
    {
        session_start();

        if(!empty($_SESSION['id_user']))
        {
            //on récupère les infos sur le stagiaire
            $traineeManager=new TraineeManager();
            $trainee=$traineeManager->getAllInfos($_SESSION['id_user']);

            //on récupère les infos sur la formation qu'il suit
            $trainingManager = new TraineeTrainingManager();
            $training = $trainingManager->getTraining($_SESSION['id_user']);

            //on récupère son nombre d'absence injustifiées
            $absenceManager = new AbsenceManager();
            $nbUnjustifiedAbsences = $absenceManager->getNbOfUnjustifiedAbsencesByUser($_SESSION['id_user']);
            
            //on récupère son nombre de retards injustifiés
            $delayManager = new DelayManager();
            $nbUnjustifiedDelays = $delayManager->getNbOfUnjustifiedDelaysByUser($_SESSION['id_user']);
            
            
            $data['training'] =$training;
            $data['trainee']=$trainee;
            $data['nbUnjustifiedAbsences']=$nbUnjustifiedAbsences;
            $data['nbUnjustifiedDelays']=$nbUnjustifiedDelays;

            $path= 'pages/trainee/index.html.twig';
            $layOut='base-trainee';
            $this->renderView($path, $data, $layOut);
        }
        else
        {
            header('Location: /');
        }
        
    }
    
}