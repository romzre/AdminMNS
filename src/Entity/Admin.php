<?php
namespace App\Entity;

use App\Entity\User;

class Admin extends User {
    protected int $id_user;
    private bool $is_admin;

    

    /**
     * Get the value of is_admin
     */ 
    public function getIs_admin()
    {
        return $this->is_admin;
    }

    /**
     * Set the value of is_admin
     *
     * @return  self
     */ 
    public function setIs_admin($is_admin)
    {
        $this->is_admin = $is_admin;

        return $this;
    }
}