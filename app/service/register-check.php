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

// Test si l'email existe dans la bdd
require '../app/Manager/UserManager.php';

$manager = new UserManager();
$checkEmail = $manager->getUserByEmail($_POST['email']);


if(empty($checkEmail))
{
    $checkEmail = NULL;
    if(count($array_dataPost) == 0)
    {
   
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $dataUser = [
       'firstName' => $_POST['firstName'],
       'familyName' => $_POST['familyName'],
       'email' => $_POST['email'],
       'password' => $password
    ];
   
    
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

    $reqRegister = $manager->insertRegister($dataTrainee);

    if($reqRegister)
    {
        $message = "Votre demande d'inscription a bien été prise en compte. Un email vous sera envoyé dés que votre espace sera disponible.";
    }
    else
    {
        $message = "Une erreur est survenue lors de votre inscription. Veuillez renouveler l'opération.";
    }   
    }
}
else
{
    $email = "Cette email est déja utilisé";
}




