<?php
session_start();
var_dump($_SESSION);


if ($headers['Sec-Fetch-Mode'] == 'navigate') {
    die('Vous n\'êtes pas autorisé à accéder à ce fichier.');
}

if (isset($_SESSION['id_user'])) {
    $headers = getallheaders();

    if (isset($headers['Sec-Fetch-Mode']) && $headers['Sec-Fetch-Mode'] == 'navigate') {
        die('Vous n\'êtes pas autorisé à accéder à ce fichier.');
    }
    echo ('coucou');

    if (isset($_GET['file'])) {
        $file_name = $_GET['file'];
        $file = '../uploads/' . $_SESSION['id_user'] . '/profile_pic/' . $file_name;
        echo ($file);
        if (file_exists($file)) {
            header('Content-Description: File Transfer');
            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment; filename="' . basename($file) . '"');
            header('Expires: 0');
            header('Cache-Control: must-revalidate');
            header('Pragma: public');
            header('Content-Length: ' . filesize($file));
            readfile($file);
            exit;
        }
    }
} else {
    echo ('no session');
    // $this->reLocate('?area=candidate&controller=account');
};
