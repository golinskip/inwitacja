<?php

namespace InvitationBundle\Entity;

/**
 * Event
 */
class Event
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
    private $description;

    /**
     * @var string
     */
    private $place;

    /**
     * @var string
     */
    private $placeCoord;

    /**
     * @var \DateTime
     */
    private $date;

    /**
     * @var \DateTime
     */
    private $createdAt;
	
	private $eventAggr;
	
	private $eventType;
    
    private $invitationGroup;
    
    private $parameter;
    
    private $invitation;
    
    private $message;
    
    private $updatedAt;


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
     * @return Event
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
     * @return Event
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
     * Set description
     *
     * @param string $description
     *
     * @return Event
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set place
     *
     * @param string $place
     *
     * @return Event
     */
    public function setPlace($place)
    {
        $this->place = $place;

        return $this;
    }

    /**
     * Get place
     *
     * @return string
     */
    public function getPlace()
    {
        return $this->place;
    }

    /**
     * Set placeCoord
     *
     * @param string $placeCoord
     *
     * @return Event
     */
    public function setPlaceCoord($placeCoord)
    {
        $this->placeCoord = $placeCoord;

        return $this;
    }

    /**
     * Get placeCoord
     *
     * @return string
     */
    public function getPlaceCoord()
    {
        return $this->placeCoord;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     *
     * @return Event
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return Event
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set updateddAt
     *
     * @param \DateTime $createdAt
     *
     * @return Event
     */
    public function setUpdatedAt($createdAt)
    {
        $this->updatedAt = $createdAt;

        return $this;
    }

    /**
     * Get updatedAt
     *
     * @return \DateTime
     */
    public function getUpdateddAt()
    {
        return $this->updatedAt;
    }
    
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->eventAggr = new \Doctrine\Common\Collections\ArrayCollection();
        $this->invitationGroup = new \Doctrine\Common\Collections\ArrayCollection();
        $this->parameter = new \Doctrine\Common\Collections\ArrayCollection();
        $this->invitation = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add eventAggr
     *
     * @param \InvitationBundle\Entity\UserEventRoleEvent $eventAggr
     *
     * @return Event
     */
    public function addEventAggr(\InvitationBundle\Entity\UserEventRoleEvent $eventAggr)
    {
        $this->eventAggr[] = $eventAggr;

        return $this;
    }

    /**
     * Remove eventAggr
     *
     * @param \InvitationBundle\Entity\UserEventRoleEvent $eventAggr
     */
    public function removeEventAggr(\InvitationBundle\Entity\UserEventRoleEvent $eventAggr)
    {
        $this->eventAggr->removeElement($eventAggr);
    }

    /**
     * Get eventAggr
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getEventAggr()
    {
        return $this->eventAggr;
    }

    /**
     * Add invitationGroup
     *
     * @param \InvitationBundle\Entity\InvitationGroup $invitationGroup
     *
     * @return Event
     */
    public function addInvitationGroup(\InvitationBundle\Entity\InvitationGroup $invitationGroup)
    {
        $this->invitationGroup[] = $invitationGroup;

        return $this;
    }

    /**
     * Remove invitationGroup
     *
     * @param \InvitationBundle\Entity\InvitationGroup $invitationGroup
     */
    public function removeInvitationGroup(\InvitationBundle\Entity\InvitationGroup $invitationGroup)
    {
        $this->invitationGroup->removeElement($invitationGroup);
    }

    /**
     * Get invitationGroup
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getInvitationGroup()
    {
        return $this->invitationGroup;
    }

    /**
     * Add parameter
     *
     * @param \InvitationBundle\Entity\Parameter $parameter
     *
     * @return Event
     */
    public function addParameter(\InvitationBundle\Entity\Parameter $parameter)
    {
        $this->parameter[] = $parameter;

        return $this;
    }

    /**
     * Remove parameter
     *
     * @param \InvitationBundle\Entity\Parameter $parameter
     */
    public function removeParameter(\InvitationBundle\Entity\Parameter $parameter)
    {
        $this->parameter->removeElement($parameter);
    }

    /**
     * Get parameter
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getParameter()
    {
        return $this->parameter;
    }

    /**
     * Add invitation
     *
     * @param \InvitationBundle\Entity\Invitation $invitation
     *
     * @return Event
     */
    public function addInvitation(\InvitationBundle\Entity\Invitation $invitation)
    {
        $this->invitation[] = $invitation;

        return $this;
    }

    /**
     * Remove invitation
     *
     * @param \InvitationBundle\Entity\Invitation $invitation
     */
    public function removeInvitation(\InvitationBundle\Entity\Invitation $invitation)
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

    /**
     * Set eventType
     *
     * @param \InvitationBundle\Entity\EventType $eventType
     *
     * @return Event
     */
    public function setEventType(\InvitationBundle\Entity\EventType $eventType = null)
    {
        $this->eventType = $eventType;

        return $this;
    }

    /**
     * Get eventType
     *
     * @return \InvitationBundle\Entity\EventType
     */
    public function getEventType()
    {
        return $this->eventType;
    }

    /**
     * Add message
     *
     * @param \InvitationBundle\Entity\Message $message
     *
     * @return Event
     */
    public function addMessage(\InvitationBundle\Entity\Message $message)
    {
        $this->message[] = $message;

        return $this;
    }

    /**
     * Remove message
     *
     * @param \InvitationBundle\Entity\Message $message
     */
    public function removeMessage(\InvitationBundle\Entity\Message $message)
    {
        $this->message->removeElement($message);
    }

    /**
     * Get message
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getMessage()
    {
        return $this->message;
    }
    
    public function fillEmptyFields() {
        if($this->getCreatedAt() == null) {
            $this->setCreatedAt(new \DateTime());
        }
        
        $this->setUpdatedAt(new \DateTime());
        
        if($this->getUrlName() == null) {
            $this->setUrlName($this->slug($this->getName()));
        }
    }
    
    protected function slug($string) {
        return preg_replace('/[^\da-z]/i', '-',strtolower(iconv('UTF-8', 'ASCII//TRANSLIT//IGNORE', $string)));
    }
}
