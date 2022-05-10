<?php
namespace App\Entity;

use App\Entity\User;
// require_once 'User.php';

class Trainee extends User {
    
    protected int $id_user;
    protected string $familyName;
    protected string $firstName;
    protected string $email;
    protected string $password;
    private bool $completeDossier;
    private int $id_organism;
    private bool $isActive;
    private bool $isRegistered;
    private string $addressComplement ;
    private string $badgeNum ;
    private string $birthdate ;
    private string $city;
    private string $laneType;
    private string $postalCode;
    private string $street;
    private int $streetNumber;
    private string $tel;

    public function __construct()
    {

    }
    


    /**
     * Get the value of completeDossier
     */ 
    public function getCompleteDossier()
    {
        return $this->completeDossier;
    }

    /**
     * Set the value of completeDossier
     *
     * @return  self
     */ 
    public function setCompleteDossier($completeDossier)
    {
        $this->completeDossier = $completeDossier;

        return $this;
    }

    /**
     * Get the value of id_organism
     */ 
    public function getId_organism()
    {
        return $this->id_organism;
    }

    /**
     * Set the value of id_organism
     *
     * @return  self
     */ 
    public function setId_organism($id_organism)
    {
        $this->id_organism = $id_organism;

        return $this;
    }

    /**
     * Get the value of isActive
     */ 
    public function getIsActive()
    {
        return $this->isActive;
    }

    /**
     * Set the value of isActive
     *
     * @return  self
     */ 
    public function setIsActive($isActive)
    {
        $this->isActive = $isActive;

        return $this;
    }

    /**
     * Get the value of isRegistered
     */ 
    public function getIsRegistered()
    {
        return $this->isRegistered;
    }

    /**
     * Set the value of isRegistered
     *
     * @return  self
     */ 
    public function setIsRegistered($isRegistered)
    {
        $this->isRegistered = $isRegistered;

        return $this;
    }

    /**
     * Get the value of addressComplement
     */ 
    public function getAddressComplement()
    {
        return $this->addressComplement;
    }

    /**
     * Set the value of addressComplement
     *
     * @return  self
     */ 
    public function setAddressComplement($addressComplement)
    {
        $this->addressComplement = $addressComplement;

        return $this;
    }

    /**
     * Get the value of badgeNum
     */ 
    public function getBadgeNum()
    {
        return $this->badgeNum;
    }

    /**
     * Set the value of badgeNum
     *
     * @return  self
     */ 
    public function setBadgeNum($badgeNum)
    {
        $this->badgeNum = $badgeNum;

        return $this;
    }

    /**
     * Get the value of city
     */ 
    public function getCity()
    {
        return $this->city;
    }

    /**
     * Set the value of city
     *
     * @return  self
     */ 
    public function setCity($city)
    {
        $this->city = $city;

        return $this;
    }

    /**
     * Get the value of laneType
     */ 
    public function getLaneType()
    {
        return $this->laneType;
    }

    /**
     * Set the value of laneType
     *
     * @return  self
     */ 
    public function setLaneType($laneType)
    {
        $this->laneType = $laneType;

        return $this;
    }

    /**
     * Get the value of postalCode
     */ 
    public function getPostalCode()
    {
        return $this->postalCode;
    }

    /**
     * Set the value of postalCode
     *
     * @return  self
     */ 
    public function setPostalCode($postalCode)
    {
        $this->postalCode = $postalCode;

        return $this;
    }

    /**
     * Get the value of street
     */ 
    public function getStreet()
    {
        return $this->street;
    }

    /**
     * Set the value of street
     *
     * @return  self
     */ 
    public function setStreet($street)
    {
        $this->street = $street;

        return $this;
    }

    /**
     * Get the value of streetNumber
     */ 
    public function getStreetNumber()
    {
        return $this->streetNumber;
    }

    /**
     * Set the value of streetNumber
     *
     * @return  self
     */ 
    public function setStreetNumber($streetNumber)
    {
        $this->streetNumber = intval($streetNumber);

        return $this;
    }

    /**
     * Get the value of tel
     */ 
    public function getTel()
    {
        return $this->tel;
    }

    /**
     * Set the value of tel
     *
     * @return  self
     */ 
    public function setTel($tel)
    {
        $this->tel = $tel;

        return $this;
    }

    /**
     * Get the value of birthdate
     */ 
    public function getBirthdate()
    {
        return $this->birthdate;
    }

    /**
     * Set the value of birthdate
     *
     * @return  self
     */ 
    public function setBirthdate($birthdate)
    {
        $this->birthdate = $birthdate;

        return $this;
    }

    /**
     * Get the value of id_user
     */ 
    public function getId_user()
    {
        return $this->id_user;
    }

    /**
     * Set the value of id_user
     *
     * @return  self
     */ 
    public function setId_user($id_user)
    {
        $this->id_user = $id_user;

        return $this;
    }
}