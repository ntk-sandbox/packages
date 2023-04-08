<?php

namespace Untek\Bundle\Language\Domain\Repositories\Console;

use Untek\Bundle\Language\Domain\Interfaces\Repositories\SwitchRepositoryInterface;
use Untek\Component\I18Next\Facades\I18Next;

class SwitchRepository implements SwitchRepositoryInterface
{

    public function setLanguage(string $locale)
    {

    }

    public function getLanguage(): string
    {
        return 'ru';
    }
}
