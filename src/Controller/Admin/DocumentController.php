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

          $manager = new DocumentManager();
          $manager->unvalidateDoc($id_document);

          $manager = new TrainingDocsManager();
          $manager->DeleteDoc($id_document);

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
        if(!empty($documents))
        {
          $data['documents'] = $documents;
         
        }

        $manager = new TraineeTrainingManager();
        $training = $manager->getAllTrainingByUser($id_user);
        $data['training'] = $training;

        $manager = new DocumentManager();
        $id_training = intval($training['id_training']);
        $manager = new TrainingDocsManager();
        $data['docstraining'] = $manager->getAllTrainingDocs($id_training);
        
        
       
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
}