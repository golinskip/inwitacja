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
        $this->value = $value;

        return $this;
    }

    /**
     * Get value
     *
     * @return string
     */
    public function getValue()
    {
        return $this->value;
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
