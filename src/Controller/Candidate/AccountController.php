<?php 
namespace App\Controller\Candidate;

use Core\Controller;
use App\Manager\UserManager;
use App\Manager\TraineeManager;
use App\Manager\TrainingDocsManager;
use App\Manager\TrainingManager;


class AccountController extends Controller {

    public function index () {

        session_start();
        

        if(!empty($_SESSION['id_user']))
        {
            // on récupère les infos sur le candidat
            $candidateManager=new TraineeManager();
            $candidate=$candidateManager->getTraineeById($_SESSION['id_user']);

            //on récupère les infos sur la formation qu'il suit
            $trainingManager = new TrainingManager();
            $training = $trainingManager->getTraining($_SESSION['id_user']);
        
            
            $data['training'] =$training;
            $data['candidate']=$candidate;

            // //on récupère les documents à fournir pour la formation 
            $trainingDocs=$trainingManager->getDocumentsByTraining($training->getIdTraining());
            $documents = [];

            $path= 'pages/candidate/account.html.twig';
            $this->renderView($path,$data);

        }
    }

    public function change_password()
    {
        if(!isset($_SESSION))session_start();

         // on récupère les infos sur le candidat
         $candidateManager=new TraineeManager();
         $candidate=$candidateManager->getTraineeById($_SESSION['id_user']);

         //on récupère les infos sur la formation qu'il suit
         $trainingManager = new TrainingManager();
         $training = $trainingManager->getTraining($_SESSION['id_user']);
     
         
         $data['training'] =$training;
         $data['candidate']=$candidate;

        if(isset($_POST['form-button']))
        {
            $success_message='';
            $error_old_password = '';
            $error_new_password = '';
            $error_confirm_password = '';
            $error_passwords = '';
            
            if(!empty($_POST['old_password']))
            {
                $old_password=$_POST['old_password']; 
            }
            else 
            {
                $error_old_password.= '<p>Merci de renseigner votre mot de passe actuel</p>';
            }
            if(!empty($_POST['new_password']))
            {
                $new_password=$_POST['new_password'];
            }
            else 
            {
                $error_new_password.= '<p>Merci de renseigner votre nouveau mot de passe</p>';
            }
            if(!empty($_POST['confirm_password']))
            {
                $confirm_password=$_POST['confirm_password'];
            }
            else 
            {
                $error_confirm_password.= '<p>Merci de confirmer votre nouveau mot de passe</p>';
            }
            if(isset($old_password) && isset($new_password) && isset($confirm_password))
            {
                //on vérifie que le mdp actuel est le bon
                $UserManager=new UserManager();
                $user=$UserManager->getUserById($_SESSION['id_user']);


                if(password_verify($old_password, $user->getPassword()))
                {

                    if($new_password===$confirm_password)
                    {
                        $new_password=password_hash($confirm_password, PASSWORD_DEFAULT);
                        $UserManager->updatePassword($new_password,$user->getEmail());

                        $success_message.='Votre mot de passe a été modifié avec succès';

                        $data['success_message']=$success_message;

                        $path= 'pages/candidate/account.html.twig';

                        $this->renderView($path,$data);
                    }
                    else 
                    {
                        $error_passwords.="<p>Les mots de passe ne sont pas identiques</p>";

                        $data['error_passwords']=$error_passwords;
                        $path= 'pages/candidate/account.html.twig';
                        $this->renderView($path,$data);
                    }
                }
                else 
                {
                    $error_old_password.= '<p>Le mot de passe renseigné ne correspond pas à votre mot de passe actuel</p>';
                    
                    $data['error_old_password']=$error_old_password;
                    $path= 'pages/candidate/account.html.twig';
                    
                    $this->renderView($path,$data);
                }
            }
            else
            {
                $data['error_old_password']=$error_old_password;
                $data['error_confirm_password']=$error_confirm_password;
                $data['error_new_password']=$error_new_password;
                $path= 'pages/candidate/account.html.twig';
            
                $this->renderView($path,$data);
            } 
        }
    }
}
