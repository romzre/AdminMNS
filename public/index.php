<?php 

if(empty($_GET['page'])) {
    include_once '../templates/pages/index.tpl.php';
} 
else 
{
    if ($_GET['page']) 
    { 
        include_once 'pages/'.$_GET['page'].'.php';
    };
};

