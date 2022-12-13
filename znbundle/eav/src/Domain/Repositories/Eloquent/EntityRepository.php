<?php

namespace ZnBundle\Eav\Domain\Repositories\Eloquent;

use ZnBundle\Eav\Domain\Entities\EntityAttributeEntity;
use ZnBundle\Eav\Domain\Entities\EntityEntity;
use ZnBundle\Eav\Domain\Interfaces\Repositories\CategoryRepositoryInterface;
use ZnBundle\Eav\Domain\Interfaces\Repositories\EntityAttributeRepositoryInterface;
use ZnBundle\Eav\Domain\Interfaces\Repositories\EntityRepositoryInterface;
use ZnCore\Collection\Interfaces\Enumerable;
use ZnCore\Collection\Libs\Collection;
use ZnDomain\Query\Entities\Query;
use ZnDomain\Relation\Libs\Types\OneToManyRelation;
use ZnDomain\Relation\Libs\Types\OneToOneRelation;
use ZnDatabase\Eloquent\Domain\Base\BaseEloquentCrudRepository;

class EntityRepository extends BaseEloquentCrudRepository implements EntityRepositoryInterface
{

    public function tableName(): string
    {
        return 'eav_entity';
    }

    public function getEntityClass(): string
    {
        return EntityEntity::class;
    }

    public function findOneByName(string $name, Query $query = null): EntityEntity
    {
        $query = Query::forge($query);
        $query->where('name', $name);
        /*$query->with([
            'attributesTie.attribute',
            //'attributesTie.attribute.enums',
            //'attributesTie.attribute.unit',
        ]);*/
        /** @var EntityEntity $entity */
        return $this->findOne($query);
    }

    public function relations()
    {
        return [
            [
                'class' => OneToOneRelation::class,
                'relationAttribute' => 'category_id',
                'relationEntityAttribute' => 'category',
                'foreignRepositoryClass' => CategoryRepositoryInterface::class,
            ],
            [
                'class' => OneToManyRelation::class,
                'relationAttribute' => 'id',
                'name' => 'attributesTie',
                'relationEntityAttribute' => 'attributes',
                'foreignRepositoryClass' => EntityAttributeRepositoryInterface::class,
                'foreignAttribute' => 'entity_id',
                'prepareCollection' => function (Enumerable $collection) {
                    /** @var EntityEntity $entityEntity */
                    foreach ($collection as $entityEntity) {
                        $entityAttributeCollection = $entityEntity->getAttributes();
                        $filedCollection = new Collection();
                        /** @var EntityAttributeEntity $entityAttributeEntity */
                        foreach ($entityAttributeCollection as $entityAttributeEntity) {
                            $attributeEntity = $entityAttributeEntity->getAttribute();
                            if ($entityAttributeEntity->getDefault() !== null) {
                                $attributeEntity->setDefault($entityAttributeEntity->getDefault());
                            }
                            if ($entityAttributeEntity->getIsRequired() !== null) {
                                $attributeEntity->setIsRequired($entityAttributeEntity->getIsRequired());
                            }
                            $attributeEntity->setTie($entityAttributeEntity);
                            $filedCollection->add($attributeEntity);
                        }
                        $entityEntity->setAttributes($filedCollection);
                        $entityEntity->setAttributesTie($entityAttributeCollection);
                    }
                    return $collection;
                }
            ],
        ];
    }
}
