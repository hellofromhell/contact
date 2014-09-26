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
    protected $favourite = false;

    protected $addresses;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->addresses = new \Doctrine\Common\Collections\ArrayCollection();
    }


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
     * Get full name.
     *
     * @return string 
     */
    public function getFullName($quotes)
    {
        if ($middle = $this->getMiddleNames()) {
            if ($quotes) {
                $middle = '&lsquo;' . $middle . '&rsquo;';
            }
        }
        return implode(' ', array($this->getFirstName(), $middle, $this->getSurname()));
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
     * Set dateAdded to current datetime
     *
     * @param \DateTime $dateAdded
     * @return Contact
     */
    public function setDateAddedToNow()
    {
        $this->dateAdded = new \DateTime();
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
     * Add addresses
     *
     * @param \Contact\Bundle\ContactBundle\Entity\ContactAddress $addresses
     * @return Contact
     */
    public function addAddress(\Contact\Bundle\ContactBundle\Entity\ContactAddress $addresses)
    {
        $this->addresses[] = $addresses;

        return $this;
    }

    /**
     * Remove addresses
     *
     * @param \Contact\Bundle\ContactBundle\Entity\ContactAddress $addresses
     */
    public function removeAddress(\Contact\Bundle\ContactBundle\Entity\ContactAddress $addresses)
    {
        $this->addresses->removeElement($addresses);
    }

    /**
     * Get addresses
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getAddresses()
    {
        return $this->addresses;
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
