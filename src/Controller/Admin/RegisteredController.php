<?php
namespace App\Controller\Admin;

use Core\Controller;
use App\Manager\AdminManager;
use App\Manager\TraineeManager;
use Twig\TokenParser\EmbedTokenParser;

class RegisteredController extends Controller
{
    public function index()
    {
    }

    public function validate()
    {
        if(!empty($_GET['id']))
        {
            $id_user = $_GET['id'];
            $manager = new AdminManager();
            $req = $manager->updateRegisteredToCandidate($id_user);
            if($req)
            {
                header("Location:/?area=admin&controller=home&action=candidates");
            }
            else
            {
                $err = "Un problème est survenue lors du changement de statue.";
                $manager = new TraineeManager();
                $registered = $manager->getAllTraineeById($id_user);
    

                $data = compact('registered','err');
                $path= 'pages/admin/profileRegistered.html.twig';
                $layOut='base-admin';
                
                $this->renderView($path, $data, $layOut);
            }
        }
    }
}