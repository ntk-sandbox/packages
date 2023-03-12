<?php

namespace Untek\Bundle\Eav\Domain\Services;

use DateTime;
use Untek\Bundle\Eav\Domain\Entities\AttributeEntity;
use Untek\Bundle\Eav\Domain\Entities\DynamicEntity;
use Untek\Bundle\Eav\Domain\Entities\ValueEntity;
use Untek\Bundle\Eav\Domain\Interfaces\Repositories\ValueRepositoryInterface;
use Untek\Bundle\Eav\Domain\Interfaces\Services\EntityServiceInterface;
use Untek\Bundle\Eav\Domain\Interfaces\Services\ValueServiceInterface;
use Untek\Core\Instance\Helpers\PropertyHelper;
use Untek\Core\Contract\Common\Exceptions\NotFoundException;
use Untek\Domain\EntityManager\Interfaces\EntityManagerInterface;
use Untek\Domain\Service\Base\BaseCrudService;

/**
 * @method ValueRepositoryInterface getRepository()
 */
class ValueService extends BaseCrudService implements ValueServiceInterface
{

    private $entityService;

    public function __construct(EntityManagerInterface $em, EntityServiceInterface $entityService)
    {
        $this->setEntityManager($em);
        $this->entityService = $entityService;
    }

    public function getEntityClass(): string
    {
        return ValueEntity::class;
    }

    public function oneRecord(int $entityId, int $recordId): DynamicEntity
    {
        $valueCollection = $this->getRepository()->allValues($entityId, $recordId);
        if ($valueCollection->count() == 0) {
            throw new NotFoundException();
        }
        $dynamicEntity = $this->entityService->createEntityById($entityId);
        foreach ($valueCollection as $valueEntity) {
            $name = $valueEntity->getAttribute()->getName();
            PropertyHelper::setValue($dynamicEntity, $name, $valueEntity->getValue());
        }
        return $dynamicEntity;
    }

    public function persistValue(AttributeEntity $attributeEntity, int $entityId, int $recordId, $value): void
    {
        $valueEntity = new ValueEntity();
        $valueEntity->setEntityId($entityId);
        $valueEntity->setRecordId($recordId);
        $valueEntity->setAttributeId($attributeEntity->getId());
        $valueEntity->setValue($value);
        $valueEntity->setUpdatedAt(new DateTime());
        $this->getEntityManager()->persist($valueEntity);
    }
}
