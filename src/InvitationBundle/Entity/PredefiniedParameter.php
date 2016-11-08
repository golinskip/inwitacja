<?php

namespace InvitationBundle\Entity;

/**
 * PredefiniedParameter
 */
class PredefiniedParameter
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

    private $parameter;

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
     * @return PredefiniedParameter
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
     * @return PredefiniedParameter
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
     * Constructor
     */
    public function __construct()
    {
        $this->parameter = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add parameter
     *
     * @param \InvitationBundle\Entity\Parameter $parameter
     *
     * @return PredefiniedParameter
     */
    public function addParameter(\InvitationBundle\Entity\Parameter $parameter)
    {
        $this->parameter[] = $parameter;

        return $this;
    }

    /**
     * Remove parameter
     *
     * @param \InvitationBundle\Entity\Parameter $parameter
     */
    public function removeParameter(\InvitationBundle\Entity\Parameter $parameter)
    {
        $this->parameter->removeElement($parameter);
    }

    /**
     * Get parameter
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getParameter()
    {
        return $this->parameter;
    }
}
