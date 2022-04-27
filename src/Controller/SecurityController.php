<?php require '../core/Controller.php';



class SecurityController extends Controller {

    public function index()
    {
        $data = [];
        $path= '../templates/pages/security/index.html.php';
        $this->renderView($path, $data);

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
        $path= '../templates/pages/security/forgot-password.html.php';
        $this->renderView($path, $data);

    }

    public function resetPassword ()
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
            <p><a href="/?page=forgot-password">
            Click here</a> to reset password.</p>';
        
        }
        
        $path = '../templates/pages/security/reset-password.html.php';
        $data = [];

        $data['form'] = $form;
        $data['error'] = $error;
        $data['success'] = $success;
        $data['error_password1'] = $error_password1;
        $data['error_password2'] = $error_password2;
        $data['error_passwords'] = $error_passwords;

        $view=new View($path, $data);
        $view->render();
               

    }

    
}