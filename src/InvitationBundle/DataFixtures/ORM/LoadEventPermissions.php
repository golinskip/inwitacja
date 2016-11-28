<?php
namespace InvitationBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use InvitationBundle\Entity\EventRole;
use InvitationBundle\Entity\Action;
use AppBundle\Entity\Language;
use AppBundle\Entity\LanguageToken;
use AppBundle\Entity\LanguageTranslation;

class LoadEventPermissions extends AbstractFixture implements OrderedFixtureInterface {
    const TRANS_CATALOGUE = 'message';
    
    private $actionList = [
        'event.view',
        'event.edit',
        'event.remove',
        'event.invitation.view',
        'event.invitation.edit',
        'event.invitation.remove',
    ];
    
    private $translations = [
        'pl' => [
            'event.view' => 'Podgląd wydarzenia',
            'event.edit' => 'Edycja wydarzenia',
            'event.remove' => 'Usuwanie wydarzenia',
            'event.invitation.view' => 'Podgląd zaproszeń',
            'event.invitation.edit' => 'Edycja zaproszeń',
            'event.invitation.remove' => 'Usuwanie zaproszeń',
            
            'eventRole.owner' => 'Twórca wydarzenia',
        ]
    ];
    
    private $manager;
    
    public function load(ObjectManager $manager) {
        $this->manager = $manager;
        
        $EventRole = new EventRole;
        $EventRole->setName('eventRole.owner');
        $EventRole->setSpecialName('owner');
            
        $manager->persist($EventRole);
        $manager->flush();
        
        $this->loadActions($EventRole);
        
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
    
    public function loadActions($EventRole) {
        foreach($this->actionList as $action) {
            $Action = new Action;
            $Action->setTag($action);
            $Action->setName('eventRole.'.$action);
            
            $Action->addEventRole($EventRole);
            
            $this->manager->persist($Action);
            $this->manager->flush();
        }
    }
    
    public function getOrder() {
        return 10;
    }
}