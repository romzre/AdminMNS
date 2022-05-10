<?php 
namespace App\Controller;

use Core\Controller;
use App\Manager\DelayManager;
use App\Manager\AbsenceManager;
use App\Manager\TraineeManager;
use App\Manager\TrainingManager;



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
            var_dump("ici"); exit;
                        
            $data['training'] =$training;
            $data['candidate']=$candidate;

            //on récupère les documents à fournir pour la formation 
            $trainingDocs=$trainingManager->getDocumentsByTraining($training->getIdTraining());

            $documents = [];

            foreach($trainingDocs as $document)
            {
                $file= ucfirst($document['wording_typeOfDoc']);
                if(strpbrk($file, '_'))
                {
                    $file=str_replace('_',' ', $file);
                }
                $documents[]=$file;
            };

            $nbIndex=count($documents);
            $data['nbIndex']=$nbIndex;
            $data['documents']=$documents;
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