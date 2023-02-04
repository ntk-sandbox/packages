<?php

namespace Untek\Bundle\Language\Domain\Repositories\Symfony4;

use Untek\Bundle\Language\Domain\Interfaces\Repositories\SwitchRepositoryInterface;
use Untek\Lib\I18Next\Facades\I18Next;

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
