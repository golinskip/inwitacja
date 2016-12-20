<?php

namespace InvitationBundle\Entity\ParameterType;

class Boolean {
    private $enableEmpty;
    
    public function getEnableEmpty() {
        return $this->enableEmpty;
    }
    
    public function setEnableEmpty($value) {
        $this->enableEmpty = $value;
        return $this;
    }
}