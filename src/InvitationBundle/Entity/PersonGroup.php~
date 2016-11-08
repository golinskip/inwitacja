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
    
    private $invitation;


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
        $this->invitation = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add invitation
     *
     * @param \InvitationBundle\Entity\Person $invitation
     *
     * @return PersonGroup
     */
    public function addInvitation(\InvitationBundle\Entity\Person $invitation)
    {
        $this->invitation[] = $invitation;

        return $this;
    }

    /**
     * Remove invitation
     *
     * @param \InvitationBundle\Entity\Person $invitation
     */
    public function removeInvitation(\InvitationBundle\Entity\Person $invitation)
    {
        $this->invitation->removeElement($invitation);
    }

    /**
     * Get invitation
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getInvitation()
    {
        return $this->invitation;
    }
}
