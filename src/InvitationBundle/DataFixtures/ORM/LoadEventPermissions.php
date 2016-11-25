<?php
namespace InvitationBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use InvitationBundle\Entity\EventRole;
use InvitationBundle\Entity\Action;

class LoadEventPermissions implements FixtureInterface {
    
    private $actionList = array(
        'event.view',
        'event.edit',
        'event.edit.guests',
        'event.remove',
    );
    
    public function load(ObjectManager $manager) {
        
        $EventRole = new EventRole;
        $EventRole->setName("owner");
        $EventRole->setTitle("Owner");
        $EventRole->setSpecialName("owner");
            
        $manager->persist($EventRole);
        $manager->flush();
        
        $this->loadActions($manager, $EventRole);
    }
    
    public function loadActions($manager, $EventRole) {
        foreach($this->actionList as $action) {
            $Action = new Action;
            $Action->setTag($action);
            $Action->setName($action);
            
            $Action->addEventRole($EventRole);
            
            $manager->persist($Action);
            $manager->flush();
        }
    }
}