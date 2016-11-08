<?php
// src/AppBundle/Entity/User.php

namespace AppBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;

class User extends BaseUser
{
    protected $id;
	private $eventAggr;
	

    public function __construct()
    {
        parent::__construct();
        // your own logic
    }

    /**
     * Add eventAggr
     *
     * @param \InvitationBundle\Entity\UserEventRoleEvent $eventAggr
     *
     * @return User
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
}
