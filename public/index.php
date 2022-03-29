<?php require '../templates/partials/inc_top.php';?>

<?php if(empty($_GET['page'])) {
    include_once "../templates/pages/index.tpl.php";
} else {
    if ($_GET['page']=='login') { 
        include_once '../templates/pages/login.tpl.php';
        if(!empty($_POST)) include_once '../app/scripts/login-check.php'; 
    };
};




require '../templates/partials/inc_bottom.php'; ?>