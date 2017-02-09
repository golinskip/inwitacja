<?php

namespace InvitationBundle\Services\Recorder;

use AppBundle\Entity\User as PanelUser;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorage;
use Symfony\Component\Security\Core\SecurityContextInterface;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Security\Http\Event\InteractiveLoginEvent;

class AdminLoginListener {
    
    protected $token;

    protected $session;

    public function __construct(TokenStorage $token, Session $session, Recorder $recorder) {
        $this->token = $token;
        $this->session = $session;
        $this->recorder = $recorder;
    }

    public function onSecurityInteractiveLogin(InteractiveLoginEvent $event) {
        $User = $this->token->getToken()->getUser();
        if(PanelUser::class == get_class($User)) {
            $this->recorder->start('login.panel')->commit();
        }
    }
}