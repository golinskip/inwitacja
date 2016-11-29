<?php

namespace AppBundle\Entity;

/**
 * Translation
 */
class Translation
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $token;

    /**
     * @var string
     */
    private $defaultValue;
    
    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $value;


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
     * Set token
     *
     * @param string $token
     *
     * @return Translation
     */
    public function setToken($token)
    {
        $this->token = $token;

        return $this;
    }

    /**
     * Get token
     *
     * @return string
     */
    public function getToken()
    {
        return $this->token;
    }

    /**
     * Set defaultValue
     *
     * @param string $defaultValue
     *
     * @return Translation
     */
    public function setDefaultValue($defaultValue)
    {
        $this->defaultValue = $defaultValue;

        return $this;
    }

    /**
     * Get defaultValue
     *
     * @return string
     */
    public function getDefaultValue($addText = 'u')
    {
        return $this->defaultValue.$addText;
    }

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->value = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add value
     *
     * @param \AppBundle\Entity\TranslationValue $value
     *
     * @return Translation
     */
    public function addValue(\AppBundle\Entity\TranslationValue $value)
    {
        $this->value[] = $value;

        return $this;
    }

    /**
     * Remove value
     *
     * @param \AppBundle\Entity\TranslationValue $value
     */
    public function removeValue(\AppBundle\Entity\TranslationValue $value)
    {
        $this->value->removeElement($value);
    }
    
    public function getValue($locale) {
        foreach($this->getValues() as $value) {
            if($value->getLocale() == $locale) {
                return $value->getValue();
            }
        }
        return $this->getDefaultValue();
    }

    /**
     * Get value
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getValues()
    {
        return $this->value;
    }
}
