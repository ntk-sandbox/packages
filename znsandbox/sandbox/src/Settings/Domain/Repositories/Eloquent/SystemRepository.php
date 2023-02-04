<?php

namespace Untek\Sandbox\Sandbox\Settings\Domain\Repositories\Eloquent;

use Untek\Core\Collection\Interfaces\Enumerable;
use Untek\Domain\Query\Entities\Query;
use Untek\Domain\Repository\Mappers\JsonMapper;
use Untek\Database\Eloquent\Domain\Base\BaseEloquentCrudRepository;
use Untek\Sandbox\Sandbox\Settings\Domain\Entities\SystemEntity;
use Untek\Sandbox\Sandbox\Settings\Domain\Interfaces\Repositories\SystemRepositoryInterface;

class SystemRepository extends BaseEloquentCrudRepository implements SystemRepositoryInterface
{

    public function tableName(): string
    {
        return 'settings_system';
    }

    public function getEntityClass(): string
    {
        return SystemEntity::class;
    }

    public function mappers(): array
    {
        return [
            new JsonMapper(['value']),
        ];
    }

    public function allByName(string $name): Enumerable
    {
        $query = Query::forge();
        $query->where('name', $name);
        return $this->findAll($query);
    }
}
