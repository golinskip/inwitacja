<?php

namespace InvitationBundle\Entity;

/**
 * Person
 */
class Person
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
     * @var int
     */
    private $account;

    /**
     * @var int
     */
    private $status;

    /**
     * @var bool
     */
    private $child;

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
     * @return Person
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
     * Set account
     *
     * @param integer $account
     *
     * @return Person
     */
    public function setAccount($account)
    {
        $this->account = $account;

        return $this;
    }

    /**
     * Get account
     *
     * @return int
     */
    public function getAccount()
    {
        return $this->account;
    }

    /**
     * Set status
     *
     * @param integer $status
     *
     * @return Person
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return int
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set child
     *
     * @param boolean $child
     *
     * @return Person
     */
    public function setChild($child)
    {
        $this->child = $child;

        return $this;
    }

    /**
     * Get child
     *
     * @return bool
     */
    public function getChild()
    {
        return $this->child;
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
    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $invitation;

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
     * @return Person
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
}
