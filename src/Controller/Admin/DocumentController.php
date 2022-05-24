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
          $id_user = $_GET['id'];
        }

        $manager = new DocumentManager();

        $path= 'pages/admin/gestion/classroom/classroom.gestion.html.twig';
        $layOut='base-admin';
        
        $this->renderView($path, $data);

    }
}