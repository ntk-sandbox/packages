<?php

namespace Untek\Bundle\Reference\Domain\Services;

use Untek\Bundle\Reference\Domain\Interfaces\Repositories\ItemRepositoryInterface;
use Untek\Bundle\Reference\Domain\Interfaces\Services\BookServiceInterface;
use Untek\Bundle\Reference\Domain\Interfaces\Services\ItemBookServiceInterface;
use Untek\Bundle\Reference\Domain\Interfaces\Services\ItemServiceInterface;
use Untek\Bundle\Reference\Domain\Subscribers\BookIdSubscriber;
use Untek\Lib\Components\Status\Enums\StatusEnum;
use Untek\Model\Query\Entities\Where;
use Untek\Model\EntityManager\Interfaces\EntityManagerInterface;
use Untek\Model\Query\Entities\Query;

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
