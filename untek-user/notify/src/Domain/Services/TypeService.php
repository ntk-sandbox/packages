<?php

namespace Untek\User\Notify\Domain\Services;

use Untek\Model\Service\Base\BaseCrudService;
use Untek\Model\EntityManager\Interfaces\EntityManagerInterface;
use Untek\Model\Query\Entities\Query;
use Untek\User\Notify\Domain\Entities\TypeEntity;
use Untek\User\Notify\Domain\Interfaces\Repositories\TypeRepositoryInterface;
use Untek\User\Notify\Domain\Interfaces\Services\TransportServiceInterface;
use Untek\User\Notify\Domain\Interfaces\Services\TypeServiceInterface;

class TypeService extends BaseCrudService implements TypeServiceInterface
{

    private $transportService;

    public function __construct(EntityManagerInterface $em, TypeRepositoryInterface $repository, TransportServiceInterface $transportService)
    {
        $this->setEntityManager($em);
        $this->setRepository($repository);
        $this->transportService = $transportService;
    }

//    public function findOneByIdWithI18n(int $id): TypeEntity
//    {
//        $query = new Query();
//        $query->with(['i18n']);
//        /** @var TypeEntity $typeEntity */
//        $typeEntity = $this->getEntityManager()->getRepository(TypeEntity::class)->findOneById($id, $query);
//        //$transportCollection = $this->transportService->allByTypeId($id);
//        //$typeEntity->setTransports($transportCollection);
//        return $typeEntity;
//    }

    public function findOneByName(string $name): TypeEntity
    {
        $query = new Query();
        $query->where('name', $name);
        //$query->with('i18n');
        /** @var TypeEntity $typeEntity */
        $typeEntity = $this->getEntityManager()->getRepository(TypeEntity::class)->findOne($query);
        return $typeEntity;
    }
}
