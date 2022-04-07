<?php
$array_dataPost = [];

foreach ($_POST as $key => $value) {
    
    if(empty($value))
    {
        $array_dataPost [] = $key;
    }
    else
    {
        $_POST[$key] = htmlspecialchars($value);
    }
}
if(count($array_dataPost) == 0)
{
   
    $password = password_hash($_POST['password_user'], PASSWORD_DEFAULT);
    $dataUser = [
       'firstName_user' => $_POST['firstName_user'],
       'familyName_user' => $_POST['familyName_user'],
       'email_user' => $_POST['email_user'],
       'password_user' => $password
    ];
    unset($_POST['firstName_user']);
    unset($_POST['familyName_user']);
    unset($_POST['email_user']);
    unset($_POST['password_user']);
    unset($_POST['confirm_password']);
    unset($_POST['trainnings']);
    unset($_POST['submit-register']);
   
    require '../app/Manager/UserManager.php';

    $manager = new UserManager();

    $req = $manager->insertRegister($_POST,$dataUser);
    var_dump($req); exit;
}

