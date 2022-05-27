<?php

namespace App\Entity;

use App\Entity\Entity;

// require_once '../src/Entity/Entity.php';

class Classroom extends Entity{

    private int $id_classroom;
    private string $name;
    private string $classroomMYB;
    private string  $classroomMYE;
    private int $num_classroom;
    private int $id_training;


    /**
     * Get the value of id_classroom
     */ 
    public function getIdClassroom()
    {
        return $this->id_classroom;
    }

    /**
     * Set the value of id_classroom
     *
     * @return  self
     */ 
    public function setIdClassroom($id_classroom)
    {
        $this->id_classroom = $id_classroom;

        return $this;
    }

    /**
     * Get the value of name
     */ 
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set the value of name
     *
     * @return  self
     */ 
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get the value of classroomMYB
     */ 
    public function getClassroomMYB()
    {
        return $this->classroomMYB;
    }

    /**
     * Set the value of classroomMYB
     *
     * @return  self
     */ 
    public function setClassroomMYB($classroomMYB)
    {
        $this->classroomMYB = $classroomMYB;

        return $this;
    }

    /**
     * Get the value of classroomMYE
     */ 
    public function getClassroomMYE()
    {
        return $this->classroomMYE;
    }

    /**
     * Set the value of classroomMYE
     *
     * @return  self
     */ 
    public function setClassroomMYE($classroomMYE)
    {
        $this->classroomMYE = $classroomMYE;

        return $this;
    }

    /**
     * Get the value of num_classroom
     */ 
    public function getNumClassroom()
    {
        return $this->num_classroom;
    }

    /**
     * Set the value of num_classroom
     *
     * @return  self
     */ 
    public function setNumClassroom($num_classroom)
    {
        $this->num_classroom = $num_classroom;

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