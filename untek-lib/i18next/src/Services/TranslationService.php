<?php

namespace Untek\Lib\I18Next\Services;

use Untek\Core\Instance\Helpers\ClassHelper;
use Untek\Core\Instance\Helpers\InstanceHelper;
use Untek\Lib\I18Next\Exceptions\NotFoundBundleException;
use Untek\Lib\I18Next\Interfaces\Services\TranslationServiceInterface;
use Untek\Lib\I18Next\Interfaces\TranslationLoaders\TranslationLoaderInterface;
use Untek\Lib\I18Next\Libs\TranslationLoaders\JsonLoader;
use Untek\Lib\I18Next\Libs\Translator;

class TranslationService implements TranslationServiceInterface
{

    /** @var Translator[] $translators */
    private $translators = [];
    private $bundles = [];
    private $language;
    private $defaultLanguage;
    private $fallbackLanguage = 'en';

    /*public function getBundles(): array
    {
        return $this->bundles;
    }*/

    public function setBundles(array $bundles): void
    {
        $this->bundles = $bundles;
    }

    public function getLanguage(): string
    {
        return $this->language;
    }

    public function setLanguage(string $language, string $fallback = null)
    {
        $language = explode('-', $language)[0];
        $this->language = $language;
        foreach ($this->translators as $translator) {
            $translator->setLanguage($language, $fallback);
        }
        if ($fallback) {
            $this->fallbackLanguage = $fallback;
        }
    }

    public function getDefaultLanguage(): string
    {
        return $this->defaultLanguage;
    }

    public function setDefaultLanguage(string $defaultLanguage): void
    {
        $this->defaultLanguage = $defaultLanguage;
        if (empty($this->language)) {
            $this->language = $defaultLanguage;
        }
    }

    public function t(string $bundleName, string $key, array $variables = [])
    {
        $translator = $this->getTranslator($bundleName);
        return $translator->getTranslation($key, $variables);
    }

    public function addBundle(string $bundleName, $loaderDefinition)
    {
        $translation = $this->loadTranslation($loaderDefinition, $this->language);
        /** @var Translator $translator */
        $translator = InstanceHelper::create(Translator::class, [
            TranslationServiceInterface::class => $this,
        ]);
        $translator->setTranslation($translation);
        $translator->setLanguage($this->language, $this->fallbackLanguage);

        $this->translators[$bundleName] = $translator;
        //$this->translators[$bundleName] = new Translator($translation, $this->language);
    }

    private function normalizeDefinition($loaderDefinition): array
    {
        if (is_string($loaderDefinition)) {
            $loaderDefinition = [
                'class' => JsonLoader::class,
                'pathMask' => $loaderDefinition,
            ];
        }
        return $loaderDefinition;
    }

    private function loadTranslation($loaderDefinition, string $language): array
    {
        $loaderDefinition = $this->normalizeDefinition($loaderDefinition);
        /** @var TranslationLoaderInterface $loader */
        $loader = ClassHelper::createObject($loaderDefinition);
        return $loader->load($this->language);
    }

    private function getTranslator(string $bundleName): Translator
    {
        if (!isset($this->translators[$bundleName])) {
            if (!array_key_exists($bundleName, $this->bundles)) {
                throw new NotFoundBundleException('Translation bundle "' . $bundleName . '" not found');
            }
            $loaderDefinition = $this->bundles[$bundleName];
            $this->addBundle($bundleName, $loaderDefinition);
        }
        /*if (!array_key_exists($bundleName, $this->translators)) {
            throw new NotFoundBundleException('Translation bundle "' . $bundleName . '" not found');
        }*/
        return $this->translators[$bundleName];
    }
}
