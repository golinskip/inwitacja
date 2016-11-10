<?php

namespace InvitationBundle\Entity;

/**
 * UserEventRoleEvent
 */
class UserEventRoleEvent
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var int
     */
    private $userId;

    /**
     * @var int
     */
    private $eventRoleId;

    /**
     * @var int
     */
    private $eventId;
	
	private $user;
	private $event;
    private $eventRole;


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
     * Set userId
     *
     * @param integer $userId
     *
     * @return UserEventRoleEvent
     */
    public function setUserId($userId)
    {
        $this->userId = $userId;

        return $this;
    }

    /**
     * Get userId
     *
     * @return int
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * Set eventRoleId
     *
     * @param integer $eventRoleId
     *
     * @return UserEventRoleEvent
     */
    public function setEventRoleId($eventRoleId)
    {
        $this->eventRoleId = $eventRoleId;

        return $this;
    }

    /**
     * Get eventRoleId
     *
     * @return int
     */
    public function getEventRoleId()
    {
        return $this->eventRoleId;
    }

    /**
     * Set eventId
     *
     * @param integer $eventId
     *
     * @return UserEventRoleEvent
     */
    public function setEventId($eventId)
    {
        $this->eventId = $eventId;

        return $this;
    }

    /**
     * Get eventId
     *
     * @return int
     */
    public function getEventId()
    {
        return $this->eventId;
    }

    /**
     * Set user
     *
     * @param \AppBundle\Entity\User $user
     *
     * @return UserEventRoleEvent
     */
    public function setUser(\AppBundle\Entity\User $user = null)
    {
        $this->setUserId($user->getId());
        
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \AppBundle\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set eventRole
     *
     * @param \InvitationBundle\Entity\EventRole $eventRole
     *
     * @return UserEventRoleEvent
     */
    public function setEventRole(\InvitationBundle\Entity\EventRole $eventRole = null)
    {
        $this->setEventRoleId($eventRole->getId());
        
        $this->eventRole = $eventRole;

        return $this;
    }

    /**
     * Get eventRole
     *
     * @return \InvitationBundle\Entity\EventRole
     */
    public function getEventRole()
    {
        return $this->eventRole;
    }

    /**
     * Set event
     *
     * @param \InvitationBundle\Entity\Event $event
     *
     * @return UserEventRoleEvent
     */
    public function setEvent(\InvitationBundle\Entity\Event $event = null)
    {
        $this->setEventId($event->getId());
        
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
