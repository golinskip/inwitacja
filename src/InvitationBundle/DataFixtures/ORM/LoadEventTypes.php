<?php
namespace InvitationBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use InvitationBundle\Entity\EventType;

use AppBundle\Entity\Translation;
use AppBundle\Entity\TranslationValue;

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
        
        $this->loadTranslations();
        
        foreach($this->data as $row) {
            
            $eventType = new EventType;
            $eventType->setName($row[0]);
            $eventType->setImage($row[1]);
            
            $Translation = $this->manager->getRepository('AppBundle:Translation')->findOneByToken($row[0]);
            if($Translation != null) {
                $eventType->setNameTranslation($Translation);
            }
            
            $this->manager->persist($eventType);
            $this->manager->flush();
        }
    }
    
    public function loadTranslations() {
        foreach($this->translations as $lang => $translation) {
            foreach($translation as $key => $value) {
                $this->loadTranslation($key, $value, $lang);
            }
        }
    }
    
    public function loadTranslation($key, $value, $lang) {
        $Translation = $this->manager->getRepository('AppBundle:Translation')->findOneByToken($key);
        if($Translation == null) {
            $Translation = new Translation;
            $Translation->setToken($key);
            $Translation->setDefaultValue($value);
        
            $this->manager->persist($Translation);
            $this->manager->flush();
        }
        
        $TranslationValue = new TranslationValue;
        $TranslationValue->setLocale($lang);
        $TranslationValue->setValue($value);
        $TranslationValue->setTranslation($Translation);
        
        $this->manager->persist($TranslationValue);
        $this->manager->flush();
    }
    
    public function getOrder() {
        return 11;
    }
}