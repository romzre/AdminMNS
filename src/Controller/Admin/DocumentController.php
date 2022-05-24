<?php

namespace App\Controller\Admin;

use App\Manager\DocumentManager;
use Core\Controller;




class DocumentController extends Controller{

    public function index(){

   
        require_once '../app/service/admin-check.php';
        $data = [];
        
        if(!empty($_GET['id']))
        {
          $id_document = $_GET['id'];
        }

        $manager = new DocumentManager();
        $data['document'] = $manager->getDoc($id_document);
  
       
        $path= 'pages/admin/gestion/document/document.gestion.html.twig';
        $layOut='base-admin';
        
        $this->renderView($path, $data);

    }
}