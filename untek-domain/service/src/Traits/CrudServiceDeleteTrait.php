<?php

namespace Untek\Model\Service\Traits;

use Untek\Model\Shared\Enums\EventEnum;

trait CrudServiceDeleteTrait
{

    public function deleteById($id)
    {
        if ($this->hasEntityManager()) {
            $this->getEntityManager()->beginTransaction();
        }
        try {
            $entity = $this->getRepository()->findOneById($id);
            $event = $this->dispatchEntityEvent($entity, EventEnum::BEFORE_DELETE_ENTITY);
            if (!$event->isSkipHandle()) {
                $this->getRepository()->deleteById($id);
            }
            $event = $this->dispatchEntityEvent($entity, EventEnum::AFTER_DELETE_ENTITY);
        } catch (\Throwable $e) {
            if ($this->hasEntityManager()) {
                $this->getEntityManager()->rollbackTransaction();
            }
            throw $e;
        }
        if ($this->hasEntityManager()) {
            $this->getEntityManager()->commitTransaction();
        }
    }
}
