<?php

namespace App\Entity;
use App\Entity\Entity;



class Document extends Entity {


    private int $id_document;
    private string $path_file;
    private string $wording_file;
    private bool $isValid;
    private int $id_user;

    public function __construct()
    {
        
    }
    /**
     * Get the value of id_document
     */ 
    public function getIdDocument()
    {
        return $this->id_document;
    }

    /**
     * Set the value of id_document
     *
     * @return  self
     */ 
    public function setIdDocument($id_document)
    {
        $this->id_document = $id_document;

        return $this;
    }

    /**
     * Get the value of path_file
     */ 
    public function getPathFile()
    {
        return $this->path_file;
    }

    /**
     * Set the value of path_file
     *
     * @return  self
     */ 
    public function setPathFile($path_file)
    {
        $this->path_file = $path_file;

        return $this;
    }

    /**
     * Get the value of wording_file
     */ 
    public function getWordingFile()
    {
        return $this->wording_file;
    }

    /**
     * Set the value of wording_file
     *
     * @return  self
     */ 
    public function setWordingFile($wording_file)
    {
        $this->wording_file = $wording_file;

        return $this;
    }

    /**
     * Get the value of isValid
     */ 
    public function getIsValid()
    {
        return $this->isValid;
    }

    /**
     * Set the value of isValid
     *
     * @return  self
     */ 
    public function setIsValid($isValid)
    {
        $this->isValid = $isValid;

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
}