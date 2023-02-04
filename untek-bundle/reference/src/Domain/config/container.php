<?php

return [
    'singletons' => [
        'Untek\Bundle\Reference\Domain\Interfaces\Services\BookServiceInterface' => 'Untek\Bundle\Reference\Domain\Services\BookService',
        'Untek\Bundle\Reference\Domain\Interfaces\Services\ItemServiceInterface' => 'Untek\Bundle\Reference\Domain\Services\ItemService',
        'Untek\Bundle\Reference\Domain\Interfaces\Services\ItemBookServiceInterface' => 'Untek\Bundle\Reference\Domain\Services\ItemBookService',

        'Untek\Bundle\Reference\Domain\Interfaces\Repositories\BookRepositoryInterface' => 'Untek\Bundle\Reference\Domain\Repositories\Eloquent\BookRepository',
        'Untek\Bundle\Reference\Domain\Interfaces\Repositories\ItemRepositoryInterface' => 'Untek\Bundle\Reference\Domain\Repositories\Eloquent\ItemRepository',
        'Untek\Bundle\Reference\Domain\Interfaces\Repositories\ItemTranslationRepositoryInterface' => 'Untek\Bundle\Reference\Domain\Repositories\Eloquent\ItemTranslationRepository',
    ],
];