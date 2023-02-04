<?php

return [
    'definitions' => [
        
    ],
    'singletons' => [
        'Untek\User\Confirm\Domain\Interfaces\Services\ConfirmServiceInterface' => 'Untek\User\Confirm\Domain\Services\ConfirmService',
        'Untek\User\Confirm\Domain\Interfaces\Repositories\ConfirmRepositoryInterface' => 'Untek\User\Confirm\Domain\Repositories\Eloquent\ConfirmRepository',
    ],
];