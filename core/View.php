<?php 
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

    /**
     * Get the value of layOut
     */ 
    public function getLayOut()
    {
        return $this->layOut;
    }

    /**
     * Set the value of layOut
     *
     * @return  self
     */ 
    public function setLayOut($layOut)
    {
        $this->layOut = $layOut;

        return $this;
    }

    function __construct($path, $data, $layOut='base')
    {
        $this->setPath($path);
        $this->setData($data);
        $this->setLayOut($layOut);
    }

    function render() {
        ob_start();

        $data = extract($this->data, EXTR_PREFIX_SAME, "wddx");

        
        require $this->path;

        $content = ob_get_clean();

        require '../templates/partials/'.$this->layOut.'.html.php';

    }

    
}