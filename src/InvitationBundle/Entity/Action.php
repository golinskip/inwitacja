<?php

namespace InvitationBundle\Entity;

/**
 * Action
 */
class Action
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
    private $tag;
    
    private $eventRoles;


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
     * @return Action
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
     * Set tag
     *
     * @param string $tag
     *
     * @return Action
     */
    public function setTag($tag)
    {
        $this->tag = $tag;

        return $this;
    }

    /**
     * Get tag
     *
     * @return string
     */
    public function getTag()
    {
        return $this->tag;
    }

    /**
     * Set eventRoles
     *
     * @param string $eventRoles
     *
     * @return Action
     */
    public function setEventRoles($eventRoles)
    {
        $this->eventRoles = $eventRoles;

        return $this;
    }

    /**
     * Get eventRoles
     *
     * @return string
     */
    public function getEventRoles()
    {
        return $this->eventRoles;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->eventRoles = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add eventRole
     *
     * @param \InvitationBundle\Entity\EventRole $eventRole
     *
     * @return Action
     */
    public function addEventRole(\InvitationBundle\Entity\EventRole $eventRole)
    {
        $this->eventRoles[] = $eventRole;
        $eventRole->addAction($this);

        return $this;
    }

    /**
     * Remove eventRole
     *
     * @param \InvitationBundle\Entity\EventRole $eventRole
     */
    public function removeEventRole(\InvitationBundle\Entity\EventRole $eventRole)
    {
        $this->eventRoles->removeElement($eventRole);
    }
}
