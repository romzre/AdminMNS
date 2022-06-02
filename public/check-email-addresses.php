
<?php


$pdo = new PDO('mysql:host=51.77.211.62:3306;dbname=adminMns2', 'kyoko9273', 'Spedum1463!');
$email = $_GET['email'];
$sql = "SELECT email from users where email=:email";

$req = $pdo->prepare($sql);
$req->execute([
    'email' => $email
]);

$user = $req->fetch(PDO::FETCH_ASSOC);

if ($user) {
    $obj = ["isExistant" => true];
} else {
    $obj = ["isExistant" => false];
}
echo json_encode($obj);
