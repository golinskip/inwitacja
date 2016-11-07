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
}

