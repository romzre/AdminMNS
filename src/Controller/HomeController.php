<?php require '../core/Controller.php';

class HomeController extends Controller {

    public function index()
    {
        $data = [];

        $path= 'pages/home/index.html.twig';
        $layOut = 'base';
        $this->renderView($path, $data, $layOut);

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
<<<<<<< HEAD
        require '../src/Entity/Form.php';
        $form = new Form();
        $data['form'] = $form;
        $data['POST'] = $_POST;
        $data['messageEndCheck']=$messageEndCheck;
=======
>>>>>>> adab1e25e043f587131cda4221f4491ca206f178
        $path = 'pages/home/register.html.twig';
        $layOut='base';
        $this->renderView($path, $data, $layOut);
    }

}