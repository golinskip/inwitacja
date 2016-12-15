<?php

namespace InvitationBundle\Entity;

/**
 * Parameter
 */
class Parameter
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
    private $type;

    /**
     * @var string
     */
    private $description;

    /**
     * @var bool
     */
    private $isCustom;
    
    private $event;
    
    private $parameterValue;
    
    private $predefiniedParameter;
    
    private $valueDetails;


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
     * @return Parameter
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
     * Set type
     *
     * @param string $type
     *
     * @return Parameter
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Parameter
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
     * Set isCustom
     *
     * @param boolean $isCustom
     *
     * @return Parameter
     */
    public function setIsCustom($isCustom)
    {
        $this->isCustom = $isCustom;

        return $this;
    }

    /**
     * Get isCustom
     *
     * @return bool
     */
    public function getIsCustom()
    {
        return $this->isCustom;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->event = new \Doctrine\Common\Collections\ArrayCollection();
        $this->parameterValue = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add event
     *
     * @param \InvitationBundle\Entity\Event $event
     *
     * @return Parameter
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
     * Add parameterValue
     *
     * @param \InvitationBundle\Entity\ParameterValue $parameterValue
     *
     * @return Parameter
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
     * Set predefiniedParameter
     *
     * @param \InvitationBundle\Entity\PredefiniedParameter $predefiniedParameter
     *
     * @return Parameter
     */
    public function setPredefiniedParameter(\InvitationBundle\Entity\PredefiniedParameter $predefiniedParameter = null)
    {
        $this->predefiniedParameter = $predefiniedParameter;

        return $this;
    }

    /**
     * Get predefiniedParameter
     *
     * @return \InvitationBundle\Entity\PredefiniedParameter
     */
    public function getPredefiniedParameter()
    {
        return $this->predefiniedParameter;
    }
    
    /**
     * Set valueDetails
     *
     * @param string $valueDetails
     *
     * @return Parameter
     */
    public function setValueDetails($valueDetails)
    {
        $this->valueDetails = $valueDetails;

        return $this;
    }

    /**
     * Get valueDetails
     *
     * @return string
     */
    public function getValueDetails()
    {
        return $this->valueDetails;
    }
}
