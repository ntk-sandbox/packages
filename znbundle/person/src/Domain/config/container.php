<?php

return [
    'definitions' => [

    ],
    'singletons' => [

        'ZnBundle\Person\Domain\Interfaces\Services\PersonServiceInterface' => 'ZnBundle\Person\Domain\Services\PersonService',
        'ZnBundle\Person\Domain\Interfaces\Services\ContactTypeServiceInterface' => 'ZnBundle\Person\Domain\Services\ContactTypeService',
        'ZnBundle\Person\Domain\Interfaces\Services\ContactServiceInterface' => 'ZnBundle\Person\Domain\Services\ContactService',
        'ZnBundle\Person\Domain\Interfaces\Repositories\ContactTypeRepositoryInterface' => 'ZnBundle\Person\Domain\Repositories\Eloquent\ContactTypeRepository',
        'ZnBundle\Person\Domain\Interfaces\Repositories\ContactRepositoryInterface' => 'ZnBundle\Person\Domain\Repositories\Eloquent\ContactRepository',

    ],
];
