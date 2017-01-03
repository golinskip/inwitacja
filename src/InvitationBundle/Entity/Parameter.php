<?php

namespace InvitationBundle\Entity;

/**
 * Parameter
 */
class Parameter
{
    const TYPE_LOGIC = 'logic';
    const TYPE_NUMBER = 'number';
    const TYPE_TEXT = 'text';
    const TYPE_ENUM = 'enum';
    
    public static $typeList = [
        self::TYPE_LOGIC,
        //self::TYPE_NUMBER,
        self::TYPE_TEXT,
        self::TYPE_ENUM,
    ];
    
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
    
    private $event;
    
    private $parameterValue;
    
    private $predefiniedParameter;
    
    private $typeConfig;

    /**
     * @var int
     */
    private $innerOrder;


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
     * Constructor
     */
    public function __construct()
    {
        $this->event = new \Doctrine\Common\Collections\ArrayCollection();
        $this->parameterValue = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set typeConfig
     *
     * @param string $typeConfig
     *
     * @return Parameter
     */
    public function setTypeConfig($typeConfig)
    {
        $this->typeConfig = $typeConfig;

        return $this;
    }

    /**
     * Get typeConfig
     *
     * @return string
     */
    public function getTypeConfig()
    {
        return $this->typeConfig;
    }
    
    public function getTypeConfigObj() {
        $TypeObj = @unserialize(base64_decode($this->getTypeConfig()));
        $TypeObjClass = "InvitationBundle\\Entity\\ParameterType\\".ucfirst($this->getType());
        if(!is_object($TypeObj) || get_class($TypeObj) !== $TypeObjClass ) {
            $TypeObj = new $TypeObjClass;
        }
        return $TypeObj;
    }
    
    public function getTypeList() {
        return self::$typeList;
    }

    /**
     * Set event
     *
     * @param \InvitationBundle\Entity\Event $event
     *
     * @return Parameter
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

    /**
     * Set innerOrder
     *
     * @param integer $innerOrder
     *
     * @return Person
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
}
