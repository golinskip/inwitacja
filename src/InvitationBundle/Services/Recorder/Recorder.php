<?php
namespace InvitationBundle\Services\Recorder;

use InvitationBundle\Entity\Changelog;
use InvitationBundle\Entity\ChangelogDetail;
use Doctrine\ORM\EntityManager;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\HttpFoundation\RequestStack;

use AppBundle\Entity\User;
use InvitationBundle\Entity\Invitation;

class Recorder {
    
    protected $em;
    
    protected $context;
    
    protected $request;
    
    protected $Changelog;
    
    protected $ChangelogDetails = array();

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
        $ChangelogDetail = new ChangelogDetail();
        $ChangelogDetail->setVariable($variable);
        $ChangelogDetail->setValue($this->_parseValue($value));
        $ChangelogDetail->setChangelog($this->Changelog);
        $this->Changelog->addChangelogDetail($ChangelogDetail);
        $this->ChangelogDetails[] = $ChangelogDetail;
        return $this;
    }
    
    protected function _parseValue($value) {
        if(is_object($value) && get_class($value) == 'DateTime') {
            return $value->format('Y-m-d H:i:s');
        }
        return (string)$value;
    }
    
    public function commit() {
        foreach($this->ChangelogDetails as $ChangelogDetail) {
            $this->em->persist($ChangelogDetail);
        }
        $this->em->persist($this->Changelog);
        $this->em->flush();
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