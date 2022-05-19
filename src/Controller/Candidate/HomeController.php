<?php 
namespace App\Controller\Candidate;

use Core\Controller;
use App\Manager\TraineeManager;
use App\Manager\TrainingDocsManager;
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
        
            
            $data['training'] =$training;
            $data['candidate']=$candidate;

            // //on récupère les documents à fournir pour la formation 
            $trainingDocs=$trainingManager->getDocumentsByTraining($training->getIdTraining());
            $documents = [];

            // on met en forme le wording de l'intitulé des documents pour l'affichage
            foreach($trainingDocs as $document)
            {
                $file= ucfirst($document['wording_typeOfDoc']);
                if(strpbrk($file, '_'))
                {
                    $file=str_replace('_',' ', $file);
                }
                $document['wording_typeOfDoc']=$file;
                $documents[]=$document;
            };

            $nbIndex=count($documents);
            $data['nbIndex']=$nbIndex;
            $data['documents']=$documents;

            // on récupère le statut des documents du candidat pour l'inscription à la formation
            $traininDocsManager = new TrainingDocsManager();
            $userTrainingDocs = $traininDocsManager->getTrainingDocsByUser($_SESSION['id_user'], $training->getIdTraining());

            // on créé un tableau associatif (id_type of docs => isValid ) avec les documents fournis par le candidat
            $userDocuments = [];
            foreach ($userTrainingDocs as $key => $userTrainingDoc) {
                $isValid = $userTrainingDoc['isValid'] == null ? null : ($userTrainingDoc['isValid'] == 0 ? false : true);
                $userDocuments[$userTrainingDoc['id_typeOfDoc']] = $isValid;
                // $documents['isValid'] = $isValid;
            }

            $data['userDocuments']= $userDocuments;

            $path= 'pages/candidate/index.html.twig';
            $layOut='base-candidate';

            
            
            // si des documents ont été envoyé, on appelle la méthode sendFile()
            if(isset($_POST['form-button'])) {
                $message = $this->sendFile();
                $data['message']=$message;
            }

            $this->renderView($path, $data, $layOut);
        }
        else
        {
            header('Location: /');
        }
    }

    public function sendFile()
    {
        $message = '';

        $typeOfDocs=$_FILES['typeOfDocs'];

        //on compte le nombre de document envoyé
        $nbDocs=count($typeOfDocs['name']);

        
        //on récupère les id_typeOfWord qui étaient passés dans l'attribut name de l'input de chaque document et on les stocke dans le tableau $id_typeOfDoc
        $id_typeOfDoc= [];

        // on crée un tableau dans regroupant les infos du document pour chaque document 
        foreach($typeOfDocs['name'] as $key => $value)
        {
            $id_typeOfDoc[]= $key;
        }
        $dataDoc=[];
        for($i=0; $i<$nbDocs; $i++)
        {
            $key_file = $id_typeOfDoc[$i];
            $dataDoc[$i]['id_typeOfDoc']=$key_file;

            if($typeOfDocs['error'][$key_file] == 0)
            {
                // Testons si le fichier n'est pas trop gros (max 5Mo)
                if ($typeOfDocs['size'][$key_file] <= 5000000)
                {

                    if($typeOfDocs['name'][$key_file] !== '')
                    {
        
                        $dataDoc[$i]['wording_file']=$typeOfDocs['name'][$key_file];

                        // Testons si l'extension est autorisée
                        $infosfichier = pathinfo($typeOfDocs['name'][$key_file]);

                        $extension_upload = $infosfichier['extension'];

                        $extensions_autorisees = array('pdf', 'jpg', 'jpeg', 'gif', 'png');

                        if(in_array($extension_upload, $extensions_autorisees))
                        {
                            // On peut valider le fichier et le stocker définitivement

                            move_uploaded_file($typeOfDocs['tmp_name'][$key_file],'uploads/' . basename($typeOfDocs['name'][$key_file]));
                            $dataDoc[$i]['basename'] = basename($typeOfDocs['name'][$key_file]);
                            
                            $message.= "<p>L'envoi a bien été effectué !</p>";
                            } 

                    }
                    else
                    {
                        $message .= '<p>Le fichier doit avoir un titre</p>';
                    }
                }
                else 
                {
                    $message .= '<p>Le fichier est trop volumineux</p>';
                }
            }            
            
        }
        return $message;
    }
}
