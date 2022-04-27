<?php require '../core/Controller.php';
require '../src/manager/TraineeManager.php';

class TraineeController extends Controller {

    public function index()
    {
        session_start();
        $traineeManager=new TraineeManager();
        $trainee=$traineeManager->getAllInfos($_SESSION['id_user']);

        $data['trainee']=$trainee;
        $path= '../templates/pages/trainee/dashboard-trainee.html.php';
        $this->renderView($path, $data);
    }
    
}