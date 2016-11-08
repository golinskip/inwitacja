<?php

namespace InvitationBundle\Entity;

/**
 * Invitation
 */
class Invitation
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
     * @var string
     */
    private $urlName;

    /**
     * @var string
     */
    private $email;

    /**
     * @var string
     */
    private $phone;

    /**
     * @var int
     */
    private $code;

    /**
     * @var \DateTime
     */
    private $addDate;

    /**
     * @var \DateTime
     */
    private $lastChange;

    /**
     * @var int
     */
    private $status;

    /**
     * @var int
     */
    private $innerOrder;
    
    private $person;
    
    private $changelog;
    
    private $invitationGroup;
    
    private $event;
    
    private $message;


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
     * @return Invitation
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
     * Set urlName
     *
     * @param string $urlName
     *
     * @return Invitation
     */
    public function setUrlName($urlName)
    {
        $this->urlName = $urlName;

        return $this;
    }

    /**
     * Get urlName
     *
     * @return string
     */
    public function getUrlName()
    {
        return $this->urlName;
    }

    /**
     * Set email
     *
     * @param string $email
     *
     * @return Invitation
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set phone
     *
     * @param string $phone
     *
     * @return Invitation
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;

        return $this;
    }

    /**
     * Get phone
     *
     * @return string
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * Set code
     *
     * @param integer $code
     *
     * @return Invitation
     */
    public function setCode($code)
    {
        $this->code = $code;

        return $this;
    }

    /**
     * Get code
     *
     * @return int
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * Set addDate
     *
     * @param \DateTime $addDate
     *
     * @return Invitation
     */
    public function setAddDate($addDate)
    {
        $this->addDate = $addDate;

        return $this;
    }

    /**
     * Get addDate
     *
     * @return \DateTime
     */
    public function getAddDate()
    {
        return $this->addDate;
    }

    /**
     * Set lastChange
     *
     * @param \DateTime $lastChange
     *
     * @return Invitation
     */
    public function setLastChange($lastChange)
    {
        $this->lastChange = $lastChange;

        return $this;
    }

    /**
     * Get lastChange
     *
     * @return \DateTime
     */
    public function getLastChange()
    {
        return $this->lastChange;
    }

    /**
     * Set status
     *
     * @param integer $status
     *
     * @return Invitation
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
     * @return Invitation
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
        $this->person = new \Doctrine\Common\Collections\ArrayCollection();
        $this->changelog = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add person
     *
     * @param \InvitationBundle\Entity\Person $person
     *
     * @return Invitation
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
     * Add changelog
     *
     * @param \InvitationBundle\Entity\Changelog $changelog
     *
     * @return Invitation
     */
    public function addChangelog(\InvitationBundle\Entity\Changelog $changelog)
    {
        $this->changelog[] = $changelog;

        return $this;
    }

    /**
     * Remove changelog
     *
     * @param \InvitationBundle\Entity\Changelog $changelog
     */
    public function removeChangelog(\InvitationBundle\Entity\Changelog $changelog)
    {
        $this->changelog->removeElement($changelog);
    }

    /**
     * Get changelog
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getChangelog()
    {
        return $this->changelog;
    }

    /**
     * Set invitationGroup
     *
     * @param \InvitationBundle\Entity\InvitationGroup $invitationGroup
     *
     * @return Invitation
     */
    public function setInvitationGroup(\InvitationBundle\Entity\InvitationGroup $invitationGroup = null)
    {
        $this->invitationGroup = $invitationGroup;

        return $this;
    }

    /**
     * Get invitationGroup
     *
     * @return \InvitationBundle\Entity\InvitationGroup
     */
    public function getInvitationGroup()
    {
        return $this->invitationGroup;
    }

    /**
     * Set event
     *
     * @param \InvitationBundle\Entity\Event $event
     *
     * @return Invitation
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
}
