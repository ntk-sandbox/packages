<?php

namespace Untek\Bundle\Dashboard\Domain\Enums\Rbac;

use Untek\Core\Enum\Interfaces\GetLabelsInterface;

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
