<?php

namespace InvitationBundle\Entity;

/**
 * Changelog
 */
class Changelog
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $type;

    /**
     * @var \DateTime
     */
    private $date;

    /**
     * @var string
     */
    private $ip;

    /**
     * @var string
     */
    private $userAgent;
    
    private $changelogDetail;
    
    private $user;
    
    private $invitation;


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
     * Set type
     *
     * @param string $type
     *
     * @return Changelog
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
     * Set date
     *
     * @param \DateTime $date
     *
     * @return Changelog
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set ip
     *
     * @param string $ip
     *
     * @return Changelog
     */
    public function setIp($ip)
    {
        $this->ip = $ip;

        return $this;
    }

    /**
     * Get ip
     *
     * @return string
     */
    public function getIp()
    {
        return $this->ip;
    }

    /**
     * Set userAgent
     *
     * @param string $userAgent
     *
     * @return Changelog
     */
    public function setUserAgent($userAgent)
    {
        $this->userAgent = $userAgent;

        return $this;
    }

    /**
     * Get userAgent
     *
     * @return string
     */
    public function getUserAgent()
    {
        return $this->userAgent;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->changelogDetail = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add changelogDetail
     *
     * @param \InvitationBundle\Entity\ChangelogDetail $changelogDetail
     *
     * @return Changelog
     */
    public function addChangelogDetail(\InvitationBundle\Entity\ChangelogDetail $changelogDetail)
    {
        $this->changelogDetail[] = $changelogDetail;

        return $this;
    }

    /**
     * Remove changelogDetail
     *
     * @param \InvitationBundle\Entity\ChangelogDetail $changelogDetail
     */
    public function removeChangelogDetail(\InvitationBundle\Entity\ChangelogDetail $changelogDetail)
    {
        $this->changelogDetail->removeElement($changelogDetail);
    }

    /**
     * Get changelogDetail
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getChangelogDetail()
    {
        return $this->changelogDetail;
    }

    /**
     * Set user
     *
     * @param \AppBundle\Entity\User $user
     *
     * @return Changelog
     */
    public function setUser(\AppBundle\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \AppBundle\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set invitation
     *
     * @param \InvitationBundle\Entity\Invitation $invitation
     *
     * @return Changelog
     */
    public function setInvitation(\InvitationBundle\Entity\Invitation $invitation = null)
    {
        $this->invitation = $invitation;

        return $this;
    }

    /**
     * Get invitation
     *
     * @return \InvitationBundle\Entity\Invitation
     */
    public function getInvitation()
    {
        return $this->invitation;
    }
}
