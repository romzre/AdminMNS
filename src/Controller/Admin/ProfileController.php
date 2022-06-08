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
            $user = $manager->getAllTraineeById($id_user);
    

            $data = compact('user');
            $path= 'pages/admin/administration/profileRegistered.html.twig';
      
            $this->renderView($path, $data);
        }
    }

    public function candidate()
    {
        if(!empty($_GET['id']))
        {
            $id_user = intval($_GET['id']);
            $manager = new TraineeManager();
            $user = $manager->getAllTraineeById($id_user);
          
            $data = compact('user');
            $data['action'] = 'candidates'; 
        
            $path= 'pages/admin/administration/profileRegistered.html.twig';
      
            $this->renderView($path, $data);
        }
    }

    public function trainee()
    {
        if(!empty($_GET['id']))
        {
            $id_user = intval($_GET['id']);
            $manager = new TraineeManager();
            $user = $manager->getAllTraineeById($id_user);
          
            $data = compact('user');
            // $data['action'] = 'index'; 
        
            $path= 'pages/admin/administration/profileRegistered.html.twig';
      
            $this->renderView($path, $data);
        }
    }
}