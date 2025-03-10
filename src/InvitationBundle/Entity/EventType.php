<?php

namespace InvitationBundle\Entity;

/**
 * EventType
 */
class EventType
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $name;
    
    private $event;
    
    private $image;
    
    /**
     * @var \AppBundle\Entity\Translation
     */
    private $nameTranslation;


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
     * @return EventType
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
     * Constructor
     */
    public function __construct()
    {
        $this->event = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add event
     *
     * @param \InvitationBundle\Entity\Event $event
     *
     * @return EventType
     */
    public function addEvent(\InvitationBundle\Entity\Event $event)
    {
        $this->event[] = $event;

        return $this;
    }

    /**
     * Remove event
     *
     * @param \InvitationBundle\Entity\Event $event
     */
    public function removeEvent(\InvitationBundle\Entity\Event $event)
    {
        $this->event->removeElement($event);
    }

    /**
     * Get event
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getEvent()
    {
        return $this->event;
    }

    /**
     * Set image
     *
     * @param string $image
     *
     * @return EventType
     */
    public function setImage($image)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get image
     *
     * @return string
     */
    public function getImage()
    {
        return $this->image;
    }


    /**
     * Set nameTranslation
     *
     * @param \AppBundle\Entity\Translation $nameTranslation
     *
     * @return EventType
     */
    public function setNameTranslation(\AppBundle\Entity\Translation $nameTranslation = null)
    {
        $this->nameTranslation = $nameTranslation;

        return $this;
    }

    /**
     * Get nameTranslation
     *
     * @return \AppBundle\Entity\Translation
     */
    public function getNameTranslation()
    {
        return $this->nameTranslation;
    }
}
