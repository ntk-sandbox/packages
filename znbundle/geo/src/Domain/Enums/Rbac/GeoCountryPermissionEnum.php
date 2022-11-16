<?php

namespace ZnBundle\Geo\Domain\Enums\Rbac;

use ZnCore\Enum\Interfaces\GetLabelsInterface;

class GeoCountryPermissionEnum implements GetLabelsInterface
{

    const ALL = 'oGeoCountryAll';
    const ONE = 'oGeoCountryOne';
    const CREATE = 'oGeoCountryCreate';
    const UPDATE = 'oGeoCountryUpdate';
    const DELETE = 'oGeoCountryDelete';
//    const RESTORE = 'oGeoCountryRestore';

    public static function getLabels()
    {
        return [
            self::ALL => 'Страна. Просмотр списка',
            self::ONE => 'Страна. Просмотр записи',
            self::CREATE => 'Страна. Создание',
            self::UPDATE => 'Страна. Редактирование',
            self::DELETE => 'Страна. Удаление',
//            self::RESTORE => 'Страна. Восстановление',
        ];
    }
}