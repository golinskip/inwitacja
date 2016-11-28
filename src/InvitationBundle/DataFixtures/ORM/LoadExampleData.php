<?php
namespace InvitationBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use InvitationBundle\Entity\Event;
use DateTime;

class LoadExampleData extends AbstractFixture implements OrderedFixtureInterface {
    
    public function load(ObjectManager $manager) {
        $User = $manager->getRepository('AppBundle:User')->findAll()[0];
            
        $EventType = $manager->getRepository('InvitationBundle:EventType')->findAll()[0];
        
        $Event = new Event;
        $Event->setName('Rocznica ślubu Kaliny i Pawła');
        $Event->setDate(new DateTime('2017-06-11'));
        $Event->setCreatedBy($User);
        $Event->setEventType($EventType);
        
        $manager->persist($Event);
        $manager->flush();
    }
    
    
    public function getOrder() {
        return 100;
    }
}