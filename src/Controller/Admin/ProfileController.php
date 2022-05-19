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

    public function candidate()
    {
        if(!empty($_GET['id']))
        {
            $id_user = intval($_GET['id']);
            $manager = new TraineeManager();
            $candidate = $manager->getAllTraineeById($id_user);
            var_dump($candidate); exit;

            $data = compact('candidate');
            $path= 'pages/admin/profileRegistered.html.twig';
            $layOut='base-admin';
      
            $this->renderView($path, $data, $layOut);
        }
    }
}