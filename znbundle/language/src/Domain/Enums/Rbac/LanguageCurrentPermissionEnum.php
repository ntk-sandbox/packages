<?php

namespace Untek\Bundle\Language\Domain\Enums\Rbac;

use Untek\Core\Enum\Interfaces\GetLabelsInterface;

class LanguageCurrentPermissionEnum implements GetLabelsInterface
{

    const SWITCH = 'oLanguageCurrentSwitch';

    public static function getLabels()
    {
        return [
            self::SWITCH => 'Текущий язык. Переключить',
        ];
    }
}