<?php

return [
    'definitions' => [

    ],
    'singletons' => [

        'Untek\Bundle\Person\Domain\Interfaces\Services\PersonServiceInterface' => 'Untek\Bundle\Person\Domain\Services\PersonService',
        'Untek\Bundle\Person\Domain\Interfaces\Services\ContactTypeServiceInterface' => 'Untek\Bundle\Person\Domain\Services\ContactTypeService',
        'Untek\Bundle\Person\Domain\Interfaces\Services\ContactServiceInterface' => 'Untek\Bundle\Person\Domain\Services\ContactService',
        'Untek\Bundle\Person\Domain\Interfaces\Repositories\ContactTypeRepositoryInterface' => 'Untek\Bundle\Person\Domain\Repositories\Eloquent\ContactTypeRepository',
        'Untek\Bundle\Person\Domain\Interfaces\Repositories\ContactRepositoryInterface' => 'Untek\Bundle\Person\Domain\Repositories\Eloquent\ContactRepository',

    ],
];
