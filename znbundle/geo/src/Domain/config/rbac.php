<?php

use ZnBundle\Geo\Domain\Enums\Rbac\GeoCountryPermissionEnum;
use ZnBundle\Geo\Domain\Enums\Rbac\GeoCurrencyPermissionEnum;
use ZnBundle\Geo\Domain\Enums\Rbac\GeoLocalityPermissionEnum;
use ZnBundle\Geo\Domain\Enums\Rbac\GeoRegionPermissionEnum;
use ZnUser\Rbac\Domain\Enums\Rbac\SystemRoleEnum;

return [
    'roleEnums' => [

    ],
    'permissionEnums' => [
        GeoCountryPermissionEnum::class,
        GeoCurrencyPermissionEnum::class,
        GeoLocalityPermissionEnum::class,
        GeoRegionPermissionEnum::class,
    ],
    'inheritance' => [
        SystemRoleEnum::GUEST => [
            GeoRegionPermissionEnum::ALL,
            GeoRegionPermissionEnum::ONE,

            GeoLocalityPermissionEnum::ALL,
            GeoLocalityPermissionEnum::ONE,

            GeoCurrencyPermissionEnum::ALL,
            GeoCurrencyPermissionEnum::ONE,

            GeoCountryPermissionEnum::ALL,
            GeoCountryPermissionEnum::ONE,
        ],
        SystemRoleEnum::USER => [

        ],
        SystemRoleEnum::ADMINISTRATOR => [
            GeoCountryPermissionEnum::CREATE,
            GeoCountryPermissionEnum::UPDATE,
            GeoCountryPermissionEnum::DELETE,

            GeoCurrencyPermissionEnum::CREATE,
            GeoCurrencyPermissionEnum::UPDATE,
            GeoCurrencyPermissionEnum::DELETE,

            GeoLocalityPermissionEnum::CREATE,
            GeoLocalityPermissionEnum::UPDATE,
            GeoLocalityPermissionEnum::DELETE,

            GeoRegionPermissionEnum::CREATE,
            GeoRegionPermissionEnum::UPDATE,
            GeoRegionPermissionEnum::DELETE,
        ],
    ],
];
