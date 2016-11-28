<?php
namespace AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\Entity\Language;

class LoadLanguages extends AbstractFixture implements OrderedFixtureInterface {
    
    public function load(ObjectManager $manager) {
        $Language = new Language();
        $Language->setLocale('pl');
        $Language->setName('pl');
        
        $manager->persist($Language);
        $manager->flush();
    }
    
    public function getOrder() {
        return 2;
    }
}