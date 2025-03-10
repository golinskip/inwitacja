<?php

namespace InvitationBundle\Entity;

/**
 * EventRole
 */
class EventRole
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $name;
	
    private $actions;
	
    private $eventAggr;
    
    private $specialName;
    
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
     * @return EventRole
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
	
	public function __construct() {
		$this->actions = new \Doctrine\Common\Collections\ArrayCollection();
	}

    /**
     * Set specialName
     *
     * @param string $specialName
     *
     * @return EventRole
     */
    public function setSpecialName($specialName)
    {
        $this->specialName = $specialName;

        return $this;
    }

    /**
     * Get specialName
     *
     * @return string
     */
    public function getSpecialName()
    {
        return $this->specialName;
    }

    /**
     * Add eventAggr
     *
     * @param \InvitationBundle\Entity\UserEventRoleEvent $eventAggr
     *
     * @return EventRole
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
     * Add action
     *
     * @param \InvitationBundle\Entity\Action $action
     *
     * @return EventRole
     */
    public function addAction(\InvitationBundle\Entity\Action $action)
    {
        $this->actions[] = $action;
        return $this;
    }

    /**
     * Remove action
     *
     * @param \InvitationBundle\Entity\Action $action
     */
    public function removeAction(\InvitationBundle\Entity\Action $action)
    {
        $this->actions->removeElement($action);
    }

    /**
     * Get actions
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getActions()
    {
        return $this->actions;
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
