<?php 
require '../vendor/autoload.php';

spl_autoload_register(function ($class) {
 
   
    $class = str_replace(
        [
            '\\',
            'Core',
            'App/Controller',
            'App/Manager',
            'App/Entity',
            'App/Service',
            'App/DTO'
            
        ],
        [
            '/',
            '../core',
            '../src/controller',
            '../src/manager',
            '../src/Entity',
            '../src/Service',
            '../src/DTO'
        
        ]
        ,$class
        
        );
      
    require_once "$class.php";
});



if(!empty($_GET['controller']))
{
    $controller = ucfirst($_GET['controller']) ;
}
else
{
    $controller = 'Home';

}

// if(file_exists('../src/Controller/' . $controller . 'Controller.php'))
// {
    
    $controller = '\\App\\Controller\\'.$controller.'Controller';

    $controller = new $controller();
    
    if(!empty($_GET['action']))
    {
        $action = $_GET['action'];
    }
    else
    {
        $action = 'index';
    }

    if(method_exists($controller , $action))
    {
        $controller->$action(); // index() soit autre
    }
    else
    {
        header("HTTP/1.1 404 Not Found");
        echo "Erreur 404 Not Found test1";
    }