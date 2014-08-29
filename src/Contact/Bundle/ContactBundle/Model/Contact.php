<?php

namespace Contact\Bundle\ContactBundle\Model;

/**
 * Contact
 */
class Contact implements ContactInterface
{
    /**
     * @var integer
     */
    protected $id;

    /**
     * @var string
     */
    protected $firstName;

    /**
     * @var string
     */
    protected $surname;

    /**
     * @var string
     */
    protected $middleNames;

    /**
     * @var \DateTime
     */
    protected $dateAdded;

    /**
     * @var boolean
     */
    protected $favourite;


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set firstName
     *
     * @param string $firstName
     * @return Contact
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;

        return $this;
    }

    /**
     * Get firstName
     *
     * @return string 
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * Set surname
     *
     * @param string $surname
     * @return Contact
     */
    public function setSurname($surname)
    {
        $this->surname = $surname;

        return $this;
    }

    /**
     * Get surname
     *
     * @return string 
     */
    public function getSurname()
    {
        return $this->surname;
    }

    /**
     * Set middleNames
     *
     * @param string $middleNames
     * @return Contact
     */
    public function setMiddleNames($middleNames)
    {
        $this->middleNames = $middleNames;

        return $this;
    }

    /**
     * Get middleNames
     *
     * @return string 
     */
    public function getMiddleNames()
    {
        return $this->middleNames;
    }

    /**
     * Set dateAdded
     *
     * @param \DateTime $dateAdded
     * @return Contact
     */
    public function setDateAdded($dateAdded)
    {
        $this->dateAdded = $dateAdded;

        return $this;
    }

    /**
     * Get dateAdded
     *
     * @return \DateTime 
     */
    public function getDateAdded()
    {
        return $this->dateAdded;
    }

    /**
     * Set favourite
     *
     * @param boolean $favourite
     * @return Contact
     */
    public function setFavourite($favourite)
    {
        $this->favourite = $favourite;

        return $this;
    }

    /**
     * Get favourite
     *
     * @return boolean 
     */
    public function getFavourite()
    {
        return $this->favourite;
    }

    /**
     * Get favourite proxy
     *
     * @return boolean 
     */
    public function isFavourite()
    {
        return $this->favourite;
    }
}
