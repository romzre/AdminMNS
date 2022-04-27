<?php 



if(!empty($_GET['controller']))
{
    $controller = ucfirst($_GET['controller']) ;
}
else
{
    $controller = 'Home';

}

if(file_exists('../src/controller/' . $controller . 'Controller.php'))
{
    
    require '../src/controller/' . $controller . 'Controller.php';

    $controller.='Controller';
    $controllerManager = new $controller() ;


    if(!empty($_GET['action']))
    {
        $action = $_GET['action'];
       
    }
    else
    {
        $action = 'index';
    }

    if(method_exists($controller,$action))
    {
        $controllerManager->$action(); // index() soit autre
    }
    else
    {
        header("HTTP/1.1 404 Not Found");
        echo "Erreur 404 Not Found A";
    }

}
else
{
    header("HTTP/1.1 404 Not Found");
    echo "Erreur 404 Not Found B";
}


// if(empty($_GET['page'])) {
//     include_once '../templates/pages/index.tpl.php';
// } 
// else 
// {
//     if ($_GET['page']) 
//     { 
//         include_once 'pages/'.$_GET['page'].'.php';
//     };
// };

