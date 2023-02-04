<?php

namespace Untek\User\Confirm\Domain\Repositories\Eloquent;

use Untek\Domain\Query\Entities\Where;
use Untek\Domain\Query\Enums\OperatorEnum;
use Untek\Domain\Query\Entities\Query;
use Untek\Core\Contract\Common\Exceptions\NotFoundException;
use Untek\Database\Eloquent\Domain\Base\BaseEloquentCrudRepository;
use Untek\User\Confirm\Domain\Entities\ConfirmEntity;
use Untek\User\Confirm\Domain\Interfaces\Repositories\ConfirmRepositoryInterface;

class ConfirmRepository extends BaseEloquentCrudRepository implements ConfirmRepositoryInterface
{

    public function tableName() : string
    {
        return 'user_confirm';
    }

    public function getEntityClass() : string
    {
        return ConfirmEntity::class;
    }

    public function deleteExpired() {
        $queryBuilder = $this->getQueryBuilder();
        $queryBuilder->where('expire', OperatorEnum::LESS_OR_EQUAL, time());
        $queryBuilder->delete();
    }

    public function findOneByUniqueAttributes(string $login, string $action): ConfirmEntity
    {
        $query = new Query;
        $query->whereNew(new Where('login', $login));
        $query->whereNew(new Where('action', $action));
        $collection = $this->findAll($query);
        if($collection->count() == 0) {
            throw new NotFoundException();
        }
        return $collection->first();
    }
}
