<?php

namespace ZnBundle\Reference\Domain\Services;

use ZnBundle\Reference\Domain\Entities\BookEntity;
use ZnDomain\Components\SoftDelete\Subscribers\SoftDeleteSubscriber;
use ZnBundle\Reference\Domain\Interfaces\Repositories\BookRepositoryInterface;
use ZnBundle\Reference\Domain\Interfaces\Services\BookServiceInterface;
use ZnDomain\Service\Base\BaseCrudService;
use ZnDomain\Query\Entities\Where;
use ZnDomain\EntityManager\Interfaces\EntityManagerInterface;
use ZnDomain\Query\Entities\Query;
use ZnDomain\Components\SoftDelete\Traits\Service\SoftDeleteTrait;
use ZnDomain\Components\SoftDelete\Traits\Service\SoftRestoreTrait;

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
