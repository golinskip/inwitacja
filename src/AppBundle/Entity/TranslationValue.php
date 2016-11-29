<?php

namespace AppBundle\Entity;

/**
 * TranslationValue
 */
class TranslationValue
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $locale;

    /**
     * @var string
     */
    private $value;
    
    /**
     * @var \AppBundle\Entity\Translation
     */
    private $translation;


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
     * Set locale
     *
     * @param string $locale
     *
     * @return TranslationValue
     */
    public function setLocale($locale)
    {
        $this->locale = $locale;

        return $this;
    }

    /**
     * Get locale
     *
     * @return string
     */
    public function getLocale()
    {
        return $this->locale;
    }

    /**
     * Set value
     *
     * @param string $value
     *
     * @return TranslationValue
     */
    public function setValue($value)
    {
        $this->value = $value;

        return $this;
    }

    /**
     * Get value
     *
     * @return string
     */
    public function getValue()
    {
        return $this->value;
    }


    /**
     * Set translation
     *
     * @param \AppBundle\Entity\Translation $translation
     *
     * @return TranslationValue
     */
    public function setTranslation(\AppBundle\Entity\Translation $translation = null)
    {
        $this->translation = $translation;

        return $this;
    }

    /**
     * Get translation
     *
     * @return \AppBundle\Entity\Translation
     */
    public function getTranslation()
    {
        return $this->translation;
    }
}
