<?php

namespace Untek\Bundle\Reference\Domain\Repositories\Eloquent;

use Untek\Bundle\Reference\Domain\Entities\BookEntity;
use Untek\Bundle\Reference\Domain\Entities\ItemEntity;
use Untek\Bundle\Reference\Domain\Filters\ItemFilter;
use Untek\Bundle\Reference\Domain\Interfaces\Repositories\BookRepositoryInterface;
use Untek\Bundle\Reference\Domain\Interfaces\Repositories\ItemRepositoryInterface;
use Untek\Model\Validator\Exceptions\UnprocessibleEntityException;
use Untek\Core\Contract\Common\Exceptions\NotFoundException;
use Untek\Model\Shared\Enums\RelationEnum;
use Untek\Model\Query\Entities\Query;
use Untek\Model\Relation\Libs\Types\OneToManyRelation;
use Untek\Model\Relation\Libs\Types\OneToOneRelation;
use Untek\Model\Repository\Mappers\JsonMapper;
use Untek\Database\Eloquent\Domain\Base\BaseEloquentCrudRepository;

class ItemRepository extends BaseEloquentCrudRepository implements ItemRepositoryInterface
{

    protected $tableName = 'reference_item';
    protected $translationRepository;

    public function getEntityClass(): string
    {
        return ItemEntity::class;
    }

    public function mappers(): array
    {
        return [
            new JsonMapper(['title_i18n', 'props']),
        ];
    }

    public function forgeQueryByFilter(object $filterModel, Query $query)
    {
        if ($filterModel instanceof ItemFilter) {
            if ($filterModel->getBookName()) {
                try {
                    /** @var BookEntity $bookEntity */
                    $bookEntity = $this
                        ->getEntityManager()
                        ->getRepository(BookEntity::class)
                        ->findOneByName($filterModel->getBookName());
                    $query->where('book_id', $bookEntity->getId());
                } catch (NotFoundException $e) {
                    throw(new UnprocessibleEntityException())
                        ->add('bookName', $e->getMessage());
                }
            }
        }
        parent::forgeQueryByFilter($filterModel, $query);
    }

    /*protected function forgeQuery(Query $query = null): Query
    {
        $query = parent::forgeQuery($query);
        $query->with(['translations']);
        return $query;
    }*/

    public function relations()
    {
        return [
            /*[
                'class' => OneToManyRelation::class,
                'relationAttribute' => 'id',
                'relationEntityAttribute' => 'translations',
                'foreignRepositoryClass' => ItemTranslationRepositoryInterface::class,
                'foreignAttribute' => 'item_id',
            ],*/
            [
                'class' => OneToOneRelation::class,
                'relationAttribute' => 'book_id',
                'relationEntityAttribute' => 'book',
                'foreignRepositoryClass' => BookRepositoryInterface::class,
            ],
            [
                'class' => OneToOneRelation::class,
                'relationAttribute' => 'parent_id',
                'relationEntityAttribute' => 'parent',
                'foreignRepositoryClass' => ItemRepositoryInterface::class,
            ],
            [
                'class' => OneToManyRelation::class,
                'relationAttribute' => 'id',
                'relationEntityAttribute' => 'children',
                'foreignRepositoryClass' => ItemRepositoryInterface::class,
                'foreignAttribute' => 'parent_id',
            ],
        ];
    }
}
