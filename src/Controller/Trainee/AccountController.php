<?php

namespace App\Controller\Trainee;

use Core\Controller;
use App\Manager\UserManager;
use App\Manager\TraineeManager;
use App\Manager\TrainingManager;


class AccountController extends Controller
{

    public function index()
    {

        session_start();


        if (!empty($_SESSION['id_user'])) {

            // si l'utilisateur a cliqué sur le bouton changé de photo on appelle la methode change_pic
            if (isset($_POST['change-pic-form-button'])) {
                $message = $this->change_pic();
                $data['message'] = $message;
            }

            // si l'utilisateur a cliqué sur le bouton supprimé la photo on appelle la methode deletePic
            if (isset($_POST['delete-pic-form-button'])) {
                $this->delete_pic();
            }

            // si le form pour modifier ses données a été soumis, on appelle la methode update_info
            if (isset($_POST['submit'])) {
                $message_update_info = $this->update_info();
                $data['message_update_info'] = $message_update_info;
            }

            // on récupère les infos sur le stagiaire
            $traineeManager = new TraineeManager();
            $trainee = $traineeManager->getTraineeById($_SESSION['id_user']);

            //on récupère les infos sur la formation qu'il suit
            $trainingManager = new TrainingManager();
            $training = $trainingManager->getTraining($_SESSION['id_user']);


            $data['training'] = $training;
            $data['trainee'] = $trainee;

            $path = 'pages/trainee/account.html.twig';
            $this->renderView($path, $data);
        } else $this->reLocate();
    }

