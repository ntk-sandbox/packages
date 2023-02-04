<?php

namespace Untek\Bundle\Eav\Domain\Interfaces\Services;

use Untek\Bundle\Eav\Domain\Entities\AttributeEntity;
use Untek\Bundle\Eav\Domain\Entities\DynamicEntity;
use Untek\Core\Contract\Common\Exceptions\NotFoundException;
use Untek\Domain\Validator\Exceptions\UnprocessibleEntityException;
use Untek\Domain\Service\Interfaces\CrudServiceInterface;

interface ValueServiceInterface extends CrudServiceInterface
{

    /**
     * @param AttributeEntity $attributeEntity
     * @param int $typeId
     * @param int $recordId
     * @param $value
     * @return void
     * @var UnprocessibleEntityException
     */
    public function persistValue(AttributeEntity $attributeEntity, int $typeId, int $recordId, $value): void;

    /**
     * @param int $entityId
     * @param int $recordId
     * @return DynamicEntity
     * @throws NotFoundException
     */
    public function oneRecord(int $entityId, int $recordId): DynamicEntity;
}
