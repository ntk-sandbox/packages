<?php

namespace Untek\Bundle\Reference\Domain\Services;

use Untek\Lib\Components\Status\Enums\StatusEnum;
use Untek\Domain\Components\SoftDelete\Subscribers\SoftDeleteSubscriber;
use Untek\Bundle\Reference\Domain\Interfaces\Repositories\ItemRepositoryInterface;
use Untek\Bundle\Reference\Domain\Interfaces\Services\ItemServiceInterface;
use Untek\Domain\Service\Base\BaseCrudService;
use Untek\Domain\Query\Entities\Where;
use Untek\Domain\EntityManager\Interfaces\EntityManagerInterface;
use Untek\Domain\Query\Entities\Query;
use Untek\Domain\Components\SoftDelete\Traits\Service\SoftDeleteTrait;
use Untek\Domain\Components\SoftDelete\Traits\Service\SoftRestoreTrait;

class ItemService extends BaseCrudService implements ItemServiceInterface
{

    use SoftDeleteTrait;
    use SoftRestoreTrait;

    public function __construct(EntityManagerInterface $em, ItemRepositoryInterface $repository)
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

    protected function forgeQuery(Query $query = null): Query
    {
        $query = parent::forgeQuery($query);
//        $query->where('status_id', StatusEnum::ENABLED);
        $query->orderBy(['sort' => SORT_ASC]);
        return $query;
    }
}
