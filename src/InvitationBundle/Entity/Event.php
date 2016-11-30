<?php

namespace InvitationBundle\Entity;

use Doctrine\ORM\Event\LifecycleEventArgs;
use Doctrine\ORM\PersistentCollection;

/**
 * Event
 */
class Event
{
    
    const DEFAULT_ROLE = 'owner';
    
    const URL_SPLITTER = '-';
    
    const URL_MAX_CHAR = 255;
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
    
    private $createdBy;
    
    private $permissionSet;
    
    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $personGroup;


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
    private function setCreatedAt($createdAt)
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
    private function setUpdatedAt($createdAt)
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
     * Get createdBy
     *
     * @return \AppBundle\Entity\User
     */
    public function getCreatedBy()
    {
        return $this->createdBy;
    }

    /**
     * Set createdBy
     *
     * @param \AppBundle\Entity\User $eventType
     *
     * @return Event
     */
    public function setCreatedBy(\AppBundle\Entity\User $createdBy)
    {
        $this->createdBy = $createdBy;

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
    
    public function beforeUpdate(LifecycleEventArgs $e) {
        $this->setUpdatedAt(new \DateTime());
    }
    
    public function fillEmptyFields(LifecycleEventArgs $e) {
        $em = $e->getObjectManager();
        $this->setCreatedAt(new \DateTime());
        $this->setUpdatedAt(new \DateTime());
        if($this->getUrlName() == null) {
            $urlName = $this->slug($this->getName());
        }
        $tryCount = 1;
        $urlNameCurrent = $urlName;
        do {
            $ExistedEvent = $em
                ->getRepository('InvitationBundle:Event')
                ->findOneByUrlName($urlNameCurrent);
            if(is_null($ExistedEvent)) {
                break;
            }
            $sufx = self::URL_SPLITTER.$tryCount;
            $urlNameCurrent = substr($urlName, 0, self::URL_MAX_CHAR-strlen($sufx)).$sufx;
            $tryCount++;
        } while(true);
        $this->setUrlName($urlNameCurrent);
    }
    
    public function assignAsOwner(LifecycleEventArgs $e) {
        $em = $e->getObjectManager();
        $EventRole = $em
            ->getRepository('InvitationBundle:EventRole')
            ->findOneBySpecialName(self::DEFAULT_ROLE);
                
        $UserEventRoleEvent = new UserEventRoleEvent;
        $UserEventRoleEvent->setUser($this->getCreatedBy());
        $UserEventRoleEvent->setEventRole($EventRole);
        $UserEventRoleEvent->setEvent($this);
            
        $em->persist($UserEventRoleEvent);
        $em->flush();
    }
    
    protected function slug($string) {
        $string = trim(preg_replace('/[^\da-z]/i', ' ',strtolower(iconv('UTF-8', 'ASCII//TRANSLIT//IGNORE', $string))));
        return str_replace(' ', self::URL_SPLITTER, $string);
    }
    
    public function checkPermission($tag) {
        if($this->permissionSet == null) {
            return false;
        }
        if(!isset($this->permissionSet[$tag])) {
            return false;
        }
        return $this->permissionSet[$tag];
        
    }
    
    public function loadPermissionSet($User) {
        $permissionSet = $this->getUserActions($User);
        $this->permissionSet = [];
        foreach($permissionSet as $Action) {
            $this->permissionSet[$Action->getTag()] = true;
        }
    }
    
    public function getUserActions($User) {
        $Actions = [];
        foreach($this->getEventAggr() as $EventAggr) {
            if($EventAggr->getUser()->getId() == $User->getId()) {
                $Actions = $Actions + $EventAggr->getEventRole()->getActions()->toArray();
            }
        }
        
        return $Actions;
    }


    /**
     * Get updatedAt
     *
     * @return \DateTime
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * Add personGroup
     *
     * @param \InvitationBundle\Entity\PersonGroup $personGroup
     *
     * @return Event
     */
    public function addPersonGroup(\InvitationBundle\Entity\PersonGroup $personGroup)
    {
        $this->personGroup[] = $personGroup;

        return $this;
    }

    /**
     * Remove personGroup
     *
     * @param \InvitationBundle\Entity\PersonGroup $personGroup
     */
    public function removePersonGroup(\InvitationBundle\Entity\PersonGroup $personGroup)
    {
        $this->personGroup->removeElement($personGroup);
    }

    /**
     * Get personGroup
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPersonGroup()
    {
        return $this->personGroup;
    }
}
