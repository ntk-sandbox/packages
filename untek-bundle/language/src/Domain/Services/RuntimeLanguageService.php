<?php

namespace Untek\Bundle\Language\Domain\Services;

use Untek\Bundle\Language\Domain\Interfaces\Repositories\StorageRepositoryInterface;
use Untek\Bundle\Language\Domain\Interfaces\Repositories\SwitchRepositoryInterface;
use Untek\Bundle\Language\Domain\Interfaces\Services\RuntimeLanguageServiceInterface;

class RuntimeLanguageService implements RuntimeLanguageServiceInterface
{

    private $switchRepository;
    private $storageRepository;

    public function __construct(
        SwitchRepositoryInterface $switchRepository,
        StorageRepositoryInterface $storageRepository
    )
    {
        $this->switchRepository = $switchRepository;
        $this->storageRepository = $storageRepository;

        $this->init();
    }

    public function init()
    {
        $currentLang = $this->storageRepository->getLanguage();
        $this->switchRepository->setLanguage($currentLang);
    }

    public function setLanguage(string $locale)
    {
        list($locale) = explode('-', $locale);
        $this->switchRepository->setLanguage($locale);
        $this->storageRepository->setLanguage($locale);
    }

    public function getLanguage(): string
    {
        return $this->switchRepository->getLanguage();
    }
}
