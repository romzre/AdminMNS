<?php 

require_once '../src/Entity/Entity.php';

class TrainingDocs {

    private int $id_document;
    private int $id_typeOfDoc;
    private int $id_training;

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
     * Get the value of id_typeOfDoc
     */ 
    public function getIdTypeOfDoc()
    {
        return $this->id_typeOfDoc;
    }

    /**
     * Set the value of id_typeOfDoc
     *
     * @return  self
     */ 
    public function setIdTypeOfDoc($id_typeOfDoc)
    {
        $this->id_typeOfDoc = $id_typeOfDoc;

        return $this;
    }

    /**
     * Get the value of id_training
     */ 
    public function getIdTraining()
    {
        return $this->id_training;
    }

    /**
     * Set the value of id_training
     *
     * @return  self
     */ 
    public function setIdTraining($id_training)
    {
        $this->id_training = $id_training;

        return $this;
    }
}
