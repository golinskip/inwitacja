<?php
namespace InvitationBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use InvitationBundle\Entity\EventType;

class LoadEventType implements FixtureInterface {
    
    public function load(ObjectManager $manager) {
        $data = [
            ['wedding', 'Wesele', 'wedding.jpg'],
            ['baptism', 'Chrzciny', 'baptism.jpg'],
            ['communion', 'Komunia', 'communion.jpg'],
        ];
        
        foreach($data as $row) {
            $eventType = new EventType;
            $eventType->setName($row[0]);
            $eventType->setTitle($row[1]);
            $eventType->setImage($row[2]);
            
            $manager->persist($eventType);
            $manager->flush();
        }
    }
}