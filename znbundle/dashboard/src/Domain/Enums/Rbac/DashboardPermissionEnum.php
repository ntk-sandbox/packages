<?php

namespace ZnBundle\Dashboard\Domain\Enums\Rbac;

use ZnCore\Enum\Interfaces\GetLabelsInterface;

class DashboardPermissionEnum implements GetLabelsInterface
{

    const ALL = 'oDashboardAll';

    public static function getLabels()
    {
        return [
            self::ALL => 'Главная страница. Просмотр',
        ];
    }
}
