<?php require '../core/Controller.php';
require '../src/manager/TraineeTrainingManager.php';
require '../src/manager/TraineeManager.php';
require '../src/manager/AbsenceManager.php';

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
            $unjustifiedAbsences = $absenceManager->getUnjustifiedAbsencesByUser($_SESSION['id_user']);
            var_dump($unjustifiedAbsences);
            
            $data['training'] =$training;
            $data['trainee']=$trainee;
            
            
            
            $path= '../templates/pages/trainee/index.html.php';
            $layOut='base-trainee';
            $this->renderView($path, $data, $layOut);
        }
        else
        {
            header('Location: /');
        }
        
    }
    
}