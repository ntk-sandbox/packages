<?php

namespace ZnBundle\Language\Symfony4\Widgets\Language;

use ZnBundle\Language\Domain\Filters\LanguageFilter;
use ZnBundle\Language\Domain\Interfaces\Services\LanguageServiceInterface;
use ZnBundle\Language\Domain\Interfaces\Services\RuntimeLanguageServiceInterface;
use ZnLib\Web\Widget\Base\BaseWidget2;

class LanguageWidget extends BaseWidget2
{

    public $baseUrl = '/language/current/switch';
    private $languageService;
    private $runtimeLanguageService;

    public function __construct(
        RuntimeLanguageServiceInterface $runtimeLanguageService,
        LanguageServiceInterface $languageService
    )
    {
        $this->languageService = $languageService;
        $this->runtimeLanguageService = $runtimeLanguageService;
    }

    public function run(): string
    {
        $dataProvider = $this->languageService->getDataProvider();
        $dataProvider->setFilterModel(new LanguageFilter());
        $collection = $dataProvider->getCollection();
        $language = $this->runtimeLanguageService->getLanguage();
        list($language) = explode('-', $language);
        return $this->render('index', [
            'collection' => $collection,
            'language' => $language,
            'baseUrl' => $this->baseUrl,
        ]);
    }
}
