<?php

namespace Untek\Bundle\Reference\Domain\Repositories\Eloquent;

use Untek\Bundle\Reference\Domain\Interfaces\Repositories\ItemRepositoryInterface;
use Untek\Bundle\Reference\Domain\Interfaces\Services\BookServiceInterface;
use Untek\Domain\Query\Entities\Where;
use Untek\Domain\EntityManager\Interfaces\EntityManagerInterface;
use Untek\Domain\Query\Entities\Query;
use Untek\Database\Eloquent\Domain\Capsule\Manager;

abstract class BaseItemRepository extends ItemRepository implements ItemRepositoryInterface
{

    protected $bookId;
    protected $bookName;
    private $bookService;

    public function __construct(EntityManagerInterface $em, Manager $manager, BookServiceInterface $bookService)
    {
        parent::__construct($em, $manager);
        $this->bookService = $bookService;
    }

    public function getBookId(): int
    {
        return $this->bookId;
    }

    public function getBookName(): string
    {
        return $this->bookName;
    }

    /*protected function forgeQuery(Query $query = null): Query
    {
        $query = parent::forgeQuery($query);
        $query->whereNew(new Where('book_id', $this->getBookId()));
        return $query;
    }*/

    protected function forgeQuery(Query $query = null): Query
    {
        $query = parent::forgeQuery($query);
        if ($this->bookId) {
            $query->whereNew(new Where('book_id', $this->getBookId()));
        } elseif ($this->bookName) {
            $bookEntity = $this->bookService->findOneByName($this->getBookName());
            $query->whereNew(new Where('book_id', $bookEntity->getId()));
        }
        return $query;
    }
}