<?php

return [
    'singletons' => [
        'Untek\Bundle\Notify\Domain\Interfaces\Repositories\ToastrRepositoryInterface' => 'Untek\Bundle\Notify\Domain\Repositories\Symfony\ToastrRepository',
        'Untek\\Bundle\\Language\\Domain\\Interfaces\\Repositories\\SwitchRepositoryInterface' => 'Untek\\Bundle\\Language\\Domain\\Repositories\\Symfony4\\SwitchRepository',
        'Untek\\Bundle\\Language\\Domain\\Interfaces\\Repositories\\StorageRepositoryInterface' => 'Untek\\Bundle\\Language\\Domain\\Repositories\\Symfony4\\StorageRepository',
    ],
];
