<?php 

require 'PdoManager.php';

class ReportManager {

    private int $id_report;
    private bool $isJustified;
    private int $id_user;
    private int $id_motif;

    /**
     * Get the value of id_report
     */ 
    public function getIdReport()
    {
        return $this->id_report;
    }

    /**
     * Set the value of id_report
     *
     * @return  self
     */ 
    public function setIdReport($id_report)
    {
        $this->id_report = $id_report;

        return $this;
    }

    /**
     * Get the value of isJustified
     */ 
    public function getIsJustified()
    {
        return $this->isJustified;
    }

    /**
     * Set the value of isJustified
     *
     * @return  self
     */ 
    public function setIsJustified($isJustified)
    {
        $this->isJustified = $isJustified;

        return $this;
    }

    /**
     * Get the value of id_user
     */ 
    public function getIdUser()
    {
        return $this->id_user;
    }

    /**
     * Set the value of id_user
     *
     * @return  self
     */ 
    public function setIdUser($id_user)
    {
        $this->id_user = $id_user;

        return $this;
    }

    /**
     * Get the value of id_motif
     */ 
    public function getIdMotif()
    {
        return $this->id_motif;
    }

    /**
     * Set the value of id_motif
     *
     * @return  self
     */ 
    public function setIdMotif($id_motif)
    {
        $this->id_motif = $id_motif;

        return $this;
    }
}