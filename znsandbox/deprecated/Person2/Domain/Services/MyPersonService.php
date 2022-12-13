<?php

namespace ZnSandbox\Sandbox\Person2\Domain\Services;

use Symfony\Component\Security\Core\Security;
use ZnCore\Code\Helpers\PropertyHelper;
use ZnDomain\EntityManager\Interfaces\EntityManagerInterface;
use ZnDomain\Query\Entities\Query;
use ZnDomain\Service\Base\BaseService;
use ZnSandbox\Sandbox\Person2\Domain\Entities\PersonEntity;
use ZnSandbox\Sandbox\Person2\Domain\Interfaces\Repositories\InheritanceRepositoryInterface;
use ZnSandbox\Sandbox\Person2\Domain\Interfaces\Repositories\PersonRepositoryInterface;
use ZnSandbox\Sandbox\Person2\Domain\Interfaces\Services\MyPersonServiceInterface;
use ZnUser\Authentication\Domain\Traits\GetUserTrait;

class MyPersonService extends BaseService implements MyPersonServiceInterface
{

    use GetUserTrait;

//    private $authService;
    private $personRepository;
    private $inheritanceRepository;

    public function __construct(
        EntityManagerInterface $em,
//        AuthServiceInterface $authService,
        PersonRepositoryInterface $personRepository,
        InheritanceRepositoryInterface $inheritanceRepository,
        private Security $security
    )
    {
        $this->setEntityManager($em);
//        $this->authService = $authService;
        $this->personRepository = $personRepository;
        $this->inheritanceRepository = $inheritanceRepository;
    }

    public function findOne(Query $query = null): PersonEntity
    {
        $identityId = $this->getUser()->getId();
        return $this->personRepository->findOneByIdentityId($identityId, $query);
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