<?php
namespace InvitationBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use InvitationBundle\Entity\EventType;
use AppBundle\Entity\LanguageToken;
use AppBundle\Entity\LanguageTranslation;

class LoadEventType extends AbstractFixture implements OrderedFixtureInterface {
    const TRANS_CATALOGUE = 'message';
    
    private $data = [
        ['eventType.wedding', 'wedding.jpg'],
        ['eventType.baptism', 'baptism.jpg'],
        ['eventType.communion', 'communion.jpg'],
    ];
    
    private $translations = [
        'pl' => [
            'eventType.wedding' => 'Ślub',
            'eventType.baptism' => 'Chrzest',
            'eventType.communion' => 'Komunia Święta',
        ]
    ];
    
    private $manager;
    
    public function load(ObjectManager $manager) {
        $this->manager = $manager;
        
        foreach($this->data as $row) {
            
            $eventType = new EventType;
            $eventType->setName($row[0]);
            $eventType->setImage($row[1]);
            
            $this->manager->persist($eventType);
            $this->manager->flush();
        }
        
        $this->loadTranslations();
    }
    
    public function loadTranslations() {
        foreach($this->translations as $lang => $translation) {
            $Language = $this->manager->getRepository('AppBundle:Language')->findOneByName($lang);
            foreach($translation as $key => $value) {
                $this->loadTranslation($key, $value, $Language);
            }
        }
    }
    
    public function loadTranslation($key, $value, $Language) {
        
        $LanguageToken = new LanguageToken;
        $LanguageToken->setToken($value);
        
        $this->manager->persist($LanguageToken);
        $this->manager->flush();
        
        $LanguageTranslation = new LanguageTranslation;
        $LanguageTranslation->setCatalogue(self::TRANS_CATALOGUE);
        $LanguageTranslation->setTranslation($key);
        $LanguageTranslation->setLanguage($Language);
        $LanguageTranslation->setLanguageToken($LanguageToken);
            
        $this->manager->persist($LanguageTranslation);
        $this->manager->flush();
    }
    
    public function getOrder() {
        return 11;
    }
}