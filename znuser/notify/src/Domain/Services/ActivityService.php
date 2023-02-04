<?php

namespace Untek\User\Notify\Domain\Services;

use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Core\Security;
use Untek\Domain\Entity\Helpers\EntityHelper;
use Untek\Domain\Entity\Interfaces\EntityIdInterface;
use Untek\Domain\Service\Base\BaseCrudService;
use Untek\Domain\Validator\Exceptions\UnprocessibleEntityException;
use Untek\User\Notify\Domain\Entities\ActivityEntity;
use Untek\User\Notify\Domain\Interfaces\Repositories\ActivityRepositoryInterface;
use Untek\User\Notify\Domain\Interfaces\Services\ActivityServiceInterface;

class ActivityService extends BaseCrudService implements ActivityServiceInterface
{

    public function __construct(ActivityRepositoryInterface $repository, private Security $security)
    {
        $this->setRepository($repository);
    }

    public function addEntity(EntityIdInterface $entity, string $action)
    {
        $this->add(
            get_class($entity),
            $entity->getId(),
            $action,
            [
                'entity' => EntityHelper::toArray($entity),
            ]
        );
    }

    public function add(string $entityName, $entityId, string $action, array $attributes = [])
    {
        $entity = new ActivityEntity();
        $entity->setTypeId(1);
        $entity->setEntityName($entityName);
        $entity->setEntityId($entityId);
        $entity->setAction($action);
        $entity->setAttributes(json_encode($attributes));

        $identityEntity = $this->security->getUser();
        if ($identityEntity == null) {
            throw new AuthenticationException();
        }

        $entity->setUserId($identityEntity->getId());
        try {
            $this->getRepository()->create($entity);
        } catch (UnprocessibleEntityException $e) {
            dd($e->getErrorCollection());
        }
    }
}
