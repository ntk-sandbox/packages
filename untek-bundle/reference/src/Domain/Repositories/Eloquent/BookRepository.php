<?php

namespace Untek\Bundle\Reference\Domain\Repositories\Eloquent;

use Untek\Bundle\Reference\Domain\Entities\BookEntity;
use Untek\Bundle\Reference\Domain\Interfaces\Repositories\BookRepositoryInterface;
use Untek\Model\Query\Entities\Where;
use Untek\Model\Query\Entities\Query;
use Untek\Database\Eloquent\Domain\Base\BaseEloquentCrudRepository;
use Untek\Model\Repository\Mappers\JsonMapper;

class BookRepository extends BaseEloquentCrudRepository implements BookRepositoryInterface
{

    protected $tableName = 'reference_book';

    public function getEntityClass(): string
    {
        return BookEntity::class;
    }

    public function mappers(): array
    {
        return [
            new JsonMapper(['title_i18n']),
        ];
    }

    public function findOneByName(string $name, Query $query = null): BookEntity
    {
        $query = $this->forgeQuery($query);
        $query->whereNew(new Where('entity', $name));
        return $this->findOne($query);
    }
}
