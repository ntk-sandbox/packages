<?php

namespace Untek\User\Notify\Domain\Services;

use Symfony\Component\Security\Core\Security;
use Untek\Core\Contract\Common\Exceptions\NotFoundException;
use Untek\Domain\Entity\Interfaces\EntityIdInterface;
use Untek\Domain\EntityManager\Interfaces\EntityManagerInterface;
use Untek\Domain\Query\Entities\Query;
use Untek\Domain\Query\Entities\Where;
use Untek\Domain\Service\Base\BaseCrudService;
use Untek\User\Authentication\Domain\Traits\GetUserTrait;
use Untek\User\Notify\Domain\Entities\NotifyEntity;
use Untek\User\Notify\Domain\Enums\NotifyStatusEnum;
use Untek\User\Notify\Domain\Interfaces\Services\MyHistoryServiceInterface;

class MyHistoryService extends BaseCrudService implements MyHistoryServiceInterface
{

//    use SoftDeleteTrait;
//    use SoftRestoreTrait;

    use GetUserTrait;

    public function __construct(
        EntityManagerInterface $em,
//        HistoryRepositoryInterface $repository,
        private Security $security
    ) {
        $this->setEntityManager($em);
        $repository = $this->getEntityManager()->getRepository(NotifyEntity::class);
        $this->setRepository($repository);
    }

    public function clearMyMessages()
    {
        $myIdentity = $this->getUser();
        $this->getRepository()->deleteByCondition(['recipient_id' => $myIdentity->getId()]);
    }

    public function findOneById($id, Query $query = null): EntityIdInterface
    {
        $this->seenById($id);
        return parent::findOneById($id, $query);
    }

    public function seenById(int $id)
    {
        $myIdentity = $this->getUser();
        $query = new Query();
        $query->whereNew(new Where('recipient_id', $myIdentity->getId()));
        $query->whereNew(new Where('status_id', NotifyStatusEnum::NEW));
        $query->whereNew(new Where('id', $id));
        try {
            /** @var NotifyEntity $entity */
//            $entity = $this->getRepository()->findOne($query);
            $entity = $this->getEntityManager()->getRepository(NotifyEntity::class)->findOne($query);
        } catch (NotFoundException $e) {
            return;
        }
        $entity->seen();
        $this->getEntityManager()->persist($entity);
    }

    public function readAll()
    {
        $myIdentity = $this->getUser();
        $query = new Query();
        $query->whereNew(new Where('recipient_id', $myIdentity->getId()));
        $query->whereNew(new Where('status_id', NotifyStatusEnum::NEW));
        $this->getRepository()->updateByQuery(
            $query,
            [
                'status_id' => NotifyStatusEnum::SEEN,
            ]
        );
    }

    protected function forgeQuery(Query $query = null): Query
    {
        $query = parent::forgeQuery($query);
        $myIdentity = $this->getUser();
        $query->whereNew(new Where('recipient_id', $myIdentity->getId()));
        return $query;
    }
}
