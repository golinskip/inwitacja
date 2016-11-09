<?php
namespace AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\Entity\User;

class LoadUserData implements FixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $userAdmin = new User();
        $userAdmin->setUsername('admin');
        $userAdmin->setEmail('admin@whitesite.eu');
        $userAdmin->setPlainPassword('admin123');
        $userAdmin->setEnabled('true');
        $userAdmin->addRole("ROLE_SUPER_ADMIN");

        $manager->persist($userAdmin);
        $manager->flush();
    }
}