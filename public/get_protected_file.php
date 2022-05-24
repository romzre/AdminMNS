<?php

$headers = getallheaders();

// if($headers['Sec-Fetch-Mode'] == 'navigate') {
//     die('Vous n\'êtes pas autorisé à accéder à ce fichier.');
// }

if(isset($_GET['file'])){
    $file = $_GET['file'];
    $file = '../uploads/'.$_SESSION['id_user'].'/fomation'.'/'.$file;
    if(file_exists($file)){
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename="'.basename($file).'"');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($file));
        readfile($file);
        exit;
    }
}