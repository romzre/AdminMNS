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
   
    require '../app/Manager/UserManager.php';

    $manager = new UserManager();
    $id  = $manager->insertUser($dataUser);
    // $dataTrainee = [
    //     'id_user' => intval($id),
    //     'birthdate' => $_POST['birthdate'],
    //     'tel' => $_POST['tel'],
    //     'laneType' => $_POST['laneType'],
    //     'street' => $_POST['street'],
    //     'addressComplement' => $_POST['addressComplement'],
    //     'postalCode' => $_POST['postalCode'],
    //     'city' => $_POST['city'],
    //     'streetNumber' => $_POST['streetNumber'],
    //     'completeDossier' => 0,
    //     'isRegister' => 0,
    // ];
    $dataTrainee = [
        intval($id),
        $_POST['birthdate'],
        $_POST['tel'],
        $_POST['laneType'],
        $_POST['street'],
        $_POST['addressComplement'],
        $_POST['postalCode'],
        $_POST['city'],
        $_POST['streetNumber'],
        0,
        0,
        0
    ];
    // var_dump($dataTrainee);exit;
    $reqRegister = $manager->insertRegister($dataTrainee);
   
}

