<?php

namespace ZnBundle\Reference\Domain\Services;

use ZnBundle\Reference\Domain\Interfaces\Repositories\ItemRepositoryInterface;
use ZnBundle\Reference\Domain\Interfaces\Services\BookServiceInterface;
use ZnBundle\Reference\Domain\Interfaces\Services\ItemBookServiceInterface;
use ZnBundle\Reference\Domain\Interfaces\Services\ItemServiceInterface;
use ZnBundle\Reference\Domain\Subscribers\BookIdSubscriber;
use ZnLib\Components\Status\Enums\StatusEnum;
use ZnDomain\Query\Entities\Where;
use ZnDomain\EntityManager\Interfaces\EntityManagerInterface;
use ZnDomain\Query\Entities\Query;

class ItemBookService extends ItemService implements ItemBookServiceInterface
{

    private $bookId;
    private $bookName;
    private $bookService;

    public function __construct(EntityManagerInterface $em, ItemRepositoryInterface $repository, BookServiceInterface $bookService)
    {
        parent::__construct($em, $repository);
        $this->bookService = $bookService;
    }

    public function getBookId(): int
    {
        return $this->bookId;
    }

    public function setBookId(int $bookId): void
    {
        $this->bookId = $bookId;
    }

    public function getBookName(): string
    {
        return $this->bookName;
    }

    public function setBookName(string $bookName): void
    {
        $this->bookName = $bookName;
        $this->addSubscriber([
            'class' => BookIdSubscriber::class,
            'bookName' => $bookName,
        ]);
    }

    protected function forgeQuery(Query $query = null): Query
    {
        $query = parent::forgeQuery($query);
//        $query->where('status_id', StatusEnum::ENABLED);
//        $query->orderBy(['sort' => SORT_ASC]);
        if($this->bookId) {
            $query->whereNew(new Where('book_id', $this->getBookId()));
        } elseif($this->bookName) {
            $bookEntity = $this->bookService->findOneByName($this->bookName);
            $query->whereNew(new Where('book_id', $bookEntity->getId()));
        }
        return $query;
    }
}
