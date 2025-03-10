<?php

namespace InvitationBundle\Entity;

/**
 * ParameterValue
 */
class ParameterValue
{

    /**
     * @var string
     */
    private $value;
    
    private $personId;
    
    private $parameterId;
    
    private $parameter;
    
    private $person;


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
     * Set value
     *
     * @param string $value
     *
     * @return ParameterValue
     */
    public function setValue($value)
    {
        $this->value = serialize($value);

        return $this;
    }

    /**
     * Get value
     *
     * @return mixed
     */
    public function getValue()
    {
        return @unserialize($this->value);
    }
    
    /**
     * Get string value
     *
     * @return mixed
     */
    public function getStringValue()
    {
        $val = $this->getValue();
        switch(gettype($val)) {
            case 'array':
                return implode(', ', $val);
            case 'string':
                return trim($val);
            default:
                return trim((string)$val);
        }
    }

    /**
     * Set personId
     *
     * @param integer $personId
     *
     * @return ParameterValue
     */
    public function setPersonId($personId)
    {
        $this->personId = $personId;

        return $this;
    }

    /**
     * Get personId
     *
     * @return integer
     */
    public function getPersonId()
    {
        return $this->personId;
    }

    /**
     * Set parameterId
     *
     * @param integer $parameterId
     *
     * @return ParameterValue
     */
    public function setParameterId($parameterId)
    {
        $this->parameterId = $parameterId;

        return $this;
    }

    /**
     * Get parameterId
     *
     * @return integer
     */
    public function getParameterId()
    {
        return $this->parameterId;
    }

    /**
     * Set parameter
     *
     * @param \InvitationBundle\Entity\Parameter $parameter
     *
     * @return ParameterValue
     */
    public function setParameter(\InvitationBundle\Entity\Parameter $parameter = null)
    {
        $this->setParameterId($parameter->getId());
        $this->parameter = $parameter;

        return $this;
    }

    /**
     * Get parameter
     *
     * @return \InvitationBundle\Entity\Parameter
     */
    public function getParameter()
    {
        
        return $this->parameter;
    }

    /**
     * Set person
     *
     * @param \InvitationBundle\Entity\Person $person
     *
     * @return ParameterValue
     */
    public function setPerson(\InvitationBundle\Entity\Person $person = null)
    {
        $this->setPersonId($person->getId());
        $this->person = $person;

        return $this;
    }

    /**
     * Get person
     *
     * @return \InvitationBundle\Entity\Person
     */
    public function getPerson()
    {
        return $this->person;
    }
}
