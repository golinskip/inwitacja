<?php

namespace InvitationBundle\Entity;

/**
 * InvitationGroup
 */
class InvitationGroup
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
    private $color;

    private $invitation;
    
    
    /**
     * @var \InvitationBundle\Entity\Event
     */
    private $event;

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
     * @return InvitationGroup
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
     * Set color
     *
     * @param string $color
     *
     * @return InvitationGroup
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
     * @param \InvitationBundle\Entity\Invitation $invitation
     *
     * @return InvitationGroup
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
     * Set event
     *
     * @param \InvitationBundle\Entity\Event $event
     *
     * @return InvitationGroup
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
