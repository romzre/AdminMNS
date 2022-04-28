<?php require '../core/Controller.php';

class HomeController extends Controller {

    public function index()
    {
        $data = [];
        $path= 'pages/home/index.html.php.twig';
        $this->renderView($path, $data);
    }
    
    public function register()
    {
        $samePass = true;
        $message = NULL;
        $email = NULL;
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

            $array_input = extract($_POST,EXTR_PREFIX_SAME,'mns_');
            
            $data['$_POST']=$_POST;
            $data['samePass']=$samePass;
            $data['message']=$message;
            $data['email'] = $email;
            
            
            
        }
        else
        {
            $data = compact('samePass','message','email');
            
        }
        $path = '../templates/pages/home/register.html.php';
        $this->renderView($path, $data);
    }

}