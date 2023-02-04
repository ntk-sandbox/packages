<?php

use Untek\User\Identity\Domain\Entities\IdentityEntity;

return [
    'definitions' => [
        'Untek\Core\Contract\User\Interfaces\Entities\IdentityEntityInterface' => IdentityEntity::class,
    ],
    'singletons' => [
        'Untek\User\Identity\Domain\Interfaces\Services\IdentityServiceInterface' => 'Untek\User\Identity\Domain\Services\IdentityService',
        'Untek\User\Identity\Domain\Interfaces\Repositories\IdentityRepositoryInterface' => 'Untek\User\Identity\Domain\Repositories\Eloquent\IdentityRepository',
    ],
];
