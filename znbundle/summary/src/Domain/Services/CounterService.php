<?php

namespace Untek\Bundle\Summary\Domain\Services;

use Packages\User\Domain\Interfaces\Services\SessionServiceInterface;
use Symfony\Component\Security\Core\Security;
use Untek\Bundle\Summary\Domain\Entities\CounterEntity;
use Untek\Bundle\Summary\Domain\Interfaces\Repositories\CounterRepositoryInterface;
use Untek\Bundle\Summary\Domain\Interfaces\Services\CounterServiceInterface;
use Untek\Core\Contract\Common\Exceptions\NotFoundException;
use Untek\Domain\Entity\Exceptions\AlreadyExistsException;
use Untek\Domain\Entity\Interfaces\EntityIdInterface;
use Untek\Domain\EntityManager\Interfaces\EntityManagerInterface;
use Untek\Domain\Query\Entities\Query;
use Untek\Domain\Query\Entities\Where;
use Untek\Domain\Service\Base\BaseCrudService;
use Untek\User\Authentication\Domain\Interfaces\Services\AuthServiceInterface;
use Untek\User\Authentication\Domain\Traits\GetUserTrait;

class CounterService extends BaseCrudService implements CounterServiceInterface
{

    use GetUserTrait;

//    private $authService;
    private $sessionService;

    public function __construct(
        EntityManagerInterface $em,
        CounterRepositoryInterface $repository,
//        AuthServiceInterface $authService,
        SessionServiceInterface $sessionService,
        private Security $security
    )
    {
        $this->setEntityManager($em);
        $this->setRepository($repository);
//        $this->authService = $authService;
        $this->sessionService = $sessionService;
    }

    public function increment(string $entityName, int $entityId, string $type, bool $isUnique = false): int
    {
        if ($isUnique) {
            try {
                $counterEntity = $this->oneRecord($entityName, $entityId, $type);
                throw new AlreadyExistsException();
            } catch (NotFoundException $e) {
            }
        }

        $counterEntity = new CounterEntity();
        $counterEntity->setEntityName($entityName);
        $counterEntity->setEntityId($entityId);
        $counterEntity->setType($type);

        $identityEntity = $this->security->getUser();
        if($identityEntity) {
            $counterEntity->setUserId($identityEntity->getId());
        }

        $sessionEntity = $this->sessionService->currentSession();
        $counterEntity->setSessionId($sessionEntity->getId());
        $this->getRepository()->create($counterEntity);
        return $this->countRecords($entityName, $entityId, $type);
    }

    public function decrement(string $entityName, int $entityId, string $type, bool $isUnique = false): int
    {
        $this->deleteRecord($entityName, $entityId, $type);
        return $this->countRecords($entityName, $entityId, $type);
    }

    private function oneRecord(string $entityName, int $entityId, string $type): EntityIdInterface
    {
        $query = new Query();
        $query->whereNew(new Where('entity_name', $entityName));
        $query->whereNew(new Where('entity_id', $entityId));
        $query->whereNew(new Where('type', $type));


        $identityEntity = $this->security->getUser();
        if($identityEntity) {
            $userId = $identityEntity->getId();
            $query->whereNew(new Where('user_id', $userId));
        } else {
            $sessionEntity = $this->sessionService->currentSession();
            $query->whereNew(new Where('session_id', $sessionEntity->getId()));
        }

        /*if (!$this->authService->isGuest()) {
            $userId = $this->authService->getIdentity()->getId();
            $query->whereNew(new Where('user_id', $userId));
        } else {
            $sessionEntity = $this->sessionService->currentSession();
            $query->whereNew(new Where('session_id', $sessionEntity->getId()));
        }*/
        return $this->getRepository()->findOne($query);
    }

    private function deleteRecord(string $entityName, int $entityId, string $type): int
    {
        $entity = $this->oneRecord($entityName, $entityId, $type);
        $this->getEntityManager()->remove($entity);
    }

    private function countRecords(string $entityName, int $entityId, string $type): int
    {
        $query = new Query();
        $query->whereNew(new Where('entity_name', $entityName));
        $query->whereNew(new Where('entity_id', $entityId));
        $query->whereNew(new Where('type', $type));
        return $this->getRepository()->count($query);
    }
}
