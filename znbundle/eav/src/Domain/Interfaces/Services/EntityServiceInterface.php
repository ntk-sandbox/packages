<?php

namespace ZnBundle\Eav\Domain\Interfaces\Services;

use ZnBundle\Eav\Domain\Entities\DynamicEntity;
use ZnBundle\Eav\Domain\Entities\EntityEntity;
use ZnBundle\Eav\Domain\Forms\DynamicForm;
use ZnDomain\Validator\Exceptions\UnprocessibleEntityException;
use ZnCore\Collection\Interfaces\Enumerable;
use ZnDomain\Query\Entities\Query;
use ZnDomain\Service\Interfaces\CrudServiceInterface;

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
