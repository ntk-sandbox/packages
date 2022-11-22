<?php

namespace ZnUser\Notify\Domain\Services;

use Symfony\Component\Security\Core\Security;
use ZnCore\Contract\User\Exceptions\UnauthorizedException;
use ZnUser\Notify\Domain\Entities\ActivityEntity;
use ZnUser\Notify\Domain\Interfaces\Repositories\ActivityRepositoryInterface;
use ZnUser\Notify\Domain\Interfaces\Services\ActivityServiceInterface;
use ZnUser\Authentication\Domain\Interfaces\Services\AuthServiceInterface;
use ZnDomain\Service\Base\BaseCrudService;
use ZnDomain\Validator\Exceptions\UnprocessibleEntityException;
use ZnDomain\Entity\Helpers\EntityHelper;
use ZnDomain\Entity\Interfaces\EntityIdInterface;

class ActivityService extends BaseCrudService implements ActivityServiceInterface
{

    private $authService;

    public function __construct(ActivityRepositoryInterface $repository, AuthServiceInterface $authService, private Security $security)
    {
        $this->setRepository($repository);
        $this->authService = $authService;
    }

    public function addEntity(EntityIdInterface $entity, string $action)
    {
        $this->add(get_class($entity), $entity->getId(), $action, [
            'entity' => EntityHelper::toArray($entity),
        ]);
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
        if($identityEntity == null) {
            throw new UnauthorizedException();
        }

        $entity->setUserId($identityEntity->getId());
        try {
            $this->getRepository()->create($entity);
        } catch (UnprocessibleEntityException $e) {
            dd($e->getErrorCollection());
        }
    }
}
