<?php

namespace Untek\Bundle\Language\Symfony4\Widgets\Language;

use Untek\Bundle\Language\Domain\Filters\LanguageFilter;
use Untek\Bundle\Language\Domain\Interfaces\Services\LanguageServiceInterface;
use Untek\Bundle\Language\Domain\Interfaces\Services\RuntimeLanguageServiceInterface;
use Untek\Lib\Web\Widget\Base\BaseWidget2;

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
