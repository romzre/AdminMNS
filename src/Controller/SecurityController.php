<?php require_once '../core/Controller.php';



class SecurityController extends Controller {

    public function index()
    {
        $data = [];
        isset($_GET['error_account'])? $data['error_account'] = $_GET['error_account']:null;
        isset($_GET['password_error'])? $data['password_error'] = $_GET['password_error']:null;
        isset($_GET['email_error']) ? $data['email_error'] = $_GET['email_error'] : null;
 
        $path= 'pages/security/index.html.twig';
        $layOut = 'base';
        $this->renderView($path, $data, $layOut);

    }

    public function check()
    {
        if (isset($_POST['submit'])) 
        {
            require '../app/service/login-check.php';
        }
        else 
        {
            header('Location :/');
        }
        
    }

    public function forgotPassword ()
    {
        $message = '';
        $messageErrorEmail = '';
        $success ='';

        if (isset($_POST['submit'])) 
        {
            require '../app/service/forgot-password.php';
        }

        $data['message'] = $message;
        $data['messageErrorEmail'] = $messageErrorEmail ;
        $data['success'] = $success;

        $path= 'pages/security/forgot-password.html.twig';
        $layOut = 'base';

        $this->renderView($path, $data, $layOut);

    }

    public function resetPassword()
    {
        $error_password1 = '';
        $error_password2='';
        $error_passwords='';
        $success = '';
        $error ='';
        $form = false;
        
        // on récupère la clé et l'email de l'user qui ont été passé en paramètre dans le lien envoyé pour réinitialiser le mdp
        if (!empty($_GET["key"]) && !empty($_GET["email"])) 
        {
            $key = $_GET["key"];
            
            $email = $_GET["email"];
            
            $curDate = date("Y-m-d H:i:s"); // on récupère la date et l'heure actuelle
        
            // on vérifie que la clé existe bien pour cet email 
            require '../app/Manager/PasswordResetManager.php';
            $passwordResetManager = new PasswordResetManager();
            $key=$passwordResetManager->keyCheck($email, $key);
            
            if(!$key)
            {
                $error .= '<h2>Invalid Link</h2>
                <p>The link is invalid/expired. Either you did not copy the correct link
                from the email, or you have already used the key in which case it is 
                deactivated.</p>
                <p><a href="/?page=forgot-password">
                Click here</a> to reset password.</p>';
                echo 'OK';
            }
            else
            {   // on récupère la date d'expiration qui est présente dans notre table et qu'on a récupéré avec la requête
                $expDate = $key['expDate'];
                if ($expDate >= $curDate) // on vérifie que la clé est toujours valide
                {
                    
                    $form = true; // on charge le formulaire pour créer le nouveau mdp si la date d'exp n'est pas dépassée
                    require '../app/service/reset-password.php';
                    
                    
                }
                else
                {
                    $error .= "<h2>Link Expired</h2>
                    <p>The link is expired. You are trying to use the expired link which 
                    as valid only 24 hours (1 days after request).<br /><br /></p>";
                }
            }
        }
        else 
        {
        
            $error .= '<h2>Invalid Link</h2>
            <p>The link is invalid/expired. Either you did not copy the correct link
            from the email, or you have already used the key in which case it is 
            deactivated.</p>
            <p><a href="/?controller=security&action=forgot-password">
            Click here</a> to reset password.</p>';
        
        }
        
        
        $data = [];

        $data['form'] = $form;
        $data['error'] = $error;
        $data['success'] = $success;
        $data['error_password1'] = $error_password1;
        $data['error_password2'] = $error_password2;
        $data['error_passwords'] = $error_passwords;
    
        $path = 'pages/security/reset-password.html.twig';
        $layOut = 'base';

        $view=new View($path, $data, $layOut);
        $view->render();
               

    }

    
}