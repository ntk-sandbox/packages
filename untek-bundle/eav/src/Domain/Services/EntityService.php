<?php

namespace Untek\Bundle\Eav\Domain\Services;

use Untek\Bundle\Eav\Domain\Entities\DynamicEntity;
use Untek\Bundle\Eav\Domain\Entities\EntityEntity;
use Untek\Bundle\Eav\Domain\Forms\DynamicForm;
use Untek\Bundle\Eav\Domain\Interfaces\Repositories\AttributeRepositoryInterface;
use Untek\Bundle\Eav\Domain\Interfaces\Repositories\EntityRepositoryInterface;
use Untek\Bundle\Eav\Domain\Interfaces\Services\EntityServiceInterface;
use Untek\Bundle\Eav\Domain\Interfaces\Services\ValueServiceInterface;
use Untek\Bundle\Eav\Domain\Libs\TypeNormalizer;
use Untek\Bundle\Eav\Domain\Libs\Validator;
use Untek\Core\Code\Helpers\PropertyHelper;
use Untek\Core\Collection\Interfaces\Enumerable;
use Untek\Core\Container\Helpers\ContainerHelper;
use Untek\Domain\EntityManager\Interfaces\EntityManagerInterface;
use Untek\Domain\Query\Entities\Query;
use Untek\Domain\Service\Base\BaseCrudService;

class EntityService extends BaseCrudService implements EntityServiceInterface
{

    private $attributeRepository;

    public function __construct(
        EntityRepositoryInterface $repository,
        EntityManagerInterface $entityManager,
        AttributeRepositoryInterface $attributeRepository
        //ValueServiceInterface $valueService
    )
    {
        $this->setEntityManager($entityManager);
        $this->setRepository($repository);
        $this->attributeRepository = $attributeRepository;
        //$this->valueService = $valueService;
    }

    public function allByCategoryId(int $categoryId, Query $query = null): Enumerable
    {
        $query = Query::forge($query);
        $query->where('category_id', $categoryId);
        return $this->findAll($query);
    }

    public function findOneByName(string $name, Query $query = null): EntityEntity
    {
        return $this->getRepository()->findOneByName($name, $query);
    }

    public function findOneByIdWithRelations($id, Query $query = null): EntityEntity
    {
        $query = Query::forge($query);
        $query->with([
            'attributesTie.attribute',
            //'attributesTie.attribute.enums',
            //'attributesTie.attribute.unit',
        ]);
        /** @var EntityEntity $entity */
        $entity = parent::findOneById($id, $query);
        return $entity;
    }

    public function createEntityById(int $id): DynamicEntity
    {
        $entityEntity = $this->findOneByIdWithRelations($id);
        return new DynamicEntity($entityEntity);
    }

    public function createFormById(int $id): DynamicForm
    {
        $entityEntity = $this->findOneByIdWithRelations($id);
        return $this->createFormByEntity($entityEntity);
    }

    public function createFormByEntity(EntityEntity $entityEntity): DynamicForm
    {
        return new DynamicForm($entityEntity);
    }

    public function validateEntity(DynamicEntity $dynamicEntity): void
    {
        $this->validate($dynamicEntity->entityId(), $dynamicEntity->toArray());
    }

    public function updateEntity(DynamicEntity $dynamicEntity): void
    {
//        $recordId = $dynamicEntity->getId();
//        $this->validate($dynamicEntity->entityId(), $dynamicEntity->toArray());
        $this->validateEntity($dynamicEntity);
        $entityEntity = $this->findOneByIdWithRelations($dynamicEntity->entityId());
        /** @var ValueServiceInterface $valueService */
        $valueService = ContainerHelper::getContainer()->get(ValueServiceInterface::class);
        foreach ($entityEntity->getAttributes() as $attributeEntity) {
            $name = $attributeEntity->getName();
            $value = PropertyHelper::getValue($dynamicEntity, $name);
            $valueService->persistValue($attributeEntity, $dynamicEntity->entityId(), $dynamicEntity->getId(), $value);
        }
    }

    public function validate(int $entityId, array $data): DynamicEntity
    {
        $entityEntity = $this->findOneByIdWithRelations($entityId);
        $dynamicEntity = new DynamicEntity($entityEntity);
        //$dynamicEntity = $this->createEntityById($entityId);
        $normalizer = new TypeNormalizer();
        $data = $normalizer->normalizeData($data, $entityEntity);
        PropertyHelper::setAttributes($dynamicEntity, $data);
        $validator = new Validator();
        $validator->validate($data, $dynamicEntity->validationRules());
        return $dynamicEntity;
    }

    public function normalize(int $entityId, array $data = []): DynamicEntity
    {
        $entityEntity = $this->findOneByIdWithRelations($entityId);
        $dynamicEntity = new DynamicEntity($entityEntity);
        $normalizer = new TypeNormalizer();
        $data = $normalizer->normalizeData($data, $entityEntity);
        PropertyHelper::setAttributes($dynamicEntity, $data);
        //$this->validateEntity($dynamicEntity);
        return $dynamicEntity;
    }
}
