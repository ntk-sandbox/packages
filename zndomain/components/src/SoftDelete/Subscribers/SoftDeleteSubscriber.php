<?php

namespace Untek\Domain\Components\SoftDelete\Subscribers;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Untek\Domain\Query\Entities\Where;
use Untek\Domain\Query\Enums\OperatorEnum;
use Untek\Domain\Domain\Enums\EventEnum;
use Untek\Domain\Domain\Events\EntityEvent;
use Untek\Domain\Domain\Events\QueryEvent;
use Untek\Domain\EntityManager\Interfaces\EntityManagerInterface;
use Untek\Domain\EntityManager\Traits\EntityManagerAwareTrait;
use Untek\Lib\Components\Status\Enums\StatusEnum;

class SoftDeleteSubscriber implements EventSubscriberInterface
{

    use EntityManagerAwareTrait;

    public $disableStatusId = StatusEnum::DELETED;

//    public $enableStatusId = StatusEnum::ENABLED;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->setEntityManager($entityManager);
    }

    public static function getSubscribedEvents()
    {
        return [
            EventEnum::BEFORE_DELETE_ENTITY => 'onBeforeDelete',
            EventEnum::BEFORE_FORGE_QUERY => 'onForgeQuery',
        ];
    }

    public function onBeforeDelete(EntityEvent $event)
    {
        $entity = $event->getEntity();
        if (method_exists($entity, 'delete')) {
            $entity->delete();
        } else {
            $entity->setStatusId($this->disableStatusId);
        }
        $this->getEntityManager()->persist($entity);
        $event->skipHandle();
    }

    public function onForgeQuery(QueryEvent $event)
    {
        if ($event->getQuery()->getWhere()) {
            foreach ($event->getQuery()->getWhere() as $where) {
                /** @var Where $where */
                if ($where->column == 'status_id') {
                    return;
                }
            }
        }
        $event->getQuery()->where('status_id', $this->disableStatusId, OperatorEnum::NOT_EQUAL);
    }
}
