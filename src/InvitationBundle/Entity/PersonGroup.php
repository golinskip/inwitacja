<?php

namespace InvitationBundle\Entity;

/**
 * PersonGroup
 */
class PersonGroup
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $name;

    /**
     * @var float
     */
    private $price;

    /**
     * @var string
     */
    private $color;
    
    private $person;
    
    /**
     * @var \InvitationBundle\Entity\Event
     */
    private $event;

    /**
     * @var int
     */
    private $innerOrder;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return PersonGroup
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set price
     *
     * @param float $price
     *
     * @return PersonGroup
     */
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Get price
     *
     * @return float
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Set color
     *
     * @param string $color
     *
     * @return PersonGroup
     */
    public function setColor($color)
    {
        $this->color = $color;

        return $this;
    }

    /**
     * Get color
     *
     * @return string
     */
    public function getColor()
    {
        return $this->color;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->person = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add person
     *
     * @param \InvitationBundle\Entity\Person $person
     *
     * @return PersonGroup
     */
    public function addPerson(\InvitationBundle\Entity\Person $person)
    {
        $this->person[] = $person;

        return $this;
    }

    /**
     * Remove person
     *
     * @param \InvitationBundle\Entity\Person $person
     */
    public function removePerson(\InvitationBundle\Entity\Person $person)
    {
        $this->person->removeElement($person);
    }

    /**
     * Get person
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPerson()
    {
        return $this->person;
    }


    /**
     * Set event
     *
     * @param \InvitationBundle\Entity\Event $event
     *
     * @return PersonGroup
     */
    public function setEvent(\InvitationBundle\Entity\Event $event = null)
    {
        $this->event = $event;

        return $this;
    }

    /**
     * Get event
     *
     * @return \InvitationBundle\Entity\Event
     */
    public function getEvent()
    {
        return $this->event;
    }

    /**
     * Set innerOrder
     *
     * @param integer $innerOrder
     *
     * @return Person
     */
    public function setInnerOrder($innerOrder)
    {
        $this->innerOrder = $innerOrder;

        return $this;
    }

    /**
     * Get innerOrder
     *
     * @return int
     */
    public function getInnerOrder()
    {
        return $this->innerOrder;
    }
}
