<?php 
namespace App\Controller\Home;

use App\Entity\Form;
use Core\Controller;
use App\Manager\TrainingManager;
// require '../core/Controller.php';
// require '../src/Manager/TrainingManager.php';
// require '../src/Entity/Form.php';

class HomeController extends Controller {

    public function index()
    {
        $data = [];

        $path= 'pages/home/index.html.twig';

        $this->renderView($path, $data);

    }
    
    public function register()
    {
        $samePass = true;
        $message = NULL;
        $email = NULL;
        $data = [];
        $messageEndCheck = NULL;
        if (isset($_POST['submit-register'])) 
        { 
            if($_POST['password'] == $_POST['confirm_password'])
            {
                require '../app/service/register-check.php';
            
            }
            else
            {
                $samePass = false;
                $message = "Les mots de passes ne sont pas identiques";
            
            }   

            $data['POST']=$_POST;
            $data['samePass']=$samePass;
            $data['message']=$message;
            
            $data['email'] = $email;

            
        }
        else
        {
            $data = compact('samePass','message','email');
            
        }
        $manager = new TrainingManager();
        $trainings = $manager->getAll();
        if(!empty($trainings))
        {
            foreach ($trainings as $training) {
                $selectTraining[$training->getIdTraining()] = $training->getTitleFormation();
            }
            $data['trainings'] = $selectTraining;
        }
       
        $form = new Form();
        $data['form'] = $form;
        $data['POST'] = $_POST;
        $data['messageEndCheck']=$messageEndCheck;
    
        $path = 'pages/home/register.html.twig';

        $this->renderView($path, $data);
    }

}