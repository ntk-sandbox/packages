<?php

namespace Untek\Bundle\Eav\Domain\Interfaces\Services;

use Untek\Bundle\Eav\Domain\Entities\DynamicEntity;
use Untek\Bundle\Eav\Domain\Entities\EntityEntity;
use Untek\Bundle\Eav\Domain\Forms\DynamicForm;
use Untek\Model\Validator\Exceptions\UnprocessibleEntityException;
use Untek\Core\Collection\Interfaces\Enumerable;
use Untek\Model\Query\Entities\Query;
use Untek\Model\Service\Interfaces\CrudServiceInterface;

interface EntityServiceInterface extends CrudServiceInterface
{

    public function allByCategoryId(int $categoryId, Query $query = null): Enumerable;

    public function findOneByName(string $name, Query $query = null): EntityEntity;

    public function validateEntity(DynamicEntity $dynamicEntity): void;

    public function updateEntity(DynamicEntity $dynamicEntity): void;

    public function createEntityById(int $id): DynamicEntity;

    public function createFormById(int $id): DynamicForm;

    public function createFormByEntity(EntityEntity $entityEntity): DynamicForm;

    public function findOneByIdWithRelations($id, Query $query = null): EntityEntity;

    /**
     * @param int $entityId
     * @param array $data
     * @return DynamicEntity
     * @throws UnprocessibleEntityException
     */
    public function validate(int $entityId, array $data): DynamicEntity;
}
