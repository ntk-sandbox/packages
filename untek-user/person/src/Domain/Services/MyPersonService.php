<?php

namespace Untek\User\Person\Domain\Services;

use Symfony\Component\Security\Core\Security;
use Untek\Core\Instance\Helpers\PropertyHelper;
use Untek\Domain\EntityManager\Interfaces\EntityManagerInterface;
use Untek\Domain\Query\Entities\Query;
use Untek\Domain\Service\Base\BaseService;
use Untek\User\Authentication\Domain\Traits\GetUserTrait;
use Untek\User\Person\Domain\Entities\PersonEntity;
use Untek\User\Person\Domain\Interfaces\Repositories\InheritanceRepositoryInterface;
use Untek\User\Person\Domain\Interfaces\Repositories\PersonRepositoryInterface;
use Untek\User\Person\Domain\Interfaces\Services\MyPersonServiceInterface;

class MyPersonService extends BaseService implements MyPersonServiceInterface
{

    use GetUserTrait;

    private $personRepository;
    private $inheritanceRepository;

    public function __construct(
        EntityManagerInterface $em,
        PersonRepositoryInterface $personRepository,
        InheritanceRepositoryInterface $inheritanceRepository,
        private Security $security
    ) {
        $this->setEntityManager($em);
        $this->personRepository = $personRepository;
        $this->inheritanceRepository = $inheritanceRepository;
    }

    public function findOne(Query $query = null): PersonEntity
    {
        $id = $this->getUser()->getPersonId();
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