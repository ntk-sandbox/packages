<?php

namespace Untek\User\Person\Domain\Enums\Rbac;

use Untek\Core\Enum\Interfaces\GetLabelsInterface;

class MyPersonPermissionEnum implements GetLabelsInterface
{

    const UPDATE = 'oPersonMyPersonUpdate';
    const ONE = 'oPersonMyPersonOne';

    public static function getLabels()
    {
        return [
            self::UPDATE => 'Моя персона. Изменение данных',
            self::ONE => 'Моя персона. Чтение данных',
        ];
    }
}