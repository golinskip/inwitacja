<?php

namespace InvitationBundle\Entity;

/**
 * ChangelogDetail
 */
class ChangelogDetail
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $variable;

    /**
     * @var string
     */
    private $value;
    
    private $changelog;


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
     * Set variable
     *
     * @param string $variable
     *
     * @return ChangelogDetail
     */
    public function setVariable($variable)
    {
        $this->variable = $variable;

        return $this;
    }

    /**
     * Get variable
     *
     * @return string
     */
    public function getVariable()
    {
        return $this->variable;
    }

    /**
     * Set value
     *
     * @param string $value
     *
     * @return ChangelogDetail
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
     * Set changelog
     *
     * @param \InvitationBundle\Entity\Changelog $changelog
     *
     * @return ChangelogDetail
     */
    public function setChangelog(\InvitationBundle\Entity\Changelog $changelog = null)
    {
        $this->changelog = $changelog;

        return $this;
    }

    /**
     * Get changelog
     *
     * @return \InvitationBundle\Entity\Changelog
     */
    public function getChangelog()
    {
        return $this->changelog;
    }
}
