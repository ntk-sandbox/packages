<?php

namespace ZnBundle\Language\Domain\Repositories\Symfony4;

use ZnBundle\Language\Domain\Interfaces\Repositories\SwitchRepositoryInterface;
use ZnLib\I18Next\Facades\I18Next;

class SwitchRepository implements SwitchRepositoryInterface
{

    public function setLanguage(string $locale)
    {
        I18Next::getService()->setLanguage($locale);
    }

    public function getLanguage(): string
    {
        return I18Next::getService()->getLanguage();
    }
}
