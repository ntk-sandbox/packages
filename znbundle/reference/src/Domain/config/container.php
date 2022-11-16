<?php

return [
    'singletons' => [
        'ZnBundle\Reference\Domain\Interfaces\Services\BookServiceInterface' => 'ZnBundle\Reference\Domain\Services\BookService',
        'ZnBundle\Reference\Domain\Interfaces\Services\ItemServiceInterface' => 'ZnBundle\Reference\Domain\Services\ItemService',
        'ZnBundle\Reference\Domain\Interfaces\Services\ItemBookServiceInterface' => 'ZnBundle\Reference\Domain\Services\ItemBookService',

        'ZnBundle\Reference\Domain\Interfaces\Repositories\BookRepositoryInterface' => 'ZnBundle\Reference\Domain\Repositories\Eloquent\BookRepository',
        'ZnBundle\Reference\Domain\Interfaces\Repositories\ItemRepositoryInterface' => 'ZnBundle\Reference\Domain\Repositories\Eloquent\ItemRepository',
        'ZnBundle\Reference\Domain\Interfaces\Repositories\ItemTranslationRepositoryInterface' => 'ZnBundle\Reference\Domain\Repositories\Eloquent\ItemTranslationRepository',
    ],
    /*'entities' => [
        'ZnBundle\Reference\Domain\Entities\BookEntity' => 'ZnBundle\Reference\Domain\Interfaces\Repositories\BookRepositoryInterface',
        'ZnBundle\Reference\Domain\Entities\ItemEntity' => 'ZnBundle\Reference\Domain\Interfaces\Repositories\ItemRepositoryInterface',
        'ZnBundle\Reference\Domain\Entities\ItemTranslationEntity' => 'ZnBundle\Reference\Domain\Interfaces\Repositories\ItemTranslationRepositoryInterface',
    ],*/
];