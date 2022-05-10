<?php 
namespace App\Controller;

use Core\Controller;
use App\Manager\TraineeManager;


class AdminController extends Controller {

    public function index()
    {
        require_once '../app/service/admin-check.php';
   
        require '../src/Manager/TraineeManager.php';
        $manager = new TraineeManager();

        $registered = $manager->getAllRegistered();

        

        $data = compact('admin', 'registered');
        $path= 'pages/admin/index.html.twig';
        $layOut='base-admin';
        
        $this->renderView($path, $data, $layOut);
    }

    public function inscrits()
    {
        require_once '../app/service/admin-check.php';
   
        require '../src/Manager/TraineeManager.php';

        $manager = new TraineeManager();

        $registered = $manager->getAllRegistered();

        $data = compact('admin', 'registered');

        $path= 'pages/admin/index.html.twig';
        $layOut='base-admin';
        $this->renderView($path, $data, $layOut);

    }

    public function candidates()
    {
        require_once '../app/service/admin-check.php';
   
        require '../src/Manager/TraineeManager.php';

        $manager = new TraineeManager();

        $candidates = $manager->getAllCandidates();

        $data = compact('admin', 'candidates');

        $path= 'pages/admin/candidates.html.twig';
        $layOut='base-admin';
        $this->renderView($path, $data, $layOut);

    }

    public function trainees()
    {
        require_once '../app/service/admin-check.php';
   
        require '../src/Manager/TraineeManager.php';

        $manager = new TraineeManager();

        $trainees = $manager->getAllTrainees();

        $data = compact('admin', 'trainees');

        $path= 'pages/admin/trainees.html.twig';
        $layOut='base-admin';
        $this->renderView($path, $data, $layOut);

    }
    

}