<?php
require_once '../src/Entity/Entity.php';
class Training extends Entity{

    private int $id_training;
    private string $title_formation;
    private int $capacity_training;
    private int $trainingYear;


    // public function __construct($id,$title_formation,$capacity_training,$trainingYear)
    // {
    //     $this->setId($id)->setTitleFormation($title_formation)->setCapacityTraining($capacity_training)->setTrainingYear($trainingYear);
    // }


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
     * Get the value of trainingYear
     */ 
    public function getTrainingYear()
    {
        return $this->trainingYear;
    }

    /**
     * Set the value of trainingYear
     *
     * @return  self
     */ 
    public function setTrainingYear($trainingYear)
    {
        $this->trainingYear = $trainingYear;

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
