<?php

namespace AppBundle\Entity;

/**
 * LanguageTranslation
 */
class LanguageTranslation
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $catalogue;

    /**
     * @var string
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
     * Set catalogue
     *
     * @param string $catalogue
     *
     * @return LanguageTranslation
     */
    public function setCatalogue($catalogue)
    {
        $this->catalogue = $catalogue;

        return $this;
    }

    /**
     * Get catalogue
     *
     * @return string
     */
    public function getCatalogue()
    {
        return $this->catalogue;
    }

    /**
     * Set translation
     *
     * @param string $translation
     *
     * @return LanguageTranslation
     */
    public function setTranslation($translation)
    {
        $this->translation = $translation;

        return $this;
    }

    /**
     * Get translation
     *
     * @return string
     */
    public function getTranslation()
    {
        return $this->translation;
    }
    /**
     * @var \AppBundle\Entity\Language
     */
    private $language;

    /**
     * @var \AppBundle\Entity\LanguageToken
     */
    private $languageToken;


    /**
     * Set language
     *
     * @param \AppBundle\Entity\Language $language
     *
     * @return LanguageTranslation
     */
    public function setLanguage(\AppBundle\Entity\Language $language = null)
    {
        $this->language = $language;

        return $this;
    }

    /**
     * Get language
     *
     * @return \AppBundle\Entity\Language
     */
    public function getLanguage()
    {
        return $this->language;
    }

    /**
     * Set languageToken
     *
     * @param \AppBundle\Entity\LanguageToken $languageToken
     *
     * @return LanguageTranslation
     */
    public function setLanguageToken(\AppBundle\Entity\LanguageToken $languageToken = null)
    {
        $this->languageToken = $languageToken;

        return $this;
    }

    /**
     * Get languageToken
     *
     * @return \AppBundle\Entity\LanguageToken
     */
    public function getLanguageToken()
    {
        return $this->languageToken;
    }
}
