<?php

namespace ZnBundle\Geo\Domain\Enums\Rbac;

use ZnCore\Enum\Interfaces\GetLabelsInterface;

class GeoLocalityPermissionEnum implements GetLabelsInterface
{

    const ALL = 'oGeoLocalityAll';
    const ONE = 'oGeoLocalityOne';
    const CREATE = 'oGeoLocalityCreate';
    const UPDATE = 'oGeoLocalityUpdate';
    const DELETE = 'oGeoLocalityDelete';
//    const RESTORE = 'oGeoLocalityRestore';

    public static function getLabels()
    {
        return [
            self::ALL => 'Населенный пункт. Просмотр списка',
            self::ONE => 'Населенный пункт. Просмотр записи',
            self::CREATE => 'Населенный пункт. Создание',
            self::UPDATE => 'Населенный пункт. Редактирование',
            self::DELETE => 'Населенный пункт. Удаление',
//            self::RESTORE => 'Населенный пункт. Восстановление',
        ];
    }
}