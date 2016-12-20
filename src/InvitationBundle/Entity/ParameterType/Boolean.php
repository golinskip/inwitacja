<?php
namespace InvitationBundle\Entity\ParameterType;

class Boolean {
    const LAYOUT_BUTTON = 'button';
    const LAYOUT_CHECKBOX = 'checkbox';
    const LAYOUT_DROPDOWN = 'dropdown';
    
    public static $layoutList = [
        self::LAYOUT_BUTTON,
        self::LAYOUT_CHECKBOX,
        self::LAYOUT_DROPDOWN,
    ];
    
    /**
     * Możliwa wartość niezdefiniowana
     * @var boolean 
     */
    private $enableEmpty;
    
    /**
     * Domyślna wartość
     * @var integer
     */
    private $default;
    
    /**
     * Modyfikator ceny, gdy prawdziwe
     * @var float 
     */
    private $truePrice;
    
    /**
     * Modyfikator ceny, gdy fałszywe
     * @var float
     */
    private $falsePrice;
    
    /**
     * Sposób wyboru: przycisk, checkbox, combobox
     * @var string
     */
    private $layout;
   
    public function getTruePrice() {
        return $this->truePrice;
    }

    public function getFalsePrice() {
        return $this->falsePrice;
    }

    public function getLayout() {
        return $this->layout;
    }

    public function setTruePrice(type $truePrice) {
        $this->truePrice = $truePrice;
        return $this;
    }

    public function setFalsePrice(type $falsePrice) {
        $this->falsePrice = $falsePrice;
        return $this;
    }

    public function setLayout(type $layout) {
        $this->layout = $layout;
        return $this;
    }
        
    public function getDefault() {
        return $this->default;
    }

    public function setDefault($default) {
        $this->default = $default;
        return $this;
    }

    public function getEnableEmpty() {
        return $this->enableEmpty;
    }
    
    public function setEnableEmpty($value) {
        $this->enableEmpty = $value;
        return $this;
    }
    
}