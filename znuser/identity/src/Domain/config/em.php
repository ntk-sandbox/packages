<?php

return [
    'entities' => [
        'ZnCore\Contract\User\Interfaces\Entities\IdentityEntityInterface' => 'ZnUser\Identity\Domain\Interfaces\Repositories\IdentityRepositoryInterface',
        'ZnUser\Identity\Domain\Entities\IdentityEntity' => 'ZnUser\Identity\Domain\Interfaces\Repositories\IdentityRepositoryInterface',
    ],
];
