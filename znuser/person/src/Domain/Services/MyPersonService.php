<?php

namespace ZnUser\Person\Domain\Services;

use Symfony\Component\Security\Core\Security;
use ZnCore\Code\Helpers\PropertyHelper;
use ZnCore\Contract\User\Exceptions\UnauthorizedException;
use ZnCore\Contract\User\Interfaces\Entities\IdentityEntityInterface;
use ZnDomain\EntityManager\Interfaces\EntityManagerInterface;
use ZnDomain\Query\Entities\Query;
use ZnDomain\Service\Base\BaseService;
use ZnUser\Person\Domain\Entities\PersonEntity;
use ZnUser\Person\Domain\Interfaces\Repositories\InheritanceRepositoryInterface;
use ZnUser\Person\Domain\Interfaces\Repositories\PersonRepositoryInterface;
use ZnUser\Person\Domain\Interfaces\Services\MyPersonServiceInterface;
use ZnUser\Authentication\Domain\Interfaces\Services\AuthServiceInterface;

class MyPersonService extends BaseService implements MyPersonServiceInterface
{

    private $authService;
    private $personRepository;
    private $inheritanceRepository;

    public function __construct(
        EntityManagerInterface $em,
        AuthServiceInterface $authService,
        PersonRepositoryInterface $personRepository,
        InheritanceRepositoryInterface $inheritanceRepository,
        private Security $security
    )
    {
        $this->setEntityManager($em);
        $this->authService = $authService;
        $this->personRepository = $personRepository;
        $this->inheritanceRepository = $inheritanceRepository;
    }

    private function getUser(): ?IdentityEntityInterface {
        $identityEntity = $this->security->getUser();
        if($identityEntity == null) {
            throw new UnauthorizedException();
        }
        return $identityEntity;
    }

    public function findOne(Query $query = null): PersonEntity
    {
        $id = $this->getUser()->getPersonId();
//        $id = $this->authService->getIdentity()->getPersonId();
        return $this->personRepository->findOneById($id, $query);
    }

    public function update(array $data): void
    {
        if (isset($data['id'])) {
            //unset($data['id']);
        }
        $personEntity = $this->findOne();
        //dump($personEntity);
        PropertyHelper::setAttributes($personEntity, $data);
        $this->getEntityManager()->update($personEntity);
    }

    public function isMyChild($id)
    {
        $parentEntityId = $this->findOne()->getId();
        $childEntityId = $this->personRepository->findOneById($id)->getId();

        $query = new Query();
        $query->where('parent_person_id', $parentEntityId);
        $query->where('child_person_id', $childEntityId);
        $childrenEntity = $this->inheritanceRepository->findAll($query);

        if ($childrenEntity->count() > 0) {
            return true;
        }

        return false;
    }
}