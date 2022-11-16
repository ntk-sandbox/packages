<?php

use ZnUser\Identity\Domain\Entities\IdentityEntity;

return [
    'definitions' => [
        'ZnCore\Contract\User\Interfaces\Entities\IdentityEntityInterface' => IdentityEntity::class,
    ],
    'singletons' => [
        'ZnUser\Identity\Domain\Interfaces\Services\IdentityServiceInterface' => 'ZnUser\Identity\Domain\Services\IdentityService',
        'ZnUser\Identity\Domain\Interfaces\Repositories\IdentityRepositoryInterface' => 'ZnUser\Identity\Domain\Repositories\Eloquent\IdentityRepository',
    ],
    /*'entities' => [
        'ZnCore\Contract\User\Interfaces\Entities\IdentityEntityInterface' => 'ZnUser\Identity\Domain\Interfaces\Repositories\IdentityRepositoryInterface',
        'ZnUser\Identity\Domain\Entities\IdentityEntity' => 'ZnUser\Identity\Domain\Interfaces\Repositories\IdentityRepositoryInterface',
    ],*/
];
