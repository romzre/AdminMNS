<?php

class User {
    protected string $email;
    protected string $familyName;
    protected string $firstName;
    protected int $id;
    protected string $password;

    public function __construct(array $userInfos)
    {
        $this->setId($userInfos['id_user']);
        $this->setFamilyName($userInfos['familyName_user']);
        $this->setFirstName($userInfos['firstName_user']);
        $this->setPassword($userInfos['password_user']);
        $this->setEmail($userInfos['email_user']);
    }

    /**
     * Get the value of email
     */ 
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set the value of email
     *
     * @return  self
     */ 
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get the value of familyName
     */ 
    public function getFamilyName()
    {
        return $this->familyName;
    }

    /**
     * Set the value of familyName
     *
     * @return  self
     */ 
    public function setFamilyName($familyName)
    {
        $this->familyName = $familyName;

        return $this;
    }

    /**
     * Get the value of firstName
     */ 
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * Set the value of firstName
     *
     * @return  self
     */ 
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;

        return $this;
    }

    /**
     * Get the value of id
     */ 
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */ 
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of password
     */ 
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set the value of password
     *
     * @return  self
     */ 
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }
}