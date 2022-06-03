<?php

namespace App\Controller\Admin;

use App\Entity\Document;
use App\Entity\Trainee;
use Core\Controller;
use App\Manager\UserManager;
use App\Manager\DocumentManager;
use App\Manager\TraineeTrainingManager;
use App\Manager\TrainingDocsManager;
use TrainingDocs;

class DocumentController extends Controller{

    public function index(){

   
        require_once '../app/service/admin-check.php';
        $data = [];
        
        if(isset($_POST['submit_cancel']))
        {
          $message = htmlspecialchars($_POST['inpJustify_text']);
          $id_document = htmlspecialchars($_POST['id_document']);
          $id = $_GET['id'];


          $manager = new TrainingDocsManager();
          $manager->DeleteDoc($id_document);

          $manager = new DocumentManager();
          $doc = $manager->getDocById($id_document);
          // Suppression du fichier 
          unlink($doc->getPathFile());
          // Suppression dans la table
          $manager->Delete($id_document);


          // Envoi du mail pour informer le candidat que son document n'a pas été validé
          require '../app/service/sendmail-unvalidateDoc.php';
          if(!empty($stmtMsg))
          {
            $data['stmtMsg'] = $stmtMsg;
          }

        }


        if(!empty($_GET['id']))
        {
          $id_user = $_GET['id'];
        }
        $manager = new UserManager();
        $data['user'] = $manager->getUserById($id_user);

        $manager = new DocumentManager();
        $documents = $manager->getAllDocsFromUser($id_user);
        

        $manager = new TraineeTrainingManager();
        $training = $manager->getAllTrainingByUser($id_user);
        
        $manager = new DocumentManager();
        $id_training = intval($training['id_training']);
        $manager = new TrainingDocsManager();
        $docstraining = $manager->getAllTrainingDocs($id_training);


        $process_Alldoc = [];
        if(!empty($docstraining))
        {
          $compt =0;
          foreach ($docstraining as $doc) 
          {
            
            $array= [];
            $array['wording_typeOfDoc'] = $doc['wording_typeOfDoc'] ;
            $array['id_typeOfDoc'] = $doc['id_typeOfDoc'] ;
            if(!empty($documents))
            {
              foreach ($documents as $document) 
              {
                
                if($doc['id_typeOfDoc'] == $document['id_typeOfDoc'])
                {
                  if($document['isValid'] == 1)
                  {
                    $compt++;
                  }
                    $array['wording_file'] = $document['wording_file'] ;
                    $array['id_document'] = $document['id_document'] ;
                    $array['id_typeOfDoc'] = $document['id_typeOfDoc'] ;
                    $array['isValid'] = $document['isValid'] ;
                    
                } 

              }
            }
            
            $process_Alldoc[] = $array;
    
          }
          
        }
        
        // $data['docstraining'] = $docstraining;
        $data['training'] = $training['title_formation'];
        $data['docs'] = $process_Alldoc;
        $data['nbAlldocs'] = count($process_Alldoc);
        $data['DocValid'] = $compt;
        
        
       
      // var_dump($data); exit;
        $path= 'pages/admin/gestion/document/document.gestion.html.twig';
        $layOut='base-admin';
        
        $this->renderView($path, $data);

    }

    public function viewTrainingDoc()
    {
      $headers = getallheaders();

      if(isset($_GET['file']))
      {
      
          $file = $_GET['file'];
          $file = '../uploads/'.$_GET['id'].'/formation'.'/'.$file;

          $content = file_get_contents($file);
          header("Content-Disposition: inline; filename=$file");
          header("Content-type: application/pdf");
          header('Cache-Control: private, max-age=0, must-revalidate');
          header('Pragma: public');
          echo $content;
      }
    }

    public function validateTrainingDoc()
    {
        require_once '../app/service/admin-check.php';
        $data = [];

    
        if(!empty($_GET['id']))
        {
          $id_user = $_GET['id'];
        }
        $id_document = htmlspecialchars($_GET['id_doc']);
       
        $manager = new DocumentManager();
        $manager->validateDoc($id_document);


        header("Location:/?area=admin&controller=document&action=index&id=".$id_user);
    }
}