    public function change_password()
    {
        if (!isset($_SESSION)) session_start();

        // on récupère les infos sur le candidat
        $userManager = new TraineeManager();
        $user = $userManager->getTraineeById($_SESSION['id_user']);

        //on récupère les infos sur la formation qu'il suit
        $trainingManager = new TrainingManager();
        $training = $trainingManager->getTraining($_SESSION['id_user']);


        $data['training'] = $training;
        $data['user'] = $user;

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

                        //si c'est le bon mdp, on change 
                        $UserManager->updatePassword($new_password, $user->getEmail());

                        $success_message .= 'Votre mot de passe a été modifié avec succès';

                        $data['success_message'] = $success_message;

                        $path = 'pages/trainee/account.html.twig';

                        $this->renderView($path, $data);
                    } else {
                        $error_passwords .= "<p>Les mots de passe ne sont pas identiques</p>";

                        $data['error_passwords'] = $error_passwords;
                        $path = 'pages/trainee/account.html.twig';
                        $this->renderView($path, $data);
                    }
                } else {
                    $error_old_password .= '<p>Le mot de passe renseigné ne correspond pas à votre mot de passe actuel</p>';

                    $data['error_old_password'] = $error_old_password;
                    $path = 'pages/trainee/account.html.twig';
                    $this->renderView($path, $data);
                }
            } else {

                $data['error_old_password'] = $error_old_password;
                $data['error_confirm_password'] = $error_confirm_password;
                $data['error_new_password'] = $error_new_password;
                $path = 'pages/trainee/account.html.twig';
                $this->renderView($path, $data);
            }
        }
    }
    public function change_pic()
    {
        $message = '';

        $profile_pic = $_FILES['profile_pic'];

        if ($profile_pic['error'] == 0) {

            // Testons si le fichier n'est pas trop gros (max 5Mo)
            if ($profile_pic['size'] <= 4000000) {

                if ($profile_pic['name'] !== '') {

                    $wording_file = basename($profile_pic['name']);

                    // Testons si l'extension et le type sont autorisés
                    $infosfichier = pathinfo($profile_pic['name']);

                    $extension_upload = $infosfichier['extension'];
                    $extensions_autorisees = array('jpg', 'jpeg');

                    $mime_type = mime_content_type($profile_pic['tmp_name']);
                    $allowed_file_types = ['image/jpg', 'image/jpeg'];

                    if (in_array($extension_upload, $extensions_autorisees) && in_array($mime_type, $allowed_file_types)) {
                        // On peut valider le fichier et le stocker définitivement
                        $path_file = "../uploads/" . $_SESSION['id_user'] . "/profile_pic/" . $wording_file;
                        move_uploaded_file($profile_pic['tmp_name'], $path_file);


                        //on ajoute le champ du fichier dans l'entrée du user 
                        $userManager = new UserManager();
                        $updatedPic = $userManager->updatePicture($wording_file, $_SESSION['id_user']);
                        if (!$updatedPic) {
                            $message .= "<p>Oups, il y a eu une erreur pendant l'envoi</p>";
                        } else {
                            // si la photo a bien été envoyée, on la redimensionne en faisant appel à la méthode resize_pic
                            $this->resize_pic($path_file);
                            $message .= "<p>L'envoi a bien été effectué !</p>";
                        }
                    } else {
                        $message .= "<p>Seules les extensions jpeg et jpg sont autorisées !</p>";
                    }
                } else {
                    $message .= '<p>Le fichier doit avoir un titre</p>';
                }
            } else {
                $message .= '<p>Le fichier est trop volumineux </p>';
            }
        } else {
            $message .= "<p>Oups il y a eu un problème lors de l'envoi, merci de renouveller l'opération </p>";
        }
        return $message;
    }

    public function resize_pic($path_file)
    {
        $im = imagecreatefromjpeg($path_file);
        $exif = exif_read_data($path_file);
        $orientation = $exif['Orientation'];
        switch ($orientation) {
            case 3:
                $im = imagerotate($im, 180, 0);
                break;
            case 6:
                $im = imagerotate($im, -90, 0);
                break;
            case 8:
                $im = imagerotate($im, 90, 0);
                break;
        }
        $size = min(imagesx($im), imagesy($im));
        $x = (imagesx($im) - $size) / 2;
        $y = (imagesy($im) - $size) / 2;
        $im2 = imagecrop($im, ['x' => $x, 'y' => $y, 'width' => $size, 'height' => $size]);
        $im3 = imagescale($im2, 400, 400);
        if ($im3 !== FALSE) {
            imagepng($im3, $path_file);
            imagedestroy($im3);
        }
        imagedestroy($im);
    }

    public function delete_pic()
    {

        $userManager = new UserManager();
        $userManager->deletePicture($_SESSION['id_user']);
    }

    public function update_info()
    {
        $message = '';
        if (!empty($_POST['firstName'])) {
            $firstName = $_POST['firstName'];
        } else {
            $message .= '<p>Prénom</p>';
        }
        if (!empty($_POST['lastName'])) {
            $lastName = $_POST['lastName'];
        } else {
            $message .= '<p>Nom</p>';
        }
        if (!empty($_POST['email'])) {
            $email = $_POST['email'];
        } else {
            $message .= '<p>Email</p>';
        }
        if (!empty($_POST['tel'])) {
            $tel = $_POST['tel'];
        } else {
            $message .= '<p>Téléphone</p>';
        }
        if (!empty($_POST['streetNumber'])) {
            $streetNumber = $_POST['streetNumber'];
        } else {

            $message .= '<p>Numéro de rue</p>';
        }
        if (!empty($_POST['street'])) {
            $street = $_POST['street'];
        } else {

            $message .= '<p>Rue</p>';
        }
        if (!empty($_POST['postalCode'])) {
            $postalCode = $_POST['postalCode'];
        } else {

            $message .= '<p>Code postal</p>';
        }
        if (!empty($_POST['city'])) {
            $city = $_POST['city'];
        } else {

            $message .= '<p>Ville</p>';
        }
        if (isset($firstName) && isset($lastName) && isset($email) && isset($tel) && isset($streetNumber) & isset($street) && isset($postalCode) && isset($city)) {
            $message = '';
            $traineeManager = new TraineeManager();
            $returnUser = $traineeManager->updateUserInfo($firstName, $lastName, $email, $_SESSION['id_user']);

            if ($returnUser) {
                $returnTrainee = $traineeManager->updateTraineeInfo($tel, $streetNumber, $street, $postalCode, $city, $_SESSION['id_user']);

                if ($returnTrainee) {
                    $message .= '<p> Vos modifications ont bien été prises en compte !</p>';
                } else {
                    $message .= '<p> Oups, une erreur est survenue !</p>';
                }
            } else {
                $message .= '<p> Oups, une erreur est survenue !</p>';
            }
        }
        return $message;
    }
}
