<?php require '../templates/partials/inc_top.php';?>

<?php if(empty($_GET['page'])) {
    include_once "../templates/pages/index.tpl.php";
} else {
    if ($_GET['page']=='login') { 
        include_once 'pages/login.php';
        if(!empty($_POST)) include_once '../app/scripts/login-check.php'; 
    };
    if ($_GET['page']=='register') { 
        require '../app/Manager/PdoManager.php';
        require "../app/Entity/Form.php";
        include_once 'pages/register.php';
     
    };
}; 

















require '../templates/partials/inc_bottom.php'; ?>