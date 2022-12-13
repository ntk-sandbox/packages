<?php

namespace ZnUser\Rbac\Domain\Services;

use ZnDomain\Validator\Exceptions\UnprocessibleEntityException;
use ZnCore\Contract\User\Interfaces\Entities\IdentityEntityInterface;
use ZnCore\Collection\Interfaces\Enumerable;
use ZnDomain\Entity\Exceptions\AlreadyExistsException;
use ZnCore\Contract\Common\Exceptions\NotFoundException;
use ZnCore\Collection\Helpers\CollectionHelper;
use ZnDomain\EntityManager\Interfaces\EntityManagerInterface;
use ZnDomain\Query\Entities\Query;
use ZnDomain\Service\Base\BaseCrudService;
use ZnUser\Rbac\Domain\Entities\AssignmentEntity;
use ZnUser\Rbac\Domain\Entities\ItemEntity;
use ZnUser\Rbac\Domain\Interfaces\Repositories\AssignmentRepositoryInterface;
use ZnUser\Rbac\Domain\Interfaces\Services\AssignmentServiceInterface;

/**
 * @method AssignmentRepositoryInterface getRepository()
 */
class AssignmentService extends BaseCrudService implements AssignmentServiceInterface
{

    public function __construct(EntityManagerInterface $em)
    {
        $this->setEntityManager($em);
    }

    public function getEntityClass(): string
    {
        return AssignmentEntity::class;
    }

    public function getRolesByIdentityId(int $identityId): array
    {
        $collection = $this->getRepository()->allByIdentityId($identityId);
        return CollectionHelper::getColumn($collection, 'item_name');
    }

    public function allByIdentityId(int $identityId, Query $query = null): Enumerable
    {
        $collection = $this->getRepository()->allByIdentityId($identityId, $query);
        return $collection;
    }

    public function attach(AssignmentEntity $assignmentEntity)
    {
        $this->checkExists($assignmentEntity);
        $this->validate($assignmentEntity);
        $this->getEntityManager()->persist($assignmentEntity);
    }

    public function detach(AssignmentEntity $assignmentEntity)
    {
        $this->validate($assignmentEntity);
        $this->getEntityManager()->remove($assignmentEntity);
    }

    private function checkExists(AssignmentEntity $assignmentEntity)
    {
        $assignmentQuery = new Query();
        $assignmentQuery->where('item_name', $assignmentEntity->getItemName());
        $assignmentQuery->where('identity_id', $assignmentEntity->getIdentityId());
        try {
            $assignmentEntity = $this->getEntityManager()->getRepository(AssignmentEntity::class)->findOne($assignmentQuery);
            throw new AlreadyExistsException('Assignment already exists');
        } catch (NotFoundException $e) {
        }
    }

    private function validate(AssignmentEntity $assignmentEntity)
    {
        $unprocessibleEntityException = new UnprocessibleEntityException();

        try {
            $identityEntity = $this->getEntityManager()->getRepository(IdentityEntityInterface::class)->findOneById($assignmentEntity->getIdentityId());
        } catch (NotFoundException $e) {
            $unprocessibleEntityException->add('identityId', 'User not found');
        }

        $itemQuery = new Query();
        $itemQuery->where('name', $assignmentEntity->getItemName());
        try {
            $itemEntity = $this->getEntityManager()->getRepository(ItemEntity::class)->findOne($itemQuery);
        } catch (NotFoundException $e) {
            $unprocessibleEntityException->add('itemName', 'Item not found');
        }

        if ($unprocessibleEntityException->getErrorCollection() && $unprocessibleEntityException->getErrorCollection()->count() > 0) {
            throw $unprocessibleEntityException;
        }
    }
}
