<?php
namespace InvitationBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use InvitationBundle\Entity\EventRole;

class LoadRoles implements FixtureInterface {
    
    public function load(ObjectManager $manager) {
        
        $eventRole = new EventRole;
        $eventRole->setName("owner");
        $eventRole->setTitle("Owner");
        $eventRole->setSpecialName("owner");
            
        $manager->persist($eventRole);
        $manager->flush();
    }
}