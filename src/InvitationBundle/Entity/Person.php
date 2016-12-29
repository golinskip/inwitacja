<?php

namespace InvitationBundle\Entity;

/**
 * Person
 */
class Person
{
    const STATUS_UNDEFINED = 0;
    const STATUS_ENABLE = 1;
    const STATUS_DISABLE = 2;
    
    const PERSON_PRESENT = 'present';
    const PERSON_ABSENT = 'absent';
    
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $name;

    /**
     * @var int
     */
    private $status = 0;

    /**
     * @var int
     */
    private $innerOrder;
    
    private $parameterValue;
    
    private $personGroup;
    
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
     * @return Person
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
     * Set status
     *
     * @param integer $status
     *
     * @return Person
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return int
     */
    public function getStatus()
    {
        return $this->status;
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
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->parameterValue = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add parameterValue
     *
     * @param \InvitationBundle\Entity\ParameterValue $parameterValue
     *
     * @return Person
     */
    public function addParameterValue(\InvitationBundle\Entity\ParameterValue $parameterValue)
    {
        $this->parameterValue[] = $parameterValue;

        return $this;
    }

    /**
     * Remove parameterValue
     *
     * @param \InvitationBundle\Entity\ParameterValue $parameterValue
     */
    public function removeParameterValue(\InvitationBundle\Entity\ParameterValue $parameterValue)
    {
        $this->parameterValue->removeElement($parameterValue);
    }

    /**
     * Get parameterValue
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getParameterValue()
    {
        return $this->parameterValue;
    }

    /**
     * Set personGroup
     *
     * @param \InvitationBundle\Entity\PersonGroup $personGroup
     *
     * @return Person
     */
    public function setPersonGroup(\InvitationBundle\Entity\PersonGroup $personGroup = null)
    {
        $this->personGroup = $personGroup;

        return $this;
    }

    /**
     * Get personGroup
     *
     * @return \InvitationBundle\Entity\PersonGroup
     */
    public function getPersonGroup()
    {
        return $this->personGroup;
    }

    /**
     * Set invitation
     *
     * @param \InvitationBundle\Entity\Invitation $invitation
     *
     * @return Person
     */
    public function setInvitation(\InvitationBundle\Entity\Invitation $invitation = null)
    {
        $this->invitation = $invitation;

        return $this;
    }

    /**
     * Get invitation
     *
     * @return \InvitationBundle\Entity\Invitation
     */
    public function getInvitation()
    {
        return $this->invitation;
    }
}
