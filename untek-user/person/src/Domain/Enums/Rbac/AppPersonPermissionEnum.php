<?php

namespace Untek\User\Person\Domain\Enums\Rbac;

use Untek\Core\Enum\Interfaces\GetLabelsInterface;

class AppPersonPermissionEnum implements GetLabelsInterface
{

    const PERSON_INFO_UPDATE = 'oPersonInfoUpdate';
    const PERSON_INFO_ONE = 'oPersonInfoOne';

    public static function getLabels()
    {
        return [
            self::PERSON_INFO_UPDATE => 'Персона. Изменение данных',
            self::PERSON_INFO_ONE => 'Персона. Чтение данных',
        ];
    }
}