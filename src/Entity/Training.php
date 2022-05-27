<?php

namespace App\Entity;

use App\Entity\Entity;

// require_once '../src/Entity/Entity.php';

class Training extends Entity{

    private int $id_training;
    private string $title_formation;
    private int $capacity_training;
    private  $code_training;
    private bool $isValid;



    /**
     * Get the value of title_formation
     */ 
    public function getTitleFormation()
    {
        return $this->title_formation;
    }

    /**
     * Set the value of title_formation
     *
     * @return  self
     */ 
    public function setTitleFormation($title_formation)
    {
        $this->title_formation = $title_formation;

        return $this;
    }

    /**
     * Get the value of capacity_training
     */ 
    public function getCapacityTraining()
    {
        return $this->capacity_training;
    }

    /**
     * Set the value of capacity_training
     *
     * @return  self
     */ 
    public function setCapacityTraining($capacity_training)
    {
        $this->capacity_training = $capacity_training;

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
     * Get the value of code_training
     */ 
    public function getCodeTraining()
    {
        return $this->code_training;
    }

    /**
     * Set the value of code_training
     *
     * @return  self
     */ 
    public function setCodeTraining($code_training)
    {
        $this->code_training = $code_training;

        return $this;
    }
}

