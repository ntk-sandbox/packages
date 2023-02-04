<?php

namespace Untek\Bundle\Geo\Domain\Enums\Rbac;

use Untek\Core\Enum\Interfaces\GetLabelsInterface;

class GeoCurrencyPermissionEnum implements GetLabelsInterface
{

    const ALL = 'oGeoCurrencyAll';
    const ONE = 'oGeoCurrencyOne';
    const CREATE = 'oGeoCurrencyCreate';
    const UPDATE = 'oGeoCurrencyUpdate';
    const DELETE = 'oGeoCurrencyDelete';
//    const RESTORE = 'oGeoCurrencyRestore';

    public static function getLabels()
    {
        return [
            self::ALL => 'Валюта. Просмотр списка',
            self::ONE => 'Валюта. Просмотр записи',
            self::CREATE => 'Валюта. Создание',
            self::UPDATE => 'Валюта. Редактирование',
            self::DELETE => 'Валюта. Удаление',
//            self::RESTORE => 'Валюта. Восстановление',
        ];
    }
}