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
        if (!empty($_GET['id'])) {
            $id_user = $_GET['id'];
            $manager = new AdminManager();
            $req = $manager->updateRegisteredToCandidate($id_user);
            mkdir('../uploads/' . $id_user, 0777);
            mkdir('../uploads/' . $id_user . '/formation', 0777);
            mkdir('../uploads/' . $id_user . '/absences', 0777);
            mkdir('../uploads/' . $id_user . '/profile_pic', 0777);
            if ($req) {
                header("Location:/?area=admin&controller=home&action=candidates");
            } else {
                $err = "Un problème est survenue lors du changement de statue.";
                $manager = new TraineeManager();
                $registered = $manager->getAllTraineeById($id_user);


                $data = compact('registered', 'err');
                $path = 'pages/admin/administration/profileRegistered.html.twig';

                $this->renderView($path, $data);
            }
        }
    }

    public function validateTrainee()
    {
        require_once '../app/service/admin-check.php';

        if (!empty($_GET['id'])) {
            $id_user = $_GET['id'];
        }

        $manager = new AdminManager();
        $req = $manager->updateCandidateToTrainee($id_user);

        header("Location:/?area=admin&controller=home");
    }
}
