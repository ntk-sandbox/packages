<?php

namespace Untek\Bundle\Reference\Domain\Services;

use Untek\Bundle\Reference\Domain\Entities\BookEntity;
use Untek\Domain\Components\SoftDelete\Subscribers\SoftDeleteSubscriber;
use Untek\Bundle\Reference\Domain\Interfaces\Repositories\BookRepositoryInterface;
use Untek\Bundle\Reference\Domain\Interfaces\Services\BookServiceInterface;
use Untek\Domain\Service\Base\BaseCrudService;
use Untek\Domain\Query\Entities\Where;
use Untek\Domain\EntityManager\Interfaces\EntityManagerInterface;
use Untek\Domain\Query\Entities\Query;
use Untek\Domain\Components\SoftDelete\Traits\Service\SoftDeleteTrait;
use Untek\Domain\Components\SoftDelete\Traits\Service\SoftRestoreTrait;

class BookService extends BaseCrudService implements BookServiceInterface
{

//    use SoftDeleteTrait;
    use SoftRestoreTrait;

    public function __construct(EntityManagerInterface $em, BookRepositoryInterface $repository)
    {
        $this->setEntityManager($em);
        $this->setRepository($repository);
    }

    public function subscribes(): array
    {
        return [
            SoftDeleteSubscriber::class,
        ];
    }

    public function findOneByName(string $name, Query $query = null): BookEntity
    {
        return $this->getRepository()->findOneByName($name, $query);
    }
}
