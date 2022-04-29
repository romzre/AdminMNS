<?php require '../core/Controller.php';
require '../src/manager/AdminManager.php';

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
    
}