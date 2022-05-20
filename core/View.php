<?php 
namespace Core;

class View 
{
    private string $path;

    private array $data;

    private string $layOut;


    /**
     * Get the value of path
     */ 
    public function getPath()
    {
        return $this->path;
    }

    /**
     * Set the value of path
     *
     * @return  self
     */ 
    public function setPath($path)
    {
        $this->path = $path;

        return $this;
    }

    /**
     * Get the value of data
     */ 
    public function getData()
    {
        return $this->data;
    }

    /**
     * Set the value of data
     *
     * @return  self
     */ 
    public function setData($data)
    {
        $this->data = $data;

        return $this;
    }


    function __construct($path, $data)
    {
        $this->setPath($path);
        $this->setData($data);
    }

    // function render() {
    //     ob_start();

    //     $data = extract($this->data, EXTR_PREFIX_SAME, "wddx");

        
    //     require $this->path;

    //     $content = ob_get_clean();

    //     require '../templates/partials/'.$this->layOut.'.html.php';

    // }

    function render() {

        $directory = "../templates/";

        $loader = new \Twig\Loader\FilesystemLoader($directory);

        $twig = new \Twig\Environment($loader,[
            'debug' => true,
            'cache' => false,
        ]);

        $twig->addExtension(new \Twig\Extension\DebugExtension());
        
        echo $twig->render($this->path,$this->data);

    }

    
}