<?php

namespace Contact\Bundle\ContactBundle\Model;

class ContactAddress implements ContactAddressInterface
{
    /**
     * @var integer
     */
    protected $id;

    /**
     * @var string
     */
    protected $title;

    /**
     * @var string
     */
    protected $lineOne;

    /**
     * @var string
     */
    protected $lineTwo;

    /**
     * @var string
     */
    protected $city;

    /**
     * @var string
     */
    protected $county;

    /**
     * @var string
     */
    protected $postCode;

    /**
     * @var \DateTime
     */
    protected $dateAdded;

    /**
     * @var \Contact\Bundle\ContactBundle\Entity\Contact
     */
    protected $contact;

    public function getId()
    {
        return $this->id;
    }

    /**
     * @param string $lineOne
     * @return ContactAddress
     */
    public function setLineOne($lineOne)
    {
        $this->lineOne = $LineOne;

        return $this;
    }

    /**
     * @return string
     */
    public function getLineOne()
    {
        return $this->lineOne;
    }

    /**
     * @param string $title
     * @return ContactAddress
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param string $lineTwo
     * @return ContactAddress
     */
    public function setLineTwo($lineTwo)
    {
        $this->lineTwo = $LineTwo;

        return $this;
    }

    /**
     * @return string
     */
    public function getLineTwo()
    {
        return $this->lineTwo;
    }

    /**
     * @param string $city
     * @return ContactAddress
     */
    public function setCity($city)
    {
        $this->city = $city;

        return $this;
    }

    /**
     * @return string
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * @param string $county
     * @return ContactAddress
     */
    public function setCounty($county)
    {
        $this->county = $county;

        return $this;
    }

    /**
     * @return string
     */
    public function getCounty()
    {
        return $this->county;
    }

    /**
     * @param string $postCode
     * @return ContactAddress
     */
    public function setPostCode($postCode)
    {
        $this->postCode = $postCode;

        return $this;
    }

    /**
     * @return string
     */
    public function getPostCode()
    {
        return $this->postCode;
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
     * Set contact
     *
     * @param \Contact\Bundle\ContactBundle\Entity\Contact $contact
     * @return ContactAddress
     */
    public function setContact(\Contact\Bundle\ContactBundle\Entity\Contact $contact = null)
    {
        $this->contact = $contact;

        return $this;
    }

    /**
     * Get contact
     *
     * @return \Contact\Bundle\ContactBundle\Entity\Contact 
     */
    public function getContact()
    {
        return $this->contact;
    }
}