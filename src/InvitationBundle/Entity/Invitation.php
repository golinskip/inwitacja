<?php

namespace InvitationBundle\Entity;

use Doctrine\ORM\Event\LifecycleEventArgs;
use Doctrine\ORM\PersistentCollection;
use Symfony\Component\Security\Core\User\UserInterface;
use InvitationBundle\Entity\Person;
/**
 * Invitation
 */
class Invitation implements UserInterface {
    
    const URL_SPLITTER = '-';
    
    const URL_MAX_CHAR = 255;
    
    const CODE_LENGTH = 6;
    
    const GUEST_ROLE = 'ROLE_GUEST';
    

    
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $urlName;

    /**
     * @var string
     */
    private $email;

    /**
     * @var string
     */
    private $phone;

    /**
     * @var int
     */
    private $code;

    /**
     * @var \DateTime
     */
    private $createdAt;

    /**
     * @var \DateTime
     */
    private $updatedAt;

    /**
     * @var int
     */
    private $status;

    /**
     * @var int
     */
    private $innerOrder;
    
    private $person;
    
    private $changelog;
    
    private $invitationGroup;
    
    private $event;
    
    private $message;
    
    private $singleUseToken;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Invitation
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set urlName
     *
     * @param string $urlName
     *
     * @return Invitation
     */
    public function setUrlName($urlName)
    {
        $this->urlName = $urlName;

        return $this;
    }

    /**
     * Get urlName
     *
     * @return string
     */
    public function getUrlName()
    {
        return $this->urlName;
    }

    /**
     * Set email
     *
     * @param string $email
     *
     * @return Invitation
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set phone
     *
     * @param string $phone
     *
     * @return Invitation
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;

        return $this;
    }

    /**
     * Get phone
     *
     * @return string
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * Set code
     *
     * @param integer $code
     *
     * @return Invitation
     */
    public function setCode($code)
    {
        $this->code = $code;

        return $this;
    }

    /**
     * Get code
     *
     * @return int
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return Invitation
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set updatedAt
     *
     * @param \DateTime $updatedAt
     *
     * @return Invitation
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * Get updatedAt
     *
     * @return \DateTime
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * Set status
     *
     * @param integer $status
     *
     * @return Invitation
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return int
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set innerOrder
     *
     * @param integer $innerOrder
     *
     * @return Invitation
     */
    public function setInnerOrder($innerOrder)
    {
        $this->innerOrder = $innerOrder;

        return $this;
    }

