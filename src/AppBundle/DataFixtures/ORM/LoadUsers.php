<?php
namespace AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\Entity\User;

class LoadUserData extends AbstractFixture implements OrderedFixtureInterface {
    
    public function load(ObjectManager $manager) {
        $userAdmin = new User();
        $userAdmin->setUsername('admin');
        $userAdmin->setEmail('admin@whitesite.eu');
        $userAdmin->setPlainPassword('admin123');
        $userAdmin->setEnabled('true');
        $userAdmin->addRole("ROLE_SUPER_ADMIN");

        $manager->persist($userAdmin);
        $manager->flush();
    }
    
    public function getOrder() {
        return 1;
    }
}