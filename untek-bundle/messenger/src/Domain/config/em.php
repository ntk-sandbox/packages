<?php

use Untek\Bundle\Messenger\Domain\Interfaces\Repositories\MessageRepositoryInterface;

return [
    'entities' => [
        Untek\Bundle\Messenger\Domain\Entities\MessageEntity::class => MessageRepositoryInterface::class,
    ],
];