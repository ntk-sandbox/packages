<?php

use Untek\Bundle\Messenger\Domain\Interfaces\Repositories\MessageRepositoryInterface;

return [
    'definitions' => [
        
    ],
    'singletons' => [
        'Untek\Bundle\Messenger\Domain\Interfaces\Services\MessageServiceInterface' => 'Untek\Bundle\Messenger\Domain\Services\MessageService',
        'Untek\Bundle\Messenger\Domain\Interfaces\ChatServiceInterface' => 'Untek\Bundle\Messenger\Domain\Services\ChatService',
        'Untek\Bundle\Messenger\Domain\Interfaces\ChatRepositoryInterface' => 'Untek\Bundle\Messenger\Domain\Repositories\Eloquent\ChatRepository',
        'Untek\Bundle\Messenger\Domain\Interfaces\Repositories\MessageRepositoryInterface' => 'Untek\Bundle\Messenger\Domain\Repositories\Eloquent\MessageRepository',
        'Untek\Bundle\Messenger\Domain\Interfaces\MemberRepositoryInterface' => 'Untek\Bundle\Messenger\Domain\Repositories\Eloquent\MemberRepository',
        'Untek\Bundle\Messenger\Domain\Interfaces\FlowRepositoryInterface' => 'Untek\Bundle\Messenger\Domain\Repositories\Eloquent\FlowRepository',
        //'Untek\Bundle\Messenger\Domain\Interfaces\MessageServiceInterface' => 'Untek\Bundle\Messenger\Domain\Services\ChatService',
    ],
];