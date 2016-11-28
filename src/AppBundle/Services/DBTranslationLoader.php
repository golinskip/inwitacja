<?php
namespace AppBundle\Services;

use Symfony\Component\Translation\Loader\LoaderInterface;
use Symfony\Component\Translation\MessageCatalogue;
use Doctrine\ORM\EntityManager;

class DBTranslationLoader implements LoaderInterface{
    private $transaltionRepository;
    private $languageRepository;
 
    /**
     * @param EntityManager $entityManager
     */
    public function __construct(EntityManager $entityManager){
        $this->transaltionRepository = $entityManager->getRepository("AppBundle:LanguageTranslation");
        $this->languageRepository = $entityManager->getRepository("AppBundle:Language");
    }
 
    public function load($resource, $locale, $domain = 'messages'){
        //Load on the db for the specified local
        $Language = $this->languageRepository->findOneByName($locale);
 
        $translations = $this->transaltionRepository->getTranslations($Language->getLocale(), $domain);
 
        $catalogue = new MessageCatalogue($locale);
 
        /**@var $translation Frtrains\CommonbBundle\Entity\LanguageTranslation */
        foreach($translations as $translation){
            $catalogue->set($translation->getLanguageToken()->getToken(), $translation->getTranslation(), $domain);
        }
 
        return $catalogue;
    }
    
    private function clearLanguageCache(){
        $cacheDir = __DIR__ . "/../../../app/cache";
     
        $finder = new \Symfony\Component\Finder\Finder();
     
        //TODO quick hack...
        $finder->in(array($cacheDir . "/dev/translations", $cacheDir . "/prod/translations"))->files();
     
        foreach($finder as $file){
            unlink($file->getRealpath());
        }
    }
}
