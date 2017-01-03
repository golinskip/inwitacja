<?php
namespace InvitationBundle\Entity\ParameterType;

class Logic {
    const LAYOUT_BUTTON = 'button';
    const LAYOUT_CHECKBOX = 'checkbox';
    const LAYOUT_DROPDOWN = 'dropdown';
    
    const VALUE_EMPTY = 'empty';
    const VALUE_TRUE = 'true';
    const VALUE_FALSE = 'false';
    
    public static $layoutList = [
        self::LAYOUT_BUTTON,
        self::LAYOUT_CHECKBOX,
        self::LAYOUT_DROPDOWN,
    ];
    
    /**
     * Możliwa wartość niezdefiniowana
     * @var logic 
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

    public function setTruePrice($truePrice) {
        $this->truePrice = $truePrice;
        return $this;
    }

    public function setFalsePrice($falsePrice) {
        $this->falsePrice = $falsePrice;
        return $this;
    }

    public function setLayout($layout) {
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
    
    public function __construct() {
        $this->enableEmpty = true;
        $this->default = 0;
        $this->truePrice = 0;
        $this->falsePrice = 0;
        $this->layout = self::$layoutList[0];
    }
    
}