<?php

return [
    'entities' => [
        'Untek\Core\Contract\User\Interfaces\Entities\IdentityEntityInterface' => 'Untek\User\Identity\Domain\Interfaces\Repositories\IdentityRepositoryInterface',
        'Untek\User\Identity\Domain\Entities\IdentityEntity' => 'Untek\User\Identity\Domain\Interfaces\Repositories\IdentityRepositoryInterface',
    ],
];