    /**
     * Get innerOrder
     *
     * @return int
     */
    public function getInnerOrder()
    {
        return $this->innerOrder;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->person = new \Doctrine\Common\Collections\ArrayCollection();
        $this->changelog = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add person
     *
     * @param \InvitationBundle\Entity\Person $person
     *
     * @return Invitation
     */
    public function addPerson(\InvitationBundle\Entity\Person $person)
    {
        $this->person[] = $person;

        return $this;
    }

    /**
     * Remove person
     *
     * @param \InvitationBundle\Entity\Person $person
     */
    public function removePerson(\InvitationBundle\Entity\Person $person)
    {
        $this->person->removeElement($person);
    }

    /**
     * Get person
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPerson()
    {
        return $this->person;
    }

    /**
     * Add changelog
     *
     * @param \InvitationBundle\Entity\Changelog $changelog
     *
     * @return Invitation
     */
    public function addChangelog(\InvitationBundle\Entity\Changelog $changelog)
    {
        $this->changelog[] = $changelog;

        return $this;
    }

    /**
     * Remove changelog
     *
     * @param \InvitationBundle\Entity\Changelog $changelog
     */
    public function removeChangelog(\InvitationBundle\Entity\Changelog $changelog)
    {
        $this->changelog->removeElement($changelog);
    }

    /**
     * Get changelog
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getChangelog()
    {
        return $this->changelog;
    }

    /**
     * Set invitationGroup
     *
     * @param \InvitationBundle\Entity\InvitationGroup $invitationGroup
     *
     * @return Invitation
     */
    public function setInvitationGroup(\InvitationBundle\Entity\InvitationGroup $invitationGroup = null)
    {
        $this->invitationGroup = $invitationGroup;

        return $this;
    }

    /**
     * Get invitationGroup
     *
     * @return \InvitationBundle\Entity\InvitationGroup
     */
    public function getInvitationGroup()
    {
        return $this->invitationGroup;
    }

    /**
     * Set event
     *
     * @param \InvitationBundle\Entity\Event $event
     *
     * @return Invitation
     */
    public function setEvent(\InvitationBundle\Entity\Event $event = null)
    {
        $this->event = $event;

        return $this;
    }

    /**
     * Get event
     *
     * @return \InvitationBundle\Entity\Event
     */
    public function getEvent()
    {
        return $this->event;
    }

    /**
     * Add message
     *
     * @param \InvitationBundle\Entity\Message $message
     *
     * @return Invitation
     */
    public function addMessage(\InvitationBundle\Entity\Message $message)
    {
        $this->message[] = $message;

        return $this;
    }

    /**
     * Remove message
     *
     * @param \InvitationBundle\Entity\Message $message
     */
    public function removeMessage(\InvitationBundle\Entity\Message $message)
    {
        $this->message->removeElement($message);
    }

    /**
     * Get message
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getMessage()
    {
        return $this->message;
    }
    
    protected function slug($string) {
        $string = trim(preg_replace('/[^\da-z]/i', ' ',strtolower(iconv('UTF-8', 'ASCII//TRANSLIT//IGNORE', $string))));
        return str_replace(' ', self::URL_SPLITTER, $string);
    }
    
    public function fillEmptyFields(LifecycleEventArgs $e) {
        $em = $e->getObjectManager();
        $this->setCreatedAt(new \DateTime());
        $this->setUpdatedAt(new \DateTime());
        $this->generateSingleUseToken();
        if($this->getUrlName() == null) {
            $urlName = $this->slug($this->getName());
        }
        $tryCount = 1;
        $urlNameCurrent = $urlName;
        do {
            $ExistedInvitation = $em
                ->getRepository('InvitationBundle:Invitation')
                ->findOneByUrlName($urlNameCurrent);
            if(is_null($ExistedInvitation)) {
                break;
            }
            $sufx = self::URL_SPLITTER.$tryCount;
            $urlNameCurrent = substr($urlName, 0, self::URL_MAX_CHAR-strlen($sufx)).$sufx;
            $tryCount++;
        } while(true);
        $this->setUrlName($urlNameCurrent);
        if($this->getCode() === null) {
            $result = $em->createQuery("SELECT i.code FROM InvitationBundle:Invitation i JOIN InvitationBundle:Event e WHERE e.id = :event")
                    ->setParameters([
                        ':event' => $this->getEvent()->getId(),
                    ])
                    ->getScalarResult();
            $codeArray = array_map('current', $result);
            do {
                $this->setCode($this->generateCode());
            } while(in_array($this->getCode(), $codeArray));
        }
    }
    
    protected function generateCode() {
        $lengthMin = pow(10, self::CODE_LENGTH-1);
        $lengthMax = pow(10, self::CODE_LENGTH)-1;
        return rand($lengthMin, $lengthMax);
    }
    
    public function beforeUpdate(LifecycleEventArgs $e) {
        $this->setUpdatedAt(new \DateTime());
        $this->generateSingleUseToken();
    }
    
    public function getRoles() {
        return [self::GUEST_ROLE];
    }

    public function getPassword() {
        return $this->code;
    }

    public function getSalt() {
        return null;
    }

    public function getUsername() {
        return $this->getUrlName();
    }

    public function eraseCredentials() {}
    
    public function getSingleUseToken() {
        return $this->singleUseToken;
    }
    
    public function generateSingleUseToken() {
        $this->singleUseToken = md5(
            $this->getId().
            date('YmdHis').
            rand(1000, 9999)
        );
        return $this->singleUseToken;
    }
    
    
    /**
    Tablica statusów wg obecności osób w zaproszeniu (0 - nie występuje, 1 - występuje)
    obecna - nieobecna - niepotwierdzona
    000 = 0 - Zaproszenie jeszcze nie było potwierdzane lub nie wprowadzono osób do zaproszenia
    001 = 1 - Wszystkie osoby niepotwierdzone
    010 = 2 - Wszystkie osoby nieobecne
    011 = 3 - Są nieobecne i niepotwierdzone
    100 = 4 - Wszystkie osoby potwierdzone
    101 = 5 - Są osoby potwierdzone i nieobecne
    110 = 6 - Są osoby obecne i nieobecne
    111 = 7 - Są osoby obecne, nieobecne i niepotwierdzone
    
    0 - nikt nie próbował jeszcze potwierdzać
    1,3,5,7 - Wciąż są niepotwierdzone osoby
    4 - wszyscy będą
    6 - część osób będzie
    2 - nie będzie nikogo
    
    */
    public function updateStatus() {
        $status = 0;
        foreach($this->getPerson() as $Person) {
            switch($Person->getStatus()) {
                case Person::STATUS_UNDEFINED:
                    $status |= 1;
                break;
                case Person::STATUS_PRESENT:
                    $status |= 4;
                break;
                case Person::STATUS_ABSENT:
                    $status |= 2;
                break;
            }
        }
        return $this->setStatus($status);
    }
}
