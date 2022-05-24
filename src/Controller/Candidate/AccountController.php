<?php

namespace App\Controller\Candidate;

use Core\Controller;
use App\Manager\UserManager;
use App\Manager\TraineeManager;
use App\Manager\TrainingDocsManager;
use App\Manager\TrainingManager;


class AccountController extends Controller
{

    public function index()
    {

        session_start();


        if (!empty($_SESSION['id_user'])) {
            // on récupère les infos sur le candidat
            $candidateManager = new TraineeManager();
            $candidate = $candidateManager->getTraineeById($_SESSION['id_user']);

            //on récupère les infos sur la formation qu'il suit
            $trainingManager = new TrainingManager();
            $training = $trainingManager->getTraining($_SESSION['id_user']);


            $data['training'] = $training;
            $data['candidate'] = $candidate;

            $path = 'pages/candidate/account.html.twig';
            $this->renderView($path, $data);
        }
    }

    public function change_password()
    {
        if (!isset($_SESSION)) session_start();

        // on récupère les infos sur le candidat
        $candidateManager = new TraineeManager();
        $candidate = $candidateManager->getTraineeById($_SESSION['id_user']);

        //on récupère les infos sur la formation qu'il suit
        $trainingManager = new TrainingManager();
        $training = $trainingManager->getTraining($_SESSION['id_user']);


        $data['training'] = $training;
        $data['candidate'] = $candidate;

        $success_message = '';
        $error_old_password = '';
        $error_new_password = '';
        $error_confirm_password = '';
        $error_passwords = '';

        if (isset($_POST['form-button'])) {


            if (!empty($_POST['old_password'])) {
                $old_password = $_POST['old_password'];
            } else {
                $error_old_password .= '<p>Merci de renseigner votre mot de passe actuel</p>';
            }
            if (!empty($_POST['new_password'])) {
                $new_password = $_POST['new_password'];
            } else {
                $error_new_password .= '<p>Merci de renseigner votre nouveau mot de passe</p>';
            }
            if (!empty($_POST['confirm_password'])) {
                $confirm_password = $_POST['confirm_password'];
            } else {
                $error_confirm_password .= '<p>Merci de confirmer votre nouveau mot de passe</p>';
            }
            if (isset($old_password) && isset($new_password) && isset($confirm_password)) {
                //on vérifie que le mdp actuel est le bon
                $UserManager = new UserManager();
                $user = $UserManager->getUserById($_SESSION['id_user']);


                if (password_verify($old_password, $user->getPassword())) {

                    if ($new_password === $confirm_password) {
                        $new_password = password_hash($confirm_password, PASSWORD_DEFAULT);
                        $UserManager->updatePassword($new_password, $user->getEmail());

                        $success_message .= 'Votre mot de passe a été modifié avec succès';

                        $data['success_message'] = $success_message;

                        $path = 'pages/candidate/account.html.twig';

                        $this->renderView($path, $data);
                    } else {
                        $error_passwords .= "<p>Les mots de passe ne sont pas identiques</p>";

                        $data['error_passwords'] = $error_passwords;
                        $path = 'pages/candidate/account.html.twig';
                        $this->renderView($path, $data);
                    }
                } else {
                    $error_old_password .= '<p>Le mot de passe renseigné ne correspond pas à votre mot de passe actuel</p>';

                    $data['error_old_password'] = $error_old_password;
                    $path = 'pages/candidate/account.html.twig';
                    $this->renderView($path, $data);
                }
            } else {

                $data['error_old_password'] = $error_old_password;
                $data['error_confirm_password'] = $error_confirm_password;
                $data['error_new_password'] = $error_new_password;
                $path = 'pages/candidate/account.html.twig';
                $this->renderView($path, $data);
            }
        }
    }
    public function change_pic()
    {
        $message = '';
        if (!isset($_SESSION)) session_start();

        if (isset($_POST['change-pic-form-button'])) {

            $profile_pic = $_FILES['profile_pic'];

            if ($profile_pic['error'] == 0) {

                // Testons si le fichier n'est pas trop gros (max 5Mo)
                if ($profile_pic['size'] <= 4000000) {

                    if ($profile_pic['name'] !== '') {

                        $wording_file = basename($profile_pic['name']);

                        // Testons si l'extension est autorisée
                        $infosfichier = pathinfo($profile_pic['name']);

                        $extension_upload = $infosfichier['extension'];

                        $extensions_autorisees = array('jpg', 'jpeg', 'png');

                        if (in_array($extension_upload, $extensions_autorisees)) {
                            // On peut valider le fichier et le stocker définitivement
                            $path_file = "../uploads/" . $_SESSION['id_user'] . "/profile_pic/" . $wording_file;
                            move_uploaded_file($profile_pic['tmp_name'], $path_file);


                            //on ajoute le champ du fichier dans l'entrée du user 
                            $userManager = new UserManager();
                            $updatedPic = $userManager->updatePicture($wording_file, $_SESSION['id_user']);
                            if ($updatedPic) {
                                $message .= "<p>Oups, il y a eu une erreur pendant l'envoi</p>";
                            } else {
                                $message .= "<p>L'envoi a bien été effectué !</p>";
                            }
                            $message .= "<p>L'envoi a bien été effectué !</p>";
                        } else {
                            $message .= "<p>Seules les extensions pdf, jpeg, jpg et png sont autorisées !</p>";
                        }
                    } else {
                        $message .= '<p>Le fichier doit avoir un titre</p>';
                    }
                }
            } else {
                $message .= "<p>Oups il y a eu un problème lors de l'envoi, merci de renouveller l'opération </p>";
            }
            return $message;
        }
    }
}
