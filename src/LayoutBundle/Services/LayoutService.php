<?php
namespace LayoutBundle\Services;

use Doctrine\ORM\EntityManager;
use InvitationBundle\Entity\Event;

class LayoutService {
    
    const DEFAULT_LAYOUT = 'default';
    
    protected $em;

    public function __construct(EntityManager $em) {
        $this->em = $em;
    }
    
    public function getLayout(Event $Event) {
        $layout = $Event->getLayout();
        if($layout == null) {
            return self::DEFAULT_LAYOUT;
        }
        return $layout;
    }
}