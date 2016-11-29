<?php
namespace PanelBundle\Entity\Form;

use Doctrine\Common\Collections\ArrayCollection;


class AddInvitationForm {
    protected $invitation;
    
    protected $person;
    
    

    public function __construct() {
        $this->person = new ArrayCollection();
    }
    
    public function getInvitation() {
        return $this->invitation;
    }
    
    public function setInvitation($invitation) {
        $this->invitation = $invitation;
        return $this;
    }
    
    public function getPerson() {
        return $this->person;
    }
    
    public function addPerson($person) {
        $this->person[] = $person;
        return $this;
    }
    
    public function setPerson($person) {
        $this->person = $person;
        return $this;
    }
}
