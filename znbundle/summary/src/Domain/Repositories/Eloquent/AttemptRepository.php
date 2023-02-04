<?php

namespace Untek\Bundle\Summary\Domain\Repositories\Eloquent;

use DateTime;
use Untek\Bundle\Summary\Domain\Entities\AttemptEntity;
use Untek\Bundle\Summary\Domain\Interfaces\Repositories\AttemptRepositoryInterface;
use Untek\Domain\Query\Entities\Where;
use Untek\Domain\Query\Enums\OperatorEnum;
use Untek\Domain\Query\Entities\Query;
use Untek\Database\Eloquent\Domain\Base\BaseEloquentCrudRepository;

class AttemptRepository extends BaseEloquentCrudRepository implements AttemptRepositoryInterface
{

    public function tableName(): string
    {
        return 'summary_attempt';
    }

    public function getEntityClass(): string
    {
        return AttemptEntity::class;
    }

    public function countByIdentityId(int $identityId, string $action, int $lifeTime): int
    {
        $date = new DateTime();
        $date->modify("-{$lifeTime} seconds");
        $query = new Query();
        $query->where('identity_id', $identityId);
        $query->whereNew(new Where('created_at', $date, OperatorEnum::GREATER));
        return $this->count($query);
    }
}
