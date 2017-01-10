<?php
namespace InvitationBundle\Services\Recorder;

use InvitationBundle\Entity\Changelog;
use InvitationBundle\Entity\ChangelogDetail;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\HttpFoundation\RequestStack;
use Doctrine\ORM\EntityManager;

use AppBundle\Entity\User;
use InvitationBundle\Entity\Invitation;

class Recorder {
    
    protected $em;
    
    protected $context;
    
    protected $request;
    
    protected $Changelog;

    public function __construct(EntityManager $em, TokenStorageInterface  $context, RequestStack $requestStack) {
        $this->em = $em;
        $this->context = $context;
        $this->request = $requestStack->getCurrentRequest();
    }
    
    public function start($tag) {
        $this->Changelog = new Changelog;
        $this->setUserAndEnv();
        $this->Changelog->setTag($tag);
        $this->Changelog->setDate(new \DateTime());
        $this->Changelog->setIp($this->request->getClientIp());
        $this->Changelog->setUserAgent($this->request->headers->get('User-Agent'));
        return $this;
    }
    
    public function record($variable, $value) {
        
    }
    
    public function commit() {
        
    }
    
    protected function setUserAndEnv() {
        $User = $this->getUser();
        switch(get_class($User)) {
            case User::class :
                $this->Changelog->setEnv(Changelog::ENV_PANEL);
                $this->Changelog->setUser($User);
            break;
            case Invitation::class :
                $this->Changelog->setEnv(Changelog::ENV_INVIT);
                $this->Changelog->setInvitation($User);
            break;
            default:
                $this->Changelog->setEnv(Changelog::ENV_ANON);
        }
    }

    protected function getUser() {
        return $this->context->getToken()->getUser();
    }

}