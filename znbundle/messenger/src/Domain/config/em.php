<?php

use ZnBundle\Messenger\Domain\Interfaces\Repositories\MessageRepositoryInterface;

return [
    'entities' => [
        ZnBundle\Messenger\Domain\Entities\MessageEntity::class => MessageRepositoryInterface::class,
    ],
];