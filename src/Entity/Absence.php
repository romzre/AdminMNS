<?php 

require 'Report.php';

class Absence extends Report {


    private string $startingDate_Absence ;
    private ?string $endDate_absence;
    

    /**
     * Get the value of startingDate_Absence
     */ 
    public function getStartingDateAbsence()
    {
        return $this->startingDate_Absence;
    }

    /**
     * Set the value of startingDate_Absence
     *
     * @return  self
     */ 
    public function setStartingDateAbsence($startingDate_Absence)
    {
        $this->startingDate_Absence = $startingDate_Absence;

        return $this;
    }

    /**
     * Get the value of endDate_absence
     */ 
    public function getEndDateAbsence()
    {
        return $this->endDate_absence;
    }

    /**
     * Set the value of endDate_absence
     *
     * @return  self
     */ 
    public function setEndDateAbsence($endDate_absence)
    {
        $this->endDate_absence = $endDate_absence;

        return $this;
    }

}