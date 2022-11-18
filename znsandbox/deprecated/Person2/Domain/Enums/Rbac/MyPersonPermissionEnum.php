<?php

namespace ZnSandbox\Sandbox\Person2\Domain\Enums\Rbac;

use ZnCore\Enum\Interfaces\GetLabelsInterface;

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