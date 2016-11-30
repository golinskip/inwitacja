<?php
namespace InvitationBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use InvitationBundle\Entity\EventRole;
use InvitationBundle\Entity\Action;

use AppBundle\Entity\Translation;
use AppBundle\Entity\TranslationValue;

class LoadEventPermissions extends AbstractFixture implements OrderedFixtureInterface {
    
    private $actionList = [
        'event.view',
        'event.edit',
        'event.remove',
        'event.invitation.view',
        'event.invitation.add',
        'event.invitation.edit',
        'event.invitation.remove',
    ];
    
    private $translations = [
        'pl' => [
            'event.view' => 'Podgląd wydarzenia',
            'event.edit' => 'Edycja wydarzenia',
            'event.remove' => 'Usuwanie wydarzenia',
            'event.invitation.view' => 'Dodawanie zaproszeń',
            'event.invitation.view' => 'Podgląd zaproszeń',
            'event.invitation.edit' => 'Edycja zaproszeń',
            'event.invitation.remove' => 'Usuwanie zaproszeń',
            
            'eventRole.owner' => 'Twórca wydarzenia',
        ]
    ];
    
    private $manager;
    
    public function load(ObjectManager $manager) {
        $this->manager = $manager;
        
        $this->loadTranslations();
        
        $EventRole = new EventRole;
        $EventRole->setName('eventRole.owner');
        $EventRole->setSpecialName('owner');
        
        $Translation = $this->manager->getRepository('AppBundle:Translation')->findOneByToken('eventRole.owner');
        if($Translation != null) {
            $EventRole->setNameTranslation($Translation);
        }
            
        $this->manager->persist($EventRole);
        $this->manager->flush();
        
        $this->loadActions($EventRole);
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
    
    public function loadActions($EventRole) {
        foreach($this->actionList as $action) {
            $Action = new Action;
            $Action->setTag($action);
            $Action->setName($action);
            
            $Translation = $this->manager->getRepository('AppBundle:Translation')->findOneByToken($action);
            if($Translation != null) {
                $Action->setNameTranslation($Translation);
            }
            
            $Action->addEventRole($EventRole);
            
            $this->manager->persist($Action);
            $this->manager->flush();
        }
    }
    
    public function getOrder() {
        return 10;
    }
}