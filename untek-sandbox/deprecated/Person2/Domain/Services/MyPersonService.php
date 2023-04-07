<?php

namespace Untek\Sandbox\Sandbox\Person2\Domain\Services;

use Symfony\Component\Security\Core\Security;
use Untek\Core\Instance\Helpers\PropertyHelper;
use Untek\Model\EntityManager\Interfaces\EntityManagerInterface;
use Untek\Model\Query\Entities\Query;
use Untek\Model\Service\Base\BaseService;
use Untek\Sandbox\Sandbox\Person2\Domain\Entities\PersonEntity;
use Untek\Sandbox\Sandbox\Person2\Domain\Interfaces\Repositories\InheritanceRepositoryInterface;
use Untek\Sandbox\Sandbox\Person2\Domain\Interfaces\Repositories\PersonRepositoryInterface;
use Untek\Sandbox\Sandbox\Person2\Domain\Interfaces\Services\MyPersonServiceInterface;
use Untek\User\Authentication\Domain\Traits\GetUserTrait;

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