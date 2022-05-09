<?php

namespace App\Controller\Admin;

use App\Entity\Trainee;
use App\Manager\TraineeManager;
use Core\Controller;

class ProfileController extends Controller {

    public function index()
    {
        
    }

    public function register()
    {
        if(!empty($_GET['id']))
        {
            $id_user = intval($_GET['id']);
            $manager = new TraineeManager();
            $registered = $manager->getAllTraineeById($id_user);
    

            $data = compact('registered');
            $path= 'pages/admin/profileRegistered.html.twig';
            $layOut='base-admin';
      
            $this->renderView($path, $data, $layOut);
        }
    }
}