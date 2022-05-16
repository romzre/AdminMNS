<?php 
namespace App\Controller\Trainee;

use Core\Controller;
use App\Manager\DelayManager;
use App\Manager\AbsenceManager;
use App\Manager\TraineeManager;
use App\Manager\TrainingManager;


class HomeController extends Controller {

    public function index()
    {
        session_start();

        if(!empty($_SESSION['id_user']))
        {
            //on récupère les infos sur le stagiaire
            $traineeManager=new TraineeManager();
            $trainee=$traineeManager->getAllInfos($_SESSION['id_user']);

            //on récupère les infos sur la formation qu'il suit
            $trainingManager = new TrainingManager();
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