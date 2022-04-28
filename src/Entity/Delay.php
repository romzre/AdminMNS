<?php 

require_once 'Report.php';

class Delay extends Report {


    private string $dateDelay ;
    

    /**
     * Get the value of dateDelay
     */ 
    public function getDateDelay()
    {
        return $this->dateDelay;
    }

    /**
     * Set the value of dateDelay
     *
     * @return  self
     */ 
    public function setDateDelay($dateDelay)
    {
        $this->dateDelay = $dateDelay;

        return $this;
    }
}