<?php 
require '../vendor/autoload.php';

spl_autoload_register(function ($class) {
 
   
    $class = str_replace(
        [
            '\\',
            'Core',
            "App/Controller/Admin",
            "App/Controller/Candidate",
            "App/Controller/Home",
            "App/Controller/Security",
            "App/Controller/Trainee",
            'App/Manager',
            'App/Entity',
            'App/Service',
            'App/DTO'
            
        ],
        [
            '/',
            '../core',
            '../src/Controller/Admin',
            '../src/Controller/Candidate',
            '../src/Controller/Home',
            '../src/Controller/Security',
            '../src/Controller/Trainee',
            '../src/Manager',
            '../src/Entity',
            '../src/Service',
            '../src/DTO'
        
        ]
        ,$class
        
        );
      $class .= '.php';  
   
    require_once "$class";
});

if(!empty($_GET['area']))
{
    $area = ucfirst($_GET['area']) ;
}
else
{
    $area = 'Home';

}

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
    
    $controller = '\\App\\Controller\\'.$area.'\\'.$controller.'Controller';

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